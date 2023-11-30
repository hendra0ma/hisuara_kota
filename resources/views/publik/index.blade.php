<?php

use App\Models\Config;
use App\Models\District;
use App\Models\Village;
use App\Models\Tps;
use App\Models\SaksiData;
use App\Models\Paslon;
?>
@extends('layouts.mainpublic')
@section('content')


<?php
use App\Models\Configs;
use App\Models\RegenciesDomain;


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
$saksidatai = SaksiData::where('regency_id', $config->regencies_id)->sum("voice");
$dpt = District::where('regency_id', $config->regencies_id)->sum("dpt");
$data_masuk = (int)$saksidatai / (int)$dpt * 100;

?>
<div class="tab-content" id="pills-tabContent p-3">

    <!-- 1st card -->
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="card rounded-0">
            <div class="card-body">
                <!-- nav options -->
                <div class="row">
                    <div class="col-12">
                        <p class="text-center fs-1 fw-bold mb-0">
                            SUARA MASUK
                        </p>
                    </div>
                    <div class="col-12">
                        <p class="text-center">
                            <div class="badge bg-primary">PROGRESS : {{substr($data_masuk, 0, 3)}}% DARI 100%</div>
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div id="chart-pie" class="chartsh h-100 text-white"></div>
                    </div>
                </div>

                <div class="row mt-5">
                    <?php $i = 1; ?>
                    @foreach ($paslon as $pas)
                    <div class="col-lg col-md col-sm col-xl mb-3">
                        <div class="card overflow-hidden" style="margin-bottom: 0px;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col col-auto">
                                        <div class="counter-icon box-shadow-secondary brround ms-auto candidate-name text-white" style="margin-bottom: 0; background-color: {{$pas->color}};">
                                            {{$i++}}
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h6 class="">{{$pas->candidate}} </h6>
                                        <h6 class="">{{$pas->deputy_candidate}} </h6>
                                        <?php
                                        $voice = 0;
                                        ?>
                                        @foreach ($pas->saksi_data as $dataTps)
                                        <?php
                                        $voice += $dataTps->voice;
                                        ?>
                                        @endforeach <br>
                                        <h3 class="mb-2 number-font">{{ $voice }} suara</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="row mt-5">
                    <div class="col-md-12 mt-3">
                        <h5 class="text-uppercase">
                            <div class="row fw-bold">
                                <div class="col-md-12 mt-1 mb-1">
                                    HITUNG SUARA
                                </div>
                                <div class="col-md-12 mt-1 mb-1">
                                    PEMILIHAN PRESIDEN DAN WAKIL PRESIDEN
                                </div>
                                <div class="col-md-12 mt-1 mb-1">
                                    {{$kota['name']}}
                                </div>
                            </div>
                           
                        </h5>
                    </div>
                    <div class="col-md-12 mt-3">
                        <h5 class="text-uppercase">
                            <span class="badge bg-primary">Progress : {{$tps_selesai}} TPS Dari {{$tps_belum}} TPS</span>
                        </h5>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-12 mt-5 table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="bg-primary">
                                <tr>
                                    <?php $i = 1 ?>
                                    <th class="align-middle text-white">Kecamatan</th>
                                    @foreach ($paslon_candidate as $item)
                                    <th class="align-middle text-white">({{$i++}}) <br> {{ $item['candidate']}} / <br> {{$item['deputy_candidate']}}</th>
                                    @endforeach

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kec as $item)
                                <tr onclick='check("{{Crypt::encrypt($item->id)}}")'>
                                    <td class="align-middle"><a class="text-dark" href="publik/kecamatan/{{Crypt::encrypt($item['id'])}}">{{$item['name']}}</a></td>
                                    @foreach ($paslon_candidate as $cd)
                                    <?php $saksi_dataa = SaksiData::where('paslon_id', $cd['id'])->where('district_id', $item['id'])->sum('voice'); ?>
                                    <td class="align-middle">{{$saksi_dataa}}</td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                            <script>
                                let check = function(id) {
                                    window.location = `publik/kecamatan/${id}`;
                                }
                            </script>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="tab-pane fade show" id="pills-home-enum" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <center>
                            <p class="text-center fs-1 fw-bold mb-0">ENUMERATOR QUICK COUNT
                            </p>
                        </center>
                    </div>
            
                    <div class="col-lg-12">
                
                        <div class="container" style="margin-left: 3%; margin-top: 2.5%;">
                            {{-- <div class="text-center fs-2 mb-3 fw-bold">SUARA MASUK</div> --}}
                            <div class="text-center">Progress {{substr($realcount,0,5)}}% dari 100%</div>
                            <div class="text-center mt-2 mb-2"><span
                                    class="badge bg-success">{{$total_incoming_vote_quick}} / {{$dpt}}</span></div>
                            <div id="chart-pie2" class="chartsh h-100 w-100"></div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                       <div class="row">
                        <?php $i = 1; ?>
                        @foreach ($paslon as $pas)
                        <div class="col-lg col-md col-sm col-xl mb-3">
                            <div class="card" style="margin-bottom: 0px;">
                                <div class="card-body">
                                    <div class="row me-auto">
                                        <div class="col-4">
                                            <div class="counter-icon box-shadow-secondary brround candidate-name text-white "
                                                style="margin-bottom: 0; background-color: {{$pas->color}};">
                                                {{$i++}}
                                            </div>
                                        </div>
                                        <div class="col me-auto">
                                            <h6 class="">{{$pas->candidate}} </h6>
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
                    <div class="col-lg-12">
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner text-center">
                                <?php $count = 1; ?>
                                @foreach ($kecamatan as $item)
                                <div class="carousel-item <?php if ($count++ == 1) : ?><?= 'active' ?><?php endif; ?>">
                                    <div class="fw-bold fs-3 mb-3">
                                        KECAMATAN {{$item['name']}}
                                    </div>
            
                                    <div class="row">
                                        <?php $i = 1; ?>
                                        @foreach ($paslon as $psl)
                                        <?php
                                        $pasln = SaksiData::join('districts', 'districts.id', '=', 'saksi_data.district_id')
                                        ->where('saksi_data.district_id', $item['id'])
                                        ->where('saksi_data.paslon_id', $psl->id)->get();
                                        $jumlah = 0;
                                        foreach ($pasln as $pas) {
                                            $jumlah += $pas->voice;
                                        }
            
                                        $persen = substr($jumlah / $item->dpt * 100, 0, 3);
            
                                        ?>
                                        <div class="col-md">
                                            <div class="card">
                                                <div class="card-header justify-content-center"
                                                    style="background-color:{{$psl->color}}">
                                                    <h3 style="margin-bottom: 0;" class="fw-bold text-white">{{$psl->candidate}} -
                                                        <br> {{$psl->deputy_candidate}}</h3>
                                                </div>
                                                <div class="card-body" style="padding: 10px;">
                                                    <div class="row">
                                                        <div class="col">
                                                            <img src="{{asset('storage/'. $psl['picture'])}}" width="125px"
                                                                height="125px" style="object-fit: cover;" alt="">
                                                        </div>
                                                        <div class="col text-center my-auto fs-1 fw-bold">
                                                            {{$persen}}%
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
            
                                        <?php
                                        $jumlah = 0;
                                        ?>
                                        @endforeach
                                        <?php $i = 1; ?>
            
                                    </div>
                                </div>
            
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Suara TPS Quick Count (Seluruh Kelurahan)</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered text-nowrap border-bottom">
                                                <thead class="bg-primary">
                                                    <tr>
                                                        <th class="text-white align-middle">Kecamatan</th>
                                                        <th class="text-white align-middle">Sumber Kelurahan</th>
                                                        <th class="text-white align-middle">Total TPS</th>
                                                        <th class="text-white align-middle">Quick Count</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($district_quick as $item)
                                                    <?php $count_tps = Tps::where('villages_id',(string)$item['id'])->count(); ?>
                                                    <?php $count_tps_quick = Tps::where('villages_id',(string)$item['id'])->where('quick_count', 1)->count(); ?>
                                                    <?php $kecc = District::where('id', $item['district_id'])->first(); ?>
                                                    <tr @if ( $count_tps_quick  > 0)
                                                        style="background-color: rgb(80,78, 78); color :white;" @else  @endif>
                                                        <td class="align-middle text">
                                                            {{$kecc['name']}}
                                                        </td>
                                                        <td class="align-middle">
                                                            <a href="modaltpsQuick2" class="modaltpsQuick2 @if ( $count_tps_quick  > 0)
                                                     text-white
                                                                @else text-dark
                                                            @endif" id="Cek" data-id="{{$item['id']}}" data-bs-toggle="modal" id=""
                                                                data-bs-target="#modaltpsQuick2">{{$item['name']}}</a>
                                                        </td>
                                                        <td class="align-middle">{{$count_tps}}</td>
                                                        <td class="align-middle">@if ( $count_tps_quick  > 0)
                                                            {{$count_tps_quick}}
                                                            @else
                                                            0
                                                            @endif</td>
                                                    </tr>
                                                    @endforeach
            
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <a href="https://quickcount.rekapitung.id" class="btn btn-block btn-success">PELAJARI METODOLOGI QUICK COUNT REKAPITUNG</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="tab-pane fade show" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <div class="card">
            <div class="card-body">
                <!-- nav options -->
                <div class="row">
                    <div class="col-12">
                        <p class="text-center fs-1 fw-bold mb-0">
                            HASIL QUICK COUNT
                        </p>
                    </div>
                    <div class="col-12">
                        <p class="text-center">
                        <div class="badge bg-primary">RANDOM : {{substr($tps_selesai_quick / $tps_belum_quick * 100, 0, 4)}}% (10%) DARI 100%</div>
                        </p>
                    </div>
                </div>
                
                <!-- nav options -->
                <div class="row">
                    <div class="col-md-12">
                        <div id="chart-donut" class="chartsh h-100"></div>
                    </div>
                </div>

                <div class="row mt-5">
                    <?php $i = 1; ?>
                    @foreach ($paslon as $pas)
                    <div class="col-lg col-md col-sm col-xl mb-3">
                        <div class="card overflow-hidden" style="margin-bottom: 0px;">
                            <div class="card-body">
                                <div class="row">

                                <?php $saksi_dataa =   Tps::join('saksi','saksi.tps_id','=','tps.id')
                                    ->join('saksi_data','saksi_data.saksi_id','=','saksi.id')
                                    ->where('saksi_data.paslon_id',$pas->id)
                                    // ->where('tps.district_id',$item->id)
                                    ->where('tps.sample',1)
                                    ->sum('saksi_data.voice');
                                    ?>


                                    <div class="col col-auto">
                                        <div class="counter-icon box-shadow-secondary brround ms-auto candidate-name text-white" style="margin-bottom: 0; background-color: {{$pas->color}};">
                                            {{$i++}}
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h6 class="">{{$pas->candidate}} </h6>
                                        <h6 class="">{{$pas->deputy_candidate}} </h6>
                                      
                                        <h3 class="mb-2 number-font">{{ $saksi_dataa }} suara</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="row mt-5">
                    <div class="col-md-12 mt-3">
                        <h5 class="text-uppercase">
                            <div class="row fw-bold">
                                <div class="col-md-12 mt-1 mb-1">
                                    HITUNG SUARA
                                </div>
                                <div class="col-md-12 mt-1 mb-1">
                                    PEMILIHAN PRESIDEN DAN WAKIL PRESIDEN
                                </div>
                                <div class="col-md-12 mt-1 mb-1">
                                    {{$kota['name']}}
                                </div>
                            </div>
                        </h5>
                    </div>
                    <div class="col-md-12 mt-3">
                        <h5 class="text-uppercase">
                            <span class="badge bg-primary">Progress : {{$tps_selesai_quick}} TPS Dari {{$tps_belum_quick}} TPS</span>
                        </h5>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-12 mt-5 table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="bg-primary">
                                <tr>
                                    <?php $i = 1 ?>
                                    <th class="align-middle text-white">Kecamatans</th>
                                    @foreach ($paslon_candidate as $item)
                                    <th class="align-middle text-white">({{$i++}}) <br> {{ $item['candidate']}} / <br> {{$item['deputy_candidate']}}</th>
                                    @endforeach

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kec as $item)
                                <tr onclick='check("{{Crypt::encrypt($item->id)}}")'>
                                    <td class="align-middle"><a class="text-dark" href="publik/quick_kecamatan/{{Crypt::encrypt($item['id'])}}">{{$item['name']}}</a></td>
                                    @foreach ($paslon_candidate as $cd)
                                    <?php $saksi_dataa =   Tps::join('saksi','saksi.tps_id','=','tps.id')
                                    ->join('saksi_data','saksi_data.saksi_id','=','saksi.id')
                                    ->where('saksi_data.paslon_id',$cd->id)
                                    ->where('tps.district_id',$item->id)
                                    ->where('tps.sample',1)
                                    ->sum('saksi_data.voice');
                                    ?>
                                    <td class="align-middle">{{$saksi_dataa}}</td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                            <script>
                                let check = function(id) {
                                    window.location = `publik/quick_kecamatan/${id}`;
                                }
                            </script>
                        </table>
                    </div>
                </div>

                {{-- <div class="row mt-5">
                    <div class="col-md-12 mt-5">
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap border-bottom">
                                <thead class="bg-primary">
                                    <tr>
                                        <th class="text-white align-middle">Kecamatan</th>
                                        <th class="text-white align-middle">Sumber Kelurahan</th>
                                        <th class="text-white align-middle">Total TPS</th>
                                        <th class="text-white align-middle">Quick Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($district_quick as $item)
                                    <?php $count_tps = Tps::where('villages_id',(string)$item['id'])->count(); ?>
                                    <?php $count_tps_quick = Tps::where('villages_id',(string)$item['id'])->where('sample', 1)->count(); ?>
                                    <?php $kecc = District::where('id', $item['district_id'])->first(); ?>
                                    <tr @if ($kecc['id'] == 3674040)
                                    style="background-color: rgb(80, 78, 78); color :white;"
                                    @else 
                                    @endif
                                    >
                                        <td class="align-middle">
                                            {{$kecc['name']}}
                                        </td>
                                        <td class="align-middle">
                                            <a href="modaltpsQuick" class="modaltpsQuick @if ($kecc['id'] == 3674040)
                                 text-white
                                            @else text-dark
                                        @endif" style="font-size: 0.8em;" id="Cek" data-id="{{$item['id']}}" data-bs-toggle="modal" id="" data-bs-target="#modaltpsQuick">{{$item['name']}}</a>
                                        </td>
                                        <td class="align-middle">{{$count_tps}}</td>
                                        <td class="align-middle">@if ($kecc['id'] == 3674040)
                                            {{$count_tps_quick}}
                                            @else
                                            0
                                        @endif</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> --}}

            </div>



        </div>

    </div>
    <div class="tab-pane fade show" id="pills-terverifikasi" role="tabpanel" aria-labelledby="pills-terverifikasi-tab">
        <div class="card rounded-0">
            <div class="card-body">
                <!-- nav options -->

                <div class="row">
                    <div class="col-12">
                        <p class="text-center fs-1 fw-bold mb-0">
                            SUARA TERVERIFIKASI
                        </p>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-12">
                        <div id="chart-verif" class="chartsh h-100"></div>
                    </div>
                </div>

                <div class="row mt-5">
                    <?php $i = 1; ?>
                    @foreach ($paslon_terverifikasi as $pas)
                    <div class="col-lg col-md col-sm col-xl mb-3    ">
                        <div class="card overflow-hidden" style="margin-bottom: 0px;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col col-auto">
                                        <div class="counter-icon box-shadow-secondary brround ms-auto candidate-name text-white" style="margin-bottom: 0;  background-color: {{$pas->color}};">
                                            {{$i++}}
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h6 class="">{{$pas->candidate}} </h6>
                                        <?php
                                        $voice = 0;
                                        ?>
                                        @foreach ($pas->saksi_data as $dataTps)
                                        <?php
                                        $voice += $dataTps->voice;
                                        ?>
                                        @endforeach <br>
                                        <h3 class="mb-2 number-font">{{ $voice }} suara</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="row mt-5">
                    <div class="col-md-12 mt-3">
                        <h5 class="text-uppercase">
                            <div class="row fw-bold">
                                <div class="col-md-12 mt-1 mb-1">
                                    HITUNG SUARA
                                </div>
                                <div class="col-md-12 mt-1 mb-1">
                                    PEMILIHAN PRESIDEN DAN WAKIL PRESIDEN
                                </div>
                                <div class="col-md-12 mt-1 mb-1">
                                    {{$kota['name']}}
                                </div>
                            </div>
                        </h5>
                    </div>
                    <div class="col-md-12 mt-3">
                        <h5 class="text-uppercase">
                            <span class="badge bg-primary">Progress : {{$tps_selesai}} TPS Dari {{$tps_belum}} TPS</span>
                        </h5>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-12 mt-5">
                        <table class="table table-bordered table-hover">
                            <thead class="bg-primary">
                                <tr>
                                    <th class="align-middle text-white">Kecamatan</th>
                                    @foreach ($paslon_candidate as $item)
                                    <th class="text-white">{{ $item['candidate']}}</th>
                                    @endforeach

                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($kec as $item)
                                <tr onclick='check("{{Crypt::encrypt($item->id)}}")'>
                                    <td><a class="text-dark" href="publik/kecamatan/{{Crypt::encrypt($item['id'])}}">{{$item['name']}}</a></td>
                                    @foreach ($paslon_candidate as $cd)
                                    <?php $saksi_dataa = SaksiData::join('saksi', 'saksi.id', '=', 'saksi_data.saksi_id')
                                    ->where('paslon_id', $cd['id'])
                                    ->where('saksi_data.district_id', $item['id'])
                                    ->where('verification', 1)->sum('voice'); ?>
                                    <td>{{$saksi_dataa}}</td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>

                            <script>
                                let check = function(id) {
                                    window.location = `publik/kecamatan/${id}`;
                                }
                            </script>
                        </table>
                    </div>
                </div>

            </div>



        </div>

    </div>
</div>
</div>
</div>

</div>






@endsection
