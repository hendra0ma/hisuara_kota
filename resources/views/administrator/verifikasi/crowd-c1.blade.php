@extends('layouts.main-verifikasi-akun')

@section('content')

{{-- Verifikasi Saksi --}}
<?php
use App\Models\District;
use App\Models\Village;
use App\Models\Tps;
use App\Models\Regency;
use App\Models\Config;

$data['config'] = Config::first();
$config = 
first();
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

<!-- PAGE-HEADER -->
<div class="row mt-5">
    <div class="col-lg">
        <h1 class="page-title fs-1 mt-2">Verifikasi Crowd C1
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                {{ $kota->name }}
                <!-- Kota -->
            </li>
        </ol>
    </div>



    <div class="col-lg-4">
        <div class="row mt-2">

            <div class="col parent-link">
                <a href="{{url('')}}/administrator/verifikasi_crowd_c1"
                    class="btn text-white w-100 py-3 {{ (url()->current() == url('').'/administrator/verifikasi_crowd_c1')?'active' : '' }}">Verifikasi
                    Crowd C1</a>
            </div>
            <div class="col parent-link">
                <a href="{{url('')}}/administrator/crowd_c1_terverifikasi"
                    class="btn text-white w-100 py-3 {{ (url()->current() == url('').'/administrator/crowd_c1_terverifikasi')?'active' : '' }}">Crowd C1
                    Terverifikasi</a>
            </div>

        </div>
    </div>
</div>
<!-- PAGE-HEADER END -->

<div class="row">
    <div class="col-md">
        <h4 class="fw-bold fs-4 mt-5 mb-0">
            Jumlah Pendaftaran Crowd C1 : {{$jumlah_saksi}}
        </h4>
    </div>
    <div class="col-md-auto mt-auto">
        <div class="ms-auto">
            <div class="btn btn-success my-auto">
                <i class="fa-solid fa-download"></i>
                Unduh
            </div>
        </div>
    </div>
</div>
<hr style="border: 1px solid">
<div class="row mt-3">


    <livewire:verifikasi-crowd-c1>


</div>
<!-- CONTAINER END -->
<div class="modal fade" id="cekmodal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-header bg-primary text-white">
            <div class="modal-title mx-auto">
                <h4 class="mb-0 fw-bold">Verifikasi Crowd C1</h4>
            </div>
        </div>
        <div class="modal-content">
            <div class="container">
                <div id="container-verifikasi">

                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



@endsection