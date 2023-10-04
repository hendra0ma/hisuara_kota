@extends('layouts.main-verifikasi-akun')

@section('content')

{{-- Verifikasi Saksi --}}
<?php
use App\Models\District;
use App\Models\Village;
use App\Models\Tps;
?>

<!-- PAGE-HEADER -->
<div class="row mt-5">
    <div class="col-lg">
        <h1 class="page-title fs-1 mt-2">Dashboard Rekapitung
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Verifikasi Saksi
                <!-- Kota -->
            </li>
        </ol>
        <h4 class="fs-4 mt-2 fw-bold">Verifikasi Saksi</h4> <!-- This Dummy Data -->
    </div>
</div>
<!-- PAGE-HEADER END -->


<div class="row mt-3">

    <div class="col-lg-9 col-md-12">
        <div class="card">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap border-bottom table-hover w-100" id="basic-datatable">
                        <p style="font-size: 10px;">*Anda Dapat
                            Menyetujui Atau MemBlokir Akun Saksi
                            Yang Tidak Di Kenal</p>
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Foto</th>
                                <th class="border-bottom-0">Nama</th>
                                <th class="border-bottom-0">NIK</th>
                                <th class="border-bottom-0">Kecamatan</th>
                                <th class="border-bottom-0">Kelurahan</th>
                                <th class="border-bottom-0">TPS</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($saksi_data as $saksi)
                            <?php $kecamatan = District::where('id',(string)$saksi['districts'])->first(); ?>
                            <?php $kelurahan = Village::where('id',(string)3674040006)->first(); ?>
                            <?php $tps = Tps::where('user_id',$saksi['id'])->first(); ?>
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
    </div>

    <div class="col-lg-3 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Status</h5>
            </div>
            <div class="card-body">
                <ul class="b">
                    <li>
                        <b class="text-success">Terverifikasi</b> adalah status saksi yang
                        terdaftar sesuai dengan data yang di berikan oleh pasangan calon dengan 2
                        indikator berupa kecocokan Nomor NIK dan email
                    </li>
                    <li>
                        <b class="text-warning">Pending</b> adalah status saksi yang terdaftar
                        sesuai dengan data yang di berikan oleh pasangan calon tetapi hanya memiliki
                        1 kecocokan indikator berupa Nomor NIK atau email sehingga admin Huver dapat
                        memverifikasi ulang saksi tersebut melalui telepon atau WhatsApp
                    </li>
                    <li>
                        <b class="text-secondary">Tidak Terdaftar</b> adalah status saksi yang tidak
                        terdaftar di dalam database saksi pasangan calon dan tidak memiliki satupun
                        kecocokan indikator berupa NIK,Email dan Nomor HP
                    </li>
                    <li>
                        <b class="text-danger">Ditolak</b> adalah status saksi tidak dikenal dan di
                        blokir oleh admin Hover
                    </li>
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Import Database Saksi</h5>
            </div>
            <div class="card-body">
                <input type="file" class="form-control" id="exampleInputname" placeholder="Import Data">
            </div>
        </div>
    </div>

 </div>
</div>
<!-- CONTAINER END -->
<div class="modal fade" id="cekmodal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Verifikasi Saksi</div>
            </div>
            <div class="container" >
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
