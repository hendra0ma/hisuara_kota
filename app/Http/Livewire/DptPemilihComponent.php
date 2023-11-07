<?php

namespace App\Http\Livewire;

use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Tps;
use App\Models\Village;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class DptPemilihComponent extends Component
{
    use WithPagination;
    public $id_wilayah;
    protected $paginationTheme = 'bootstrap';
    public $tipe_wilayah;
    public $search;
    public function render()
    {
        if ($this->tipe_wilayah == "kota") {
            $reg = Regency::where("id",$this->id_wilayah)->first();
            $provinsi = Province::where("id",$reg->province_id)->first();
            $data['judul'] = 'Daftar Pemilih Tetap (DPT) <br> '.$reg->name.' tahun 2024';
            $data['dpt_i'] = DB::table('dpt_indonesia')
            ->where('regency_name',$reg->name)
            ->where('nama_pemilih', 'like', '%' . $this->search . '%')
            ->where('province_name',$provinsi->name)->paginate(25);
            
            
        }elseif ($this->tipe_wilayah == "kecamatan") {
            $kec = District::where("id",$this->id_wilayah)->first();
            $reg = Regency::where("id",$kec->regency_id)->first();
            $data['judul'] = 'Daftar Pemilih Tetap (DPT) <br> Kecamatan ' . $kec->name . ', '.$reg->name.' tahun 2024';
            $data['dpt_i'] = DB::table('dpt_indonesia')
            ->where('regency_name',$reg->name)
            ->where('nama_pemilih', 'like', '%' . $this->search . '%')
            ->where('district_name',$kec->name)->paginate(25);
            
        }elseif($this->tipe_wilayah == "kelurahan"){
            $vill = Village::where("id",$this->id_wilayah)->first();
            $kec = District::where("id",$vill->district_id)->first();
            $reg = Regency::where("id", $kec->regency_id)->first();
            $data['wilayah']= $vill;
            $data['judul'] = 'Daftar Pemilih Tetap (DPT) <br> Kelurahan ' . $vill->name . ', ' . $reg->name . ' tahun 2024';
            $data['dpt_i'] = DB::table('dpt_indonesia')
            ->where('village_name',$vill->name)
            ->where('nama_pemilih', 'like', '%' . $this->search . '%')
            ->where('district_name',$kec->name)->paginate(25);
        }else{

            $tps = Tps::where("id",$this->id_wilayah)->first();
            $vill = Village::where("id",$tps->villages_id)->first();
            $kec = District::where("id",$vill->district_id)->first();

            $data['wilayah']= $vill;
            $data['dpt_i'] = DB::table('dpt_indonesia')
            ->where('village_name',$vill->name)
            ->where('nama_pemilih', 'like', '%' . $this->search . '%')
            ->where('district_name',$kec->name)->paginate(25);
            
        }
        return view('livewire.dpt-pemilih-component',$data);
        // dd($reg);
    }
}
