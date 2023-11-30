<?php

use App\Models\Config;
use App\Models\District;
use App\Models\Regency;

$config = Config::all()->first();
use App\Models\Configs;
use App\Models\RegenciesDomain;
$configs = Config::all()->first();
$currentDomain = request()->getHttpHost();
if (isset(parse_url($currentDomain)['port'])) {
    $url = substr($currentDomain, 0, strpos($currentDomain, ':8000'));
}else{
    $url = $currentDomain;
}
$regency_id = RegenciesDomain::where('domain',"LIKE","%".$url."%")->first();
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

$kota = Regency::where('id', $config->regencies_id)->first();

?>

<!-- GLOBAL-LOADER -->
<div id="global-loader">
    <img src="{{url('/')}}/assets/images/loader.svg" class="loader-img" alt="Loader">
</div>
<!-- /GLOBAL-LOADER -->

<!-- PAGE -->
<div class="page">
    <div class="page-main">

        <!--APP-SIDEBAR-->
        <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
        <aside class="app-sidebar">
            <div class="side-header">
                <a class="header-brand1" href="{{url('')}}/administrator/index">
                <h3 class="text-dark">
                        <b>
                            {{$config['jenis_pemilu']}}  {{$config['tahun']}}
                        </b>
                    </h3>
                </a><!-- LOGO -->
            </div>
            <ul class="side-menu">
                <li class="my-2">
                    &nbsp;
                </li>
                <li class="mt-5">
                    <center>
                        <img src="{{asset('images/logo')}}/rekapitung_gold.png" style="width:120px;height:auto">
                    </center>
                </li>
                <li class="mt-3">
                    <span>
                        <a href="#" class="text-dark">
                            <center>
                                <b>{{$kota['name']}} <br>
                                    KELURAHAN {{$village['name']}}</b>
                            </center>
                        </a>
                    </span>
                </li>
                <li>
                    <h3>Main</h3>
                </li>
                @if(Request::segment(2) == "index")
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="#">
                        <i class="side-menu__icon fe fe-database"></i>
                        <span class="side-menu__label">Kelurahan</span>
                        <i class="angle fa fa-angle-right"></i>
                    </a>
                    <ul class="slide-menu">
                        @foreach($villages as $village)
                        <li><a href="{{$village->id}}" class="slide-item"> {{$village->name}}</a></li>
                        @endforeach

                    </ul>
                </li>
                @elseif(Request::segment(2) == "village")

                <li class="slide is-expanded">
                    <a class="side-menu__item" data-bs-toggle="slide" href="#">
                        <i class="side-menu__icon fe fe-database"></i>
                        <span class="side-menu__label">Keterangan Fitur</span>
                        <i class="angle fa fa-angle-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li><a href="#" class="slide-item c1saksi">C1 Saksi</a></li>
                        <li><a href="#" class="slide-item c1partai">C1 Partai</a></li>
                        <li><a href="#" class="slide-item c1saksipend">C1 Saksi (Pending)</a></li>
                        <li><a href="#" class="slide-item c1relawan">C1 Relawan</a></li>
                        <li><a href="#" class="slide-item c1relawanband">C1 Relawan (Banding)</a></li>
                        <li><a href="#" class="slide-item pengajuankoreksi">Pengajuan koreksi</a></li>
                        <li><a href="#" class="slide-item tpsdibatalkan">TPS Dibatalkan</a></li>
                        <li><a href="#" class="slide-item koreksiditolak">Koreksi Ditolak</a></li>
                        <li><a href="#" class="slide-item kecurangan">Kecurangan</a></li>

                    </ul>
                </li>
                @elseif(Request::segment(2) == "koreksidata")
                @endif
                <hr>
                <li>
                    <!-- <a class="side-menu__item" href="#"><i class="side-menu__icon mdi mdi-logout"></i><span class="side-menu__label">Logout</span></a> -->
                    <form action="{{ route('logout') }}" method="post">
                        @csrf


                        <a class="side-menu__item" onclick="$($(this).parent()).submit()" style="cursor: pointer">
                            <i class="side-menu__icon mdi mdi-logout"></i> Sign out
                        </a>
                    </form>
                </li>
            </ul>
        </aside>
        <!--/APP-SIDEBAR-->