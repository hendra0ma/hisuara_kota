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
use App\Models\Province;
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

                <div class="row mt-5 edit-disini">
                    <div class="col-md-12 mt-5 table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="bg-primary">
                                <tr>
                                    <?php $i = 1 ?>
                                    <th class="text-white align-middle">Kelurahan</th>
                                    @foreach ($paslon_candidate as $item)
                                    <th class="text-white align-middle">({{$i++}}) <br> {{ $item['candidate']}} / <br> {{ $item['deputy_candidate']}}</th>
                                    @endforeach

                                </tr>
                            </thead>
                            <tbody>
                                <?php // dd(\App\Models\SaksiData::suara(0,3674040001)) ?>
                            @foreach ($kel as $item)
                            <tr onclick='check("{{Crypt::encrypt($item->id)}}")'>
                                <td class="text-middle"><a class="text-dark" href="/publik/kelurahan/{{Crypt::encrypt($item['id'])}}">{{$item['name']}}</a></td>
                                <?php $si_item = $item['id']; ?>
                                @foreach ($paslon_candidate as $cd)
                                <?php
                                    // $saksi_dataa = \App\Models\SaksiData::where([
                                    //         ['paslon_id', '=', $cd['id']],
                                    //         ['village_id', '=', $item['id']]
                                    //     ])->sum('voice');
                                    // $saksi_dataa = \App\Models\SaksiData::suara(intval($cd['id']), intval($item['id']));
                                ?>
                                <td class="text-middle data-disini">{{ SaksiData::suara($cd['id'],$item['id']) }}</td>
                                @endforeach
                            </tr>
                            @endforeach
                            </tbody>
                            <script>
                                let check = function(id) {
                                    window.location = `{{url('')}}/publik/kelurahan/${id}`;
                                }
                            </script>
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
                                        <h3 class="mb-2 number-font">{{ $voice }} suara r</h3>
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
                            {{$kota['name']}}
                        </h5>
                    </div>
                    <div class="col-md-12 mt-3">
                        <h5 class="text-uppercase">
                            <span class="badge bg-primary">Progress : 480 TPS Dari 2963 TPS</span>
                        </h5>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-12 mt-5">
                        <table class="table table-bordered table-hover">
                            <thead class="bg-primary">
                                <tr>
                                    <th class="align-middle text-white">kelurahan</th>
                                    @foreach ($paslon_candidate as $item)
                                    <th class="text-white">{{ $item['candidate']}}</th>
                                    @endforeach

                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($kel as $item)


                                <tr onclick='check("{{Crypt::encrypt($item->id)}}")'>
                                    <td><a class="text-dark" href="/publik/kelurahan/{{Crypt::encrypt($item['id'])}}">{{$item['name']}}</a></td>
                                    @foreach ($paslon_candidate as $cd)
                                    <?php $saksi_dataa =   Tps::join('saksi','saksi.tps_id','=','tps.id')
                                    ->join('saksi_data','saksi_data.saksi_id','=','saksi.id')
                                    ->where('saksi_data.paslon_id',$cd->id)
                                    ->where('saksi_data.village_id',(string)$item['id'])
                                    ->where('tps.sample', 1)
                                     ->sum('saksi_data.voice');
?>
                                    <td>{{$saksi_dataa}}</td>
                                    @endforeach


                                </tr>
                                @endforeach
                            </tbody>

                            <script>
                                let check = function(id) {
                                    window.location = `publik/kelurahan/${id}`;
                                }
                            </script>
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
                                    <th class="align-middle text-white">kelurahan</th>
                                    @foreach ($paslon_candidate as $item)
                                    <th class="text-white">{{ $item['candidate']}}</th>
                                    @endforeach

                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($kel as $item)


                                <tr onclick='check("{{Crypt::encrypt($item->id)}}")'>
                                    <td><a class="text-dark" href="/publik/kelurahan/{{Crypt::encrypt($item['id'])}}">{{$item['name']}}</a></td>
                                    @foreach ($paslon_candidate as $cd)
                                    <?php $saksi_dataa = SaksiData::join('saksi', 'saksi.id', '=', 'saksi_data.saksi_id')
                                        ->where('paslon_id', $cd['id'])
                                        ->where('saksi_data.village_id',(string)$item['id'])
                                        ->where('verification', 1)
                                        ->sum('voice'); ?>
                                    <td>{{$saksi_dataa}}</td>
                                    @endforeach


                                </tr>
                                @endforeach
                            </tbody>

                            <script>
                                let check = function(id) {
                                    window.location = `publik/kelurahan/${id}`;
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