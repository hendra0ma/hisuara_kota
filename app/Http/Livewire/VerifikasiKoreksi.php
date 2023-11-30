<?php

namespace App\Http\Livewire;

use App\Models\Config;
use App\Models\Configs;
use App\Models\District;
use App\Models\RegenciesDomain;
use App\Models\RiwayatKoreksi;
use App\Models\Saksi;
use App\Models\Village;
use Livewire\Component;
use Livewire\WithPagination;

class VerifikasiKoreksi extends Component
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
        $this->config = new Configs;
        $this->config->regencies_id =  (string) $regency_id->regency_id;
        $this->config->provinces_id =  $this->configs->provinces_id;
    }

    public function render()
    {
        $data['saksi_data'] = RiwayatKoreksi::join('tps','riwayat_koreksi.tps_id','=','tps.id')
        ->where('riwayat_koreksi.regency_id',$this->config->regencies_id)
        ->where('tps.number','like','%'.$this->search.'%')
        ->select('riwayat_koreksi.*','tps.*','riwayat_koreksi.user_id as user_riwayat_id')
        ->paginate(18);

        $data['jumlah_koreksi_c1'] =RiwayatKoreksi::join('tps','riwayat_koreksi.tps_id','=','tps.id')
        ->where('riwayat_koreksi.regency_id',$this->config->regencies_id)
        ->count();

        if (count($data['saksi_data']) > 0) {
            $data['village'] = Village::where ('id', $data['saksi_data'][0]->village_id)->first();
            $data['district'] = District::where ('id', $data['saksi_data'][0]->district_id)->first();
        }
        // dd($data);

        return view('livewire.verifikasi-koreksi', $data);
    }
}
