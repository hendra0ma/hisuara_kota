<?php

use App\Models\Config;
use App\Models\Configs;
use App\Models\District;
use App\Models\Village;
use App\Models\Tps;
use App\Models\SaksiData;
use App\Models\Paslon;
use App\Models\RegenciesDomain;


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
    <title>Rekapitung Quick Count</title>

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
    <style>
        .carousel-inner .carousel-item {
            transition: transform 1s ease;
        }
    </style>
</head>

<body data-bgimg="">
    <?php

    $currentDomain = request()->getHttpHost();
    if (isset(parse_url($currentDomain)['port'])) {
        $url = substr($currentDomain, 0, strpos($currentDomain, ':8000'));
    } else {
        $url = $currentDomain;
    }
    $regency_id = RegenciesDomain::where('domain', "LIKE", "%" . $url . "%")->first();

    $configs = Config::first();
    $config = new Configs;
    $config->regencies_id =  (string) $regency_id->regency_id;
    $config->provinces_id =  $configs->provinces_id;
    $config->regencies_logo =  $configs->regencies_logo;

    $config->setup =  $configs->setup;
$config->darkmode =  $configs->darkmode;
    $config->updated_at =  $configs->updated_at;
    $config->created_at =  $configs->created_at;
    $config->partai_logo =  $configs->partai_logo;
    $config->date_overlimit =  $configs->date_overlimit;
    $config->show_public =  $configs->show_public;
    $config->show_terverifikasi =  $configs->show_terverifikasi;
    $config->lockdown =  $configs->lockdown;
    $config->multi_admin =  $configs->multi_admin;
    $config->otonom =  $configs->otonom;
    $config->dark_mode =  $configs->dark_mode;
    $config->jumlah_multi_admin =  $configs->jumlah_multi_admin;
    $config->jenis_pemilu =  $configs->jenis_pemilu;
    $config->tahun =  $configs->tahun;
    $config->quick_count =  $configs->quick_count;
    $config->default =  $configs->default;
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

            <div class="text-center">
                <h1 class="fw-bolder display-4 pt-5 mb-0">Quick Count</h1>
            </div>

            <div class="container">

                <div class="row align-items-center">

                    <div class="col-2">
                        <img style="width: 75px" src="{{url('/')}}/images/logo/rekapitung_gold.png" alt="">
                    </div>

                    <div class="col-8">
                        <div class="fs-4 fw-bold mx-auto text-center"> {{$config['jenis_pemilu']}} {{$config['tahun']}} / PROVINSI {{$provinsi->name}} / {{$kota->name}}</div>
                    </div>

                    <div class="col-2">
                        <div class="dropdown d-md-flex">
                            <a class="nav-link icon ms-auto m-0">
                                <i class="fe fe-minimize fullscreen-button"></i>
                            </a>
                        </div><!-- FULL-SCREEN -->
                    </div>
                </div>

                <div class="progress bg-white mt-3" style="height:25px">
                    <div class="progress-bar bg-success" role="progressbar" aria-label="Example with label" style="width:  9.3%;height:25px" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">9.3%</div>
                </div>

                <div class="row mt-3">
                    @foreach ($paslon as $ps)
                    <div class="col-md">
                        <div class="card">
                            <div class="card-body">
                                <img src="{{asset('storage/'. $ps['picture'])}}" width="500px" height="300px" style="object-fit: cover;" alt="">
                                <hr>
                                <div class="fs-3 mt-2 fw-bold " style="color:{{$ps->color}}">{{$ps->candidate}} <br> - {{$ps->deputy_candidate}}</div>
                                <hr>
                                <div class="fs-3 mt-2">
                                    <div class="progress mt-2">
                                        <?php
                                        $pasln = SaksiData::where('saksi_data.paslon_id', $ps->id)->where('regency_id', $config->regencies_id)->get();
                                        $jumlah = 0;
                                        $dpt = 0;
                                        foreach ($kecamatan as $kcmt) {
                                            $dpt += $kcmt->dpt;
                                        }
                                        foreach ($pasln as $pas) {
                                            $jumlah += $pas->voice;
                                        }

                                        $jumlah1 = number_format($jumlah, 0, ',', '.');

                                        $persen = substr($jumlah / $dpt * 100, 0, 3);
                                        ?>
                                        <div class="progress-bar" style="background-color:{{$ps->color}}" role="progressbar" aria-label="Example with label" style="width:  {{$persen}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{$jumlah1}}</div>
                                        <?php
                                        $jumlah = 0;
                                        $dpt = 0;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
            <div class="container">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner text-center">
                        <?php $count = 1; ?>
                        @foreach ($kecamatan as $item)
                        <div class="carousel-item <?php if ($count++ == 1) : ?><?= 'active' ?><?php endif; ?>">
                            <div class="fw-bold fs-3 mb-3">
                                KECAMATAN {{$item['name']}}
                            </div>

                            <div class="row">
                                <?php $i = 1; ?>
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
                                    <div class="card">
                                        <div class="card-header justify-content-center" style="background-color:{{$psl->color}}">
                                            <h3 style="margin-bottom: 0;" class="fw-bold text-white">{{$psl->candidate}} - <br> {{$psl->deputy_candidate}}</h3>
                                        </div>
                                        <div class="card-body" style="padding: 10px;">
                                            <div class="row">
                                                <div class="col">
                                                    <img src="{{asset('storage/'. $psl['picture'])}}" width="125px" height="125px" style="object-fit: cover;" alt="">
                                                </div>
                                                <div class="col text-center my-auto fs-1 fw-bold">
                                                    {{$persen}}%
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                $jumlah = 0;
                                ?>
                                @endforeach
                                <?php $i = 1; ?>

                            </div>
                        </div>

                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <div class="row fixed-bottom" style="height: 75px; bottom: 150px; width: 1800px; left:229px">

                <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">


                        <div class="carousel-item  <?php if ($count++ == 1) : ?><?= 'active' ?><?php endif; ?>">
                            <div style="min-width:150px; min-height:100px; max-width:200px; max-height:100px; overflow:hidden;">
                            </div>
                            <div class="carousel-caption d-none d-md-block">
                                <div class="col-md-12">

                                    <div class="row">
                                        <div class="col-md-1">
                                            <div class="row" style="width: 150px;">
                                                <div class="col-md text-center" style="background-color: #000">
                                                    <h5 style="margin-top: 1.25em; margin-bottom: 1.25em;">KECAMATAN
                                                        <br>{{$item['name']}}
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $i = 1; ?>
                                        @foreach ($paslon as $psl)
                                        <?php
                                        $pasln = SaksiData::join('districts', 'districts.id', '=', 'saksi_data.district_id')->where('saksi_data.district_id', $item['id'])->where('saksi_data.paslon_id', $psl->id)->get();
                                        $jumlah = 0;
                                        foreach ($pasln as $pas) {
                                            $jumlah += $pas->voice;
                                        }

                                        $persen = substr($jumlah / $item->dpt * 100, 0, 3);

                                        ?>
                                        <div class="col-md-2 position-relative" style="background-color: white; height: 75px; overflow: hidden; color: #ced4da; border-right: 1px solid">
                                            <h1 class="fw-bolder" style="position: absolute; bottom: 8px; left: 16px;">
                                                0{{$i++}}</h1>
                                            <img style="height: 100px; margin-bottom: 0.65em; margin-left: -100px;" src="{{asset('storage/'. $psl['picture'])}}" alt="">
                                            <h1 style="position: absolute; top: 10%; right: 20px; font-size: 35px; color: #1a1a1ac4" class="fw-bold">{{$persen}}%</h1>
                                            <h1 style="position: absolute; top: 75%; right: 20px; font-size: 9px; color: #1a1a1ac4" class="fw-bold">{{$psl->candidate}} | {{$psl->deputy_candidate}}</h1>
                                        </div>
                                        <?php
                                        $jumlah = 0;
                                        ?>
                                        @endforeach
                                        <?php $i = 1; ?>
                                        <div class="col-md-3 position-relative" style="background-color: black; height: 75px; overflow: hidden; color: #ced4da;">

                                            <h1 style="position: absolute; top: 9%; left: 20px; font-size: 20px; color: white" class="fw-bold">Data Masuk</h1>
                                            <h1 style="position: absolute; top: 37%; left: 20px; font-size: 40px; color: white" class="fw-bold">65,70%</h1>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>

        <!-- FOOTER -->
        <footer class="footer" style="height: 50px; background-color: #000">
            <div class="row flex-row-reverse">
                <div class="col-md-12 col-xs-12 text-center text-white">
                    <marquee>Data Baru Masuk</marquee>
                </div>
            </div>
        </footer>
        <!-- FOOTER END -->
    </div>


    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

    <!-- JQUERY JS -->
    <script src="../../assets/js/jquery.min.js"></script>
    @include('layouts.templateCommander.script-command')
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

</body>

</html>