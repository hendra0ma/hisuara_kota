<?php

namespace App\Http\Livewire;

use App\Models\Config;
use App\Models\Configs;
use App\Models\Paslon;
use App\Models\RegenciesDomain;
use App\Models\Saksi;
use App\Models\User;
use App\Models\Village;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Clainnya extends Component
{
    private $config;
    private $configs;
      public function __construct()
    {
        $currentDomain = request()->getHttpHost();
        if (isset(parse_url($currentDomain)['port'])) {
            $url = substr($currentDomain, 0, strpos($currentDomain, ':8000'));
        } else {
            $url = $currentDomain;
        }
        $regency_id = RegenciesDomain::where('domain', 'LIKE', '%' . $url . '%')->first();

        $this->configs = Config::first();
        $this->config = new Configs();
        $this->config->regencies_id = (string) $regency_id->regency_id;      
    }
    public function render()
    {
        $villagee = Auth::user()->villages;
        $data['dev'] = User::join('tps', 'tps.id', '=', 'users.tps_id')->where("tps.regency_id",  $this->config->regencies_id)->first();
        $data['kelurahan'] = Village::where('id', $villagee)->first();
        $data['paslon'] = Paslon::get();

        $cekSaksi = Saksi::where('tps_id', Auth::user()->tps_id)->where("tps.regency_id",  $this->config->regencies_id)->count('id');
        return view('livewire.clainnya',$data);
    }
}
