<?php

namespace App\Http\Livewire;

use App\Models\Saksi;
use Livewire\Component;
use Livewire\WithPagination;

class AllC1Plano extends Component
{
        use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $data['all_c1'] = Saksi::paginate(10);
        return view('livewire.all-c1-plano',$data);
    }
}
