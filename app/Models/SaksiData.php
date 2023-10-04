<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class SaksiData extends Model
{
    use HasFactory;
    protected $table = "saksi_data";
    protected $fillable = ['paslon_id','district_id','user_id','village_id','village_id','regency_id','voice','saksi_id'];
    public function saksi()
    {
        return $this->hasOne(Saksi::class,"id",'saksi_id');
    }
    public static function suara($paslon,$village){
        $data = SaksiData::where([
            ['paslon_id', '=', (string)$paslon],
            ['village_id', '=', (string)$village]
        ])->sum('voice');
        return $data;
    }
}
