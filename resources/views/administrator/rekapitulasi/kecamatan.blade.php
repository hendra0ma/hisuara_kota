@extends('layouts.main-kecamatan')

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
                                <h3 class="mb-2 number-font">Benyamin Davnie /
                                    Pilar Saga ichsan</h3>
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
                    <div class="col-md">
                        <div class="container" style="margin-left: 3%; margin-top: 10%;">
                            <div class="text-center">Progress {{substr($realcount,0,5)}}% dari 100%</div>
                            <div id="chart-pie" class="chartsh h-100 w-100"></div>
                        </div>
                    </div>
                    <div class="col-md">
                        <?php $i = 1; ?>
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
                            <div id="chart-donut" class="chartsh h-100 w-100"></div>
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
</div>


<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mx-auto">Suara Masuk (Seluruh Kecamatan)</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <td>Wilayah</td>
                        <?php $i = 1;  ?>
                        @foreach($paslon as $pas)
                        <td>Suara 0{{$i++}}</td>
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
                                    ->where('saksi_data.village_id', $dist->id);
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
                <h5 class="card-title mx-auto">Suara Terverifikasi (Seluruh Kecamatan)</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <td>Wilayah</td>
                        <?php $i = 1;  ?>
                        @foreach($paslon as $pas)
                        <td>Suara 0{{$i++}}</td>
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
                                    ->where('saksi_data.district_id', $dist->id);
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

<div class="card mg-b-20">
    <div class="card-header">
        <div class="card-title">Admin Tracking (KECAMATAN {{$kecamatan->name}})</div>
    </div>
    <div class="card-body">
        <div class="ht-300" id="map" style="height:300px"></div>
    </div>
</div>

@endsection