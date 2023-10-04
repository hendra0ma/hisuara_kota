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
    <link rel="shortcut icon" type="image/x-icon" href="{{url('/')}}/assets/images/brand/favicon.ico" />

    <!-- TITLE -->
    <title>Rekapitung</title>
    <!-- FILE UPLODE CSS -->
    <link href="{{url('/')}}/assets/plugins/fileuploads/css/fileupload.css" rel="stylesheet" type="text/css" />

    <!-- SELECT2 CSS -->

    <!-- INTERNAL Fancy File Upload css -->
    <link href="{{url('/')}}/assets/plugins/fancyuploder/fancy_fileupload.css" rel="stylesheet" />
    <!-- BOOTSTRAP CSS -->
    <link href="{{url('/')}}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="{{url('/')}}/assets/css/style.css" rel="stylesheet" />
    <link href="{{url('/')}}/assets/css/dark-style.css" rel="stylesheet" />
    <link href="{{url('/')}}/assets/css/skin-modes.css" rel="stylesheet" />

    <!-- SIDE-MENU CSS -->
    <link href="{{url('/')}}/assets/css/sidemenu.css" rel="stylesheet" id="sidemenu-theme">

    <!--C3.JS CHARTS CSS -->
    <link href="{{url('/')}}/assets/plugins/charts-c3/c3-chart.css" rel="stylesheet" />

    <!-- P-scroll bar css-->
    <link href="{{url('/')}}/assets/plugins/p-scroll/perfect-scrollbar.css" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="{{url('/')}}/assets/css/icons.css" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{url('/')}}/assets/colors/color1.css" />

    <style>
        .mobile-phone {
            margin: auto;
            margin-top: 170px;
            padding: 10px 10px 30px;
            width: 350px;
            height: 650px;
            box-shadow: 0 0 20px #000000;
            border-radius: 30px;
        }

        .screen {
            width: 100%;
            height: 100%;
            background: #f2f2f2;
            border-radius: 30px;
            overflow-y: auto;
        }

        .brove {
            width: 150px;
            height: 20px;
            background: white;
            position: absolute;
            margin: 0 100px;
            border-radius: 0 0 20px 20px;
        }

        .speaker {
            width: 60px;
            height: 5px;
            background: #d2d2d2;
            display: block;
            margin: auto;
            margin-top: 5px;
            border-radius: 20px;
        }

    </style>

</head>

<body class="">

    <div class='mobile-phone'>
        <div class='brove' style="z-index: 100"><span class='speaker'></span></div>
        <div class='screen pt-5 px-3'>
            <!-- As a link -->
            <!-- <nav class="navbar bg-primary py-1">
                <b class="navbar-brand mx-auto text-white fw-bold" style="font-size: 16px">Quickcount</b>
            </nav> -->

            <h1 class="text-center fs-5">
                <img src="{{url('/')}}/assets/images/brand/logo_gold.png" class="hadow-4 mb-3 mt-3"
                style="width: 150px;" alt="Avatar" />
                 <br>  <span class="fw-bold">
                 Quick Count
                     </span>
            </h1>
            <h4> Halo Enumerator</h4>
            <div class="row no-gutters">
                <div class="col-lg-12 mt-2">
                    <div class="input-group">
                        <div class="input-group-text">
                            Suara 01
                        </div><!-- input-group-text -->
                        <input class="form-control ui-timepicker-input" id="tpBasic" placeholder="Suara 01" type="text"
                            autocomplete="off">
                    </div>
                </div>
                <div class="col-lg-12 mt-2">
                    <div class="input-group">
                        <div class="input-group-text">
                            Suara 02
                        </div><!-- input-group-text -->
                        <input class="form-control ui-timepicker-input" id="tpBasic" placeholder="Suara 02" type="text"
                            autocomplete="off">
                    </div>
                </div>
                <div class="col-lg-12 mt-2">
                    <div class="input-group">
                        <div class="input-group-text">
                            Suara 03
                        </div><!-- input-group-text -->
                        <input class="form-control ui-timepicker-input" id="tpBasic" placeholder="Suara 03" type="text"
                            autocomplete="off">
                    </div>
                </div>
                <div class="col-lg-12 mt-2">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Upload Foto C1</h4>
                        </div>
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1>
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#modelId">
                                            <i class="mdi mdi-camera"></i>
                                        </a>
                                    </h1>
                                </div>
                                <div class="col-md-12">
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#modelId">Ambil Foto</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <input type="submit" name="" class="btn btn-block btn-primary" value="Kirim" id="send">
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Peringatan!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Fitur hanya bisa dibuka melalui hp android.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="exampleModalLabel">Panduan Enumerator</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-justify">
                <p>
                Metode Quick Count ini menggunakan Stratified Cluster Random Sampling. Jumlah sampel yang diambil adalah 10% dari total TPS yang tersebar merata secara proporsional di setiap kab/kota pemilihan. Desa/kelurahan di setiap Daerah Pemilihan dipilih secara acak dan proporsional. Di masing-masing desa/kelurahan terpilih, dipilih TPS secara acak. Di TPS terpilih, enumerator melakukan input data hasil perolehan suara Pilpres dan Pileg kemudian mengirimkannya ke data centre. Quick Count ini memiliki margin of error +/- 1% pada tingkat kepercayaan 99%.
                </p>

                <a href="https://quickcount.rekapitung.id"class="mt-2 fw-bold">Lebih lanjut tentang Quick Count</a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Oke</button>

                </div>
            </div>
        </div>
    </div>

    <!-- End PAGE -->
    <!-- FILE UPLOADES JS -->
    <script src="{{url('/')}}/assets/plugins/fileuploads/js/fileupload.js"></script>
    <script src="{{url('/')}}/assets/plugins/fileuploads/js/file-upload.js"></script>
    <!-- INTERNAL File-Uploads Js-->
    <script src="{{url('/')}}/assets/plugins/fancyuploder/jquery.ui.widget.js"></script>
    <script src="{{url('/')}}/assets/plugins/fancyuploder/jquery.fileupload.js"></script>
    <script src="{{url('/')}}/assets/plugins/fancyuploder/jquery.iframe-transport.js"></script>
    <script src="{{url('/')}}/assets/plugins/fancyuploder/jquery.fancy-fileupload.js"></script>
    <script src="{{url('/')}}/assets/plugins/fancyuploder/fancy-uploader.js"></script>
    <!-- JQUERY JS -->
    <script src="{{url('/')}}/assets/js/jquery.min.js"></script>

    <!-- BOOTSTRAP JS -->
    <script src="{{url('/')}}/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="{{url('/')}}/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- SPARKLINE JS-->
    <script src="{{url('/')}}/assets/js/jquery.sparkline.min.js"></script>

    <!-- CHART-CIRCLE JS-->
    <script src="{{url('/')}}/assets/js/circle-progress.min.js"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="{{url('/')}}/assets/plugins/p-scroll/perfect-scrollbar.js"></script>

    <!-- INPUT MASK JS-->
    <script src="{{url('/')}}/assets/plugins/input-mask/jquery.mask.min.js"></script>

    <!-- CUSTOM JS-->
    <script src="{{url('/')}}/assets/js/custom.js"></script>

    <script>
        $(document).ready(function () {
            $("#exampleModal").modal('show');
        });

    </script>

</body>

</html>
