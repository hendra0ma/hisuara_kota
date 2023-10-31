<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Paslon;
use App\Models\Province;
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
    function home($id) {

        // return Auth::user();

        date_default_timezone_set("Asia/Jakarta");
        $data['jam'] = date("H");

        $id = Crypt::decrypt($id);
        $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->get();
        $paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id,SUM(voice) as total FROM saksi_data WHERE saksi_data.province_id = '.$id.' GROUP by paslon_id ORDER by total DESC'));

        $data['paslon_tertinggi'] = Paslon::where('id', $paslon_tertinggi['0']->paslon_id)->first();
        $data['urutan'] = $paslon_tertinggi;
        // dd($data['urutan']);


        $data['paslon']                   = Paslon::with(['saksi_data'=>function ($query) use($id) {
           
           $query->where('saksi_data.province_id',$id);
        }])->get();
        $data['paslon_terverifikasi']     = Paslon::with(['saksi_data' => function ($query)use($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id')
                ->whereNull('saksi.pending')
                ->where('saksi_data.province_id',$id)
                ->where('saksi.verification', 1);
        }])->get();
        $verification                     = Saksi::where('province_id',$id)->where('verification', 1)->with('saksi_data')->get();
        $dpt                              = District::where('province_id',$id)->sum("dpt");
        $data['dpt'] = $dpt;

        $incoming_vote                    = SaksiData::where('province_id',$id)->select('voice')->get();
        $voice = SaksiData::sum('voice');
        $data['total_verification_voice'] = 0;
        $data['total_incoming_vote']      = SaksiData::where('province_id',$id)->sum('voice');
        $data['realcount']                = $data['total_incoming_vote'] / $dpt * 100;
        foreach ($verification as $key) {
            foreach ($key->saksi_data as $verif) {
                $data['total_verification_voice'] += $verif->voice;
            }
        }
        $data['saksi_masuk'] = Saksi::where('province_id',$id)->count();
        $data['tps_masuk'] = Tps::where('province_id',$id)->where('setup', 'terisi')->count();
        $data['total_tps']   =  Tps::where('setup', 'belum terisi')->count();
        $data['tps_kosong']  =  $data['total_tps'] - $data['tps_masuk'];


        $data['saksi_terverifikasi'] = Saksi::where('province_id',$id)->where('verification', 1)->count();
        foreach ($incoming_vote as $key) {
            $data['total_incoming_vote'] += $key->voice;
        }
        $data['suara_masuk'] = SaksiData::count('voice');
        $data['tracking'] = Tracking::get();
        $data['provinsi'] = Province::get();
        $data['kota'] = Regency::where('province_id',$id)->get();

        return view('provinsi.index', $data);
        // return "hai";
    }
}
