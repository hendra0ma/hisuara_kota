<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tps extends Model
{
    use HasFactory;
    protected $table = 'tps';
    protected $fillable = ['dpt, created_at, number, villages_id, district_id, regency_id, province_id'];

    public function saksi()
    {
        return $this->hasOne(Saksi::class, 'tps_id', 'id');
    }
}
