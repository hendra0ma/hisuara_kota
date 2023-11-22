<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saksi extends Model
{
    use HasFactory;
    protected $table = "saksi";
    protected $fillable = ['c1_plano'];
    public $timestamps = false;



    public function saksi_data()
    {
        return $this->hasMany(SaksiData::class, "saksi_id", "id");
    }
}
