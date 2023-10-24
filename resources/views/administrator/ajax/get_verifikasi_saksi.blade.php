<?php
use App\Models\Tracking;


$track = Tracking::where('id_user',$user['id'])->first();
// dump($url);
?>

<style>
    td {
        max-width: 200px;
        /* word-break: break-all */
    }

    /* .parent-print {
        position: relative;
    }

    .btn-print {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%)
    } */
</style>

<div class="container">
    <div class="row">
        <div class="col mt-2">
            <div class="media">
                @if ($user['profile_photo_path'] == NULL)
                <img class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover; margin-right: 10px;" src="https://ui-avatars.com/api/?name={{ $user['name'] }}&color=7F9CF5&background=EBF4FF">
                @else
                <img class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover; margin-right: 10px;" src="{{url("/storage/profile-photos/".$user['profile_photo_path']) }}">
                @endif

                <div class="media-body my-auto">
                    <h5 class="mb-0">{{ $user['name'] }}</h5>
                    NIK : {{ $user['nik'] }}
                </div>
            </div>
        </div>
        <div class="col-md-auto pt-2 my-auto">
            <button class="btn btn-warning text-white"><i class="fa-solid fa-print"></i> Print</button>
        </div>
        {{-- <div class="col-md-3 mt-2 ">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle justify-content-end" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Action Saksi
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  @if ($user['is_active'] == 1)
                 
                <form action="action_verifikasi/{{ encrypt($user['id']) }}" method="post">
                    @csrf
                    <input type="hidden" name="aksi" value="{{ encrypt(0) }}">
                    <li><button class="dropdown-item" type="submit">Hapus Saksi</button></li>
                </form>
                  @endif
                  @if ($user['is_active'] == 0)
                  <form action="action_verifikasi/{{ encrypt($user['id']) }}" method="post">
                    @csrf
                    <input type="hidden" name="aksi" value="{{ encrypt(1) }}">
                    <li><button class="dropdown-item" type="submit">Verifikasi Saksi</button></li>
                </form>
                <form action="action_verifikasi/{{ encrypt($user['id']) }}" method="post">
                    @csrf
                    <input type="hidden" name="aksi" value="{{ encrypt(0) }}">
                    <li><button class="dropdown-item" type="submit">Hapus Saksi</button></li>
                </form>
                  @endif
                </ul>
            </div>
        </div> --}}
    </div>
    <div class="row mt-5">
        @if ($user['is_active'] == 2)
        <div class="col-12">
            <div class="alert alert-danger" role="alert">
                <i class="fa fa-check-circle"></i> Belum Terverifikasi
            </div>
        </div>
        @else
        <div class="col-12">
            <div class="alert alert-success fs-4" role="alert">
                <i class="fa fa-check-circle"></i> Terverifikasi
            </div>
        </div>
        @endif
    </div>
    <div class="row">

        <div class="col-md-4">
            <div class="row mt-5">
                <div class="col-12">
                    <b>Detail Akun <i class="fa fa-info-circle"></i></b>
                </div>
            
                <div class="col-12 mt-5">
                    <table class="table">
                        <tr>
                            <td class="ps-0 pe-2">Status</td>
                            <td class="px-0">:</td>
                            @if ($user['is_active'] == 2)
                            <td class="ps-2">Belum Terverifikasi</td>
                            @else
                            @if ($tps['setup'] == 'terisi')
                            <td class="ps-2">Terverifikasi (Sudah Mengirim Data Saksi)</td>
                            @else
                            <td class="ps-2">Terverifikasi (Belum Mengirim Data Saksi)</td>
                            @endif
                            @endif
                        </tr>
                        <tr>
                            <td class="ps-0 pe-2">Email</td>
                            <td class="px-0">:</td>
                            <td class="ps-2">{{ $user['email'] }}</td>
                        </tr>
                        <tr>
                            <td class="ps-0 pe-2">No.Hp</td>
                            <td class="px-0">:</td>
                            <td class="ps-2">{{ $user['no_hp'] }}</td>
                        </tr>
                        <tr>
                            <td class="ps-0 pe-2">Alamat</td>
                            <td class="px-0">:</td>
                            <td class="ps-2">{{ $user['address'] }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="row mt-5">
                <div class="col-12">
                    <b>Lokasi <i class="fa fa-info-circle"></i></b>
                </div>

                <div class="col-12 mt-5">
                    <table class="table">
                        <tr>
                            <td class="ps-0 pe-2">Kecamatan</td>
                            <td class="px-0">:</td>
                            <td class="ps-2">{{$district['name'] }}</td>
                        </tr>
                        <tr>
                            <td class="ps-0 pe-2">Kelurahan</td>
                            <td class="px-0">:</td>
                            <td class="ps-2">{{$village['name'] }}</td>
                        </tr>
                        <tr>
                            <td class="ps-0 pe-2">TPS</td>
                            <td class="px-0">:</td>
                            <td class="ps-2">{{ $tps['number'] }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="row mt-5">
                <div class="col-12">
                    <b>Meta Data <i class="fa fa-info-circle"></i></b>
                </div>
            @if ($track == NULL)
                <div class="col-12 mt-2">
                    <table class="table">
                        <tr>
                            <td class="ps-0 pe-2">Lontitude</td>
                            <td class="px-0">:</td>
                            <td class="ps-2">Tidak Terdeteksi</td>
                        </tr>
                        <tr>
                            <td class="ps-0 pe-2">Latitude</td>
                            <td class="px-0">:</td>
                            <td class="ps-2">Tidak Terdeteksi</td>
                        </tr>
                        <tr>
                            <td class="ps-0 pe-2">Ip Address</td>
                            <td class="px-0">:</td>
                            <td class="ps-2"Tidak Terdeteksi</td>
                        </tr>
                        <tr>
                            <td class="ps-0 pe-2">Tanggal Teregristrasi</td>
                            <td class="px-0">:</td>
                            <td class="ps-2">(dummy)</td>
                        </tr>
                        @if($url == 'hadir')
                        <tr>
                            <td class="ps-0 pe-2">Jam Absen</td>
                            <td class="px-0">:</td>
                            <td class="ps-2">{{ $user['created_at'] }}</td>
                        </tr>
                        @else
                        @endif
                    </table>
                </div>

            @else
                <div class="col-12 mt-2">
                    <table class="table">
                        <tr>
                            <td class="ps-0 pe-2">Lontitude</td>
                            <td class="px-0">:</td>
                            <td class="ps-2">{{$track['longitude'] }}</td>
                        </tr>
                        <tr>
                            <td class="ps-0 pe-2">Latitude</td>
                            <td>:</td>
                            <td class="ps-2">{{$track['latitude'] }}</td>
                        </tr>
                        <tr>
                            <td class="ps-0 pe-2">Ip Address</td>
                            <td>:</td>
                            <td class="ps-2">{{ $track['ip_address'] }}</td>
                        </tr>
                        <tr>
                            <td class="ps-0 pe-2">Tanggal Teregristrasi</td>
                            <td class="px-0">:</td>
                            <td class="ps-2">(dummy)</td>
                        </tr>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>

    @if($url == 'hadir')
    <div class="row">
        {{-- <div class="col-12 mt-2">
            <b>Foto Potrait & KTP <i class="fa fa-info-circle"></i></b>
        </div> --}}
        <div class="col-4 mt-2 px-1">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0 fw-bold">
                        Foto Selfie
                    </h6>
                </div>
                <div class="card-body p-0">
                    @if ($user['profile_photo_path'] == NULL)
                        <img style="height: 415px; object-fit: cover;" src="https://ui-avatars.com/api/?name={{ $user['name'] }}&color=7F9CF5&background=EBF4FF">
                    @else
                        <img style="height: 415px; object-fit: cover;" src="{{url("/storage/profile-photos/".$user['profile_photo_path']) }}">
                    @endif
                </div>
            </div>
        </div>
        <div class="col-8 mt-2 px-1">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0 fw-bold">
                        Foto KTP
                    </h6>
                </div>
                <div class="card-body p-0">
                    @if ($tps['foto_lokasi'] != null)
                        <img style="height: 415px; object-fit: cover" src="{{ $tps['foto_lokasi'] }}" alt="">
                    @else
                        <img style="height: 415px; object-fit: cover" src="https://t-2.tstatic.net/default-2.jpg" alt="">
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mb-5">
        <div class="col-6 mt-2 px-1">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0 fw-bold">
                        Foto Selfie di Lokasi
                    </h6>
                </div>
                <div class="card-body p-0">
                    @if ($tps['foto_lokasi'] != null)
                        <img style="height: 415px; object-fit: cover" src="{{ $tps['foto_lokasi'] }}" alt="">
                    @else
                        <img style="height: 415px; object-fit: cover" src="https://t-2.tstatic.net/default-2.jpg" alt="">
                    @endif
                </div>
            </div>
        </div>
        <div class="col-6 mt-2 px-1">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0 fw-bold">
                        Foto TPS
                    </h6>
                </div>
                <div class="card-body p-0">
                    @if ($tps['foto_lokasi'] != null)
                        <img style="height: 415px; object-fit: cover" src="{{ $tps['foto_lokasi'] }}" alt="">
                    @else
                        <img style="height: 415px; object-fit: cover" src="https://t-2.tstatic.net/default-2.jpg" alt="">
                    @endif
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="row mb-5">
        {{-- <div class="col-12 mt-2">
            <b>Foto Potrait & KTP <i class="fa fa-info-circle"></i></b>
        </div> --}}
        <div class="col-4 mt-2 px-1">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0 fw-bold">
                        Foto Selfie
                    </h6>
                </div>
                <div class="card-body p-0">
                    @if ($user['profile_photo_path'] == NULL)
                        <img style="height: 415px; object-fit: cover;" src="https://ui-avatars.com/api/?name={{ $user['name'] }}&color=7F9CF5&background=EBF4FF">
                    @else
                        <img style="height: 415px; object-fit: cover;" src="{{url("/storage/profile-photos/".$user['profile_photo_path']) }}">
                    @endif
                </div>
            </div>
        </div>
        <div class="col-8 mt-2 px-1">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0 fw-bold">
                        Foto KTP
                    </h6>
                </div>
                <div class="card-body p-0">
                    @if ($tps['foto_lokasi'] != null)
                        <img style="height: 415px; object-fit: cover" src="{{ $tps['foto_lokasi'] }}" alt="">
                    @else
                        <img style="height: 415px; object-fit: cover" src="https://t-2.tstatic.net/default-2.jpg" alt="">
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($url == 'hadir')
    <div class="row">
        <div class="col-12">
            <hr>
            <div class="row">
                <div class="col"> <strong>Saksi Mengirim Data TPS:</strong> <br>{{$saksi['created_at']}}</div>
                <div class="col"> <strong>Checked BY:</strong> <br> -
                </div>
                <div class="col"> <strong>Status:</strong> <br> @if ($saksi['verification'] == 1)
                  Selesai
                @else
                Pending
                @endif
            </div>
            </div>
            <div class="track">
                <div class="step active success"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Saksi Mendaftar</span> </div>
                @if ($tps['setup'] == "terisi")
                <div class="step active  success"> <span class="icon"> <i class="fa fa-send"></i> </span> <span class="text">Saksi Mengirimkan TPS</span> </div>
                @if ($saksi['verification'] != NULL)
                <div class="step active success"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Terverifikasi</span> </div>
                @else
                <div class="step success"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Terverifikasi</span> </div>
                @endif
                @else
                <div class="step  success"> <span class="icon"> <i class="fa fa-send"></i> </span> <span class="text">Saksi Mengirimkan TPS</span> </div>
                <div class="step success"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Selesai</span> </div>
                @endif
            </div>
            <hr>

        </div>
    </div>
    @if ($saksi != NULL)
    @if ($saksi['kecurangan'] == "yes")
    <div class="row mt-5">
        <div class="col-12">
            <hr>
            <div class="row">
                <div class="col"> <strong>Estimasi Kecurangan Terverfikasi:</strong> <br>29 nov 2019 </div>
                <div class="col"> <strong>Checked BY:</strong> <br> Hendra Maulidan
                </div>
                <div class="col"> <strong>Status:</strong> <br> Selesai </div>
            </div>
            <div class="track">
                @if ($saksi['status_kecurangan'] == 'belum terverifikasi')
                <div class="step active secondary"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Saksi Mengirim Kecurangan</span> </div>
                <div class="step secondary"> <span class="icon"> <i class="fa fa-send"></i> </span> <span class="text">Terverifikasi/Selesai</span> </div>
                @elseif($saksi['status_kecurangan'] == 'terverifikasi')
                <div class="step active secondary"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Saksi Mengirim Kecurangan</span> </div>
                <div class="step active secondary"> <span class="icon"> <i class="fa fa-send"></i> </span> <span class="text">Terverifikasi/Selesai</span> </div>
                @elseif($saksi['status_kecurangan'] == 'ditolak')
                <div class="step active danger"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Saksi Mengirim Kecurangan</span> </div>
                <div class="step active danger"> <span class="icon"> <i class="fa fa-send"></i> </span> <span class="text">Ditolak</span> </div>
                @endif
            </div>
            <hr>
        </div>
    </div>
    @else
    
    @endif
    @endif

    @else
    @endif



</div>
