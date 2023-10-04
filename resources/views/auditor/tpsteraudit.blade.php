@extends('layouts/mainLayoutAuditor');

@section('content')
<div class="row mt-4">
    <div class="col-lg-6 justify-content-center mb-3">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
        </div>
        @endif
        <div class="row">
            <div class="col-md-3" id="logo-col3" style="display: none;">

            </div>
            <div class="col-md-12" id="title-col8">
                <center>
                    <h2 class="text-uppercase text-size-custom">Dashboard <br>{{ $regency->name }}</h2>
                    <h5 class="mt-4">
                        Auditor
                    </h5>
                </center>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="row">
            <div class="col-6">
                <div class="card bg-light text-dark">
                    <div class="card-header text-center bg-secondary text-white">
                        <span> TPS Teraudit </span>
                    </div>
                    <div class="card-body text-center" style="font-size:15px;font-weight:bolder">
                        <div class="row no-gutters">
                            <div class="col-10">
                                {{ $jumlah_tps_teraudit }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card bg-light text-dark">
                    <div class="card-header text-center bg-success text-white">
                        <span> TPS Terverifikasi </span>
                    </div>
                    <div class="card-body text-center" style="font-size:15px;font-weight:bolder">
                        <div class="row no-gutters">
                            <div class="col-10">
                                {{ $jumlah_tps_terverifikasi }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

</div>


@foreach ($list_suara as $ls)
<div class="col-md-6 col-xl-4">
    <div class="card item-card">

        <div class="ribbon-success ribbon-top-right"><span class="bg-success">Teraudit</span></div>

        <div class=" product-grid6 card-body">
            <div class="product-image6">
                @if ($ls->profile_photo_path == NULL)
                <img class="img-fluid" style="width: 250px;" src="https://ui-avatars.com/api/?name={{ $ls->name }}&color=7F9CF5&background=EBF4FF" alt="img">
                @else
                <img class="img-fluid" style="width: 250px;" src="{{url("/storage/profile-photos/".$ls->profile_photo_path) }}">
                @endif
            </div>
            <div class="product-content text-center">
                <h4 class="fw-bold">Kecamatan {{ $district->name }}</h4>
                <h4 class="mb-3 fw-bold"><a href="#">TPS {{ $ls->number }}</a></h4>
                <h4 class="price">Data C1 Masuk</h4>
            </div>
            <ul class="icons z-index3" style="background: rgb(0,0,0); background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.65) 15%, rgba(0,0,0,0.75) 25%, rgba(0,0,0,1) 100%);
                                                height: 110%; transform: translateY(115px);">
                <div class="row mb-3 mt-8">
                    <div class="col-md-12">NIK :</div>
                    <div class="col-md">{{ $ls->nik }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">Nama :</div>
                    <div class="col-md">{{ $ls->name }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">No Wa :</div>
                    <div class="col-md">{{ $ls->no_hp }}</div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-12">Date :</div>
                    <div class="col-md">{{ $ls->date }}</div>
                </div>
                <button type="button" class="btn btn-primary w-75 mb-4 periksa-c1-plano" data-bs-toggle="modal" data-bs-target="#periksaC1Verifikator" data-id="{{ $ls->tps_id }}">
                    Periksa C1
                    Plano
                </button>

            </ul>
        </div>
    </div>
</div>
@endforeach
{{$list_suara->links()}}



<div class="modal fade" id="periksaC1Verifikator" tabindex="-1" aria-labelledby="periksaC1VerifikatorLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="periksaC1VerifikatorLabel">Data TPS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row" id="container-view-modal">

                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalPeriksa" tabindex="-1" aria-labelledby="modalPeriksaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPeriksaLabel">Persetujuan Koreksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <ul>
                        <li>Setiap perubahan data yang di lakukan wajib memerlukan izin dan persetujuan dari
                            administrator (Human Verifikasi)</li>
                        <li>Aktifitas perubahan data yang anda lakukan akan di tampilkan pada history publik yang dapat
                            di lihat oleh masyarakat
                            . Segala perbuatan yang melanggar hukum dengan merubah hasil perhitungan suara yang sah
                            dapat di kenakan Pasal 505 UU No.7 Tahun 2017</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer ajukanPerubahan">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="" class="btn btn-primary">Ajukan Perubahan</a>
            </div>
        </div>
    </div>
</div>


<!-- SWEET-ALERT JS -->
<script src="../../assets/plugins/sweet-alert/sweetalert.min.js"></script>
<script src="../../assets/js/sweet-alert.js"></script>
@endsection