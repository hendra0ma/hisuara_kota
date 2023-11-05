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
$config = Config::first();
$kota = Regency::where('id', $config['regencies_id'])->first();
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