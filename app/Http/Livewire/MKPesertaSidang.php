<?php

namespace App\Http\Livewire;

use App\Models\Config;
use App\Models\Configs;
use App\Models\Listkecurangan;
use App\Models\RegenciesDomain;
use App\Models\Regency;
use App\Models\Saksi;
use App\Models\Tps;
use Livewire\Component;
use Livewire\WithPagination;

class MKPesertaSidang extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    private $config;
    private $configs;
    protected $queryString = ['search'];

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
    }
      
    public function render()
    {
        $data['config'] = Config::first();
        $data['kota']   = Regency::where('id', $this->config->regencies_id)->first();
        $data['index_tsm']    = Listkecurangan::get();
        $data['jumlah_peserta_sidang']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('saksi.kecurangan', 'yes')
            ->where('saksi.status_kecurangan', 'terverifikasi')
            ->where('makamah_konsitusi', 'Panggil')
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->count();
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('saksi.kecurangan', 'yes')
            ->where('saksi.status_kecurangan', 'terverifikasi')
            ->where('makamah_konsitusi', 'Panggil')
            ->where('name', 'like', '%' . $this->search . '%')
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->paginate(18);
        $data['tag'] = 1;
        $data['terverifikasi'] = Saksi::where('kecurangan', 'yes')->where('status_kecurangan', 'terverifikasi') ->where("saksi.regency_id",  $this->config->regencies_id)->get();
        $data['tidak_menjawab'] = Saksi::where('kecurangan', 'yes')->where('status_kecurangan', 'terverifikasi')->where('makamah_konsitusi', 'Tidak Menjawab') ->where("saksi.regency_id",  $this->config->regencies_id)->get();
        $data['selesai'] = Saksi::where('kecurangan', 'yes')->where('status_kecurangan', 'terverifikasi')->where('makamah_konsitusi', 'Selesai') ->where("saksi.regency_id",  $this->config->regencies_id)->get();
        $data['ditolak'] = Saksi::where('kecurangan', 'yes')->where('makamah_konsitusi', 'Ditolak') ->where("saksi.regency_id",  $this->config->regencies_id)->get();
        $data['data_masuk'] = Saksi::where('kecurangan', 'yes')->where('status_kecurangan', 'terverifikasi') ->where("saksi.regency_id",  $this->config->regencies_id)->get();
        return view('livewire.m-k-peserta-sidang', $data);
    }
}
