<?php

use App\Models\Config;
use App\Models\District;
use App\Models\Village;
use App\Models\Tps;
use App\Models\SaksiData;
use App\Models\Paslon;
?>
@extends('layouts.mainpublicProvinsi')
@section('content')
<?php

use App\Models\Configs;
use App\Models\Province;
use App\Models\RegenciesDomain;
use App\Models\Regency;
use App\Models\SuaraC1Provinsi;

$configs = Config::all()->first();
$currentDomain = request()->getHttpHost();
if (isset(parse_url($currentDomain)['port'])) {
    $url = substr($currentDomain, 0, strpos($currentDomain, ':8000'));
} else {
    $url = $currentDomain;
}
$regency_id = RegenciesDomain::where('domain', "LIKE", "%" . $url . "%")->first();

$config = new Configs;
// $config->regencies_id =  (string) $regency_id->regency_id;
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
$saksidatai = SaksiData::sum("voice");
$dpt = Province::sum("dpt");
$data_masuk = (int)$saksidatai / (int)$dpt * 100;

?>

<div class="tab-content" id="pills-tabContent p-3">

    <!-- 1st card -->
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="card rounded-0">
            <div class="card-body">

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
                    <?php $voice = 0; ?>

                    @foreach ($paslon as $pas)
                    <div class="col-lg col-md col-sm col-xl mb-3    ">
                        <div class="card overflow-hidden" style="margin-bottom: 0px;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col col-auto">
                                        <div class="counter-icon box-shadow-secondary brround ms-auto candidate-name text-white" style="margin-bottom: 0; background-color: {{$pas->color}};">
                                            {{$i}}
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h6 class="">{{$pas->candidate}} </h6>
                                        <h6 class="">{{$pas->deputy_candidate}} </h6>
                                        <?php 
                                        $regency = Regency::where('province_id',$id_prov)->get();
                                        foreach ($regency as $regen) {
                                            $voice += $regen['suara'.$i];
                                        }   
                                        $i++;
                                        ?>

                                        <h3 class="mb-2 number-font">{{ $voice }} suara</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $voice=0; ?>
                    @endforeach
                </div>

                <div class="row mt-5">
                    <div class="col-md-12 mt-3">
                        <h5 class="text-uppercase">HITUNG SUARA PEMILIHAN Umum
                            Indonesia
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
                                    <th class="align-middle text-white">Provinsi</th>
                                    @foreach ($paslon_candidate as $item)
                                    <th class="text-white">{{ $item['candidate']}} , {{ $item['deputy_candidate']}} </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($provinsi as $kota)
                            <tr>
                                <td>
                                    <?php $regDomain = RegenciesDomain::where('regency_id',$kota->id)->select('domain')->first(); ?>
                                    <a href="{{env('HTTP_SSL').$regDomain->domain.env('HTTP_PORT','')}}/index">{{$kota->name}}</a>
                                </td>
                                <?php $j = 1; ?>
                                @foreach ($paslon_candidate as $item)
                                <td>{{ $kota['suara'.$j++]}}</td>
                                @endforeach
                            </tr>
                            @endforeach

                            </tbody>


                        </table>
                    </div>
                    <hr>
                    <div class="mt-2"></div>
                    @foreach ($provinsi as $reg)
                    <div class="col-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-dark">
                            <?php $regDomain = RegenciesDomain::where('regency_id',$reg->id)->select('domain')->first(); ?>
                                <h4 class="fw-bold text-light text-center mx-auto">
                                    <a href="{{env('HTTP_SSL').$regDomain->domain.env('HTTP_PORT','')}}/index">
                                    {{$reg->name}}
                                </a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-regency{{$reg->id}}"></div>
                                    <?php
                                    $i = 1;
                                    ?>
                                    @foreach ($paslon_candidate as $pas)
                                   
                                        {{$pas->candidate}} & {{$pas->deputy_candidate}} | {{ $reg['suara'.$i] }} <br>
                                  
                                    <?php $i++; ?>
                                    @endforeach
                                <?php $i = 0 ?>
                            </div>
                        </div>
                    </div>
                    @endforeach
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
                    <h5 class="text-uppercase">HITUNG SUARA PEMILIHAN umum
                        Indonesia
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
                                <th class="align-middle text-white">Kota</th>
                                @foreach ($paslon_candidate as $item)
                                <th class="text-white">{{ $item['candidate']}}</th>
                                @endforeach
                            </tr>
                        </thead>
                        @foreach ($provinsi as $kota)
                        <tr>
                            <td>{{$kota->name}}</td>
                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                        @endforeach
                        <tbody>

                            <tr>

                            </tr>

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