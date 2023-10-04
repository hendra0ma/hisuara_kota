@extends('layouts.main-bantuan')
@section('content')

<div class="row mt-3">
    <div class="col-lg-4">
        <h1 class="page-title fs-1 mt-2">Tentang
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tentang
                <!-- Kota -->
            </li>
        </ol>
    </div>
</div>

<div class="row mt-5">
    <div class="col-lg-6 col-md-12">
        <div class="card">
            <div class="card-header">
                <img style="width: 100px;" src="../../assets/images/brand/logo.png" alt="" srcset="">
                <h1 class="card-title fs-1 ms-5">Rekapitung</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <span class="fa fa-check-circle fa-2x text-success"></span>
                            </div>
                            <div class="flex-grow-1 ms-5">
                                <h4 class="mt-0 fw-bold">Ini adalah Rekapitung versi terbaru</h4>
                                <p>Versi 1.0 (Ultimate) (64 bit)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md">
                        <a href="pusat_bantuan" class="fw-bold fs-4 text-muted">Dapatkan Bantuan Rekapitung
                            <span class="fa fa-external-link ms-3"></span>
                        </a> 
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md">
                        <a href="laporan" class="fw-bold fs-4 text-muted">Laporkan Masalah
                            <span class="fa fa-external-link ms-3"></span>
                        </a> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-12">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title fw-bold">Rekapitung</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md">
                        <p class="mt-0">Hak cipta 2024 Rekapitung. Semua hak dilindungi undang-undang.</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md">
                        <b href="pusat_bantuan" class="fw-bold">PT. Mahadaya Swara Teknologi.</b> 
                        <br>
                        <br>
                        <a href="pusat_bantuan" class="fw-bold">Persyaratan Layanan</a> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
