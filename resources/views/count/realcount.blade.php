<?php

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
    <title>Zanex – Bootstrap Admin & Dashboard Template</title>

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
        body {
            overflow: hidden;
            line-height: 30px;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            visibility: visible;
            color: #fff;
            letter-spacing: 0.02em;
            background-size: cover;
            background-image: url(https://i.pinimg.com/originals/f7/8d/47/f78d47177cd1f8e1f2047c3f5e735365.jpg);
            background-repeat: no-repeat;
        }

        .main {
            display: flex;
            padding-top: 50px;
            --s: 350px;
            /* size  */
            --m: 4px;
            /* margin */
            --f: calc(1.732 * var(--s) + 4 * var(--m) - 1px);
        }

        .container-image {
            font-size: 10px;
            margin: 0 auto;
            /*disable white space between inline block element */
        }

        .container-image div {
            width: var(--s);
            margin: var(--m);
            height: calc(var(--s)*1.1547);
            display: inline-block;
            font-size: initial;
            clip-path: polygon(0% 25%, 0% 75%, 50% 100%, 100% 75%, 100% 25%, 50% 0%);
            background: white;
            margin-bottom: calc(var(--m) - var(--s)*0.2885);
        }

        .container-image div:nth-child(odd) {
            background: white;
        }


        .vert .carousel-item-next.carousel-item-left,
        .vert .carousel-item-prev.carousel-item-right {
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }

        .vert .carousel-item-next,
        .vert .active.carousel-item-right {
            -webkit-transform: translate3d(0, 100%, 0);
            transform: translate3d(0, 100% 0);
        }

        .vert .carousel-item-prev,
        .vert .active.carousel-item-left {
            -webkit-transform: translate3d(0, -100%, 0);
            transform: translate3d(0, -100%, 0);
        }

        @media (min-width: 768px) {
            .col-md-2 {
                -ms-flex: 0 0 25%;
                flex: 0 0 25%;
                max-width: 18% !important;
            }
        }

        @media (min-width: 768px) {
            .col-md-3 {
                -ms-flex: 0 0 25%;
                flex: 0 0 25%;
                max-width: 19% !important;
            }
        }

        .carousel-caption {
            position: absolute;
            right: -1%;
            top: 0%;
            left: 0%;
            z-index: 10;
            padding-top: 10px;
            padding-bottom: 20px;
            color: #fff;
            text-align: center;
        }

        h1.h1 {
            margin-top: 0.25em !important;
            margin-bottom: 0.25em !important;
        }
    </style>
</head>

<body data-bgimg="">
    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="../../assets/images/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            <div class="row">
                <div class="col-md">
                    <div class="container">
                        <div class="row mt-9">
                            <div class="col-md text-center">
                                <h1 class="uppercase">PILPRES {{$kota['name']}}</h1>
                                <h5 class="uppercase">PROGRESS % DARI 100%</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <div class="main">
                        <div class="container-image">
                            @foreach ($paslon as $ps)
                            <div style="background-image: url({{asset('storage/'. $ps['picture'])}}); background-size: 500px; background-repeat: no-repeat; background-position: center">
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-left: 13.025%; margin-right: 13.025%; margin-top: 125px; background: #000;">
                @foreach ($paslon as $ps)
                <div class="col-md align-middle" style="border-right: 1px solid;">
                    <h1 class="text-center h1 fs-1 paslon{{$ps['id']}}">
                    </h1>
                </div>
                @endforeach

            </div>

            <div class="row fixed-bottom" style="height: 75px; bottom: 150px; width: 1800px; left:auto">

                <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <?php $count = 1; ?>
                        @foreach ($kecamatan as $item)
                        <?php $pasln = SaksiData::join('districts', 'districts.id', '=', 'saksi_data.district_id')->where('district_id', $item['id'])->get();
                        $jumlah =  SaksiData::where('district_id', $item['id'])->sum('voice');

                        ?>
                        <div class="carousel-item <?php if ($count++ == 1) : ?><?= 'active' ?><?php endif; ?>">
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

                                        @if (count($pasln) != 0)

                                        @foreach ($pasln as $psl)
                                        <?php $dolr = $psl['voice'] / $jumlah * 100;  ?>
                                        <div class="col-md-2 position-relative" style="background-color: white; height: 75px; overflow: hidden; color: #ced4da; border-right: 1px solid">
                                            <h1 class="fw-bolder" style="position: absolute; bottom: 8px; left: 16px;">
                                                0{{$psl['paslon_id']}}</h1>
                                            <img style="height: 100px; margin-bottom: 0.65em; margin-left: -100px;" src="{{asset('storage/'. $psl['picture'])}}" alt="">
                                            <h1 style="position: absolute; top: 10%; right: 20px; font-size: 35px; color: #1a1a1ac4" class="fw-bold">{{floor($dolr)}}%</h1>
                                            <h1 style="position: absolute; top: 75%; r
                                        ight: 20px; font-size: 9px; color: #1a1a1ac4" class="fw-bold">{{$psl['candidate']}} | {{$psl['deputy_candidate']}}</h1>
                                        </div>
                                        @endforeach
                                        @else
                                        @foreach ($paslon as $psl)

                                        <div class="col-md-2 position-relative" style="background-color: white; height: 75px; overflow: hidden; color: #ced4da; border-right: 1px solid">
                                            <h1 class="fw-bolder" style="position: absolute; bottom: 8px; left: 16px;">
                                                0{{$psl['id']}}</h1>
                                            <img style="height: 100px; margin-bottom: 0.65em; margin-left: -100px;" src="{{asset('storage/'. $psl['picture'])}}" alt="">
                                            <h1 style="position: absolute; top: 10%; right: 20px; font-size: 35px; color: #1a1a1ac4" class="fw-bold">0%</h1>
                                            <h1 style="position: absolute; top: 75%; r
                                    ight: 20px; font-size: 9px; color: #1a1a1ac4" class="fw-bold">{{$psl['candidate']}} | {{$psl['deputy_candidate']}}</h1>
                                        </div>
                                        @endforeach
                                        @endif


                                        <div class="col-md-3 position-relative" style="background-color: black; height: 75px; overflow: hidden; color: #ced4da;">
                                            <h1 style="position: absolute; top: 9%; left: 20px; font-size: 20px; color: white" class="fw-bold">Data Masuk</h1>
                                            <h1 style="position: absolute; top: 37%; left: 20px; font-size: 40px; color: white" class="fw-bold">95,70%</h1>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>

            </div>
        </div>

        <!-- FOOTER -->
        <footer class="footer" style="height: 65px; background-color: #000">
            <div class="row flex-row-reverse">
                <div class="col-md-12 col-xs-12 text-center">
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

<script src="../../assets/js/jquery.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    $(document).ready(function() {
        show_count();
        Pusher.logToConsole = true;
        var pusher = new Pusher('d3492f7a24c6c2d7ed0f', {
            cluster: 'ap1'
        });
        var channel = pusher.subscribe('messages');
        channel.bind('my-event', function(data) {
            show_count();
        });

        function show_count() {
            @foreach($paslon as $ps)
            var paslon {
                {
                    $ps['id']
                }
            } = '';
            @endforeach

            $.ajax({
                url: 'publik/ajax/real_count',
                type: 'GET',
                async: true,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    @foreach($paslon as $ps)
                    paslon {
                        {
                            $ps['id']
                        }
                    } += `${data.paslon{{$ps['id']}}}`,
                    $('.paslon{{$ps['
                        id ']}}').html(paslon {
                        {
                            $ps['id']
                        }
                    });
                    @endforeach

                }
            });
        }
    });
</script>