<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    public $table = "history";
    protected $fillable = ['user_id', 'action','saksi_id','status'];

}
