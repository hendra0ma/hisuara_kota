<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paslon extends Model
{
    use HasFactory;
    protected $table = "paslon";
    protected $fillable = ['name'];

   public function saksi_data()
   {
       return $this->hasMany(SaksiData::class);
   }
   public function quicksaksidata()
   {
       return $this->hasMany(QuickSaksiData::class);
   }

}
