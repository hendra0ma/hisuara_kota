<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuickSaksi extends Model
{
    use HasFactory;
    protected $fillable = ['c1_plano'];
    protected $table = "quicksaksi";



}
