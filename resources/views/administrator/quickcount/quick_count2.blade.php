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
$kota = Regency::where('id', $config->regencies_id)->first();
$paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id,SUM(voice) as total FROM saksi_data WHERE regency_id = "' . $config->regencies_id . '" GROUP by paslon_id ORDER by total DESC'));
$urutan = $paslon_tertinggi;
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
            <h2 class="page-title mt-1 mb-0" style="font-size: 60px">
                QUICK COUNT
            </h2>
            <h4 class="mt-2">
                {{ $kota['name'] }}
            </h4>
           </center>
        </div>

        <div class="col-12">
            
            <div class="card" style="margin-bottom: 1rem">
                <div class="card-body" style="position: relative">
                    <img src="{{asset('')}}assets/icons/hisuara_new.png" style="position: absolute; top: 25px; left: 25px; width: 100px"
                        alt="">
                    <div class="row">
                        <div class="col-xxl-6">
                            <div class="container">
                                <div class="text-center fs-3 mb-3 fw-bold">Suara Masuk</div>
                                <div class="text-center">Progress {{substr($realcount,0,5)}}% dari 100%</div>
                                <div class="text-center mt-2 mb-2"><span class="badge bg-success">{{$total_incoming_vote}} /
                                        {{$dpt}}</span></div>
                                <div id="chart-pie2" class="chartsh h-100 w-100"></div>
                            </div>

                            <?php $i = 1; ?>
                            <div class="row mt-2">
                                @foreach ($paslon as $pas)
                                <div class="col-lg col-md col-sm col-xl mb-3">
                                    <div class="card" style="margin-bottom: 0px;">
                                        <div class="card-body">
                                            <div class="row me-auto">
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
                            <div class="text-center title-atas-table fs-5 mb-0 fw-bold">Hasil Perhitungan Cepat</div>
                            <div class="text-center title-atas-table fs-5 mb-0 fw-bold">Pemilihan Presiden dan Wakil Presiden</div>
                            <div class="text-center title-atas-table fs-5 fw-bold">PROVINSI {{$props->name}}</div>
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
                                        <th class="text-white text-center align-middle">{{ $item['candidate']}} - <br>
                                            {{ $item['deputy_candidate']}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kec as $item)
                                    <tr onclick='check("{{Crypt::encrypt($item->id)}}")'>
                                        <td class="align-middle"><a
                                                href="{{url('/')}}/administrator/perhitungan_kecamatan/{{Crypt::encrypt($item['id'])}}">{{$item['name']}}</a>
                                        </td>
                                        @foreach ($paslon as $cd)
                                        <?php $saksi_dataa = SaksiData::join('saksi', 'saksi.id', '=', 'saksi_data.saksi_id')->where('paslon_id', $cd['id'])->where('saksi_data.district_id', $item['id'])->sum('voice'); ?>
                                        <td class="align-middle text-end">(dummy)</td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                                <script>
                                    let check = function (id) {
                                        window.location = `{{url('/')}}/administrator/perhitungan_kecamatan/${id}`;
                                    }
                                </script>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        {{-- <div class="col-md-12 mt-4 text-center">
            <h1 class="fw-bold mb-2">
                Perolehan Tingkat Kecamatan
            </h1>
        </div>
        <hr style="background-color: black">
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
        </div> --}}
        
</div>



<div class="modal fade" id="modaltpsQuick2" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content text-white" id="container-tps-quick2">

        </div>
    </div>
</div>

{{-- <script>
    setTimeout(() => {
        window.location.href = "{{url('/')}}/administrator/redirect_quick_nasional"
    }, 5000);
</script> --}}
@endsection
