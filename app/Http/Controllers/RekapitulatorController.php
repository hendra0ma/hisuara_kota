<?php

namespace App\Http\Controllers;

use App\Models\District;

use App\Models\Regency;
use App\Models\Paslon;
use App\Models\Rekapitulator;
use App\Models\User;
use App\Models\Village;
use App\Models\Config;
use App\Models\Rekapitulator as ModelsRekapitulator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class RekapitulatorController extends Controller
{
    public function index()
    {
        $data['config'] = Config::first();

        $rekapitulator = ModelsRekapitulator::where('district_id', Auth::user()->districts)->get();
        if (count($rekapitulator) == 0) {
            $district = Village::where('district_id', Auth::user()->districts)->get();
            $paslon   = Paslon::get();
            foreach ($paslon as $psl) {
                foreach ($district as $ds) {
                    $rekapitulator_form =  ModelsRekapitulator::create([
                        'village_id' => $ds['id'],
                        'district_id' => Auth::user()->districts,
                        'paslon_id' => $psl['id'],
                    ]);
                }
            }
        }
   
        $data['kecamatan'] = Village::where('district_id', Auth::user()->districts)->get();
        $data['kec'] = Village::where('district_id', Auth::user()->districts)->first();
        // $data['rekapitulator'] = Village::join('rekapitulator', 'villages.id', '=', 'rekapitulator.village_id')
        // ->join('paslon','paslon.id','=','rekapitulator.paslon_id')
        // ->get();
        $data['suara'] = Paslon::get();
        $data['id'] = Auth::user()->districts;
        return view('administrator.rekapitulasi.rekapitulator', $data);
    }
    function print_kecamatan(){
        $data['config'] = Config::first();
        $data['kecamatan'] = Village::where('district_id', Auth::user()->districts)->get();
        $data['kec'] = Village::where('district_id', Auth::user()->districts)->first();
        $data['data_kec'] = District::where('id',Auth::user()->districts)->first();
         $data['data_kota'] = Regency::where('id',  $data['data_kec']->regency_id)->first();
     
        // $data['rekapitulator'] = Village::join('rekapitulator', 'villages.id', '=', 'rekapitulator.village_id')
        // ->join('paslon','paslon.id','=','rekapitulator.paslon_id')
        // ->get();
        $data['suara'] = Paslon::get();
        $data['id'] = Auth::user()->districts;
         return view('administrator.rekapitulasi.print_kecamatan', $data);
    }
    

    public function action_rekapitulator(Request $request, $id)
    {
        $rekapitulator = Rekapitulator::where('village_id', Crypt::decrypt($id))->get();
        foreach ($rekapitulator as $key) {
            Rekapitulator::where('id', $key['id'])->update([
                'value' => $request[$key['id']],
            ]);
        }

        return redirect('rekapitulator/index');
    }
}
