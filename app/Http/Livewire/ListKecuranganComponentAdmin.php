<?php

namespace App\Http\Livewire;

use App\Models\Config;
use App\Models\Configs;
use App\Models\Kecurangan;
use App\Models\RegenciesDomain;
use App\Models\Tps;
use Livewire\Component;
use Livewire\WithPagination;

class ListKecuranganComponentAdmin extends Component
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
        // $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
        //     ->join('users', 'users.tps_id', '=', 'tps.id')
        //     ->where('saksi.kecurangan', 'yes')
            // ->where('saksi.status_kecurangan', 'belum terverifikasi')
            // ->where('name', 'like', '%'.$this->search.'%')
        //     ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
        //     ->paginate(16);

        $data['list_suara']  = Kecurangan::join('users', 'users.id', '=', 'kecurangan.user_id')
        ->whereNull('kecurangan.tps_id')
        ->where('kecurangan.status_kecurangan', 'belum terverifikasi')
        ->where('users.regency_id', $this->config->regencies_id)
        ->where('users.name', 'like', '%'.$this->search.'%')
        ->select('kecurangan.created_at as date', 'users.*','kecurangan.*','kecurangan.id as kecurangan_id')->paginate(25);
        // dd($data);
        $data['jumlah_data_kecurangan']  = Kecurangan::whereNull('kecurangan.tps_id')->count();

        return view('livewire.list-kecurangan-component-admin', $data);
    }
}