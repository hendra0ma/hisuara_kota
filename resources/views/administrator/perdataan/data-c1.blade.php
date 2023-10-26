@extends('layouts.main-verifikasi-akun')

@section('content')

<?php

use App\Models\District;
use App\Models\Village;
use App\Models\TPS;

use App\Models\Regency;
use App\Models\Config;

$data['config'] = Config::first();
$config = Config::first();
$kota = Regency::where('id', $config['regencies_id'])->first();
?>

<div class="row mt-5">
    <div class="col-lg-4">
        <h1 class="page-title fs-1 mt-2">Data C1
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">{{ $kota->name }}
                <!-- Kota -->
            </li>
        </ol>
    </div>
</div>

<h4 class="fw-bold fs-4 mt-5 mb-0">
    Jumlah C1 : {{$jumlah_c1}}
</h4>
<hr style="border: 1px solid">

<livewire:all-c1-plano />

@endsection