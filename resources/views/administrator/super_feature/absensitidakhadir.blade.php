@extends('layouts.mainAbsen')
@section('content')


<div class="row mt-5">
    <div class="col-lg" style="position: fixed; z-index: 10; background: #f2f3f9">
        <h1 class="page-title fs-1 mt-2">Saksi Tidak Hadir
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">{{ $kota->name }}
                <!-- Kota -->
            </li>
        </ol>
    </div>

    <div class="col-lg-8" style="position: fixed; right: 18px; width: 1244.66px; z-index: 10; background: #f2f3f9">
        <div class="row mt-2">

            {{-- <div class="col parent-link">
                <a href="{{url('')}}/administrator/verifikasi_saksi" class="btn text-white w-100 py-3">Verifikasi Saksi</a>
            </div>
            <div class="col parent-link">
                <a href="{{url('')}}/administrator/absensi" class="btn text-white w-100 py-3">Saksi Teregristrasi</a>
            </div>
            <div class="col parent-link">
                <a href="{{url('')}}/administrator/absensi/hadir" class="btn text-white w-100 py-3">Saksi Hadir</a>
            </div>
            <div class="col parent-link">
                <a href="{{url('')}}/administrator/absensi/tidak_hadir" class="btn text-white w-100 py-3">Saksi Tidak Hadir</a>
            </div> --}}
            <div class="col parent-link">
                <a data-command-target="verifikasi-saksi" href="{{url('')}}/administrator/verifikasi_saksi"
                    class="btn text-white w-100 py-3 btn-to-loader {{ (url()->current() == url('').'/administrator/verifikasi_saksi')?'active' : '' }}">Verifikasi
                    Saksi</a>
            </div>
            <div class="col parent-link">
                <a data-command-target="saksi-teregistrasi" href="{{url('')}}/administrator/absensi"
                    class="btn text-white w-100 py-3 btn-to-loader {{ (url()->current() == url('').'/administrator/absensi')?'active' : '' }}">Saksi
                    Teregistrasi</a>
            </div>
            <div class="col parent-link">
                <a data-command-target="saksi-hadir" href="{{url('')}}/administrator/absensi/hadir"
                    class="btn text-white w-100 py-3 btn-to-loader {{ (url()->current() == url('').'/administrator/absensi/hadir')?'active' : '' }}">Saksi
                    Hadir</a>
            </div>
            <div class="col parent-link">
                <a data-command-target="saksi-tidak-hadir" href="{{url('')}}/administrator/absensi/tidak_hadir"
                    class="btn text-white w-100 py-3 btn-to-loader {{ (url()->current() == url('').'/administrator/absensi/tidak_hadir')?'active' : '' }}">Saksi
                    Tidak Hadir</a>
            </div>
            <div class="col parent-link">
                <a data-command-target="saksi-ditolak" href="{{url('')}}/administrator/saksi_ditolak"
                    class="btn text-white w-100 py-3 btn-to-loader {{ (url()->current() == url('').'/administrator/saksi_ditolak')?'active' : '' }}">Saksi
                    Ditolak</a>
            </div>

        </div>
    </div>
    {{-- <div class="col-lg-8 mt-2">
        <div class="row">
            <div class="col-lg-4 justify-content-end">
                <div class="card">
                    <div class="card-header bg-secondary">
                        <div class="card-title text-white">Total Saksi Terdaftar</div>
                    </div>
                    <div class="card-body">
                        <p class="">{{$user}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-success">
                        <div class="card-title text-white">Total Saksi Hadir</div>
                    </div>
                    <div class="card-body">
                        <p class="">{{count($absen2)}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="card-title text-white">Total Saksi Absen</div>
                    </div>
                    <div class="card-body">
                        <p class="">{{$user - count($absen2)}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>

<style>
    .tooltip-inner {
        background-color: rgb(248, 38, 73);
        box-shadow: 0px 0px 4px black;
        opacity: 1 !important;
    }
    .tooltip.bs-tooltip-right .tooltip-arrow::before {
        border-right-color: rgb(248, 38, 73) !important;
    }
    .tooltip.bs-tooltip-left .tooltip-arrow::before {
        border-left-color: rgb(248, 38, 73) !important;
    }
    .tooltip.bs-tooltip-bottom .tooltip-arrow::before {
        border-bottom-color: rgb(248, 38, 73) !important;
    }
    .tooltip.bs-tooltip-top .tooltip-arrow::before {
        border-top-color: rgb(248, 38, 73) !important;
    }
</style>

<div style="position: fixed; width: 97%; margin-top: 76px; z-index: 10; background: #f2f3f9">
    <div class="row">
        <div class="col-md">
            <h4 class="fw-bold fs-4 mt-5 mb-0">
                Jumlah Saksi Belum Hadir : {{$jumlah_tidak_hadir}}
            </h4>
        </div>
        <div class="col-md-auto mt-auto">
            <div class="ms-auto">
                <button style="width: 82.22px; height: 38px; margin-right: 3px;" class="btn btn-success my-auto">
                    <i class="fa-solid fa-download"></i>
                    Unduh
                </button>
            </div>
        </div>
    </div>
    <hr style="border: 1px solid; width: 1841px">
</div>
<div class="row mt-3">
    <livewire:absensi-tidak-hadir>

{{-- <div class="row mt-5">
    <div class="col-md">

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover w-100" id="basic-datatable">
                        <thead class="bg-primary">
                            <tr>
                                <th class="text-white text-center align-middle">Foto</th>
                                <th class="text-white text-center align-middle">Nama</th>
                                <th class="text-white text-center align-middle">Kecamatan</th>
                                <th class="text-white text-center align-middle">Kecamatan</th>
                                <th class="text-white text-center align-middle">Kelurahan</th>
                                <th class="text-white text-center align-middle">TPS</th>
                                <th class="text-white text-center align-middle">Jam Absen</th>
                                <th class="text-white text-center align-middle">Email</th>
                          
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($absen as $item)
                            <?php $district = App\Models\District::where('id',$item['districts'])->first(); ?>
                            <?php $villages = App\Models\Village::where('id',$item['villages'])->first(); ?>
                            <?php $tps = App\Models\Tps::where('id',$item['tps_id'])->first(); ?>
                            <tr>
                                <td class="text-center"> @if ($item['profile_photo_path'] == NULL)
                                    <img class="rounded-circle" style="width: 75px; height: 75px; object-fit: cover; margin-right: 10px;" src="https://ui-avatars.com/api/?name={{ $item['name'] }}&color=7F9CF5&background=EBF4FF">
                                    @else
                                    <img class="rounded-circle" style="width: 75px; height: 75px; object-fit: cover; margin-right: 10px;" src="{{url("/storage/profile-photos/".$item['profile_photo_path']) }}">
                                    @endif
                                </td>
                                <td class="align-middle">{{$item['name']}}</td>
                                <td class="align-middle">{{$district['name']}}</td>
                                <td class="align-middle">{{$villages['name']}}</td>
                                <td class="align-middle">{{$tps['number']}}</td>
                                <td class="align-middle">{{$item['created_at']}}</td>
                                <td class="align-middle">{{$item['email']}}</td>
               
                             
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div> --}}
</div>

<script>
    $(document).ready(function() {
        var specificUrl = "{{ url('') }}/administrator/verifikasi_saksi"; // Specific URL to match
    
        $('.glowy-menu[href="' + specificUrl + '"]').addClass('active');
    });
</script>

@endsection