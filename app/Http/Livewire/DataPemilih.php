<?php

namespace App\Http\Livewire;

use App\Models\Config;
use App\Models\Configs;
use App\Models\RegenciesDomain;
use App\Models\SuratSuara;
use Livewire\Component;
use Livewire\WithPagination;

class DataPemilih extends Component
{
    use WithPagination;

    
    private $config;
    private $configs;
    
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];

    public function __construct()
    {

        $currentDomain = request()->getHttpHost();
        $url = substr($currentDomain, 0, strpos($currentDomain, ':8000'));
        $regency_id = RegenciesDomain::where('domain',"LIKE","%".$url."%")->first();

        $this->configs = Config::first();
        $this->config = new Configs;
        $this->config->regencies_id =  (string) $regency_id->regency_id;
        $this->config->provinces_id =  $this->configs->provinces_id;
        $this->config->setup =  $this->configs->setup;
        $this->config->updated_at =  $this->configs->updated_at;
        $this->config->created_at =  $this->configs->created_at;
        $this->config->partai_logo =  $this->configs->partai_logo;
        $this->config->date_overlimit =  $this->configs->date_overlimit;
        $this->config->show_public =  $this->configs->show_public;
        $this->config->show_terverifikasi =  $this->configs->show_terverifikasi;
        $this->config->lockdown =  $this->configs->lockdown;
        $this->config->multi_admin =  $this->configs->multi_admin;
        $this->config->otonom =  $this->configs->otonom;
        $this->config->dark_mode =  $this->configs->dark_mode;
        $this->config->jumlah_multi_admin =  $this->configs->jumlah_multi_admin;
        $this->config->jenis_pemilu =  $this->configs->jenis_pemilu;
        $this->config->tahun =  $this->configs->tahun;
        $this->config->quick_count =  $this->configs->quick_count;
        $this->config->default =  $this->configs->default;
    }


    public function render()
    {
        $data['surat_suaras'] = SuratSuara::join('users','surat_suara.user_id','=','users.id')
        ->where('users.regency_id',$this->config->regencies_id)
        ->select('surat_suara.*','users.*','surat_suara.id as surat_id','users.id as user_id')
        ->get();
        return view('livewire.data-pemilih',$data);
    }
}
