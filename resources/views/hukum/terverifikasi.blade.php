@extends('layouts.main-hukum')

@section('content')
<!-- PAGE-HEADER -->

<div class="row mt-3">
    <div class="col-lg-4">
        <h1 class="page-title fs-1 mt-2">Dashboard Rekapitung
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Validator Kecurangan
                <!-- Kota -->
            </li>
        </ol>
        <h4 class="fs-4 mt-2 fw-bold">Validator Kecurangan (2)</h4>
    </div>
    <div class="col-lg-8 mt-2">
        <div class="row">
            <div class="col-lg-4 justify-content-end">
                <div class="card">
                    <div class="card-header bg-secondary">
                        <div class="card-title text-white">Total Kecurangan Masuk</div>
                    </div>
                    <div class="card-body">
                        <p class="">{{ count($data_masuk) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-success">
                        <div class="card-title text-white">Total Kecurangan Terverifikasi</div>
                    </div>
                    <div class="card-body">
                        <p class="">{{ count($terverifikasi) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="card-title text-white">Total Kecurangan Ditolak</div>
                    </div>
                    <div class="card-body">
                        <p class="">{{ count($ditolak) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PAGE-HEADER END -->
<hr style="border: 1px solid;">

<div class="row" style="margin-top: 30px;">

    @foreach($list_suara as $ls)
    <div class="col-md-6 col-xl-4">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="card-title text-white">ARSIP LAPORAN KECURANGAN SAKSI</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md">
                        @if ($ls->profile_photo_path == NULL)
                        <img class="" style="width: 250px;"
                            src="https://ui-avatars.com/api/?name={{ $ls->name }}&color=7F9CF5&background=EBF4FF"
                            alt="img">
                        @else
                        <img class="" style="width: 250px;"
                            src="{{url("/storage/profile-photos/".$ls->profile_photo_path) }}">
                        @endif
                    </div>
                    <div class="col-md">
                        <div class="row mb-2">
                            <div class="col-md-4 fw-bold">NIK</div>
                            <div class="col-md">{{$ls->nik}}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 fw-bold">Nama</div>
                            <div class="col-md">{{$ls->name}}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 fw-bold">No Wa</div>
                            <div class="col-md">{{$ls->no_hp}}</div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4 fw-bold">Date</div>
                            <div class="col-md">{{$ls->date}}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md fw-bold">
                                <a href="fotomasalah"
                                    class="btn btn-secondary w-90 fotoKecuranganterverifikasi mt-2 rounded-0" id="Cek"
                                    data-bs-toggle="modal" id="" data-bs-target="#fotoKecuranganterverifikasi"
                                    data-id="{{$ls->tps_id}}">
                                    Arsip Kecurangan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection
