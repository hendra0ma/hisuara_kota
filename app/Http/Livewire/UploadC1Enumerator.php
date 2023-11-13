<?php

namespace App\Http\Livewire;

use App\Models\Paslon;
use App\Models\Saksi;
use App\Models\User;
use App\Models\Village;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UploadC1Enumerator extends Component
{
    public function render()
    {
        $villagee = Auth::user()->villages;
        $data['dev'] = User::join('tps', 'tps.id', '=', 'users.tps_id')->first();
        $data['kelurahan'] = Village::where('id', $villagee)->first();
        $data['paslon'] = Paslon::get();
        $cekSaksi = Saksi::where('tps_id', Auth::user()->tps_id)->count('id');
        return view('livewire.upload-c1-enumerator', $data);
    }
}
