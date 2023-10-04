<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPernyataan extends Model
{
    use HasFactory;
    protected $table = "surat_pernyataan";
    protected $fillable = ['qrcode_hukum_id','deskripsi','saksi_id'];

}
