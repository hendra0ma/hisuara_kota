<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Zanex – Bootstrap  Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords" content="admin, dashboard, dashboard ui, admin dashboard template, admin panel dashboard, admin panel html, admin panel html template, admin panel template, admin ui templates, administrative templates, best admin dashboard, best admin templates, bootstrap 4 admin template, bootstrap admin dashboard, bootstrap admin panel, html css admin templates, html5 admin template, premium bootstrap templates, responsive admin template, template admin bootstrap 4, themeforest html">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/images/brand/favicon.ico" />

    <!-- TITLE -->
    <title>Zanex – Bootstrap Admin & Dashboard Template</title>

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

    <!-- SELECT2 CSS -->
    <link href="../../assets/plugins/select2/select2.min.css" rel="stylesheet" />

    <!-- DATA TABLE CSS -->
    <link href="../../assets/plugins/datatable/css/dataTables.bootstrap5.css" rel="stylesheet" />
    <link href="../../assets/plugins/datatable/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link href="../../assets/plugins/datatable/responsive.bootstrap5.css" rel="stylesheet" />

    <!-- INTERNAL SELECT2 CSS -->
    <link href="../../assets/plugins/select2/select2.min.css" rel="stylesheet" />

    <!-- P-scroll bar css-->
    <link href="../../assets/plugins/p-scroll/perfect-scrollbar.css" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="../../assets/css/icons.css" rel="stylesheet" />

    <!-- SIDEBAR CSS -->
    <link href="../../assets/plugins/sidebar/sidebar.css" rel="stylesheet">

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="../../assets/colors/color1.css" />

</head>

<body class="app sidebar-mini">

    <div class="container mt-5">
        <h1 class="text-center"><img class="mt-5" style="width: 100px;" src="../../assets/images/brand/logo.png" alt="">
        </h1>
        <h4 class="text-center">KOTA TANGERANG SELATAN <br>
            TAHUN 2020</h4>
        <div class="card mt-5">
            <div class="card-header">
                <h4 class="card-title text-center mx-auto">Kecurangan (Fraud)</h4>

            </div>
            <div class="card-body">
                <div class="row justify-content-center">


                    @foreach ($qrcode as $item)
                    <?php $scan_url = "" . url('/') . "/scanning-secure/" . Crypt::encrypt($item['nomor_berkas']) . ""; ?>


                    <div class="col-md-3">
                        <a href="{{$scan_url}}">
                            <div class="card">
                                <div class="card-body">
                                    {!! QrCode::size(200)->generate($scan_url); !!}
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach


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

    <!-- C3 CHART JS -->
    <script src="../../assets/plugins/charts-c3/d3.v5.min.js"></script>
    <script src="../../assets/plugins/charts-c3/c3-chart.js"></script>

    <!-- INTERNAL SELECT2 JS -->
    <script src="../../assets/plugins/select2/select2.full.min.js"></script>
    <script src="../../assets/plugins/sweet-alert/sweetalert.min.js"></script>

    <!-- DATA TABLE JS-->
    <script src="../../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="../../assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
    <script src="../../assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
    <script src="../../assets/plugins/datatable/js/buttons.bootstrap5.min.js"></script>
    <script src="../../assets/plugins/datatable/js/jszip.min.js"></script>
    <script src="../../assets/plugins/datatable/pdfmake/pdfmake.min.js"></script>
    <script src="../../assets/plugins/datatable/pdfmake/vfs_fonts.js"></script>
    <script src="../../assets/plugins/datatable/js/buttons.html5.min.js"></script>
    <script src="../../assets/plugins/datatable/js/buttons.print.min.js"></script>
    <script src="../../assets/plugins/datatable/js/buttons.colVis.min.js"></script>
    <script src="../../assets/plugins/datatable/dataTables.responsive.min.js"></script>
    <script src="../../assets/plugins/datatable/responsive.bootstrap5.min.js"></script>
    <script src="../../assets/js/table-data.js"></script>

</body>

</html>