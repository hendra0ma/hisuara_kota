<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSaksiC extends Model
{
    use HasFactory;
    protected $table = "data_saksi_c1_c8";
    protected $fillable = ['paslon_id','district_id','user_id','village_id','regency_id','voice','saksi_id'];
    public function saksi()
    {
        return $this->hasOne(SaksiC::class,"id",'saksi_id');
    }
    public static function suara($paslon,$village){
        $data = DataSaksiC::where([
            ['paslon_id', '=', (string)$paslon],
            ['village_id', '=', (string)$village]
        ])->sum('voice');
        return $data;
    }
}
