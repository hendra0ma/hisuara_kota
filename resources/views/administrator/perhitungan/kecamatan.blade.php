<?php

use App\Models\Config;
use App\Models\District;
use App\Models\Regency;
use App\Models\SaksiData;
use App\Models\Tps;
use App\Models\Village;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

$config = Config::all()->first();

use App\Models\Configs;
use App\Models\RegenciesDomain;

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

@extends('layouts.main-perhitungan')

@section('content')

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
            $regency = Regency::where('id', $config->regencies_id)->select('name')->first();
            $kcamatan = District::where('id', $id_kecamatan)->select('name')->first();
            ?>
            <li><a href="{{url('')}}/administrator/index" class="text-white">{{$regency->name}}</a></li>
            <li><a href="{{url('')}}/administrator/perhitungan_kecamatan/{{Crypt::encrypt($id_kecamatan)}}" class="text-white">{{$kcamatan->name}}</a></li>

        </ul>
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
                                                        <div class="mx-auto counter-icon box-shadow-secondary brround candidate-name text-white "
                                                            style="margin-bottom: 0; background-color: {{$pas->color}};">
                                                            {{$i++}}
                                                        </div>
                                                    </div>
                                                    <div class="col text-center">
                                                        <h6 class="mt-4">{{$pas->candidate}} </h6>
                                                        <h6 class="">{{$pas->deputy_candidate}} </h6>
                                                        <?php
                                                                $total_saksi = SaksiData::where('paslon_id',$pas->id)->where('district_id',$id_kecamatan)->sum('voice');
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
                                <th class="text-white text-center align-middle">KELURAHAN</th>
                                @foreach ($paslon as $item)
                                <th class="text-white text-center align-middle"
                                    style="background: {{$item->color}}; position:relative">
                                    <img style="width: 60px; position: absolute; left: 0; bottom: 0"
                                        src="{{asset('')}}storage/{{$item->picture}}" alt="">
                                    <div class="ms-7">
                                        {{ $item['candidate']}} - <br>
                                        {{ $item['deputy_candidate']}}
                                    </div>
                                </th>
                                @endforeach
    
                            </thead>
                            <tbody>
                                <!-- Foreach here -->
    
                                @foreach ($district as $item)
                                <tr onclick='check("{{Crypt::encrypt($item->id)}}")'>
                                    <td class="align-middle"><a
                                            href="{{url('/')}}/administrator/perhitungan_kecamatan/{{Crypt::encrypt($item['id'])}}">{{$item['name']}}</a>
                                    </td>
                                    @foreach ($paslon as $cd)
                                    <?php $saksi_dataa = SaksiData::where('regency_id',$config->regencies_id)->where('paslon_id', $cd['id'])->where('saksi_data.village_id', (string)$item['id'])->sum('voice'); ?>
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
                <table class="table table-bordered table-hover">
                    <thead class="bg-primary">
                        <th class="text-white text-center align-middle">KELURAHAN</th>
                        @foreach ($paslon as $item)
                        <th class="text-white text-center align-middle" style="background: {{$item->color}}; position:relative">
                            <img style="width: 60px; position: absolute; left: 0; bottom: 0" src="{{asset('')}}storage/{{$item->picture}}"
                                alt="">
                            <div class="ms-7">
                                {{ $item['candidate']}} - <br>
                                {{ $item['deputy_candidate']}}
                            </div>
                        </th>
                        @endforeach

                    </thead>
                    <tbody>
                        <!-- Foreach here -->

                        @foreach($district as $dist)
                        <tr>
                            <td><a href="{{url('/')}}/administrator/perhitungan_kelurahan/{{Crypt::encrypt($dist['id'])}}?from=realcount">{{$dist->name}}</a>
                            </td>
                            <?php
                            $voices = App\Models\Paslon::with(['saksi_data' => function ($query) use ($dist) {
                                $query
                                    ->where('saksi_data.village_id', (string)$dist->id);
                            }])->get();
                            ?>
                            @foreach($voices as $voc)
                            <?php $total_voices = 0;  ?>
                            @foreach($voc->saksi_data as $saksi)
                            <?php $total_voices = $saksi->voice  ?>
                            @endforeach
                            <td> {{$total_voices}} </td>
                            @endforeach
                        </tr>
                        @endforeach



                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if ($config->quick_count == 'yes')
    <div class="col-lg-6 col-md" style="display:{{($config->otonom == 'yes')?'none':'block'}}">
        <div class="card">
            {{-- <div class="card-header bg-secondary">
                <h3 class="card-title text-white">Suara TPS Terverifikasi</h3>
            </div> --}}
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

                    <div class="col-12">
                        <table class="table table-bordered table-hover mb-0">
                            <thead class="bg-primary">
                                <th class="text-white text-center align-middle">KELURAHAN</th>
                                @foreach ($paslon as $item)
                                <th class="text-white text-center align-middle" style="background: {{$item->color}}; position:relative">
                                    <img style="width: 60px; position: absolute; left: 0; bottom: 0" src="{{asset('')}}storage/{{$item->picture}}"
                                        alt="">
                                    <div class="ms-7">
                                        {{ $item['candidate']}} - <br>
                                        {{ $item['deputy_candidate']}}
                                    </div>
                                </th>
                                @endforeach


                            </thead>
                            <tbody>
                                <!-- Foreach here -->

                                @foreach($district as $dist)
                                <tr>
                                    <td><a href="{{url('/')}}/administrator/perhitungan_kelurahan/{{Crypt::encrypt($dist['id'])}}?from=terverifikasi">{{$dist->name}}</a></td>
                                    <?php
                                    $voices = App\Models\Paslon::with(['saksi_data' => function ($query) use ($dist) {
                                        $query
                                            ->join('saksi', 'saksi_data.saksi_id', 'saksi.id')
                                            ->where('saksi.verification', 1)
                                            ->where('saksi_data.village_id', (string)$dist->id);
                                    }])->get();
                                    ?>
                                    @foreach($voices as $voc)
                                    <?php $total_voices = 0;  ?>
                                    @foreach($voc->saksi_data as $saksi)
                                    <?php $total_voices = $saksi->voice  ?>
                                    @endforeach
                                    <td> {{$total_voices}} </td>
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

    <div class="col-lg-6">
        <div class="card">
            {{-- <div class="card-header bg-info">
                <h3 class="card-title text-white">Suara TPS Masuk</h3>
            </div> --}}
            <div class="card-body" style="position: relative;">
                <img src="{{asset('')}}assets/icons/hisuara_new.png"
                    style="position: absolute; top: 25px; left: 25px; width: 100px" alt="">
                <div class="row">
                    <div class="col-12">
    
                        <div class="row">
                            <div class="col-12">
                                <div class="container">
                                    <div class="text-center fs-3 mb-3 fw-bold">REKAPITULASI</div>
                                    <div class="text-center">Progress {{substr($realcount,0,5)}}% dari 100%</div>
                                    <div class="text-center mt-2 mb-2"><span
                                            class="badge bg-success">{{$total_incoming_vote}} /
                                            {{$dpt}}</span></div>
                                    <div id="chart-rekapitulasi" class="chartsh h-100 w-100"></div>
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
                                                                    $total_saksi = SaksiData::where('paslon_id',$pas->id)->where('district_id',$id_kecamatan)->sum('voice');
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
    
                    <div class="col-12">
                        <table class="table table-bordered table-hover mb-0">
                            <thead class="bg-primary">
                                <tr>
                                    <th class="text-white text-center align-middle">KELURAHAN</th>
                                    @foreach ($paslon as $item)
                                    <th class="text-white text-center align-middle" style="background: {{$item->color}}; position:relative">
                                        <img style="width: 60px; position: absolute; left: 0; bottom: 0"
                                            src="{{asset('')}}storage/{{$item->picture}}" alt="">
                                        <div class="ms-7">
                                            {{ $item['candidate']}} - <br>
                                            {{ $item['deputy_candidate']}}
                                        </div>
                                    </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <?php $totalSaksiDataa = [];  ?>
                                @foreach ($paslon as $cd)
                                <?php $totalSaksiDataa[$cd['id']] = 0; ?>
                                @endforeach
                                @foreach ($district as $item)
                                <tr onclick='check("{{Crypt::encrypt($item->id)}}")'>
                                    <td class="align-middle"><a
                                            href="{{url('/')}}/administrator/perhitungan_kelurahan/{{Crypt::encrypt($item['id'])}}">{{$item['name']}}</a>
                                    </td>
                                    @foreach ($paslon as $cd)
                                    <?php $saksi_dataa = SaksiData::join('saksi', 'saksi.id', '=', 'saksi_data.saksi_id')->where('paslon_id', $cd['id'])->where('saksi_data.village_id', (string)$item['id'])->sum('voice'); ?>
                                    <td class="align-middle">
                                        {{$saksi_dataa}}</td>
                                    <?php     
                                                                $totalSaksiDataa[$cd['id']] += $saksi_dataa; ?>
                                    @endforeach
                                </tr>
                                @endforeach
                                <tr style="background-color: #cccccc">
                                    <td class="align-middle">
                                        <div class="fw-bold">Total</div>
                                    </td>
                        
                                    @foreach ($paslon as $cd)
                                    <td class="align-middle">{{$totalSaksiDataa[$cd['id']]}}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                            <script>
                                let check = function (id) {
                                                            window.location = `{{url('/')}}/administrator/perhitungan_kelurahan/${id}`;
                                                        }
                            </script>
                        </table>
                    </div>
                </div>
    
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            {{-- <div class="card-header bg-info">
                <h3 class="card-title text-white">Suara TPS Masuk</h3>
            </div> --}}
            <div class="card-body" style="position: relative;">
                <img src="{{asset('')}}assets/icons/hisuara_new.png"
                    style="position: absolute; top: 25px; left: 25px; width: 100px" alt="">
                <div class="row">
                    <div class="col-6">
    
                        <div class="row">
                            <div class="col-12">
                                <div class="container">
                                    <div class="text-center fs-3 mb-3 fw-bold">HITUNG ULANG KPU</div>
                                    <div class="text-center">Progress {{substr($realcount,0,5)}}% dari 100%</div>
                                    <div class="text-center mt-2 mb-2"><span
                                            class="badge bg-success">{{$total_incoming_vote}} /
                                            {{$dpt}}</span></div>
                                    <div id="chart-kpu" class="chartsh h-100 w-100"></div>
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
                                                                    $total_saksi = SaksiData::where('paslon_id',$pas->id)->where('district_id',$id_kecamatan)->sum('voice');
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
    
                    <div class="col-6">
                        <table class="table table-bordered table-hover mb-0 h-100">
                            <thead class="bg-primary">
                                <tr>
                                    <th class="text-white text-center align-middle">KELURAHAN</th>
                                    @foreach ($paslon as $item)
                                    <th class="text-white text-center align-middle" style="background: {{$item->color}}; position:relative">
                                        <img style="width: 60px; position: absolute; left: 0; bottom: 0"
                                            src="{{asset('')}}storage/{{$item->picture}}" alt="">
                                        <div class="ms-7">
                                            {{ $item['candidate']}} - <br>
                                            {{ $item['deputy_candidate']}}
                                        </div>
                                    </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <?php $totalSaksiDataa = [];  ?>
                                @foreach ($paslon as $cd)
                                <?php $totalSaksiDataa[$cd['id']] = 0; ?>
                                @endforeach
                                @foreach ($district as $item)
                                <tr onclick='check("{{Crypt::encrypt($item->id)}}")'>
                                    <td class="align-middle"><a
                                            href="{{url('/')}}/administrator/perhitungan_kelurahan/{{Crypt::encrypt($item['id'])}}">{{$item['name']}}</a>
                                    </td>
                                    @foreach ($paslon as $cd)
                                    <?php $saksi_dataa = SaksiData::join('saksi', 'saksi.id', '=', 'saksi_data.saksi_id')->where('paslon_id', $cd['id'])->where('saksi_data.village_id', (string)$item['id'])->sum('voice'); ?>
                                    <td class="align-middle">
                                        {{$saksi_dataa}}</td>
                                    <?php     
                                                                $totalSaksiDataa[$cd['id']] += $saksi_dataa; ?>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                            <script>
                                let check = function (id) {
                                                            window.location = `{{url('/')}}/administrator/perhitungan_kelurahan/${id}`;
                                                        }
                            </script>
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
                <table class="table table-bordered table-hover">
                    <thead class="bg-primary">
                        <th class="text-white text-center align-middle">KELURAHAN</th>
                        @foreach ($paslon as $item)
                        <th class="text-white text-center align-middle" style="background: {{$item->color}}; position:relative">
                            <img style="width: 60px; position: absolute; left: 0; bottom: 0" src="{{asset('')}}storage/{{$item->picture}}"
                                alt="">
                            <div class="ms-7">
                                {{ $item['candidate']}} - <br>
                                {{ $item['deputy_candidate']}}
                            </div>
                        </th>
                        @endforeach


                    </thead>
                    <tbody>
                        <!-- Foreach here -->

                        @foreach($district as $dist)
                        <tr>
                            <td><a href="{{url('/')}}/administrator/perhitungan_kelurahan/{{Crypt::encrypt($dist['id'])}}?from=terverifikasi">{{$dist->name}}</a></td>
                            <?php
                            $voices = App\Models\Paslon::with(['saksi_data' => function ($query) use ($dist) {
                                $query
                                    ->join('saksi', 'saksi_data.saksi_id', 'saksi.id')
                                    ->where('saksi.verification', 1)
                                    ->where('saksi_data.village_id', (string)$dist->id);
                            }])->get();
                            ?>
                            @foreach($voices as $voc)
                            <?php $total_voices = 0;  ?>
                            @foreach($voc->saksi_data as $saksi)
                            <?php $total_voices = $saksi->voice  ?>
                            @endforeach
                            <td> {{$total_voices}} </td>
                            @endforeach
                        </tr>
                        @endforeach



                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            {{-- <div class="card-header bg-info">
                <h3 class="card-title text-white">Suara TPS Masuk</h3>
            </div> --}}
            <div class="card-body" style="position: relative;">
                <img src="{{asset('')}}assets/icons/hisuara_new.png"
                    style="position: absolute; top: 25px; left: 25px; width: 100px" alt="">
                <div class="row">
                    <div class="col-12">
    
                        <div class="row">
                            <div class="col-12">
                                <div class="container">
                                    <div class="text-center fs-3 mb-3 fw-bold">REKAPITULASI</div>
                                    <div class="text-center">Progress {{substr($realcount,0,5)}}% dari 100%</div>
                                    <div class="text-center mt-2 mb-2"><span
                                            class="badge bg-success">{{$total_incoming_vote}} /
                                            {{$dpt}}</span></div>
                                    <div id="chart-rekapitulasi" class="chartsh h-100 w-100"></div>
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
                                                                        $total_saksi = SaksiData::where('paslon_id',$pas->id)->where('district_id',$id_kecamatan)->sum('voice');
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
    
                    <div class="col-12">
                        <table class="table table-bordered table-hover mb-0">
                            <thead class="bg-primary">
                                <tr>
                                    <th class="text-white text-center align-middle">KELURAHAN</th>
                                    @foreach ($paslon as $item)
                                    <th class="text-white text-center align-middle"
                                        style="background: {{$item->color}}; position:relative">
                                        <img style="width: 60px; position: absolute; left: 0; bottom: 0"
                                            src="{{asset('')}}storage/{{$item->picture}}" alt="">
                                        <div class="ms-7">
                                            {{ $item['candidate']}} - <br>
                                            {{ $item['deputy_candidate']}}
                                        </div>
                                    </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <?php $totalSaksiDataa = [];  ?>
                                @foreach ($paslon as $cd)
                                <?php $totalSaksiDataa[$cd['id']] = 0; ?>
                                @endforeach
                                @foreach ($district as $item)
                                <tr onclick='check("{{Crypt::encrypt($item->id)}}")'>
                                    <td class="align-middle"><a
                                            href="{{url('/')}}/administrator/perhitungan_kelurahan/{{Crypt::encrypt($item['id'])}}">{{$item['name']}}</a>
                                    </td>
                                    @foreach ($paslon as $cd)
                                    <?php $saksi_dataa = SaksiData::join('saksi', 'saksi.id', '=', 'saksi_data.saksi_id')->where('paslon_id', $cd['id'])->where('saksi_data.village_id', (string)$item['id'])->sum('voice'); ?>
                                    <td class="align-middle">
                                        {{$saksi_dataa}}</td>
                                    <?php     
                                                                    $totalSaksiDataa[$cd['id']] += $saksi_dataa; ?>
                                    @endforeach
                                </tr>
                                @endforeach
                                <tr style="background-color: #cccccc">
                                    <td class="align-middle">
                                        <div class="fw-bold">Total</div>
                                    </td>
    
                                    @foreach ($paslon as $cd)
                                    <td class="align-middle">{{$totalSaksiDataa[$cd['id']]}}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                            <script>
                                let check = function (id) {
                                                                window.location = `{{url('/')}}/administrator/perhitungan_kelurahan/${id}`;
                                                            }
                            </script>
                        </table>
                    </div>
                </div>
    
            </div>
        </div>
    </div>
    
    <div class="col-lg-6">
        <div class="card">
            {{-- <div class="card-header bg-info">
                <h3 class="card-title text-white">Suara TPS Masuk</h3>
            </div> --}}
            <div class="card-body" style="position: relative;">
                <img src="{{asset('')}}assets/icons/hisuara_new.png"
                    style="position: absolute; top: 25px; left: 25px; width: 100px" alt="">
                <div class="row">
                    <div class="col-12">
    
                        <div class="row">
                            <div class="col-12">
                                <div class="container">
                                    <div class="text-center fs-3 mb-3 fw-bold">HITUNG ULANG KPU</div>
                                    <div class="text-center">Progress {{substr($realcount,0,5)}}% dari 100%</div>
                                    <div class="text-center mt-2 mb-2"><span
                                            class="badge bg-success">{{$total_incoming_vote}} /
                                            {{$dpt}}</span></div>
                                    <div id="chart-kpu" class="chartsh h-100 w-100"></div>
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
                                                                        $total_saksi = SaksiData::where('paslon_id',$pas->id)->where('district_id',$id_kecamatan)->sum('voice');
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
    
                    <div class="col-12">
                        <table class="table table-bordered table-hover mb-0">
                            <thead class="bg-primary">
                                <tr>
                                    <th class="text-white text-center align-middle">KELURAHAN</th>
                                    @foreach ($paslon as $item)
                                    <th class="text-white text-center align-middle"
                                        style="background: {{$item->color}}; position:relative">
                                        <img style="width: 60px; position: absolute; left: 0; bottom: 0"
                                            src="{{asset('')}}storage/{{$item->picture}}" alt="">
                                        <div class="ms-7">
                                            {{ $item['candidate']}} - <br>
                                            {{ $item['deputy_candidate']}}
                                        </div>
                                    </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <?php $totalSaksiDataa = [];  ?>
                                @foreach ($paslon as $cd)
                                <?php $totalSaksiDataa[$cd['id']] = 0; ?>
                                @endforeach
                                @foreach ($district as $item)
                                <tr onclick='check("{{Crypt::encrypt($item->id)}}")'>
                                    <td class="align-middle"><a
                                            href="{{url('/')}}/administrator/perhitungan_kelurahan/{{Crypt::encrypt($item['id'])}}">{{$item['name']}}</a>
                                    </td>
                                    @foreach ($paslon as $cd)
                                    <?php $saksi_dataa = SaksiData::join('saksi', 'saksi.id', '=', 'saksi_data.saksi_id')->where('paslon_id', $cd['id'])->where('saksi_data.village_id', (string)$item['id'])->sum('voice'); ?>
                                    <td class="align-middle">
                                        {{$saksi_dataa}}</td>
                                    <?php     
                                                                    $totalSaksiDataa[$cd['id']] += $saksi_dataa; ?>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                            <script>
                                let check = function (id) {
                                                                window.location = `{{url('/')}}/administrator/perhitungan_kelurahan/${id}`;
                                                            }
                            </script>
                        </table>
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

