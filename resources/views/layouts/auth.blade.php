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
    <title>Authentication</title>

    <!-- BOOTSTRAP CSS -->
    <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="../../assets/css/style.css" rel="stylesheet" />
    <link href="../../assets/css/dark-style.css" rel="stylesheet" />
    <link href="../../assets/css/skin-modes.css" rel="stylesheet" />

    <!-- SIDE-MENU CSS -->
    <link href="../../assets/css/sidemenu.css" rel="stylesheet" id="sidemenu-theme">

    <!-- SINGLE-PAGE CSS -->
    <link href="../../assets/plugins/single-page/css/main.css" rel="stylesheet" type="text/css">

    <!--C3 CHARTS CSS -->
    <link href="../../assets/plugins/charts-c3/c3-chart.css" rel="stylesheet" />

    <!-- P-scroll bar css-->
    <link href="../../assets/plugins/p-scroll/perfect-scrollbar.css" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="../../assets/css/icons.css" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="../../assets/colors/color1.css" />

    <!-- SELECT2 CSS -->
    <link href="../../assets/plugins/select2/select2.min.css" rel="stylesheet" />

    <!-- INTERNAL Sumoselect css-->
    <link rel="stylesheet" href="../../assets/plugins/sumoselect/sumoselect.css">

    <!-- MULTI SELECT CSS -->
    <link rel="stylesheet" href="../../assets/plugins/multipleselect/multiple-select.css">
    <style>
        .otp-input-wrapper {
            width: 240px;
            text-align: left;
            display: inline-block;
        }

        .otp-input-wrapper input {
            padding: 0;
            width: 264px;
            font-size: 20px;
            font-weight: 600;
            color: #3e3e3e;
            background-color: transparent;
            border: 0;
            margin-left: 2px;
            letter-spacing: 30px;
            font-family: sans-serif !important;
        }

        .otp-input-wrapper input:focus {
            box-shadow: none;
            outline: none;
        }

        .otp-input-wrapper svg {
            position: relative;
            display: block;
            width: 240px;
            height: 2px;
        }
    </style>
</head>

<body class="">


    <!-- JQUERY JS -->
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
        crossorigin="anonymous"></script>

    <!-- BOOTSTRAP JS -->
    <script src="../../assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>



    <div class="login-img bg-dark">

        <!-- GLOABAL LOADER -->
        <div id="global-loader">
            <img src="{{ asset('') }}assets/images/loader.svg" class="loader-img" alt="Loader">
        </div>
        <!-- /GLOABAL LOADER -->

        <!-- PAGE -->
        <div class="page">
            <div class="">
                <!-- CONTAINER OPEN -->
                <div class="col col-login mx-auto">
                    <div class="text-center">
                        <img src="{{ asset('') }}images/logo/hisuara.png"
                            class="img-fluid img-thumbnail bg-dark shadow-lg border-0" style="width:100px;height:auto;"
                            alt="">
                    </div>
                </div>
                <div class="container-login100 d-flex">
                    <div class="wrap-login100 p-0">
                        <div class="card-body">
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                                @csrf
                                <input type="hidden" id="latitude" name="latitude">
                                <input type="hidden" id="longitude" name="longitude">
                                <span class="login100-form-title">
                                    Login
                                </span>
                                <div class="alert alert-success" id="kodeAlert" style="display:none">
                                    Berhasil Generate kode akses, Silahkan cek Email Anda.
                                </div>

                                <x-jet-validation-errors class="mb-4" />
                                <div class="wrap-input100 validate-input">
                                    <input class="input100" type="text" name="email"
                                        placeholder="Masukkan No. KTP/No. Hp/Email" required>
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                        <i class="zmdi zmdi-email" aria-hidden="true"></i>
                                    </span>
                                </div>

                                <div class="wrap-input100 validate-input" data-bs-validate="Password is required">
                                    <input class="input100" type="password" name="password" placeholder="Password"
                                        required>
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                        <i class="zmdi zmdi-lock" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <center>




                                    <!-- <div class="wrap-input100 validate-input">
                                <div class="otp-input-wrapper">
                                    <input type="text" maxlength="6" pattern="[0-9]*" autocomplete="off"
                                        name="acakey" required>
                                    <svg viewBox="0 0 240 2" xmlns="http://www.w3.org/2000/svg">
                                        <line x1="0" y1="0" x2="400" y2="1" stroke="#3e3e3e" stroke-width="2"
                                            stroke-dasharray="20" />
                                    </svg>
                                </div>
                            </div> -->
                                    <div class="col-lg-12">
                                        <p class="containerTime text-danger text-center">

                                        </p>
                                    </div>
                                    <!-- <div class="container-login100-form-btn">
                                <button class="login100-form-btn btn-danger text-white p-1 mt-2" id="pengajuan">
                                    <img src="<?= asset('') ?>assets/acakey_new_icon_key.png"
                                        style="width:20px;height:auto;">&nbsp;
                                    Get Kode ACA
                                </button>
                            </div> -->
                                </center>

                                <div class="row justify-content-end">
                                    <!-- <div class="col-6">
                                <a href="https://www.acakey.com/info" class="text-primary ms-1">Apa Itu Acakey?</a>
                            </div> -->
                                    <div class="col-6 text-end">
                                        <a href="#" class="text-primary ms-1">Forgot Password?</a>
                                    </div>
                                </div>

                                <div class="container-login100-form-btn">
                                    <button type="submit"
                                        class="login100-form-btn"style="background-color: #6c757d!important;color:white">
                                        Login
                                    </button>
                                </div>
                                <div class="text-center pt-3">
                                    <p class="text-dark mb-0">Not a member?<a href="register-admin"
                                            class="text-primary ms-1">Create an Account</a></p>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <h5 class="fw-semibold text-center">
                                www.hisuara.id
                            </h5>
                        </div>
                    </div>
                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <section class="bg-light" style="height: 10px;">
            <div class="container">
                <img style="display: block; margin-left: auto; margin-right: auto;"
                    src="{{ asset('/') }}assets/images/acakey_new.png" width="250px" class="pt-5 mb-5">
                <div class="text-center pb-5" style="font-size: 13px;">
                    © PT.Mahadaya Swara Teknologi <br />
                    All Right Reserved 2021
                </div>
            </div>
        </section>
        <!-- End PAGE -->

    </div>
   

    <!-- BACKGROUND-IMAGE CLOSED -->


    <!-- CHART-CIRCLE JS -->
    <script src="../../assets/js/circle-progress.min.js"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="../../assets/plugins/p-scroll/perfect-scrollbar.js"></script>

    <!-- INPUT MASK JS -->
    <script src="../../assets/plugins/input-mask/jquery.mask.min.js"></script>

    <!-- CUSTOM JS-->
    <script src="../../assets/js/custom.js"></script>

    <!-- SELECT2 JS -->
    <script src="../../assets/plugins/select2/select2.full.min.js"></script>
    <script src="../../assets/js/select2.js"></script>
    <script src="../../assets/js/form-elements.js"></script>

    <!-- MULTI SELECT JS-->
    <script src="../../assets/plugins/multipleselect/multiple-select.js"></script>
    <script src="../../assets/plugins/multipleselect/multi-select.js"></script>
</body>

</html>
