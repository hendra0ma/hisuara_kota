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
    <title>Hisuara</title>

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

    <!-- SELECT2 CSS -->
    <link href="../../assets/plugins/select2/select2.min.css" rel="stylesheet" />

    <!-- DATA TABLE CSS -->
    <link href="../../assets/plugins/datatable/css/dataTables.bootstrap5.css" rel="stylesheet" />
    <link href="../../assets/plugins/datatable/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link href="../../assets/plugins/datatable/responsive.bootstrap5.css" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="../../assets/colors/color1.css" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
     integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
     crossorigin=""/>

    <link href="../../assets/plugins/sweet-alert/sweetalert.css" rel="stylesheet" />
    <!-- INTERNAL Notifications  Css -->
    <link href="../../assets/plugins/notify/css/jquery.growl.css" rel="stylesheet" />
    <link href="../../assets/plugins/notify/css/notifIt.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet" />
    
    <link rel="stylesheet" href="https://raw.githack.com/thdoan/magnify/master/dist/css/magnify.css">
    
    <style>
        .inner-card {
            border-radius: 10px;
            background-color: #cbd7ff;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5) inset;
            -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5) inset;
            -moz-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5) inset;
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

        .mid {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }
        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        /* The slider */
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
            height: 26px;
            width: 26px;
            left: 4px;
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
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
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
        
        .c3-legend-item text{
            font-size: 11px;
        }
    </style>

    <script src="../../assets/js/jquery.min.js"></script>

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

        .parent-link a {
            background: rgba(98, 88, 202, 0.65);
        }

        .parent-link a:hover {
            background: #6259ca;
        }
    </style>

</head>

<?php $dark_mode = ($config->darkmode == "yes") ? 'dark-mode' : ""; ?>

<body class="app sidebar-mini {{$dark_mode}}">