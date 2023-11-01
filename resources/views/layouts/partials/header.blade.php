<?php

use App\Models\Config;
use App\Models\District;
use App\Models\Regency;
use App\Models\SaksiData;
use App\Models\Tps;
use App\Models\Village;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Saksi;
use App\Models\RegenciesDomain;
use App\Models\Province;

$config = Config::all()->first();
$regency = District::where('regency_id', $config['regencies_id'])->get();
$kota = Regency::where('id', $config['regencies_id'])->first();
$dpt = District::where('regency_id', $config['regencies_id'])->sum('dpt');
$tps = Tps::count();
$marquee = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->get();
$total_tps = Tps::where('setup', 'belum terisi')->count();;
$tps_masuk = Tps::where('setup', 'terisi')->count();
$tps_kosong = $total_tps - $tps_masuk;
$suara_masuk = SaksiData::count('voice');
$verification = Saksi::where('verification', 1)->with('saksi_data')->get();
$total_verification_voice = 0;
foreach ($verification as $key) {
    foreach ($key->saksi_data as $verif) {
        $total_verification_voice += $verif->voice;
    }
}
$paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id,SUM(voice) as total FROM saksi_data GROUP by paslon_id ORDER by total DESC'));
$urutan = $paslon_tertinggi;
$props = Province::where('id', $kota['province_id'])->first();
$cityProp = Regency::where('province_id', $kota['province_id'])->get();
?>


<style>
    .header .btn {
        margin-left: 0px !important;
        position: relative;
    }

    .for-kolapse-kurangin>.side-app>.row:first-child {
        margin-top: 90px !important;
        transition: all 0.5s ease-in-out;
    }

    .for-kolapse-kurangin>.side-app>.row.kurangin {
        margin-top: 0px !important;
        transition: all 0.5s ease-in-out;
    }

    .sidenav-toggled .header-baru {
        padding-left: 80px !important
    }

    .tooltip-inner {
        background-color: #f82649 !important;
    }

    .bs-tooltip-bottom .tooltip-arrow::before {
        border-bottom-color: #f82649 !important;
    }

    .active-button {
        background-color: #e1af0a !important;
    }

    .custom-urutan:nth-child(1) {
        border-radius: 25px 0px 0px 25px
    }

    .custom-urutan:nth-child(2) {
        border-radius: 0px
    }

    .custom-urutan:nth-child(3) {
        border-radius: 0px 25px 25px 0px
    }

    /* custom scrollbar */
    .row.items::-webkit-scrollbar {
        display: none
    }

    .kecurangan.active-button {
        background-color: #f82649 !important;
    }

    .sirantap.active-button {
        background-color: #f82649 !important;
    }

    .glowy-menu.active {
        background-color: rgb(4, 217, 255) !important;
        -webkit-box-shadow: 0px 0px 50px 0px rgb(4, 217, 255);
        -moz-box-shadow: 0px 0px 50px 0px rgb(4, 217, 255);
        box-shadow: 0px 0px 50px 0px rgb(4, 217, 255);
    }

    .glowy-menu.glow-kecurangan.active {
        background-color: rgb(254, 118, 8) !important;
        -webkit-box-shadow: 0px 0px 50px 0px rgb(254, 118, 8);
        -moz-box-shadow: 0px 0px 50px 0px rgb(254, 118, 8);
        box-shadow: 0px 0px 50px 0px rgb(254, 118, 8);
    }

    /* ::-webkit-scrollbar-track {
      background-color: transparent;
    }
    
    ::-webkit-scrollbar-thumb {
      background-color: #d6dee1;
      border-radius: 20px;
      background-clip: content-box;
    }
    
    ::-webkit-scrollbar-thumb:hover {
      background-color: #a8bbbf;
    }

    ::-webkit-scrollbar-corner {
        background: transparent;
    } */
</style>

