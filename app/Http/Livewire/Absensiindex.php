<?php

namespace App\Http\Livewire;

use App\Models\Absensi;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Absensiindex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];
    public function render()
    {
        $data['absen2'] = Absensi::join('users', 'users.id', '=', 'absensi.user_id')->get();
        $data['absen'] = User::where('role_id',8)->where('is_active', '=', 1)->where('name', 'like', '%'.$this->search.'%')->paginate(18);
        $data['user'] = User::where('role_id',8)->count();
        $data['jumlah'] = $data['user'];
        
        return view('livewire.absensiindex', $data);
    }
}
