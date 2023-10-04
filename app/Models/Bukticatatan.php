<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bukticatatan extends Model
{
    use HasFactory;
    public $table = "bukti_catatan";
    protected $fillable = ['text','tps_id'];
}
