<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\District;
use App\Models\Paslon;
use App\Models\Regency;
use App\Models\Saksi;
use App\Models\Tps;
use App\Models\User;
use App\Models\Village;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use App\Events\NotifEvent;
use App\Models\QuickSaksiData;
use App\Models\Tracking as ModelsTracking;

class AuditorController extends Controller
{
    public function index()
    {




        $data['district']  = District::where('id', Auth::user()->districts)->first();
        $district = $data['district'];
        $data['villages'] = Village::where('district_id', $district->id)->get();
        $data['team'] = User::where('id', '!=', Auth::user()->id)->where('role_id', Auth::user()->role_id)->get();
        $data['title2'] = "KEC ." . $data['district']['name'] . "";
        return view('auditor.index', $data);
    }

    public function auditData($id)
    {
        $id = Crypt::decrypt($id);
        $saksi = new Saksi;
        $data = [
            'audit' => 1,
        ];
        $saksi->where('id', $id)->update($data);
        $saksi = Saksi::where('id', $id)->first();
        $tps = Tps::where('id', $saksi['tps_id'])->first();
        $kecamatan = District::where('id', $saksi['district_id'])->first();
        $kelurahan = Village::where('id', $saksi['village_id'])->first();
        $pesan = "" . Auth::user()->name . " Mengaudit TPS " . $tps['number'] . " Kecamatan " . $kecamatan['name'] . " Kelurahan " . $kecamatan['name'] . "  ";
        $history = History::create([
            'user_id' => Auth::user()->id,
            'action' => $pesan,
            'saksi_id' => $saksi['id'],
            'status' => 2,
        ]);
        // event(new NotifEvent($pesan));
        return redirect()->back()->with(['success' => 'Berhasil Mengaudit data']);
    }
    public function tpsteraudit($id)
    {
        $id = Crypt::decrypt($id);
        $config = Config::first();
        $data['regency'] = Regency::where('id', $config->regencies_id)->first();
        $data['village'] = Village::where('id', $id)->first();
        $data['district'] = District::where('id', $data['village']->district_id)->first();
        $data['jumlah_tps_teraudit']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('tps.villages_id', $id)->where('saksi.audit', 1)->count();
        $data['jumlah_tps_terverifikasi'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('tps.villages_id', $id)->where('saksi.verification', 1)->count();
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('tps.villages_id', $id)
            ->where('saksi.verification', 1)
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->where('saksi.audit', 1)
        ->paginate(10);
        return view('auditor.tpsteraudit', $data);
    }
    public function batalkanData($id)
    {
        $id = Crypt::decrypt($id);
        $saksi = new Saksi;
        $data = [
            'batalkan' => 1,
            'verification' => "",
        ];
        $saksi->where('id', $id)->update($data);
        return redirect()->back()->with(['success-batal' => 'Berhasil Membatalkan data']);
    }
    public function village($id)
    {
        $id = Crypt::decrypt($id);
        $config = Config::first();
        $data['regency'] = Regency::where('id', (string)$config->regencies_id)->first();
        $data['village'] = Village::where('id', (string)$id)->first();
         $data['villages'] = Village::where('id', (string)$id)->get();

        $data['district'] = District::where('id', $data['village']->district_id)->first();
        $data['jumlah_tps_teraudit']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('tps.villages_id', $id)->where('saksi.audit', 1)->count();
        $data['jumlah_tps_terverifikasi'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('tps.villages_id', $id)->where('saksi.verification', 1)->count();
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('tps.villages_id', (string)$id)
            ->where('saksi.verification', 1)
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->where('saksi.audit', "")
            ->paginate(10);
                $data['title2'] = "KEC ." . $data['district']['name'] . "";
        $data['list_suara_audit']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('tps.villages_id', (string)$id)
           ->where('saksi.verification', 1)
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->where('saksi.audit', 1)
            ->paginate(10);

         $data['list_suara_batal']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('tps.villages_id', (string)$id)
           ->where('saksi.batalkan', 1)
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->paginate(10);

        return view('auditor.village', $data);

    }
    public function getSaksiData(Request $req)
    {
        $data['paslon'] = Paslon::with(['saksi_data' => function ($query) use ($req) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id')
                ->join('tps', 'tps.id', 'saksi.tps_id')

                ->where('tps.id', '=', $req->id);
        }])->get();
        $data['user'] = User::where('tps_id', $req->id)->first();

        $data['village'] = Village::where('id', $data['paslon'][0]->saksi_data[0]->village_id)->first();
        return view('auditor.modalView', $data);
    }

    public function auditC1() {
        $data['config'] = Config::first();
        $config = Config::first();
        $data['paslon'] = Paslon::with('quicksaksidata')->get();
        $data['paslon_terverifikasi']     = Paslon::with(['quicksaksidata' => function ($query) {
            $query->join('quicksaksi', 'quicksaksidata.saksi_id', 'quicksaksi.id')
                ->whereNull('quicksaksi.pending')
                ->where('quicksaksi.verification', 1);
        }])->get();
        $data['total_incoming_vote']      = QuickSaksiData::sum('voice');
        $data['kota'] = Regency::where('id', $config['regencies_id'])->first();
        $data['tracking'] = ModelsTracking::get();
        $data['jumlah_tps_masuk'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->count();
        $data['jumlah_tps_terverifikai'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('saksi.verification', 1)->count();
        $data['total_tps']   =  Tps::where('setup','belum terisi')->count();
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('saksi.verification', 1)
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->where('saksi.audit', "")
            ->paginate(18);

        $data['list_suara_audit']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('saksi.verification', 1)
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->where('saksi.audit', 1)
            ->paginate(18);

        $data['list_suara_batal']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
           ->where('saksi.batalkan', 1)
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->paginate(18);

        $data['village'] = Village::where('id', $data['list_suara'][0]->village_id)->first();
        return view('administrator.c1.audit-c1', $data);
    }
}
