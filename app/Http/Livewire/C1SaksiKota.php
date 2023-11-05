<?php

namespace App\Http\Livewire;

use App\Models\District;
use App\Models\Saksi;
use App\Models\Tps;
use App\Models\Village;
use Livewire\Component;
use Livewire\WithPagination;

class C1SaksiKota extends Component
{
    public $id_kel;
    // public $district;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];
    
    public function render()
    {
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            // ->where('tps.villages_id',(string)$this->id_kel)
            ->where('saksi.verification', '')
            ->whereNull('saksi.pending')
            ->where('saksi.batalkan', '=', 0)
            ->whereNull('saksi.koreksi')
            ->where('saksi.overlimit', 0)
            ->where('name', 'like', '%'.$this->search.'%')
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->paginate(16);
        // $data = Saksi::whereNull('koreksi')
        //     ->where('batalkan', '=', 0)->get();
        $data['jumlah_verifikasi_c1'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            // ->where('tps.villages_id',(string)$this->id_kel)
            ->where('saksi.verification', '')
            ->whereNull('saksi.pending')
            ->where('saksi.batalkan', '=', 0)
            ->whereNull('saksi.koreksi')
            ->where('saksi.overlimit', 0)
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->count();

        // $data['district'] = District::find($data['list_suara'][0]->district_id);
        if (count($data['list_suara']) > 0) {
            $data['village'] = Village::where ('id', $data['list_suara'][0]->village_id)->first();
            $data['district'] = District::where ('id', $data['list_suara'][0]->district_id)->first();
        }
        
        return view('livewire.c1-saksi-kota', $data);
    }
}
