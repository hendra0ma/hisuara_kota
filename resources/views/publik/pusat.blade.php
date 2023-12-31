<?php

use App\Models\Config;
use App\Models\District;
use App\Models\Village;
use App\Models\Tps;
use App\Models\SaksiData;
use App\Models\Paslon;
?>
@extends('layouts.mainpublicPusat')
@section('content')
<?php

use App\Models\Configs;
use App\Models\Province;
use App\Models\RegenciesDomain;
use App\Models\Regency;
use App\Models\SuaraC1Provinsi;
use Illuminate\Support\Facades\DB;

$configs = Config::all()->first();
$config = $configs;
$saksidatai =  DB::table('regencies')
->selectRaw('SUM(suara1 + suara2 + suara3) as total_suara')
->value('total_suara');
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
                    <?php

                    $i = 1;

                    $voice = 0;
                    ?>

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
                                        $regency = Regency::get();
                                        foreach ($regency as $regen) {
                                            $voice += $regen['suara' . $i];
                                        }
                                        $i++;
                                        ?>

                                        <h3 class="mb-2 number-font">{{ $voice }} suara</h3>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php $voice = 0; ?>
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

                                @foreach ($provinsi as $prv)
                                <tr>
                                    <td>
                                        <a href="{{route('provinsi'.$prv->id.'.public',Crypt::encrypt($prv->id))}}">

                                            {{$prv->name}}
                                        </a>
                                    </td>
                                    <?php
                                    $i = 1;
                                    ?>
                                    @foreach ($paslon as $pas)
                                    <?php
                                    ${'suara' . $i} = Regency::where('province_id', $prv->id)->sum('suara' . $i);
                                    ?>
                                    <td>{{ ${'suara'.$i} }}</td>
                                    <?php $i++; ?>
                                    @endforeach
                                    <?php $i = 0 ?>

                                </tr>
                                @endforeach
                            </tbody>


                        </table>
                    </div>

                    @foreach ($provinsi as $prv)
                    <div class="col-4">
                        <div class="card border-0 shadow-sm">
                        <div class="card-header bg-dark">
                            <h4 class="fw-bold text-light text-center mx-auto">
                                    {{$prv->name}}
                                </h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-provinsi{{$prv->id}}"></div>
                              
                                    <?php
                                    $i = 1;
                                    ?>
                                    @foreach ($paslon_candidate as $pas)

                                    <?php
                                    ${'suara' . $i} = Regency::where('province_id', $prv->id)->sum('suara' . $i);
                                    ?>

                                   
                                        {{$pas->candidate}} & {{$pas->deputy_candidate}} | {{ ${'suara'.$i} }} <br>
                                  
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
                                    <th class="align-middle text-white">Provinsi</th>
                                    @foreach ($paslon_candidate as $item)
                                    <th class="text-white">{{ $item['candidate']}}</th>
                                    @endforeach

                                </tr>
                            </thead>

                            <tbody>

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