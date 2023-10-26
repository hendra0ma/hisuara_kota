<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class RelawanDihapus extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];

    public function render()
    {
        $data['saksi_data'] = User::where('role_id', '=', 14)->where('is_active', '=', '0')->where('name', 'like', '%'.$this->search.'%')->paginate(16);
        
        return view('livewire.relawan-dihapus', $data);
    }
}
