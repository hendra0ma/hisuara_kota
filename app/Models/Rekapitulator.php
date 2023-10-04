<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekapitulator extends Model
{
    use HasFactory;
    protected $table = 'rekapitulator';
    protected $fillable = ['village_id' ,'district_id','paslon_id','regency_id'];
}
