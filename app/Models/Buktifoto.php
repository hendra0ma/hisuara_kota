<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buktifoto extends Model
{
    use HasFactory;
    public $table = "bukti_foto";
    protected $fillable = ['url','tps_id'];
}
