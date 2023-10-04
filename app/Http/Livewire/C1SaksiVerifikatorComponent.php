<?php

namespace App\Http\Livewire;

use App\Models\Tps;
use Livewire\Component;
use Livewire\WithPagination;

class C1SaksiVerifikatorComponent extends Component
{
    public $id_kel;
    public $district;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('tps.villages_id',(string)$this->id_kel)
            ->where('saksi.verification', '')
            ->whereNull('saksi.pending')
            ->where('saksi.overlimit', 0)
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->paginate(18);
        return view('livewire.c1-saksi-verifikator-component', $data);
    }
}
