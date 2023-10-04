<?php

namespace App\Http\Livewire;

use App\Models\Tps;
use Livewire\Component;
use Livewire\WithPagination;

class C1SaksiPending extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $village_id;
    public function render()
    {
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('tps.villages_id', $this->village_id)
            ->where('saksi.verification', '')
            ->whereNotNull('saksi.pending')
            ->where('saksi.overlimit', 0)
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->paginate(18);
        return view('livewire.c1-saksi-pending', $data);
    }
}
