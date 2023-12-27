<?php

use App\Models\Saksi;
use App\Models\SaksiData;
use App\Models\Rekapitulator;

use App\Models\Regency;
use App\Models\Config;

$data['config'] = Config::first();
$config = Config::first();
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

$kota = Regency::where('id', $config->regencies_id)->first();
?>
@extends('layouts.main-rekapitulator')

@section('content')
<div class="row mt-5">
    <div class="col-lg">
        <h1 class="page-title fs-1 mt-2">Verifikasi Saksi
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                {{ $kota->name }}
                <!-- Kota -->
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
        <div class="ms-auto pageheader-btn mt-5">
            <div class="row">
                <div class="col">
                    <!-- Authentication -->
                    <a href="{{url('')}}/rekapitulator/print_kecamatan" class="btn btn-dark btn-icon text-white w-100">
                        <span>
                            <i class="fa fa-print"></i>
                        </span> Print
                    </a>
                </div>
                <div class="col">
                    <!-- Authentication -->
                    <a href="#" onclick="saveDiv('pdf','Title')" class="btn btn-success btn-icon text-white w-100">
                        <span>
                            <i class="fa fa-save"></i>
                        </span> save
                    </a>
                </div>
            </div>


        </div>
    </div>
</div>

<div class="row mt-5" id="pdf">

    <div class="col-lg-6 col-md-12">
        <div class="card">
            <div class="card-header bg-dark">
                <div class="row w-100">
                    <div class="col-md-12 text-center">
                        <h5><img style="width: 113px;"
                            src="{{url('/')}}/assets/images/brand/hisuara.png"
                            alt=""></h5>
                    </div>
                    <div class="col-md-12 mt-2">
                        <h5 class="card-title mx-auto text-white">
                            <center>
                                Hasil Rekapitulasi Hisuara
                            </center>
                        </h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="bg-primary">
                        <tr>
                            <th class="text-center text-white align-middle">
                                Kelurahan
                            </th>
                            <th class="text-center text-white align-middle">
                                Suara Masuk (%)
                            </th>
                            @foreach ($suara as $suar)
                            <th class="text-center text-white align-middle">
                                {{$suar['candidate']}} - <br>
                                {{$suar['deputy_candidate']}}
                            </th>
                            @endforeach
                            <th class="text-center text-white align-middle">
                                Unduh
                            </th>
                        </tr>
                    </thead>

                    @foreach ($kecamatan as $item)
                    <?php $saksi  = Saksi::where('village_id', $item['id'])->get(); ?>
                    <?php $persen = count($saksi)  /   $item['tps'] * 100;
                    ?>
                    <tr>
                        <td>
                            {{$item['name']}}
                        </td>
                        <td>
                            {{floor($persen)}}%
                        </td>
                        @foreach ($suara as $suar)
                        <?php $saksi_data = SaksiData::where('paslon_id', $suar['id'])->where('village_id', (string)$item['id'])->sum('voice'); ?>
                        <td>
                            @if ($saksi_data == NULL)
                            Belum ada data
                            @else
                            {{$saksi_data}}
                            @endif
                        </td>
                        @endforeach
                        <td>
                            <a class="btn btn-success" href="#">Unduh</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row w-100">
                    <div class="col-md-12 text-center">
                        <h5><img style="width: 100px;"
                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/46/KPU_Logo.svg/925px-KPU_Logo.svg.png"
                            alt=""></h5>
                    </div>
                    <div class="col-md-12 mt-2">
                        <h5 class="card-title mx-auto">
                            <center>
                                Hasil Rekapitulasi KPU
                            </center>
                        </h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="bg-primary">
                        <tr>
                            <th class="text-center text-white align-middle">
                                Kelurahan
                            </th>
                            <th class="text-center text-white align-middle">
                                Suara Masuk (%)
                            </th>
                            @foreach ($suara as $suar)
                            <th class="text-center text-white align-middle">
                                {{$suar['candidate']}} - <br>
                                {{$suar['deputy_candidate']}}
                            </th>
                            @endforeach
                            <th class="text-center text-white align-middle">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    @foreach ($kecamatan as $kelurahan)
                    <?php $rekapitulator = Rekapitulator::where('village_id', (string)$kelurahan['id'])->get() ?>
                    <tr>
                        <td>
                            {{$kelurahan['name']}}
                        </td>
                        <td>
                            {{floor($persen)}}%
                        </td>
                        <form action="action_rekapitulator/{{Crypt::encrypt($kelurahan['id'])}}" method="post">
                            @csrf
                            {{-- <input class="form-control" type="hidden" name="id" value="{{$id}}"> --}}
                            @foreach ($rekapitulator as $item)
                            <td> <input class="form-control" type="text" name="{{$item['id']}}" value="{{$item['value']}}"></td>
                            @endforeach
                            <td>
                                <button class="btn btn-success" type="submit">Save</button>
                            </td>
                        </form>
    
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
