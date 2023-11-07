<?php

use App\Models\Config;
use App\Models\District;
use App\Models\RegenciesDomain;
use App\Models\Regency;
use App\Models\SaksiData;
use App\Models\Tps;
use App\Models\Village;
use App\Models\User;
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
$regency_id = RegenciesDomain::where('domain', "LIKE", "%" . $url . "%")->first();

$config = new Configs;
$config->regencies_id =  (string) $regency_id->regency_id;
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

@extends('layouts.main-perhitungan');
@section('content')
<!-- PAGE-HEADER -->
<div class="row" style="margin-top: 90px; transition: all 0.5s ease-in-out;">



    <div class="col-lg-12">
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
            $desa = Village::where('id', $id_kelurahan)->select('name')->first();
            $regency = Regency::where('id', $config->regencies_id)->select('name')->first();
            $kcamatan = District::where('id', $desa->district_id)->select('name')->first();
            ?>
            <li><a href="{{url('')}}/administrator/index" class="text-white">{{$regency->name}}</a></li>
            <li><a href="{{url('')}}/administrator/perhitungan_kecamatan/{{Crypt::encrypt($district->id)}}" class="text-white">{{$district->name}}</a></li>
            <li><a href="{{url('')}}/administrator/perhitungan_kelurahan/{{Crypt::encrypt($id_kelurahan)}}" class="text-white">{{$desa->name}}</a></li>

        </ul>
    </div>

    <div class="col-lg-6" style="{{($config->quick_count == 'yes')?'':'display:none'}}">
        <div class="card" style="margin-bottom: 1rem">
            <div class="card-body" style="position: relative">
                <img src="{{asset('')}}assets/icons/hisuara_new.png" style="position: absolute; top: 25px; left: 25px; width: 100px" alt="">
                <div class="row">
                    <div class="col-12">
                        <div class="container">
                            <div class="text-center fs-3 mb-3 fw-bold">QUICK COUNT</div>
                            <div class="text-center">Progress {{substr($realcount,0,5)}}% dari 100%</div>
                            <div class="text-center mt-2 mb-2"><span class="badge bg-success">{{$total_incoming_vote}} /
                                    {{$dpt}}</span></div>
                            <div id="chart-pie2" style="height: 320px" class="chartsh h-100 w-100"></div>
                        </div>
                    </div>
                    <div class="col-xxl">
                        <div class="row mt-2">
                            <?php $i = 1; ?>
                            @foreach ($paslon as $pas)
                            <div class="col-lg col-md col-sm col-xl mb-3">
                                <div class="card" style="margin-bottom: 0px;">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mx-auto counter-icon box-shadow-secondary brround candidate-name text-white " style="margin-bottom: 0; background-color: {{$pas->color}};">
                                                    {{$i++}}
                                                </div>
                                            </div>
                                            <div class="col text-center">
                                                <h6 class="mt-4">{{$pas->candidate}} </h6>
                                                <h6 class="">{{$pas->deputy_candidate}} </h6>
                                                <?php
                                                $voice = 0;
                                                ?>
                                                @foreach ($pas->quicksaksidata as $dataTps)
                                                <?php
                                                $voice += $dataTps->voice;
                                                ?>
                                                @endforeach
                                                <h3 class="mb-2 number-font">{{ $voice }} suara</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="{{($config->otonom == 'yes')?'col-lg-12 col-md-12':'col-lg-6 col-md-12'}}">
        <div class="card">
            {{-- <div class="card-header bg-info">
                <h3 class="card-title text-white">Suara TPS Masuk</h3>
            </div> --}}
            <div class="card-body" style="position: relative;">
                <img src="{{asset('')}}assets/icons/hisuara_new.png" style="position: absolute; top: 25px; left: 25px; width: 100px" alt="">
                <div class="row">
                    <div class="col-12">
                        <div class="container">
                            <div class="text-center fs-3 mb-3 fw-bold">REAL COUNT</div>
                            <div class="text-center">Progress {{substr($realcount,0,5)}}% dari 100%</div>
                            <div class="text-center mt-2 mb-2"><span class="badge bg-success">{{$total_incoming_vote}} /
                                    {{$dpt}}</span></div>
                            <div id="chart-pie" style="height: 320px" class="chartsh h-100 w-100"></div>
                        </div>
                    </div>
                    <div class="col-xxl">
                        <div class="row mt-2">
                            <?php $i = 1; ?>
                            @foreach ($paslon as $pas)
                            <div class="col-lg col-md col-sm col-xl mb-3">
                                <div class="card" style="margin-bottom: 0px;">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mx-auto counter-icon box-shadow-secondary brround candidate-name text-white " style="margin-bottom: 0; background-color: {{$pas->color}};">
                                                    {{$i++}}
                                                </div>
                                            </div>
                                            <div class="col text-center">
                                                <h6 class="mt-4">{{$pas->candidate}} </h6>
                                                <h6 class="">{{$pas->deputy_candidate}} </h6>
                                                <?php
                                                $voice = 0;
                                                ?>
                                                @foreach ($pas->saksi_data as $dataTps)
                                                <?php
                                                $voice += $dataTps->voice;
                                                ?>
                                                @endforeach
                                                <h3 class="mb-2 number-font">{{ $voice }} suara</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @if ($config->quick_count == 'yes')
    <div class="col-lg-12 col-md" style="display:{{($config->otonom == 'yes')?'none':'block'}}">
        <div class="card">
            {{-- <div class="card-header bg-secondary">
                <h3 class="card-title text-white">Suara TPS Terverifikasi</h3>
            </div> --}}
            <div class="card-body" style="position: relative">
                <img src="{{asset('')}}assets/icons/hisuara_new.png" style="position: absolute; top: 25px; left: 25px; width: 100px" alt="">
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-12">
                                <div class="container">
                                    <div class="text-center fs-3 mb-3 fw-bold">SUARA TERVERIFIKASI</div>
                                    <div class="text-center">Terverifikasi {{$saksi_terverifikasi}} TPS dari
                                        {{$saksi_masuk}}
                                        TPS Masuk
                                    </div>
                                    <div class="text-center mt-2 mb-2"><span class="badge bg-success">{{$total_verification_voice}} / {{$dpt}}</span>
                                    </div>
                                    <div id="chart-donut" style="height: 320px" class="chartsh h-100 w-100"></div>
                                </div>
                            </div>
                            <div class="col-xxl">
                                <?php $i = 1; ?>
                                <div class="row mt-2">
                                    @foreach ($paslon_terverifikasi as $pas)
                                    <div class="col-lg col-md col-sm col-xl mb-3">
                                        <div class="card" style="margin-bottom: 0px;">
                                            <div class="card-body p-3">
                                                <div class="row me-auto">
                                                    <div class="col-12">
                                                        <div class="mx-auto counter-icon box-shadow-secondary brround candidate-name text-white ms-auto" style="margin-bottom: 0; background-color: {{$pas->color}};">
                                                            {{$i++}}
                                                        </div>
                                                    </div>
                                                    <div class="col text-center">
                                                        <h6 class="mt-4">{{$pas->candidate}} </h6>
                                                        <h6 class="">{{$pas->deputy_candidate}} </h6>
                                                        <?php
                                                        $voice = 0;
                                                        ?>
                                                        @foreach ($pas->saksi_data as $dataTps)
                                                        <?php
                                                        $voice += $dataTps->voice;
                                                        ?>
                                                        @endforeach
                                                        <h3 class="mb-2 number-font">{{ $voice }} suara</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @else
    <div class="col-lg-6 col-md" style="display:{{($config->otonom == 'yes')?'none':'block'}}">
        <div class="card">
            <div class="card-body" style="position: relative">
                <img src="{{asset('')}}assets/icons/hisuara_new.png" style="position: absolute; top: 25px; left: 25px; width: 100px" alt="">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="container">
                                    <div class="text-center fs-3 mb-3 fw-bold">SUARA TERVERIFIKASI</div>
                                    <div class="text-center">Terverifikasi {{$saksi_terverifikasi}} TPS dari
                                        {{$saksi_masuk}}
                                        TPS Masuk
                                    </div>
                                    <div class="text-center mt-2 mb-2"><span class="badge bg-success">{{$total_verification_voice}} / {{$dpt}}</span>
                                    </div>
                                    <div id="chart-donut" style="height: 320px" class="chartsh h-100 w-100"></div>
                                </div>
                            </div>
                            <div class="col-xxl">
                                <?php $i = 1; ?>
                                <div class="row mt-2">
                                    @foreach ($paslon_terverifikasi as $pas)
                                    <div class="col-lg col-md col-sm col-xl mb-3">
                                        <div class="card" style="margin-bottom: 0px;">
                                            <div class="card-body p-3">
                                                <div class="row me-auto">
                                                    <div class="col-12">
                                                        <div class="mx-auto counter-icon box-shadow-secondary brround candidate-name text-white ms-auto" style="margin-bottom: 0; background-color: {{$pas->color}};">
                                                            {{$i++}}
                                                        </div>
                                                    </div>
                                                    <div class="col text-center">
                                                        <h6 class="mt-4">{{$pas->candidate}} </h6>
                                                        <h6 class="">{{$pas->deputy_candidate}} </h6>
                                                        <?php
                                                        $voice = 0;
                                                        ?>
                                                        @foreach ($pas->saksi_data as $dataTps)
                                                        <?php
                                                        $voice += $dataTps->voice;
                                                        ?>
                                                        @endforeach
                                                        <h3 class="mb-2 number-font">{{ $voice }} suara</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endif


    <?php

    $currentDomain = request()->getHttpHost();
    if (isset(parse_url($currentDomain)['port'])) {
        $url = substr($currentDomain, 0, strpos($currentDomain, ':8000'));
    } else {
        $url = $currentDomain;
    }
    $regency_id = RegenciesDomain::where('domain', "LIKE", "%" . $url . "%")->first();

    if (request()->segment(1) == "administrator" && request()->segment(2) == "perhitungan_kecamatan") {
        $id_wilayah = Crypt::decrypt(request()->segment(3));
        $tipe_wilayah = "kecamatan";
    } elseif (request()->segment(1) == "administrator" && request()->segment(2) == "index") {
        $id_wilayah = $regency_id->regency_id;
        $tipe_wilayah = "kota";
    } else {
        $id_wilayah = Crypt::decrypt(request()->segment(3));
        $tipe_wilayah = "kelurahan";
    }

    ?>
    <livewire:dpt-pemilih-component :id_wilayah="$id_wilayah" :tipe_wilayah="$tipe_wilayah" />




