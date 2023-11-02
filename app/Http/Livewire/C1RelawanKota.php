<?php

namespace App\Http\Livewire;

use App\Models\Relawan;
use App\Models\Tps;
use Livewire\Component;
use Livewire\WithPagination;

class C1RelawanKota extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $village_id;
    public $search;
    protected $queryString = ['search'];

    public function render()
    {
        $data['list_suara']  = Tps::join('c1_relawan', 'c1_relawan.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            // ->where('c1_relawan.village_id', $this->village_id)
            ->where('c1_relawan.status', 1)
            ->where('name', 'like', '%' . $this->search . '%')
            ->select('c1_relawan.*', 'c1_relawan.created_at as date', 'tps.*', 'users.*')
            ->paginate(18);

        $data['jumlah_c1_relawan']  = Tps::join('c1_relawan', 'c1_relawan.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            // ->where('c1_relawan.village_id', $this->village_id)
            ->where('c1_relawan.status', 1)
            ->select('c1_relawan.*', 'c1_relawan.created_at as date', 'tps.*', 'users.*')
            ->count();
        // dump($data);
        return view('livewire.c1-relawan-kota', $data);
    }
}
