<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Databukti extends Model
{
    use HasFactory;
    public $table = "data_bukti";
    protected $fillable = ['bukti','tps_id'];
}
