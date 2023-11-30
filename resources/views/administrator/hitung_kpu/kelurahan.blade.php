@extends('layouts.mainlayoutKpu')

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
// $paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id,SUM(voice) as total FROM saksi_data WHERE regency_id = "' . $config->regencies_id . '" GROUP by paslon_id ORDER by total DESC'));
// $urutan = $paslon_tertinggi;
$kota = Regency::where('id', $config->regencies_id)->first();
$dpt = District::where('regency_id', $config->regencies_id)->sum('dpt');
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
            <h2 class="page-title mt-1 mb-3" style="font-size: 60px">
                HITUNG ULANG KPU
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
            <?php
            
            
                $regency = Regency::where('id', $config->regencies_id)->first();
                $district = District::where('id',(string) $desa->district_id)->first();
                ?>
            <li><a href="{{url('')}}/administrator/real_count2" class="text-white">{{$regency->name}}</a></li>
            <li><a href="{{url('')}}/administrator/realcount_kecamatan/{{Crypt::encrypt($district->id)}}"
                    class="text-white">{{$district->name}}</a></li>
            <li><a href="{{url('')}}/administrator/realcount_kelurahan/{{Crypt::encrypt($id_kelurahan)}}"
                    class="text-white">{{$desa->name}}</a></li>
    
        </ul>
    </div>

    <div class="col-12 mt-1">
        <div class="card">
            <div class="card-body" style="position: relative">
                <img src="{{asset('')}}assets/icons/hisuara_new_new.png"
                    style="position: absolute; top: 25px; left: 25px; width: 150px" alt="">
                <div class="row">
                    <div class="col-xxl-6">
                        <div class="container">
                            <div class="text-center fs-3 mb-3 fw-bold">Suara Masuk</div>
                            <div class="text-center">Progress {{substr($realcount,0,5)}}% dari 100%</div>
                            <div class="text-center mt-2 mb-2"><span class="badge bg-success">{{$total_incoming_vote}} /
                                    {{$dpt}}</span></div>
                            <div id="chart-pie" class="chartsh h-100 w-100"></div>
                        </div>
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
                                              
                                                <h3 class="mb-2 number-font">{{ $suaraCrowd['suaraCrowd'.$pas->id] }} suara</h3>
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

                    <div class="col-xxl-6" style="height: 640px; overflow-y: scroll; overflow-x: hidden">
                        <div class="text-center title-atas-table fs-5 mb-0 fw-bold">Hasil Perhitungan Suara</div>
                        <div class="text-center title-atas-table fs-5 mb-0 fw-bold">Pemilihan Presiden dan Wakil
                            Presiden</div>
                        <div class="text-center title-atas-table fs-5 fw-bold">{{ $kota['name'] }}</div>
                        <div class="row mx-auto" style="width: 884.5px;">
                            @foreach ($urutan as $pasangan)
                       
                            <div class="col py-2 judul text-center text-white custom-urutan"
                                style="background: {{ $pasangan->color }}">
                                <div class="text">{{ $pasangan->candidate }} || {{ $pasangan->deputy_candidate }} :
                                </b></div>
                            </div>
                            @endforeach
                        </div>
                        <table class="table table-bordered table-hover mt-3 display">
                            <thead style="background-color: #45aaf2;">
                                <tr>
                                    <th class="align-middle text-white text-center align-middle" rowspan="2">TPS</th>
                                    @foreach ($urutan as $item)
                                    <th class="text-white text-center align-middle" style="background: {{$item->color}}; position:relative">
                                        <img style="width: 60px; position: absolute; left: 0; bottom: 0" src="{{asset('')}}storage/{{$item->picture}}"
                                            alt="">
                                        <div class="ms-7">
                                            {{ $item['candidate']}} - <br>
                                            {{ $item['deputy_candidate']}}
                                        </div>
                                    </th>
                                    @endforeach
                        
                                </tr>
                            </thead>
                        
                            <tbody>
                                @foreach ($tps_kel as $item)
                        
                        
                                <tr data-id="{{$item['id']}}" data-bs-toggle="modal" class="modal-id" data-bs-target="#modal-id">
                                    <td> <a href="{{url('')}}/administrator/kpu_tps/{{Crypt::encrypt($item->id)}}"
                                            class="modal-id" style="font-size: 0.8em;" id="Cek">TPS
                                            {{$item['number']}}</a>
                                
                        
                                    @php
                                        ${"suara".$item->id} = [];
                                    @endphp

                                    @foreach ($paslon as $cd)
                                    <?php $saksi_dataa =  App\Models\DataCrowdC1::where('paslon_id', $cd['id'])
                                    ->where('tps_id', (string)$item['id'])
                                    ->sum('voice');
                                    
                                      ${"suara".$item->id}[$cd->id] = $saksi_dataa;
                                     ?>
                                    <td class="align-middle text-end">{{$saksi_dataa}}</td>

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
<script>
    $(document).ready(function() {
        var specificUrl = "{{ url('') }}/administrator/hitung_kpu"; // Specific URL to match
    
        $('.glowy-menu[href="' + specificUrl + '"]').addClass('active');
    });
</script>
@endsection