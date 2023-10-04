<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Qrcode;
use Livewire\WithPagination;
class FraudBarcodeReportComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
            $data['qrcode'] = QrCode::join('surat_pernyataan','surat_pernyataan.qrcode_hukum_id','=','qrcode_hukum.id')->select('qrcode_hukum.*')->paginate(15);
        return view('livewire.fraud-barcode-report-component',$data);
    }
}
