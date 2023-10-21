<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class VerifikasiSaksi extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];

    public function render()
    {
        $data['saksi_data'] = User::where('role_id', '=', 8)->where('name', 'like', '%'.$this->search.'%')->paginate(16);
        return view('livewire.verifikasi-saksi', $data);
    }
}
