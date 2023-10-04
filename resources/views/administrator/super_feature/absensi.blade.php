@extends('layouts.mainAbsen')
@section('content')


<div class="row mt-3">
    <div class="col-lg-4">
        <h1 class="page-title fs-1 mt-2">Dashboard Rekapitung
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Absensi Saksi
                <!-- Kota -->
            </li>
        </ol>
        <h4 class="fs-4 mt-2 fw-bold">Daftar Absensi Saksi</h4>
    </div>
    <div class="col-lg-8 mt-2">
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
                        <p class="">{{count($absen)}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="card-title text-white">Total Saksi Absen</div>
                    </div>
                    <div class="card-body">
                        <p class="">{{$user - count($absen)}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<h4 class="fw-bold fs-4 mt-5">
    {{$title}}  
</h4>
<hr style="border: 1px solid">

<div class="row mt-5">
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
                                <th class="text-white text-center align-middle">Kelurahan</th>
                                <th class="text-white text-center align-middle">TPS</th>
                                <th class="text-white text-center align-middle">Jam Absen</th>
                                <th class="text-white text-center align-middle">Email</th>
                                <th class="text-white text-center align-middle">Longitude</th>
                                <th class="text-white text-center align-middle">Latitude</th>
                                <th class="text-white text-center align-middle">Action</th>
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
                                <td class="align-middle">{{$item['longitude']}}</td>
                                <td class="align-middle">{{$item['latitude']}}</td>
                                <td class="align-middle">
                                    @if ($item['status'] == 'sudah absen')
                                    <span class="badge bg-success">{{$item['status']}}</span>
                                    @else
                                    <span class="badge bg-danger">{{$item['status']}}</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection