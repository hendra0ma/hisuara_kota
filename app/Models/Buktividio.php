<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buktividio extends Model
{
    use HasFactory;
    public $table = "bukti_vidio";
    protected $fillable = ['url','tps_id','bukti_vidio'];

}