</div>

{{-- <div class="row" style="margin-top: 90px; transition: all 0.5s ease-in-out;">
    <div class="col-lg-6 col-md-12">
        <div class="card">
            <div class="card-header bg-info-gradient">
                <h3 class="card-title text-white">Suara TPS Masuk</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md">
                        <div class="container" style="margin-left: 3%; margin-top: 10%;">
                            <div class="text-center">Progress {{substr($realcount,0,5)}}% dari 100%</div>
<div id="chart-pie" style="height: 320px" class="chartsh h-100 w-100"></div>
</div>
</div>
<div class="col-md">
    <?php

    $i = 1; ?>
    @foreach ($paslon as $pas)
    <div class="row mt-2">
        <div class="col-lg col-md col-sm col-xl mb-3">
            <div class="card" style="margin-bottom: 0px;">
                <div class="card-body">
                    <div class="row me-auto">
                        <div class="col-4">
                            <div class="counter-icon box-shadow-secondary brround candidate-name text-white " style="margin-bottom: 0; background-color: {{$pas->color}};">
                                {{$i++}}
                            </div>
                        </div>
                        <div class="col me-auto">
                            <h6 class="">{{$pas->candidate}} </h6>
                            <h6 class="">{{$pas->deputy_candidate}} </h6>
                            <?php
                            $voice = 0;
                            ?>
                            @foreach ($pas->saksi_data as $dataTps)
                            <?php
                            $voice += $dataTps->voice;
                            ?>
                            @endforeach
                            <h3 class="mb-2 number-font">{{ $voice }} suara</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
</div>

</div>
</div>
</div>

<div class="col-lg-6 col-md-12">
    <div class="card">
        <div class="card-header bg-secondary-gradient">
            <h3 class="card-title text-white">Suara Terverifikasi</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md">
                    <div class="container" style="margin-left: 3%; margin-top: 10%;">
                        <div class="text-center">Terverifikasi 6 TPS dari 1 TPS Masuk</div>
                        <div id="chart-donut" style="height: 320px" class="chartsh h-100 w-100"></div>
                    </div>
                </div>
                <div class="col-md">
                    <?php $i = 1; ?>
                    @foreach ($paslon_terverifikasi as $pas)
                    <div class="row mt-2">
                        <div class="col-lg col-md col-sm col-xl mb-3">
                            <div class="card" style="margin-bottom: 0px;">
                                <div class="card-body">
                                    <div class="row me-auto">
                                        <div class="col-4">
                                            <div class="counter-icon box-shadow-secondary brround candidate-name text-white ms-auto" style="margin-bottom: 0; background-color: {{$pas->color}};">
                                                {{$i++}}
                                            </div>
                                        </div>
                                        <div class="col me-auto">
                                            <h6 class="">{{$pas->candidate}} </h6>
                                            <h6 class="">{{$pas->deputy_candidate}} </h6>
                                            <?php
                                            $voice = 0;
                                            ?>
                                            @foreach ($pas->saksi_data as $dataTps)
                                            <?php
                                            $voice += $dataTps->voice;
                                            ?>
                                            @endforeach
                                            <h3 class="mb-2 number-font">{{ $voice }} suara</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
</div> --}}

