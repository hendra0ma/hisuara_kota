<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Koreksi extends Model
{
    use HasFactory;
    protected $table = 'koreksi';
    protected $fillable = ['paslon_id', 'district_id'];
}
