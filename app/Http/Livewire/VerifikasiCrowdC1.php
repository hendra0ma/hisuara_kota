<?php

namespace App\Http\Livewire;

use App\Models\Config;
use App\Models\Configs;
use App\Models\RegenciesDomain;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class VerifikasiCrowdC1 extends Component
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
        $data['saksi_data'] = User::where('role_id', '=', 8)->where('is_active', '=', 0) ->where("users.regency_id",  $this->config->regencies_id)->where('name', 'like', '%' . $this->search . '%')->paginate(16);
        return view('livewire.verifikasi-crowd-c1', $data);
    }
}