<div class="row mt-3">

    <div class="col-md-12">
        <div class="container-fluid">
            <div class="tab">
                <div class="row">
                    <div class="col-md">
                        <button class="btn tablink w-100 rounded-0 text-dark" onclick="openPage('saksi-masuk', this, '#45aaf2')" id="defaultOpen">Suara TPS Masuk</button>
                    </div>
                    <div class="col-md">
                        <button class="btn tablink w-100 rounded-0 text-dark" onclick="openPage('saksi-terverifikasi', this, '#f7b731')">Suara TPS Terverifikasi</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="saksi-masuk" class="tabcontent">
            <div class="card">
                <div class="card-header">
                    <h5 class="cart-title mx-auto text-center fw-bold my-auto">Suara TPS Masuk (Kelurahan {{$district['name']}})</h5>
                </div>
                <div class="card-body">

                    <!-- 1st card -->
                    <table class="table table-bordered table-hover">
                        <thead style="background-color: #45aaf2;">
                            <tr>
                                <th class="align-middle text-white text-center align-middle" rowspan="2">Tps</th>
                                @foreach ($paslon_candidate as $item)
                                <th class="text-white text-center align-middle">{{ $item['candidate']}} - {{ $item['deputy_candidate']}}</th>
                                @endforeach

                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($tps_kel as $item)


                            <tr data-id="{{$item['id']}}" data-bs-toggle="modal" class="modal-id" data-bs-target="#modal-id">
                                <td> <a href="{{url('')}}/administrator/perhitungan_tps/{{Crypt::encrypt($item->id)}}" class="modal-id text-dark" style="font-size: 0.8em;" id="Cek">TPS {{$item['number']}}</a>
                                    @foreach ($paslon_candidate as $cd)

                                    <?php
                                    $tpsass = \App\Models\Tps::where('number', (string)$item['number'])->where('villages_id', (string)$id)->first(); ?>
                                    <?php $saksi_data = \App\Models\SaksiData::join('saksi', 'saksi.id', '=', 'saksi_data.saksi_id')->where('paslon_id', $cd['id'])->where('tps_id', $tpsass->id)->sum('voice'); ?>
                                <td>{{$saksi_data}}</td>

                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="saksi-terverifikasi" class="tabcontent">
            <div class="card">
                <div class="card-header">
                    <h5 class="cart-title mx-auto text-center fw-bold my-auto">Suara TPS Terverifikasi (Kelurahan {{$district['name']}})</h5>
                </div>
                <div class="card-body">

                    <!-- 1st card -->
                    <table class="table table-bordered table-hover">
                        <thead style="background-color: #f7b731;">
                            <tr>
                                <th class="text-white text-center align-middle" rowspan="2">Tps</th>
                                @foreach ($paslon_candidate as $item)
                                <th class="text-white text-center align-middle">{{ $item['candidate']}} - {{ $item['deputy_candidate']}}</th>
                                @endforeach

                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($tps_kel as $item)


                            <tr data-id="{{$item['id']}}" data-bs-toggle="modal" class="modal-id" data-bs-target="#modal-id">
                                <td> <a href="={{url('')}}/administrator/perhitungan_tps/{{Crypt::encrypt($item->id)}}" class="modal-id text-dark" style="font-size: 0.8em;" id="Cek">TPS {{$item['number']}}</a>
                                    @foreach ($paslon_candidate as $cd)

                                    <?php
                                    $tpsass = \App\Models\Tps::where('number', (string)$item['number'])->where('villages_id', (string)$id)->first(); ?>
                                    <?php $saksi_data = \App\Models\SaksiData::join('saksi', 'saksi.id', '=', 'saksi_data.saksi_id')->where('verification', 1)->where('paslon_id', $cd['id'])->where('tps_id', $tpsass->id)->sum('voice'); ?>
                                <td>{{$saksi_data}}</td>

                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function openPage(pageName, elmnt, color) {
        var i, tabcontent, tablinks;

        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";

        }
        tablinks = document.getElementsByClassName("tablink");
        let darkmode = document.body.className.split(' ');

        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].style.backgroundColor = "";
            (darkmode.length == 3) ? tablinks[i].style.color = "white": tablinks[i].style.color = "black";
        }

        document.getElementById(pageName).style.display = "block";




        elmnt.style.backgroundColor = color;
        elmnt.style.color = 'white';
    }
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>

