@extends('layouts.mainlayout')

@section('content')

<?php
use App\Models\User;

use App\Models\Config;
use App\Models\District;
use App\Models\Regency;
use App\Models\SaksiData;
use App\Models\Tps;
use App\Models\Village;
use App\Models\Province;
use Illuminate\Support\Facades\DB;

$config = Config::all()->first();
use App\Models\Configs;
use App\Models\RegenciesDomain;
$configs = Config::all()->first();
$currentDomain = request()->getHttpHost();
if (isset(parse_url($currentDomain)['port'])) {
    $url = substr($currentDomain, 0, strpos($currentDomain, ':8000'));
}else{
    $url = $currentDomain;
}
$regency_id = RegenciesDomain::where('domain',"LIKE","%".$url."%")->first();

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

$regency = District::where('regency_id', $config->regencies_id)->get();
$kota = Regency::where('id', $config->regencies_id)->first();
$dpt = District::where('regency_id', $config->regencies_id)->sum('dpt');
$tps = Tps::count();
$props = Province::where('id',$kota['province_id'])->first();
?>

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

    .title-atas-table {
        line-height: 23px
    }
</style>

<div class="row" style="margin-top: 90px; transition: all 0.5s ease-in-out;">

    <div class="col-lg-12">
        <center>
            <h2 class="mb-3 page-title mt-1" style="font-size: 60px">
                TERVERIFIKASI
            </h2>
        </center>
    </div>

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
            <?php $regency =Regency::where('id',$config->regencies_id)->select('name')->first(); ?>
            <li><a href="" class="text-white">{{$regency->name}}</a></li>

        </ul>
    </div>

    <div class="col-12 mt-1">
        <div class="card">
            {{-- <div class="card-header bg-secondary">
                <h3 class="card-title text-white">Suara TPS Terverifikasi</h3>
            </div> --}}
            <div class="card-body" style="position: relative">
                <img src="{{asset('')}}assets/icons/hisuara_new_new.png"
                    style="position: absolute; top: 25px; left: 25px; width: 150px" alt="">
                <div class="row">
                    <div class="col-xxl-6">
                        <div class="container">
                            <div class="text-center fs-3 mb-3 fw-bold">Suara Masuk</div>
                            <div class="text-center">Terverifikasi {{$saksi_terverifikasi}} TPS dari {{$saksi_masuk}}
                                TPS Masuk</div>
                            <div class="text-center mt-2 mb-2"><span
                                    class="badge bg-success">{{$total_verification_voice}} / {{$dpt}}</span></div>
                            <div id="chart-donut" class="chartsh h-100 w-100"></div>
                        </div>
                        <?php $i = 1; ?>
                        <div class="row mt-2">
                            @foreach ($paslon_terverifikasi as $pas)
                            <div class="col-lg col-md col-sm col-xl mb-3">
                                <div class="card" style="margin-bottom: 0px;">
                                    <div class="card-body p-3">
                                        <div class="row me-auto">
                                            <div class="col-12">
                                                <div class="mx-auto counter-icon box-shadow-secondary brround candidate-name text-white ms-auto"
                                                    style="margin-bottom: 0; background-color: {{$pas->color}};">
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
                                                $voice += isset($dataTps->voice)?$dataTps->voice:0;
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

                    <style>
                        .row:has(> .custom-urutan) {
                            margin-top: 75px
                        }

                        .custom-urutan::before {
                            position: absolute;
                            top: -80px;
                            left: 50%;
                            transform: translateX(-50%);
                            font-size: 60px;
                            color: black;
                        }

                        .custom-urutan:nth-child(1)::before {
                            content: '1'
                        }

                        .custom-urutan:nth-child(2)::before {
                            content: '2'
                        }

                        .custom-urutan:nth-child(3)::before {
                            content: '3'
                        }
                    </style>

                    <div class="col-xxl-6">
                        <div class="text-center title-atas-table fs-5 mb-0 fw-bold">Hasil Verifikasi Suara</div>
                        <div class="text-center title-atas-table fs-5 mb-0 fw-bold">Pemilihan Presiden dan Wakil
                            Presiden</div>
                        <div class="text-center title-atas-table fs-5 fw-bold">{{ $kota['name'] }}</div>
                        <div class="row">
                            <div class="col-auto fw-bold text-center fs-4 d-flex">
                                <div class="mt-auto">
                                    Suara Terbanyak
                                </div>
                            </div>
                            <div class="col">
                                <div class="row mx-auto">
                                    @foreach ($urutan as $urutPaslon)
                                    <?php $pasangan = App\Models\Paslon::where('id', $urutPaslon->paslon_id)->first(); ?>
                                    <div class="col py-2 judul text-center text-white custom-urutan" style="background: {{ $pasangan->color }}">
                                        <div class="text">{{ $pasangan->candidate }} || {{ $pasangan->deputy_candidate }} :
                                            {{$urutPaslon->total}}</b></div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-hover mt-3">
                            <thead class="bg-primary">
                                <td class="text-white text-center align-middle">KECAMATAN</td>
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
                                @foreach ($kec as $item)
                                <tr onclick='check("{{Crypt::encrypt($item->id)}}")'>
                                    <td class="align-middle"><a
                                            href="{{url('/')}}/administrator/terverifikasi_kecamatan/{{Crypt::encrypt($item['id'])}}">{{$item['name']}}</a>
                                    </td>
                                    @foreach ($paslon as $cd)
                                    <?php $saksi_dataa = SaksiData::join('saksi', 'saksi.id', '=', 'saksi_data.saksi_id')->where('paslon_id', $cd['id'])->where('saksi_data.district_id', $item['id'])->where('saksi.verification',1)->sum('voice'); ?>
                                    <td class="align-middle text-end">{{$saksi_dataa}}</td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- <div class="col-md-12 mt-4 text-center">
                        <h1 class="fw-bold mb-2">
                            Perolehan Tingkat Kecamatan
                        </h1>
                    </div>
                    <hr style="background-color: black"> --}}


                </div>


            </div>
        </div>
    </div>

