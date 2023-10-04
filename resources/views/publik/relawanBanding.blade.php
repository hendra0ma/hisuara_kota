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

    <link href="../../assets/plugins/sweet-alert/sweetalert.css" rel="stylesheet" />

    <style>
        .tooltip {
            visibility: visible;
        }

        .tooltip .tooltiptext {
            visibility: hidden;
            width: 120px;
            background-color: black;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;
            position: absolute;
            z-index: 1;
            bottom: 150%;
            left: 50%;
            margin-left: -60px;
        }

        .tooltip .tooltiptext::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: black transparent transparent transparent;
        }
    </style>

</head>

<body class="app sidebar-mini">

    <div class="container">
        <div class="row mt-5 justify-content-center">

            <div class="col-lg-10 mt-5">
                <div class="card">
                    <h4 class="mt-5 text-center">
                        <img class="card-img-top" style="width: 100px;" src="https://paslon1.tangsel.pilwalkot.rekapitung.id/ui/images/Lambang_Kota_Tangerang_Selatan_svg1.png" alt="">
                    </h4>
                    <h4 class="card-title text-center"> {{$config['jenis_pemilu']}} TAHUN  {{$config['tahun']}} <br> {{$kota->name}}</h4>
                    <div class="card-body">
                        <h4 class="card-title text-center">Formulir Pendaftaran C1 Banding</h4>
                        <form action="{{url('')}}/daftar-banding" method="post">
                            <x-jet-validation-errors class="mb-4" />
                            @csrf
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" id="nama" aria-describedby="nama" placeholder="Masukkan Nama">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" aria-describedby="email" placeholder="Masukkan Email">
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" name="alamat" id="alamat" aria-describedby="alamat" placeholder="Masukkan Alamat">
                            </div>
                            <div class="mb-3">
                                <label for="no_ktp" class="form-label">No KTP</label>
                                <input type="number" class="form-control" name="no_ktp" id="no_ktp" aria-describedby="no_ktp" placeholder="Masukkan No KTP">
                            </div>
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No Hp</label>
                                <input type="number" class="form-control" name="no_hp" id="no_hp" aria-describedby="no_hp" placeholder="Masukkan No Hp">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password" aria-describedby="password" placeholder="Masukkan Password">
                            </div>
                            <div class="mb-3">
                                <label for="repassword" class="form-label">Ulangi Password</label>
                                <input type="password" class="form-control" name="repassword" id="repassword" aria-describedby="repassword" placeholder="Masukkan Ulangi Password">
                            </div>
                            <div class="mb-3">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <select name="kecamatan" id="kecamatan" class="form-control" onchange="ajaxKel(this.value)">
                                    @foreach($kecamatan as $kec)
                                    <option value="{{$kec->id}}">
                                        {{$kec->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="kelurahan" class="form-label">Kelurahan</label>
                                <select name="kelurahan" id="kelurahan" class="form-control" onchange="ajaxTps(this.value)">
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="TPS" class="form-label">TPS</label>
                                <select name="tps" id="tps" class="form-control">
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>
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

    <!-- C3 CHART JS -->
    <script src="../../assets/plugins/charts-c3/d3.v5.min.js"></script>
    <script src="../../assets/plugins/charts-c3/c3-chart.js"></script>

    <!-- INTERNAL SELECT2 JS -->
    <script src="../../assets/plugins/select2/select2.full.min.js"></script>
    <script src="../../assets/plugins/sweet-alert/sweetalert.min.js"></script>
    <script>
        let ajaxKel = function(id) {
            $.ajax({
                url: "{{url('')}}/get-kel",
                data: {
                    id
                },
                type: "get",
                success: function(res) {
                    $('#kelurahan').html(res)
                }
            });
        }
        let ajaxTps = function(id) {
            $.ajax({
                url: "{{url('')}}/get-tps",
                data: {
                    id
                },
                type: "get",
                success: function(res) {
                    $('#tps').html(res)
                }
            });
        }
    </script>

</body>

</html>