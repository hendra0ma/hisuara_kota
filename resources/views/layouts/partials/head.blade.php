<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=1920px, initial-scale=0.75, user-scalable=yes'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Zanex – Bootstrap  Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords" content="admin, dashboard, dashboard ui, admin dashboard template, admin panel dashboard, admin panel html, admin panel html template, admin panel template, admin ui templates, administrative templates, best admin dashboard, best admin templates, bootstrap 4 admin template, bootstrap admin dashboard, bootstrap admin panel, html css admin templates, html5 admin template, premium bootstrap templates, responsive admin template, template admin bootstrap 4, themeforest html">
    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('')}}assets/images/brand/favicon.ico" />
    <!-- TITLE -->
    <title>Hisuara</title>

    <!-- BOOTSTRAP CSS -->
    <link href="{{asset('')}}assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="{{asset('')}}assets/css/style.css" rel="stylesheet" />
    <link href="{{asset('')}}assets/css/dark-style.css" rel="stylesheet" />
    <link href="{{asset('')}}assets/css/skin-modes.css" rel="stylesheet" />

    <!-- SIDE-MENU CSS -->
    <link href="{{asset('')}}assets/css/sidemenu.css" rel="stylesheet" id="sidemenu-theme">

    <!--C3 CHARTS CSS -->
    <link href="{{asset('')}}assets/plugins/charts-c3/c3-chart.css" rel="stylesheet" />

    <!-- P-scroll bar css-->
    <link href="{{asset('')}}assets/plugins/p-scroll/perfect-scrollbar.css" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="{{asset('')}}assets/css/icons.css" rel="stylesheet" />

    <!-- SIDEBAR CSS -->
    <link href="{{asset('')}}assets/plugins/sidebar/sidebar.css" rel="stylesheet">

    <!-- SELECT2 CSS -->
    <link href="{{asset('')}}assets/plugins/select2/select2.min.css" rel="stylesheet" />

    <!-- DATA TABLE CSS -->
    <link href="{{asset('')}}assets/plugins/datatable/css/dataTables.bootstrap5.css" rel="stylesheet" />
    <link href="{{asset('')}}assets/plugins/datatable/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link href="{{asset('')}}assets/plugins/datatable/responsive.bootstrap5.css" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{asset('')}}assets/colors/color1.css" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />

    <link href="{{asset('')}}assets/plugins/sweet-alert/sweetalert.css" rel="stylesheet" />
    <!-- INTERNAL Notifications  Css -->
    <link href="{{asset('')}}assets/plugins/notify/css/jquery.growl.css" rel="stylesheet" />
    <link href="{{asset('')}}assets/plugins/notify/css/notifIt.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://raw.githack.com/thdoan/magnify/master/dist/css/magnify.css">

    <style>
        @media screen and (max-width: 1366px) {
            body {
                min-width: 1903px;
                -moz-transform: scale(0.7091352);
                -moz-transform-origin: 0 0;
                transform: scale(0.7091352);
                transform-origin: 0 0;
            }
        }

        .inner-card {
            border-radius: 10px;
            background-color: #cbd7ff;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.5) inset;
            -webkit-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.5) inset;
            -moz-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.5) inset;
        }

        .hiasan-1 {
            background-color: rgba(98, 89, 202, 0.8);
            height: 60px;
            position: relative;
        }

        .hiasan-2 {
            background-color: #404042;
            height: 60px;
        }

        .card.custom {
            position: relative;
        }

        .gambar-bulat {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            border-radius: 100%;
            border: 5px white solid;
        }
    </style>

    @livewireStyles
    <style>
        /* Style the tab */
        .tab {
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-right: none;
            border-left: none;
        }

        /* Style the buttons inside the tab */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: rgba(0, 0, 0, 0.25)
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            margin-top: 25px;
        }

        /*
        panjang/tinggi lingkaran = pt
        margin kiri = mk
        lebar background = lb
        jarak ke paling kanan lebar bg = jarak-maks-bg
        jadi

        p + mk = panjang-n-jarak
        lb - panjang-n-jarak = jarak-maks-bg
        jarak-maks-bg - mk = hasil
        */

        :root {
            --tinggi-bg: 25px;
            --panjang-tinggi-lingkaran: calc(var(--tinggi-bg) - 8px);
            --jarak-kiri-lingkaran: 4px;
            --lebar-bg: 60px;
            --panjang-n-jarak: calc(var(--panjang-tinggi-lingkaran) + var(--jarak-kiri-lingkaran));
            --jarak-maks-bg: calc(var(--lebar-bg) - var(--panjang-n-jarak));
            --trans-dibutuhkan: calc(var(--jarak-maks-bg) - var(--jarak-kiri-lingkaran));
            /* Changed reference to --panjang-tinggi-lingkaran */
        }

        /* Your other styles remain unchanged */



        .mid {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: var(--lebar-bg);
            height: var(--tinggi-bg);
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }


        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: var(--panjang-tinggi-lingkaran);
            width: var(--panjang-tinggi-lingkaran);
            left: var(--jarak-kiri-lingkaran);
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }


        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(var(--trans-dibutuhkan));
            -ms-transform: translateX(var(--trans-dibutuhkan));
            transform: translateX(var(--trans-dibutuhkan));
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        .btn-dark-custom {
            background: rgb(113, 56, 150);
            background: linear-gradient(180deg, rgba(113, 56, 150, 1) 0%, rgba(108, 48, 147, 1) 2%, rgba(96, 29, 140, 1) 9%, rgba(78, 0, 130, 1) 25%, rgba(64, 0, 107, 1) 84%, rgba(60, 0, 101, 1) 88%, rgba(65, 0, 109, 1) 93%, rgba(15, 0, 25, 1) 100%, rgba(0, 0, 0, 1) 100%, rgba(0, 0, 0, 0.5) 100%, rgba(0, 0, 0, 0.75) 100%);
        }

        .bg-dark-custom {
            background: rgb(78, 0, 130);
            background: linear-gradient(180deg, rgba(78, 0, 130, 1) 0%, rgba(78, 0, 130, 1) 68%, rgba(15, 0, 25, 1) 100%, rgba(0, 0, 0, 1) 100%, rgba(0, 0, 0, 0.5) 100%, rgba(0, 0, 0, 0.75) 100%);
        }

        .c3-legend-item text {
            font-size: 11px;
        }
    </style>

    <script src="{{asset('')}}assets/js/jquery.min.js"></script>

    <link rel="stylesheet" href="https://raw.githack.com/thdoan/magnify/master/dist/css/magnify.css">

    <style>
        ul.b {
            list-style-type: square;
        }

        ul.b li {
            margin-bottom: 10px;
        }
    </style>

    <style>
        .track {
            position: relative;
            background-color: #ddd;
            height: 7px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            margin-bottom: 60px;
            margin-top: 50px
        }

        .track .step {
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            width: 25%;
            margin-top: -18px;
            text-align: center;
            position: relative
        }

        .track .step.active.success:before {
            background: #09ad95
        }

        .track .step.active.success .icon {
            background: #09ad95;
            color: #fff
        }

        .track .step.active.danger:before {
            background: #f82649
        }

        .track .step.active.danger .icon {
            background: #f82649;
            color: #fff
        }

        .track .step.active.secondary:before {
            background: #fb6b25
        }

        .track .step.active.secondary .icon {
            background: #fb6b25;
            color: #fff
        }

        .track .step::before {
            height: 7px;
            position: absolute;
            content: "";
            width: 100%;
            left: 0;
            top: 18px
        }

        .track .icon {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            position: relative;
            border-radius: 100%;
            background: #ddd
        }


        .track .text {
            display: block;
            margin-top: 7px
        }

        .itemside {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            width: 100%
        }

        .itemside .aside {
            position: relative;
            -ms-flex-negative: 0;
            flex-shrink: 0
        }

        .img-sm {
            width: 80px;
            height: 80px;
            padding: 7px
        }

        ul.row,
        ul.row-sm {
            list-style: none;
            padding: 0
        }

        .itemside .info {
            padding-left: 15px;
            padding-right: 7px
        }

        .itemside .title {
            display: block;
            margin-bottom: 5px;
            color: #212529
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem
        }

        .parent-link a.active {
            background: #6259ca;
        }

        .parent-link a.active:after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            right: 0;
            width: 40%;
            border-top: 3px solid #6259ca;
            z-index: -1;
        }

        .parent-link a.active-tab {
            background: #6259ca;
        }

        .parent-link a.active-tab:after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            right: 0;
            width: 40%;
            border-top: 3px solid #6259ca;
            z-index: -1;
        }

        .parent-link.kecurangan a.active-tab {
            background: #ff4f4e;
        }

        .parent-link.kecurangan a.active-tab:after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            right: 0;
            width: 40%;
            border-top: 3px solid #ff4f4e;
            z-index: -1;
        }

        .parent-link a {
            background: rgba(98, 88, 202, 0.65);
        }

        .parent-link a:hover {
            background: #6259ca;
        }

        .parent-link .btn-fdp.active {
            background: #000000;
        }

        .parent-link .btn-fdp.active:after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            right: 0;
            width: 40%;
            border-top: 3px solid #000000;
            z-index: -1;
        }

        .parent-link .btn-fdp {
            background: rgba(0, 0, 0, 0.35);
        }

        .parent-link .btn-fdp:hover {
            background: #000000;
        }

        .parent-link .btn-ver.active {
            background: #ff4f4e;
        }

        .parent-link .btn-ver.active:after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            right: 0;
            width: 40%;
            border-top: 3px solid #f82649;
            z-index: -1;
        }

        .parent-link .btn-ver {
            background: rgba(248, 38, 73, 0.65)
        }

        .parent-link .btn-ver:hover {
            background: #ff4f4e;
        }

        .security-keluar {
            position: fixed;
            z-index: 10;
            background-image: url('https://t3.ftcdn.net/jpg/02/69/46/42/360_F_269464287_Q2DoeIRT847orJlYDSX59T8pjlF9nO94.jpg');
            background-size: cover;
            height: 100vh;
            width: 100vw;
            top: 0;
            left: 0;
        }

        .box-security {
            width: 1000px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%)
        }

        .box-security ul {
            margin-bottom: 15px;
        }

        .box-security ul li {
            font-weight: bold;
            color: black;
            line-height: 2.5rem;
            font-size: 20px;
        }

        .icon-shield {
            font-size: 350px;
        }

        .close-security {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 20;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script>
        function setCookie(cname, cvalue, exdays) {
            const d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            let expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }

        function getCookie(cname) {
            let name = cname + "=";
            let ca = document.cookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }
    </script>

</head>

<?php $dark_mode = ($config->darkmode == "yes") ? 'dark-mode' : ""; ?>

<body class="app sidebar-mini {{$dark_mode}}">
    <img id="imageHisuara" src="{{asset('images/voice_hisuara.gif')}}" alt="hisuara image" style="
        z-index: 20;
        bottom: 15px;
        width: 4%;
        left: 50%;
        transform: translateX(-50%);
        position: fixed;
        display: none;">
    <div class="security-keluar" style="display: none">
        <div class="box-security">
            <div class="row">
                <div class="col-6 text-center">

                </div>
                <div class="col-6">
                    <ul>
                        <li><img src="{{asset('')}}images/logo/Hisuara_new_white.png" class="mb-5" alt=""></li>
                        <li class="text-danger fs-4">SECURITY SYSTEM</li>
                        <li>Admin Code Authentication</li>
                        <li>Malware Removal & Hack Repair</li>
                        <li>Continuous Malware & Hack Scanning</li>
                        <li>Brand Reputation & Blacklist Monitoring</li>
                        <li>Stop Hacks</li>
                        <li>Website Application Firewall</li>
                        <li>DDoS Protection</li>
                        <li>Advanced DDoS Mitigation</li>
                    </ul>
                </div>
            </div>
        </div>
        <button class="btn close-security">
            <i class="fa-solid fa-x text-danger fs-1 fw-bold"></i>
        </button>
    </div>

    <script>
        $('.close-security').on('click', function() {
            $('.security-keluar').hide()
        })
    </script>