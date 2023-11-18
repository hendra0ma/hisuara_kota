@extends('layouts.mainAbsen')
@section('content')


<div class="row">
    <div class="col-lg" style="position: fixed; z-index: 10; background: #f2f3f9">
        <h1 class="page-title fs-1 mt-2">Saksi Hadir
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                {{ $kota->name }}
                <!-- Kota -->
            </li>
        </ol>
    </div>



    <div class="col-lg-8" style="position: fixed; right: 18px; width: 1244.66px; z-index: 10; background: #f2f3f9">
        <div class="row mt-2">
            
            <div class="col parent-link">
                <a href="{{url('')}}/administrator/verifikasi_saksi"
                    class="btn text-white w-100 py-3 {{ (url()->current() == url('').'/administrator/verifikasi_saksi')?'active' : '' }}">Verifikasi
                    Saksi</a>
            </div>
            <div class="col parent-link">
                <a href="{{url('')}}/administrator/absensi"
                    class="btn text-white w-100 py-3 {{ (url()->current() == url('').'/administrator/absensi')?'active' : '' }}">Saksi
                    Teregistrasi</a>
            </div>
            <div class="col parent-link">
                <a href="{{url('')}}/administrator/absensi/hadir"
                    class="btn text-white w-100 py-3 {{ (url()->current() == url('').'/administrator/absensi/hadir')?'active' : '' }}">Saksi
                    Hadir</a>
            </div>
            <div class="col parent-link">
                <a href="{{url('')}}/administrator/absensi/tidak_hadir"
                    class="btn text-white w-100 py-3 {{ (url()->current() == url('').'/administrator/absensi/tidak_hadir')?'active' : '' }}">Saksi
                    Tidak Hadir</a>
            </div>
            <div class="col parent-link">
                <a href="{{url('')}}/administrator/saksi_ditolak"
                    class="btn text-white w-100 py-3 {{ (url()->current() == url('').'/administrator/absensi/saksi_ditolak')?'active' : '' }}">Saksi
                    Ditolak</a>
            </div>

        </div>
    </div>
</div>
<!-- PAGE-HEADER END -->

<div style="position: fixed; width: 97%; margin-top: 76px; z-index: 10; background: #f2f3f9">
    <div class="row">
        <div class="col-md">
            <h4 class="fw-bold fs-4 mt-5 mb-0">
                Jumlah Saksi Hadir : {{$jumlah_hadir}}
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

    <livewire:absensi>
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
</div> --}}
</div>
<div style="background: #f2f3f9; position: fixed; width: 100%; height: 70px; top: 90px; left: 0; z-index: 8;"></div>
<!-- CONTAINER END -->
<div class="modal fade" id="cekmodal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-header bg-primary text-white">
            <div class="modal-title mx-auto">
                <h4 class="mb-0 fw-bold">Detail Data Saksi</h4>
            </div>
        </div>
        <div class="modal-content h-auto">
            <div class="container">
                <div id="container-verifikasi">

                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var specificUrl = "{{ url('') }}/administrator/verifikasi_saksi"; // Specific URL to match
    
        $('.glowy-menu[href="' + specificUrl + '"]').addClass('active');
    });
</script>


@endsection