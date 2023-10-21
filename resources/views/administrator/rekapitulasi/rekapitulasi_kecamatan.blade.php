<?php

use App\Models\Saksi;
use App\Models\SaksiData;
use App\Models\Rekapitulator;

use App\Models\Regency;
use App\Models\Config;

$data['config'] = Config::first();
$config = Config::first();
$kota = Regency::where('id', $config['regencies_id'])->first();
?>
@extends('layouts.main-rekapitulator-kota')

@section('content')
<div class="row mt-3">
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
                    <a href="{{url('')}}/administrator/rekapitulator-kota-print"target="_blank" class="btn btn-dark btn-icon text-white w-100">
                        <span>
                            <i class="fa fa-print"></i>
                        </span> Print
                    </a>
                </div>
                <div class="col">
                    <!-- Authentication -->
                    <a href="#" class="btn btn-success btn-icon text-white w-100">
                        <span>
                            <i class="fa fa-save"></i>
                        </span> save
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<h4 class="fs-4 mt-2 fw-bold">
Election Results Comparison (ERC)
</h4>
<hr style="border: 1px solid">
<h4 class="fs-4 mt-2 fw-bold">
Tingkat Kabupaten / Kota
</h4>

<div class="row mt-5">

    <div class="col-lg-6 col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row w-100">
                    <div class="col-md-12 text-center">
                        <h5><img style="width: 145px;"
                            src="{{url('/')}}/assets/images/brand/logo_gold.png"
                            alt=""></h5>
                    </div>
                    <div class="col-md-12 mt-2">
                        <h5 class="card-title mx-auto">
                            <center>
                                Hasil Rekapitulasi Rekapitung
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
                                Kecamatan
                            </th>
                            <th class="text-center text-white align-middle">
                                Suara Masuk (%)
                            </th>

                            @foreach ($paslon as $item)
                            <th class="text-center text-white align-middle">
                                {{ $item['candidate']}} - <br>
                                {{ $item['deputy_candidate']}}
                            </th>
                            @endforeach
                            <th class="text-center text-white align-middle">
                                Unduh
                            </th>
                        </tr>
                    </thead>
                    @foreach ($kecamatan as $item)
                    <?php
                        $saksi = App\Models\Saksi::where('district_id', $item['id'])->get();
                        $tps = App\Models\Tps::where('district_id',$item['id'])->count();
                        ?>
                    <tr>
                        <td>
                            {{-- <a href="{{url('/')}}/administrator/rekapitulator/index/{{Crypt::encrypt($item['id'])}}"> --}}
                            <a>
                                {{$item['name']}}
                            </a>
                        </td>
                        <td>
                            <?php
                                if (count($saksi) == 0) {
                                    echo '0';
                                }else{
                                    $persen = count($saksi) /  $tps * 100;
                                    echo floor($persen);
                                } 
                            ?>%
                        </td>
                        @foreach ($paslon as $suar)
                        <?php $saksi_data = App\Models\SaksiData::where('paslon_id', $suar['id'])->where('district_id', $item['id'])->sum('voice'); ?>
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
                        <h5><img style="width: 75px;"
                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/46/KPU_Logo.svg/925px-KPU_Logo.svg.png"
                            alt="">
                            <div class="fw-bold mt-3">KOMISI PEMILIHAN UMUM</div>    
                        </h5>
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
                            @foreach ($paslon as $suar)
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
                    <?php $rekapitulator = App\Models\Rekapitulator::where('district_id', $kelurahan['id'])->where('regency_id',$kelurahan['regency_id'])->get() ?>
                    <tr>
                        <td>
                            {{$kelurahan['name']}}
                        </td>
                        <td>
                           <?php
                             if (count($saksi) == 0) {
                                    echo '0';
                                }else{
                                    $persen = count($rekapitulator) /  $tps * 100;
                                   echo floor($persen);
                                } 
                           ?>

                           
                        </td>
                        <form action="action_rekapitulator/{{Crypt::encrypt($kelurahan['id'])}}" method="post">
                            @csrf

                            @foreach ($rekapitulator as $item)
                            <td> <input class="form-control" type="text" name="{{$item['id']}}"
                                    value="{{$item['value']}}"></td>
                            @endforeach
                            <td><button class="btn btn-success" type="submit">Save</button></td>
                        </form>
                    </tr>
                    @endforeach
                </table>

            </div>
        </div>
    </div>
</div>
@endsection
