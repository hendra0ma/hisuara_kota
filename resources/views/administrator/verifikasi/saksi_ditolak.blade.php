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
        <h1 class="page-title fs-1 mt-2">Saksi Ditolak
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                {{ $kota->name }}
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
                <a href="{{url('')}}/administrator/verifikasi_saksi" class="btn text-white w-100 py-3 {{ (url()->current() == url('').'/administrator/verifikasi_saksi')?'active' : '' }}">Verifikasi Saksi</a>
            </div>
            <div class="col parent-link">
                <a href="{{url('')}}/administrator/absensi" class="btn text-white w-100 py-3 {{ (url()->current() == url('').'/administrator/absensi')?'active' : '' }}">Saksi Teregristrasi</a>
            </div>
            <div class="col parent-link">
                <a href="{{url('')}}/administrator/absensi/hadir" class="btn text-white w-100 py-3 {{ (url()->current() == url('').'/administrator/absensi/hadir')?'active' : '' }}">Saksi Hadir</a>
            </div>
            <div class="col parent-link">
                <a href="{{url('')}}/administrator/absensi/tidak_hadir" class="btn text-white w-100 py-3 {{ (url()->current() == url('').'/administrator/absensi/tidak_hadir')?'active' : '' }}">Saksi Tidak Hadir</a>
            </div>
            <div class="col parent-link">
                <a href="{{url('')}}/administrator/saksi_ditolak" class="btn text-white w-100 py-3 {{ (url()->current() == url('').'/administrator/saksi_ditolak')?'active' : '' }}">Saksi Ditolak</a>
            </div>

        </div>
    </div>
</div>
<!-- PAGE-HEADER END -->

<h4 class="fw-bold fs-4 mt-5 mb-0">
    Jumlah Saksi Ditolak : {{$jumlah_saksi_ditolak}}
</h4>
<hr style="border: 1px solid">

<div class="row mt-3">

    <livewire:saksi-ditolak>

    {{-- <div class="col-lg-12 col-md-12">
        <div class="card">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap border-bottom table-hover w-100" id="basic-datatable">
                        <p style="font-size: 15px;">*Anda dapat
                            menyetujui atau memblokir akun saksi
                            yang tidak di kenal</p>
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Foto</th>
                                <th class="border-bottom-0">Nama</th>
                                <th class="border-bottom-0">NIK</th>
                                <th class="border-bottom-0">No. Hp</th>
                                <th class="border-bottom-0">Email</th>
                                <th class="border-bottom-0">Kecamatan</th>
                                <th class="border-bottom-0">Kelurahan</th>
                                <th class="border-bottom-0">TPS</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($saksi_data as $saksi)
                            <?php $kecamatan = \App\Models\District::where('id',(string)$saksi['districts'])->first(); ?>
                            <?php $kelurahan = \App\Models\Village::where('id',(string)3674040006)->first(); ?>
                            <?php $tps = \App\Models\Tps::where('user_id',$saksi['id'])->first(); ?>
                            <tr>
                                <td>  @if ($saksi['profile_photo_path'] == NULL)
                                    <img class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;" src="https://ui-avatars.com/api/?name={{ $saksi['name'] }}&color=7F9CF5&background=EBF4FF">
                                    @else
                                    <img class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;" src="{{url("/storage/profile-photos/".$saksi['profile_photo_path']) }}">
                                    @endif
                               </td>
                                <td>{{$saksi['name']}}  &nbsp;@if ($saksi['role_id'] == 8)
                                    <i class="fa fa-check-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="fa fa-check-circle" aria-label="fa fa-check-circle"></i>
                                    @else

                                @endif</td>
                                <td>{{$saksi['nik']}}</td>
                                <td>{{$saksi['no_hp']}}</td>
                                <td>{{$saksi['email']}}</td>
                                <td>{{$kecamatan['name'] }}</td>
                                <td>{{$kelurahan['name'] }}</td>
                                <td><?php if($tps == null){?> <?php }else{ ?> {{$tps['number']}}<?php } ?></td>
                                <td>
                                    @if ($saksi['is_active'] == 2)
                                    <span class="badge bg-danger  me-1 mb-1 mt-1">Belum Terverifikasi</span>
                                    @else
                                    <span class="badge bg-success  me-1 mb-1 mt-1">Terverifikasi</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="cekmodal" class="btn btn-primary cekmodal" style="font-size: 0.8em;" id="Cek" data-id="{{$saksi['id']}}"
                                        data-bs-toggle="modal" id="" data-bs-target="#cekmodal">Cek</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}
    
</div>




@endsection
