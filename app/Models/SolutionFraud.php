<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolutionFraud extends Model
{
    use HasFactory;
    protected $fillable = ['solution','list_kecurangan_id'];
}
