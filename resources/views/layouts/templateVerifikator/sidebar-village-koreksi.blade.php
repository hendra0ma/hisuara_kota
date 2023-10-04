<?php

use App\Models\Config;
use App\Models\District;
use App\Models\Regency;
use App\Models\Village;
use App\Models\Tps;

$config = Config::all()->first();
$kota = Regency::where('id',(string)$config['regencies_id'])->first();
$district = District::where('regency_id',(string)$config['regencies_id'])->first();
$village = Village::where('district_id',(string)$district->id)->first();
$tps = Tps::where('district_id',(string)$district->id)->count();
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
            </div>
            <ul class="side-menu">
                <!-- <li class="my-2">
                    &nbsp;
                </li>
                <li class="mt-5">
                    <center>
                        <img src="{{asset('storage').'/'.$config['regencies_logo']}}" style="width:120px;height:auto">
                    </center>
                </li>
                <li class="mt-3">
                    <span>
                        <a href="#" class="text-dark">
                            <center>
                                <b>{{ $kota['name'] }} <br>
                                    {{$title}}<br>
                            </center>
                        </a>
                    </span>
                </li> -->
                <li class="mt-5">
                    <center>
                        <img src="{{asset('images/logo')}}/rekapitung_gold.png" style="width:120px;height:auto">
                    </center>
                </li>
                <li>
                    <h3>Main</h3>
                </li>
                   <li class="slide is-expanded">
                    <a class="side-menu__item" data-bs-toggle="slide" href="#">
                        <i class="side-menu__icon fe fe-database"></i>
                        <span class="side-menu__label">DPT - TPS {{$title2}}</span>
                        <i class="angle fa fa-angle-right"></i>
                    </a>
                    <ul class="slide-menu open">
                        <li><a href="#" class="slide-item">DPT {{$district->dpt}}</a></li>
                        <li><a href="#" class="slide-item">TPS {{$tps}}</a></li>
                    </ul>
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


                        <a class="side-menu__item" onclick="$($(this).parent()).submit()" style="cursor: pointer;">
                            <i class="side-menu__icon mdi mdi-logout"></i> Sign out
                        </a>
                    </form>
                </li>
            </ul>
        </aside>
        <!--/APP-SIDEBAR-->