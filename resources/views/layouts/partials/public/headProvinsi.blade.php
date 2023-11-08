<?php

use App\Models\District;
use App\Models\Village;
use App\Models\Tps;
use App\Models\SaksiData;
use App\Models\Paslon;
?>
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
    <title> &nbsp; {{$config->jenis_pemilu}} &nbsp; - &nbsp; Indonesia &nbsp; </title>

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
    <script>
        var documentTitle = document.title + " - ";

        (function titleMarquee() {
            document.title = documentTitle = documentTitle.substring(1) + documentTitle.substring(0, 1);
            setTimeout(titleMarquee, 200);
        })();
    </script>
</head>

<body class="app sidebar-mini">

    <a class="nav-link icon theme-layout nav-link-bg layout-setting align-item">
        <span class="dark-layout"><i class="fe fe-moon"></i></span>
        <span class="light-layout"><i class="fe fe-sun"></i></span>
    </a>

    <div class="container" style="margin-top: -60px;">
        <div class="row mt-5">
            <div class="col-md text-center mt-5 ">
                <h4 class="text-uppercase fw-bold">
                    <div style="display:inline-block"class="bg-dark p-2 rounded-2 shadow">
                        <img style="width: 100px;" src="{{asset('')}}images/logo/hisuara.png" alt="">
                    </div>
                </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md text-center">
                <h4 style="margin-bottom: 7.5px !important;" class="text-uppercase fw-bold">
                    {{$config->jenis_pemilu}} Indonesia
                </h4>
            </div>
        </div>
      
                  
                
        <div class="row">
            <div class="col-md text-center">
                <h4 class="text-uppercase fw-bold">
                    Tahun {{$config->tahun}}
                </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md text-center">
                <h6 class="text-uppercase fw-bold">
                    {{$title}}
                </h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md text-center">
                <hr>
                <h2 class="text-uppercase fw-bold">
                    Hasil Perhitungan Suara
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row" id="marquee1">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <a class="btn btn-sm btn-success rounded-0 text-white" style="font-size:11px;" data-toggle="modal" data-tooltip-toogle="tooltip" title="Kiriman Saksi adalah laporan saksi di TPS yang mengirim hasil perhitungan langsung dari lokasi TPS. Setiap saksi yang mengirim data perhitungan di TPS akan ditampilkan pada tulisan berjalan ini." id="inputGroup-sizing-sm">Kiriman Saksi <i class="fa fa-question-circle"></i></a>
                        </div>
                        <div class="form-control" style="height:25px;" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                         


                        </div>
                    </div>
                </div>
                <div class="row" id="marquee3" style="display:none">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <button class="btn btn-info btn-sm text-white rounded-0" data-tooltip-toogle="tooltip" title="TPS Quick Count adalah TPS yang terdaftar sebagai TPS Sample yang dipilih secara acak oleh Sistem dengan perhitungan 30% dari total TPS masuk dalam satu Kelurahan." style="font-size:11px;" data-toggle="modal" data-target="#modalTpsQuickCountQuest" id="inputGroup-sizing-sm">TPS QuickCount <i class="fa fa-question-circle"></i></button>
                        </div>
                        <div class="form-control" style="height:25px;" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            
                        </div>
                    </div>
                </div>
                <div class="row" id="marquee2">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <button class="btn btn-warning btn-sm text-white rounded-0" data-tooltip-toogle="tooltip" title="Terverifikasi adalah status kiriman C1 TPS yang telah di verifikasi oleh verifikator." style="font-size:11px;" data-toggle="modal" data-target="#modalTpsQuickCountQuest" id="inputGroup-sizing-sm">Terverifikasi <i class="fa fa-question-circle"></i></button>
                        </div>
                        <div class="form-control" style="height:25px;" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                       
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md text-center">
                <div class="container">
                    <ul class="nav nav-tabs mb-3 shadow-sm" id="pills-tab" role="tablist">
                        <li class="nav-item col" style="padding-right: 0; padding-left: 0;"> <button style="height: 24px;" class="btn nav-link active w-100 rounded-0 hoper border" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">RealCount</button> </li>
                        @if($config->quick_count == "yes")
                        <li class="nav-item col" style="padding-right: 0; padding-left: 0;"> <button style="height: 24px;" class="btn nav-link w-100 rounded-0 hoper border" id="pills-home-tab" data-toggle="pill" href="#pills-home-enum" role="tab" aria-controls="pills-home-enum" aria-selected="true">Quick Count By Enumerator</button> </li>
                        <!-- <li class="nav-item col" style="padding-right: 0; padding-left: 0;"> <button style="height: 24px;" class="btn nav-link w-100 rounded-0 border" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Sistem Quick Count</button> </li> -->
                        @endif
                        @if($config->show_terverifikasi == "show")
                        <li class="nav-item col" style="padding-right: 0; padding-left: 0;"> <button style="height: 24px;" class="btn nav-link w-100 rounded-0 border" id="pills-terverifikasi-tab" data-toggle="pill" href="#pills-terverifikasi" role="tab" aria-controls="pills-terverifikasi" aria-selected="false">Terverifikasi</button> </li>
                        @endif
                    </ul>
                </div>