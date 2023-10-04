<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationCommander extends Model
{
    use HasFactory;
    protected $fillable = ['order','jenis','setting','link_redirect'];
}
