<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
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
                    <h5 class="mt-0">{{ $user['name'] }}</h5>
                    NIK : {{ $user['nik'] }}
                </div>
            </div>
        </div>
        <div class="col-md-3 mt-2 ">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle justify-content-end" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Action
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
    <div class="row mt-5">
        <div class="col-12">
            <b>Detail Akun <i class="fa fa-info-circle"></i></b>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12">
            <table class="table">
                <tr>
                    <td style="width: 130px">Status</td>
                    <td style="width: 52px">:</td>
                    @if ($user['is_active'] == 2)
                    <td>Belum Terverifikasi</td>
                    @else
                    <td>Terverifikasi</td>
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
    <div class="row mt-5">
        <div class="col-12">
            <b>Lokasi <i class="fa fa-info-circle"></i></b>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12">
            <table class="table">
                <tr>
                    <td style="width: 130px">Kecamatan</td>
                    <td style="width: 52px">:</td>
                    <td>{{$district['name'] }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12">
            <b>Kontak Saksi <i class="fa fa-info-circle"></i></b>
        </div>
    </div>
    <div class="row mt-5 mb-5">
        <div class="col-md-6">
            <button class="btn bg-success text-light w-100"><i class="fa-brands fa-whatsapp"></i>
                Whatsapp</button>
        </div>
        <div class="col-md-6">
            <button class="btn bg-warning w-100"><i class="fa fa-phone"></i> Telepon</button>
        </div>
    </div>
</div>
