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
    <div class="col-lg">
        <h1 class="page-title fs-1 mt-2">Lacak Saksi
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                {{ $kota->name }}
                <!-- Kota -->
            </li>
        </ol>
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

    {{-- content --}}

</div>
@endsection