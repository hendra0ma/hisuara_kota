<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultiAdministrator extends Model
{
    use HasFactory;
    protected $table = 'multi_administrators';
    protected $fillable = ['order'];

}
