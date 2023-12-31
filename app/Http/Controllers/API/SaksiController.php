<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\Configs;
use App\Models\Paslon;
use App\Models\RegenciesDomain;
use App\Models\Relawan;
use App\Models\Saksi;
use App\Models\SaksiData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SaksiController extends Controller
{
    public $config;
    public $configs;
    public function __construct()
    {

        $currentDomain = request()->getHttpHost();
        if (isset(parse_url($currentDomain)['port'])) {
            $url = substr($currentDomain, 0, strpos($currentDomain, ':8000'));
        }else{
            $url = $currentDomain;
        }
        $regency_id = RegenciesDomain::where('domain',"LIKE","%".$url."%")->first();

        $this->configs = Config::first();
        $this->config = new Configs;
        $this->config->regencies_id =  (string) $regency_id->regency_id;
        $this->config->provinces_id =  $this->configs->provinces_id;
        $this->config->setup =  $this->configs->setup;
        $this->config->updated_at =  $this->configs->updated_at;
        $this->config->created_at =  $this->configs->created_at;
        $this->config->partai_logo =  $this->configs->partai_logo;
        $this->config->date_overlimit =  $this->configs->date_overlimit;
        $this->config->show_public =  $this->configs->show_public;
        $this->config->show_terverifikasi =  $this->configs->show_terverifikasi;
        $this->config->lockdown =  $this->configs->lockdown;
        $this->config->multi_admin =  $this->configs->multi_admin;
        $this->config->otonom =  $this->configs->otonom;
        $this->config->dark_mode =  $this->configs->dark_mode;
        $this->config->jumlah_multi_admin =  $this->configs->jumlah_multi_admin;
        $this->config->jenis_pemilu =  $this->configs->jenis_pemilu;
        $this->config->tahun =  $this->configs->tahun;
        $this->config->quick_count =  $this->configs->quick_count;
        $this->config->default =  $this->configs->default;
    }
    public function uploadC1Plano(Request $request)
    {
        $user = auth()->user();
        $config = Config::first();
        $validator = Validator::make($request->all(), [
            'c1_images' => 'required|mimes:png,jpg|max:2048',
            'voice.*' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        if ($files = $request->file('c1_images')) {
            $file =  $request->file->store('public/storage/c1_plano');
        }

        $cek_kecurangan = Saksi::where('kecurangan', 'yes')->where('tps_id', $user->tps_id)->whereNull('pending')->first();
        $cek_relawan = Relawan::where('tps_id', $user->tps_id)->where('status', 2)->first();
        if ($cek_relawan != null) {
            if ($cek_kecurangan != null) {
                Saksi::where('tps_id', $user->tps_id)->where('kecurangan', 'yes')->whereNull('pending')->update([
                    'c1_images'  => $file,
                    'verification' => "",
                    'audit' => "",
                    'district_id' => $user->districts,
                    'village_id' => $user->villages,
                    'regency_id' => $this->config->regencies_id,
                    'overlimit' => 0
                ]);

                $saksi = Saksi::where('tps_id', $user->tps_id)->whereNull('pending')->first();

                if ($config->date_overlimit > date('Y-m-d')) {
                    Saksi::where('tps_id', $user->tps_id)->whereNull('pending')->update([
                        'overlimit' => 1
                    ]);
                }
                $paslon = Paslon::get();
                for ($i = 0; $i < count($paslon); $i++) {
                    SaksiData::create([
                        'user_id' => $user->id,
                        'paslon_id' => $paslon[$i]->id,
                        'voice' => $request->voice[$i],
                        'saksi_id' => $saksi->id
                    ]);
                }
            } else {
                $this->insertPendingSaksiData($request, $user, $file, $config);
            }
        } else {
            if ($cek_kecurangan != null) {
                $this->updateSaksiData($request, $user, $file, $config);
            } else {
                $this->insertSaksidata($request, $user, $file, $config);
            }
        }
        return response()->json(['messages' => "Berhasil mengupload c1 plano."], 200);
    }
    private function insertSaksidata($request, $user, $file, $config)
    {
        $insert =   Saksi::create([
            'c1_images'  => $file,
            'verification' => "",
            'audit' => "",
            'district_id' => $user->districts,
            'village_id' => $user->villages,
            'regency_id' => $this->config->regencies_id,
            'overlimit' => 0,
            'tps_id' => $user->tps_id
        ]);
        if ($config->date_overlimit > date('Y-m-d')) {
            Saksi::where('id', $insert->id)->update([
                'overlimit' => 1
            ]);
        }
        $paslon = Paslon::get();
        for ($i = 0; $i < count($paslon); $i++) {
            SaksiData::create([
                'user_id' => $user->id,
                'paslon_id' => $paslon[$i]->id,
                'voice' => $request->voice[$i],
                'saksi_id' => $insert->id
            ]);
        }
    }
    private function updateSaksiData($request, $user, $file, $config)
    {
        Saksi::where('tps_id', $user->tps_id)->whereNull('pending')->update([
            'c1_images'  => $file,
            'verification' => "",
            'audit' => "",
            'district_id' => $user->districts,
            'village_id' => $user->villages,
            'regency_id' => $this->config->regencies_id,
            'overlimit' => 0
        ]);
        $saksi = Saksi::where('tps_id', $user->tps_id)->whereNull('pending')->first();
        if ($config->date_overlimit > date('Y-m-d')) {
            Saksi::where('tps_id', $user->tps_id)->whereNull('pending')->update([
                'overlimit' => 1
            ]);
        }
        $paslon = Paslon::get();
        for ($i = 0; $i < count($paslon); $i++) {
            SaksiData::create([
                'user_id' => $user->id,
                'paslon_id' => $paslon[$i]->id,
                'voice' => $request->voice[$i],
                'saksi_id' => $saksi->id
            ]);
        }
    }
    private function insertPendingSaksiData($request, $user, $file, $config)
    {
        $insert =   Saksi::create([
            'c1_images'  => $file,
            'verification' => "",
            'audit' => "",
            'district_id' => $user->districts,
            'village_id' => $user->villages,
            'regency_id' => $this->config->regencies_id,
            'overlimit' => 0,
            'tps_id' => $user->tps_id,
            'pending' => 1
        ]);
        if ($config->date_overlimit > date('Y-m-d')) {
            Saksi::where('id', $insert->id)->update([
                'overlimit' => 1
            ]);
        }
        $paslon = Paslon::get();
        for ($i = 0; $i < count($paslon); $i++) {
            SaksiData::create([
                'user_id' => $user->id,
                'paslon_id' => $paslon[$i]->id,
                'voice' => $request->voice[$i],
                'saksi_id' => $insert->id
            ]);
        }
    }


    public function uploadKecurangan(Request $request)
    {
          $validator = Validator::make($request->all(), [
            'foto_kecurangan' => 'required|mimes:png,jpg|max:2048',
            "video_kecurangan" => 'required_without:foto_kecurangan'
                
        ]);
        if($request->fie('foto_kecurangan')){
            $foto_kecurangan = $request->file->store('public/storage/hukum/bukti_foto');
        }
        if($request->fie('video_kecurangan')){
            $video_kecurangan = $request->file->store('public/storage/hukum/bukti_foto');
        }
    }
}
