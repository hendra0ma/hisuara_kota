<?php
use App\Models\Tracking;


$track = Tracking::where('id_user',$user['id'])->first();
?>
<div class="container">
    <div class="row">
        <div class="col-9 mt-2">
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
        <div class="col-md-3 mt-2 ">
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
        </div>
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
            <div class="alert alert-success" role="alert">
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
                            <td style="width: 130px">Status</td>
                            <td style="width: 52px">:</td>
                            @if ($user['is_active'] == 2)
                            <td>Belum Terverifikasi</td>
                            @else
                            @if ($tps['setup'] == 'terisi')
                            <td>Terverifikasi (Sudah Mengirim Data Saksi)</td>
                            @else
                            <td>Terverifikasi (Belum Mengirim Data Saksi)</td>
                            @endif
                            @endif
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>{{ $user['email'] }}</td>
                        </tr>
                        <tr>
                            <td>No.Hp</td>
                            <td>:</td>
                            <td>{{ $user['no_hp'] }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{ $user['address'] }}</td>
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
                            <td style="width: 130px">Kecamatan</td>
                            <td style="width: 52px">:</td>
                            <td>{{$district['name'] }}</td>
                        </tr>
                        <tr>
                            <td>Kelurahan</td>
                            <td>:</td>
                            <td>{{$village['name'] }}</td>
                        </tr>
                        <tr>
                            <td>TPS</td>
                            <td>:</td>
                            <td>{{ $tps['number'] }}</td>
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
                            <td style="width: 130px">Lontitude</td>
                            <td style="width: 52px">:</td>
                            <td>Tidak Terdeteksi</td>
                        </tr>
                        <tr>
                            <td>Latitude</td>
                            <td>:</td>
                            <td>Tidak Terdeteksi</td>
                        </tr>
                        <tr>
                            <td>Ip Address</td>
                            <td>:</td>
                            <td>Tidak Terdeteksi</td>
                        </tr>
                    </table>
                </div>
            </div>
            @else
                <div class="col-12 mt-2">
                    <table class="table">
                        <tr>
                            <td style="width: 130px">Lontitude</td>
                            <td style="width: 52px">:</td>
                            <td>{{$track['longitude'] }}</td>
                        </tr>
                        <tr>
                            <td>Latitude</td>
                            <td>:</td>
                            <td>{{$track['latitude'] }}</td>
                        </tr>
                        <tr>
                            <td>Ip Address</td>
                            <td>:</td>
                            <td>{{ $track['ip_address'] }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-12 mt-2">
            <b>Foto Lokasi <i class="fa fa-info-circle"></i></b>
        </div>
        <div class="col-12 mt-2">
            @if ($tps['foto_lokasi'] != null)
                <img style="width: 100%" src="{{ $tps['foto_lokasi'] }}" alt="">
            @else
                <img style="width: 100%" src="https://t-2.tstatic.net/default-2.jpg" alt="">
            @endif
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <hr>
            <div class="row">
                <div class="col"> <strong>Saksi Mengirim Data tps:</strong> <br>{{$saksi['created_at']}}</div>
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



</div>
