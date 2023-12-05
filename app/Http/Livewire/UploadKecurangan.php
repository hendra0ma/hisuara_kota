<?php

namespace App\Http\Livewire;

use App\Models\Bukti_deskripsi_curang;
use App\Models\Config;
use App\Models\Configs;
use App\Models\Listkecurangan;
use App\Models\RegenciesDomain;
use App\Models\Tps;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UploadKecurangan extends Component
{

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

    public function render(Request $request)
    {
        $villagee = Auth::user()->villages;
        $data['tps'] = Tps::where('villages_id', $villagee)->get();
        $data['list_kecurangan'] = Listkecurangan::get();
        $data['kelurahan'] = Village::where('id', $villagee)->first();

        $data['list_solution'] = Bukti_deskripsi_curang::join('list_kecurangan', 'list_kecurangan.id', '=', 'bukti_deskripsi_curang.list_kecurangan_id')
        ->join('kecurangan','kecurangan.id','=','bukti_deskripsi_curang.kecurangan_id')
        ->join('solution_frauds', 'solution_frauds.id', '=', 'list_kecurangan.solution_fraud_id')
        ->where('bukti_deskripsi_curang.tps_id', $request['id'])
        ->where("kecurangan.regency_id",  $this->config->regencies_id)
     
            ->select('solution_frauds.*', 'bukti_deskripsi_curang.*', 'list_kecurangan.*', 'list_kecurangan.id as id_list')
            ->get();
        $data['pelanggaran_umum']    = Listkecurangan::where('jenis', 0)->get();
        $data['pelanggaran_petugas'] = Listkecurangan::where('jenis', 1)->get();
        $data['pelanggaran_etik'] = Listkecurangan::where('jenis', 2)->get();
        $data['pelanggaran_apartur'] = Listkecurangan::where('jenis', 3)->get();

        $data['tps'] = Tps::where('villages_id', (string)$villagee)->get();

        return view('livewire.upload-kecurangan', $data);
    }
}
