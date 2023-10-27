<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Regency;
use App\Models\Tps;
use App\Models\Village;
use Illuminate\Http\Request;
use App\Models\Paslon;
use App\Models\Config;
use App\Models\User;

class PublicController extends Controller
{
    public function getRegencies()
    {
        $reg = Regency::select('id','province_id','name')->get();
        if(count($reg) == null) return response()->json(['message'=>"Data NULL"],204);
        return response()->json($reg,200);
    }
    public function getRegenciesByProvinceId(Request $req)
    {
        $reg = Regency::where('province_id',$req->id_prov)->select('id','province_id','name')->get();
        if(count($reg) == null) return response()->json(['message'=>"Data NULL"],204);
        return response()->json($reg,200);
    }
    public function getDistrictByRegencyId(Request $request)
    {
        $district = District::where('regency_id',$request->id)->select('id','regency_id','name')->get();
        if(count($district) == null) return response()->json(['message'=>"Data NULL"],204);
        return response()->json($district,200);
    }
    public function getVillageByDistrictId(Request $request)
    {
        $village = Village::where('district_id',$request->id)->select('id','district_id','name')->get();
           if(count($village) == null) return response()->json(['message'=>"Data NULL"],204);
        return response()->json($village,200);
    }
    public function getTpsByVilage(Request $request)
    {
       $village = Tps::where('villages_id',$request->id)->select('id','villages_id','number')->get();
       if(isset($request['relawan'])){
           $village = Tps::leftJoin('saksi', 'tps.id', '=', 'saksi.tps_id')
           ->whereNull('saksi.tps_id')
           ->select('tps.*')
           ->get();
       }
           if(count($village) == null) return response()->json(['message'=>"Data NULL"],204);
        return response()->json($village,200);
    }   
   public function getSuara(Request $request)
    {
        $config = Config::first();
        
        if($request->jenis != "terverifikasi"){
         $paslon = Paslon::with(['saksi_data' => function($query) {
                $query->select(['paslon_id','voice']);
                }])->get();
            $i = 0;
            foreach ($paslon as $pas) {
               
                $data[$i] = [
                    'candidate'=> $pas->candidate,
                    'deputy_candidate'=> $pas->deputy_candidate,
                    'color'=> $pas->color,
                    'voice'=>$pas->saksi_data->sum('voice'),
                ];
                $i++;
            }
        }else{
            $data = [];
            $paslonterverifikasi = Paslon::with(['saksi_data' => function ($query) {
                $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id')
                    ->whereNull('saksi.pending')
                    ->where('saksi.verification', 1);
            }])->get();
            
            foreach ($paslonterverifikasi as $pas) {
                $data[] = [
                    'candidate'=> $pas->candidate,
                    'deputy_candidate'=> $pas->deputy_candidate,
                    'color'=> $pas->color,
                    'voice'=>$pas->saksi_data->sum('voice'),
                ];
            }
        }
        return response()->json($data,200);
    }

    public function getFraud(Request $request)
    {
       $count_kecurangan  =\App\Models\Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
        ->where('saksi.kecurangan', 'yes')
        ->where('saksi.status_kecurangan', 'belum terverifikasi')
        ->select('tps.id','saksi.kecurangan','saksi.status_kecurangan')
        ->count();   
        return response()->json([
            'fraud_total' => $count_kecurangan
        ],200);
    }

    public function getTPS(Request $request)
    {
      $count_tps = TPS::count();

         return response()->json(compact('count_tps'), 200);
    }

    public function getTPSMasuk(Request $request)
    {
        $count_tps_masuk = TPS::where('setup','terisi')->count();

        return response()->json([
            'count_tps_masuk' => $count_tps_masuk
        ], 200);
    }

    public function getTPSKosong(Request $request)
    {
        $data['tps_masuk'] = Tps::where('setup','terisi')->count();
        $data['total_tps']   =  Tps::where('setup','belum terisi')->count();;
        $count_tps_kosong = $data['total_tps'] - $data['tps_masuk'];

        return response()->json([
            'count_tps_kosong' => $count_tps_kosong
        ], 200);
    }
    function tpsByVillage(Request $request){
    
        $tps = Tps::where('villages_id',$request->village_id)->get();
        
        foreach ($tps as $key => $item) {
            $user = User::where('tps_id',$item['id'])->first();
            if ($user !=null) {
                // Menghapus elemen dari $data jika villages_id adalah '3674010001'
                
                unset($tps[$key]);
            }
        }
     


        if (count($tps) > 0) {
            return response()->json($tps,200);
        }
        return response()->json(['messages'=>"data kosong"],404);
    }
}
