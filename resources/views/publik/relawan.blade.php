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
    <title>Relawan</title>

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
                                <img class="card-img-top bg-dark rounded-3" style="width: 150px;" src="{{asset('images/logo/hisuara.png')}}" alt="">
                            </h4>
                            <h4 class="card-title text-center"> {{$config['jenis_pemilu']}} TAHUN  {{$config['tahun']}} <br> {{$kota->name}}</h4>
                    <div class="row justify-content-center">
                        <div class="col-md-11">
                            <div class="card-body">
                                <h4 class="card-title text-center">Formulir Pendaftaran Relawan</h4>
                                <hr>
                                <form action="{{url('')}}/daftar-relawan" method="post">
                                    @csrf
                                    <x-jet-validation-errors class="mb-4" />
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control" name="nama" id="nama" value="{{old('nama')}}" aria-describedby="nama" placeholder="Masukkan Nama">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}" aria-describedby="email" placeholder="Masukkan Email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <input type="text" class="form-control" name="alamat" id="alamat" value="{{old('alamat')}}" aria-describedby="alamat" placeholder="Masukkan Alamat">
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_ktp" class="form-label">No KTP</label>
                                        <input type="number" class="form-control" name="no_ktp" id="no_ktp" value="{{old('no_ktp')}}" aria-describedby="no_ktp" placeholder="Masukkan No KTP">
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_hp" class="form-label">No Hp</label>
                                        <input type="number" class="form-control" name="no_hp" id="no_hp" value="{{old('no_hp')}}" aria-describedby="no_hp" placeholder="Masukkan No Hp">
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
                                        <select class="form-control" name="kecamatan" id="kecamatan" onchange="ajaxKel(this.value)">
                                            @foreach($kecamatan as $kec)
                                            <option value="{{$kec->id}}">
                                                {{$kec->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kelurahan" class="form-label">Kelurahan</label>
                                        <select class="form-control" name="kelurahan" id="kelurahan" onchange="ajaxTps(this.value)">
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="TPS" class="form-label">TPS</label>
                                        <select class="form-control" name="tps" id="tps">
                                        </select>
                                    </div>
        
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card bg-primary rounded-0">
      
                <div class="card-body text-center">
                    <h5 class="card-title"><img width="150px" src="{{asset('images/logo/hisuara.png')}}" alt=""></h5>
                    <div class="row no-gutters mx-auto mt-5" style="width: 350px;">
                        <!-- <div class="col"><a href="https://facebook.com/" type="button" class="rounded-0 btn btn-facebook"><i class="fa fa-facebook me-2"></i>Facebook</a></div>
                        <div class="col"><a href="https://twitter.com/" type="button" class="rounded-0 btn btn-twitter"><i class="fa fa-twitter me-2"></i>Twitter</a></div>
                        <div class="col"><a href="https://wa.me/6281235757667" type="button" class="rounded-0 btn btn-success"><i class="fa fa-whatsapp me-2"></i>Whatsapp</a></div> -->
                    </div>
                    <div class="row mt-5 text-white">
                        <div class="col">
                            <a class="text-white fw-bold" href="{{url('')}}/login">Login</a> |
                            <a class="text-white fw-bold" href="{{url('')}}/relawan">Relawan</a> |
                            <!-- <a class="text-white fw-bold" href="{{url('')}}/publik/history">History</a> | -->
                            <a class="text-white fw-bold" href="https://disclaimer.rekapitung.id">Disclaimer</a> |
                        
                        </div>
                    </div>

                    <div class="row mt-5 text-white">
                        <div class="col">
                            <b>© PT. Hisuara.id</b>
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