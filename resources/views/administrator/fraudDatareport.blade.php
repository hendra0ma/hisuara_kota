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

@include('layouts.partials.head')
@include('layouts.partials.sidebar')
@include('layouts.partials.header')

<div class="row mt-3">
    <div class="col-lg">
        <h1 class="page-title fs-1 mt-2">Barkode Kecurangan
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            {{-- <li class="breadcrumb-item"><a href="#">Bukti Kecurangan</a></li> --}}
            <li class="breadcrumb-item active" aria-current="page">
                {{$kota->name}}
                <!-- Kota -->
            </li>
        </ol>
    </div>

    <div class="col-lg-auto my-auto">
        <a href="{{route('superadmin.print_qr')}}" target="_blank" class="btn btn-block btn-dark">
            Print &nbsp; <i class="fa fa-print"></i>
        </a>
    </div>
</div>

{{-- <h4 class="fs-4 mt-5 fw-bold">Election Fraud Barcode Report (EFBR) <div>Dilindungi Paten Rekapitung</div> --}}
</h4>

<h4 class="fw-bold fs-4 mt-5 mb-0">
    Jumlah Barcode : {{$jumlah_barcode}}
</h4>
<hr style="border: 1px solid">

<div class="card mt-5">
    <div class="card-body">
        <livewire:fraud-barcode-report-component />
    </div>
</div>

</div>
@include('layouts.partials.footer')
@include('layouts.partials.scripts-bapilu')
@include('layouts.templateCommander.script-command')