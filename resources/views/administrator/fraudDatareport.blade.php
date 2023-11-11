<?php
use App\Models\District;
use App\Models\Village;
use App\Models\Tps;
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

$kota = Regency::where('id', $config->regencies_id)->first();
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

<livewire:fraud-barcode-report-component />

</div>
@include('layouts.partials.footer')
@include('layouts.partials.scripts-bapilu')
@include('layouts.templateCommander.script-command')