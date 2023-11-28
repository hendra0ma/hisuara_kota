<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class MarqueeController
{
    public $id_wilayah;
    public $tables = [];
    public $data = [];
    public $limit;
     public function __construct($id_wilayah,$tables,$limit) {
        $this->id_wilayah = $id_wilayah;
        $this->tables = $tables;
        $this->limit = $limit;
    }
    public function getDataMarquee(){
        $kolom_wilayah = $this->getTipeWilayahFromId($this->id_wilayah);
        if ($kolom_wilayah != "") {
            foreach ($this->tables as $table) {
                $this->data[$table] = DB::table($table)
                ->join('users',"$table.tps_id",'=','users.tps_id')
                ->join('tps',"$table.tps_id",'=','tps.id')
                ->join('villages',"$table.village_id",'=','villages.id')
                ->join('districts',"$table.district_id",'=','districts.id')
                ->where("$table.$kolom_wilayah",$this->id_wilayah)
                ->select(
                'users.name as username',
                'users.role_id',
                'districts.name as nama_kelurahan',
                'villages.name as nama_kelurahan',
                'tps.number as nomor_tps')
                ->limit($this->limit)
                ->get();
            }
        }
            return $this->data;
    }
    private function getTipeWilayahFromId($id_wilayah){
        $lengthId = strlen($id_wilayah);
        $tipe_wilayah = "";
        switch ($lengthId) {
            case 2:
                $tipe_wilayah = "province_id";
                break;
            case 4:
                $tipe_wilayah = "regency_id";
                break;
            case 7:
                $tipe_wilayah = "district_id";
                break;
            case 10:
                $tipe_wilayah = "village_id";
                break;
            default:
                break;
        }
        return $tipe_wilayah;

    }
}
