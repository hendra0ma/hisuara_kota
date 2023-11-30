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
use Illuminate\Support\Facades\DB;

class PusatController extends Controller
{
    function home() {
        date_default_timezone_set("Asia/Jakarta");
        $data['jam'] = date("H");
        $data['paslon']                   = Paslon::get();
    
        $dpt         = Regency::sum("dpt");

        $data['dpt'] = $dpt;
        $data['regency'] =Regency::sum("dpt");

        $data['total_incoming_vote']      = Regency::sum('suara1') + Regency::sum('suara2') + Regency::sum('suara3') ;
        $data['realcount']                = $data['total_incoming_vote'] / $dpt * 100;
        $data['provinsi'] = Province::get();

        
        return view('pusat.index', $data);
        // return "hai";
    }

    public function quick_count_nasional()
    {
        $data['paslon']                   = Paslon::get();

        $dpt         = Regency::sum("dpt");

        $data['dpt'] = $dpt;
        $data['regency'] = Regency::sum("dpt");

        $data['total_incoming_vote']      = Regency::sum('suaraq1') + Regency::sum('suaraq2') + Regency::sum('suaraq3');
        $data['realcount']                = $data['total_incoming_vote'] / $dpt * 100;
        $data['provinsi'] = Province::get();


        return view('quick_count_nasional.index', $data);
        // return "hai";
        // dd($data['paslon']);
    }
}
