<?php

namespace App\Http\Livewire;

use App\Models\Tps;
use Livewire\Component;
use Livewire\WithPagination;

class FraudDataPrintTercetak extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];

    public function render()
    {
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->join('qrcode_hukum', 'qrcode_hukum.tps_id', '=', 'users.tps_id')
            ->where('saksi.kecurangan', 'yes')
            ->where('saksi.status_kecurangan', 'terverifikasi')
            ->where('print', 1)
            ->where('name', 'like', '%' . $this->search . '%')
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->get();
        return view('livewire.fraud-data-print-tercetak', $data);
    }
}
