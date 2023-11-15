@extends('layouts.mainlayout')

@section('content')
<?php

use App\Models\Config;
use App\Models\Configs;
use App\Models\District;
use App\Models\RegenciesDomain;
use App\Models\Regency;
use App\Models\SaksiData;
use App\Models\Tps;
use App\Models\Village;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

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

<style>
    .open-desktop {
        display: block;
    }

    @media (max-width: 1680px) {

        .open-desktop {
            display: none;
        }

        .break-point-1 {
            flex: 0 0 50%;
            max-width: 50%;
        }

        .break-point-2 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }

    @media (max-width: 1024px) {

        .open-desktop {
            display: none;
        }

        .break-point-1 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .break-point-2 {
            flex: 0 0 100%;
            max-width: 100%;
        }

    }
</style>

<div class="row" style="margin-top: 90px; transition: all 0.5s ease-in-out;">

    {{-- <div class="col-md-auto pe-0 my-auto">
        <img src="{{asset('')}}storage/{{$config->regencies_logo}}" style="width: 80px" alt="">
    </div>
    <div class="col-lg-11 ps-2 mb-3">
        <h1 class="page-title fs-1 mt-2">PILPRES 2024
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">{{ $kota->name }}
                <!-- Kota -->
            </li>
        </ol>
    </div> --}}
    {{-- <div class="col-lg-6 text-end">
        <div class="row mx-auto text-center">
            <div class="col-md me-auto">
                <div class="row">
                    <div class="col my-auto text-center">
                        <h3 class="mb-0">Indikator</h3>
                    </div>

                    <div class="col-auto mt-2">
                        <div class="card" style="margin-bottom: 0px; background: transparent">
                            <div class="card-body text-center" style="padding: 0px;">
                                <i class="fe fe-user fs-4"></i>
                            </div>
                            <div class="card-footer text-center" style="color: black; padding: 0px;">
                                @if ($jam > 8 && $jam < 21) <div class="badge bg-success">Saksi : Aktif</div>
                            @else
                            <div class="badge bg-danger">Saksi : Nonaktif</div>
                            @endif
                        </div>
                    </div>
                    <h5 style="font-size:13px" class="text-center mt-3">09.00 - 21.00</h5>
                </div>
                <div class="col-auto mt-2">
                    <div class="card" style="margin-bottom: 0px; background: transparent">
                        <div class="card-body text-center" style="padding: 0px;">
                            <i class="fe fe-user fs-4"></i>
                        </div>
                        <div class="card-footer text-center" style="color: black; padding: 0px;">

                            @if ($jam > 14 && $jam < 21) <div class="badge bg-success">Relawan :
                                aktif</div>
                        @else
                        <div class="badge bg-danger">Relawan : Nonaktif</div>
                        @endif
                    </div>
                </div>
                <h5 style="font-size:13px" class="text-center mt-3">14.00 - 21.00</h5>
            </div>
            <div class="col-auto mt-2">
                <div class="card" style="margin-bottom: 0px; background: transparent">
                    <div class="card-body text-center" style="padding: 0px;">
                        <i class="fe fe-user fs-4"></i>
                    </div>
                    <div class="card-footer text-center" style="color: black; padding: 0px;">
                        @if ($jam >= 21)
                        <div class="badge bg-success">Overtime : Aktif</div>
                        @else
                        <div class="badge bg-danger">Overtime : Nonaktif</div>
                        @endif
                    </div>
                </div>
                <h5 style="font-size:13px" class="text-center mt-3">21.00 - dst</h5>
            </div>
            <div class="col-auto my-auto">
                <a href="https://time.is/Jakarta" id="time_is_link" rel="nofollow" style="font-size:25px">
                </a>
                <span id="Jakarta_z41c" style="font-size:27px"></span>
                <span style="font-size:27px; margin-left: 5px;">WIB</span>
                <script src="//widget.time.is/t.js"></script>
                <script>
                    time_is_widget.init({
                            Jakarta_z41c: {}
                        });
                </script>
            </div>
        </div>


    </div>
</div>
</div> --}}

