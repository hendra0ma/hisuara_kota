<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DptModel extends Model
{
    use HasFactory;
    public $table = "dpt";
    protected $fillable = ['districts_id', 'villages_id','count'];
}
