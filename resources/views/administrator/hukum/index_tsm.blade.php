@extends('layouts.main-indekTSM')

@section('content')
<div class="row mt-3">
    <div class="col-lg-4">
        <h1 class="page-title fs-1 mt-2">Dashboard Rekapitung
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Indikator Data TSM
                <!-- Kota -->
            </li>
        </ol>
        <h4 class="fs-4 mt-2 fw-bold">Indikator Data TSM (ETSMI)</h4>
    </div>
    <div class="col-lg-8">
        <div class="row justify-content-end">
            <div class="col-md-2">
                <a href="{{url('')}}/administrator/print-index-tsm" target="_blank"
                    class="btn btn-block btn-dark ml-2 mr-2">Print &nbsp;&nbsp;<i class="fa fa-print"></i></a>
            </div>
        </div>
    </div>
</div>

<h4 class="fs-4 mt-5 fw-bold">Election TSM Indicator <div>Dilindungi Paten Rekapitung</div>
</h4>
<hr style="border: 1px solid">

<!-- PAGE-HEADER END -->
<div class="row mx-auto mt-5 container">
    <div class="col-lg-12">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-danger">
                        <center>
                            <h4 class="mx-auto fw-bold mb-0 text-white">
                                PELANGGARAN ADMINISTRASI PEMILU
                            </h4>
                        </center>
                    </div>
                    <div class="card-body">

                        <center>
                            <div id="chart-pie"></div>
                        </center>
                        <table
                            class="table table-bordered text-nowrap border-bottom dataTable no-footer table-striped table-hover w-100"
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
                                            $persen = ($totalKec / $jumlahSaksi) * 100;

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
                            <h4 class="mx-auto fw-bold text-white mb-0">
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
                                              $persen = ($totalKec / $jumlahSaksi) * 100;
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
                            <h4 class="mx-auto fw-bold text-white mb-0">
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
                                                $persen = ($totalKec / $jumlahSaksi) * 100;
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


    <div class="row">
        <div class="col">
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
    </div>



</div>
@include('layouts.templateCommander.script-command')

<script>
    $(document).ready(function () {
        $('#responsive-datatable_info').dataTable({
            "pageLength": 50
        });
    });

</script>
@endsection
