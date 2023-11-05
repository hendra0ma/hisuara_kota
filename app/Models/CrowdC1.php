<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrowdC1 extends Model
{
    use HasFactory;
    protected $table = 'crowd_c1';
    protected $fillable = ['crowd_c1','status','user_id','regency_id','petugas_id','tps_id','district_id','village_id'];
}
