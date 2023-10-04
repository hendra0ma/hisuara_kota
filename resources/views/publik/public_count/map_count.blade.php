<?php

use App\Models\District;
use App\Models\Village;
use App\Models\Tps;
use App\Models\SaksiData;
use App\Models\Paslon;
?>
<!doctype html>

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
    <title>Map Count</title>

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

    <!-- SIDEBAR CSS -->
    <link href="../../assets/plugins/sidebar/sidebar.css" rel="stylesheet">

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="../../assets/colors/color1.css" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />

    <style>
        body {
            overflow-x: hidden;
        }

        .circle {
            width: 50px;
            line-height: 50px;
            border-radius: 50%;
            text-align: center;
            font-size: 32px;
            border: 1px solid #ccc;
            background: #fff;
            color: #000 !important;
        }

        .carousel-caption {
            display: block !important;
        }

        @media (max-width: 768px) {
            .carousel-item {
                height: 700px;
            }
        }
    </style>
</head>

<body class="app sidebar-mini">

    <?php
    $saksidatai = SaksiData::sum("voice");
    $dpt = District::where('regency_id', $config->regencies_id)->sum("dpt");
    $data_masuk = (int)$saksidatai / (int)$dpt * 100;

    ?>

    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="../../assets/images/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            <div class="row align-items-center flex-row-reverse bg-white">
                <div class="col-md-12 col-sm-12 text-center">
                    <marquee class="mt-3" behavior="" direction="">Data Baru telah masuk dari Nastasha Velandra TPS 67 Kel.
                        Ciputat Kec. Ciputat</marquee>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="dropdown">
                        <a class="nav-link icon theme-layout nav-link-bg layout-setting">
                            <span class="dark-layout" data-bs-placement="top" data-bs-toggle="tooltip" title="Dark Theme"><i class="fe fe-moon"></i></span>
                            <span class="light-layout" data-bs-placement="top" data-bs-toggle="tooltip" title="Light Theme"><i class="fe fe-sun"></i></span>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md text-center mt-5 ">
                    <h4 class="text-uppercase fw-bold">
                        <img style="width: 100px;" src="{{asset('storage').'/'.$config['regencies_logo']}}" alt="">
                    </h4>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md text-center">
                    <h3 class="fw-bold pb-5">Maps Count
                    <h3 class="fw-bold"> {{$config['jenis_pemilu']}}  {{$config['tahun']}} {{$provinsi->name}}
                    <h3 class="fw-bold">{{$kota->name}}
                    </h3>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="badge bg-primary">PROGRESS : {{substr($data_masuk, 0, 3)}}% DARI 100%</div>
                </div>
            </div>

            <div class="container mt-5">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header p-0">
                                <a class="ms-auto nav-link icon full-screen-link nav-link-bg" style="margin-right: 10px !important;" id="ikon-map-full">
                                    <i class="fe fe-minimize"></i>
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="ht-300" id="mapid" style="height: 500px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row mb-5">
                    <div class="col-md-12">
                        <div id="carousel-controls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php $count = 1; ?>
                                @foreach ($kecamatan as $item)
                                <?php


                                // $jumlah =  SaksiData::where('district_id', $item['id'])->sum('voice');
                                ?>
                                <div class="carousel-item <?php if ($count++ == 1) : ?><?= 'active' ?><?php endif; ?>">
                                    <img class="d-block" style="opacity: 0" src="../../assets/images/media/4.jpg" data-bs-holder-rendered="true">
                                    <div class="carousel-caption d-none d-md-block" style="top:0">
                                        <h3 class="text-dark fw-bold">KECAMATAN <br> {{$item['name']}} </h3>
                                        <div class="row">

                                            @foreach ($paslon as $psl)
                                            <?php
                                            $pasln = SaksiData::join('districts', 'districts.id', '=', 'saksi_data.district_id')->where('saksi_data.district_id', $item['id'])->where('saksi_data.paslon_id', $psl->id)->get();
                                            $jumlah = 0;
                                            foreach ($pasln as $pas) {
                                                $jumlah += $pas->voice;
                                            }

                                            $persen = substr($jumlah / $item->dpt * 100, 0, 3);

                                            ?>
                                            <div class="col-md">
                                                <div class="card" style="background-color: {{$psl->color}};">
                                                    <div class="card-body">
                                                        <p class="card-text">
                                                        <div class="row">
                                                            <div class="col">
                                                                <img style="width: 100px;" src="{{asset('storage/'. $psl['picture'])}}">
                                                            </div>
                                                            <div class="col">
                                                                <p class="fw-bolder fs-3">{{$persen}}%</p>
                                                                Jumlah Suara : {{$jumlah}}
                                                            </div>
                                                        </div>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            $jumlah = 0;
                                            ?>
                                            @endforeach


                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div><!-- COL-END -->
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

    <!-- CHART-CIRCLE JS-->
    <script src="../../assets/js/circle-progress.min.js"></script>

    <!-- INPUT MASK JS-->
    <script src="../../assets/plugins/input-mask/jquery.mask.min.js"></script>

    <!-- SIDE-MENU JS -->
    <script src="../../assets/plugins/sidemenu/sidemenu.js"></script>

    <!-- SIDEBAR JS -->
    <script src="../../assets/plugins/sidebar/sidebar.js"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="../../assets/plugins/p-scroll/perfect-scrollbar.js"></script>
    <script src="../../assets/plugins/p-scroll/pscroll.js"></script>
    <script src="../../assets/plugins/p-scroll/pscroll-1.js"></script>

    <!-- CUSTOM JS-->
    <script src="../../assets/js/custom.js"></script>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <script src="https://devlama.rekapitung.id/assets/js/geojson.ajax.js"></script>
    <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet' />
    @include('layouts.templateCommander.script-command')
    
    <script>
        // Adding a Popup
        var mymap = L.map('mapid').setView([-6.297308926250658, 106.71285789150006], 12);

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoiaXNhYTIxIiwiYSI6ImNsZnc5dmQ3NDBmMjUzcW8zZzg0c2RnazgifQ.mphOBqpgqHl5ONLL092Txw'
        }).addTo(mymap);


                

        function getColor(d) {
            return d == 'Serpong' ? '#0e0e0e' :
            d == 'Serpong Utara' ? '#0e0e0e' :
            d == 'Pondokaren' ? '#0e0e0e' :
            d == 'Ciputat' ? '#f00' :
            d == 'Ciputat Timur' ? '#0e0e0e' :
            d == 'Pamulang' ? '#0e0e0e' :
            d == 'Setu' ? '#0e0e0e' :
             '#59FD02';
        }

        function popUp(f, l) {
            var out = [];
            if (f.properties) {
                out.push("Kecamatan " + f.properties['WADMKC']);
                l.bindPopup(out.join("<br />"));
            }
        }

        var jsonTest = new L.GeoJSON.AJAX(["{{url('/')}}/assets/tangsel1.geojson"], {
            style: function(feature) {
                kec = feature.properties['WADMKC'];
                return {
                    fillColor: getColor(kec),
                    fillOpacity: 0.8,
                    color: "white",
                    dashArray: '3',
                    weight: 1,
                    opacity: 0.99
                }
            },
            onEachFeature: popUp,
        }).addTo(mymap);
    </script>

    <script>
        $('#ikon-map-full').on('click',function(){
            mymap.toggleFullscreen();
        });
    </script>

</body>

</html>