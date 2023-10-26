<?php

namespace App\Http\Livewire;

use App\Models\Paslon;
use App\Models\User;
use App\Models\Village;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AbsensiSaksi extends Component
{
    public function render()
    {
        $data['kelurahan'] = Village::where('id', Auth::user()->villages)->first();
        $data['paslon'] = Paslon::get();
        $data['dev'] = User::join('tps', 'tps.id', '=', 'users.tps_id')->first();
        return view('livewire.absensi-saksi',$data);
    }
}
