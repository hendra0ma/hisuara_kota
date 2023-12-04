<?php

namespace App\Http\Livewire;

use App\Models\Config;
use App\Models\Configs;
use App\Models\RegenciesDomain;
use App\Models\Relawan;
use Livewire\Component;
use Livewire\WithPagination;

class AllC1Relawan extends Component
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
        $data['all_c1'] = Relawan::where("c1_relawan.regency_id",  $this->config->regencies_id)->paginate(10);
        return view('livewire.all-c1-relawan',$data);
    }
}
