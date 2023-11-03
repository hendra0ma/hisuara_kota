<?php

namespace App\Http\Livewire;

use App\Models\Tps;
use Livewire\Component;
use Livewire\WithPagination;

class ListKecuranganComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];

    public function render()
    {
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('saksi.kecurangan', 'yes')
            ->where('saksi.status_kecurangan', 'belum terverifikasi')
            ->where('name', 'like', '%'.$this->search.'%')
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->paginate(16);

        $data['jumlah_data_kecurangan']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('saksi.kecurangan', 'yes')
            ->where('saksi.status_kecurangan', 'belum terverifikasi')
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->count();
        return view('livewire.list-kecurangan-component', $data);
    }
}
