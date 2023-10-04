<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bukti_deskripsi_curang extends Model
{
    use HasFactory;
    public $table = "bukti_deskripsi_curang";
    protected $fillable = ['text','tps_id','list_kecurangan_id']; 
}
