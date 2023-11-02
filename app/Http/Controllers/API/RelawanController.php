<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\Configs;
use App\Models\RegenciesDomain;
use App\Models\Relawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RelawanController extends Controller
{
    public $config;
    public $configs;
    public function __construct()
    {

        $currentDomain = request()->getHttpHost();
        $url = substr($currentDomain, 0, strpos($currentDomain, ':8000'));
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
    public function uploadC1Relawan(Request $request)
    {
          $validator = Validator::make($request->all(), [
            'c1_images' => 'required|mimes:png,jpg|max:2048',
        ]);

        $config = Config::first();
        $user  = Auth::user();

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        if ($files = $request->file('c1_images')) {
            $file =  $request->file->store('public/storage/c1_plano');
        }
        $upload_relawan = new Relawan;
        $upload_relawan->c1_images = $file;
        $upload_relawan->regency_id = $this->config->regencies_id;
        $upload_relawan->district_id = $user->districts;
        $upload_relawan->village_id = $user->villages;
        $upload_relawan->tps_id = $user->tps_id;
        $upload_relawan->status = 0;
        $upload_relawan->relawan_id = $user->id;
        $upload_relawan->save();
    }
    
}
