<?php

namespace App\Models;

use App\Scopes\RegencyScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB as FacadesDB;

class SaksiData extends Model
{
    use HasFactory;
    protected $table = "saksi_data";
    protected $fillable = ['paslon_id', 'district_id', 'user_id', 'village_id', 'village_id', 'regency_id', 'voice', 'saksi_id', 'province_id'];

    // protected static function booted()
    // {
    //     // Check if there's a join in progress using the DB facade
    //     // FacadesDB::enableQueryLog();
    //     // $isJoining = FacadesDB::getQueryLog();
    //     // dd(app('request'));
    //     // if (app('request')->has('joining')) {
    //     //     // Lakukan logika pembuatan hanya jika tidak ada join
    //     // }
    //     // $isJoining = end($isJoining)['query'];

    //     // if (stripos($isJoining, 'join') !== false) {
    //     //     return;
    //     // }

    //     $currentDomain = request()->getHttpHost();
    //     $url = isset(parse_url($currentDomain)['port']) ? substr($currentDomain, 0, strpos($currentDomain, ':8000')) : $currentDomain;
        
    //     $regency_id = RegenciesDomain::where('domain', 'LIKE', "%{$url}%")->first();
    //     $config = new Configs;

    //     $config->regencies_id = ($regency_id === null) ?  $config->regencies_id = "" : (string) $regency_id->regency_id;

    //     static::addGlobalScope(new RegencyScopes($config->regencies_id));
    // }

    public function saksi()
    {
        return $this->hasOne(Saksi::class, "id", 'saksi_id');
    }
    public static function suara($paslon, $village)
    {
        $data = SaksiData::where([
            ['paslon_id', '=', (string)$paslon],
            ['village_id', '=', (string)$village]
        ])->sum('voice');
        return $data;
    }
}
