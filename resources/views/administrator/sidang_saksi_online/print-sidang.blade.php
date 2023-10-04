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

    <!--- FONT-ICONS CSS -->
    <link href="../../assets/css/icons.css" rel="stylesheet" />


    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="../../assets/colors/color1.css" />


  

    <script src="../../assets/js/jquery.min.js"></script>

    <link rel="stylesheet" href="https://raw.githack.com/thdoan/magnify/master/dist/css/magnify.css">

    <!-- GALLERY CSS -->
    <link href="../../assets/plugins/gallery/gallery.css" rel="stylesheet">

</head>

<div class="app sidebar-mini">

    <div class="card">
      
        <div class="card-body">

            <div class="row justify-content-center">
            <div class="col-md-12 text-center mb-2">
                    <img style="width: 175px" src="{{url('/')}}/assets/images/brand/logo-2.png" alt="">
                </div>
                <div class="col-md-12 text-center">
                    <h5>{{$kota['name']}}, </h5>
                </div>
                <div class="col-md-12 text-center">
                    <h5>KECAMATAN {{$kecamatan['name']}}, KELURAHAN</h5>
                </div>
                <div class="col-md-12 text-center">
                    <h5>{{$kelurahan['name']}}</h5>
                </div>
                <div class="col-md-12 text-center">
                    <h3 class="text-danger">TPS {{$data_tps->number}}</h3>
                </div>
                <div class="col-md-12 text-center">
                    <p>No. Dokumen: {{$qrcode_hukum['nomor_berkas']}}</p>
                </div>
                <div class="col-md">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <td class="fw-bold">Petugas Saksi</td>
                            <td class="fw-bold">Petugas Verifikator</td>
                            <td class="fw-bold">Petugas Validasi Kecurangan</td>
                        </tr>
                        <tr>
                            <td>{{$qrcode_hukum['name']}}</td>
                            <td>{{$verifikator_id['name']}}</td>
                            <td>{{$hukum_id['name']}}</td>
                        </tr>
                        <tr>
                            <td>{{$qrcode_hukum['no_hp']}}</td>
                            <td>{{$verifikator_id['no_hp']}}</td>
                            <td>{{$hukum_id['no_hp']}}</td>
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
                    <div id="carouselFotoKecurangan" class="carousel slide mt-2 mb-2" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php $i = 1; ?>
                            @foreach ($bukti_foto as $item)
                            <div class="carousel-item {{($i == 1)?'active':""}}">
                                <?php $i++; ?>
                                <img class="d-block w-100" alt="" src="{{asset('storage')}}/{{ $item->url }}"
                                    data-bs-holder-rendered="true">
                            </div>
                            @endforeach

                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselFotoKecurangan"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselFotoKecurangan"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>




                    @foreach ($bukti_vidio as $item)
                    <div class="mt-2 mb-2" id="video" role="tabpanel" aria-labelledby="pills-home-tab">
                        <video style="width: 100%; height: auto;" controls>
                            <source src="{{asset('storage/'.$item->url)}}" type=video/ogg> <source
                                src="{{asset('storage/'.$item->url)}}" type=video/mp4> </video> </div> @endforeach
                                </div> </div> <hr>

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
                                <div class="col-md-8 text-center py-3 mt-3"
                                    style="border: 1px solid #45aaf2; background: #45aaf236;">
                                    <div class="row align-items-center">
                                        <div class="col-md-7">
                                            <h4 class="card-title mb-1">Mengesahkan</h4>
                                            <p class="mb-0">Data Laporan Kecurangan</p>
                                            <p class="mb-0">Tanggal, 14 Februari 2024</p>
                                            <p class="mb-5">Dalam Rangka Gugatan Pemilu Presiden Tahun 2024</p>
                                            <p class="mb-0">{{$verifikator_id['name']}}</p>
                                            <p class="mb-0">Validator Kecurangan</p>
                                        </div>
                                        <div class="col-md">
                                            <img style="width: 150px" src="{{url('/')}}/assets/stamp.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>

            </div>
        </div>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
        </script>

        <!--- TABS JS -->
        <script src="../../assets/plugins/tabs/jquery.multipurpose_tabcontent.js"></script>
        <script src="../../assets/plugins/tabs/tab-content.js"></script>

        <!-- JQUERY JS -->
        <script src="../../assets/js/jquery.min.js"></script>

        <script>
            // setTimeout(function() {
            window.print();
            window.onafterprint = back;

            function back() {
                window.close()
            }



            // },300)

        </script>
        <!-- Internal Chat js-->
        </body>

</html>
