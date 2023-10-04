{{-- Verifikasi Saksi --}}
<?php
use App\Models\District;
use App\Models\Village;
use App\Models\TPS;
use App\Models\User;
use App\Models\Koreksi;
?>
@extends('layouts.main-verifikasi-akun')


@section('content')

<!-- PAGE-HEADER -->
<div class="row mt-5">
    <div class="col-lg">
        <h1 class="page-title fs-1 mt-2">Dashboard Rekapitung
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Verifikasi Koreksi
                <!-- Kota -->
            </li>
        </ol>
        <h4 class="fs-4 mt-2 fw-bold">Verifikasi Koreksi</h4> <!-- This Dummy Data -->
    </div>
</div>
<!-- PAGE-HEADER END -->

<!-- PAGE-HEADER END -->
<div class="row mt-3">
    <div class="col-lg-9 col-md-12">
        <div class="card">
            
            <div class="card-body">
                <div class="table-responsive export-table">
                    <table id="file-datatable"
                        class="table table-bordered text-nowrap key-buttons border-bottom  w-100">
                        <p style="font-size: 10px;">*Anda Dapat Menyetujui Atau MemBlokir Akun Saksi
                            Yang Tidak Di Kenal</p>

                        <thead>
                            <tr>
                                <th class="border-bottom-0">Nama Saksi</th>
                                <th class="border-bottom-0">Nama Admin (By Request)</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Keterangan</th>
                                <th class="border-bottom-0">Tanggal</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($saksi_data as $item)
                            <?php $request_by = User::where('id',$item['kecurangan_id_users'])->first(); ?>
                            <?php $koreksi_by = Koreksi::where('user_id',$item['id'])->first(); ?>
                            <tr>
                                <td>{{$item['name']}}</td>
                                <td>{{$request_by['name']}}</td>
                                <td>
                                    @if ($koreksi_by['status'] == "menunggu")
                                    <span class="badge bg-danger  me-1 mb-1 mt-1">Menunggu
                                    </span>
                                    @endif

                                    @if ($koreksi_by['status'] == "ditolak")
                                    <span class="badge bg-danger  me-1 mb-1 mt-1">Ditolak
                                    </span>
                                    @endif

                                    @if ($koreksi_by['status'] == "selesai")
                                    <span class="badge bg-success  me-1 mb-1 mt-1">Selesai
                                    </span>
                                    @endif
                                </td>
                                <td>{{$koreksi_by['keterangan']}}</td>
                                <td>{{$koreksi_by['created_at']}}</td>
                                <td>
                                    <a href="disetujuimodal" class="btn btn-primary disetujuimodal"
                                        style="font-size: 0.8em;" id="Cek" data-id="{{$koreksi_by['saksi_id']}}"
                                        data-bs-toggle="modal" id="" data-bs-target="#disetujuimodal">Cek</a>
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
                        <b class="text-success">Disetujui</b> adalah status koreksi yang Disetujui
                        oleh admin Hover
                    </li>
                    <li>
                        <b class="text-warning">Pending</b> adalah status koreksi yang masih di
                        proses oleh admin Hover
                    </li>
                    <li>
                        <b class="text-danger">Ditolak</b> adalah status saksi tidak dikenal
                        dan di
                        blokir oleh admin Hover
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="disetujuimodal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">&nbsp;</div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Admin Request</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    <div class="media">
                                        <img class="rounded-circle"
                                            style="width: 70px; height: 70px; object-fit: cover; margin-right: 10px;"
                                            src="https://firanda.com/wp-content/uploads/2021/03/08.-Pas-Foto-Bg-Merah.jpg">
                                        <div class="media-body">
                                            <h5 class="mt-0">Isa Ardiansyah</h5>
                                            NIK : 0896883746236
                                        </div>
                                    </div>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Saksi</h5>
                            </div>
                            <div class="card-body  text-center">
                                <p class="card-text">
                                    <div class="row fw-bolder">
                                        <div class="col">Bahuwirya Gilang Tampubolon S.I.Kom</div>
                                        <div class="col">TPS 10</div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col">NIK : 1234567890123</div>
                                        <div class="col">Ciputat/Ciputat</div>
                                    </div>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md mb-3"><img
                            src="https://paslon1.tangsel.pilwalkot.rekapitung.id/assets/upload/c1plano18.jpg">
                    </div>
                    <div class="col-md">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Data Lama</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">
                                            <form action="">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="suara01">Suara 01</label>
                                                        <input type="text" id="suara01" class="form-control" value="95"
                                                            disabled>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="suara02">Suara 02</label>
                                                        <input type="text" id="suara02" class="form-control" value="46"
                                                            disabled>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="suara03">Suara 03</label>
                                                        <input type="text" id="suara03" class="form-control" value="85"
                                                            disabled>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="suara04">Suara 04</label>
                                                        <input type="text" id="suara04" class="form-control" value="226"
                                                            disabled>
                                                    </div>
                                                </div>
                                            </form>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Pengajuan Data Baru</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">
                                            <form action="">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="suara01">Suara 01</label>
                                                        <input type="text" id="suara01" class="form-control" value="95"
                                                            disabled>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="suara02">Suara 02</label>
                                                        <input type="text" id="suara02" class="form-control" value="46"
                                                            disabled>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="suara03">Suara 03</label>
                                                        <input type="text" id="suara03" class="form-control" value="85"
                                                            disabled>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="suara04">Suara 04</label>
                                                        <input type="text" id="suara04" class="form-control" value="226"
                                                            disabled>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="keterangan">Keterangan</label>
                                                        <textarea class="form-control" id="keterangan" cols="30"
                                                            rows="10" disabled>nomer 3 salah input</textarea>
                                                    </div>
                                                </div>
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn bg-success text-light w-100">Selesai</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection
