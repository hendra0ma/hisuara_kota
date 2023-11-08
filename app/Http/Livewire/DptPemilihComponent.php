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
            $reg = Regency::where("id",(string) $this->id_wilayah)->first();
            $provinsi = Province::where("id",(string) $reg->province_id)->first();
            $data['judul'] = 'Daftar Pemilih Tetap (DPT) <br> '.$reg->name.' tahun 2024';
            $data['dpt_i'] = DB::table('dpt_indonesia')
            ->where('regency_name',$reg->name)
            ->where('nama_pemilih', 'like', '%' . $this->search . '%')
            ->where('province_name',$provinsi->name)->paginate(25);
            
            
        }elseif ($this->tipe_wilayah == "kecamatan") {
            $kec = District::where("id",(string) $this->id_wilayah)->first();
            $reg = Regency::where("id",(string) $kec->regency_id)->first();
            $data['judul'] = 'Daftar Pemilih Tetap (DPT) <br> Kecamatan ' . $kec->name . ', '.$reg->name.' tahun 2024';
            $data['dpt_i'] = DB::table('dpt_indonesia')
            ->where('regency_name',$reg->name)
            ->where('nama_pemilih', 'like', '%' . $this->search . '%')
            ->where('district_name',$kec->name)->paginate(25);
            
        }elseif ($this->tipe_wilayah == "kelurahan"){
            $vill = Village::where("id",(string) $this->id_wilayah)->first();
            $kec = District::where("id",(string) $vill->district_id)->first();
            $reg = Regency::where("id", (string) $kec->regency_id)->first();
            $data['wilayah']= $vill;
            $data['judul'] = 'Daftar Pemilih Tetap (DPT) <br> Kelurahan ' . $vill->name . ', ' . $reg->name . ' tahun 2024';
            $data['dpt_i'] = DB::table('dpt_indonesia')
            ->where('village_name',$vill->name)
            ->where('nama_pemilih', 'like', '%' . $this->search . '%')
            ->where('district_name',$kec->name)->paginate(25);
        }else{

            $tps = Tps::where("id",$this->id_wilayah)->first();
            $vill = Village::where("id",(string)$tps->villages_id)->first();
            $kec = District::where("id",(string)$vill->district_id)->first();
            $data['judul'] = 'Daftar Pemilih Tetap (DPT) <br> Kelurahan ' . $vill->name . ', TPS ' . $tps->number . ' tahun 2024';
            $data['wilayah']= $vill;
            $tps_number = strlen((string) $tps->number);
            if ($tps_number == 1) {
                $tps_number = "00".$tps->number;
            }elseif ($tps_number == 2) {
                $tps_number = "0".$tps->number;
                
            }else{
                $tps_number = $tps->number;
                
            }
            $data['dpt_i'] = DB::table('dpt_indonesia')
            ->where('village_name',$vill->name)
            ->where('tps','like',"%".(string)$tps_number."%")
            ->where('nama_pemilih', 'like', '%' . $this->search . '%')
            ->where('district_name',$kec->name)->paginate(25);
            // dd($data);
            
        }
        return view('livewire.dpt-pemilih-component',$data);
        // dd($reg);
    }
}
