@extends('layouts.main-verifikasi-akun')

@section('content')

<?php
use App\Models\District;
use App\Models\Village;
use App\Models\Tps;
use App\Models\Regency;
use App\Models\Config;

$data['config'] = Config::first();
$config = Config::first();
$kota = Regency::where('id', $config['regencies_id'])->first();
?>

<!-- PAGE-HEADER -->
<div class="row mt-5">
    <div class="col-lg-3">
        <h1 class="page-title fs-1 mt-2">Pelacakan Saksi
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                {{ $kota->name }}
                <!-- Kota -->
            </li>
        </ol>
    </div>
    <div class="col-lg-9">
        <div class="row" style="flex-wrap: nowrap; width: 100%; overflow: scroll">
            @foreach ($saksi as $ls)
            <div class="col-md-auto">
                @if ($ls->profile_photo_path == NULL)
                <img class="" style="width: 125px; height: 125px; object-fit: cover"
                    src="https://ui-avatars.com/api/?name={{ $ls->name }}&color=7F9CF5&background=EBF4FF" alt="img">
                @else
                <img class="" style="width: 125px; height: 125px; object-fit: cover" src="{{url("/storage/profile-photos/".$ls->profile_photo_path) }}">
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- PAGE-HEADER END -->

<div class="row">
    <div class="col-md">
        <h4 class="fw-bold fs-4 mt-5 mb-0">
            Jumlah Saksi : {{$jumlah_saksi}}
        </h4>
    </div>
    <div class="col-md-auto mt-auto">
    </div>
</div>
<hr style="border: 1px solid">
<div class="row mt-3">

    <div class="col-12">
        <div class="card mg-b-20" style="display:{{($config->otonom == 'yes')?' none':'block'}}">
            <div class="card-body">
                <div class="ht-300" id="map" style="height:600px; z-index: 2"></div>
            </div>
        </div>
    </div>

</div>
@endsection