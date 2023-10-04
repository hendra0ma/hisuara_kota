@extends('layouts.main-hukum')

@section('content')
<!-- PAGE-HEADER -->

<div class="row mt-3">
    <div class="col-lg-4">
        <h1 class="page-title fs-1 mt-2">Dashboard
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Hukum
                <!-- Kota -->
            </li>
        </ol>
        <h4 class="fs-4 mt-2 fw-bold">Administrator Hukum (2)</h4>
    </div>
    <!-- <div class="col-lg-8 mt-2">
        <div class="row">
            <div class="col-lg-3 justify-content-end">
                <div class="card">
                    <div class="card-header bg-secondary">
                        <div class="card-title text-white">Data Masuk</div>
                    </div>
                    <div class="card-body">
                        <p class="">{{ count($data_masuk) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header bg-success">
                        <div class="card-title text-white">Data Terverifikasi</div>
                    </div>
                    <div class="card-body">
                        <p class="">{{ count($terverifikasi) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="card-title text-white">Data Ditolak</div>
                    </div>
                    <div class="card-body">
                        <p class="">{{ count($ditolak) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header bg-info">
                        <div class="card-title text-white">Data Ditolak</div>
                    </div>
                    <div class="card-body">
                        <p class="">{{ count($ditolak) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="col-lg-8">
      <div class="row justify-content-end">
            
        
          <div class="col-2">
              <button onclick="window.print()"class="btn btn-block btn-dark ml-2 mr-2"> Print &nbsp;&nbsp;<i class="fa fa-print"></i></button>
          </div>
          <div class="col-2">
              <button onclick="window.print()"class="btn btn-block btn-primary ml-2 mr-2"> save &nbsp;&nbsp;<i class="fa fa-download"></i></button>
          </div>
      </div>
    </div>
</div>

<!-- PAGE-HEADER END -->

<div class="row mt-5">

   <div class="col-lg-6">
        <div class="row justify-content-center">
            <div class="col-lg-12 ">
                <div class="card">
                    <div class="card-header">
                        <center>
                            <h4 class="mx-auto">
                                PELANGGARAN ADMINISTRASI PEMILU
                            </h4>
                        </center>
                    </div>
                    <div class="card-body">

                        <center>
                            <div id="chart-pie"></div>
                        </center>
                        <table
                            class="table table-bordered text-nowrap border-bottom dataTable no-footer table-striped table-hover"
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
    <div class="col-lg-6">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <center>
                            <h4 class="mx-auto">
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
                    <div class="card-header">
                        <center>
                            <h4 class="mx-auto">
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
    <hr>


</div>

@endsection
