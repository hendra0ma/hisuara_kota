<?php

namespace App\Http\Livewire;

use App\Models\Saksi;
use App\Models\Village;
use Livewire\Component;
use Livewire\WithPagination;

class VerifikasiKoreksi extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];

    public function render()
    {
        $data['saksi_data'] = Saksi::join('users', 'users.tps_id', '=', 'saksi.tps_id')->where('koreksi', 1)->where('name', 'like', '%'.$this->search.'%')->paginate(18);
        $data['jumlah_koreksi_c1'] = Saksi::join('users', 'users.tps_id', '=', 'saksi.tps_id')->where('koreksi', 1)->count();

        if (count($data['saksi_data']) > 0) {
            $data['village'] = Village::where ('id', $data['saksi_data'][0]->village_id)->first();
        }

        return view('livewire.verifikasi-koreksi', $data);
    }
}
