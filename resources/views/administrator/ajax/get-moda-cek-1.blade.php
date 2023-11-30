<?php

use App\Models\Config;
use App\Models\District;
use App\Models\RegenciesDomain;
use App\Models\Regency;
use App\Models\SaksiData;
use App\Models\Tps;
use App\Models\Village;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

$config = Config::all()->first();

use App\Models\Configs;

$configs = Config::all()->first();
$currentDomain = request()->getHttpHost();
if (isset(parse_url($currentDomain)['port'])) {
    $url = substr($currentDomain, 0, strpos($currentDomain, ':8000'));
} else {
    $url = $currentDomain;
}
$regency_id = RegenciesDomain::where('domain', $url)->first();

$reg = App\Models\Regency::where('id', $regency_id->regency_id)->first();

$config = new Configs;
$config->regencies_id =  (string) $regency_id->regency_id;
$config->regencies_logo =  (string) $reg->logo_kota;
$config->provinces_id =  $configs->provinces_id;
$config->setup =  $configs->setup;
$config->darkmode =  $configs->darkmode;
$config->updated_at =  $configs->updated_at;
$config->created_at =  $configs->created_at;
$config->partai_logo =  $configs->partai_logo;
$config->date_overlimit =  $configs->date_overlimit;
$config->show_public =  $configs->show_public;
$config->show_terverifikasi =  $configs->show_terverifikasi;
$config->lockdown =  $configs->lockdown;
$config->multi_admin =  $configs->multi_admin;
$config->otonom =  $configs->otonom;
$config->dark_mode =  $configs->dark_mode;
$config->jumlah_multi_admin =  $configs->jumlah_multi_admin;
$config->jenis_pemilu =  $configs->jenis_pemilu;
$config->tahun =  $configs->tahun;
$config->quick_count =  $configs->quick_count;
$config->default =  $configs->default;

$regency = District::where('regency_id', $config->regencies_id)->get();
$kota = Regency::where('id', $config->regencies_id)->first();
$dpt = District::where('regency_id', $config->regencies_id)->sum('dpt');
$tps = Tps::count();
?>

<style>
    ul.breadcrumb {
        padding: 10px 16px;
        list-style: none;
        background-color: #0d6efd !important;
    }

    ul.breadcrumb li {
        display: inline;
        font-size: 18px;
    }

    ul.breadcrumb li+li:before {
        padding: 8px;
        color: white;
        content: "/\00a0";
    }

    ul.breadcrumb li a {

        text-decoration: none;
    }

    ul.breadcrumb li a:hover {
        color: #01447e;
        text-decoration: underline;
    }
</style>

<ul class="breadcrumb">
    <?php
        $desa = Village::where('id', $saksi->village_id)->first();
        $regency = Regency::where('id',(string) $config->regencies_id)->first();
        $kcamatan = District::where('id', (string)$desa->district_id)->first();
        ?>
    <li>{{$regency->name}}</li>
    <li>{{$kcamatan->name}}</li>
    <li>{{$desa->name}}</li>
    <li>TPS {{$saksi->number}}</li>

</ul>
<div class="col-12">
    <div class="card rounded-0 mb-0">
        <div class="card-body">
            
            <div class="row">
                <?php
                    use App\Models\User;
                ?>
                @if ($saksi['kecurangan'] == "yes" && $qrcode != null)
                <?php $scan_url = url('') . "/scanning-secure/" . (string)Crypt::encrypt($qrcode->nomor_berkas); ?>
                <div class="col-auto my-auto">
                    {!! QrCode::size(100)->generate( $scan_url); !!}
                </div>
                @else
                @endif
                <div class="col mt-2">
                    <div class="media">
                        @if ($user['profile_photo_path'] == NULL)
                        <img class="rounded-circle"
                            style="width: 100px; height: 100px; object-fit: cover; margin-right: 10px;"
                            src="https://ui-avatars.com/api/?name={{ $user['name'] }}&color=7F9CF5&background=EBF4FF">
                        @else
                        <img class="rounded-circle"
                            style="width: 100px; height: 100px; object-fit: cover; margin-right: 10px;" src="{{url("/storage/profile-photos/".$user['profile_photo_path']) }}">
                        @endif

                        <div class="media-body my-auto">
                            <h5 class="mb-0">{{ $user['name'] }}</h5>
                            NIK : {{ $user['nik'] }}
                            <div>TPS {{$saksi->number}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-auto pt-2 my-auto px-1">
                    <a href="https://wa.me/{{$user->no_hp}}" class="btn btn-success text-white"><i
                            class="fa-solid fa-phone"></i>
                        Hubungi</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12" style="height: 100vh; overflow: scroll">
    <center>
        <img width="100%" src="{{asset('')}}storage/{{$saksi->c1_images}}" data-magnify-speed="200" alt=""
            data-magnify-magnifiedwidth="2500" data-magnify-magnifiedheight="2500" class="img-fluid zoom"
            data-magnify-src="{{asset('')}}storage/{{$saksi->c1_images}}">
    </center>
</div>