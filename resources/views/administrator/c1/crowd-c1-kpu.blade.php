@extends('layouts.main-verifikasi-akun')

@section('content')

<?php

use App\Models\District;
use App\Models\Village;
use App\Models\TPS;

use App\Models\Regency;
use App\Models\Config;
use App\Models\RegenciesDomain;
use Illuminate\Support\Facades\Crypt;

$data['config'] = Config::first();
$config = Config::first();
$kota = Regency::where('id', $config['regencies_id'])->first();
?>

<div class="row mt-5">
    <div class="col-lg">
        <h1 class="page-title fs-1 mt-2">Crowd C1 KPU
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">{{ $kota->name }}
                <!-- Kota -->
            </li>
        </ol>
    </div>
    <div class="col-lg-6">
        <div class="alert alert-danger" role="alert">
            <div class="row">
                <div class="col-auto">
                    <i class="fa-solid fa-circle-exclamation" style="font-size: 50px"></i>
                </div>
                <div class="col">
                    Data C1 ini didapat dari situs KPU dan belum terproses pada Realcount. 
                    Anda harus melakukan proses verifikasi terlebih dahulu dengan cara klik
                    pada gambar C1. 
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <h4 class="fw-bold fs-4 mt-5 mb-0">
            Jumlah Crowd C1 KPU : {{$jumlah_c1}}
        </h4>

    </div>
    <div class="col-auto mt-auto">
        <div class="btn btn-success">
            <i class="fa-solid fa-download"></i>
            Unduh
        </div>
    </div>
</div>

<hr style="border: 1px solid">


<!-- :wilayah_id="$id_wilayah" :tipe_wilayah="$tipe_wilayah" -->


<livewire:crowd-c1-kpu />

@endsection