<div class="app-header header header-baru py-0 pe-0" style="padding-left: 0px !important">
    <div class="container-fluid px-0">

        <div class="d-flex" style="position: relative">

            <div class="col-12 px-0">
                <div class="card mb-0 border-0">
                    <div class="card-body for-kolapse py-1 pl-5" style="background: #000; padding-right: 2.5rem">
                        <div class="row py-2 justify-content-between" style="gap: 15px">

                            <div class="col-auto col-hisuara" style="display:none;width:238px;height:54px">
                                <div class="row my-auto mx-auto">

                                    <div class="col-md ps-3 mb-0 text-light headerAnimate">
                                        <h2 class="text-white mb-0 text-center headerPojokan"></h2>
                                        <h2 class="text-white mb-0 text-center headerPojokanText1" style="display:none">
                                        </h2>
                                        <h2 class="text-white mb-0 text-center headerPojokanText2" style="display:none">
                                        </h2>
                                    </div>
                                </div>
                            </div>

                            <div class="col-auto col-pilpres">
                                <div class="row">

                                    <div class="col-md-auto pe-0 my-auto">
                                        <img src="{{asset('')}}storage/{{$config->regencies_logo}}" style="width: 50px"
                                            alt="">
                                    </div>
                                    <div class="col-lg-auto ps-3 mb-0">
                                        <h3 class="text-white mb-0">PILPRES 2024
                                            <!-- Kota -->
                                        </h3>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active text-white" aria-current="page">
                                                <marquee width="150px" direction="left" scrollamount="3">
                                                    {{ $kota->name }}
                                                </marquee>
                                                <!-- KABUPATEN KEPULAUAN SIAU TABULANDANG BIARO -->
                                                <!-- Kota -->
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>


                            <script>
                                function animateHeaderPojokan() {
                                    $container = $(".headerPojokan");
                                    const text = "HISUARA"
                                    const $elements = text.split("").map((s) => $(
                                        `<span style="margin-left:5px;text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #e60073, 0 0 40px #e60073, 0 0 50px #e60073, 0 0 60px #e60073, 0 0 70px #e60073;">${s}</span>`
                                    ));

                                    $container.html($elements);
                                    $container.show();
                                    // $("#gantiBackground").css({
                                    //     "background-color": "#007bff"
                                    // }, 1000);
                                    $elements.forEach(function($el, i) {
                                        $el
                                            .css({
                                                top: -60,
                                                opacity: 0
                                            })
                                            .delay(100 * i)
                                            .animate({
                                                top: 0,
                                                opacity: 1
                                            }, 200);
                                    });
                                    setTimeout(() => {
                                        $($(".headerPojokan").find('span')).remove();
                                        animateHeaderPojokanText1()
                                    }, 2000);

                                }

                                function animateHeaderPojokanText1() {
                                    $container = $(".headerPojokanText1");

                                    const text = "Vox Populi, Vox Dei"
                                    const $elements = text.split("").map((s) => $(
                                        `<span style="margin-left:4px;text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #e60073, 0 0 40px #e60073, 0 0 50px #e60073, 0 0 60px #e60073, 0 0 70px #e60073;">${s}</span>`
                                    ));

                                    $container.html($elements);
                                    $container.show();
                                    // $("#gantiBackground").css({
                                    //     "background-color": "#007bff"
                                    // }, 1000);
                                    $elements.forEach(function($el, i) {
                                        $el
                                            .css({
                                                top: -60,
                                                opacity: 0
                                            })
                                            .delay(100 * i)
                                            .animate({
                                                top: 0,
                                                opacity: 1
                                            }, 200);
                                    });
                                    setTimeout(() => {
                                        $($(".headerPojokanText1").find('span')).remove();
                                        $('.col-hisuara').hide()
                                        $('.col-pilpres').show()
                                        setTimeout(() => {
                                            $('.col-hisuara').css('display') = 'flex'
                                            $('.col-pilpres').hide()

                                            animateHeaderPojokan()
                                        }, 1000 * 60);
                                    }, 4000);
                                }

                                function animateHeaderPojokanText2() {
                                    $container = $(".headerPojokanText2");

                                    const text = "Vox Dei"
                                    const $elements = text.split("").map((s) => $(
                                        `<span style="text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #e60073, 0 0 40px #e60073, 0 0 50px #e60073, 0 0 60px #e60073, 0 0 70px #e60073;">${s}</span>`
                                    ));

                                    $container.html($elements);
                                    $container.show();
                                    // $("#gantiBackground").css({
                                    //     "background-color": "#007bff"
                                    // }, 1000);
                                    $elements.forEach(function($el, i) {
                                        $el
                                            .css({
                                                top: -60,
                                                opacity: 0
                                            })
                                            .delay(100 * i)
                                            .animate({
                                                top: 0,
                                                opacity: 1
                                            }, 200);
                                    });
                                    setTimeout(() => {
                                        $($(".headerPojokanText2").find('span')).remove();
                                        $('.col-hisuara').hide()
                                        $('.col-pilpres').show()
                                        setTimeout(() => {
                                            $('.col-hisuara').css('display') = 'flex'
                                            $('.col-pilpres').hide()

                                            animateHeaderPojokan()
                                        }, 1000 * 60);
                                    }, 2000);

                                }
                              
                            </script>


                            <div class="col-md-auto my-auto">
                                <div class="row h-100 justify-content-end" style="gap: 10px;">
                                    <div class="col-md-auto px-0">
                                        <a class="w-100 mx-auto btn text-white"
                                            style="background-color: #528bff; width: 40px; height: 36px;"
                                            href="{{url('')}}/administrator/index">
                                            <span class="dark-layout" data-bs-placement="bottom"
                                                data-bs-toggle="tooltip" title="Dashboard">
                                                <i class="fa-solid fa-gauge-high"></i>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="col-md-auto px-0">
                                        <button class="w-100 mx-auto btn tugel-kolaps text-white"
                                            style="background-color: #656064; width: 40px; height: 36px;"
                                            data-target="petugas">
                                            <span class="dark-layout" data-bs-placement="bottom"
                                                data-bs-toggle="tooltip" title="Petugas">
                                                <i class="fa-solid fa-user-tie"></i>
                                            </span>
                                        </button>
                                    </div>

                                    <div class="col-md-auto px-0">
                                        <button class="w-100 mx-auto btn tugel-kolaps text-white"
                                            style="background-color: #656064; width: 40px; height: 36px;"
                                            data-target="operator">
                                            <span class="dark-layout" data-bs-placement="bottom"
                                                data-bs-toggle="tooltip" title="Operator">
                                                <i class="fa-solid fa-computer"></i>
                                            </span>
                                        </button>
                                    </div>

                                    <div class="col-md-auto px-0">
                                        <button class="w-100 mx-auto btn tugel-kolaps text-white"
                                            style="background-color: #656064; width: 40px; height: 36px;"
                                            data-target="perhitungan">
                                            <span class="dark-layout" data-bs-placement="bottom"
                                                data-bs-toggle="tooltip" title="Perhitungan">
                                                <i class="fa-solid fa-chart-simple"></i>
                                            </span>
                                        </button>
                                    </div>

                                    <div class="col-md-auto px-0">
                                        <button class="w-100 mx-auto btn tugel-kolaps text-white"
                                            style="background-color: #656064; width: 40px; height: 36px;"
                                            data-target="dokumentasi">
                                            <span class="dark-layout" data-bs-placement="bottom"
                                                data-bs-toggle="tooltip" title="Dokumentasi">
                                                <i class="fa-solid fa-book"></i>
                                            </span>
                                        </button>
                                    </div>

                                    <div class="col-md-auto px-0">
                                        <button class="w-100 mx-auto btn tugel-kolaps text-white kecurangan"
                                            style="background-color: #656064; width: 40px; height: 36px;"
                                            data-target="kecurangan">
                                            <span class="dark-layout" data-bs-placement="bottom"
                                                data-bs-toggle="tooltip" title="Kecurangan">
                                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" x="0" y="0"
                                                    viewBox="0 0 24 24" style="enable-background:new 0 0 512 512"
                                                    xml:space="preserve" class="">
                                                    <g>
                                                        <path
                                                            d="M14.25 0H2.75C1.23 0 0 1.23 0 2.75v15.5C0 19.77 1.23 21 2.75 21h8.14a7.138 7.138 0 0 1-1.39-4.25c0-4 3.25-7.25 7.25-7.25.08 0 .17 0 .25.01V2.75C17 1.23 15.77 0 14.25 0zM4 4h4c.55 0 1 .45 1 1s-.45 1-1 1H4c-.55 0-1-.45-1-1s.45-1 1-1zm5 10H4c-.55 0-1-.45-1-1s.45-1 1-1h5c.55 0 1 .45 1 1s-.45 1-1 1zm4-4H4c-.55 0-1-.45-1-1s.45-1 1-1h9c.55 0 1 .45 1 1s-.45 1-1 1z"
                                                            fill="#ffffff" opacity="1" data-original="#000000" class="">
                                                        </path>
                                                        <path
                                                            d="M16.75 22c-2.895 0-5.25-2.355-5.25-5.25s2.355-5.25 5.25-5.25S22 13.855 22 16.75 19.645 22 16.75 22zm0-8.5c-1.792 0-3.25 1.458-3.25 3.25S14.958 20 16.75 20 20 18.542 20 16.75s-1.458-3.25-3.25-3.25z"
                                                            fill="#ffffff" opacity="1" data-original="#000000" class="">
                                                        </path>
                                                        <path
                                                            d="M23 24a.997.997 0 0 1-.707-.293l-3.25-3.25a.999.999 0 1 1 1.414-1.414l3.25 3.25A.999.999 0 0 1 23 24z"
                                                            fill="#ffffff" opacity="1" data-original="#000000" class="">
                                                        </path>
                                                    </g>
                                                </svg>
                                            </span>
                                        </button>
                                    </div>

                                    <div class="col-md-auto px-0">
                                        <button class="w-100 mx-auto btn tugel-kolaps text-white sirantap"
                                            style="background-color: #656064; width: 40px; height: 36px;"
                                            data-target="sirantap">
                                            <span class="dark-layout" data-bs-placement="bottom"
                                                data-bs-toggle="tooltip" title="Sistem Laporan Data Pemilu">
                                                <i class="fa-solid fa-print"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md my-auto">
                                <div class="row">

                                    <div class="col-md-auto my-auto">
                                        <h4 class="mb-0 fw-bold dashboard tugel-content"
                                            style="color: #e1af0a; font-size: 16px; display: none;">
                                            Dashboard
                                        </h4>
                                        <h4 class="mb-0 fw-bold petugas tugel-content"
                                            style="color: #e1af0a; font-size: 16px; display: none;">
                                            Petugas
                                        </h4>
                                        <h4 class="mb-0 fw-bold operator tugel-content"
                                            style="color: #e1af0a; font-size: 16px; display: none;">
                                            Operator
                                        </h4>
                                        <h4 class="mb-0 fw-bold perhitungan tugel-content"
                                            style="color: #e1af0a; font-size: 16px; display: none;">
                                            Perhitungan
                                        </h4>
                                        <h4 class="mb-0 fw-bold rekapitulasi tugel-content"
                                            style="color: #e1af0a; font-size: 16px; display: none;">
                                            Rekapitulasi
                                        </h4>
                                        <h4 class="mb-0 fw-bold dokumentasi tugel-content"
                                            style="color: #e1af0a; font-size: 16px; display: none;">
                                            Dokumentasi
                                        </h4>
                                        <h4 class="mb-0 fw-bold kecurangan tugel-content"
                                            style="color: #f82649; font-size: 16px; display: none;">
                                            Kecurangan
                                        </h4>
                                        <h4 class="mb-0 fw-bold suara tugel-content"
                                            style="color: #e1af0a; font-size: 16px; display: none;">
                                            Urutan
                                        </h4>
                                        <h4 class="mb-0 fw-bold tabulasi tugel-content"
                                            style="color: #e1af0a; font-size: 16px; display: none;">
                                            Tabulasi
                                        </h4>
                                        <!-- <h4 class="mb-0 fw-bold  tugel-content" style="color: #e1af0a; font-size: 16px">
                                         Hisuara
                                        </h4> -->
                                        <h4 class="mb-0 fw-bold kota tugel-content"
                                            style="color: #e1af0a; font-size: 16px; display: none;">
                                            Kota
                                        </h4>
                                        <h4 class="mb-0 fw-bold support tugel-content"
                                            style="color: #e1af0a; font-size: 16px; display: none;">
                                            Support
                                        </h4>
                                        <h4 class="mb-0 fw-bold setting tugel-content"
                                            style="color: #e1af0a; font-size: 16px; display: none;">
                                            Settings
                                        </h4>
                                        <h4 class="mb-0 fw-bold lacak tugel-content"
                                            style="color: #e1af0a; font-size: 16px; display: none;">
                                            Pelacakan
                                        </h4>
                                        <h4 class="mb-0 fw-bold sirantap tugel-content"
                                            style="color: #f82649; font-size: 16px; display: none;">
                                            Sirantap
                                        </h4>
                                    </div>

                                    <div class="col-md petugas tugel-content" style="display: none">
                                        <div class="row">
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/administrator/verifikasi_saksi"
                                                    class="py-1 btn fs-6 w-100 text-white glowy-menu"
                                                    style="background-color: #528bff; border-radius: 25px 0px 0px 25px;">
                                                    Saksi
                                                </a>
                                            </div>
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/administrator/relawan"
                                                    class="py-1 btn fs-6 w-100 text-white glowy-menu"
                                                    style="background-color: #528bff; border-radius: 0;">
                                                    Relawan
                                                </a>
                                            </div>
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/administrator/enumerator"
                                                    class="py-1 btn fs-6 w-100 text-white glowy-menu"
                                                    style="background-color: #528bff; border-radius: 0;">
                                                    Enumerator
                                                </a>
                                            </div>
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/administrator/verifikasi_akun"
                                                    class="py-1 btn fs-6 w-100 text-white glowy-menu"
                                                    style="background-color: #528bff; border-radius: 0px 25px 25px 0px;">
                                                    Admin
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md operator tugel-content" style="display: none">
                                        <div class="row">
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/verifikator/verifikasi-c1"
                                                    class="py-1 btn fs-6 w-100 text-white glowy-menu"
                                                    style="background-color: #528bff; border-radius: 25px 0px 0px 25px;">
                                                    Verifikasi C1
                                                </a>
                                            </div>
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/auditor/audit-c1"
                                                    class="py-1 btn fs-6 w-100 text-white glowy-menu"
                                                    style="background-color: #528bff; border-radius: 0px;">
                                                    Audit C1
                                                </a>
                                            </div>
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="#" class="py-1 btn fs-6 w-100 text-white glowy-menu"
                                                    style="background-color: #528bff; border-radius: 0px;">
                                                    Crowd C1 KPU
                                                </a>
                                            </div>
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/administrator/verifikasi_koreksi"
                                                    class="py-1 btn fs-6 w-100 text-white glowy-menu"
                                                    style="background-color: #528bff; border-radius: 0px 25px 25px 0px;">
                                                    Koreksi
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md perhitungan tugel-content" style="display: none">
                                        <div class="row">
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/administrator/real_count2"
                                                    class="py-1 btn fs-6 w-100 text-white glowy-menu"
                                                    style="background-color: #528bff; border-radius: 25px 0px 0px 25px;">
                                                    Real Count
                                                </a>
                                            </div>
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/administrator/quick_count2"
                                                    class="py-1 btn fs-6 w-100 text-white glowy-menu"
                                                    style="background-color: #528bff; border-radius: 0px">
                                                    Quick Count
                                                </a>
                                            </div>
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/administrator/terverifikasi"
                                                    class="py-1 btn fs-6 w-100 text-white glowy-menu"
                                                    style="background-color: #528bff; border-radius: 0px;">
                                                    Terverifikasi
                                                </a>
                                            </div>
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/administrator/rekapitulasi"
                                                    class="py-1 btn fs-6 w-100 text-white glowy-menu"
                                                    style="background-color: #528bff; border-radius: 0px 25px 25px 0px;">
                                                    Rekapitulasi
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md rekapitulasi tugel-content" style="display: none">
                                        <div class="row">
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/administrator/rekapitulasi_kelurahan"
                                                    class="py-1 btn fs-6 w-100 text-white glowy-menu"
                                                    style="background-color: #528bff; border-radius: 25px 0px 0px 25px;">
                                                    Rekapitulasi Kelurahan
                                                </a>
                                            </div>
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/administrator/rekapitulasi_kecamatan"
                                                    class="py-1 btn fs-6 w-100 text-white glowy-menu"
                                                    style="background-color: #528bff; border-radius: 0px 25px 25px 0px;">
                                                    Rekapitulasi Kecamatan
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md dokumentasi tugel-content" style="display: none">
                                        <div class="row">
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/administrator/data-c1"
                                                    class="py-1 btn fs-6 w-100 text-white glowy-menu"
                                                    style="background-color: #528bff; border-radius: 25px 0px 0px 25px;">
                                                    Data C1
                                                </a>
                                            </div>
                                            <!-- <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="#" class="py-1 btn fs-6 w-100 text-white glowy-menu" style="background-color: #528bff; border-radius: 0;">
                                                    Data C6
                                                </a>
                                            </div> -->
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="#" class="py-1 btn fs-6 w-100 text-white glowy-menu"
                                                    style="background-color: #528bff; border-radius: 0;">
                                                    Surat Suara
                                                </a>
                                            </div>
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{route('superadmin.rdata')}}"
                                                    class="py-1 btn fs-6 w-100 text-white glowy-menu"
                                                    style="background-color: #528bff; border-radius: 0px 25px 25px 0px;">
                                                    Riwayat
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md kecurangan tugel-content" style="display: none">
                                        <div class="row">
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/verifikator/verifikator_kecurangan"
                                                    class="py-1 btn fs-6 w-100 text-white glowy-menu glow-kecurangan"
                                                    style="background-color: #f82649; border-radius: 25px 0px 0px 25px;">
                                                    Verifikator Kecurangan
                                                </a>
                                            </div>
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/hukum/validator_kecurangan"
                                                    class="py-1 btn fs-6 w-100 text-white glowy-menu glow-kecurangan"
                                                    style="background-color: #f82649; border-radius: 0px 25px 25px 0px;">
                                                    Validator Kecurangan
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md sirantap tugel-content" style="display: none">
                                        <div class="row">
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/administrator/fraud-data-print"
                                                    class="py-1 btn fs-6 w-100 text-white glowy-menu glow-kecurangan"
                                                    style="background-color: #f82649; border-radius: 25px 0px 0px 25px;">
                                                    Bukti Kecurangan
                                                </a>
                                            </div>
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/administrator/fraud-data-report"
                                                    class="py-1 btn fs-6 w-100 text-white glowy-menu glow-kecurangan"
                                                    style="background-color: #f82649; border-radius: 0px;">
                                                    Barkode Kecurangan
                                                </a>
                                            </div>
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/administrator/index-tsm"
                                                    class="py-1 btn fs-6 w-100 text-white glowy-menu glow-kecurangan"
                                                    style="background-color: #f82649; border-radius: 0px;">
                                                    Jenis Kecurangan
                                                </a>
                                            </div>
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{route('superadmin.analisa_dpt_kpu')}}"
                                                    class="py-1 btn fs-6 w-100 text-white glowy-menu glow-kecurangan"
                                                    style="background-color: #f82649; border-radius: 0px 25px 25px 0px;;">
                                                    Realisasi DPT
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md lacak tugel-content" style="display: none">
                                        <div class="row">
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/administrator/lacak_saksi"
                                                    class="py-1 btn fs-6 w-100 text-white glowy-menu"
                                                    style="background-color: #528bff; border-radius: 25px 0px 0px 25px;">
                                                    Lacak Saksi
                                                </a>
                                            </div>
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/administrator/lacak_relawan"
                                                    class="py-1 btn fs-6 w-100 text-white glowy-menu"
                                                    style="background-color: #528bff; border-radius: 0;">
                                                    Lacak Relawan
                                                </a>
                                            </div>
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/administrator/lacak_enumerator"
                                                    class="py-1 btn fs-6 w-100 text-white glowy-menu"
                                                    style="background-color: #528bff; border-radius: 0;">
                                                    Lacak Enumerator
                                                </a>
                                            </div>
                                            <div class="col-md" style="padding-left: 1px; padding-right: 1px">
                                                <a href="{{url('')}}/administrator/lacak_admin"
                                                    class="py-1 btn fs-6 w-100 text-white glowy-menu"
                                                    style="background-color: #528bff; border-radius: 0px 25px 25px 0px;">
                                                    Lacak Admin
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md text-white tabulasi tugel-content" style="display:none">
                                        <div class="row">
                                            <div class="col py-2 judul text-center bg-secondary text-white"
                                                style="border-top-left-radius: 25px; border-bottom-left-radius: 25px">
                                                <div class="text">Total TPS : <b>{{ $total_tps }}</b></div>
                                            </div>
                                            <div class="col py-2 judul text-center bg-danger text-white">
                                                <div class="text">TPS Masuk : <b>{{ $tps_masuk }}</b></div>
                                            </div>
                                            <div class="col py-2 judul text-center bg-primary text-white">
                                                <div class="text">TPS Kosong : <b>{{ $tps_kosong }}</b></div>
                                            </div>
                                            <div class="col py-2 judul text-center bg-info text-white">
                                                <div class="text">Suara Masuk : <b>{{ $suara_masuk }}</b></div>
                                            </div>
                                            <div class="col py-2 judul text-center bg-success text-white"
                                                style="border-top-right-radius: 25px; border-bottom-right-radius: 25px">
                                                <div class="text">Terverifikasi : <b>{{$total_verification_voice}}</b>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <style>
                                        .items.active {
                                            cursor: grabbing;
                                            cursor: -webkit-grabbing;
                                        }
                                    </style>

                                    <div class="col-md text-white kota tugel-content" style="display: none">
                                        <div class="row">
                                            <div class="col-4 my-auto">
                                                <input type="text" class="w-100 form-control py-0 searchbar"
                                                    style="border-radius: 25px; height: 30px" name="" id=""
                                                    placeholder="Cari Kota...">
                                            </div>
                                            <div class="col-6">
                                                <?php $domainKota = RegenciesDomain::join("regencies", 'regency_domains.regency_id', '=', 'regencies.id')->where("regency_domains.province_id", $props->id)->get(); ?>
                                                <div class="row items"
                                                    style="width: 515px; overflow: scroll; flex-wrap: nowrap">
                                                    <div class="col-auto">
                                                        <a class="text-white btn rounded-0 item bg-danger"
                                                            href="http://pilpres.banten.hisuara.id/index">DASHBOARD
                                                            {{$props->name}}</a>
                                                    </div>
                                                    @foreach($domainKota as $dokota)
                                                    <div class="col-auto">
                                                        <a class="text-white btn rounded-0 item" style="background: #528bff" href="http://{{$dokota->domain}}">{{$dokota->name}}</a>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        $(document).ready(function() {
                                            $('.searchbar').on('input', function() {
                                                const searchText = $(this).val().toLowerCase().trim();
                                                $('.item').each(function() {
                                                    const itemText = $(this).text().toLowerCase();

                                                    if (itemText.includes(searchText)) {
                                                        $(this).parent('.col-auto').show(); // Show the parent column if the item matches the search text
                                                    } else {
                                                        $(this).parent('.col-auto').hide(); // Hide the parent column if the item doesn't match
                                                    }
                                                });
                                            });
                                        });

                                        const slider = document.querySelector('.items');
                                        let isDown = false;
                                        let startX;
                                        let scrollLeft;

                                        slider.addEventListener('mousedown', (e) => {
                                            isDown = true;
                                            slider.classList.add('active');
                                            startX = e.pageX - slider.offsetLeft;
                                            scrollLeft = slider.scrollLeft;
                                        });
                                        slider.addEventListener('mouseleave', () => {
                                            isDown = false;
                                            slider.classList.remove('active');
                                        });
                                        slider.addEventListener('mouseup', () => {
                                            isDown = false;
                                            slider.classList.remove('active');
                                        });
                                        slider.addEventListener('mousemove', (e) => {
                                            if (!isDown) return;
                                            e.preventDefault();
                                            const x = e.pageX - slider.offsetLeft;
                                            const walk = (x - startX) * 1; //scroll-fast
                                            slider.scrollLeft = scrollLeft - walk;
                                            console.log(walk);
                                        });
                                    </script>

                                    <div class="col-md text-white support tugel-content" style="display: none">
                                        <div class="row">
                                            <div class="col-md-auto px-1 my-auto">
                                                <img src="https://plus.unsplash.com/premium_photo-1661510749856-47c47ea10fc7?auto=format&fit=crop&q=80&w=1932&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                                    class="avatar profile-user brround"
                                                    style="width: 35px; height: 35px; object-fit: cover" alt="">
                                            </div>
                                            <div class="col-md my-auto">
                                                <input class="w-100 form-control py-0"
                                                    style="border-radius: 25px; height: 30px" type="text" name="" id=""
                                                    placeholder="Kirim pesan ...">
                                            </div>
                                            <div class="col-md-auto my-auto p-0">
                                                <button class="btn text-white my-auto"><i
                                                        class="fa-solid fa-paper-plane"
                                                        style="font-size: 16px;"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md setting tugel-content settings"
                                        style="display: none; top: 0; position: relative;">
                                        {{-- Settings --}}
                                        <div class="row px-5 my-auto" style="gap: 25px;">
                                            <div class="col-md">
                                                <div class="mid">

                                                    <label class="switch">
                                                        <input type="checkbox" {{($config->default ==
                                                        "yes")?'disabled':''}} data-target="mode"
                                                        onclick="settings('multi_admin',this)" {{($config->multi_admin
                                                        == "no") ? "":"checked"; }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                                <div class="text-center"
                                                    style="font-size:13px; font-family: 'Roboto', sans-serif !important;">
                                                    Multi
                                                </div>
                                            </div>

                                            <div class="col-md">
                                                <div class="mid">

                                                    <label class="switch">
                                                        <input type="checkbox" data-target="mode"
                                                            onclick="settings('otonom',this)" {{($config->otonom ==
                                                        "no") ? "":"checked"; }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                                <div class="text-center"
                                                    style="font-size:13px; font-family: 'Roboto', sans-serif !important;">
                                                    Otonom
                                                </div>
                                            </div>

                                            <div class="col-md">
                                                <div class="mid">
                                                    <label class="switch">
                                                        <input type="checkbox" {{($config->default ==
                                                        "yes")?'disabled':''}} data-target="mode"
                                                        onclick="settings('show_terverifikasi',this)"
                                                        {{($config->show_terverifikasi == "hide") ? "":"checked"; }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                                <div class="text-center"
                                                    style="font-size:13px; font-family: 'Roboto', sans-serif !important;">
                                                    Verifikasi
                                                </div>
                                            </div>

                                            <div class="col-md">
                                                <div class="mid">
                                                    <label class="switch">
                                                        <input type="checkbox" {{($config->default ==
                                                        "yes")?'disabled':''}} data-target="mode"
                                                        onclick="settings('show_public',this)" {{($config->show_public
                                                        == "hide") ? "":"checked"; }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                                <div class="text-center"
                                                    style="font-size:13px; font-family: 'Roboto', sans-serif !important;">
                                                    Publish C1
                                                </div>
                                            </div>

                                            <div class="col-md">
                                                <div class="mid">

                                                    <label class="switch">
                                                        <input type="checkbox" {{($config->default ==
                                                        "yes")?'disabled':''}} data-target="mode"
                                                        onclick="settings('lockdown',this)" {{($config->lockdown ==
                                                        "no") ? "":"checked"; }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                                <div class="text-center"
                                                    style="font-size:13px; font-family: 'Roboto', sans-serif !important;">
                                                    Lockdown
                                                </div>
                                            </div>

                                            <div class="col-md">
                                                <div class="mid">
                                                    <label class="switch">
                                                        <input type="checkbox" {{($config->default ==
                                                        "yes")?'disabled':''}} data-target="mode"
                                                        onclick="settings('quick_count',this)" {{($config->quick_count
                                                        == "no") ? "":"checked"; }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                                <div class="text-center"
                                                    style="font-size:13px; font-family: 'Roboto', sans-serif !important;">
                                                    Quick Count
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md suara tugel-content" style="display: none">
                                        <div class="row">
                                            @foreach ($urutan as $urutPaslon)
                                            <?php $pasangan = App\Models\Paslon::where('id', $urutPaslon->paslon_id)->first(); ?>
                                            <div class="col py-2 judul text-center text-white custom-urutan"
                                                style="background: {{ $pasangan->color }}">
                                                <div class="text">{{ $pasangan->candidate }} ||
                                                    {{ $pasangan->deputy_candidate }} : {{$urutPaslon->total}}</b>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-white judul-pertama">
                                        <div class="row">

                                            <div class="col-12 judul text-center text-white" id="gantiBackground"
                                                style="transition: background 1s; transform: scaleX(1.2);">
                                                <div class="text">
                                                    <h1 style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #e60073, 0 0 40px #e60073, 0 0 50px #e60073, 0 0 60px #e60073, 0 0 70px #e60073;"
                                                        class="display-2" id="text-effect"></h1>
                                                    <h1 style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100%; color: #fff; text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #e60073, 0 0 40px #e60073, 0 0 50px #e60073, 0 0 60px #e60073, 0 0 70px #e60073;"
                                                        class="display-3" id="text-effect2"></h1>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

                                    <script>
                                        function animate() {
                                            $('.judul-pertama').css("z-index", "900");
                                            $container = $("#text-effect");
                                            $('.tugel-content').hide(500);

                                            const text = "HISUARA"
                                            const $elements = text.split("").map((s) => $(
                                                `<span style="margin-left:20px" class="my-auto fw-normal">${s}</span>`
                                            ));

                                            $container.html($elements);
                                            $container.show();
                                            // $("#gantiBackground").css({
                                            //     "background-color": "#007bff"
                                            // }, 1000);
                                            $elements.forEach(function($el, i) {
                                                $el
                                                    .css({
                                                        top: -60,
                                                        opacity: 0
                                                    })
                                                    .delay(100 * i)
                                                    .animate({
                                                        top: 0,
                                                        opacity: 1
                                                    }, 200);
                                            });

                                            setTimeout(() => {
                                                $("#text-effect").hide();
                                                $("#text-effect").html("");
                                                animate2()
                                            }, 3000)

                                        }

                                        function animate2() {

                                            $container = $("#text-effect2");
                                            const text = "VOX POPULI,VOX DEI"
                                            const $elements = text.split("").map((s) => $(
                                                `<span style="margin-left:15px" class="my-auto">${s}</span>`));

                                            $container.html($elements);
                                            $container.show();
                                            // $("#gantiBackground").css({
                                            //     "background-color": "#007bff"
                                            // }, 1000);
                                            $elements.forEach(function($el, i) {
                                                $el
                                                    .css({
                                                        top: -60,
                                                        opacity: 0
                                                    })
                                                    .delay(100 * i)
                                                    .animate({
                                                        top: 0,
                                                        opacity: 1
                                                    }, 200);
                                            });
                                            setTimeout(() => {
                                                $("#text-effect2").html("")
                                                $("#text-effect2").hide()
                                                const dataTarget = getCookie('dataTarget');
                                                if (dataTarget != "") {
                                                    $(`[data-target='${dataTarget}']`).click();
                                                } else {
                                                    $('.active-button').click()
                                                }
                                                $('.col-hisuara').css('display', 'flex')
                                                $('.col-pilpres').hide()
                                                animateHeaderPojokan();

                                            }, 5000);
                                        }


                                        $(function() {


                                            <?php
                                            if (request()->segment(2) != "index") {  ?>
                                                const dataTarget = getCookie('dataTarget');
                                                if (dataTarget != "") {
                                                    $(`[data-target='${dataTarget}']`).click();
                                                } else {
                                                    $('.active-button').click()
                                                }

                                                setTimeout(() => {
                                                    $('.col-hisuara').css('display') = 'flex'
                                                    $('.col-pilpres').hide()
                                                    animateHeaderPojokan();
                                                 }, 6000);

                                              

                                            <?php } else { ?>
                                                animate();
                                            <?php  } ?>

                                        });
                                    </script>

                                </div>
                            </div>

                            <div class="col-md-auto my-auto">
                                <div class="row h-100 justify-content-end" style="gap: 10px;">
                                    <div class="col-md-auto px-0">
                                        <button class="w-100 mx-auto btn tugel-kolaps text-white active-button"
                                            style="background-color: #656064; width: 40px; height: 36px;"
                                            data-target="tabulasi">
                                            <span class="dark-layout" data-bs-placement="bottom"
                                                data-bs-toggle="tooltip" title="Tabulasi">
                                                <i class="fa-solid fa-database"></i>
                                            </span>
                                        </button>
                                    </div>
                                    <div class="col-md-auto px-0">
                                        <button class="w-100 mx-auto btn tugel-kolaps text-white"
                                            style="background-color: #656064; width: 40px; height: 36px;"
                                            data-target="suara">
                                            <span class="dark-layout" data-bs-placement="bottom"
                                                data-bs-toggle="tooltip" title="Urutan Suara">
                                                <i class="fa-solid fa-ranking-star"></i>
                                            </span>
                                        </button>
                                    </div>

                                    <div class="col-md-auto px-0">
                                        <button class="w-100 mx-auto btn tugel-kolaps text-white"
                                            style="background-color: #656064; width: 40px; height: 36px;"
                                            data-target="kota">
                                            <span class="dark-layout" data-bs-placement="bottom"
                                                data-bs-toggle="tooltip" title="Kota">
                                                <i class="fa-solid fa-city"></i>
                                            </span>
                                        </button>
                                    </div>
                                    {{-- <div class="dropdown d-none d-md-flex">
                                        <a class="nav-link icon theme-layout nav-link-bg layout-setting"
                                            onclick="darktheme()">

                                        </a>
                                    </div><!-- Theme-Layout --> --}}
                                    <script>
                                        let darktheme = function() {
                                            setTimeout(function() {
                                                let body = document.body;
                                                let themes = body.className.split(" ");
                                                let theme = (themes.length == 3) ? "yes" : "no";
                                                $.ajax({
                                                    url: `{{ route('superadmin.theme') }}`,
                                                    data: {
                                                        theme,
                                                        "_token": "{{ csrf_token() }}"
                                                    },
                                                    type: "post",
                                                    success: function(res) {

                                                    }
                                                });
                                            }, 300);
                                        }
                                    </script>

                                    <div class="col-md-auto px-0">
                                        <button class="w-100 mx-auto btn tugel-kolaps text-white"
                                            style="background-color: #656064; width: 40px; height: 36px;" data-target="lacak">
                                            <span class="dark-layout" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Pelacakan">
                                                <i class="fa-solid fa-location-dot"></i>
                                            </span>
                                        </button>
                                    </div>
                                    <div class="col-md-auto px-0">
                                        <button class="w-100 mx-auto btn tugel-kolaps text-white"
                                            style="background-color: #656064; width: 40px; height: 36px;"
                                            data-target="support">
                                            <span class="dark-layout" data-bs-placement="bottom"
                                                data-bs-toggle="tooltip" title="Support">
                                                <i class="fa-solid fa-headset"></i>
                                            </span>
                                        </button>
                                    </div>
                                    <div class="col-md-auto px-0">
                                        <button class="w-100 mx-auto btn tugel-kolaps text-white"
                                            style="background-color: #656064; width: 40px; height: 36px;"
                                            data-target="featured">
                                            <span class="dark-layout" data-bs-placement="bottom"
                                                data-bs-toggle="tooltip" title="Featured">
                                                <i class="fa-solid fa-star"></i>
                                            </span>
                                        </button>
                                    </div>
                                    <div class="col-md-auto px-0">
                                        <div class="dropdown d-none d-md-flex profile-1">
                                            <a href="#" data-bs-toggle="dropdown"
                                                class="nav-link pt-0 leading-none d-flex">
                                                <span>
                                                    @if (Auth::user()->profile_photo_path == NULL)
                                                    <img class="avatar profile-user brround"
                                                        style="object-fit: cover; width: 33px; height: 33px"
                                                        src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&color=7F9CF5&background=EBF4FF"
                                                        alt="profile-user">
                                                    @else
                                                    <img class="avatar profile-user brround"
                                                        style="object-fit: cover; width: 33px; height: 33px"
                                                        src="{{url("/storage/profile-photos/".Auth::user()->profile_photo_path) }}"
                                                    alt="profile-user" s>
                                                    @endif
                                                </span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                <div class="drop-heading">
                                                    <div class="text-center">
                                                        <h5 class="text-dark mb-0">{{ Auth::user()->name }}</h5>
                                                        <small class="text-muted">{{ Auth::user()->role_id == 1 ?
                                                            'Administrator' : 'uwon luyi' }}</small>
                                                    </div>
                                                </div>
                                                <div class="dropdown-divider m-0"></div>

                                                <a class="dropdown-item" href="/user/profile">
                                                    <i class="dropdown-icon fe fe-user"></i> Profile
                                                </a>
                                                <a class="dropdown-item" href="#">
                                                    <i class="dropdown-icon fe fe-user"></i> Upload C1
                                                </a>
                                                <a class="dropdown-item" href="#">
                                                    <i class="dropdown-icon fe fe-user"></i> Upload C1 Enumerator
                                                </a>
                                                <a class="dropdown-item" href="#">
                                                    <i class="dropdown-icon fe fe-user"></i> Upload C1 Relawan
                                                </a>
                                                <a class="dropdown-item" href="#">
                                                    <i class="dropdown-icon fe fe-user"></i> Upload Kecurangan
                                                </a>
                                                <button class="dropdown-item tugel-kolaps" href="#" data-target="setting">
                                                    <i class="dropdown-icon fa-solid fa-gear"></i> Setting
                                                </button>

                                                <form action="{{ route('logout') }}" method="post">
                                                    @csrf
                                                    <button class="dropdown-item" type="submit">
                                                        <i class="dropdown-icon fe fe-alert-circle"></i> Sign out
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="card-footer p-0 border-0" id="marquee1"
                    style="position: relative; background-color: #343a40">
                    {{-- <button class="btn-dark btn-kolapse-sidebar text-white"
                        style="background-color: #30304d; position: absolute; left: 0; z-index: 20; border-0"><i
                            class="fa-solid fa-align-left"></i></button> --}}
                    <button class="btn-dark btn-kolapse text-white h-100"
                        style="background-color: #30304d; position: absolute; left: 0; z-index: 20; border-0"><i
                            class="fa-solid fa-bars"></i></button>
                    <button class="btn-danger text-white h-100 rounded-0"
                        style="position: absolute; left: 28px; z-index: 20">Suara Masuk</button>
                    <a href="https://time.is/Jakarta" id="time_is_link" rel="nofollow"></a>
                    <button class="btn-dark text-white h-100 rounded-0"
                        style="position: absolute; left: 123px; z-index: 20;"><span id="Jakarta_z41c"
                            style="font-size:20px; color: #f7f700"></span> <span
                            style="font-size: 20px; color: #f7f700">WIB</span></button>
                    <script src="//widget.time.is/t.js"></script>
                    <script>
                        time_is_widget.init({
                            Jakarta_z41c: {}
                        });
                    </script>
                    {{-- <button class="btn btn-kolapse text-white" style="background-color: #30304d; z-index: 20"><i
                            class="fa-solid fa-bars"></i></button>
                    <button class="btn btn-danger text-white rounded-0" style="z-index: 20">Suara Masuk</button> --}}
                    <marquee>
                        @foreach ($marquee as $item)
                        <?php $kecamatan =  District::where('id', $item['districts'])->first(); ?>
                        <?php $kelurahan =  Village::where('id', $item['villages'])->first(); ?>
                        <?php $tps =  Tps::where('id', $item['tps_id'])->first(); ?>
                        <span class="text-success">▼ </span><span class="text-white"
                            style="font-size: 20px;">{{$item['name']}}
                            Kecamatan {{$kecamatan['name']}}, Kelurahan {{$kelurahan['name']}}, TPS {{$tps['number']}}
                        </span>
                        @endforeach
                    </marquee>
                </div>
            </div>

            <script>
                $('.btn-kolapse').on('click', function() {
                    $('.for-kolapse').toggle(500);
                    $('.for-kolapse-kurangin > .side-app > .row:first').toggleClass('kurangin')
                })

                // $('.btn-kolapse-sidebar').on('click', function() {
                //     $('body.app.sidebar-mini').toggleClass('sidenav-toggled')
                // })

                $('.tugel-kolaps').on('click', function() {

                    let target = $(this).data('target')

                    // $.cookie('dataTarget', `${target}`, { expires: 7, path: '/' });

                    setCookie("dataTarget", target, 30);

                    // console.log(target)
                    $('.tugel-content').hide()
                    $(`.${target}`).show(200)
                })

                $('.tugel-kolaps-menu').on('click', function() {

                    let target = $(this).data('target')
                    // console.log(target)
                    const cek = $(`.${target}`).css('display') == 'block';

                    $('.tugel-content-menu').hide(500)

                    if (cek) {
                        $('.tugel-content-menu').hide(500)
                    } else {
                        $(`.${target}`).show(500)
                    }
                })

                $('.tugel-kolaps').on('click', function() {
                    const btnIni = $(this);
                    $('.judul-pertama').css("z-index", "-900");
                    $('.tugel-kolaps').removeClass('active-button');
                    btnIni.addClass('active-button');
                });



                // $('.tugel-kolaps-menu.content-toggled').on('click', function() {

                // let target = $(this).data('target')
                // console.log(target)
                // $('.tugel-content-menu').removeClass('content-toggled')
                // $(`.${target}`).toggleClass('content-toggled')
                // })
            </script>

        </div>
    </div>
</div>
<div class="mb-1 navbar navbar-expand-lg  responsive-navbar navbar-dark d-md-none bg-white">
    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
        <div class="d-flex order-lg-2 ms-auto">


            <div class="dropdown d-md-flex message">
                <a class="nav-link icon text-center" data-bs-toggle="dropdown">
                    <i class="fe fe-message-square"></i><span class=" pulse-danger"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">

                    <div class="message-menu">
                        <?php
                        $allUser = App\Models\User::where('id', '!=', Auth::user()->id)
                            ->where('role_id', '!=', 8)
                            ->where('role_id', '!=', 0)
                            ->where('role_id', '!=', 14)
                            ->get(); ?>
                        @foreach ($allUser as $usr)
                        <a class="dropdown-item d-flex" href="#" onclick="openForm(`<?= $usr->id ?>`)">
                            <span class="avatar avatar-md brround me-3 align-self-center cover-image"
                                data-bs-image-src="{{ url('/') }}/assets/images/users/1.jpg"></span>
                            <div class="wd-90p">
                                <div class="d-flex">
                                    <h5 class="mb-1">{{ $usr->name }}</h5>
                                    <small class="text-muted ms-auto text-end">

                                    </small>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    <div class="dropdown-divider m-0"></div>

                </div>
            </div><!-- MESSAGE-BOX -->
            <div class="dropdown d-md-flex profile-1">
                <a href="#" data-bs-toggle="dropdown" class="nav-link pe-2 leading-none d-flex pt-0">
                    <span>
                        @if (Auth::user()->profile_photo_path == NULL)
                        <img class="avatar profile-user brround" style="object-fit: cover"
                            src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&color=7F9CF5&background=EBF4FF"
                            alt="profile-user">
                        @else
                        <img class="avatar profile-user brround" style="object-fit: cover" src="{{url("/storage/profile-photos/".Auth::user()->profile_photo_path) }}" alt="profile-user" s>
                        @endif
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <div class="drop-heading">
                        <div class="text-center">
                            <h5 class="text-dark mb-0">{{ Auth::user()->name }}</h5>
                            <small class="text-muted">{{ Auth::user()->role_id == 1 ? 'Administrator' : 'uwon luyi'
                                }}</small>
                        </div>
                    </div>
                    <div class="dropdown-divider m-0"></div>
                    <a class="dropdown-item" href="/user/profile">
                        <i class="dropdown-icon fe fe-user"></i> Profile
                    </a>

                    <form action="{{ route('logout') }}" method="post">
                        @csrf


                        <button class="dropdown-item" type="submit">
                            <i class="dropdown-icon fe fe-alert-circle"></i> Sign out
                        </button>
                    </form>
                </div>
            </div>
            <div class="dropdown d-md-flex header-settings">
                <a href="#" class="nav-link icon " data-bs-toggle="sidebar-right" data-target=".sidebar-right">
                    <i class="fe fe-menu"></i>
                </a>
            </div><!-- SIDE-MENU -->
        </div>
    </div>
</div>
<!-- /Mobile Header -->

<script>
    $(document).ready(function() {
        var currentUrl = window.location.href; // Get the current URL
        
        $('.glowy-menu').each(function() {
            if ($(this).attr('href') === currentUrl) {
                $(this).addClass('active'); // Add 'active' class if href matches current URL
            }
        });
    });
</script>

<!--app-content open-->
<div class="app-content for-kolapse-kurangin" style="margin-top: 40px; margin-left: 0px !important">
    <div class="side-app">