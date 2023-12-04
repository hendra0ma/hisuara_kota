<?php

namespace App\Http\Livewire;

use App\Models\Config;
use App\Models\Configs;
use App\Models\District;
use App\Models\RegenciesDomain;
use App\Models\Tps;
use App\Models\Village;
use Livewire\Component;
use Livewire\WithPagination;

class C1Koreksi extends Component
{
    public $id_kel;
    // public $district;
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
        $regency_id = RegenciesDomain::where('domain', 'LIKE', '%' . $url . '%')->first();

        $this->configs = Config::first();
        $this->config = new Configs();
        $this->config->regencies_id = (string) $regency_id->regency_id;      
    }
    public function render()
    {
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            // ->where('tps.villages_id',(string)$this->id_kel)
            ->where('saksi.verification', '')
            ->whereNull('saksi.pending')
            // ->where('saksi.batalkan', '=', 0)
            // ->whereNull('saksi.koreksi')
            ->where("users.regency_id",  $this->config->regencies_id)
            ->where('saksi.koreksi', '=', 1)
            ->where('saksi.overlimit', 0)
            ->where('name', 'like', '%'.$this->search.'%')
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->paginate(18);
            
        $data['jumlah_c1_koreksi']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            // ->where('tps.villages_id',(string)$this->id_kel)
            ->where('saksi.verification', '')
            ->whereNull('saksi.pending')
            // ->where('saksi.batalkan', '=', 0)
            // ->whereNull('saksi.koreksi')
            ->where("users.regency_id",  $this->config->regencies_id)
            ->where('saksi.koreksi', '=', 1)
            ->where('saksi.overlimit', 0)
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->count();
        // $data = Saksi::whereNull('koreksi')
        //     ->where('batalkan', '=', 0)->get();

        // $data['district'] = District::find($data['list_suara'][0]->district_id);
        if (count($data['list_suara']) > 0) {
            $data['village'] = Village::where ('id', $data['list_suara'][0]->village_id)->first();
            $data['district'] = District::where ('id', $data['list_suara'][0]->district_id)->first();
        }
        
        return view('livewire.c1-koreksi', $data);
    }
}
