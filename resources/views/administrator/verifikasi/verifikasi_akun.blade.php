{{-- Verifikasi Saksi --}}
<?php

use App\Models\District;
use App\Models\Village;
use App\Models\TPS;

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

@extends('layouts.main-verifikasi-akun')


@section('content')
<!-- PAGE-HEADER -->
<div class="row mt-5">
    <div class="col-lg" style="position: fixed; z-index: 10; background: #f2f3f9">
        <h1 class="page-title fs-1 mt-2">Verifikasi Admin
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                {{ $kota->name }}
                <!-- Kota -->
            </li>
        </ol>
    </div>

    <div class="col-lg-4" style="position: fixed; right: 18px; width: 1244.66px; z-index: 10; background: #f2f3f9">
        <div class="row mt-2">
            <div class="col parent-link">
                <a href="{{url('')}}/administrator/verifikasi_akun" class="btn text-white w-100 py-3 {{ (url()->current() == url('').'/administrator/verifikasi_akun')?'active' : '' }}">Verifikasi Admin</a>
            </div>
            <div class="col parent-link">
                <a href="{{url('')}}/administrator/admin_terverifikasi" class="btn text-white w-100 py-3 {{ (url()->current() == url('').'/administrator/admin_terverifikasi')?'active' : '' }}">Admin Terverifikasi</a>
            </div>

        </div>
    </div>
</div>
<!-- PAGE-HEADER END -->

<div style="position: fixed; width: 97%; margin-top: 76px; z-index: 10; background: #f2f3f9">
    <div class="row">
        <div class="col-md">
            <h4 class="fw-bold fs-4 mt-5 mb-0">
                Jumlah Admin : {{$jumlah_admin}}
            </h4>
        </div>
        <div class="col-md-auto mt-auto">
            <div class="ms-auto">
                <button style="width: 82.22px; height: 38px; margin-right: 3px;" class="btn btn-success my-auto">
                    <i class="fa-solid fa-download"></i>
                    Unduh
                </button>
            </div>
        </div>
    </div>
    <hr style="border: 1px solid; width: 1841px">
</div>
<div class="row mt-3">

    <livewire:verifikasi-akun>
    {{-- <div class="col-lg-9 col-md-12">
        <div class="card">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap border-bottom table-hover w-100" id="basic-datatable">
                        <p style="font-size: 15px;">*Anda dapat menyetujui stau memblokir akun saksi
                            yang tidak di kenal</p>
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Foto</th>
                                <th class="border-bottom-0">Nama</th>
                                <th class="border-bottom-0">Email</th>
                                <th class="border-bottom-0">Kecamatan</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admin_data as $admin)
                            <?php $kecamatan = District::where('id', $admin['districts'])->first(); ?>

                            <tr>
                                <td> @if ($admin['profile_photo_path'] == NULL)
                                    <img class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;" src="https://ui-avatars.com/api/?name={{ $admin['name'] }}&color=7F9CF5&background=EBF4FF">
                                    @else
                                    <img class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;" src="{{url("/storage/profile-photos/".$admin['profile_photo_path']) }}">
                                    @endif
                                </td>
                                <td>{{$admin['name']}}</td>
                                <td>{{$admin['email']}}</td>
                                <td>{{$kecamatan['name']}}</td>
                                <td>
                                    @if ($admin['is_active'] == 2)
                                    <span class="badge bg-danger  me-1 mb-1 mt-1">Belum Terverifikasi</span>
                                    @else
                                    <span class="badge bg-success  me-1 mb-1 mt-1">Terverifikasi</span>
                                    @endif

                                </td>
                                <td>
                                    <a href="cekmodalakun" class="btn btn-primary cekmodalakun" style="font-size: 0.8em;" id="Cek" data-id="{{$admin['id']}}" data-bs-toggle="modal" id="" data-bs-target="#cekmodalakun">Cek</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Status</h5>
            </div>
            <div class="card-body">
                <ul class="b">
                    <li>
                        <b class="text-success">Terverifikasi</b> adalah status admin yang terdaftar
                        sesuai dengan data yang di berikan oleh pasangan calon dengan 2 indikator
                        berupa kecocokan Nomor NIK dan email
                    </li>
                    <li>
                        <b class="text-warning">Pending</b> adalah status admin yang terdaftar
                        sesuai dengan data yang di berikan oleh pasangan calon tetapi hanya memiliki
                        1 kecocokan indikator berupa Nomor NIK atau email sehingga Admin Otentifikasi dapat
                        memverifikasi ulang admin tersebut melalui telepon atau WhatsApp
                    </li>
                    <li>
                        <b class="text-secondary">Tidak Terdaftar</b> adalah status admin yang tidak
                        terdaftar di dalam database admin pasangan calon dan tidak memiliki satupun
                        kecocokan indikator berupa NIK,Email dan Nomor HP
                    </li>
                    <li>
                        <b class="text-danger">Ditolak</b> adalah status admin tidak dikenal dan di
                        blokir oleh Admin Otentifikasi
                    </li>
                </ul>
            </div>
        </div>
    </div> --}}

</div>
<!-- CONTAINER END -->
<div style="background: #f2f3f9; position: fixed; width: 100%; height: 70px; top: 90px; left: 0; z-index: 8;"></div>
<div class="modal fade" id="cekmodalakun" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-header bg-primary text-white">
            <div class="modal-title mx-auto">
                <h4 class="mb-0 fw-bold">Detail Data Admin</h4>
            </div>
        </div>
        <div class="modal-content">
            <div class="container">
                <div id="container-akun"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection