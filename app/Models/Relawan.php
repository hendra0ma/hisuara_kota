<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relawan extends Model
{
    use HasFactory;
    protected $table = 'c1_relawan';
    protected $fillable = ['c1_images', 'district_id', 'village_id', 'relawan_id', 'regency_id', 'tps_id'];
    public function relawan_data()
    {
        return $this->hasMany(RelawanData::class, 'c1_relawan_id', 'id');
    }
}