{{-- <div class="row mt-3">
    <!-- PAGE-HEADER -->
    <div class="col-lg-4">
        <h1 class="page-title fs-1 mt-2">Dashboard Rekapitung
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Kecamatan</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$kecamatan['name']}}
<!-- Kota -->
</li>
</ol>
<h4 class="fs-4 mt-2 fw-bold">Multi Administator</h4>
</div>

<div class="col-lg-8 justify-content-end mt-2">
    <div class="row">
        <div class="col"></div>
        <div class="col-lg-9 justify-content-end">
            <div class="card" style="margin-bottom: 0px;">
                <div class="card-body">
                    <div class="row mx-auto">
                        <div class="col-5 ">
                            <div class="counter-icon box-shadow-secondary brround candidate-name text-white bg-danger" style="margin-bottom: 0;">
                                1
                            </div>
                        </div>
                        <div class="col me-auto">
                            <h6 class="">Suara Tertinggi</h6>
                            <h3 class="mb-2 number-font">{{$paslon_tertinggi['candidate']}} /
                                {{$paslon_tertinggi['deputy_candidate']}}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

<div class="row mt-3">
    <div class="col-lg-6 col-md-12">
        <div class="card">
            <div class="card-header bg-info-gradient">
                <h3 class="card-title text-white">Suara TPS Masuk</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xxl-6">
                        <div class="container" style="margin-left: 3%; margin-top: 10%;">
                            <div class="text-center">Progress {{substr($realcount,0,5)}}% dari 100%</div>
                            <div id="chart-pie" class="chartsh h-100 w-100"></div>
                        </div>
                    </div>
                    <div class="col-xxl-6">

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
                <h3 class="card-title text-white">Suara TPS Terverifikasi</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xxl-6">
                        <div class="container" style="margin-left: 3%; margin-top: 10%;">
                            <div class="text-center">Terverifikasi 6 TPS dari 1 TPS Masuk</div>
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
</div>


