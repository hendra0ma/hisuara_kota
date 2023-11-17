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
    <title>Rekapitung</title>

    <!-- BOOTSTRAP CSS -->
    <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="../../assets/css/style.css" rel="stylesheet" />
    <link href="../../assets/css/dark-style.css" rel="stylesheet" />
    <link href="../../assets/css/skin-modes.css" rel="stylesheet" />

    <!-- SIDE-MENU CSS -->
    <link href="../../assets/css/sidemenu.css" rel="stylesheet" id="sidemenu-theme">

    <!--C3 CHARTS CSS -->
    <link href="../../assets/plugins/charts-c3/c3-chart.css" rel="stylesheet" />

    <!-- P-scroll bar css-->
    <link href="../../assets/plugins/p-scroll/perfect-scrollbar.css" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="../../assets/css/icons.css" rel="stylesheet" />

    <!-- SIDEBAR CSS -->
    <link href="../../assets/plugins/sidebar/sidebar.css" rel="stylesheet">

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="../../assets/colors/color1.css" />

    <!-- TABS STYLES -->
    <link href="../../assets/plugins/tabs/tabs.css" rel="stylesheet" />
</head>

<body class="app sidebar-mini">

    <div class="container-md">

        <div class="row mt-5 justify-content-center">
            <div class="col-md-12 text-center">
                {{-- <h1 class="mx-auto fw-bold">DOKUMEN EFBR REKAPITUNG</h1> --}}
                <h1 class="mx-auto fw-bold mb-0">BUKTI KECURANGAN</h1>
            </div>
            <div class="col-md-6 mt-5">
                {{-- <div class="card">
                    <div class="card-header mx-auto text-center">
                        <div class="row">
                            <div class="col-md-12">
                                <h5>{{$kota['name']}}, </h5>
                            </div>
                            <div class="col-md-12">
                                <h5>KECAMATAN {{$kecamatan['name']}}, KELURAHAN</h5>
                            </div>
                            <div class="col-md-12">
                                <h5>{{$kelurahan['name']}}</h5>
                            </div>
                            <div class="col-md-12">
                                <h3 class="text-danger">TPS {{$data_tps->number}}</h3>
                            </div>
                            <div class="col-md-12">
                                <p>No. Dokumen: {{$qrcode_hukum['nomor_berkas']}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- nav options -->
                        <ul class="nav nav-tabs mb-3 shadow-sm row" id="pills-tab" role="tablist">
                            <li class="nav-item col-lg-4">
                                <a class="nav-link rounded-0 w-100 active" id="pills-home-tab" data-toggle="pill"
                                    href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
                                    <div class="mx-auto">
                                        Detail
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item col-lg-4">
                                <a class="nav-link rounded-0 w-100" id="pills-profile-tab" data-toggle="pill"
                                    href="#pills-profile" role="tab" aria-controls="pills-profile"
                                    aria-selected="false">
                                    <div class="mx-auto">
                                        Kecurangan
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item col-lg-4">
                                <a class="nav-link rounded-0 w-100" id="pills-contact-tab" data-toggle="pill"
                                    href="#pills-contact" role="tab" aria-controls="pills-contact"
                                    aria-selected="false">
                                    <div class="mx-auto">
                                        Surat Pernyataan
                                    </div>
                                </a>
                            </li>
                        </ul> <!-- content -->

                        <div class="tab-content" id="pills-tabContent p-3">

                            <!-- 1st card -->
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab">
                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <td>Nama Saksi</td>
                                        <td>{{$qrcode_hukum['name']}}</td>
                                    </tr>
                                    <tr>
                                        <td>No Hp Saksi</td>
                                        <td>{{$qrcode_hukum['no_hp']}}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Admin Verifikasi</td>
                                        <td>{{$verifikator_id['name']}}</td>
                                    </tr>
                                    <tr>
                                        <td>No Hp Admin Verifikasi</td>
                                        <td>{{$verifikator_id['no_hp']}}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Saksi Mengirim Data</td>
                                        <td>{{$qrcode_hukum['tanggal_masuk']}}</td>
                                    </tr>
                                </table>
                            </div>

                            <!-- 2nd card -->
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                aria-labelledby="pills-profile-tab">

                                <ul class="nav nav-tabs mb-3 shadow-sm" id="pills-tab" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active" id="pills-home-tab"
                                            data-toggle="pill" href="#deskripsi" role="tab" aria-controls="pills-home"
                                            aria-selected="true">Deskripsi</a> </li>
                                    <li class="nav-item"> <a class="nav-link" id="pills-profile-tab" data-toggle="pill"
                                            href="#foto" role="tab" aria-controls="pills-profile"
                                            aria-selected="false">Foto</a> </li>
                                    <li class="nav-item"> <a class="nav-link" id="pills-contact-tab" data-toggle="pill"
                                            href="#video" role="tab" aria-controls="pills-contact"
                                            aria-selected="false">Video</a> </li>
                                </ul> <!-- content -->

                                <div class="tab-content" id="pills-tabContent p-3">

                                    <!-- 1st card -->
                                    <div class="tab-pane fade show active" id="deskripsi" role="tabpanel"
                                        aria-labelledby="pills-home-tab">

                                        <h2>Kecurangan</h2>

                                        <ul class="list-style-1">
                                            @foreach ($list as $item)
                                            <li>{{$item['text']}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade show" id="foto" role="tabpanel"
                                        aria-labelledby="pills-home-tab">
                                        @foreach ($bukti_foto as $item)
                                        <img class="d-block w-100" alt="" src="{{asset('storage')}}/{{ $item->url }}"
                                            data-bs-holder-rendered="true">

                                        @endforeach
                                    </div>
                                    @foreach ($bukti_vidio as $item)
                                    <div class="tab-pane fade show" id="video" role="tabpanel"
                                        aria-labelledby="pills-home-tab">
                                        <video style="width: 100%; height: auto;" controls>
                                            <source src="{{asset('storage/'.$item->url)}}" type=video/ogg>
                                            <source src="{{asset('storage/'.$item->url)}}" type=video/mp4>
                                        </video>
                                    </div>
                                    @endforeach

                                </div>

                            </div> <!-- 3nd card -->

                            <div class="tab-pane fade third" id="pills-contact" role="tabpanel"
                                aria-labelledby="pills-contact-tab">
                                <h1>Surat Pernyataan</h1>
                                <b>Yang bertanda tangan dibawah ini:</b>

                                <table class="table mt-2">
                                    <tr>
                                        <td>NIK</td>
                                        <td>:</td>
                                        <td>{{$qrcode_hukum['nik']}}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td>{{$qrcode_hukum['name']}}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td>{{$qrcode_hukum['address']}}</td>
                                    </tr>
                                    <tr>
                                        <td>No. Hp</td>
                                        <td>:</td>
                                        <td>{{$qrcode_hukum['no_hp']}}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td>{{$qrcode_hukum['email']}}</td>
                                    </tr>
                                    <tr>
                                        <td>TPS</td>
                                        <td>:</td>
                                        <td>{{$data_tps->number}}</td>
                                    </tr>
                                    <tr>
                                        <td>Kelurahan</td>
                                        <td>:</td>
                                        <td>{{$kelurahan['name']}}</td>
                                    </tr>
                                    <tr>
                                        <td>Kecamatan</td>
                                        <td>:</td>
                                        <td>{{$kecamatan['name']}}</td>
                                    </tr>
                                    <tr>
                                        <td>Kota/Kab</td>
                                        <td>:</td>
                                        <td>{{$kota['name']}}</td>
                                    </tr>
                                </table>
                                {!! html_entity_decode($qrcode_hukum['deskripsi']) !!}
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="card">
                    <div class="card-header">
                        <div class="row w-100">
                            <div class="col mt-2">
                                <div class="media">
                                    @if ($user['profile_photo_path'] == NULL)
                                    <img class="rounded-circle"
                                        style="width: 100px; height: 100px; object-fit: cover; margin-right: 10px;"
                                        src="https://ui-avatars.com/api/?name={{ $user['name'] }}&color=7F9CF5&background=EBF4FF">
                                    @else
                                    <img class="rounded-circle"
                                        style="width: 100px; height: 100px; object-fit: cover; margin-right: 10px;"
                                        src="{{url("/storage/profile-photos/".$user['profile_photo_path']) }}">
                                    @endif

                                    <div class="media-body my-auto">
                                        <h5 class="mb-0">{{ $user['name'] }}</h5>
                                        NIK : {{ $user['nik'] }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-auto pt-2 my-auto px-1">
                                <a href="https://wa.me/{{$user->no_hp}}" class="btn btn-success text-white">
                                    Hubungi</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body mx-auto text-center">
                        <div class="row">
                            <div class="col-md-12">
                                <h5>{{$kota['name']}}, </h5>
                            </div>
                            <div class="col-md-12">
                                <h5>KECAMATAN {{$kecamatan['name']}}, KELURAHAN</h5>
                            </div>
                            <div class="col-md-12">
                                <h5>{{$kelurahan['name']}}</h5>
                            </div>
                            <div class="col-md-12">
                                <h3 class="text-danger">TPS {{$data_tps->number}}</h3>
                            </div>
                            <div class="col-md-12">
                                <p class="mb-0">No. Dokumen: {{$qrcode_hukum['nomor_berkas']}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <td class="fw-bold bg-primary text-white">
                                            <div class="text-center">Petugas Saksi</div>
                                        </td>
                                        <td class="fw-bold bg-primary text-white">
                                            <div class="text-center">Petugas Verifikator</div>
                                        </td>
                                        <td class="fw-bold bg-primary text-white">
                                            <div class="text-center">Petugas Validasi Kecurangan</div>
                                        </td>
                                        {{-- <td class="fw-bold bg-primary text-white">
                                            <div class="text-center">Tanggal Dokumen</div>
                                        </td> --}}
                                    </tr>
                                    <tr>
                                        <td> {{ $qrcode_hukum->name }}</td>
                                        <td> {{ $verifikator_id->name }}</td>
                                        <td> {{ $hukum_id->name }}</td>
                                        {{-- <td rowspan="2" class="align-middle text-center"> {{
                                            $qrcode_hukum->created_at }}</td> --}}
                                    </tr>
                                    <tr>
                                        <td> {{ $qrcode_hukum->no_hp }}</td>
                                        <td> {{ $verifikator_id->no_hp}}</td>
                                        <td> {{ $hukum_id->no_hp }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md">
                                <h1 class="mb-0">Laporan Kecurangan</h1>
                                <hr style="border: 1px solid black">
                                <ul class="list-style-1">
                                    @foreach ($list as $item)
                                    <li>{{$item['text']}}</li>
                                    @endforeach
                                </ul>


                                <h1 class="mt-5 mb-0">Bukti Foto dan Video</h1>
                                <hr style="border: 1px solid black">
                                
                                <div class="row">
                                    @foreach ($bukti_foto as $item)
                                    <div class="col-12 mb-2">
                                        <img class="d-block w-100" alt=""
                                            src="{{asset('storage')}}/{{ $item->url }}"
                                            data-bs-holder-rendered="true">
                                    </div>
                                    @endforeach
                                </div>




                                @foreach ($bukti_vidio as $item)
                                <div class="mt-2 mb-2" id="video" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <video style="width: 100%; height: auto;" controls>
                                        <source src="{{asset('storage/'.$item->url)}}" type=video/ogg>
                                        <source src="{{asset('storage/'.$item->url)}}" type=video/mp4>
                                    </video>
                                </div>
                                @endforeach

                                <h1 class="mt-5 mb-0">Bukti Rekaman Video</h1>
                                <hr style="border: 1px solid black">
                                <div id="carouselFotoKecurangan" class="carousel slide mt-2 mb-2"
                                    data-bs-ride="carousel">
                                    {{-- @foreach ($bukti_vidio as $item) --}}
                                    <div class="mt-2 mb-2" id="video" role="tabpanel" aria-labelledby="pills-home-tab">
                                        <video style="width: 100%; height: auto;" controls>
                                            <source src="#" type=video/ogg>
                                            <source src="#" type=video/mp4>
                                        </video>
                                    </div>
                                    {{-- @endforeach --}}

                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-12s">
                                    <h1 class="mb-0 text-center">Surat Pernyataan</h1>
                                    <hr style="border: 1px solid black">
                                    <b>Yang bertanda tangan dibawah ini:</b>
                                    <table class="table mt-2">
                                        <tr>
                                            <td>NIK</td>
                                            <td>:</td>
                                            <td>{{$qrcode_hukum['nik']}}</td>
                                        </tr>
                                        <tr>
                                            <td>Nama</td>
                                            <td>:</td>
                                            <td>{{$qrcode_hukum['name']}}</td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>:</td>
                                            <td>{{$qrcode_hukum['address']}}</td>
                                        </tr>
                                        <tr>
                                            <td>No. Hp</td>
                                            <td>:</td>
                                            <td>{{$qrcode_hukum['no_hp']}}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>:</td>
                                            <td>{{$qrcode_hukum['email']}}</td>
                                        </tr>
                                        <tr>
                                            <td>TPS</td>
                                            <td>:</td>
                                            <td>{{$data_tps->number}}</td>
                                        </tr>
                                        <tr>
                                            <td>Kelurahan</td>
                                            <td>:</td>
                                            <td>{{$kelurahan['name']}}</td>
                                        </tr>
                                        <tr>
                                            <td>Kecamatan</td>
                                            <td>:</td>
                                            <td>{{$kecamatan['name']}}</td>
                                        </tr>
                                        <tr>
                                            <td>Kota/Kab</td>
                                            <td>:</td>
                                            <td>{{$kota['name']}}</td>
                                        </tr>
                                    </table>
                                    {!! html_entity_decode($qrcode_hukum['deskripsi']) !!}
                                </div>
                                <div class="col-md-12 text-center py-3 mt-3" style="border: 1px solid #45aaf2;">
                                    <div class="row align-items-center">
                                        <div class="col-md-12">
                                            <h4 class="card-title mb-1">Mengesahkan</h4>
                                            <p class="mb-0">Data Laporan Kecurangan</p>
                                            <p class="mb-0">Tanggal, 14 Februari 2024</p>
                                            <p class="mb-5">Dalam Rangka Gugatan Pemilu Presiden Tahun 2024</p>
                                            <p class="mb-0">{{$verifikator_id['name']}}</p>
                                            <p class="mb-0">Validator Kecurangan</p>
                                        </div>
                                        <div class="col-md">
                                            {{-- <img style="width: 150px" src="{{url('/')}}/assets/stamp.png" alt="">
                                            --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- JQUERY JS -->
        <script src="../../assets/js/jquery.min.js"></script>

        <!-- BOOTSTRAP JS -->
        <script src="../../assets/plugins/bootstrap/js/popper.min.js"></script>
        <script src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

        <!-- SPARKLINE JS-->
        <script src="../../assets/js/jquery.sparkline.min.js"></script>

        <!-- Select2 js-->
        <script src="../../assets/plugins/select2/js/select2.min.js"></script>

        <!-- SIDE-MENU JS -->
        <script src="../../assets/plugins/sidemenu/sidemenu.js"></script>

        <!-- Perfect SCROLLBAR JS-->
        <script src="../../assets/plugins/p-scroll/perfect-scrollbar.js"></script>
        <script src="../../assets/plugins/p-scroll/pscroll.js"></script>
        <script src="../../assets/plugins/p-scroll/pscroll-1.js"></script>

        <!-- SIDEBAR JS -->
        <script src="../../assets/plugins/sidebar/sidebar.js"></script>

        <!-- CUSTOM JS-->
        <script src="../../assets/js/custom.js"></script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

        <!--- TABS JS -->
        <script src="../../assets/plugins/tabs/jquery.multipurpose_tabcontent.js"></script>
        <script src="../../assets/plugins/tabs/tab-content.js"></script>

</body>

</html>