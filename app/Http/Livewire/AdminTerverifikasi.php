<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AdminTerverifikasi extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];

    public function render()
    {
        $data['admin_data'] = User::where('role_id', '!=', 8)->where('is_active', '=', '1')->paginate(16);
        return view('livewire.admin-terverifikasi', $data);
    }
}