<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mx-auto">Suara TPS Masuk (Seluruh Kecamatan)</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="bg-primary">
                        <th class="text-white text-center align-middle">KELURAHAN</th>
                        @foreach ($paslon as $item)
                        <th class="text-white text-center align-middle">{{ $item['candidate']}} - <br> {{
                            $item['deputy_candidate']}}</th>
                        @endforeach

                    </thead>
                    <tbody>
                        <!-- Foreach here -->

                        @foreach($district as $dist)
                        <tr>
                            <td><a href="{{url('/')}}/administrator/perhitungan_kelurahan/{{Crypt::encrypt($dist['id'])}}">{{$dist->name}}</a>
                            </td>
                            <?php
                            $voices = App\Models\Paslon::with(['saksi_data' => function ($query) use ($dist) {
                                $query
                                    ->where('saksi_data.village_id', (string)$dist->id);
                            }])->get();
                            ?>
                            @foreach($voices as $voc)
                            <?php $total_voices = 0;  ?>
                            @foreach($voc->saksi_data as $saksi)
                            <?php $total_voices = $saksi->voice  ?>
                            @endforeach
                            <td> {{$total_voices}} </td>
                            @endforeach
                        </tr>
                        @endforeach



                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mx-auto">Suara TPS Terverifikasi (Seluruh Kecamatan)</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="bg-primary">
                        <th class="text-white text-center align-middle">KELURAHAN</th>
                        @foreach ($paslon as $item)
                        <th class="text-white text-center align-middle">{{ $item['candidate']}} - <br> {{
                            $item['deputy_candidate']}}</th>
                        @endforeach


                    </thead>
                    <tbody>
                        <!-- Foreach here -->

                        @foreach($district as $dist)
                        <tr>
                            <td>{{$dist->name}}</td>
                            <?php
                            $voices = App\Models\Paslon::with(['saksi_data' => function ($query) use ($dist) {
                                $query
                                    ->join('saksi', 'saksi_data.saksi_id', 'saksi.id')
                                    ->where('saksi.verification', 1)
                                    ->where('saksi_data.village_id', (string)$dist->id);
                            }])->get();
                            ?>
                            @foreach($voices as $voc)
                            <?php $total_voices = 0;  ?>
                            @foreach($voc->saksi_data as $saksi)
                            <?php $total_voices = $saksi->voice  ?>
                            @endforeach
                            <td> {{$total_voices}} </td>
                            @endforeach
                        </tr>
                        @endforeach



                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg justify-content-end">
        <div class="card">
            <div class="card-header bg-secondary">
                <div class="card-title text-white">Total TPS</div>
            </div>
            <div class="card-body">
                <p class="">{{ $total_tps }}</p>
            </div>
        </div>
    </div>
    <div class="col-lg">
        <div class="card">
            <div class="card-header bg-danger">
                <div class="card-title text-white">TPS Masuk</div>
            </div>
            <div class="card-body">
                <p class="">{{ $tps_masuk }}</p>
            </div>
        </div>
    </div>
    <div class="col-lg">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="card-title text-white">TPS Kosong</div>
            </div>
            <div class="card-body">
                <p class="">{{ $tps_kosong }}</p>
            </div>
        </div>
    </div>
    <div class="col-lg">
        <div class="card">
            <div class="card-header bg-cyan">
                <div class="card-title text-white">Suara Masuk</div>
            </div>
            <div class="card-body">
                <p class="">{{ $suara_masuk }}</p>
            </div>
        </div>
    </div>
    <div class="col-lg">
        <div class="card">
            <div class="card-header bg-success">
                <div class="card-title text-white">Suara Terverifikasi</div>
            </div>
            <div class="card-body">
                <p class="">{{$total_verification_voice}}</p>
            </div>
        </div>
    </div>
</div>
</div> --}}

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