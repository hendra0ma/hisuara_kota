<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatPerson extends Model
{
    use HasFactory;
    protected $table = 'chat_people';
    protected $fillable = ['message', 'send_by', 'time', 'send_to'];
}
