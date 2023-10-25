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
use Illuminate\Support\Facades\DB;

$config = Config::all()->first();
$regency = District::where('regency_id', $config['regencies_id'])->get();
$kota = Regency::where('id', $config['regencies_id'])->first();
$dpt = District::where('regency_id', $config['regencies_id'])->sum('dpt');
$tps = Tps::count();
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
</style>

<div class="row">

    <div class="col-lg-12">
       <center>
        <h3 class="page-title mt-1 mb-0" style="font-size: 60px">
            TERVERIFIKASI
        </h3>
        <h4 class="mt-2">
            {{ $kota['name'] }}
        </h4>
       </center>
    </div>

    <div class="col-12 mt-1">
        <div class="card">
            {{-- <div class="card-header bg-secondary">
                <h3 class="card-title text-white">Suara TPS Terverifikasi</h3>
            </div> --}}
            <div class="card-body">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="container">
                            <div class="text-center">Terverifikasi {{$saksi_terverifikasi}} TPS dari {{$saksi_masuk}}
                                TPS Masuk</div>
                            <div class="text-center mt-2 mb-2"><span
                                    class="badge bg-success">{{$total_verification_voice}} / {{$dpt}}</span></div>
                            <div id="chart-donut" class="chartsh h-100 w-100"></div>
                        </div>
                    </div>
                    <div class="col-xxl">
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

                    <div class="col-md-12 mt-4 text-center">
                        <h1 class="fw-bold mb-2">
                            Perolehan Tingkat Kecamatan
                        </h1>
                    </div>
                    <hr style="background-color: black">
                    
                    <table class="table table-bordered table-hover mt-4">
                        <thead class="bg-primary">
                            <td class="text-white text-center align-middle">KECAMATAN</td>
                            @foreach ($paslon as $item)
                            <th class="text-white text-center align-middle">{{ $item['candidate']}} - <br>
                                {{ $item['deputy_candidate']}}</th>
                            @endforeach
                        </thead>
                        <tbody>
                            @foreach ($kec as $item)
                            <tr onclick='check("{{Crypt::encrypt($item->id)}}")'>
                                <td><a
                                        href="{{url('/')}}/administrator/perhitungan_kecamatan/{{Crypt::encrypt($item['id'])}}">{{$item['name']}}</a>
                                </td>
                                @foreach ($paslon as $cd)
                                <?php $saksi_dataa = SaksiData::join('saksi', 'saksi.id', '=', 'saksi_data.saksi_id')->where('paslon_id', $cd['id'])->where('saksi_data.district_id', $item['id'])->where('saksi.verification',1)->sum('voice'); ?>
                                <td>{{$saksi_dataa}}</td>
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
@endsection
