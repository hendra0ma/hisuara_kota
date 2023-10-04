<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    use HasFactory;
    protected $table = "rekening_users";
    protected $fillable = ['name'];

   public function rekening()
   {
       return $this->hasMany(User::class);
   }
}
