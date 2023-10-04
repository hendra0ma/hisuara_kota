<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Regency;

class Config extends Model
{
    use HasFactory;
    public $table = "config";
    protected $fillable = ['province'];



    public function regencies()
    {
        return $this->belongsTo(Regency::class);
    }
}
