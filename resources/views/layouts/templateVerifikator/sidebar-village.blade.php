<?php

use App\Models\Config;
use App\Models\District;
use App\Models\Regency;

$config = Config::all()->first();
$kota = Regency::where('id', $config['regencies_id'])->first();

$title = '';
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
                                <b>{{$kota['name']}} <br>
                                    KELURAHAN {{$village['name']}}</b>
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
                        <span class="side-menu__label">Jenis C1</span>
                        <i class="angle fa fa-angle-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li>
                            <button class="btn tablink w-100 rounded-0  slide-item" onclick="openPage('C1-Saksi', this)">C1 Saksi <span class="badge rounded-pill bg-danger">{{$count_suara}}</span></button>
                        </li>
                      
                        <li>
                            <button class="btn tablink w-100 rounded-0  slide-item" onclick="openPage('C1-Relawan', this)">C1 Relawan Partai</button>
                        </li>
                        <li>
                            <button class="btn tablink w-100 rounded-0  slide-item" onclick="openPage('C1-Saksi-Pending', this)" style="background-color: rgb(98, 89, 202);">C1
                                Saksi (Pending)</button>
                        </li>
                        <li>
                            <button class="btn tablink w-100 rounded-0  slide-item" onclick="openPage('Kecurangan', this)">Kecurangan <span class="badge rounded-pill bg-danger">{{$count_kecurangan}}</span></button>
                        </li>
                    </ul>
                </li>
                
                <li class="slide is-expanded">
                    <a class="side-menu__item" data-bs-toggle="slide" href="#">
                        <i class="side-menu__icon fe fe-database"></i>
                        <span class="side-menu__label">Keterangan Fitur</span>
                        <i class="angle fa fa-angle-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li><a href="#" class="slide-item c1saksi">C1 Saksi</a></li>
                    
                        <li><a href="#" class="slide-item c1saksipend">C1 Saksi (Pending)</a></li>
                        <li><a href="#" class="slide-item c1relawan">C1 Relawan Partai</a></li>
                        <!-- <li><a href="#" class="slide-item c1relawanband">C1 Relawan Partai (Banding)</a></li> -->
                        <li><a href="#" class="slide-item pengajuankoreksi">Pengajuan Koreksi</a></li>
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