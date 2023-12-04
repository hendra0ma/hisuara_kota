<?php

namespace App\Http\Livewire;

use App\Models\Config;
use App\Models\Configs;
use App\Models\Kecurangan;
use App\Models\RegenciesDomain;
use Livewire\Component;
use Livewire\WithPagination;

class FraudDataPrint extends Component
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
        $regency_id = RegenciesDomain::where('domain', 'LIKE', '%' . $url . '%')->first();

        $this->configs = Config::first();
        $this->config = new Configs();
        $this->config->regencies_id = (string) $regency_id->regency_id;      
    }
    public function render()
    {
        $data['list_suara']  = Kecurangan::join('users', 'users.id', '=', 'kecurangan.user_id')
        ->join('qrcode_hukum', 'qrcode_hukum.kecurangan_id', '=', 'kecurangan.id')
        ->where('kecurangan.status_kecurangan', 'terverifikasi')
        ->whereNull('qrcode_hukum.print')
        ->where('users.regency_id', $this->config->regencies_id)
        ->where('users.name', 'like', '%'.$this->search.'%')
        ->select('kecurangan.created_at as date', 'users.*','kecurangan.*','kecurangan.id as kecurangan_id')
        ->paginate(16);
      dd($data);
        return view('livewire.fraud-data-print', $data);
    }
}
