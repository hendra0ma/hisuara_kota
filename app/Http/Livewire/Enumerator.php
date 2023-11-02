<?php

namespace App\Http\Livewire;

use App\Models\Absensi;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Enumerator extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];

    public function render()
    {
        $data['saksi_data'] = User::where('role_id', '=', 8)->where('is_active', '=', 0)->where('name', 'like', '%' . $this->search . '%')->paginate(16);
        return view('livewire.enumerator', $data);
    }
}
