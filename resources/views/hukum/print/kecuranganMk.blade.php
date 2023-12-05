<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Zanex – Bootstrap  Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
        content="admin, dashboard, dashboard ui, admin dashboard template, admin panel dashboard, admin panel html, admin panel html template, admin panel template, admin ui templates, administrative templates, best admin dashboard, best admin templates, bootstrap 4 admin template, bootstrap admin dashboard, bootstrap admin panel, html css admin templates, html5 admin template, premium bootstrap templates, responsive admin template, template admin bootstrap 4, themeforest html">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/images/brand/favicon.ico" />

    <!-- TITLE -->
    <title>Laporan Kecurangan {{ $qrcode->nomor_berkas }}</title>

    <!-- BOOTSTRAP CSS -->
    <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/exif-js"></script>
    <style>
        body {
            font-size: 18px
        }

        .page-break {
            page-break-before: always;
            page-break-after: always;
            page-break-inside: avoid;

        }

        @media screen {
            div.divFooter {
                display: none;
            }

            body {
                display: none;
            }
        }

        @media print {
            div.divFooter {
                position: fixed;
                bottom: 0;
            }

            .stamp {
                position: fixed;
                bottom: 0px;
                top: 75%;
                left: 75%;

            }

            /* @page {
                size: auto;
                margin: 25px;
                counter-increment: page;
            
                @bottom-center {
                    content: counter(page);
                }
            } */
        }

        @media print {
            section.vendorListHeading {
                background-color: #fff !important;
                -webkit-print-color-adjust: exact;
            }
        }

        @media print {
            .vendorListHeading p {
                color: white !important;
            }
        }
    </style>
</head>

