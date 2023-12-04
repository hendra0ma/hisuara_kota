<?php

namespace App\Http\Livewire;

use App\Models\Config;
use App\Models\Configs;
use App\Models\RegenciesDomain;
use App\Models\Tps;
use Livewire\Component;
use Livewire\WithPagination;

class C1SaksiPending extends Component
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
        $regency_id = RegenciesDomain::where('domain', 'LIKE', '%' . $url . '%')->first();

        $this->configs = Config::first();
        $this->config = new Configs();
        $this->config->regencies_id = (string) $regency_id->regency_id;      
    }
    public function render()
    {
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('tps.villages_id', $this->village_id)
            ->where('saksi.verification', '')
            ->whereNotNull('saksi.pending')
            ->where('saksi.overlimit', 0)
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->paginate(18);
        return view('livewire.c1-saksi-pending', $data);
    }
}
