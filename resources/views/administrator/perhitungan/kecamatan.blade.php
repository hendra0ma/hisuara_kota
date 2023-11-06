@extends('layouts.main-perhitungan')

@section('content')

<div class="row mt-3">
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
                        <?php

use App\Models\RegenciesDomain;
use Illuminate\Support\Facades\Crypt;

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
                        <th class="text-white text-center align-middle">{{ $item['candidate']}} - <br> {{ $item['deputy_candidate']}}</th>
                        @endforeach

                    </thead>
                    <tbody>
                        <!-- Foreach here -->

                        @foreach($district as $dist)
                        <tr>
                            <td><a href="{{url('/')}}/administrator/perhitungan_kelurahan/{{Crypt::encrypt($dist['id'])}}">{{$dist->name}}</a></td>
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
                        <th class="text-white text-center align-middle">{{ $item['candidate']}} - <br> {{ $item['deputy_candidate']}}</th>
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
<?php
    
    $currentDomain = request()->getHttpHost();
    if (isset(parse_url($currentDomain)['port'])) {
        $url = substr($currentDomain, 0, strpos($currentDomain, ':8000'));
    }else{
        $url = $currentDomain;
    }
    $regency_id = RegenciesDomain::where('domain',"LIKE","%".$url."%")->first();

    if(request()->segment(1) == "administrator" && request()->segment(2) == "perhitungan_kecamatan"){
        $id_wilayah = Crypt::decrypt(request()->segment(3));
        $tipe_wilayah = "kecamatan";
    }elseif(request()->segment(1) == "administrator" && request()->segment(2) == "index"){
        $id_wilayah = $regency_id->regency_id;
        $tipe_wilayah = "kota";
        
    }else{
        $id_wilayah = Crypt::decrypt(request()->segment(3));
        $tipe_wilayah = "kelurahan";
    }
    ?>
    <livewire:dpt-pemilih-component :id_wilayah="$id_wilayah" :tipe_wilayah="$tipe_wilayah" />


@endsection