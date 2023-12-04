<?php

namespace App\Http\Livewire;

use App\Models\Config;
use App\Models\Configs;
use App\Models\RegenciesDomain;
use App\Models\Relawan;
use Livewire\Component;
use Livewire\WithPagination;

class C1HunterComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
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
        $data['relawan'] = Relawan::join('users', 'users.id', '=', 'c1_relawan.relawan_id')
            ->join('districts', 'districts.id', '=', 'c1_relawan.district_id')
            ->where("users.regency_id",  $this->config->regencies_id)
            ->where('c1_relawan.status', 0)
            ->select('users.*', 'c1_relawan.*', 'districts.name as district_name')
            ->paginate(18);
        return view('livewire.c1-hunter-component', $data);
    }
}
