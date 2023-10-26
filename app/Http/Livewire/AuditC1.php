<?php

namespace App\Http\Livewire;

use App\Models\Tps;
use App\Models\Village;
use Livewire\Component;
use Livewire\WithPagination;

class AuditC1 extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];
    
    public function render()
    {
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('saksi.verification', 1)
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->where('name', 'like', '%'.$this->search.'%')
            ->where('saksi.audit', "")
            ->paginate(18);

        $data['jumlah_audit_c1']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('saksi.verification', 1)
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->where('saksi.audit', "")
            ->count();

        if (count($data['list_suara']) > 0) {
            $data['village'] = Village::where ('id', $data['list_suara'][0]->village_id)->first();
        }


        return view('livewire.audit-c1', $data);
    }
}
