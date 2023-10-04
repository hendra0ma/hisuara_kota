@extends('layouts.main-balwaslu')

@section('content')
<!-- PAGE-HEADER -->

<div class="row mt-3">
    <div class="col-lg-4">
        <h1 class="page-title fs-1 mt-2">Dashboard
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Administrator 1
                <!-- Kota -->
            </li>
        </ol>
    </div>
    <div class="col-lg-8 mt-2">
        <div class="row">
            <div class="col-lg-4 justify-content-end">
                <div class="card">
                    <div class="card-header bg-secondary">
                        <div class="card-title">Data Masuk</div>
                    </div>
                    <div class="card-body">
                        <p class="">{{ count($data_masuk) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-success">
                        <div class="card-title">Data Terverifikasi</div>
                    </div>
                    <div class="card-body">
                        <p class="">{{ count($terverifikasi) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="card-title">Data Ditolak</div>
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

<div class="row">
   
    @foreach($list_suara as $ls)
    <div class="col-md-6 col-xl-3">
        <div class="card item-card" style="height: 450px">
            <div class="ribbone z-index2">
                <div class="ribbon"><span>verified</span></div>
            </div>
            <div class="product-grid6 card-body">
                <div class="product-image6">
                    @if ($ls->profile_photo_path == NULL)
                    <img class="img-fluid" style="width: 300px;"
                        src="https://ui-avatars.com/api/?name={{ $ls->name }}&color=7F9CF5&background=EBF4FF" alt="img">
                    @else
                    <img class="rounded-circle" style="width: 300px;"
                        src="{{url("/storage/profile-photos/".$ls->profile_photo_path) }}">
                    @endif

                </div>
                <div class="product-content text-center">

                    <h4 class="mb-3 fw-bold"><a href="#">TPS {{$ls->number}}</a></h4>
                    <div class="alert alert-primary">
                        <strong>Data Masuk</strong>
                    </div>
                    
                </div>
                <ul class="icons z-index3" style="background: rgb(0,0,0); background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.65) 15%, rgba(0,0,0,0.75) 25%, rgba(0,0,0,1) 100%);
                        height: 100%; transform: translateY(115px);">
                    <div class="container">
                        <div class="row mb-3 mt-8">
                            <div class="col-md-12">NIK :</div>
                            <div class="col-md">{{$ls->nik}}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">Nama :</div>
                            <div class="col-md">{{$ls->name}}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">No Wa :</div>
                            <div class="col-md">{{$ls->no_hp}}</div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12">Date :</div>
                            <div class="col-md">{{$ls->date}}</div>
                        </div>
                        <a href="fotomasalah" class="btn btn-secondary w-90 fotoKecuranganterverifikasi mt-2 rounded-0" id="Cek"
                            data-bs-toggle="modal" id="" data-bs-target="#fotoKecuranganterverifikasi" data-id="{{$ls->tps_id}}">
                            List Kecurangan</a>
                    </div>
                </ul>
            </div>
        </div>
    </div>
    @endforeach

</div>

@endsection