<div class="col-lg col-md">
    <div class="row g-0">
        <div class="col-md">

            {{-- <div class="row mt-3">
                <div class="col-lg-3 col-md-6 break-point-1">
                    <div class="row g-0">
                        <div class="col-md-4">

                            <img src="{{asset('assets/images/brand/logo_gold.png')}}" class="img-fluid">
                        </div>
                        <div class="col-md-8">

                            <h1 class="page-title fs-3 mt-2">DASHBOARD HISUARA
                            </h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $kota['name'] }}
                                    <!-- Kota -->
                                </li>
                            </ol>
                        </div>
                    </div>


                    @if ($config->multi_admin == 'yes')
                    //
                    <?php
    //$userOnline = User::where('role_id', 1)->count();
    //$jumlahOrang = 0;
    // foreach($userOnline as $user){
    //     if(Cache::has('is_online' . $user->id)){
    //         $jumlahOrang +=1;
    //     }
    // }
    //
    ?>
                    <h4 class="fs-4 mt-2 fw-bold">Multi Administator ({{ $userOnline }}) </h4> <!-- This Dummy Data -->
                    @else
                    <h4 class="fs-4 mt-2 fw-bold">Multi Administator (1) </h4> <!-- This Dummy Data -->
                    @endif
                    <h5>
                        {{ Auth::user()->name }}
                    </h5>
                </div>

                <div class="col-lg-9 col-xxl-0 justify-content-end mt-2 break-point-1">
                    <div class="row">


                        <div class="col open-desktop">

                            <div class="">
                                <div class="card" style="margin-bottom: 0px;">
                                    <div class="card-body" style="padding: 5px; padding-bottom: 0px">
                                        <div class="card-header text-center" style="padding: 0px; padding-bottom: 10px">
                                            <div class="card-title mx-auto">

                                                Mode Sistem <i class="fa fa-question-circle" data-bs-placement="top"
                                                    data-bs-toggle="tooltip" title=""
                                                    data-bs-original-title="Mode sistem adalah status sistem HISUARA yang dibagi menjadi tiga bagian, yaitu : mode saksi, mode relawan dan mode overtime (Antisipasi Hacker). Ketiga mode ini berjalan pada hari yang sama dengan pembagian waktu yang telah di tetapkan."></i>
                                            </div>
                                        </div>
                                        <div class="row mx-auto text-center">
                                            <div class="col-xxl-3 my-auto">
                                                <a href="https://time.is/Jakarta" id="time_is_link" rel="nofollow"
                                                    style="font-size:25px"></a>
                                                <span id="Jakarta_z41c" style="font-size:27px"></span>
                                                <div style="font-size:27px">WIB</div>
                                                <script src="//widget.time.is/t.js"></script>
                                                <script>
                                                    time_is_widget.init({
                                        Jakarta_z41c: {}
                                    });
                                                </script>
                                            </div>
                                            <div class="col-md me-auto">
                                                <div class="row">

                                                    <div class="col mt-2">
                                                        <div class="card" style="margin-bottom: 0px;">
                                                            <div class="card-body text-center" style="padding: 0px;">
                                                                <i class="fe fe-user fs-4"></i>
                                                            </div>
                                                            <div class="card-footer text-center"
                                                                style="color: black; padding: 0px">
                                                                @if ($jam > 8 && $jam < 21) <div
                                                                    class="badge bg-success">Saksi :
                                                                    Aktif</div>
                                                            @else
                                                            <div class="badge bg-danger">Saksi : Nonaktif</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <h5 style="font-size:13px" class="text-center mt-3">09.00 - 21.00
                                                    </h5>
                                                </div>
                                                <div class="col mt-2">
                                                    <div class="card" style="margin-bottom: 0px;">
                                                        <div class="card-body text-center" style="padding: 0px;">
                                                            <i class="fe fe-user fs-4"></i>
                                                        </div>
                                                        <div class="card-footer text-center"
                                                            style="color: black; padding: 0px">

                                                            @if ($jam > 14 && $jam < 21) <div class="badge bg-success">
                                                                Relawan :
                                                                aktif</div>
                                                        @else
                                                        <div class="badge bg-danger">Relawan : Nonaktif</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <h5 style="font-size:13px" class="text-center mt-3">14.00 - 21.00</h5>
                                            </div>
                                            <div class="col mt-2">
                                                <div class="card" style="margin-bottom: 0px;">
                                                    <div class="card-body text-center" style="padding: 0px;">
                                                        <i class="fe fe-user fs-4"></i>
                                                    </div>
                                                    <div class="card-footer text-center"
                                                        style="color: black; padding: 0px">
                                                        @if ($jam >= 21)
                                                        <div class="badge bg-success">Overtime : Aktif</div>
                                                        @else
                                                        <div class="badge bg-danger">Overtime : Nonaktif</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <h5 style="font-size:13px" class="text-center mt-3">21.00 - dst</h5>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>




                <div class="col-lg-6 col-md-6 justify-content-end  break-point-2">
                    <div class="card" style="margin-bottom: 0px;">
                        <div class="card-body">
                            <div class="row mx-auto">
                                <div class="col-3 ">
                                    <div class="counter-icon box-shadow-secondary brround candidate-name text-white bg-danger"
                                        style="margin-bottom: 0;">
                                        1
                                    </div>
                                </div>
                                <div class="col me-auto">
                                    <h6 class="">Suara Tertinggi</h6>
                                    <h3 class="mb-2 number-font">{{ $paslon_tertinggi['candidate'] }} /
                                        {{ $paslon_tertinggi['deputy_candidate'] }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-lg-8 justify-content-end mt-2">
            <div class="row">
                <div class="col-lg-4 justify-content-end">
                    <div class="card">
                        <div class="card-header bg-secondary">
                            <div class="card-title text-white">Real Count</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header bg-success">
                                <div class="card-title text-white">TPS Masuk</div>
                            </div>
                            <div class="card-body">
                                <p class="">{{ $total_verification_voice }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header bg-primary">
                                <div class="card-title text-white">Suara Masuk</div>
                            </div>
                            <div class="card-body">
                                <p class="">{{ $total_incoming_vote }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header bg-success">
                            <div class="card-title text-white">TPS Masuk</div>
                        </div>
                        <div class="card-body">
                            <p class="">{{ $total_verification_voice }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <div class="card-title text-white">Suara Masuk</div>
                        </div>
                        <div class="card-body">
                            <p class="">{{ $total_incoming_vote }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>



    @if($config->multi_admin == "yes")
    //
    <?php
// $userOnline = User::where('role_id',1)->count();
// $jumlahOrang = 0;
// foreach($userOnline as $user){
//     if(Cache::has('is_online' . $user->id)){
//         $jumlahOrang +=1;
//     }
// }
// 
?>
    <h4 class="fs-4 mt-2 fw-bold">Multi Administator ({{$userOnline}}) </h4> <!-- This Dummy Data -->
    @else
    <h4 class="fs-4 mt-2 fw-bold">Multi Administator (1) </h4> <!-- This Dummy Data -->

    @endif
    <h5>
        {{Auth::user()->name}}
    </h5>
</div>

<div class="col-lg-9 col-xxl-0 justify-content-end mt-2 break-point-1">
    <div class="row">


        <div class="col open-desktop">

            <div class="">
                <div class="card" style="margin-bottom: 0px;">
                    <div class="card-body" style="padding: 5px; padding-bottom: 0px">
                        <div class="card-header text-center" style="padding: 0px; padding-bottom: 10px">
                            <div class="card-title mx-auto">

                                Mode Sistem <i class="fa fa-question-circle" data-bs-placement="top"
                                    data-bs-toggle="tooltip" title=""
                                    data-bs-original-title="Mode sistem adalah status sistem HISUARA yang dibagi menjadi tiga bagian, yaitu : mode saksi, mode relawan dan mode overtime (Antisipasi Hacker). Ketiga mode ini berjalan pada hari yang sama dengan pembagian waktu yang telah di tetapkan."></i>
                            </div>
                            <div id="chart-pie" class="chartsh h-100 w-100"></div>
                        </div>
                    </div>
                    <div class="col-xxl-6">
                        <?php $i = 1; ?>
                        @foreach ($paslon as $pas)
                        <div class="row mt-2">
                            <div class="col-lg col-md col-sm col-xl mb-3">
                                <div class="card" style="margin-bottom: 0px;">
                                    <div class="card-body">
                                        <div class="row me-auto">
                                            <div class="col-4">
                                                <div class="counter-icon box-shadow-secondary brround candidate-name text-white "
                                                    style="margin-bottom: 0; background-color: {{ $pas->color }};">
                                                    {{ $i++ }}
                                                </div>
                                            </div>
                                            <div class="col me-auto">
                                                <h6 class="">{{ $pas->candidate }} </h6>
                                                <h6 class="">{{ $pas->deputy_candidate }} </h6>
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

    <div class="col-lg-6 col-md-12" style="display:{{ $config->otonom == 'yes' ? 'none' : 'block' }}">
        <div class="card">
            <div class="card-header bg-secondary-gradient">
                <h3 class="card-title text-white">Suara TPS Terverifikasi</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xxl-6">
                        <div class="container" style="margin-left: 3%; margin-top: 2.5%;">
                            <div class="text-center fs-3 mb-3 fw-bold">SUARA TERVERIFIKASI</div>
                            <div class="text-center">Terverifikasi {{ $saksi_terverifikasi }} TPS dari
                                {{ $saksi_masuk }} TPS Masuk
                            </div>
                            <div class="text-center mt-2 mb-2"><span class="badge bg-success">{{
                                    $total_verification_voice }} /
                                    {{ $dpt }}</span></div>
                            <div id="chart-donut" class="chartsh h-100 w-100"></div>
                        </div>
                    </div>
                    <div class="col-xxl-6">
                        <?php $i = 1; ?>
                        @foreach ($paslon_terverifikasi as $pas)
                        <div class="row mt-2">
                            <div class="col-lg col-md col-sm col-xl mb-3">
                                <div class="card" style="margin-bottom: 0px;">
                                    <div class="card-body">
                                        <div class="row me-auto">
                                            <div class="col-4">
                                                <div class="counter-icon box-shadow-secondary brround candidate-name text-white ms-auto"
                                                    style="margin-bottom: 0; background-color: {{ $pas->color }};">
                                                    {{ $i++ }}
                                                </div>
                                            </div>
                                            <div class="col me-auto">
                                                <h6 class="">{{ $pas->candidate }} </h6>
                                                <h6 class="">{{ $pas->deputy_candidate }} </h6>
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
</div>

<div class="row">
    <div class="{{ $config->otonom == 'yes' ? 'col-lg-12 col-md-12' : 'col-lg-6 col-md-12' }}">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Suara TPS Masuk (

                    Seluruh Kecamatan)</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="bg-primary">
                        <tr>
                            <th class="text-white text-center align-middle">KECAMATAN</th>
                            @foreach ($paslon as $item)
                            <th class="text-white text-center align-middle">{{ $item['candidate'] }} - <br>
                                {{ $item['deputy_candidate'] }}
                            </th>
                            @endforeach

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($kec as $item)
                        <tr onclick='check("{{ Crypt::encrypt($item->id) }}")'>
                            <td><a
                                    href="{{ url('/') }}/administrator/perhitungan_kecamatan/{{ Crypt::encrypt($item['id']) }}">{{
                                    $item['name'] }}</a>
                            </td>
                            @foreach ($paslon as $cd)
                            <?php $saksi_dataa = SaksiData::join('saksi', 'saksi.id', '=', 'saksi_data.saksi_id')
                                ->where('paslon_id', $cd['id'])
                                ->where('saksi_data.district_id', $item['id'])
                                ->sum('voice'); ?>
                            <td>{{ $saksi_dataa }}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>

                    <script>
                        let check = function(id) {
                            window.location = `{{ url('/') }}/administrator/perhitungan_kecamatan/${id}`;
                        }
                    </script>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-12" style="display:{{ $config->otonom == 'yes' ? 'none' : 'block' }}">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Suara TPS Terverifikasi (Seluruh Kecamatan)</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="bg-primary">
                        <td class="text-white text-center align-middle">KECAMATAN</td>
                        @foreach ($paslon as $item)
                        <th class="text-white text-center align-middle">{{ $item['candidate'] }} - <br>
                            {{ $item['deputy_candidate'] }}
                        </th>
                        @endforeach
                    </thead>
                    <tbody>
                        @foreach ($kec as $item)
                        <tr onclick='check("{{ Crypt::encrypt($item->id) }}")'>
                            <td><a
                                    href="{{ url('/') }}/administrator/perhitungan_kecamatan/{{ Crypt::encrypt($item['id']) }}">{{
                                    $item['name'] }}</a>
                            </td>
                            @foreach ($paslon as $cd)
                            <?php $saksi_dataa = SaksiData::join('saksi', 'saksi.id', '=', 'saksi_data.saksi_id')
                                ->where('paslon_id', $cd['id'])
                                ->where('saksi_data.district_id', $item['id'])
                                ->where('saksi.verification', 1)
                                ->sum('voice'); ?>
                            <td>{{ $saksi_dataa }}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="card-title">Tabulasi ({{ ucwords(strtolower($kota->name)) }})</div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg justify-content-end">
                <div class="card">
                    <div class="card-header bg-secondary">
                        <div class="card-title text-white">Total TPS</div>
                    </div>
                    <div class="card-body">
                        <h3 class="">{{ $total_tps }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="card">
                    <div class="card-header bg-danger">
                        <div class="card-title text-white">TPS Masuk</div>
                    </div>
                    <div class="card-body">
                        <h3 class="">{{ $tps_masuk }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="card-title text-white">TPS Kosong</div>
                    </div>
                    <div class="card-body">
                        <h3 class="">{{ $tps_kosong }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="card">
                    <div class="card-header bg-cyan">
                        <div class="card-title text-white">Suara Masuk</div>
                    </div>
                    <div class="card-body">
                        <h3 class="">{{ $suara_masuk }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="card">
                    <div class="card-header bg-success">
                        <div class="card-title text-white">Suara Terverifikasi</div>
                    </div>
                    <div class="card-body">
                        <h3 class="">{{ $total_verification_voice }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div> --}}

<style>
    .col.judul {
        display: flex;
        padding-top: 10px;
        padding-bottom: 10px;
        position: relative;
    }

    .col.judul .text {
        margin: auto;
    }

    .arrow-nav {
        border: 0;
        background: transparent;
    }

    .custom-prev {
        position: absolute;
        top: 7.5px;
        left: 0px;
    }

    .custom-next {
        position: absolute;
        top: 7.5px;
        right: 0px;
    }

    .carousel-item {
        transition: -webkit-transform .6s ease;
        transition: transform .6s ease;
        transition: transform .6s ease, -webkit-transform .6s ease;
    }

    .urutan-suara {
        position: absolute;
    }

    .urutan-suara::after {
        border-top: 1px black solid;
    }

    .urutan-suara:nth-child(1) {
        left: 50%;
        transform: translateX(-50%);
    }

    .urutan-suara:nth-child(2) {
        left: 0;
        top: 30px;
    }

    .urutan-suara:nth-child(3) {
        right: 0;
        top: 60px;
    }

    .chart-teks {
        color: white;
        z-index: 19;
    }
</style>
<div class="row">

    {{-- <div class="col-md-3 mb-4 pe-1">
        <div class="card mb-0">
            <div class="card-header py-1">
                <div class="card-title mx-auto">Settings</div>
            </div>
            <div class="card-body p-4">
                <div class="row justify-content-center px-5 my-auto">
                    <div class="col-auto mb-2">
                        <div class="mid">

                            <label class="switch">
                                <input type="checkbox" {{($config->default == "yes")?'disabled':''}} data-target="mode"
                                onclick="settings('multi_admin',this)"
                                {{($config->multi_admin == "no") ? "":"checked"; }}>
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="text-center" style="font-size:13px">
                            Multi
                        </div>
                    </div>

                    <div class="col-auto mb-2">
                        <div class="mid">

                            <label class="switch">
                                <input type="checkbox" data-target="mode" onclick="settings('otonom',this)"
                                    {{($config->otonom == "no") ? "":"checked"; }}>
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="text-center" style="font-size:13px">
                            Otonom
                        </div>
                    </div>

                    <div class="col-auto mb-2">
                        <div class="mid">
                            <label class="switch">
                                <input type="checkbox" {{($config->default == "yes")?'disabled':''}} data-target="mode"
                                onclick="settings('show_terverifikasi',this)" {{($config->show_terverifikasi == "hide")
                                ? "":"checked"; }}>
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="text-center" style="font-size:13px">
                            Verifikasi
                        </div>
                    </div>

                    <div class="col-auto mb-2">
                        <div class="mid">
                            <label class="switch">
                                <input type="checkbox" {{($config->default == "yes")?'disabled':''}} data-target="mode"
                                onclick="settings('show_public',this)" {{($config->show_public == "hide") ?
                                "":"checked"; }}>
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="text-center" style="font-size:13px">
                            Publish C1
                        </div>
                    </div>

                    <div class="col-auto mb-2">
                        <div class="mid">

                            <label class="switch">
                                <input type="checkbox" {{($config->default == "yes")?'disabled':''}} data-target="mode"
                                onclick="settings('lockdown',this)" {{($config->lockdown == "no") ? "":"checked"; }}>
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="text-center" style="font-size:13px">
                            Lockdown
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <div class="col-md-5 mb-4 px-1">
        <div class="card mb-0">
            <div class="card-header w-100 py-1" style="display: block">
                <div class="card-title">
                    <div class="row text-center" style="font-weight: 900">
                        <div class="col-4">1</div>
                        <div class="col-4">2</div>
                        <div class="col-4">3</div>
                    </div>
                </div>
            </div>
            <div class="card-body" style="padding: 26px">
                <div class="row">
                    @foreach ($urutan as $urutPaslon)
                    <?php $pasangan = App\Models\Paslon::where('id', $urutPaslon->paslon_id)->first(); ?>
                    <div class="col-md">
                        <div class="card shadow text-center mb-0">
                            <div class="card-header py-4 px-0" style="background: {{ $pasangan->color }}">
                                <h3 class="card-title text-white mx-auto">{{ $pasangan->candidate }} || {{
                                    $pasangan->deputy_candidate }} </h3>
                            </div>
                            <div class="card-body p-1">
                                <div class="fs-4">{{$urutPaslon->total}}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <div class="col-md-4 mb-4 ps-1">
        <div class="card mb-0">
            <div class="card-header py-1">
                <div class="card-title mx-auto">Tabulasi ({{ ucwords(strtolower($kota->name)) }})</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col py-1 judul text-center bg-secondary text-white"
                        style="border-top-left-radius: 25px; border-bottom-left-radius: 25px">
                        <div class="text">Total TPS</div>
                    </div>
                    <div class="col py-1 judul text-center bg-danger text-white">
                        <div class="text">TPS Masuk</div>
                    </div>
                    <div class="col py-1 judul text-center bg-primary text-white">
                        <div class="text">TPS Kosong</div>
                    </div>
                    <div class="col py-1 judul text-center bg-info text-white">
                        <div class="text">Suara Masuk</div>
                    </div>
                    <div class="col py-1 judul text-center bg-success text-white"
                        style="border-top-right-radius: 25px; border-bottom-right-radius: 25px">
                        <div class="text">Suara Terverifikasi</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col h3 text-center">
                        <h3 class="mb-0 py-1">{{ $total_tps }}</h3>
                    </div>
                    <div class="col h3 text-center">
                        <h3 class="mb-0 py-1">{{ $tps_masuk }}</h3>
                    </div>
                    <div class="col h3 text-center">
                        <h3 class="mb-0 py-1">{{ $tps_kosong }}</h3>
                    </div>
                    <div class="col h3 text-center">
                        <h3 class="mb-0 py-1">{{ $suara_masuk }}</h3>
                    </div>
                    <div class="col h3 text-center">
                        <h3 class="mb-0 py-1">{{$total_verification_voice}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}



</div>

{{-- <div class="card mb-0 mt-3">
    <div class="card-header">
        <div class="card-title">Tabulasi ({{ ucwords(strtolower($kota->name)) }})</div>
        s
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg justify-content-end">
                <div class="card mb-0">
                    <div class="card-header bg-secondary">
                        <div class="card-title text-white">Total TPS</div>
                    </div>
                    <div class="card-body">
                        <h3 class="">{{ $total_tps }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="card mb-0">
                    <div class="card-header bg-danger">
                        <div class="card-title text-white">TPS Masuk</div>
                    </div>
                    <div class="card-body">
                        <h3 class="">{{ $tps_masuk }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="card mb-0">
                    <div class="card-header bg-primary">
                        <div class="card-title text-white">TPS Kosong</div>
                    </div>
                    <div class="card-body">
                        <h3 class="">{{ $tps_kosong }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="card mb-0">
                    <div class="card-header bg-cyan">
                        <div class="card-title text-white">Suara Masuk</div>
                    </div>
                    <div class="card-body">
                        <h3 class="">{{ $suara_masuk }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="card mb-0">
                    <div class="card-header bg-success">
                        <div class="card-title text-white">Suara Terverifikasi</div>
                    </div>
                    <div class="card-body">
                        <h3 class="">{{$total_verification_voice}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="row">

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
            <?php $regency =Regency::where('id',$config->regencies_id)->select('name')->first(); ?>
            <li><a href="" class="text-white">{{$regency->name}}</a></li>

        </ul>
    </div>

    <div class="col-lg-6" style="{{($config->quick_count == 'yes')?'':'display:none'}}">
        <div class="card" style="margin-bottom: 1rem">
            <div class="card-body" style="position: relative">
                <img src="{{asset('')}}assets/icons/hisuara_new.png"
                    style="position: absolute; top: 25px; left: 25px; width: 100px" alt="">
                <div class="row">
                    <div class="col-12">
                        <div class="container">
                            <div class="text-center fs-3 mb-3 fw-bold">QUICK COUNT</div>
                            <div class="text-center">Progress {{substr($realcount,0,5)}}% dari 100%</div>
                            <div class="text-center mt-2 mb-2"><span class="badge bg-success">{{$total_incoming_vote}} /
                                    {{$dpt}}</span></div>
                            <div id="chart-pie2" class="chartsh h-100 w-100"></div>
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
                                                <div class="mx-auto counter-icon box-shadow-secondary brround candidate-name text-white "
                                                    style="margin-bottom: 0; background-color: {{$pas->color}};">
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
                <table class="table table-bordered table-hover mb-0">
                    <thead class="bg-primary">
                        <tr>
                            <th class="text-white text-center align-middle">Kecamatan</th>
                            <th class="text-white text-center align-middle">Jumlah <br> TPS Quick Count</th>
                            <th class="text-white text-center align-middle">Quick <br> Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($district_quick as $item)
                        <?php $count_tps = Tps::where('district_id', (string)$item['id'])->count(); ?>
                        <?php $count_tps_quick = Tps::where('district_id', (string)$item['id'])->where('quick_count', 1)->count(); ?>
                        <?php $kecc = District::where('id', $item['district_id'])->first(); ?>
                        <tr @if ( $count_tps_quick> 0)
                            style="background-color: rgb(80,78, 78); color :white;" @else @endif>
                            <td class="align-middle text">
                                {{$item['name']}}
                            </td>
                            <td class="align-middle">{{$count_tps}}</td>
                            <td class="align-middle">@if ( $count_tps_quick > 0)
                                {{$count_tps_quick}}
                                @else
                                0
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="{{($config->otonom == 'yes')?'col-lg-12 col-md-12':'col-lg-6 col-md-12'}}">
        <div class="card">
            {{-- <div class="card-header bg-info">
                <h3 class="card-title text-white">Suara TPS Masuk</h3>
            </div> --}}
            <div class="card-body" style="position: relative;">
                <img src="{{asset('')}}assets/icons/hisuara_new.png"
                    style="position: absolute; top: 25px; left: 25px; width: 100px" alt="">

                <div class="row">
                    <div class="{{($config->otonom == 'yes')?'col-6':'col-12'}}">
                        <div class="row">
                            <div class="col-12">
                                <div class="container">
                                    <div class="text-center fs-3 mb-3 fw-bold">REAL COUNT</div>
                                    <div class="text-center">Progress {{substr($realcount,0,5)}}% dari 100%</div>
                                    <div class="text-center mt-2 mb-2"><span
                                            class="badge bg-success">{{$total_incoming_vote}} /
                                            {{$dpt}}</span></div>
                                    <div class="chart-teks">
                                        Prabowo
                                    </div>   
                                    <div id="chart-pie" class="chartsh h-100 w-100">
                                    </div>
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
                                                        <div class="mx-auto counter-icon box-shadow-secondary brround candidate-name text-white "
                                                            style="margin-bottom: 0; background-color: {{$pas->color}};">
                                                            {{$i++}}
                                                        </div>
                                                    </div>
                                                    <div class="col text-center">
                                                        <h6 class="mt-4">{{$pas->candidate}} </h6>
                                                        <h6 class="">{{$pas->deputy_candidate}} </h6>
                                                        <?php
                                                    $total_saksi = SaksiData::where('paslon_id',$pas->id)->sum('voice');
                                                ?>

                                                        <h3 class="mb-2 number-font">{{ $total_saksi }} suara</h3>
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
                    <div class="{{($config->otonom == 'yes')?'col-6':'col-12'}}">
                        <table class="table table-bordered table-hover mb-0 {{($config->otonom == 'yes')?'h-100':''}}">
                            <thead class="bg-primary">
                                <tr>
                                    <th class="text-white text-center align-middle">KECAMATAN</th>
                                    @foreach ($paslon as $item)
                                    <th class="text-white text-center align-middle">{{ $item['candidate']}} - <br>
                                        {{ $item['deputy_candidate']}}
                                    </th>
                                    @endforeach

                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($kec as $item)
                                <tr onclick='check("{{Crypt::encrypt($item->id)}}")'>
                                    <td class="align-middle"><a
                                            href="{{url('/')}}/administrator/perhitungan_kecamatan/{{Crypt::encrypt($item['id'])}}">{{$item['name']}}</a>
                                    </td>
                                    @foreach ($paslon as $cd)
                                    <?php $saksi_dataa = SaksiData::where('paslon_id', $cd['id'])->where('saksi_data.district_id', $item['id'])->sum('voice'); ?>
                                    <td class="align-middle">{{$saksi_dataa}}</td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>

                            <script>
                                let check = function(id) {
                                    window.location = `{{url('/')}}/administrator/perhitungan_kecamatan/${id}`;
                                }
                            </script>
                        </table>
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
                <img src="{{asset('')}}assets/icons/hisuara_new.png"
                    style="position: absolute; top: 25px; left: 25px; width: 100px" alt="">
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
                                    <div class="text-center mt-2 mb-2"><span
                                            class="badge bg-success">{{$total_verification_voice}} / {{$dpt}}</span>
                                    </div>
                                    <div id="chart-donut" class="chartsh h-100 w-100"></div>
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
                                                        <div class="mx-auto counter-icon box-shadow-secondary brround candidate-name text-white ms-auto"
                                                            style="margin-bottom: 0; background-color: {{$pas->color}};">
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

                    <div class="col-6">
                        <table class="table table-bordered table-hover h-100">
                            <thead class="bg-primary">
                                <td class="text-white text-center align-middle">KECAMATAN</td>
                                @foreach ($paslon as $item)
                                <th class="text-white text-center align-middle">{{ $item['candidate']}} - <br>
                                    {{ $item['deputy_candidate']}}
                                </th>
                                @endforeach
                            </thead>
                            <tbody>
                                @foreach ($kec as $item)
                                <tr onclick='check("{{Crypt::encrypt($item->id)}}")'>
                                    <td class="align-middle"><a
                                            href="{{url('/')}}/administrator/perhitungan_kecamatan/{{Crypt::encrypt($item['id'])}}">{{$item['name']}}</a>
                                    </td>
                                    @foreach ($paslon as $cd)
                                    <?php $saksi_dataa = SaksiData::join('saksi', 'saksi.id', '=', 'saksi_data.saksi_id')->where('paslon_id', $cd['id'])->where('saksi_data.district_id', $item['id'])->where('saksi.verification', 1)->sum('voice'); ?>
                                    <td class="align-middle">{{$saksi_dataa}}</td>
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
    @else
    <div class="col-lg-6 col-md" style="display:{{($config->otonom == 'yes')?'none':'block'}}">
        <div class="card">
            {{-- <div class="card-header bg-secondary">
                <h3 class="card-title text-white">Suara TPS Terverifikasi</h3>
            </div> --}}
            <div class="card-body" style="position: relative">
                <img src="{{asset('')}}assets/icons/hisuara_new.png"
                    style="position: absolute; top: 25px; left: 25px; width: 100px" alt="">
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
                                    <div class="text-center mt-2 mb-2"><span
                                            class="badge bg-success">{{$total_verification_voice}} / {{$dpt}}</span>
                                    </div>
                                    <div id="chart-donut" class="chartsh h-100 w-100"></div>
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
                                                        <div class="mx-auto counter-icon box-shadow-secondary brround candidate-name text-white ms-auto"
                                                            style="margin-bottom: 0; background-color: {{$pas->color}};">
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
                <table class="table table-bordered table-hover h-100">
                    <thead class="bg-primary">
                        <td class="text-white text-center align-middle">KECAMATAN</td>
                        @foreach ($paslon as $item)
                        <th class="text-white text-center align-middle">{{ $item['candidate']}} - <br>
                            {{ $item['deputy_candidate']}}
                        </th>
                        @endforeach
                    </thead>
                    <tbody>
                        @foreach ($kec as $item)
                        <tr onclick='check("{{Crypt::encrypt($item->id)}}")'>
                            <td class="align-middle"><a
                                    href="{{url('/')}}/administrator/perhitungan_kecamatan/{{Crypt::encrypt($item['id'])}}">{{$item['name']}}</a>
                            </td>
                            @foreach ($paslon as $cd)
                            <?php $saksi_dataa = SaksiData::join('saksi', 'saksi.id', '=', 'saksi_data.saksi_id')->where('paslon_id', $cd['id'])->where('saksi_data.district_id', $item['id'])->where('saksi.verification', 1)->sum('voice'); ?>
                            <td class="align-middle">{{$saksi_dataa}}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>

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


<!-- <div class="card mg-b-20"style="display:{{($config->otonom == 'yes')?' none':'block'}}">
    <div class="card-header">
        <div class="card-title">Admin Demography Tracking</div>

        <div class="ms-auto">
            <a class="nav-link icon full-screen-link nav-link-bg"id="ikon-map-full">
                <i class="fe fe-minimize"></i>
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="ht-300" id="map" style="height:600px; z-index: 2"></div>
    </div>
</div> -->

{{-- <div style="
                                height: 320px;
                                width: 260px;
                                background: transparent;
                                position: absolute;
                                z-index: 1;
                            "></div>
<div style="
                                height: 320px;
                                width: 260px;
                                background: transparent;
                                position: absolute;
                                right: 25px;
                                z-index: 1;
                            "></div> --}}
<script>
    $(document).ready(function() {
        const createChartContainer = (style) => {
            return `<div style="${style}"></div>`;
        };

        const chartStyle = `
            height: 320px;
            width: 260px;
            background: transparent;
            position: absolute;
            z-index: 1;
        `;

        const chartContainer1 = createChartContainer(chartStyle);
        const chartContainer2 = createChartContainer(`${chartStyle} right: 25px;`);

        $('.chartsh').prepend(chartContainer1, chartContainer2);
    });
</script>

@endsection