<!-- SWEET-ALERT JS -->
<script src="../../assets/plugins/sweet-alert/sweetalert.min.js"></script>
<script src="../../assets/js/sweet-alert.js"></script>

<script>
    $('.c1saksi').click(function() {
        $('body').removeClass('timer-alert');
        swal({
            title: "C1 Saksi",
            text: "C1 Saksi adalah hasil perhitungan suara di TPS yang dikirimkan oleh saksi resmi partai.",
            type: "warning",
            confirmButtonText: 'Ok',
        });
    })
</script>

<script>
    $('.c1relawan').click(function() {
        $('body').removeClass('timer-alert');
        swal({
            title: "C1 Relawan",
            text: "C1 Relawan adalah hasil perhitungan suara di TPS yang dikirimkan oleh relawan.",
            type: "warning",
            confirmButtonText: 'Ok',
        });
    })
</script>

<script>
    $('.c1saksipend').click(function() {
        $('body').removeClass('timer-alert');
        swal({
            title: "C1 Saksi (Pending)",
            text: "C1 Saksi (Pending) adalah kiriman data TPS dari saksi yang tertahan karena adanya data C1 dari TPS yang sama telah dikirimkan oleh Relawan setempat. Hal ini biasanya terjadi karena C1 Saksi terlambat dikirimkan dan atau tidak adanya Saksi di TPS tersebut.",
            type: "warning",
            confirmButtonText: 'Ok',
        });
    })
