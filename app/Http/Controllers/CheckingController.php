<?php

namespace App\Http\Controllers;

use App\Models\Paslon;
use App\Models\Saksi;
use App\Models\Tps;
use App\Models\User;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class CheckingController extends Controller
{
    public function index()
    {
        $data['team'] = User::where('id', '!=', Auth::user()->id)->where('role_id', Auth::user()->role_id)->get();
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('saksi.overlimit', 1)
            ->whereNull('saksi.pending')
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->get();
        return view('checking.index', $data);
    }
    public function getSaksiData(Request $req)
    {
        $data['paslon'] = Paslon::with(['saksi_data' => function ($query) use ($req) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id')
                ->join('tps', 'tps.id', 'saksi.tps_id')
                ->whereNull('saksi.pending')
                ->where('tps.id', '=', $req->id);
        }])->get();

        $data['village'] = Village::where('id', $data['paslon'][0]->saksi_data[0]->village_id)->first();
        return view('checking.modalView', $data);
    }
    public function verifikasi($id)
    {
        $id = Crypt::decrypt($id);
        $data = [
            'overlimit' => "",
        ];
        Saksi::where('id', $id)->update($data);
        return redirect()->back()->with(['success' => "berhasil memverifikasi data tps."]);
    }
    public function tolakOverlimit($id)
    {
        $id = Crypt::decrypt($id);
        $data = [
            'overlimit' => 2,
        ];
        Saksi::where('id', $id)->update($data);
        return redirect()->back()->with(['success' => "berhasil menolak data tps."]);
    }
}
