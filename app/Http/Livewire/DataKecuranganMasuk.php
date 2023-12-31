<?php

namespace App\Http\Livewire;

use App\Models\Config;
use App\Models\Configs;
use App\Models\RegenciesDomain;
use App\Models\Tps;
use Livewire\Component;
use Livewire\WithPagination;

class DataKecuranganMasuk extends Component
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
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('saksi.kecurangan', 'yes')
            ->where('saksi.status_kecurangan', 'terverifikasi validator')
            ->orWhere('saksi.status_kecurangan', 'diproses')
            ->where("users.regency_id",  $this->config->regencies_id)
            ->where('name', 'like', '%'.$this->search.'%')
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->paginate(18);

        $data['jumlah_data_kecurangan_masuk']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('saksi.kecurangan', 'yes')
            ->where('saksi.status_kecurangan', 'terverifikasi validator')
            ->where("users.regency_id",  $this->config->regencies_id)
            ->orWhere('saksi.status_kecurangan', 'diproses')
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->count();

        return view('livewire.data-kecurangan-masuk', $data);
    }
}