</script>

<script>
    $('.c1relawanband').click(function() {
        $('body').removeClass('timer-alert');
        swal({
            title: "C1 Relawan (Banding)",
            text: "C1 Banding adalah data C1 yang berbeda di TPS yang sama. Kiriman C1 Banding berasal dari masyarakat / relawan untuk dibandingkan dengan C1 Saksi.",
            type: "warning",
            confirmButtonText: 'Ok',
        });
    })
</script>
<!-- CONTAINER END -->
</div>

</div>

<!-- Modal -->
<div class="modal fade" id="periksaModal1" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Foto C1 Plano</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <a>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12"><img width="550px" src="https://demo.tangsel.pilwalkot.rekapitung.id/assets/upload/c1plano.jpg" class="zoom" data-magnify-src="https://demo.tangsel.pilwalkot.rekapitung.id/assets/upload/c1plano.jpg">
                        </div>
                    </div>
                    <form>
                        <div class="row justify-content-between mt-4 mb-4">
                            <div class="col-md-3 text-center">
                                <label for="suara01 w-100">Suara 01</label>
                                <input class="form-control" type="text" value="12" size="10" disabled>
                            </div>
                            <div class="col-md-3 text-center">
                                <label for="suara02">Suara 02</label>
                                <input class="form-control" type="text" value="23" size="10" disabled>
                            </div>
                            <div class="col-md-3 text-center">
                                <label for="suara03">Suara 03</label>
                                <input class="form-control" type="text" value="0" size="10" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="jumlahsuarasah">Jumlah Suara Sah :</label>
                                <input class="form-control" id="jumlahsuarasah" type="text" value="35" size="10" disabled>
                            </div>
                        </div>
                    </form>
                </div>
            </a>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="periksaModal2" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Foto C2 Plano</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <a>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12"><img width="550px" src="https://demo.tangsel.pilwalkot.rekapitung.id/assets/upload/c1plano.jpg" class="zoom" data-magnify-src="https://demo.tangsel.pilwalkot.rekapitung.id/assets/upload/c1plano.jpg">
                        </div>
                    </div>
                    <form>
                        <div class="row justify-content-between mt-4 mb-4">
                            <div class="col-md-3 text-center">
                                <label for="suara01 w-100">Suara 01</label>
                                <input class="form-control" type="text" value="12" size="10" disabled>
                            </div>
                            <div class="col-md-3 text-center">
                                <label for="suara02">Suara 02</label>
                                <input class="form-control" type="text" value="23" size="10" disabled>
                            </div>
                            <div class="col-md-3 text-center">
                                <label for="suara03">Suara 03</label>
                                <input class="form-control" type="text" value="0" size="10" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="jumlahsuarasah">Jumlah Suara Sah :</label>
                                <input class="form-control" id="jumlahsuarasah" type="text" value="35" size="10" disabled>
                            </div>
                        </div>
                    </form>
                </div>
            </a>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



@endsection