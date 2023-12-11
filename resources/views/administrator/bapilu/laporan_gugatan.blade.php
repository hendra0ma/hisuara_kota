@include('layouts.partials.head')

@include('layouts.partials.sidebar-gugatan')
<?php
$solution = \App\Models\SolutionFraud::get();
?>
<!--/APP-SIDEBAR-->
@include('layouts.partials.header')


<div class="row mt-3">
    <div class="col-lg-4">
        <h1 class="page-title fs-1 mt-2">Dashboard Rekapitung
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gugatan Pemilu
                <!-- Kota -->
            </li>
        </ol>
        <h4 class="fs-4 mt-2 fw-bold">Akun Tim Hukum Paslon</h4>
    </div>

    <div class="col-lg-4 text-center">
        <h4><a class="header-brand1">
                <img src="{{url('/')}}/assets/images/brand/logo-1.png" style="width: 150px" class="img-fluid"
                    alt="logo">
            </a>
        </h4>
    </div>


</div>
<div class="row mt-3">
    <div class="col-md-12">
        <h2 class="fw-bold text-center mx-auto" style="margin-bottom: 5px;">Laporan Kecurangan dan Pelanggaran Pemilu
        </h2>
    </div>
    <div class="col-md-12">
        <h2 class="fw-bold text-center mx-auto">{{$config['jenis_pemilu']}} Tahun  {{$config['tahun']}}  {{$kota->name}}</h2>
    </div>
</div>

<hr>
<h2 class="fw-bold mb-0 tugel" data-bs-toggle="collapse" href="#collapse1" role="button" aria-expanded="false"
    aria-controls="multiCollapseExample1">
    <div class="row">
        <div class="col-6">
            Data 1
        </div>
        <div class="col-6 text-end">
            <i class="fa-solid fa-chevron-down"></i>
            <i class="fa-solid fa-chevron-right" style="display: none"></i>
        </div>
    </div>
</h2>
<hr>

