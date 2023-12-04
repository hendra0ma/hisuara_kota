<?php

namespace App\Http\Livewire;

use App\Models\Config;
use App\Models\Configs;
use Livewire\Component;
use App\Models\Qrcode;
use App\Models\RegenciesDomain;
use Livewire\WithPagination;
class FraudBarcodeReportComponent extends Component
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
        $data['qrcode'] = QrCode::join('surat_pernyataan','surat_pernyataan.qrcode_hukum_id','=','qrcode_hukum.id')
                                ->join('tps', 'tps.id', '=', 'qrcode_hukum.tps_id')
                                ->join('users', 'users.tps_id', '=', 'qrcode_hukum.tps_id')
                                ->where("users.regency_id",  $this->config->regencies_id)
                                ->join('villages', 'villages.id', '=', 'tps.villages_id')
                                ->where('users.name', 'like', '%'.$this->search.'%')
                                ->select('users.name as user_name', 'users.nik as user_nik', 'tps.*', 'villages.name as village_name', 'qrcode_hukum.*')
                                ->paginate(16);
        $data['jumlah_barkode'] = QrCode::join('surat_pernyataan','surat_pernyataan.qrcode_hukum_id','=','qrcode_hukum.id')
                                ->join('tps', 'tps.id', '=', 'qrcode_hukum.tps_id')
                                ->join('users', 'users.tps_id', '=', 'qrcode_hukum.tps_id')
                                ->join('villages', 'villages.id', '=', 'tps.villages_id')
                                ->where("users.regency_id",  $this->config->regencies_id)
                                ->select('users.name as user_name', 'users.nik as user_nik', 'tps.*', 'villages.name as village_name', 'qrcode_hukum.*')
                                ->count();
        return view('livewire.fraud-barcode-report-component',$data);
    }
}
