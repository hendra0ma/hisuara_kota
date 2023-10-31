@extends('layouts.mainlayout')

@section('content')


<div class="row mt-3">
    <div class="col-lg-4">
        <h1 class="page-title fs-1 mt-2">Realisasi DPT
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            {{-- <li class="breadcrumb-item"><a href="#">Bukti Kecurangan</a></li> --}}
            <li class="breadcrumb-item active" aria-current="page">
                {{$kota->name}}
                <!-- Kota -->
            </li>
        </ol>
    </div>
</div>

<h4 class="fw-bold fs-4 mt-5 mb-0">
    &nbsp;
</h4>
<hr style="border: 1px solid">
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <center>
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/46/KPU_Logo.svg/925px-KPU_Logo.svg.png"
                    class="hadow-4 mb-3" style="width: 100px;" alt="Avatar" />
            </center>
            <b>
                <center>Hasil Analisa Realisasi DPT KPU</center>
                <center> {{$config['jenis_pemilu']}} {{$config['tahun']}} {{$kota->name}}</center>
            </b>
            <table class="table table-bordered table-hover mt-2">
                <thead class="bg-primary text-white">
                    <tr>
                    <tr>
                        <td class="text-white text-center align-middle">Kecamatan</td>
                        <td class="text-white text-center align-middle">Total DPT KPU</td>
                        <td class="text-white text-center align-middle">Total Pengguna Hak Pilih</td>
                        <td class="text-white text-center align-middle">Selisih</td>
                        <td class="text-white text-center align-middle">GAP</td>
                        <td class="text-white text-center align-middle">Indikasi</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kecamatan as $item)
                    <?php $pengguna_hak = App\Models\SaksiData::where('district_id',$item['id'])->sum('voice'); ?>

                    <?php $persen = ($item['dpt'] - $pengguna_hak) / $item['dpt'] * 100; ?>
                    <tr>
                        <td>{{$item['name']}}</td>
                        <td>{{$item['dpt']}}</td>
                        <td>{{$pengguna_hak}}</td>
                        <td>{{$item['dpt'] - $pengguna_hak}}</td>
                        <td>@if ($pengguna_hak == 0)
                            0%
                            @else
                            {{ floor($persen) }}%
                            @endif
                        </td>
                        <td>
                            @if ($pengguna_hak == 0)
                            <span class="badge" style="background-color: rgba(0, 0, 0, 0.25)">Belum Terisi</span>
                            @else
                            @if (floor($persen) >= 1 && floor($persen) <= 50) <span class="badge bg-warning">
                                Rendah</span>
                                @elseif (floor($persen) > 50 && floor($persen) <= 70) <span class="badge bg-success">
                                    Normal</span>
                                    @elseif (floor($persen) > 70 && floor($persen) <= 80) <span
                                        class="badge bg-secondary">Tinggi</span>
                                        @elseif (floor($persen) > 80 && floor($persen) <= 90) <span
                                            class="badge bg-danger">Indikasi Kecurangan</span>
                                            @elseif (floor($persen) > 90 && floor($persen) <= 100) <span
                                                class="badge bg-dark">Manipulasi</span>
                                                @endif
                                                @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{url('/')}}/administrator/analisa_dpt_kpu/print" class="btn btn-xl btn-dark"> <span
                    class="mdi mdi-printer"></span> Print</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Keterangan Indikator</div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered w-100">
                        <tr>
                            <td><b class="text-warning">1% - 50%</b> <br> Rendah</td>
                            <td><b class="text-success">51% - 70%</b> <br> Normal</td>
                            <td><b class="text-secondary">71% - 80%</b> <br> Tinggi</td>
                            <td><b class="text-danger">81% - 90%</b> <br> Indikasi Kecurangan</td>
                            <td><b class="text-dark">91% - 100%</b> <br> Manipulasi</td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection