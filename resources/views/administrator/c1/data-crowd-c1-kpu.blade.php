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
use App\Models\Configs;

$config = Config::first();



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
        <!-- <div class="alert alert-danger" role="alert">
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
        </div> -->
    </div>
</div>

<div class="row">
    <div class="col">
        <h4 class="fw-bold fs-4 mt-5 mb-0">
            Jumlah Data Crowd C1 KPU : {{$jumlah_c1}}
        </h4>

    </div>
    <div class="col-auto mt-auto">
        <a class="btn btn-success"href="{{url('')}}/administrator/download-images/1">
            <i class="fa-solid fa-download"></i>
            Unduh
        </a>
    </div>
</div>

<hr style="border: 1px solid">


<!-- :wilayah_id="$id_wilayah" :tipe_wilayah="$tipe_wilayah" -->


<livewire:data-crowd-c1-kpu />


    <!-- Modal -->
    <div class="modal fade" id="verify-crowd-c1" tabindex="-1" aria-labelledby="verify-crowd-c1Label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verify-crowd-c1Label"><img style="height: 50px;" class="mb-3 me-3"
                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/46/KPU_Logo.svg/531px-KPU_Logo.svg.png" alt="">
                        Verifikasi Crowd C1 KPU</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"id="modal-crowd">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
                </div>
            </div>
        </div>
    </div>



    <script>
        let ajaxCrowdC1 = function (id) {
            $.ajax({
                url:"{{url('')}}/administrator/get-data-c1-crowd",
                data:{
                    id,
                },
                type:"get",
                success:function(res){
                    $('#modal-crowd').html(res)
                }
            })
        }
    </script>

@endsection