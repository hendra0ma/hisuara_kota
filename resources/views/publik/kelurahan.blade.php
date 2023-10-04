<?php

use App\Models\District;
use App\Models\Village;
use App\Models\Tps;
use App\Models\SaksiData;
use App\Models\Paslon;
?>
@extends('layouts.mainpublic')
@section('content')

<?php
$saksidatai = SaksiData::sum("voice");
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
                    <div class="col-md">
                        <p class="text-center">
                        <div class="badge bg-primary">PROGRESS : {{substr($data_masuk, 0, 3)}}% DARI 100%</div>
                        </p>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-12">
                        <div id="chart-pie" class="chartsh h-100"></div>
                    </div>
                </div>

                <div class="row mt-5">
                    <?php $i = 1; ?>
                    @foreach ($paslon as $pas)
                    <div class="col-lg col-md col-sm col-xl mb-3    ">
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
                        <h5 class="text-uppercase">HITUNG SUARA PEMILIHAN
                            {{$kota['name']}}
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
                        <table class="table table-bordered text-nowrap border-bottom">
                            <thead class="bg-primary">
                                <tr>
                                    <?php $i = 1 ?>
                                    <th class="text-white align-middle">TPS</th>
                                    @foreach ($paslon_candidate as $item)
                                    <th class="text-white align-middle">({{$i++}}) <br> {{ $item['candidate']}} / <br> {{ $item['deputy_candidate']}}</th>
                                    @endforeach

                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($kel as $item)
                                    <tr data-id="{{$item['id']}}" data-bs-toggle="modal" class="modal-id" data-bs-target="#modal-id">
                                    <td class="align-middle"> <a href="#" class="modal-id text-dark" style="font-size: 0.8em;" id="Cek">TPS {{$item['number']}}</a>
                                        @foreach ($paslon_candidate as $cd)
                                        <?php $saksi_dataa = SaksiData::join('saksi', 'saksi.id', '=', 'saksi_data.saksi_id')
                                            ->where('paslon_id', (string)$cd['id'])
                                            ->where('tps_id', (string)$item['id'])
                                            ->sum('voice'); ?>
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

    <div class="tab-pane fade show" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <div class="card">
            <div class="card-body">
                <!-- nav options -->

                <div class="row">
                    <div class="col-md">
                        <p class="text-center">
                        <div class="badge bg-primary">RANDOM : {{substr($tps_selesai_quick / $tps_belum_quick * 100, 0, 4)}}% (10%) DARI 100%</div>
                        </p>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-12">
                        <div id="chart-donut" class="chartsh h-100"></div>
                    </div>
                </div>

                <div class="row mt-5">
                    <?php $i = 1; ?>
                    @foreach ($paslon_quick as $pas)
                    <div class="col-lg col-md col-sm col-xl mb-3    ">
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
                        <h5 class="text-uppercase">HITUNG SUARA PEMILIHAN PILPRES DAN WAKIL PILPRES
                            {{$kota['name']}}</h5>
                    </div>
                    <div class="col-md-12 mt-3">
                        <h5 class="text-uppercase">
                            <span class="badge bg-primary">Progress : 480 TPS Dari 2963 TPS</span>
                        </h5>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-12 mt-5 table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom">
                            <thead class="bg-primary">
                                <tr>
                                    <?php $i = 1 ?>
                                    <th class="text-white align-middle">TPS</th>
                                    @foreach ($paslon_candidate as $item)
                                    <th class="text-white align-middle">({{$i++}}) <br> {{ $item['candidate']}} / <br> {{ $item['deputy_candidate']}}</th>
                                    @endforeach

                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($kel as $item)
                                    <tr data-id="{{$item['id']}}" data-bs-toggle="modal" class="modal-id" data-bs-target="#modal-id">
                                    <td class="align-middle"> <a href="#" class="modal-id text-dark" style="font-size: 0.8em;" id="Cek">TPS {{$item['number']}}</a>
                                        @foreach ($paslon_candidate as $cd)
                                        <?php $saksi_dataa = SaksiData::join('saksi', 'saksi.id', '=', 'saksi_data.saksi_id')
                                            ->where('paslon_id', (string)$cd['id'])
                                            ->where('tps_id', (string)$item['id'])
                                            ->sum('voice'); ?>
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

    <div class="tab-pane fade show" id="pills-terverifikasi" role="tabpanel" aria-labelledby="pills-terverifikasi-tab">
        <div class="card rounded-0">
            <div class="card-body">
                <!-- nav options -->

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
                        <h5 class="text-uppercase">HITUNG SUARA PEMILIHAN
                            {{$kota['name']}}
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
                                    <th class="align-middle text-white" rowspan="2">Tps</th>
                                    @foreach ($paslon_candidate as $item)
                                    <th class="text-white">{{ $item['candidate']}}</th>
                                    @endforeach

                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($tps_ver as $item)


                                <tr data-id="{{$item['id']}}" data-bs-toggle="modal" class="modal-id" data-bs-target="#modal-id">
                                    <td> <a href="#" class="modal-id text-dark" style="font-size: 0.8em;" id="Cek">TPS {{$item['number']}}</a>

                                        @foreach ($paslon_candidate as $cd)

                                        <?php
                                        $tpsass = Tps::where('number',(string)$item['number'])
                                            ->where('villages_id',(string)$id)
                                            ->first();
                                        $saksi_data = SaksiData::join('saksi', 'saksi.id', '=', 'saksi_data.saksi_id')
                                            ->where('paslon_id',(string)$cd['id'])
                                            ->where('tps_id',(string)$tpsass->id)
                                            ->sum('voice'); ?>
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
</div>
</div>
</div>

</div>





@endsection
