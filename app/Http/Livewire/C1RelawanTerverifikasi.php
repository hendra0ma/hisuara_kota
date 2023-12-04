<?php

namespace App\Http\Livewire;

use App\Models\Config;
use App\Models\Configs;
use App\Models\RegenciesDomain;
use App\Models\Relawan;
use App\Models\Tps;
use Livewire\Component;
use Livewire\WithPagination;

class C1RelawanTerverifikasi extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $village_id;
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
        $regency_id = RegenciesDomain::where('domain', $url)->first();

        $this->configs = Config::first();
        $this->config = new Configs();
        $this->config->regencies_id = (string) $regency_id->regency_id;      
    }
    public function render()
    {
        $data['list_suara']  = Tps::join('c1_relawan', 'c1_relawan.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('c1_relawan.village_id', $this->village_id)
            ->where('c1_relawan.status', 1)
            ->where("users.regency_id",  $this->config->regencies_id)
            ->select('c1_relawan.*', 'c1_relawan.created_at as date', 'tps.*', 'users.*')
            ->paginate(18);
        // dump($data);
        return view('livewire.c1-relawan-terverifikasi', $data);
    }
}