<!-- PAGE-HEADER END -->
<div class="row mt-3 collapse multi-collapse show chevron-logic mx-auto container" id="collapse1">

    <h2 class="fw-bold">Index TSM Pemilu</h2>
    <div class="col-lg-12">
        <div class="row justify-content-center">
            <div class="col-lg-12 ">
                <div class="card">
                    <div class="card-header bg-danger">
                        <center>
                            <h4 class="mx-auto text-white mb-0 fw-bold">
                                PELANGGARAN ADMINISTRASI PEMILU
                            </h4>
                        </center>
                    </div>
                    <div class="card-body">

                        <center>
                            <div id="chart-pie"></div>
                        </center>
                        <table
                            class="w-100 table table-bordered text-nowrap border-bottom dataTable no-footer table-striped table-hover"
                            id="basic-datatable" role="grid" aria-describedby="basic-datatable_info">
                            <thead class="bg-primary">
                                <tr>
                                    <th class="text-white">No</th>
                                    <th class="text-white">Kode</th>
                                    <th class="text-white">Persentase</th>
                                    <th class="text-white">Kecurangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                @foreach ($index_tsm as $item)
                                <?php if ($item->jenis != 0) {
                                            continue;
                                        } ?>
                                <tr>
                                    <?php


                                            $totalKec =  App\Models\Bukti_deskripsi_curang::join('list_kecurangan', 'list_kecurangan.id', '=', 'bukti_deskripsi_curang.list_kecurangan_id')
                                                ->join('saksi', 'saksi.tps_id', '=', 'bukti_deskripsi_curang.tps_id')
                                                ->where('saksi.status_kecurangan', "terverifikasi")
                                                ->where('bukti_deskripsi_curang.list_kecurangan_id', $item->id)
                                                ->where('list_kecurangan.jenis', 0)
                                                ->count();
                                            $jumlahSaksi =        App\Models\Saksi::whereNull('pending')->count();
                                            $persen =($totalKec != 0) ?($totalKec/ $jumlahSaksi)*100 : 0;

                                            ?>

                                    <td>{{ $i++ }}</td>
                                    <td>{{$item->kode}}</td>
                                    <td>{{substr($persen,0,4)}}%</td>
                                    <td>{{ $item['kecurangan'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-lg-12">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-danger">
                        <center>
                            <h4 class="mx-auto text-white mb-0 fw-bold">
                                PELANGGARAN TINDAK PIDANA
                            </h4>
                        </center>
                    </div>
                    <div class="card-body">

                        <center>
                            <div id="chart-donut"></div>
                        </center>

                        <div class="table-responsive">
                            <table
                                class="table table-bordered text-nowrap border-bottom dataTable no-footer table-striped table-hover datable"
                                role="grid" id="responsive-datatable_info">
                                <thead class="bg-dark">
                                    <tr>
                                        <th class="text-white">No</th>
                                        <th class="text-white">Kode</th>
                                        <th class="text-white">Persentase</th>
                                        <th class="text-white">Kecurangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>
                                    @foreach ($index_tsm as $item)
                                    <?php if ($item->jenis != 1) {
                                              continue;
                                          } ?>
                                    <tr>
                                        <?php

                                              $totalKec =  App\Models\Bukti_deskripsi_curang::join('list_kecurangan', 'list_kecurangan.id', '=', 'bukti_deskripsi_curang.list_kecurangan_id')
                                                   ->join('saksi', 'saksi.tps_id', '=', 'bukti_deskripsi_curang.tps_id')
                                                   ->where('saksi.status_kecurangan', "terverifikasi")
                                                  ->where('bukti_deskripsi_curang.list_kecurangan_id', $item->id)
                                                  ->where('list_kecurangan.jenis', 1)
                                                  ->count();
                                             $jumlahSaksi =        App\Models\Saksi::whereNull('pending')->count();
                                              $persen =($totalKec != 0) ?($totalKec/ $jumlahSaksi)*100 : 0;
                                              ?>
                                        <td>{{ $i++ }}</td>
                                        <td>{{$item->kode}}</td>
                                        <td>{{substr($persen,0,4)}}%</td>
                                        <td>{{ $item['kecurangan'] }}</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-danger">
                        <center>
                            <h4 class="mx-auto text-white mb-0 fw-bold">
                                PELANGGARAN KODE ETIK
                            </h4>
                        </center>
                    </div>
                    <div class="card-body">

                        <center>
                            <div id="chart-donut-et"></div>
                        </center>

                        <div class="table-responsive">
                            <table
                                class="table table-bordered text-nowrap border-bottom dataTable no-footer table-striped table-hover datable"
                                role="grid" id="responsive-datatable_info">
                                <thead class="bg-dark">
                                    <tr>
                                        <th class="text-white">No</th>
                                        <th class="text-white">Kode</th>
                                        <th class="text-white">Persentase</th>
                                        <th class="text-white">Kecurangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>
                                    @foreach ($index_tsm as $item)
                                    <?php if ($item->jenis != 2) {
                                                continue;
                                            } ?>
                                    <tr>
                                        <?php

                                                $totalKec =  App\Models\Bukti_deskripsi_curang::join('list_kecurangan', 'list_kecurangan.id', '=', 'bukti_deskripsi_curang.list_kecurangan_id')
                                                     ->join('saksi', 'saksi.tps_id', '=', 'bukti_deskripsi_curang.tps_id')
                                                     ->where('saksi.status_kecurangan', "terverifikasi")
                                                    ->where('bukti_deskripsi_curang.list_kecurangan_id', $item->id)
                                                    ->where('list_kecurangan.jenis', 1)
                                                    ->count();
                                               $jumlahSaksi =        App\Models\Saksi::whereNull('pending')->count();
                                                $persen =($totalKec != 0) ?($totalKec/ $jumlahSaksi)*100 : 0;
                                                ?>
                                        <td>{{ $i++ }}</td>
                                        <td>{{$item->kode}}</td>
                                        <td>{{substr($persen,0,4)}}%</td>
                                        <td>{{ $item['kecurangan'] }}</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Keterangan Kode</div>
            </div>
            <div class="card-body">
                <table class="table table-bordered w-100">
                    <?php 
                  $kodeF = DB::table('solution_frauds')->get();
                  ?>
                    <tr>
                        @foreach($kodeF as $kod)
                        <td><b class="text-danger">{{$kod->kode}}</b> ({{$kod->solution}})</td>
                        @endforeach
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="row justify-content-end">
            <div class="col-4">
                <a href="{{url('')}}/administrator/print-index-tsm" target="_blank"
                    class="btn btn-block btn-dark ml-2 mr-2 w-100"> Print &nbsp;&nbsp;<i class="fa fa-print"></i></a>
            </div>

        </div>
    </div>

</div>

<hr>
<h2 class="fw-bold mb-0 tugel" data-bs-toggle="collapse" href="#collapse2" role="button" aria-expanded="false"
    aria-controls="multiCollapseExample2">
    <div class="row">
        <div class="col-6">
            Data 2
        </div>
        <div class="col-6 text-end">
            <i class="fa-solid fa-chevron-down" style="display: none"></i>
            <i class="fa-solid fa-chevron-right"></i>
        </div>
    </div>
</h2>
<hr>

<div class="row collapse multi-collapse chevron-logic" id="collapse2">
    <h2 class="fw-bold">
        Rekomendasi Tindakan
    </h2>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Rekomendasi</div>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($solution as $solut)
                    <?php $jmlh_kecurangan =  \App\Models\Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
                                                ->join('users', 'users.tps_id', '=', 'tps.id')
                                                ->join('bukti_deskripsi_curang', 'bukti_deskripsi_curang.tps_id', '=', 'tps.id')
                                                ->join('list_kecurangan', 'list_kecurangan.id', '=', 'bukti_deskripsi_curang.list_kecurangan_id')
                                                ->where('list_kecurangan.solution_fraud_id',$solut->id)
                                                ->where('saksi.kecurangan', 'yes')
                                                ->where('saksi.status_kecurangan', 'terverifikasi')
                                                ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
                                                ->count();?>
                    <div class="col-lg justify-content-end">
                        <div class="card">
                            <div class="card-header bg-primary">
                                <div class="card-title text-white">{{$solut->solution}}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mx-auto text-center">
                                        <b class="fs-4 mx-auto">{{$jmlh_kecurangan}} </b>
                                    </div>
                                    <div class="col my-auto text-end">
                                        <a href="{{route('superadmin.solution',encrypt($solut->id))}}"
                                            class="my-auto">Lihat
                                            <i class="mdi mdi-eye"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<hr>
<h2 class="fw-bold mb-0 tugel" data-bs-toggle="collapse" href="#collapse3" role="button" aria-expanded="false"
    aria-controls="multiCollapseExample2">
    <div class="row">
        <div class="col-6">
            Data 3
        </div>
        <div class="col-6 text-end">
            <i class="fa-solid fa-chevron-down" style="display: none"></i>
            <i class="fa-solid fa-chevron-right"></i>
        </div>
    </div>
</h2>
<hr>

<div class="row collapse multi-collapse chevron-logic" id="collapse3">
    <h2 class="fw-bold">
        Election Fraud Barcode Report (EFBR)
    </h2>
    <div class="col-lg-12">
        <div class="card mt-5">
            <div class="card-header">
                <h4 class="card-title text-center mx-auto">Election Fraud Barcode Report (FBR)</h4>

            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($qrcode as $item)
                    <?php $scan_url = "" . url('/') . "/scanning-secure/" . Crypt::encrypt($item['nomor_berkas']) . ""; ?>
                    <div class="col-md-3">
                        <center>
                            <div class="card" style="background-color:white">
                                <div class="card-body">
                                    <a href="{{url('/') . "/scanning-secure/" . Crypt::encrypt($item['nomor_berkas'])}}"
                                        target="_blank" rel="noopener noreferrer">
                                        {!! QrCode::size(200)->generate($scan_url); !!}
                                    </a>
                                </div>
                            </div>
                        </center>
                    </div>
                    @endforeach
                    <div class="col-lg-12">
                        <div class="row justify-content-end">
                            <div class="col-lg-2">
                                <a href="{{url('')}}/administrator/fraud-data-report"
                                    class="btn btn-dark btn-block">Selengkapnya</a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

<hr>
<h2 class="fw-bold mb-0 tugel" data-bs-toggle="collapse" href="#collapse4" role="button" aria-expanded="false"
    aria-controls="multiCollapseExample2">
    <div class="row">
        <div class="col-6">
            Data 4
        </div>
        <div class="col-6 text-end">
            <i class="fa-solid fa-chevron-down" style="display: none"></i>
            <i class="fa-solid fa-chevron-right"></i>
        </div>
    </div>
</h2>
<hr>

<div class="row collapse multi-collapse chevron-logic" id="collapse4">
    <h2 class="fw-bold">
        Election Fraud Data Print (EFDP)
    </h2>
    @foreach($list_suara as $ls)
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="card-title text-white">DATA SAKSI</div>
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



    <div class="col-lg-12">
        <div class="row justify-content-end">
            <div class="col-lg-2">
                <a href="{{url('')}}/administrator/fraud-data-print" class="btn btn-dark btn-block">Selengkapnya</a>
            </div>
        </div>
    </div>




</div>

<div id="fotoKecuranganterverifikasi" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bukti</h5>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <div id="container-hukum-verifikasi"></div>
            </div>
        </div>
    </div>
</div>


<script>
    $('a.fotoKecuranganterverifikasi').on('click', function () {
        let id = $(this).data('id');
        $.ajax({
            url: `{{route('superadmin.ajaxKecuranganTerverifikasi')}}`,
            type: "GET",
            data: {
                id
            },
            success: function (response) {
                if (response) {
                    $('#container-hukum-verifikasi').html(response);
                }
            }
        });
    });

</script>





<hr>
<h2 class="fw-bold mb-0 tugel" data-bs-toggle="collapse" href="#collapse5" role="button" aria-expanded="false"
    aria-controls="multiCollapseExample2">
    <div class="row">
        <div class="col-6">
            Data 5
        </div>
        <div class="col-6 text-end">
            <i class="fa-solid fa-chevron-down" style="display: none"></i>
            <i class="fa-solid fa-chevron-right"></i>
        </div>
    </div>
</h2>
<hr>

<div class="row collapse multi-collapse chevron-logic" id="collapse5" style="margin-top: 30px;">
    <h2 class="fw-bold">
        Peserta Sidang MK
    </h2>

    @foreach($list_sidang as $ls)
    <?php
    $qr_code =  App\Models\Qrcode::where('tps_id',$ls->tps_id)->first();
    
    $scan_url = "" . url('/') . "/scanning-secure/" . Crypt::encrypt($qr_code['nomor_berkas']) . ""; ?>
    <div class="col-md-6 col-xl-4">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="card-title text-white">DATA LAPORAN KECURANGAN SAKSI</div>
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
                        <a id="Cek" data-bs-toggle="modal" onclick="qrsidang(this)" data-bs-target="#modalQrCode"
                            data-id="{{$ls->tps_id}}" href="#">
                            {!! QrCode::size(200)->generate($scan_url); !!}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach



    <div class="col-lg-12">
        <div class="row justify-content-end">
            <div class="col-lg-2">
                <a href="{{url('')}}/administrator/sidang_online" class="btn btn-dark btn-block">Selengkapnya</a>
            </div>
        </div>
    </div>

    <script>
        let qrsidang = function (ini) {
            let id_tps = $(ini).data('id');
            $.ajax({
                url: "{{url('')}}/administrator/get_qrsidang",
                data: {
                    id_tps,
                },
                type: 'GET',
                success: function (response) {
                    document.querySelector('div#qrSidang').innerHTML = response;
                }
            })
        }

    </script>
</div>



<div id="fotoKecuranganterverifikasi" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bukti</h5>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <div id="container-hukum-verifikasi"></div>
            </div>
        </div>
    </div>
</div>


<div id="modalQrCode" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Scan</h5>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body" id="qrSidang">
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#fotoKecuranganterverifikasi">-->
                <!--    Launch-->
                <!--</button>-->
            </div>

        </div>
    </div>
</div>


<script>
    $('a.fotoKecuranganterverifikasi').on('click', function () {
        let id = $(this).data('id');
        $.ajax({
            url: `{{route('superadmin.ajaxKecuranganTerverifikasi')}}`,
            type: "GET",
            data: {
                id
            },
            success: function (response) {
                if (response) {
                    $('#container-hukum-verifikasi').html(response);
                }
            }
        });
    });

</script>

</div>
<script>
    $(document).ready(function () {
        $('#responsive-datatable_info').dataTable({
            "pageLength": 50
        });
    });

</script>

<script>
    $('h2.tugel').on('click', function () {
        let koleps = $(this).attr('href');
        let down = $(this).find('i.fa-chevron-down')
        let right = $(this).find('i.fa-chevron-right')
        setTimeout(() => {
            if ($(koleps).hasClass('show')) {
                $(down).show();
                $(right).hide();

            } else {
                $(down).hide();
                $(right).show();
            }
        }, 10);
    });

</script>

@include('layouts.partials.footer')
@include('layouts.partials.scripts-bapilu')
