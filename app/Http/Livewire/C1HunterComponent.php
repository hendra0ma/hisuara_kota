<?php

namespace App\Http\Livewire;

use App\Models\Relawan;
use Livewire\Component;
use Livewire\WithPagination;

class C1HunterComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $data['relawan'] = Relawan::join('users', 'users.id', '=', 'c1_relawan.relawan_id')
            ->join('districts', 'districts.id', '=', 'c1_relawan.district_id')
            ->select('users.*', 'c1_relawan.*', 'districts.name as district_name')
            ->where('c1_relawan.status', 0)
            ->paginate(18);
        return view('livewire.c1-hunter-component', $data);
    }
}
