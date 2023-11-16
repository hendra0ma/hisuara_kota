<?php

namespace App\Http\Livewire;

use App\Models\Bukti_deskripsi_curang;
use App\Models\Listkecurangan;
use App\Models\Tps;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UploadKecurangan extends Component
{
    public function render(Request $request)
    {
        $villagee = Auth::user()->villages;
        $data['tps'] = Tps::where('villages_id', $villagee)->get();
        $data['list_kecurangan'] = Listkecurangan::get();
        $data['kelurahan'] = Village::where('id', $villagee)->first();

        $data['list_solution'] = Bukti_deskripsi_curang::join('list_kecurangan', 'list_kecurangan.id', '=', 'bukti_deskripsi_curang.list_kecurangan_id')
        ->join('solution_frauds', 'solution_frauds.id', '=', 'list_kecurangan.solution_fraud_id')
        ->where('bukti_deskripsi_curang.tps_id', $request['id'])
            ->select('solution_frauds.*', 'bukti_deskripsi_curang.*', 'list_kecurangan.*', 'list_kecurangan.id as id_list')
            ->get();
        $data['pelanggaran_umum']    = Listkecurangan::where('jenis', 0)->get();
        $data['pelanggaran_petugas'] = Listkecurangan::where('jenis', 1)->get();
        $data['pelanggaran_etik'] = Listkecurangan::where('jenis', 2)->get();

        $data['tps'] = Tps::where('villages_id', (string)$villagee)->get();

        return view('livewire.upload-kecurangan', $data);
    }
}
