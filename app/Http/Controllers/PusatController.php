<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Paslon;
use App\Models\Province;
use App\Models\Saksi;
use App\Models\SaksiData;
use App\Models\Tps;
use App\Models\Tracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PusatController extends Controller
{
    function home() {
        date_default_timezone_set("Asia/Jakarta");
        $data['jam'] = date("H");
        $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->get();
        $paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id,SUM(voice) as total FROM saksi_data GROUP by paslon_id ORDER by total DESC'));

        $data['paslon_tertinggi'] = Paslon::where('id', $paslon_tertinggi['0']->paslon_id)->first();
        $data['urutan'] = $paslon_tertinggi;
        // dd($data['urutan']);


        $data['paslon']                   = Paslon::with('saksi_data')->get();
        $data['paslon_terverifikasi']     = Paslon::with(['saksi_data' => function ($query) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id')
                ->whereNull('saksi.pending')
                ->where('saksi.verification', 1);
        }])->get();
        $verification                     = Saksi::where('verification', 1)->with('saksi_data')->get();
        $dpt                              = District::sum("dpt");
        $data['dpt'] = $dpt;

        $incoming_vote                    = SaksiData::select('voice')->get();
        $voice = SaksiData::sum('voice');
        $data['total_verification_voice'] = 0;
        $data['total_incoming_vote']      = SaksiData::sum('voice');
        $data['realcount']                = $data['total_incoming_vote'] / $dpt * 100;
        foreach ($verification as $key) {
            foreach ($key->saksi_data as $verif) {
                $data['total_verification_voice'] += $verif->voice;
            }
        }
        $data['saksi_masuk'] = Saksi::count();

        $data['tps_masuk'] = Tps::where('setup', 'terisi')->count();
        $data['total_tps']   =  Tps::where('setup', 'belum terisi')->count();
        $data['tps_kosong']  =  $data['total_tps'] - $data['tps_masuk'];


        $data['saksi_terverifikasi'] = Saksi::where('verification', 1)->count();
        foreach ($incoming_vote as $key) {
            $data['total_incoming_vote'] += $key->voice;
        }
        $data['suara_masuk'] = SaksiData::count('voice');
        $data['tracking'] = Tracking::get();
        $data['provinsi'] = Province::get();
        return view('pusat.index', $data);
        // return "hai";
    }
    
   

}
