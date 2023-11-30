<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSaksiC extends Model
{
    use HasFactory;
    protected $table = "data_saksi_c1_c8";
    protected $fillable = ['paslon_id','district_id','user_id','village_id','regency_id','voice','saksi_id'];

//     public $config;
//     public $configs;
//     public function __construct()
//     {

//         $currentDomain = request()->getHttpHost();
//         if (isset(parse_url($currentDomain)['port'])) {
//             $url = substr($currentDomain, 0, strpos($currentDomain, ':8000'));
//         } else {
//             $url = $currentDomain;
//         }
//         $regency_id = RegenciesDomain::where('domain', $url)->first();

//         $this->configs = Config::first();
//         $this->config = new Configs;
//         if ($regency_id == null) {
//             $this->config->regencies_id = "";
//         }else{
//             $this->config->regencies_id =  (string) $regency_id->regency_id;
//         }
//         $this->config->provinces_id =  $this->configs->provinces_id;
//         $this->config->setup =  $this->configs->setup;
//         $this->config->updated_at =  $this->configs->updated_at;
//         $this->config->created_at =  $this->configs->created_at;
//         $this->config->partai_logo =  $this->configs->partai_logo;
//         $this->config->date_overlimit =  $this->configs->date_overlimit;
//         $this->config->show_public =  $this->configs->show_public;
//         $this->config->show_terverifikasi =  $this->configs->show_terverifikasi;
//         $this->config->lockdown =  $this->configs->lockdown;
//         $this->config->multi_admin =  $this->configs->multi_admin;
//         $this->config->otonom =  $this->configs->otonom;
//         $this->config->dark_mode =  $this->configs->dark_mode;
//         $this->config->jumlah_multi_admin =  $this->configs->jumlah_multi_admin;
//         $this->config->jenis_pemilu =  $this->configs->jenis_pemilu;
//         $this->config->tahun =  $this->configs->tahun;
//         $this->config->quick_count =  $this->configs->quick_count;
//         $this->config->default =  $this->configs->default;
//     }

//    public static function boot()
//     {
//         parent::boot();

//         // Menambahkan query default
//         static::addGlobalScope('regency_id', function ($builder) {
          
//             if ($this->config->regencies_id != "") {
//             $builder
//             ->where('regency_id',$this->config->regencies_id);
//             }
//         });
//     }
//     public function withoutGlobalRegencyIdScope()
//     {
//         return $this->withoutGlobalScope('regency_id');
//     }

    public function saksi()
    {
        return $this->hasOne(SaksiC::class,"id",'saksi_id');
    }




    public static function suara($paslon,$village){
        $data = DataSaksiC::where([
            ['paslon_id', '=', (string)$paslon],
            ['village_id', '=', (string)$village]
        ])->sum('voice');
        return $data;
    }
}
