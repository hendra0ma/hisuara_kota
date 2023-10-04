<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelawanData extends Model
{
    use HasFactory;
    protected $table = "c1_relawan_data";
    protected $fillable = ['relawan_id', 'paslon_id', 'village_id', 'regency_id', 'voice`'];
}