<body>
    <?php
    use App\Models\Tracking;
    
    $track = Tracking::where('id_user', $user['id'])->first();
    $scan_url = url('') . '/scanning-secure/' . (string) Crypt::encrypt($qrcode->nomor_berkas);
    // dump($absensi);
    ?>


    <div class="asdf mt-5 row justify-content-center" style="position: relative;width:100%;height:100%;">

        <div class="col-12 text-center mb-3 mt-5">
            @if ($user['profile_photo_path'] == null)
                <img class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover; margin-right: 10px;"
                    src="https://ui-avatars.com/api/?name={{ $user['name'] }}&color=7F9CF5&background=EBF4FF">
            @else
                <img class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover; margin-right: 10px;"
                    src="{{ url('/storage/profile-photos/' . $user['profile_photo_path']) }}">
            @endif
        </div>
        <div class="col-12 my-auto text-center mb-5">
            <div class="mb-0 fw-bold" style="font-size: 30px">{{ $user['name'] }}</div>
            <div style="font-size: 20px">NIK : {{ $user['nik'] }}</div>
        </div>
        <div class="col-12 py-3 text-center ">
            <h1 class="fw-bold mb-0 text-danger" style="font-size: 36px">
                LAPORAN KECURANGAN SAKSI
            </h1>
        </div>
        <div class="col-9 text-center py-3 mb-5 " style="border: 1px black solid">

            <h2>
                {{ $kota->name }}<br>
                Kec
                {{ $kecamatan->name }} / Kel
                {{ $kelurahan->name }} <br>
            </h2>
            <h2 class="text-danger" style="font-size:40px">TPS {{ $tps->number }} <br></h2>

        </div>

        <div class="col-12 text-center mb-5 mt-5">
            <img src="{{ asset('') }}assets/icons/hisuara_new.png" width="350px" alt="">
        </div>

        <div class="col-12 text-center" style="position: absolute; bottom: -90px">
            <h3>PILPRES 2024 {{ $kota->name }}</h3>
        </div>
        {{-- <img src="{{asset('')}}assets/stamp.png" class="img-flluid stamp"
            style="width:150px;height:auto; z-index: 2000;" alt="">
        <div class="row">
            <div class="col-12">
                <center>
                    <h1 class="mt-2 text-danger text-uppercase" style="font-size: 40px;">bukti kecurangan rekapitung
                    </h1>
                    <h5 class="mt-1 mb-1">
                        NO BERKAS : {{ $qrcode->nomor_berkas }}
                    </h5>

                    <img style="width: 350px; height: auto; margin-top:75px"
                        src="{{url('/')}}/images/logo/rekapitung_gold.png" alt="">

                <center>
            </div>
        </div>


        <div class="row justify-content-center border border-dark"
            style="align-items:center;height:100%;margin-top:75px">
            
            <div class="col-6">
                {!! QrCode::size(200)->generate( $scan_url); !!}
            </div>
            <div class="col-6">

                <h5>
                    {{$kota->name }}<br>
                    kec
                    {{$kecamatan->name}} / Kel
                    {{$kelurahan->name}} <br>
                </h5>
                <h2 class="text-danger" style="font-size:40px">TPS {{ $tps->number }} <br></h2>

            </div>
        </div> --}}

    </div>

    <div class="page-break" style="width: 100%; height: 100%;">
        <div class="row">
            <div class="col-auto text-center mb-3">
                @if ($user['profile_photo_path'] == null)
                    <img style="width: 175px; height: 175px; object-fit: cover; margin-right: 10px;"
                        src="https://ui-avatars.com/api/?name={{ $user['name'] }}&color=7F9CF5&background=EBF4FF">
                @else
                    <img style="width: 175px; height: 175px; object-fit: cover; margin-right: 10px;"
                        src="{{ url('/storage/profile-photos/' . $user['profile_photo_path']) }}">
                @endif
            </div>
            <div class="col my-auto text-center">
                <div class="mb-0 fw-bold" style="font-size: 30px">{{ $user['name'] }}</div>
                <div style="font-size: 20px">NIK : {{ $user['nik'] }}</div>
                <div style="font-size: 20px">SAKSI TPS {{ $tps['number'] }}</div>
            </div>
            <div class="col-auto my-auto">
                {!! QrCode::size(125)->generate($scan_url) !!}
            </div>
        </div>

        <div class="row">
            <div class="col-md">
                <div class="row mt-3">
                    <div class="col-12">
                        <b>Detail Akun <i class="fa fa-info-circle"></i></b>
                    </div>

                    <hr class="mt-1 ms-3" style="margin-bottom: 0px; background: #000; height: 5px; width: 300px">

                    <div class="col-12">
                        <table class="table table-stripped">
                            @if ($user['role_id'] == 8)
                                <tr>
                                    <td class="ps-0 pe-2" style="width: 200px">Status</td>
                                    <td class="px-0">:</td>
                                    @if ($user['is_active'] == 2)
                                        <td class="ps-2">Belum Terverifikasi</td>
                                    @else
                                        @if ($tps['setup'] == 'terisi')
                                            <td class="ps-2">Terverifikasi (Sudah Mengirim C1)</td>
                                        @else
                                            <td class="ps-2">Terverifikasi (Belum Mengirim C1)</td>
                                        @endif
                                    @endif
                                </tr>
                            @endif
                            <tr>
                                <td class="ps-0 pe-2" style="width: 200px">Email</td>
                                <td class="px-0">:</td>
                                <td class="ps-2">{{ $user['email'] }}</td>
                            </tr>
                            <tr>
                                <td class="ps-0 pe-2" style="width: 200px">No.Hp</td>
                                <td class="px-0">:</td>
                                <td class="ps-2">{{ $user['no_hp'] }}</td>
                            </tr>
                            <tr>
                                <td class="ps-0 pe-2" style="width: 200px">Alamat</td>
                                <td class="px-0">:</td>
                                <td class="ps-2">{{ $user['address'] }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="row mt-3">
                    <div class="col-12">
                        <b>Lokasi <i class="fa fa-info-circle"></i></b>
                    </div>

                    <hr class="mt-1 ms-3" style="margin-bottom: 0px; background: #000; height: 5px; width: 300px">

                    <div class="col-12">
                        <table class="table">
                            <tr>
                                <td class="ps-0 pe-2" style="width: 200px">Kota</td>
                                <td class="px-0">:</td>
                                <td class="ps-0">{{ $kota->name }}</td>
                            </tr>
                            @if ($user['role_id'] == 8)
                                <tr>
                                    <td class="ps-0 pe-2" style="width: 200px">Kecamatan</td>
                                    <td class="px-0">:</td>
                                    <td class="ps-0">{{ $kecamatan['name'] }}</td>
                                </tr>
                                <tr>
                                    <td class="ps-0 pe-2" style="width: 200px">Kelurahan</td>
                                    <td class="px-0">:</td>
                                    <td class="ps-0">{{ $kelurahan['name'] }}</td>
                                </tr>
                                <tr>
                                    <td class="ps-0 pe-2" style="width: 200px">TPS</td>
                                    <td class="px-0">:</td>
                                    <td class="ps-0">{{ $tps['number'] }}</td>
                                </tr>
                            @endif

                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="row mt-3">
                    <div class="col-12">
                        <b>Meta Data <i class="fa fa-info-circle"></i></b>
                    </div>
                    @if ($track == null)
                        <hr class="mt-1 ms-3" style="margin-bottom: 0px; background: #000; height: 5px; width: 300px">

                        <div class="col-12">
                            <table class="table">
                                <tr>
                                    <td class="ps-0 pe-2" style="width: 200px">Lontitude</td>
                                    <td class="px-0">:</td>
                                    <td class="ps-0">Tidak Terdeteksi</td>
                                </tr>
                                <tr>
                                    <td class="ps-0 pe-2" style="width: 200px">Latitude</td>
                                    <td class="px-0">:</td>
                                    <td class="ps-0">Tidak Terdeteksi</td>
                                </tr>
                                <tr>
                                    <td class="ps-0 pe-2" style="width: 200px">Ip Address</td>
                                    <td class="px-0">:</td>
                                    <td class="ps-0">Tidak Terdeteksi</td>
                                </tr>
                                <tr>
                                    <td class="ps-0 pe-2" style="width: 200px">Tanggal Teregistrasi</td>
                                    <td class="px-0">:</td>
                                    <td class="ps-0">{{ $user['created_at'] }}</td>
                                </tr>
                                @if ($user['role_id'] == 8)
                                    <tr>
                                        <td class="ps-0 pe-2" style="width: 200px">Jam Absen</td>
                                        <td class="px-0">:</td>
                                        <td class="ps-0">{{ $user['created_at'] }}</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    @else
                        <hr class="mt-1 ms-3" style="margin-bottom: 0px; background: #000; height: 5px; width: 300px">

                        <div class="col-12">
                            <table class="table">
                                <tr>
                                    <td class="ps-0 pe-2">Lontitude</td>
                                    <td class="px-0">:</td>
                                    <td class="ps-2">{{ $track['longitude'] }}</td>
                                </tr>
                                <tr>
                                    <td class="ps-0 pe-2">Latitude</td>
                                    <td>:</td>
                                    <td class="ps-2">{{ $track['latitude'] }}</td>
                                </tr>
                                <tr>
                                    <td class="ps-0 pe-2">Ip Address</td>
                                    <td>:</td>
                                    <td class="ps-2">{{ $track['ip_address'] }}</td>
                                </tr>
                                <tr>
                                    <td class="ps-0 pe-2">Tanggal Teregistrasi</td>
                                    <td class="px-0">:</td>
                                    <td class="ps-2">{{ $user['created_at'] }}</td>
                                </tr>
                            </table>
                        </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div style="width:100%;height:100%;" class="page-break">
        <div class="col-12">
            <div class="row">
                {{-- <div class="col-12 mt-2">
                    <b>Foto Potrait & KTP <i class="fa fa-info-circle"></i></b>
                </div> --}}
                <div class="col-4 mt-2 px-1">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0 fw-bold">
                                Foto Admin
                            </h6>
                        </div>
                        <div class="card-body p-0 text-center">
                            @if ($user['profile_photo_path'] == null)
                                <img style="width: 100%; height: 250px; object-fit: cover;"
                                    src="https://ui-avatars.com/api/?name={{ $user['name'] }}&color=7F9CF5&background=EBF4FF">
                            @else
                                <img style="height: 250px; height: 250px; object-fit: cover;"
                                    src="{{ url('/storage/profile-photos/' . $user['profile_photo_path']) }}">
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
                            @if ($user['foto_ktp'] != null)
                                <img style="height: 250px; object-fit: cover; width: 100%"
                                    src="{{ $user['foto_ktp'] }}" alt="">
                            @else
                                <img style="height: 250px; object-fit: cover; width: 100%"
                                    src="https://t-2.tstatic.net/default-2.jpg" alt="">
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @if ($user['role_id'] == 8)
            <div class="col-12">

                <div class="row mb-3">
                    <div class="col-12 mt-2 px-1">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0 fw-bold">
                                    Foto Saksi di Lokasi TPS
                                </h6>
                            </div>
                            <div class="card-body p-0">
                                @if ($absensi['selfie_lokasi'] != null)
                                    <img style="height: 300px; width: 100%; object-fit: cover"
                                        src="{{ $absensi['selfie_lokasi'] }}" alt="">
                                @else
                                    <img style="height: 300px; width: 100%; object-fit: cover"
                                        src="https://t-2.tstatic.net/default-2.jpg" alt="">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-2 px-1">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0 fw-bold">
                                    Foto TPS
                                </h6>
                            </div>
                            <div class="card-body p-0">
                                @if ($tps['foto_lokasi'] != null)
                                    <img style="height: 300px; width: 100%; object-fit: cover"
                                        src="{{ $tps['foto_lokasi'] }}" alt="">
                                @else
                                    <img style="height: 300px; width: 100%; object-fit: cover"
                                        src="https://t-2.tstatic.net/default-2.jpg" alt="">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endif
    </div>

    <div style="width:100%;height:100%;" class="page-break">
        <div class="col-12 text-center mb-3">
            @if ($user['profile_photo_path'] == null)
                <img class="rounded-circle"
                    style="width: 150px; height: 150px; object-fit: cover; margin-right: 10px;"
                    src="https://ui-avatars.com/api/?name={{ $user['name'] }}&color=7F9CF5&background=EBF4FF">
            @else
                <img class="rounded-circle"
                    style="width: 150px; height: 150px; object-fit: cover; margin-right: 10px;"
                    src="{{ url('/storage/profile-photos/' . $user['profile_photo_path']) }}">
            @endif
        </div>
        <div class="col-12 my-auto text-center">
            <div class="mb-0 fw-bold" style="font-size: 30px">{{ $user['name'] }}</div>
            <div style="font-size: 20px">NIK : {{ $user['nik'] }}</div>
            @if ($user['role_id'] == 8)
                <div style="font-size: 20px">SAKSI TPS {{ $tps['number'] }}</div>
            @endif
        </div>
        <div class="col-12 py-3 text-center mb-5">
            <h4 class="fw-bold mb-0 text-danger">
                Laporan Kecurangan Saksi
            </h4>
        </div>
        <div class="col-12 px-0 py-0 mb-3">
            <div class="card">
                <div class="card-header" style="border: 1px #eee solid !important; background-color: #eee">
                    <h5 class="mb-0 card-title">1. Laporan Kecurangan Saksi</h5>
                </div>
                <div class="card-body" style="border: 1px #eee solid !important">
                    <ul class="list-group">
                        @foreach ($list_kecurangan as $item)
                            <li class="list-group-item">{{ $item->text }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 px-0 py-0 mb-3">
            <div class="card">
                <div class="card-header" style="border: 1px #eee solid !important; background-color: #eee">
                    <h5 class="mb-0 card-title">2. Rekomendasi Tindakan Hukum</h5>
                </div>
                <div class="card-body" style="border: 1px #eee solid !important">
                    <ul class="list-group" id="appendDataSolution">

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 px-0 py-0 mb-3">
            <div class="card">
                <div class="card-header" style="border: 1px #eee solid !important; background-color: #eee">
                    <h5 class="mb-0 card-title">3. Pelapor dan Pemeriksa</h5>
                </div>
                <div class="card-body" style="border: 1px #eee solid !important">
                    <table class="table table-bordered">
                        <tr>
                            <td class="fw-bold">
                                <div class="text-center">A. Petugas Kecurangan</div>
                            </td>
                            <td class="fw-bold">
                                <div class="text-center">B. Petugas Verifikator</div>
                            </td>

                            <td class="fw-bold">
                                <div class="text-center">Tanggal Dokumen</div>
                            </td>
                        </tr>
                        <tr>
                            <td> {{ $user->name }}</td>
                            <td> {{ $verifikator->name }}</td>

                            <td rowspan="2" class="align-middle text-center"> {{ $qrcode->created_at }}</td>
                        </tr>
                        <tr>
                            <td> {{ $user->no_hp }}</td>
                            <td> {{ $verifikator->no_hp }}</td>

                        </tr>
                    </table>
                    {{-- <table class="table table-bordered">
                        <tr>
                            <td class="fw-bold">
                                <div class="text-center">Tanggal Dokumen</div>
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="2" class="align-middle text-center"> {{ $qrcode->created_at }}</td>
                        </tr>
                    </table> --}}
                </div>
            </div>
        </div>
        {{-- <center>
            <h1 class="mt-2 text-danger">DOKUMEN REKAPITUNG</h1>
            <center>
                <h2 style="margin-top : -5px;text-transform:uppercase;">Berkas Laporan Kecurangan</h2>
                <h5 style="margin-top : -10px;text-transform:uppercase;">Pilpres 2024</h5>
            </center>
        </center>
        <div class="text-center">
            NO BERKAS : {{ $qrcode->nomor_berkas }}
        </div>
        <center>

            <hr />
            <center>
                <h4>
                    Kota Tanggerang Selatan - Kecamatan
                    {{$kecamatan->name}} - Kelurahan
                    {{$kelurahan->name}}- TPS
                    TPS {{ $tps->name }} <br>
                </h4>
            </center>
            <hr />
            <br />

            <table class="table table-bordered">
                <tr>
                    <td class="font-weight-bold">
                        <div class="text-center">Petugas Saksi</div>
                    </td>
                    <td class="font-weight-bold">
                        <div class="text-center">Petugas Verifikator</div>
                    </td>
                    <td class="font-weight-bold">
                        <div class="text-center">Petugas Validasi Kecurangan</div>
                    </td>
                    <td class="font-weight-bold">
                        <div class="text-center">Tanggal</div>
                    </td>
                </tr>
                <tr>
                    <td> {{$user->name}}</td>
                    <td> {{ $verifikator->name }}</td>
                    <td> {{ $hukum->name }}</td>
                    <td rowspan="2" class="align-middle text-center"> {{ $qrcode->created_at }} </td>
                </tr>
                <tr>
                    <td> {{$user->no_hp}}</td>
                    <td> {{ $verifikator->no_hp}}</td>
                    <td> {{ $hukum->no_hp }}</td>
                </tr>
            </table>
            <table class="table">

                <tr>
                    <td class="font-weight-bold text-danger fw-bolder">
                        Daftar Kecurangan
                    </td>
                </tr>
                @foreach ($list_kecurangan as $item)
                <tr>
                    <td>{{ $item->text }} </td>
                </tr>
                @endforeach
                <tr>
                    <td class="font-weight-bold text-danger fw-bolder border-0">
                        Rekomendasi Tindakan
                    </td>
                </tr>
                <tbody id="appendDataSolution">

                </tbody>

                <script>



                </script>
            </table>
        </center> --}}
    </div>

    <div style="width:100%;height:100%;">

        <div class="row">
            <div class="col-12">
                <div class="card-body p-0" style="border: 1px #eee solid !important">
                    <div class="card-header" style="border: 1px #eee solid !important; background-color: #eee">
                        <h5 class="mb-0 card-title">4. Barang Bukti</h5>
                    </div>
                    <table class="table table-bordered mb-0">
                        <tr>
                            <td class="fw-bold w-50">Foto</td>
                            <td class="fw-bold w-50">Metadata</td>
                        </tr>
                        @foreach ($foto_kecurangan as $bf)
                            <tr>
                                <td class="text-center">
                                    <img class="image" style="height: 250px; object-fit: cover"
                                        src="{{ asset('storage/' . $bf->url) }}"
                                        data-url="{{ asset('storage/' . $bf->url) }}" alt="">
                                </td>
                                <td class="exifResultsPhoto">

                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="fw-bold w-50">Video Kecurangan</td>
                            <td class="fw-bold w-50">Metadata</td>
                        </tr>
                        <tr>
                            <td>
                                <center>
                                    {!! QrCode::size(200)->generate($scan_url) !!}
                                    <div class="mt-3">Scan disini untuk melihat video</div>
                                </center>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="fw-bold w-50">Video Pernyataan Saksi</td>
                            <td class="fw-bold w-50">Metadata</td>
                        </tr>
                        <tr>
                            <td>
                                <center>
                                    {!! QrCode::size(200)->generate($scan_url) !!}
                                    <div class="mt-3">Scan disini untuk melihat video</div>
                                </center>
                            </td>
                            <td></td>
                        </tr>
                    </table>
                    <script>
                        $(document).ready(function() {
                            setTimeout(() => {
                                $(".image").each(function(index) {

                                    var currentImage = this;
                                    EXIF.getData(currentImage, function() {
                                        var exifData = EXIF.getAllTags(this);
                                        var locationInfo = "Image " + (index + 1) + " EXIF Data:<br>";

                                        if (exifData && (exifData.DateTimeOriginal || (exifData
                                                .GPSLatitude && exifData.GPSLongitude))) {
                                            if (exifData.DateTimeOriginal) {
                                                locationInfo += "<b>Date taken</b>: " + exifData
                                                    .DateTimeOriginal + "<br>";
                                            }
                                            if (exifData.GPSLatitude && exifData.GPSLongitude) {
                                                var latitude = exifData.GPSLatitude[0] + exifData
                                                    .GPSLatitude[1] / 60 + exifData.GPSLatitude[2] / 3600;
                                                var longitude = exifData.GPSLongitude[0] + exifData
                                                    .GPSLongitude[1] / 60 + exifData.GPSLongitude[2] / 3600;
                                                locationInfo += "<b>Location</b>: Latitude " + latitude +
                                                    ", Longitude " + longitude + "<br>";
                                            }
                                            if (exifData.Make) {
                                                locationInfo += "<b>Camera Make: </b>" + exifData.Make +
                                                    "<br>";
                                            }
                                            if (exifData.Model) {
                                                locationInfo += "<b>Camera Model: </b>" + exifData.Model +
                                                    "<br>";
                                            }
                                            if (exifData.ApertureValue) {
                                                locationInfo += "<b>Aperture: </b>f/" + exifData
                                                    .ApertureValue + "<br>";
                                            }
                                            if (exifData.ExposureTime) {
                                                locationInfo += "<b>Exposure Time: </b>" + exifData
                                                    .ExposureTime + " sec<br>";
                                            }
                                            if (exifData.ISO) {
                                                locationInfo += "<b>ISO: </b>" + exifData.ISO + "<br>";
                                            }
                                            if (exifData.FocalLength) {
                                                locationInfo += "<b>Focal Length: </b>" + exifData
                                                    .FocalLength + "mm<br>";
                                            }
                                            if (exifData.Flash) {
                                                locationInfo += "<b>Flash: </b>" + exifData.Flash + "<br>";
                                            }
                                            if (exifData.ImageWidth && exifData.ImageHeight) {
                                                locationInfo += "<b>Image Resolution: </b>" + exifData
                                                    .ImageWidth + "x" + exifData.ImageHeight + "<br>";
                                            }
                                            // Include more EXIF tags as needed
                                        } else {
                                            locationInfo += "<b>EXIF data not found</b>";
                                        }

                                        // Display the information in the console to ensure it's being correctly constructed
                                        console.log(locationInfo);

                                        // Find the corresponding .exifResults element related to the current image and update its content
                                        $(currentImage).closest('tr').find('.exifResultsPhoto').html(
                                            locationInfo);
                                    });
                                });
                            }, 100)
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
    </div>


    {{-- @foreach ($foto_kecurangan as $foto)

    <img style="width:100%;" class="d-block page-break" alt="" src="{{url('')}}/storage/{{ $foto->url }}"
        data-bs-holder-rendered="true">

    @endforeach --}}
    @if ($user['role_id'] == 8)
        <div class="row page-content-wrapper page-break">
            <div class="col-md-12 mb-2">
                <h1 class="fs-3 text-center"> Lampiran C1</h1>
            </div>
            <div class="col-md-12">
                <img alt="" class="d-block mx-auto" style="width: 90%; height: 90%;"
                    src="{{ url('') }}/storage/{{ $saksi->c1_images }}" data-bs-holder-rendered="true">
            </div>
        </div>

        <div class="row page-content-wrapper page-break">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body text-center" style="padding: 21.5px">
                        <div class="card-header py-2 text-white bg-dark">
                            <h4 class="mb-0 mx-auto text-black card-title">Data Pemilih dan Hak Pilih (TPS
                                {{ $tps->number }}
                                /
                                Kelurahan {{ $kelurahan->name }})</h4>
                        </div>
                        <table class="table table-striped">
                            <tr>
                                <td class="py-2 text-start" style="width: 50%">Jumlah Hak Pilih (DPT)</td>
                                <td class="py-2" style="width: 5%">:</td>
                                <td class="py-2" style="width: 40%">
                                    {{ $surat_suara != null ? $surat_suara->dpt : '0' }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 text-start" style="width: 50%">Surat Suara Sah</td>
                                <td class="py-2" style="width: 5%">:</td>
                                <td class="py-2" style="width: 40%">
                                    {{ $surat_suara != null ? $surat_suara->surat_suara_sah : '0' }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 text-start" style="width: 50%">Suara Tidak Sah</td>
                                <td class="py-2" style="width: 5%">:</td>
                                <td class="py-2" style="width: 40%">
                                    {{ $surat_suara != null ? $surat_suara->surat_suara_tidak_sah : '0' }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 text-start" style="width: 50%">Jumlah Suara Sah dan Suara Tidak Sah
                                </td>
                                <td class="py-2" style="width: 5%">:</td>
                                <td class="py-2" style="width: 40%">
                                    {{ $surat_suara != null ? $surat_suara->jumlah_sah_dan_tidak : '0' }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 text-start" style="width: 50%">Total Surat Suara</td>
                                <td class="py-2" style="width: 5%">:</td>
                                <td class="py-2" style="width: 40%">
                                    {{ $surat_suara != null ? $surat_suara->total_surat_suara : '0' }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 text-start" style="width: 50%">Sisa Surat Suara</td>
                                <td class="py-2" style="width: 5%">:</td>
                                <td class="py-2" style="width: 40%">
                                    {{ $surat_suara != null ? $surat_suara->sisa_surat_suara : '0' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- <div class="row page-content-wrapper page-break">
        <div class="col-12 px-0">
            <div class="card">
                <div class="card-header" style="background-color: #eee">
                    <h4 class="mb-0 mx-auto text-black card-title">Surat Suara TPS</h4>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mx-auto">
                        <tr>
                            <td>Total Surat Suara</td>
                            <td>:</td>
                            <td>(dummy)</td>
                        </tr>
                        <tr>
                            <td>Jumlah Pemilih</td>
                            <td>:</td>
                            <td>(dummy)</td>
                        </tr>
                        <tr>
                            <td>Jumlah Hak Pilih</td>
                            <td>:</td>
                            <td>(dummy)</td>
                        </tr>
                        <tr>
                            <td>Surat Suara Sah</td>
                            <td>:</td>
                            <td>(dummy)</td>
                        </tr>
                        <tr>
                            <td>Suara Tidak Sah</td>
                            <td>:</td>
                            <td>(dummy)</td>
                        </tr>
                        <tr>
                            <td>Total Suara</td>
                            <td>:</td>
                            <td>(dummy)</td>
                        </tr>
                        <tr>
                            <td>Sisa Surat Suara</td>
                            <td>:</td>
                            <td>(dummy)</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="page-content-wrapper page-break" style="width:100%;height:100%;">
        <div class="col-12">

            <div class="row mt-2 justify-align-center">

                <div class="container">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <h5 class="text-center"><u>SURAT PERNYATAAN</u></h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12">

                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-lg-12">
                                <div class="col-lg-6">
                                    <h6>Yang bertanda tangan dibawah ini :</h6>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md">
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <b>Detail Akun <i class="fa fa-info-circle"></i></b>
                                    </div>

                                    <hr class="mt-1 ms-3"
                                        style="margin-bottom: 0px; background: #000; height: 5px; width: 300px">

                                    <div class="col-12">
                                        <table class="table table-stripped">
                                            <tr>
                                                <td class="ps-0 pe-2" style="width: 200px">NIK</td>
                                                <td class="px-0">:</td>
                                                <td class="ps-2">{{ $user->nik }}</td>
                                            </tr>
                                            <tr>
                                                <td class="ps-0 pe-2" style="width: 200px">Nama</td>
                                                <td class="px-0">:</td>
                                                <td class="ps-2">{{ $user->name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="ps-0 pe-2" style="width: 200px">Alamat</td>
                                                <td class="px-0">:</td>
                                                <td class="ps-2">{{ $user->address }}</td>
                                            </tr>
                                            <tr>
                                                <td class="ps-0 pe-2" style="width: 200px">No Hp</td>
                                                <td class="px-0">:</td>
                                                <td class="ps-2">{{ $user->no_hp }}</td>
                                            </tr>
                                            <tr>
                                                <td class="ps-0 pe-2" style="width: 200px">Email</td>
                                                <td class="px-0">:</td>
                                                <td class="ps-2">{{ $user->email }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @if ($user['role_id'] == 8)
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <b>Lokasi <i class="fa fa-info-circle"></i></b>
                                        </div>

                                        <hr class="mt-1 ms-3"
                                            style="margin-bottom: 0px; background: #000; height: 5px; width: 300px">

                                        <div class="col-12">
                                            <table class="table">
                                                <tr>
                                                    <td class="ps-0 pe-2" style="width: 200px">Kecamatan</td>
                                                    <td class="px-0">:</td>
                                                    <td class="ps-0">{{ $kecamatan->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="ps-0 pe-2" style="width: 200px">Kelurahan</td>
                                                    <td class="px-0">:</td>
                                                    <td class="ps-0">{{ $kelurahan->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="ps-0 pe-2" style="width: 200px">TPS</td>
                                                    <td class="px-0">:</td>
                                                    <td class="ps-0">{{ $tps->number }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="ps-0 pe-2" style="width: 200px">Kota</td>
                                                    <td class="px-0">:</td>
                                                    <td class="ps-0">{{ $kota->name }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-12 text-justify" style="line-height:1.8; text-align: justify">
                                {{ $surat_pernyataan->deskripsi }}
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <b>Tanggal Kirim </b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 text-left">
                                <p>Yang Membuat Pernyataan Ini:</p>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-12 text-left">
                                <p class="mt-5"><u> {{ $user->name }}</u></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 text-center mt-4 py-3 mx-auto"
                    style="font-size: 14px; border: 1px #f82649 solid; width: 95%">
                    <i>Laporan Ini Dicetak Oleh Komputer Dan Tidak Memerlukan Tanda Tangan.
                        Berkas Terlampir</i>
                </div>
            </div>

        </div>
    </div>

    {{-- <div class="divFooter" style="font-size: 18px">{{ $qrcode->nomor_berkas }} <br /> <small class="text-danger">
            Dokumen ini telah dihasilkan
            dari rekapitung.id dengan nomor berkas : {{ $qrcode->nomor_berkas }}
            Untuk Paslon Muhammad - Saraswati. Hasil cetak dokumen ini dapat diverifikasi berdasarkan kode
            barcode di rekapitung.id </small> </div> --}}

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
    </script>
    <script>
        setTimeout(function() {
            let uniqueData = [
                @foreach ($list_kecurangan as $item)
                    '{{ $item->solution }} | {{ $item->kode }}',
                @endforeach
            ];

            uniqueArray = uniqueData.filter(function(item, pos) {
                return uniqueData.indexOf(item) == pos;
            });
            uniqueArray.forEach(function(item, index) {
                $('#appendDataSolution').append(`
        <tr>
            <td>
                ${item}    
            </td>
        </tr>
        `)
            });
        }, 200)


        function afterPrintOrDelay() {
            @if ($qrcode->mkPrint != null)
            location.href = "{{url()->previous()}}";
            @else
              location.href = `{{url("administrator/update-Status-printMk")}}/{{Crypt::encrypt($kecurangan->id)}}`;
            @endif
        }
        if (window.matchMedia) {
            var mediaQueryList = window.matchMedia('print');
            mediaQueryList.addListener(function(mql) {
                if (!mql.matches) {
                    afterPrintOrDelay();
                }
            });
        }

        window.onafterprint = function() {
            afterPrintOrDelay();
        };

        window.print();

        setTimeout(afterPrintOrDelay, 5000); 
    </script>
</body>

</html>
