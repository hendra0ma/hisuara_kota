<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Qrcode;
use Livewire\WithPagination;
class FraudBarcodeReportComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];

    public function render()
    {
        $data['qrcode'] = QrCode::join('surat_pernyataan','surat_pernyataan.qrcode_hukum_id','=','qrcode_hukum.id')
                                ->join('tps', 'tps.id', '=', 'qrcode_hukum.tps_id')
                                ->join('users', 'users.tps_id', '=', 'qrcode_hukum.tps_id')
                                ->join('villages', 'villages.id', '=', 'tps.villages_id')
                                ->where('users.name', 'like', '%'.$this->search.'%')
                                ->select('users.name as user_name', 'users.nik as user_nik', 'tps.*', 'villages.name as village_name', 'qrcode_hukum.*')
                                ->paginate(16);
        $data['jumlah_barkode'] = QrCode::join('surat_pernyataan','surat_pernyataan.qrcode_hukum_id','=','qrcode_hukum.id')
                                ->join('tps', 'tps.id', '=', 'qrcode_hukum.tps_id')
                                ->join('users', 'users.tps_id', '=', 'qrcode_hukum.tps_id')
                                ->join('villages', 'villages.id', '=', 'tps.villages_id')
                                ->select('users.name as user_name', 'users.nik as user_nik', 'tps.*', 'villages.name as village_name', 'qrcode_hukum.*')
                                ->count();
        return view('livewire.fraud-barcode-report-component',$data);
    }
}
