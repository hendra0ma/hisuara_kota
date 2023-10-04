<?php

namespace App\Http\Livewire;

use App\Models\Tps;
use Livewire\Component;
use Livewire\WithPagination;


class C1DeveloperAuditor extends Component
{
    public $id_kel;
    public $district;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
        ->join('users', 'users.tps_id', '=', 'tps.id')
        ->where('saksi.verification', 1)
        ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
        ->where('saksi.audit', "")
        ->paginate(10);
        return view('livewire.c1-developer-auditor',$data);
    }
}
