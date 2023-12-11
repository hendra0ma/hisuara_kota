<?php

namespace App\Http\Livewire;

use App\Models\Config;
use App\Models\Configs;
use App\Models\CrowdC1;
use App\Models\RegenciesDomain;
use App\Models\Relawan;
use App\Models\Tps;
use Livewire\Component;
use Livewire\WithPagination;

class C1CrowdVoice extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];
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
       
            $data['list_suara']  = CrowdC1::join('users','crowd_c1.user_id','=','users.id')
            ->join('tps','crowd_c1.tps_id','=','tps.id')
            ->where('crowd_c1.regency_id',$this->config->regencies_id)
            ->where('crowd_c1.status',"0")

            ->where('tps.number', 'like', '%'.$this->search.'%')
            ->select('users.*','tps.*','crowd_c1.*','crowd_c1.id as crowd_id')
            
            ->paginate(25);
            
        return view('livewire.c1-crowd-voice', $data);
    }
}
