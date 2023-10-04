<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tps extends Model
{
    use HasFactory;
    protected $table = 'tps';

    public function saksi()
    {
        return $this->hasOne(Saksi::class, 'tps_id', 'id');
    }
}
