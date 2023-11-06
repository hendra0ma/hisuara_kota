@extends('layouts.mainAbsen')
@section('content')

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

<div class="row mt-5">
    <div class="col-lg-4">
        <h1 class="page-title fs-1 mt-2">Enumerator Tidak Hadir
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">{{ $kota->name }}
                <!-- Kota -->
            </li>
        </ol>
    </div>

    <div class="col-lg-8">
        <div class="row mt-2">

            {{-- <div class="col parent-link">
                <a href="{{url('')}}/administrator/verifikasi_saksi" class="btn text-white w-100 py-3">Verifikasi Saksi</a>
            </div>
            <div class="col parent-link">
                <a href="{{url('')}}/administrator/absensi" class="btn text-white w-100 py-3">Saksi Teregristrasi</a>
            </div>
            <div class="col parent-link">
                <a href="{{url('')}}/administrator/absensi/hadir" class="btn text-white w-100 py-3">Saksi Hadir</a>
            </div>
            <div class="col parent-link">
                <a href="{{url('')}}/administrator/absensi/tidak_hadir" class="btn text-white w-100 py-3">Saksi Tidak Hadir</a>
            </div> --}}
            <div class="col parent-link">
                <a href="{{url('')}}/administrator/enumerator" class="btn text-white w-100 py-3 {{ (url()->current() == url('').'/administrator/enumerator')?'active' : '' }}">Enumerator</a>
            </div>
            <div class="col parent-link">
                <a href="{{url('')}}/administrator/enumerator_teregistrasi" class="btn text-white w-100 py-3 {{ (url()->current() == url('').'/administrator/enumerator_teregistrasi')?'active' : '' }}">Enumerator Teregistrasi</a>
            </div>
            <div class="col parent-link">
                <a href="{{url('')}}/administrator/enumerator_hadir" class="btn text-white w-100 py-3 {{ (url()->current() == url('').'/administrator/enumerator_hadir')?'active' : '' }}">Enumerator Hadir</a>
            </div>
            <div class="col parent-link">
                <a href="{{url('')}}/administrator/enumerator_tidak_hadir" class="btn text-white w-100 py-3 {{ (url()->current() == url('').'/administrator/enumerator_tidak_hadir')?'active' : '' }}">Enumerator Tidak Hadir</a>
            </div>
            <div class="col parent-link">
                <a href="{{url('')}}/administrator/enumerator_ditolak" class="btn text-white w-100 py-3 {{ (url()->current() == url('').'/administrator/enumerator_ditolak')?'active' : '' }}">Enumerator Ditolak</a>
            </div>

        </div>
    </div>
    {{-- <div class="col-lg-8 mt-2">
        <div class="row">
            <div class="col-lg-4 justify-content-end">
                <div class="card">
                    <div class="card-header bg-secondary">
                        <div class="card-title text-white">Total Saksi Terdaftar</div>
                    </div>
                    <div class="card-body">
                        <p class="">{{$user}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-success">
                        <div class="card-title text-white">Total Saksi Hadir</div>
                    </div>
                    <div class="card-body">
                        <p class="">{{count($absen2)}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="card-title text-white">Total Saksi Absen</div>
                    </div>
                    <div class="card-body">
                        <p class="">{{$user - count($absen2)}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>

<style>
    .tooltip-inner {
        background-color: rgb(248, 38, 73);
        box-shadow: 0px 0px 4px black;
        opacity: 1 !important;
    }
    .tooltip.bs-tooltip-right .tooltip-arrow::before {
        border-right-color: rgb(248, 38, 73) !important;
    }
    .tooltip.bs-tooltip-left .tooltip-arrow::before {
        border-left-color: rgb(248, 38, 73) !important;
    }
    .tooltip.bs-tooltip-bottom .tooltip-arrow::before {
        border-bottom-color: rgb(248, 38, 73) !important;
    }
    .tooltip.bs-tooltip-top .tooltip-arrow::before {
        border-top-color: rgb(248, 38, 73) !important;
    }
</style>

<div class="row">
    <div class="col-md">
        <h4 class="fw-bold fs-4 mt-5 mb-0">
            Jumlah Enumerator Belum Hadir : {{$jumlah_tidak_hadir}}
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

<livewire:enumerator-tidak-hadir>

{{-- <div class="row mt-5">
    <div class="col-md">

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover w-100" id="basic-datatable">
                        <thead class="bg-primary">
                            <tr>
                                <th class="text-white text-center align-middle">Foto</th>
                                <th class="text-white text-center align-middle">Nama</th>
                                <th class="text-white text-center align-middle">Kecamatan</th>
                                <th class="text-white text-center align-middle">Kecamatan</th>
                                <th class="text-white text-center align-middle">Kelurahan</th>
                                <th class="text-white text-center align-middle">TPS</th>
                                <th class="text-white text-center align-middle">Jam Absen</th>
                                <th class="text-white text-center align-middle">Email</th>
                          
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($absen as $item)
                            <?php $district = App\Models\District::where('id',$item['districts'])->first(); ?>
                            <?php $villages = App\Models\Village::where('id',$item['villages'])->first(); ?>
                            <?php $tps = App\Models\Tps::where('id',$item['tps_id'])->first(); ?>
                            <tr>
                                <td class="text-center"> @if ($item['profile_photo_path'] == NULL)
                                    <img class="rounded-circle" style="width: 75px; height: 75px; object-fit: cover; margin-right: 10px;" src="https://ui-avatars.com/api/?name={{ $item['name'] }}&color=7F9CF5&background=EBF4FF">
                                    @else
                                    <img class="rounded-circle" style="width: 75px; height: 75px; object-fit: cover; margin-right: 10px;" src="{{url("/storage/profile-photos/".$item['profile_photo_path']) }}">
                                    @endif
                                </td>
                                <td class="align-middle">{{$item['name']}}</td>
                                <td class="align-middle">{{$district['name']}}</td>
                                <td class="align-middle">{{$villages['name']}}</td>
                                <td class="align-middle">{{$tps['number']}}</td>
                                <td class="align-middle">{{$item['created_at']}}</td>
                                <td class="align-middle">{{$item['email']}}</td>
               
                             
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div> --}}

<script>
    $(document).ready(function() {
        var specificUrl = "{{ url('') }}/administrator/enumerator"; // Specific URL to match
    
        $('.glowy-menu[href="' + specificUrl + '"]').addClass('active');
    });
</script>

@endsection