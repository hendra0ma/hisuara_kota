<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qrcode extends Model
{
    use HasFactory;
    public $table = "qrcode_hukum";
    protected $fillable = ['token','tps_id','nomor_berkas','verifikator_id','hukum_id','tanggal_masuk'];
    protected $guarded = [];
}
