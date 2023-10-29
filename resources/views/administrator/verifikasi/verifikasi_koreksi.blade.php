{{-- Verifikasi Saksi --}}
<?php
use App\Models\District;
use App\Models\Village;
use App\Models\TPS;
use App\Models\User;
use App\Models\Koreksi;

use App\Models\Regency;
use App\Models\Config;

$data['config'] = Config::first();
$config = Config::first();
$kota = Regency::where('id', $config['regencies_id'])->first();
?>
@extends('layouts.main-verifikasi-akun')


@section('content')

<!-- PAGE-HEADER -->
<div class="row mt-5">
    <div class="col-lg-4">
        <h1 class="page-title fs-1 mt-2">Koreksi C1
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">{{ $kota->name }}
                <!-- Kota -->
            </li>
        </ol> <!-- This Dummy Data -->
    </div>
    <div class="col-md">
        <div class="row">
            <div class="col-12 mb-2">
                <div class="row">
                    <div class="col parent-link">
                        <a class="btn text-white w-100 py-3 c1koreksi tablink" onclick="openPage('C1-Koreksi', this, '#6259ca')"  id="defaultOpen">C1 Koreksi (Verifikator)</a>
                    </div>
                    <div class="col parent-link">
                        <a class="btn text-white w-100 py-3 c1teraudit tablink" onclick="openPage('C1-Dibatalkan', this, '#6259ca')">C1 Dibatalkan (Auditor)</a>
                    </div>
                </div>
            </div>
            
            {{-- <div class="col-md-12 text-white mt-3">
                <div class="row">
                    <div class="col py-2 judul text-center bg-secondary text-white"
                        style="border-top-left-radius: 25px; border-bottom-left-radius: 25px">
                        <div class="text">Total TPS : <b>{{ $total_tps }}</b></div>
                    </div>
                    <div class="col py-2 judul text-center bg-danger text-white">
                        <div class="text">TPS Masuk : <b>{{ $jumlah_tps_masuk }}</b></div>
                    </div>
                    <div class="col py-2 judul text-center bg-primary text-white">
                        <div class="text">TPS Kosong : <b>{{ $jumlah_kosong }}</b></div>
                    </div>
                    <div class="col py-2 judul text-center bg-success text-white"
                        style="border-top-right-radius: 25px; border-bottom-right-radius: 25px">
                        <div class="text">TPS Terverifikasi : <b>{{$jumlah_tps_terverifikai}}</b></div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

    <script>
        function openPage(pageName, elmnt, color) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].style.backgroundColor = "";
                // Remove the "active-tab" class from all tab links
                tablinks[i].classList.remove("active-tab");
            }
            document.getElementById(pageName).style.display = "block";
            elmnt.style.backgroundColor = color;
            // Add the "active-tab" class to the selected tab link
            elmnt.classList.add("active-tab");
        }

        // Wrap this part in a DOMContentLoaded event listener
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("defaultOpen").click();
        });
    </script>

    <style>
    /* Define a CSS class for the active tab text */
        .active-tab {
            color: white;
        }

        .active-tab:hover {
            color: white;
        }
    </style>
    {{-- <div class="col-lg-8">
        <div class="row">
            <div class="col">
                <div class="card mb-3 bg-light text-dark">
                    <div class="card-header py-3 bg-secondary text-white">
                        <div> Total TPS </div>
                    </div>
                    <div class="card-body py-3" style="font-size:15px;font-weight:bolder">
                        <div class="row no-gutters">
                            <div class="col-12">
                                {{$total_tps}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-3 bg-light text-dark">
                    <div class="card-header py-3 bg-danger text-white">
                        <div> TPS Masuk </div>
                    </div>
                    <div class="card-body py-3" style="font-size:15px;font-weight:bolder">
                        <div class="row no-gutters">
                            <div class="col-12">
                                {{$jumlah_tps_masuk}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-3 bg-light text-dark">
                    <div class="card-header py-3 bg-success text-white">
                        <div> TPS Terverifikasi </div>
                    </div>
                    <div class="card-body py-3" style="font-size:15px;font-weight:bolder">
                        <div class="row no-gutters">
                            <div class="col-12">
                                {{$jumlah_tps_terverifikai}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div> --}}

</div>
<!-- PAGE-HEADER END -->

<!-- PAGE-HEADER END -->

<style>
    .inner-card {
        border-radius: 10px;
        background-color: #cbd7ff;
        box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5) inset;
        -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5) inset;
        -moz-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5) inset;
    }
</style>

<div id="C1-Koreksi" class="tabcontent mt-0 px-0">
    <livewire:verifikasi-koreksi>
</div>
<div id="C1-Dibatalkan" class="tabcontent mt-0 px-0">
    <livewire:c1-dibatalkan />
</div>

{{-- <div class="row mt-3">
    <div class="col-lg-9 col-md-12">
        <div class="card">
            
            <div class="card-body">
                <div class="table-responsive export-table">
                    <table id="file-datatable"
                        class="table table-bordered text-nowrap key-buttons border-bottom  w-100">
                        <p style="font-size: 15px;">*Anda dapat menyetujui atau memblokir akun saksi
                            yang tidak di kenal</p>

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
                            <?php $koreksi_by = Koreksi::where('user_id',(string)$item['id'])->first(); ?>
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
                        oleh Admin Otentifikasi
                    </li>
                    <li>
                        <b class="text-warning">Pending</b> adalah status koreksi yang masih di
                        proses oleh Admin Otentifikasi
                    </li>
                    <li>
                        <b class="text-danger">Ditolak</b> adalah status saksi tidak dikenal
                        dan di
                        blokir oleh Admin Otentifikasi
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div> --}}

<div class="modal fade" id="disetujuimodal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-header bg-primary text-white">
            <div class="modal-title mx-auto">
                <h4 class="mb-0 fw-bold">Otentifikasi Koreksi</h4>
            </div>
        </div>
        <div class="modal-content">
            <div class="container" id="container-koreksi">
            </div>
            
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@endsection
