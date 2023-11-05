<?php

namespace App\Http\Livewire;

use App\Models\CrowdC1;
use App\Models\Saksi;
use Livewire\Component;
use Livewire\WithPagination;

class CrowdC1Kpu extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];
    // public $id_wilayah;
    // public $tipe_wilayah;

    public function render()
    {
        $data['all_c1'] = CrowdC1::join('tps','crowd_c1.tps_id','=','tps.id')->where('tps.number', 'like', '%' . $this->search . '%')->paginate(12);
        return view('livewire.crowd-c1-kpu', $data);
    }
}
