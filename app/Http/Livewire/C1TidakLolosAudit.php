<?php

namespace App\Http\Livewire;

use App\Models\District;
use App\Models\Tps;
use App\Models\Village;
use Livewire\Component;
use Livewire\WithPagination;

class C1TidakLolosAudit extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];

    public function render()
    {
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
        ->join('users', 'users.tps_id', '=', 'tps.id')
        ->where('saksi.verification', '')
        ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
        ->where('name', 'like', '%' . $this->search . '%')
        ->where('saksi.batalkan', 1)
        ->paginate(18);

        $data['jumlah_c1_tidak_lolos_audit']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
        ->join('users', 'users.tps_id', '=', 'tps.id')
        ->where('saksi.verification', '')
        ->where('saksi.batalkan', 1)
        ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
        ->count();

        if (count($data['list_suara']) > 0) {
            $data['village'] = Village::where('id', $data['list_suara'][0]->village_id)->first();
            $data['district'] = District::where('id', $data['list_suara'][0]->district_id)->first();
        }
        return view('livewire.c1-tidak-lolos-audit', $data);
    }
}
