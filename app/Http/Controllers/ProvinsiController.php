<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Paslon;
use App\Models\Province;
use App\Models\QuickSaksiData;
use App\Models\Regency;
use App\Models\Saksi;
use App\Models\SaksiData;
use App\Models\Tps;
use App\Models\Tracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class ProvinsiController extends Controller
{
    function home($id)
    {

        date_default_timezone_set("Asia/Jakarta");
        $id = decrypt($id);
        $data['jam'] = date("H");
        $data['paslon']                   = Paslon::get();
    
        $dpt         = Regency::where('province_id',$id)->sum("dpt");
        

        $data['dpt'] = $dpt;
        $data['regency'] =Regency::sum("dpt");

    
        $data['total_incoming_vote']      = Regency::where('province_id',$id)->sum('suara1') + Regency::where('province_id',$id)->sum('suara2') + Regency::where('province_id',$id)->sum('suara3') ;
        $data['realcount']                = $data['total_incoming_vote'] / $dpt * 100;
     
        $data['provinsi'] = Province::get();
        
        $data['provinsi_ini'] = Province::where('id',$id)->first();
        $data['regencies'] = Regency::where('province_id',$id)->get();

        return view('provinsi.index', $data);
        // return "hai";
    }
    //halaman public provinsi
    public function pusatProvinsi($id)
    {

        $id = Crypt::decrypt($id);

        $dpt = Province::where('id', $id)->sum("dpt");
        // $data['kota'] = Regency::find($this->config->regencies_id);
        // $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->get();
        $data['paslon'] = Paslon::with('saksi_data')->get();
        $data['paslon_terverifikasi']     = Paslon::with(['saksi_data' => function ($query) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id')->where('saksi.verification', 1);
        }])->get();
        $data['paslon_quick']     = Paslon::with(['saksi_data' => function ($query) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id')
                ->join('tps', 'tps.id', 'saksi.tps_id')
                ->where('tps.sample', '1');
        }])->get();


        $data['provinsi'] = Regency::where('province_id', $id)->get();
        $data['paslon_quick'] = Paslon::with('quicksaksidata')->get();
        $data['paslon_terverifikasi_quick']     = Paslon::with(['quicksaksidata' => function ($query) {
            $query->join('quicksaksi', 'quicksaksidata.saksi_id', 'quicksaksi.id')
                ->whereNull('quicksaksi.pending')
                ->where('quicksaksi.verification', 1);
        }])->get();
        $data['total_incoming_vote_quick']      = QuickSaksiData::sum('voice');
        $data['realcount']  = $data['total_incoming_vote_quick'] / $dpt * 100;
        $data['tps_selesai'] = Tps::where('setup', 'terisi')->count();
        $data['tps_belum'] = Tps::count();
        $data['tps_selesai_quick'] = Tps::where('setup', 'terisi')->where('sample', 1)->count();
        $data['tps_belum_quick'] = Tps::where('sample', 1)->count();
        $data['paslon_candidate'] = Paslon::get();
        $data['title'] = "";
        $data['id_prov'] = $id;
        // $data['villages_quick'] = Tps::join('villages','villages.id','=','tps.villages_id')->where('sample',1)->get();
        // $data['district_quick'] = District::join('villages', 'villages.district_id', '=', 'districts.id')->where('regency_id', $this->config->regencies_id)->get();
        return view('publik.provinsi', $data);
    }
}
