<?php

namespace App\Http\Livewire;

use App\Models\Config;
use App\Models\Configs;
use App\Models\CrowdC1;
use App\Models\RegenciesDomain;
use App\Models\Saksi;
use Livewire\Component;
use Livewire\WithPagination;

class CrowdC1Kpu extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];
    // public $id_wilayah;
    // public $tipe_wilayah;
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
        $data['all_c1'] = CrowdC1::where('crowd_c1.status',"0")
        ->whereNull('crowd_c1.tps_id')
        ->where("crowd_c1.regency_id",  $this->config->regencies_id)
        ->paginate(12);
        return view('livewire.crowd-c1-kpu', $data);
    }
}
