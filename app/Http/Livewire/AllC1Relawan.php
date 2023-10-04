<?php

namespace App\Http\Livewire;

use App\Models\Relawan;

use Livewire\Component;
use Livewire\WithPagination;

class AllC1Relawan extends Component
{
        use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $data['all_c1'] = Relawan::paginate(10);
        return view('livewire.all-c1-relawan',$data);
    }
}