</div>

<div class="col-12 mt-5 mb-5" style="">
    <div class="row">
        <div class="col-12 text-center pt-2">
            <img src="{{asset('')}}assets/imagesKota/{{$kota->logo_kota}}" alt="">
        </div>
        <div class="col-12 text-black p-2 fs-5 fw-bold text-center">
            PERHITUNGAN TINGKAT KECAMATAN <br>
            {{$kota->name}}
        </div>
    </div>
</div>

<?php 
    $a = 1; 
    $b = 1; 
    $c = 1; 
    $d = 1; 
    $e = 1; 
?>

<div class="col-12">
    <div class="row">
        @foreach ($kec as $item)
        <div class="col-3">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <div class="card-title mx-auto">
                        <a href="{{url('/')}}/administrator/terverifikasi_kecamatan/{{Crypt::encrypt($item['id'])}}">
                            KECAMATAN {{$item['name']}}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div id="charture-{{$a++}}" class="chartsh h-100 w-100"></div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@foreach($kec as $item)
<script>
    // Sample data
    $(document).ready(function() {
        var chartData = {
        columns: [
            @foreach($paslon as $pas)
            <?php $saksi_dataaa = SaksiData::join('saksi', 'saksi.id', '=', 'saksi_data.saksi_id')->where('paslon_id', $pas['id'])->where('saksi_data.district_id', $item['id'])->where('saksi.verification',1)->sum('voice'); ?>
            ['data{{$d++}}', {{$saksi_dataaa}}],
            @endforeach
        ],
        type: 'pie', // Type of chart (line chart in this case)
        colors: {
            @foreach($paslon as $pas)
            data{{$c++}}: '{{$pas->color}}', // Color for the third data series
            @endforeach
        },
        names: {
            // name of each serie
            @foreach($paslon as $pas)
            data{{$e++}}: " {{ $pas['candidate']}} - {{ $pas['deputy_candidate']}}",
            @endforeach
        },
        legend: {
            show: true, //hide legend
        },
        axis: {
            rotated: true,
        },
    };

    // Chart configuration
    var chartConfig = {
        bindto: '#charture-{{$b++}}', // ID of the chart container
        data: chartData,
        pie: {
            label: {
                format: function (value, ratio, id) {
                    return d3.format('.1%')(ratio); // Show percentage on the labels
                }
            }
        }
    };

    // Generate the chart
    var chart = c3.generate(chartConfig);
    })
</script>
<?php $c = 1;?>
<?php $d = 1;?>
<?php $e = 1;?>
@endforeach
@endsection