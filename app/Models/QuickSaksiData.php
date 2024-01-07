<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuickSaksiData extends Model
{
    use HasFactory;
    protected $fillable = ['paslon_id', 'district_id', 'user_id', 'village_id', 'village_id', 'regency_id', 'voice', 'saksi_id', 'province_id'];
    protected $table = "quicksaksidata";
 

}
