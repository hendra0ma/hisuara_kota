@extends('layouts.mainlayoutProvinsi')
@section('content')
<?php

use App\Models\Config;
use App\Models\District;
use App\Models\ProvinceDomain;
use App\Models\Regency;
use App\Models\SaksiData;
use App\Models\Tps;
use App\Models\Village;
use App\Models\User;
use App\Models\RegenciesDomain;
use Illuminate\Support\Facades\DB;

$config = Config::first();


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


    <div class="col-lg col-md mt-4">
        <div class="row g-0">
            <div class="col-md">



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
                </style>
                <div class="row">






                </div>

                <div class="row">
                    <div class="col-lg-6" style="{{($config->quick_count == 'yes')?'':'display:none'}}">
                        <div class="card" style="margin-bottom: 1rem">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xxl-12">
                                        <div class="container">
                                            <div class="text-center fs-3 mb-3 fw-bold">QUICK COUNT</div>
                                            <div class="text-center">Progress {{substr($realcount,0,5)}}% dari 100%</div>
                                            <div class="text-center mt-2 mb-2"><span class="badge bg-success">{{$total_incoming_vote}} / {{$dpt}}</span></div>
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

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xxl-12">
                                        <div class="container">
                                            <div class="text-center fs-3 mb-3 fw-bold">REAL COUNT</div>
                                            <div class="text-center">Progress {{substr($realcount,0,5)}}% dari 100%</div>
                                            <div class="text-center mt-2 mb-2"><span class="badge bg-success">{{$total_incoming_vote}} /
                                                    {{$dpt}}</span></div>
                                            <div id="chart-pie" class="chartsh h-100 w-100"></div>
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


                                <table class="table table-bordered table-hover ">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th class="text-white text-center align-middle">PROVINSI</th>
                                            @foreach ($paslon as $item)
                                            <th class="text-white text-center align-middle">{{ $item['candidate']}} - <br>
                                                {{ $item['deputy_candidate']}}
                                            </th>
                                            @endforeach

                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($kota as $item)
                                            <?php $domainProv = RegenciesDomain::where('regency_id',$item->id)->first(); ?>
                                        <tr onclick='check("{{$domainProv->domain}}")'>
                                            <td><a href="http://{{$domainProv->domain}}{{env('HTTP_PORT','')}}/administrator/index">{{$item['name']}}</a>
                                            </td>
                                            @foreach ($paslon as $cd)
                                            <?php $saksi_dataa = SaksiData::join('saksi', 'saksi.id', '=', 'saksi_data.saksi_id')->where('saksi_data.paslon_id', $cd['id'])
                                               ->where('saksi_data.regency_id',$item->id)
                                            ->sum('voice'); ?>
                                            <td>{{$saksi_dataa}}</td>
                                            @endforeach
                                        </tr>
                                        @endforeach
                                    </tbody>

                                    <script>
                                        let check = function(id) {
                                            window.location = `https://${id}/administrator/index`;
                                        }
                                    </script>
                                </table>

                            </div>
                        </div>
                    </div>

                    @if ($config->quick_count == 'yes')
                    <div class="col-lg col-md" style="display:{{($config->otonom == 'yes')?'none':'block'}}">
                        <div class="card">
                         
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-xxl-12">
                                                <div class="container">
                                                    <div class="text-center fs-3 mb-3 fw-bold">SUARA TERVERIFIKASI</div>
                                                    <div class="text-center">Terverifikasi {{$saksi_terverifikasi}} TPS dari {{$saksi_masuk}}
                                                        TPS Masuk</div>
                                                    <div class="text-center mt-2 mb-2"><span class="badge bg-success">{{$total_verification_voice}} / {{$dpt}}</span></div>
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

                                    <div class="col-6">
                                        <table class="table table-bordered table-hover h-100">
                                            <thead class="bg-primary">
                                                <td class="text-white text-center align-middle">PROVINSI</td>
                                                @foreach ($paslon as $item)
                                                <th class="text-white text-center align-middle">{{ $item['candidate']}} - <br>
                                                    {{ $item['deputy_candidate']}}
                                                </th>
                                                @endforeach
                                            </thead>
                                            <tbody>
                                              
                                    <tbody>
                                        @foreach ($kota as $item)
                                            <?php $domainProv = App\Models\RegenciesDomain::where('regency_id',$item->id)->first(); ?>
                                        <tr onclick='check("{{$domainProv->domain}}")'>
                                            <td><a href="http://{{$domainProv->domain}}{{env('HTTP_PORT','')}}/administrator/index">{{$item['name']}}</a>
                                            </td>
                                            @foreach ($paslon as $cd)
                                            <?php $saksi_dataa = SaksiData::join('saksi', 'saksi.id', '=', 'saksi_data.saksi_id')->where('saksi_data.paslon_id', $cd['id'])
                                            ->where('saksi_data.regency_id',$item->id)
                                            ->sum('voice'); ?>
                                            <td>{{$saksi_dataa}}</td>
                                            @endforeach
                                        </tr>
                                        @endforeach
                                    </tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    @else
                    <div class="col-lg col-md" style="display:{{($config->otonom == 'yes')?'none':'block'}}">
                        <div class="card">
                          
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-xxl-12">
                                                <div class="container">
                                                    <div class="text-center fs-3 mb-3 fw-bold">SUARA TERVERIFIKASI</div>
                                                    <div class="text-center">Terverifikasi {{$saksi_terverifikasi}} TPS dari {{$saksi_masuk}}
                                                        TPS Masuk</div>
                                                    <div class="text-center mt-2 mb-2"><span class="badge bg-success">{{$total_verification_voice}} / {{$dpt}}</span></div>
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
                                <table class="table table-bordered table-hover h-100">
                                    <thead class="bg-primary">
                                        <td class="text-white text-center align-middle">PROVINSI</td>
                                        @foreach ($paslon as $item)
                                        <th class="text-white text-center align-middle">{{ $item['candidate']}} - <br>
                                            {{ $item['deputy_candidate']}}
                                        </th>
                                        @endforeach
                                    </thead>

                                    <tbody>
                                        @foreach ($kota as $item)
                                            <?php $domainProv = App\Models\RegenciesDomain::where('regency_id',$item->id)->first(); ?>
                                        <tr onclick='check("{{$domainProv->domain}}")'>
                                            <td><a href="http://{{$domainProv->domain}}{{env('HTTP_PORT','')}}/administrator/index">{{$item['name']}}</a>
                                            </td>
                                            @foreach ($paslon as $cd)
                                            <?php $saksi_dataa = SaksiData::join('saksi', 'saksi.id', '=', 'saksi_data.saksi_id')->where('saksi_data.paslon_id', $cd['id'])
                                             ->where('saksi_data.regency_id',$item->id)
                                            ->sum('voice'); ?>
                                            <td>{{$saksi_dataa}}</td>
                                            @endforeach
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>
                    @endif

                </div>
@endsection
