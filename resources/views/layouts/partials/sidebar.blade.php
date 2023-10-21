<?php

use App\Models\Config;
use App\Models\District;
use App\Models\Province;
use App\Models\RegenciesDomain;
use App\Models\Regency;
use App\Models\Tps;
use Illuminate\Support\Facades\DB;

$config = Config::all()->first();
$regency = District::where('regency_id', $config['regencies_id'])->get();
$kota = Regency::where('id', $config['regencies_id'])->first();
$dpt = District::where('regency_id', $config['regencies_id'])->sum('dpt');
$tps = 2963;
?>
<!-- GLOBAL-LOADER -->
<div id="global-loader">
    <img src="{{url('/')}}/assets/images/loader.svg" class="loader-img" alt="Loader">
</div>
<!-- /GLOBAL-LOADER -->

<style>
    .side-menu__item {
        color: white
    }

    .page .page-main ul li h3 {
        color: white
    }
</style>

<!-- PAGE -->
<div class="page">
    <div class="page-main">
        <!--APP-SIDEBAR-->
        <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
        <aside class="app-sidebar text-white pt-0" style="background-color: #3c4b64 !important;">
            <div class="biru-header">
                <a class="header-brand1" href="{{url('')}}/administrator/index">
                    <li>
                        <center>
                            <img src="{{asset('images/logo')}}/hisuara.png" style="width: 175px">
                        </center>
                    </li>
                </a>
            </div>
            <ul class="side-menu" style="padding: 0 !important">
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
                                <b>{{$kota['name']}}</b>
                            </center>
                        </a>
                    </span>
                </li> -->
                <?php
                    $props = Province::where('id',$kota['province_id'])->first();
                    $cityProp = Regency::where('province_id',$kota['province_id'])->get();

                ?>

                <style>
                    .side-menu .side-menu__icon{
                        color: #fff
                    }

                    .biru-header {
                        padding-bottom: 15px;
                        background: #34425a;
                    }

                    .metro-tabs {
                        border-top: #34425a 3px solid;
                        border-bottom: #34425a 3px solid;
                        position: relative;
                        display: -webkit-box;
                        display: -ms-flexbox;
                        display: flex;
                        -webkit-box-align: center;
                        -ms-flex-align: center;
                        align-items: center;
                        padding: 10px 30px;
                        font-size: 14px;
                        font-weight: 400;
                        -webkit-transition: border-left-color 0.3s ease, background-color 0.3s ease;
                        transition: border-left-color 0.3s ease, background-color 0.3s ease;
                        color: #fff;
                    }

                    .metro-tabs:hover {
                        color: white
                    }
                    
                    .steel-bg {
                        /* background-color: #a8a8a0; */
                        padding: 10px;
                        padding-left: 15px;
                        padding-right: 15px;
                    }

                    .steel-button {
                        height: 35px;
                        padding: 0px;
                        text-align: center;
                        /* background: linear-gradient(180deg, rgba(248,248,240,1) 0%, rgba(231,225,223,1) 100%); */
                        background: transparent;
                        /* color: #76736e; */
                        color: white;
                        font-weight: bold;
                        border-radius: 10px !important;
                        box-shadow: 0px 0px 10px 5px rgba(255,255,255,0.75) inset;
                        -webkit-box-shadow: 0px 0px 10px 5px rgba(255,255,255,0.75) inset;
                        -moz-box-shadow: 0px 0px 10px 5px rgba(255,255,255,0.75) inset;
                        /* border: #505038 1px solid !important; */
                        /* box-shadow: 0px 5px 0px 0px rgba(80,80,56,1);
                        -webkit-box-shadow: 0px 5px 0px 0px rgba(80,80,56,1);
                        -moz-box-shadow: 0px 5px 0px 0px rgba(80,80,56,1); */
                    }

                    .support-system {
                        height: 150px;
                        padding: 0px;
                        padding-top: 20px;
                        padding-bottom: 20px;
                        text-align: center;
                        /* background: linear-gradient(180deg, rgba(248,248,240,1) 0%, rgba(231,225,223,1) 100%); */
                        background: transparent;
                        /* color: #76736e; */
                        color: white;
                        font-weight: bold;
                        border-radius: 10px !important;
                        box-shadow: 0px 0px 10px 5px rgba(255,255,255,0.75) inset;
                        -webkit-box-shadow: 0px 0px 10px 5px rgba(255,255,255,0.75) inset;
                        -moz-box-shadow: 0px 0px 10px 5px rgba(255,255,255,0.75) inset;
                        /* border: #505038 1px solid !important; */
                        /* box-shadow: 0px 5px 0px 0px rgba(80,80,56,1);
                        -webkit-box-shadow: 0px 5px 0px 0px rgba(80,80,56,1);
                        -moz-box-shadow: 0px 5px 0px 0px rgba(80,80,56,1); */
                    }

                    .title-menu {
                        padding: 0px;
                        text-align: center;
                        background: transparent;
                        color: white;
                        font-weight: bold;
                        border-radius: 10px !important;
                        box-shadow: 0px 0px 20px 10px rgba(255,255,255,0.75) inset;
                        -webkit-box-shadow: 0px 0px 20px 10px rgba(255,255,255,0.75) inset;
                        -moz-box-shadow: 0px 0px 20px 10px rgba(255,255,255,0.75) inset;
                    }
                    
                    .slide-menu a {
                        color: white
                    }

                    .slide-item:hover {
                        color: rgb(200, 200, 200) !important;
                    }

                    .slide-item:focus {
                        color: rgb(150, 150, 150) !important;
                    }

                    .active .slide-item {
                        color: rgb(150, 150, 150) !important;
                    }
                    
                </style>

                <div class="biru-menu">

                    <li class="slide mt-5">

                        <a class="side-menu__item" data-bs-toggle="slide" href="#"><i
                                class="side-menu__icon fe fe-grid"></i><span class="side-menu__label">PROVINSI {{$props->name}}</span><i
                                class="angle fa fa-angle-right"></i></a>
                        <ul class="slide-menu">
                            <li><a href="http://pilpres.banten.hisuara.id/index" class="slide-item fw-bolder text-danger">DASHBOARD {{$props->name}}</a></li>
                            <?php $domainKota = RegenciesDomain::join("regencies",'regency_domains.regency_id','=','regencies.id')->where("regency_domains.province_id",$props->id)->get(); ?>
                                @foreach($domainKota as $dokota)
                                <li><a href="{{$dokota->domain}}" class="slide-item">{{$dokota->name}}</a></li>
                                @endforeach
                        </ul>
                    </li>

                    <style>

                        .side-menu__item.active {
                            background: #3c4b64 !important
                        }

                        .side-menu__item.active:hover, .side-menu__item.active:focus {
                            background: white !important;
                        }

                        .side-menu__item.active:hover .side-menu__icon, .side-menu__item.active:focus .side-menu__icon {
                            color: #756dd1 !important
                        }

                        .side-menu__item:hover .side-menu__label, .side-menu__item:focus .side-menu__label{
                            color: #756dd1 !important
                        }
        
                    </style>

                    <li>
                        <a class="side-menu__item" href="{{url('')}}/administrator/index"><i
                                class="side-menu__icon fa-solid fa-gauge-high"></i><span class="side-menu__label">DASHBOARD</span></a>
                    </li>

                    <li>
                        <a class="metro-tabs" href="#" data-bs-toggle="slide" style="border-top: #34425a 6px solid;"><span class="side-menu__label fs-3">PETUGAS</span></a>
                        <ul class="slide-menu">
                            <li><a href="{{url('')}}/administrator/verifikasi_saksi" class="fs-5 slide-item text-white">Saksi</a></li>
                            <li><a href="{{url('')}}/administrator/verifikasi_akun" class="fs-5 slide-item text-white">Admin</a></li>
                            <li><a href="{{url('')}}/administrator/relawan  " class="fs-5 slide-item text-white">Relawan</a></li>
                            <li><a href="#" class="fs-5 slide-item text-white">Enumerator</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="metro-tabs" href="#" data-bs-toggle="slide"><span class="side-menu__label fs-3">OPERATOR</span></a>
                        <ul class="slide-menu">
                            <li><a href="{{url('')}}/verifikator/verifikasi-c1" class="fs-5 slide-item text-white">Verifikasi C1</a></li>
                            <li><a href="{{url('')}}/auditor/audit-c1" class="fs-5 slide-item text-white">Audit C1</a></li>
                            <li><a href="{{url('')}}/administrator/verifikasi_koreksi" class="fs-5 slide-item text-white">Koreksi C1</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="metro-tabs" href="#" data-bs-toggle="slide"><span class="side-menu__label fs-3">PERHITUNGAN</span></a>
                        <ul class="slide-menu">
                            <li><a href="{{url('')}}/administrator/real_count2" class="fs-5 slide-item text-white">Real Count</a></li>
                            <li><a href="{{url('')}}/administrator/quick_count2" class="fs-5 slide-item text-white">Quick Count</a></li>
                            <li><a href="{{url('')}}/administrator/terverifikasi" class="fs-5 slide-item text-white">Terverifikasi</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="metro-tabs" href="#" data-bs-toggle="slide"><span class="side-menu__label fs-3">REKAPITULASI</span></a>
                        <ul class="slide-menu">
                            <li><a href="{{url('')}}/administrator/rekapitulasi_kelurahan" class="fs-5 slide-item text-white">Rekapitualsi Kelurahan</a></li>
                            <li><a href="{{url('')}}/administrator/rekapitulasi_kecamatan" class="fs-5 slide-item text-white">Rekapitualsi Kecamatan</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="metro-tabs" href="#" data-bs-toggle="slide"><span class="side-menu__label fs-3">DOKUMENTASI</span></a>
                        <ul class="slide-menu">
                            <li><a href="#" class="fs-5 slide-item text-white">Data C1</a></li>
                            <li><a href="#" class="fs-5 slide-item text-white">Data C2</a></li>
                            <li><a href="#" class="fs-5 slide-item text-white">Data C3</a></li>
                            <li><a href="#" class="fs-5 slide-item text-white">Data C4</a></li>
                            <li><a href="#" class="fs-5 slide-item text-white">Data C5</a></li>
                            <li><a href="#" class="fs-5 slide-item text-white">Data C6</a></li>
                            <li><a href="#" class="fs-5 slide-item text-white">Data C7</a></li>
                            <li><a href="#" class="fs-5 slide-item text-white">Data C8</a></li>
                            <hr>
                            <li><a href="#" class="fs-5 slide-item text-white fs-6">Total Surat Suara</a></li>
                            <li><a href="#" class="fs-5 slide-item text-white fs-6">Surat Suara Terpakai</a></li>
                            <li><a href="#" class="fs-5 slide-item text-white fs-6">Surat Suara Sah</a></li>
                            <li><a href="#" class="fs-5 slide-item text-white fs-6">Suara Tidak Sah</a></li>
                            <li><a href="#" class="fs-5 slide-item text-white fs-6">Sisa Surat Suara</a></li>
                        </ul>
                    </li>
                    

                    {{-- <li>
                        <a class="side-menu__item" href="#"><i class="side-menu__icon mdi mdi-account-multiple"></i><span class="side-menu__label">Saksi</span></a>
                    </li>
                    
                    <li>
                        <a class="side-menu__item" href="#"><i class="side-menu__icon mdi mdi-account-multiple"></i><span class="side-menu__label">Admin</span></a>
                    </li>

                    <li>
                        <a class="side-menu__item" href="#"><i class="side-menu__icon mdi mdi-account-multiple"></i><span class="side-menu__label">Payroll</span></a>
                    </li>

                    <li>
                        <a class="side-menu__item" href="#"><i class="side-menu__icon mdi mdi-account-multiple"></i><span class="side-menu__label">Real Count</span></a>
                    </li>

                    <li>
                        <a class="side-menu__item" href="#"><i class="side-menu__icon mdi mdi-account-multiple"></i><span class="side-menu__label">Quick Count</span></a>
                    </li>
                    <li>
                        <a class="side-menu__item" href="#"><i class="side-menu__icon mdi mdi-account-multiple"></i><span class="side-menu__label">Terverifikasi</span></a>
                    </li>
                    <li>
                        <a class="side-menu__item" href="#"><i class="side-menu__icon mdi mdi-account-multiple"></i><span class="side-menu__label">Operator Hisuara</span></a>
                    </li> --}}
                    
                    {{-- <li>
                        <div class="row steel-bg">
                            <div class="col-12" style="padding:5px;">
                                <div class="card mb-0 text-center title-menu rounded-0 w-100">
                                    <div class="my-auto" style="font-size: 30px">Menu</div>
                                </div>
                            </div>
                        </div>

                        <div class="row steel-bg">
                            <div class="col-6" style="padding:5px;">
                                <div class="card mb-0 text-center steel-button rounded-0 w-100">
                                    <div class="my-auto" style="font-size: 14px">Saksi</div>
                                </div>
                            </div>

                            <div class="col-6" style="padding:5px;">
                                <div class="card mb-0 text-center steel-button rounded-0 w-100">
                                    <div class="my-auto" style="font-size: 14px">Real Count</div>
                                </div>
                            </div>
                        </div>

                        <div class="row steel-bg">
                            <div class="col-6" style="padding:5px;">
                                <div class="card mb-0 text-center steel-button rounded-0 w-100">
                                    <div class="my-auto" style="font-size: 14px">Admin</div>
                                </div>
                            </div>

                            <div class="col-6" style="padding:5px;">
                                <div class="card mb-0 text-center steel-button rounded-0 w-100">
                                    <div class="my-auto" style="font-size: 14px">Quick Count</div>
                                </div>
                            </div>
                        </div>

                        <div class="row steel-bg">
                            <div class="col-6" style="padding:5px;">
                                <div class="card mb-0 text-center steel-button rounded-0 w-100">
                                    <div class="my-auto" style="font-size: 14px">Payroll</div>
                                </div>
                            </div>
                            <div class="col-6" style="padding:5px;">
                                <div class="card mb-0 text-center steel-button rounded-0 w-100">
                                    <div class="my-auto" style="font-size: 14px">Terverifikasi</div>
                                </div>
                            </div>
                        </div>

                        <div class="row steel-bg">
                            <div class="col-12" style="padding:5px;">
                                <div class="card mb-0 text-center support-system rounded-0 w-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="auto" height="auto" x="0" y="0" viewBox="0 0 682.667 682.667" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><defs><clipPath id="a" clipPathUnits="userSpaceOnUse"><path d="M0 512h512V0H0Z" fill="#ffffff" opacity="1" data-original="#000000" class=""></path></clipPath></defs><g clip-path="url(#a)" transform="matrix(1.33333 0 0 -1.33333 0 682.667)"><path d="M0 0c13.296-4.493 27.537-6.934 42.35-6.934 30.25 0 58.122 10.166 80.401 27.26C142.45 4.743 166.898-5.083 193.564-6.679a1.616 1.616 0 0 1 1.704 1.613" style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(158.277 352.182)" fill="none" stroke="#ffffff" stroke-width="20" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" opacity="1" class=""></path><path d="M0 0h-16.757C-43.854 0-65.82 21.966-65.82 49.063v0c0 27.097 21.966 49.064 49.063 49.064H0z" style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(158.357 260.415)" fill="none" stroke="#ffffff" stroke-width="20" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" opacity="1" class=""></path><path d="M0 0h16.757C43.854 0 65.82 21.966 65.82 49.063v0c0 27.097-21.966 49.064-49.063 49.064H0Z" style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(353.637 260.415)" fill="none" stroke="#ffffff" stroke-width="20" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" opacity="1" class=""></path><path d="M0 0v7.717C0 82.72-60.802 143.522-135.805 143.522v0c-75.003 0-135.805-60.802-135.805-135.805V0" style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(391.805 358.478)" fill="none" stroke="#ffffff" stroke-width="20" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" opacity="1" class=""></path><path d="M0 0v7.408c0 53.706-43.693 97.399-97.4 97.399-53.706 0-97.399-43.693-97.399-97.399V0" style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(353.396 357.193)" fill="none" stroke="#ffffff" stroke-width="20" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" opacity="1" class=""></path><path d="M0 0h56.664" style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(286.086 250.991)" fill="none" stroke="#ffffff" stroke-width="20" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" opacity="1" class=""></path><path d="M0 0h-13.387c-11.089 0-20.079-8.99-20.079-20.08v0c0-11.09 8.99-20.08 20.079-20.08H0c11.09 0 20.08 8.99 20.08 20.08v0C20.08-8.99 11.09 0 0 0Z" style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(263.133 271.071)" fill="none" stroke="#ffffff" stroke-width="20" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" opacity="1" class=""></path><path d="M0 0v-49.39c0-53.927 43.716-97.643 97.643-97.643h.001c53.927 0 97.643 43.716 97.643 97.643v44.494" style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(158.357 337.785)" fill="none" stroke="#ffffff" stroke-width="20" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" opacity="1" class=""></path><path d="M0 0v33.895" style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(214.226 164.674)" fill="none" stroke="#ffffff" stroke-width="20" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" opacity="1" class=""></path><path d="M0 0h-201v0c0 81.515 66.081 147.595 147.596 147.595h31.155" style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(211 10)" fill="none" stroke="#ffffff" stroke-width="20" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" opacity="1" class=""></path><path d="M0 0h32.811c81.514 0 147.595-66.081 147.595-147.595v0h-201" style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(321.594 157.595)" fill="none" stroke="#ffffff" stroke-width="20" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" opacity="1" class=""></path><path d="M0 0v-33.895" style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(297.774 198.57)" fill="none" stroke="#ffffff" stroke-width="20" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" opacity="1" class=""></path><path d="m0 0 47.898-47.898 47.305 69.544-50.904 22.653L0 0M0 0l-47.898-47.898-47.305 69.544 50.904 22.653L0 0" style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(255.91 122.812)" fill="none" stroke="#ffffff" stroke-width="20" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" opacity="1" class=""></path><path d="M0 0v0" style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(256 10)" fill="none" stroke="#ffffff" stroke-width="20" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" opacity="1" class=""></path></g></g></svg>
                                    <div class="mt-2">
                                        Operator Hisuara
                                    </div>
                                </div>
                            </div>
                        </div>

                    </li> --}}
                    

                    {{-- <li>
                        <h3 style="margin: 0 !important">
                            <div class="card mb-0 text-center metro-tabs rounded-0 text-white w-100">
                                <div class="my-auto h4 fw-bold">Payroll</div>
                            </div>
                        </h3>
                    </li>
                    <li>
                        <h3 style="margin: 0 !important">
                            <div class="card mb-0 text-center metro-tabs rounded-0 text-white w-100">
                                <div class="my-auto h4 fw-bold">Real Count</div>
                            </div>
                        </h3>
                    </li>
                    <li>
                        <h3 style="margin: 0 !important">
                            <div class="card mb-0 text-center metro-tabs rounded-0 text-white w-100">
                                <div class="my-auto h4 fw-bold">Quick Count</div>
                            </div>
                        </h3>
                    </li>
                    <li>
                        <h3 style="margin: 0 !important">
                            <div class="card mb-0 text-center metro-tabs rounded-0 text-white w-100">
                                <div class="my-auto h4 fw-bold">Terverifikasi</div>
                            </div>
                        </h3>
                    </li>
                    <li>
                        <h3 style="margin: 0 !important">
                            <div class="card mb-0 text-center metro-tabs rounded-0 text-white w-100">
                                <div class="my-auto h4 fw-bold">Verifikasi C1</div>
                            </div>
                        </h3>
                    </li>
                    <li>
                        <h3 style="margin: 0 !important">
                            <div class="card mb-0 text-center metro-tabs rounded-0 text-white w-100">
                                <div class="my-auto h4 fw-bold">Audit C1</div>
                            </div>
                        </h3>
                    </li>
                    <li>
                        <h3 style="margin: 0 !important">
                            <div class="card mb-0 text-center metro-tabs rounded-0 text-white w-100">
                                <div class="my-auto h4 fw-bold">Komparasi KPU</div>
                            </div>
                        </h3>
                    </li> --}}

                    {{-- <li>
                        <a class="side-menu__item" href="{{url('')}}/administrator/real_count2"><i
                                class="side-menu__icon mdi mdi-check-circle"></i><span class="side-menu__label">Real
                                Count</span></a>
                    </li> --}}

                    {{-- <li>
                        <a class="side-menu__item" href="{{url('')}}/administrator/quick_count2"><i class="side-menu__icon mdi mdi-quicktime"></i><span
                                class="side-menu__label">Quick Count</span></a> 
                    </li> --}}

                    <!-- <li>
                        <a class="side-menu__item" href="{{url('')}}/administrator/maps_count"><i
                                class="side-menu__icon mdi mdi-google-maps"></i><span class="side-menu__label">Maps
                                Count</span></a>
                    </li> -->

                    {{-- <li>
                        <h3>Administrator</h3>
                    </li> --}}

                    {{-- <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="#"><i
                                class="side-menu__icon fe fe-grid"></i><span class="side-menu__label">Otentifikasi</span><i
                                class="angle fa fa-angle-right"></i></a>
                        <ul class="slide-menu">
                            <li><a href="{{url('')}}/administrator/absensi" class="slide-item">Absensi Saksi</a></li>
                            <li><a href="/v2l_security/{{encrypt(7)}}?title=Otentifikasi Saksi"
                                    class="slide-item">Otentifikasi Saksi</a></li>
                            <li><a href="/v2l_security/{{encrypt(8)}}?title=Otentifikasi Admin"
                                    class="slide-item">Otentifikasi Admin</a></li>
                            <li><a href="/v2l_security/{{encrypt(9)}}?title=Otentifikasi Koreksi"
                                    class="slide-item">Otentifikasi Koreksi</a></li>
                        </ul>
                    </li> --}}

                    <!-- <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon mdi mdi-account-check"></i><span class="side-menu__label">Admin Verifikator</span><i class="angle fa fa-angle-right"></i></a>
                        <ul class="slide-menu">
                            @foreach ($regency as $rg)
                            <li><a href="/key_kecamatan/{{encrypt($rg['id'])}}/{{encrypt(1)}}?title=Verifikator" class="slide-item">KEC. {{$rg['name']}}</a></li>
                            @endforeach
                        </ul>
                    </li> -->

                    <!-- <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon mdi mdi-compare"></i><span class="side-menu__label">Admin Komparasi KPU</span><i class="angle fa fa-angle-right"></i></a>
                        <ul class="slide-menu">
                            @foreach ($regency as $rg)
                            <li><a href="/key_kecamatan/{{encrypt($rg['id'])}}/{{encrypt(5)}}?title=Komparasi" class="slide-item">KEC. {{$rg['name']}}</a></li>
                            @endforeach
                        </ul>
                    </li> -->
                    <!-- <li>
                        <a class="side-menu__item" href="/v2l_security/{{encrypt(14)}}?title=Admin Relawan"><i class="side-menu__icon mdi mdi-account-multiple"></i><span class="side-menu__label">Admin Relawan</span></a>
                    </li> -->
                    <!-- <li>
                        <a class="side-menu__item" href="/v2l_security/{{encrypt(13)}}?title=Admin Over Limit"><i class="side-menu__icon mdi mdi-speedometer"></i><span class="side-menu__label">Admin Over Limit</span></a>
                    </li> -->

                    {{-- <li>
                        <a class="side-menu__item" href="/v2l_security/{{encrypt(10)}}?title=Pembayaran Saksi"><i
                                class="side-menu__icon fa fa-money"></i><span class="side-menu__label">Pembayaran
                                Saksi</span></a>
                    </li>
                    <li>
                        <a class="side-menu__item" href="#" type="button" data-bs-toggle="modal" data-bs-target="#chat"><i
                                class="side-menu__icon fa fa-cogs"></i><span class="side-menu__label">Bantuan Support System</span></a>
                    </li> --}}

                    {{-- <li>
                        <h3>Verifikator</h3>
                    </li>

                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="#"><i
                                class="side-menu__icon mdi mdi-account-check"></i><span class="side-menu__label">Verifikasi
                                Suara Saksi</span><i class="angle fa fa-angle-right"></i></a>
                        <ul class="slide-menu">
                            @foreach ($regency as $rg)

                            <li><a href="/key_kecamatan/{{encrypt($rg['id'])}}/{{encrypt(1)}}?title=Verifikasi Suara Saksi"
                                    class="slide-item">KEC. {{$rg['name']}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <a class="side-menu__item" href="/v2l_security/{{encrypt(14)}}?title=Verifikasi Suara Relawan Partai"><i
                                class="side-menu__icon mdi mdi-account-multiple"></i><span class="side-menu__label">Verifikasi Suara Relawan Partai</span></a>
                    </li>
                    <li>
                        <a class="side-menu__item" href="/v2l_security/{{encrypt(13)}}?title=Verifikasi Suara Overtime"><i
                                class="side-menu__icon mdi mdi-speedometer"></i><span class="side-menu__label">Verifikasi Suara Overtime</span></a>
                    </li> --}}
                    <!-- <li>
                        <a class="side-menu__item" href="/v2l_security/{{encrypt(13)}}?title=Verifikasi Suara Overtime"><i
                                class="side-menu__icon mdi mdi-dropbox"></i><span class="side-menu__label">Verifikasi Suara Saksi Partai</span></a>
                    </li> -->

                    {{-- <li>
                        <h3>Audit</h3>
                    </li> --}}

                    {{-- <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="#"><i
                                class="side-menu__icon mdi mdi-account-check"></i><span class="side-menu__label">Audit Suara Masuk</span><i class="angle fa fa-angle-right"></i></a>
                        <ul class="slide-menu">
                            @foreach ($regency as $rg)
                            <li><a href="/key_kecamatan/{{encrypt($rg['id'])}}/{{encrypt(3)}}?title=Audit Suara Masuk"
                                    class="slide-item">KEC. {{$rg['name']}}</a></li>
                            @endforeach
                        </ul>
                    </li> --}}

                    <!-- <li>
                        <h3>Kecurangan</h3>
                    </li>
                    <li>
                        <a class="side-menu__item" href="/v2l_security/{{encrypt(11)}}?title=Validasi Kecurangan"><i
                                class="side-menu__icon mdi mdi-scale-balance"></i><span class="side-menu__label">Validasi
                                Kecurangan</span></a>
                    </li>
                    <li>
                        <a class="side-menu__item" href="/v2l_security/{{encrypt(26)}}?title=Indikasi Realisasi DPT"><i
                                class="side-menu__icon mdi mdi-google-analytics"></i><span class="side-menu__label">Indikasi Realisasi DPT</span></a>
                    </li> -->


                    {{-- <li>
                        <h3>Fitur Utama</h3>
                    </li> --}}

                    <!-- <li>
                        <a class="side-menu__item" href="/v2l_security/{{encrypt(20)}}?title=Pencetakan Data Kecurangan"><i
                                class="side-menu__icon mdi mdi-printer"></i><span class="side-menu__label">Pencetakan Data Kecurangan</span></a>
                    </li>
                    <li>
                        <a class="side-menu__item"
                            href="/v2l_security/{{encrypt(21)}}?title=Barcode Data Kecurangan"><i
                                class="side-menu__icon mdi mdi-barcode"></i><span class="side-menu__label">Barcode Data Kecurangan</span></a>
                    </li> -->
                    <!-- <li>
                        <a class="side-menu__item" href="/v2l_security/{{encrypt(22)}}?title=Indikator Data TSM"><i
                                class="side-menu__icon mdi mdi-chart-arc"></i><span class="side-menu__label">Indikator Data TSM</span></a>
                    </li> -->

                    {{-- <li>
                        <a class="side-menu__item" href="/v2l_security/{{encrypt(23)}}?title=Komparasi Data Perhitungan"><i
                                class="side-menu__icon mdi mdi mdi-compare"></i><span class="side-menu__label">Komparasi Data Perhitungan</span></a>
                    </li> --}}

                    <!-- <li>
                        <h3>Laporan Kecurangan</h3>
                    </li>

                    <li>
                        <a class="side-menu__item" href="/v2l_security/{{encrypt(18)}}?title=Tim Hukum Paslon"><i
                                class="side-menu__icon mdi mdi-scale-balance"></i><span class="side-menu__label">Tim Hukum
                                Paslon</span></a>
                    </li>
                    <li>
                        <a class="side-menu__item" href="/v2l_security/{{encrypt(19)}}?title=Bawaslu"><i
                                class="side-menu__icon mdi mdi-file-chart"></i><span class="side-menu__label">Bawaslu</span></a>
                    </li>
                    <li>
                        <a class="side-menu__item" href="/v2l_security/{{encrypt(24)}}?title=Mahkamah Konstitusi (MK)"><i
                                class="side-menu__icon fa fa-gavel"></i><span class="side-menu__label">Mahkamah Konstitusi (MK)</span></a>
                    </li> -->

                    <li class="slide">

                        <a class="side-menu__item" data-bs-toggle="slide" href="#"><i
                                class="side-menu__icon fa-solid fa-gears"></i><span class="side-menu__label">Pengaturan</span><i
                                class="angle fa fa-angle-right"></i></a>
                        <ul class="slide-menu">
                            <li><a href="#modalCommander" data-bs-toggle="modal"
                            data-jenis="setting" data-izin="multi_admin" data-title="Multi Admin"
                            data-deskripsi="Mode Multi Administrator adalah fitur dimana Administrator dapat login di beberapa device pada saat bersamaan." 
                            class="slide-item">Mode Multi Admin</a></li>

                            <li><a href="#modalCommander" data-bs-toggle="modal"
                            data-jenis="setting" data-izin="otonom" data-title="Mode Otonom"
                            data-deskripsi="Mode Otonom adalah sistem Hisuara yang berjalan tanpa admin dan hanya menampilkan perolehan suara yang dikirim oleh saksi." 
                            class="slide-item">Mode Otonom</a></li>

                            <li><a href="#modalCommander" data-bs-toggle="modal" data-jenis="redirect"
                            data-izin="{{url('')}}/administrator/patroli_mode/tracking/maps"
                            data-title="Lacak Admin" data-deskripsi="Lacak Admin adalah sistem untuk melacak posisi admin berdasarkan demografi wilayah pemilihan."
                            class="slide-item">Mode Patroli</a></li>

                            <li><a href="#modalCommander" href="#modalCommander" data-bs-toggle="modal"
                            data-jenis="setting" data-izin="lockdown" data-title="Mode Lockdown"
                            data-deskripsi="Mode Lockdown adalah penutupan sementara seluruh admin. Status lockdown terjadi biasanya karena ada serangan hacker dan atau proses perhitungan yang telah dinyatakan selesai."
                            class="slide-item">Mode Lockdown</a></li>

                            <li><a href="#modalCommander" data-bs-toggle="modal"
                            data-jenis="setting" data-izin="show_terverifikasi" data-title="Mode Verifikasi Publik"
                            data-deskripsi="Mode Verifikasi adalah publikasi data terverifikasi untuk dilihat pada publik. Hasil suara terverifikasi bisa lebih rendah, lebih tinggi ataupun sama dengan suara masuk."
                            class="slide-item">Mode Verifikasi</a></li>

                            <li><a href="#modalCommander" href="#modalCommander" data-bs-toggle="modal"
                            data-jenis="setting" data-izin="show_public" data-title="Mode C1 Publik"
                            data-deskripsi="Mode Publikasi C1 adalah mode untuk menampilkan lampiran C1 kepada publik atau masyarakat melalui Hisuara.id"
                            class="slide-item">Mode Publikasi C1</a></li>

                            <li><a href="#modalCommander" data-bs-toggle="modal" data-jenis="redirect"
                            data-izin="{{url('')}}/administrator/r-data" data-title="Data Tracking" data-deskripsi="Anda membutuhkan izin commander untuk mengakses halaman ini."
                            class="slide-item">Mode Tracking</a></li>

                            <li><a href="#modalCommander" data-bs-toggle="modal"
                            data-jenis="setting" data-izin="master_data_tps" data-title="Mode Data TPS"
                            data-deskripsi="Mode Data C1 adalah mode untuk menampilkan Data rekam Rekam C1"
                            class="slide-item">Mode Data C1</a></li>

                        </ul>
                    </li>

                    {{-- <li>
                        <h3>Pengaturan</h3>
                    </li> --}}

                    {{-- <li>
                        <a class="side-menu__item modal-action" href="#modalCommander" data-bs-toggle="modal"
                            data-jenis="setting" data-izin="multi_admin" data-title="Multi Admin"
                            data-deskripsi="Mode Multi Administrator adalah fitur dimana Administrator dapat login di beberapa device pada saat bersamaan.">
                            <i class="side-menu__icon mdi mdi-account-multiple-outline"></i><span
                                class="side-menu__label">Mode Multi Admin</span></a>
                    </li> --}}

                    {{-- <li>
                        <a class="side-menu__item modal-action" href="#modalCommander" data-bs-toggle="modal"
                            data-jenis="setting" data-izin="otonom" data-title="Mode Otonom"
                            data-deskripsi="Mode Otonom adalah sistem Hisuara yang berjalan tanpa admin dan hanya menampilkan perolehan suara yang dikirim oleh saksi.">
                            <i class="side-menu__icon fa fa-magic"></i><span class="side-menu__label">Mode Otonom</span></a>
                    </li> --}}

                    <!-- <li class="slide">
                        <a class="side-menu__item modal-action" data-bs-toggle="slide" href="#"><i
                                class="side-menu__icon mdi mdi-satellite-variant  "></i><span class="side-menu__label">Admin Tracking</span><i class="angle fa fa-angle-right"></i></a>
                        <ul class="slide-menu">

                            <li><a href="#modalCommander" data-bs-toggle="modal" data-jenis="redirect"
                                    data-izin="{{url('')}}/administrator/patroli_mode/tracking/maps"
                                    data-title="Lacak Admin" data-deskripsi="Lacak Admin adalah sistem untuk melacak posisi admin berdasarkan demografi wilayah pemilihan."
                                    class="slide-item modal-action" class="slide-item">Lacak Admin</a></li>
                        </ul>
                    </li> -->

                    {{-- <li>
                        <a href="#modalCommander" data-bs-toggle="modal" data-jenis="redirect"
                                    data-izin="{{url('')}}/administrator/patroli_mode" data-title="Mode Patroli"
                                    data-deskripsi="Mode Patroli adalah sistem untuk melihat aktifitas admin yang sedang bertugas maupung yang selesai bertugas." class="side-menu__item modal-action"> <i
                                class="side-menu__icon mdi mdi-satellite-variant  "></i><span class="side-menu__label">Mode Patroli</span></a>

                    </li> --}}

                    {{-- <li>
                        <a class="side-menu__item modal-action" href="#modalCommander" data-bs-toggle="modal"
                            data-jenis="setting" data-izin="lockdown" data-title="Mode Lockdown"
                            data-deskripsi="Mode Lockdown adalah penutupan sementara seluruh admin. Status lockdown terjadi biasanya karena ada serangan hacker dan atau proses perhitungan yang telah dinyatakan selesai.">
                            <i class="side-menu__icon mdi mdi-lock"></i>
                            <span class="side-menu__label">Mode Lockdown</span></a>
                    </li> --}}

                    {{-- <li>
                        <a class="side-menu__item modal-action" href="#modalCommander" data-bs-toggle="modal"
                            data-jenis="setting" data-izin="show_terverifikasi" data-title="Mode Verifikasi Publik"
                            data-deskripsi="Mode Verifikasi adalah publikasi data terverifikasi untuk dilihat pada publik. Hasil suara terverifikasi bisa lebih rendah, lebih tinggi ataupun sama dengan suara masuk.">
                            <i class="side-menu__icon mdi mdi-account-check"></i><span class="side-menu__label">Mode
                                Verifikasi</span></a>
                    </li> --}}

                    {{-- <li>
                        <a class="side-menu__item modal-action" href="#modalCommander" data-bs-toggle="modal"
                            data-jenis="setting" data-izin="show_public" data-title="Mode C1 Publik"
                            data-deskripsi="Mode Publikasi C1 adalah mode untuk menampilkan lampiran C1 kepada publik atau masyarakat melalui Hisuara.id">
                            <i class="side-menu__icon mdi mdi-image"></i><span class="side-menu__label">Mode Publikasi C1</span></a>
                    </li> --}}

                    {{-- <li>
                        <a class="side-menu__item modal-action" href="#modalCommander" data-bs-toggle="modal" data-jenis="redirect"
                            data-izin="{{url('')}}/administrator/r-data" data-title="Data Tracking" data-deskripsi="Anda membutuhkan izin commander untuk mengakses halaman ini.">
                            <i class="side-menu__icon mdi mdi-record"></i><span class="side-menu__label">Mode
                                Tracking</span></a>
                    </li> --}}

                    {{-- <li>
                        <a class="side-menu__item modal-action" href="#modalCommander" data-bs-toggle="modal"
                            data-jenis="setting" data-izin="master_data_tps" data-title="Mode Data TPS"
                            data-deskripsi="Mode Data C1 adalah mode untuk menampilkan Data rekam Rekam C1">
                            <i class="side-menu__icon mdi mdi-file"></i><span class="side-menu__label">Mode Data C1</span></a>
                    </li> --}}


                    {{-- <li>
                        <h3>Informasi DPT/TPS</h3>
                    </li> --}}

                    {{-- <li>
                        <a class="side-menu__item" href="#">
                            <i class="side-menu__icon mdi mdi-arrow-right-drop-circle"></i><span class="side-menu__label">Total DPT {{$dpt}}</span></a>
                    </li>
                    <li>
                        <a class="side-menu__item" href="#">
                            <i class="side-menu__icon mdi mdi-arrow-right-drop-circle-outline"></i><span class="side-menu__label">Total TPS {{$tps}}</span></a>
                    </li>
                    <li>
                        <h3>Bantuan</h3>
                    </li>
                    <li>
                        <a class="side-menu__item" href="https://help.rekapitung.id">
                            <i class="side-menu__icon fa fa-question"></i><span class="side-menu__label">Bantuan</span></a>
                    </li> --}}

                    {{-- <li>
                        <h3>Demontrasi</h3>
                    </li>

                    <li>
                        <a class="side-menu__item" href="/v2l_security/{{encrypt(16)}}?title=Input C1 Plano">
                            <i class="side-menu__icon mdi mdi-file-account"></i><span class="side-menu__label">Upload C1</span></a>
                    </li>

                
                    <li>
                        <a class="side-menu__item" href="/v2l_security/{{encrypt(30)}}?title=Input C1 Quick Count">
                            <i class="side-menu__icon mdi mdi-file"></i><span class="side-menu__label">Input C1 Quick Count</span></a>
                    </li> --}}
                    <!-- <li>
                        <a class="side-menu__item" href="#">
                            <i class="side-menu__icon mdi mdi-settings"></i><span class="side-menu__label">Data Setup</span></a>
                    </li> -->
                    {{-- <li>
                        <a class="side-menu__item" href="{{url('')}}/administrator/dev-pass">
                            <i class="side-menu__icon mdi mdi-flash"></i><span class="side-menu__label">Mode Developer</span></a>
                    </li> --}}

                    <hr>
                    <li>
                        <a class="side-menu__item" href="#" type="button" data-bs-toggle="modal" data-bs-target="#chat"><i
                                class="side-menu__icon fa-solid fa-headset"></i><span class="side-menu__label">Support</span></a>
                    </li>
                    <li>
                        <!-- <a class="side-menu__item" href="#"><i class="side-menu__icon mdi mdi-logout"></i><span class="side-menu__label">Logout</span></a> -->
                        <form action="{{ route('logout') }}" method="post">
                            @csrf


                            <a class="side-menu__item" onclick="$($(this).parent()).submit()" style="cursor: pointer">
                                <i class="side-menu__icon mdi mdi-logout"></i> Sign out
                            </a>
                        </form>
                    </li>
                </div>

            </ul>
        </aside>
        <div class="modal fade" style="background-color: rgba(0, 0, 0, 0.5)" id="modalCommander" tabindex="-1" aria-labelledby="modalCommanderLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content" style="background-color: black; border-radius: 25px">
                    <div class="modal-header">
                        <div class="row w-100 justify-content-end  align-items-center">
                            <div class="col-md">
                                <!--<h5 class="modal-title text-white my-auto" id="modalCommanderLabel"></h5>-->
                                <span><img src="{{url('')}}/images/logo/rekapitung_gold.png" style="width:100px" alt=""> <b
                                        class="text-white fs-3">COMMANDER MODE</b></span>
                            </div>
                            <div class="col-md-5">
                                <b class="text-white fs-5 d-flex justify-content-end align-items-center my-auto align-self-center"
                                    id="modalCommanderLabel"></b>
                            </div>
                        </div>

                    </div>
                    <form action="{{url('')}}/administrator/main-permission" id="form-izin" method="post">
                        @csrf
                        <input type="hidden" value="" name="izin">
                        <input type="hidden" value="" name="jenis">
                        <input type="hidden" name="order" value="{{Auth::user()->id}}">
                        <div class="modal-body">
                            <p id="text-container" class="text-white">

                            </p>
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="number" class="form-control" name="kode" placeholder="kode">
                                </div>
                            </div>
                            <input type="hidden" name="order" value="{{Auth::user()->id}}">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn text-white" style="background-color: red;">Commander Permission</button>
                            <button type="button" class="btn" style="background-color: white" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" style="background-repeat: no-repeat;
                background-size: cover;" id="modalMap" tabindex="-1" aria-labelledby="modalCommanderLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content bg-dark">
                    <div class="modal-header">
                        <div class="row w-100 justify-content-end  align-items-center">
                            <div class="col-md">
                                <span><img src="{{url('')}}/public/storage/alien.png" style="width:100px" alt=""> <b
                                        class="text-white fs-3" style="margin-left: -20px;">DETAIL TRACKING</b></span>
                            </div>
                            <div class="col-md-5">
                                <b class="text-white fs-5 d-flex justify-content-end align-items-center my-auto align-self-center"
                                    id="modalCommanderLabel"></b>
                            </div>
                        </div>

                    </div>
                    <form action="{{url('')}}/administrator/main-permission" id="form-izin" method="post">
                        @csrf
                        <input type="hidden" value="" name="izin">
                        <input type="hidden" value="" name="jenis">
                        <input type="hidden" name="order" value="{{Auth::user()->id}}">
                        <div class="modal-body">
                            <p id="text-container" class="text-white">

                            </p>
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="number" class="form-control" name="kode" placeholder="kode">
                                </div>
                            </div>
                            <input type="hidden" name="order" value="{{Auth::user()->id}}">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn">Commander Permission</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-dark">
                    <div class="modal-header">
                        <div class="row w-100 justify-content-end  align-items-center">
                            <div class="col-md">
                                <!--<h5 class="modal-title text-white my-auto" id="modalCommanderLabel"></h5>-->
                                <span><img src="{{url('')}}/public/storage/alien.png" style="width:100px" alt=""> <b
                                        class="text-white fs-3" style="margin-left: -20px;">COMMANDER CODE</b></span>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-white">
                        <div class="container p-2">
                            <h3>
    
                                @if ($message = Session::get('error'))
                                {{$message}}
                                @endif
                            </h3>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>

        <style>
            p#text-container {
                font-size: 16px;
            }

        </style>

        <script>
            @if($message = Session::get('error'))
            $(document).ready(function () {
                let alertModal = new bootstrap.Modal(document.getElementById('alertModal'), {
                    keyboard: false
                });
                alertModal.show();
            });
            @endif


            const buttonModal = $('.modal-action');
            buttonModal.on('click', function () {
                const title = $(this).data('title');
                const inputIzin = $($('form#form-izin').find('input[name=izin]'));
                const izin = $(this).data('izin');
                const jenis = $(this).data('jenis');
                const inputjenis = $($('form#form-izin').find('input[name=jenis]'));
                const deskripsi = $(this).data('deskripsi');
                const containerTitle = $('#modalCommanderLabel');
                const containerDeskripsi = $('#text-container');
                inputIzin.val(izin)
                containerDeskripsi.html(deskripsi)
                containerTitle.html(title)
                inputjenis.val(jenis);
            });

        </script>
