<?php

namespace App\Http\Livewire;

use App\Models\Saksi;
use Livewire\Component;
use Livewire\WithPagination;

class CrowdC1Kpu extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];

    public function render()
    {
        $data['all_c1'] = Saksi::join('tps', 'saksi.tps_id', '=', 'tps.id')->where('tps.number', 'like', '%' . $this->search . '%')->paginate(12);
        return view('livewire.crowd-c1-kpu', $data);
    }
}
