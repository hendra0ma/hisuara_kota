<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaksiC extends Model
{
    use HasFactory;
    protected $table = "saksi_c1_c8";
    protected $fillable =['c_images'];
    public $timestamps = false;

    public function saksi_data()
    {
        return $this->hasMany(DataSaksiC::class,"saksi_id","id");
    }

}
