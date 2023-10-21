<?php

namespace App\Http\Livewire;

use App\Models\Absensi as AbsensiModel;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Absensi extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];
    public function render()
    {
        $data['absen'] = AbsensiModel::join('users', 'users.id', '=', 'absensi.user_id')->where('name', 'like', '%'.$this->search.'%')->paginate(16);
        $data['absen2'] = AbsensiModel::join('users', 'users.id', '=', 'absensi.user_id')->get();
        $data['user'] = User::where('role_id',8)->count();
        $data['jumlah'] = count($data['absen2']);
        
        return view('livewire.absensi', $data);
    }
}
