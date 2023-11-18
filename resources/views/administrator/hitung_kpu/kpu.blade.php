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
$paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id,SUM(voice) as total FROM saksi_data WHERE regency_id = "' . $config->regencies_id . '" GROUP by paslon_id ORDER by total DESC'));
$urutan = $paslon_tertinggi;
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
        top:7.5px;
        left: 0px;
    }

    .custom-next {
        position: absolute;
        top:7.5px;
        right: 0px;
    }

    .carousel-item {
        transition: -webkit-transform .6s ease;
        transition: transform .6s ease;
        transition: transform .6s ease,-webkit-transform .6s ease;
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
            <?php $regency =Regency::where('id',$config->regencies_id)->select('name')->first(); ?>
            <li><a href="" class="text-white">{{$regency->name}}</a></li>
    
        </ul>
    </div>

    <div class="col-12 mt-1">
        <div class="card">
            {{-- <div class="card-header bg-info">
                <h3 class="card-title text-white">Suara TPS Masuk</h3>
            </div> --}}
            <div class="card-body" style="position: relative">
                <img src="{{asset('')}}assets/icons/hisuara_new.png" style="position: absolute; top: 25px; left: 25px; width: 100px"
                    alt="">
                <div class="row">
                    <div class="col-xxl-6">
                        <div class="container">
                            <div class="text-center fs-3 mb-3 fw-bold">Suara Masuk</div>
                            <div class="text-center">Progress {{substr($realcount,0,5)}}% dari 100%</div>
                            <div class="text-center mt-2 mb-2"><span class="badge bg-success">{{$total_incoming_vote}} / {{$dpt}}</span></div>
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

                    <style>
                        .row:has(> .custom-urutan){
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
                        <div class="text-center title-atas-table fs-5 mb-0 fw-bold">Hasil Perhitungan Suara</div>
                        <div class="text-center title-atas-table fs-5 mb-0 fw-bold">Pemilihan Presiden dan Wakil Presiden</div>
                        <div class="text-center title-atas-table fs-5 fw-bold">{{ $kota['name'] }}</div>
                        <div class="row mx-auto" style="width: 884.5px;">
                            @foreach ($urutan as $urutPaslon)
                            <?php $pasangan = App\Models\Paslon::where('id', $urutPaslon->paslon_id)->first(); ?>
                            <div class="col py-2 judul text-center text-white custom-urutan"
                                style="background: {{ $pasangan->color }}">
                                <div class="text">{{ $pasangan->candidate }} || {{ $pasangan->deputy_candidate }} : {{$urutPaslon->total}}</b></div>
                            </div>
                            @endforeach
                        </div>
                        <table class="table table-bordered table-hover mt-3">
                            <thead class="bg-primary">
                                <tr>
                                    <th class="text-white text-center align-middle">KECAMATAN</th>
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kec as $item)
                                <tr onclick='check("{{Crypt::encrypt($item->id)}}")'>
                                    <td class="align-middle">
                                        <a href="{{url('/')}}/administrator/kpu_kecamatan/{{Crypt::encrypt($item['id'])}}">{{$item['name']}}</a>
                                    </td>
                                    @foreach ($paslon as $cd)
                                    <?php $saksi_dataa = SaksiData::join('saksi', 'saksi.id', '=', 'saksi_data.saksi_id')->where('paslon_id', $cd['id'])->where('saksi_data.district_id', $item['id'])->sum('voice'); ?>
                                    <td class="align-middle">{{$saksi_dataa}}</td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                            <script>
                                let check = function (id) {
                                    window.location = `{{url('/')}}/administrator/kpu_kecamatan/${id}`;
                                }
                            </script>
                        </table>
                    </div>
                    {{-- <div class="col-md">
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner text-center custom">
                                <?php $count = 1; ?>
                                @foreach ($kec as $item)
                                <div class="carousel-item <?php if ($count++ == 1) : ?><?= 'active' ?><?php endif; ?>">
                                    <div class="fw-bold fs-3 mb-3">
                                        KECAMATAN {{$item['name']}}
                                    </div>
                                    <div class="row">
                                        <?php $i = 1; ?>
                                        @foreach ($paslon as $psl)
                                        <?php
                                        $pasln = SaksiData::join('districts', 'districts.id', '=', 'saksi_data.district_id')->where('saksi_data.district_id', $item['id'])->where('saksi_data.paslon_id', $psl->id)->get();
                                        $jumlah = 0;
                                        foreach ($pasln as $pas) {
                                            $jumlah += $pas->voice;
                                        }
                                        $persen = substr($jumlah / $item->dpt * 100, 0, 3);
                                        ?>
                                        <div class="col-md">
                                            <div class="card mb-4">
                                                <div class="card-header justify-content-center"
                                                    style="background-color:{{$psl->color}}">
                                                    <h5 style="margin-bottom: 0;" class="text-white">{{$psl->candidate}}
                                                        || {{$psl->deputy_candidate}}</h5>
                                                </div>
                                                <div class="card-body" style="padding: 10px;">
                                                    <div class="row">
                                                        <div class="col">
                                                            <img src="{{asset('storage/'. $psl['picture'])}}" width="100px"
                                                                height="100px" style="object-fit: cover;" alt="">
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
                            <button class="arrow-nav custom-prev" type="button" data-bs-target="#carouselExampleControls"
                                data-bs-slide="prev">
                                <i class="fa-solid fa-chevron-left" style="color: rgba(0, 0, 0, 0.5);font-size: 25px"></i>
                            </button>
                            <button class="arrow-nav custom-next" type="button" data-bs-target="#carouselExampleControls"
                                data-bs-slide="next">
                                <i class="fa-solid fa-chevron-right" style="color: rgba(0, 0, 0, 0.5);font-size: 25px"></i>
                            </button>
                        </div>
                    </div>  --}}
                </div>
                </div>

                {{-- <div class="col-md">
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner text-center custom">
                            <?php $count = 1; ?>
                            @foreach ($kec as $item)
                            <div class="carousel-item <?php if ($count++ == 1) : ?><?= 'active' ?><?php endif; ?>">
                                <div class="fw-bold fs-3 mb-3">
                                    KECAMATAN {{$item['name']}}
                                </div>
                                <div class="row">
                                    <?php $i = 1; ?>
                                    @foreach ($paslon as $psl)
                                    <?php
                                    $pasln = SaksiData::join('districts', 'districts.id', '=', 'saksi_data.district_id')->where('saksi_data.district_id', $item['id'])->where('saksi_data.paslon_id', $psl->id)->get();
                                    $jumlah = 0;
                                    foreach ($pasln as $pas) {
                                        $jumlah += $pas->voice;
                                    }
                                    $persen = substr($jumlah / $item->dpt * 100, 0, 3);
                                    ?>
                                    <div class="col-md">
                                        <div class="card mb-4">
                                            <div class="card-header justify-content-center"
                                                style="background-color:{{$psl->color}}">
                                                <h5 style="margin-bottom: 0;" class="text-white">{{$psl->candidate}}
                                                    || {{$psl->deputy_candidate}}</h5>
                                            </div>
                                            <div class="card-body" style="padding: 10px;">
                                                <div class="row">
                                                    <div class="col">
                                                        <img src="{{asset('storage/'. $psl['picture'])}}" width="100px"
                                                            height="100px" style="object-fit: cover;" alt="">
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
                        <button class="arrow-nav custom-prev" type="button" data-bs-target="#carouselExampleControls"
                            data-bs-slide="prev">
                            <i class="fa-solid fa-chevron-left" style="color: rgba(0, 0, 0, 0.5);font-size: 25px"></i>
                        </button>
                        <button class="arrow-nav custom-next" type="button" data-bs-target="#carouselExampleControls"
                            data-bs-slide="next">
                            <i class="fa-solid fa-chevron-right" style="color: rgba(0, 0, 0, 0.5);font-size: 25px"></i>
                        </button>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

    
</div>

<script>
    // $('.mode-1').on('click', function() {
    //     $('.tampilan-1').show();
    //     $('.tampilan-2').hide();
    // })
    // $('.mode-2').on('click', function() {
    //     $('.tampilan-1').hide();
    //     $('.tampilan-2').show();
    // })
</script>
@endsection
