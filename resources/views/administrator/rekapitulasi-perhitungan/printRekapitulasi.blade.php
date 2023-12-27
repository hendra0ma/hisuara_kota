
<?php

use App\Models\Config;
use App\Models\Regency;
use App\Models\Configs;
use App\Models\RegenciesDomain;
use App\Models\Saksi;

$configs = Config::first();
$currentDomain = request()->getHttpHost();
if (isset(parse_url($currentDomain)['port'])) {
    $url = substr($currentDomain, 0, strpos($currentDomain, ':8000'));
}else{
    $url = $currentDomain;
}
$regency_id = RegenciesDomain::where('domain',"LIKE","%".$url."%")->first();

$reg = App\Models\Regency::where('id', $regency_id->regency_id)->first();

$config = new Configs;
$config->regencies_id =  (string) $regency_id->regency_id;


$kota = Regency::where('id', $config->regencies_id)->first();

?>
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
        @media screen and (max-width: 1366px) and (min-width: 768px) {
            body {
                min-width: 1903px;
                -moz-transform: scale(0.7091352);
                -moz-transform-origin: 0 0;
                transform: scale(0.7091352);
                transform-origin: 0 0;
            }
        }

        @media print {
            .ganti-paper {
                page-break-before: always;
            }
        }

        @media screen and (max-width: 767px) {
            body {
                min-width: 1903px;
                -moz-transform: scale(0.611309135);
                -moz-transform-origin: 0 0;
                transform: scale(0.611309135);
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

        .parent-link a.active-tab.tablink2 {
            background: #ed1d27 !important;
        }

        .parent-link a.active-tab.tablink2:after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            right: 0;
            width: 40%;
            border-top: 3px solid #ed1d27 !important;
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

        .parent-link a.tablink2 {
            background: #ed1d2780;
        }

        .parent-link a.tablink2:hover {
            background: #ed1d27 !important;
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
            z-index: 30;
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




<div class="container">


    <div id="urutan-suara-terbanyak">
        <div class="text-center title-atas-table fs-5 mb-0 fw-bold">Hasil Perhitungan Suara</div>
        <div class="text-center title-atas-table fs-5 mb-0 fw-bold">Pemilihan Presiden dan Wakil
            Presiden</div>
        <div class="text-center title-atas-table fs-5 fw-bold">{{ $kota['name'] }}</div>
        <div class="row">
            <div class="col-auto fw-bold text-center fs-4 d-flex">
                <div class="mt-auto">
                    Suara Terbanyak
                </div>
            </div>
            <div class="col">
                <div class="row mx-auto">
                    @foreach ($urutan as $urutPaslon)
                    <?php $pasangan = App\Models\Paslon::where('id', $urutPaslon->paslon_id)->first(); ?>
                    <div class="col py-2 judul text-center custom-urutan">
                        <div class="text">{{ $pasangan->candidate }} || {{ $pasangan->deputy_candidate }} :
                            {{$urutPaslon->total}}</b>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

    <table class="table table-bordered table-hover mt-3 display">
        <thead>
            <tr>
                <th class="align-middle text-dark text-center align-middle" rowspan="2">TPS</th>
                @foreach ($paslon_candidate as $item)
                <th class="text-dark text-center align-middle" style="position:relative">
                    <img style="width: 60px; position: absolute; left: 0; bottom: 0" src="{{asset('')}}storage/{{$item->picture}}" alt="">
                    <div class="ms-7">
                        {{ $item['candidate']}} - <br>
                        {{ $item['deputy_candidate']}}
                    </div>
                </th>
                @endforeach

            </tr>
        </thead>

        <tbody>
            <?php $totalSaksiDataa = [];  ?>
            @foreach ($paslon as $cd)
            <?php $totalSaksiDataa[$cd['id']] = 0; ?>
            @endforeach
            @foreach ($tps_kel as $item)


            <tr data-id="{{$item['id']}}" data-bs-toggle="modal" class="modal-id" data-bs-target="#modal-id">
                <td> <a href="{{url('')}}/administrator/rekap_tps/{{Crypt::encrypt($item->id)}}" class="modal-id" style="font-size: 0.8em;" id="Cek">TPS
                        {{$item['number']}}</a>
                    @foreach ($paslon_candidate as $cd)

                    <?php
                    $tpsass = \App\Models\Tps::where('number', (string)$item['number'])->where('villages_id', (string)$id)->first(); ?>
                    <?php $saksi_data = \App\Models\SaksiData::join('saksi', 'saksi.id', '=', 'saksi_data.saksi_id')->where('paslon_id', $cd['id'])->where('tps_id', $tpsass->id)->sum('voice'); ?>
                <td class="text-end">{{$saksi_data}}</td>
                <?php
                $totalSaksiDataa[$cd['id']] += $saksi_data; ?>
                @endforeach
            </tr>
            @endforeach
            <tr style="background-color: #cccccc">
                <td class="align-middle">
                    <div class="fw-bold">Total</div>
                </td>

                @foreach ($paslon as $cd)
                <td class="align-middle text-end">{{$totalSaksiDataa[$cd['id']]}}</td>
                @endforeach
            </tr>
        </tbody>
    </table>
    <?php $saksiVillage = Saksi::where('village_id',$id)->select('c1_images')->get(); ?>
    @foreach ($saksiVillage as $sv)
    <div class="ganti-paper">
        <img src="{{asset('')}}storage/{{$sv->c1_images}}" alt="" srcset="">
    </div>
    @endforeach
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

<!-- CHARTJS CHART JS-->
<script src="../../assets/plugins/chart/Chart.bundle.js"></script>
<script src="../../assets/plugins/chart/utils.js"></script>

<!-- PIETY CHART JS-->
<script src="../../assets/plugins/peitychart/jquery.peity.min.js"></script>
<script src="../../assets/plugins/peitychart/peitychart.init.js"></script>

<!-- INTERNAL SELECT2 JS -->
<script src="../../assets/plugins/select2/select2.full.min.js"></script>

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

<!-- ECHART JS-->
<script src="../../assets/plugins/echarts/echarts.js"></script>

<!-- SIDE-MENU JS-->
<script src="../../assets/plugins/sidemenu/sidemenu.js"></script>

<!-- SIDEBAR JS -->
<script src="../../assets/plugins/sidebar/sidebar.js"></script>

<!-- Perfect SCROLLBAR JS-->
<script src="../../assets/plugins/p-scroll/perfect-scrollbar.js"></script>
<script src="../../assets/plugins/p-scroll/pscroll.js"></script>
<script src="../../assets/plugins/p-scroll/pscroll-1.js"></script>

<!-- APEXCHART JS -->
<script src="../../assets/js/apexcharts.js"></script>

<!-- INDEX JS -->
<script src="../../assets/js/index1.js"></script>

<!-- CUSTOM JS -->
<script src="../../assets/js/custom.js"></script>

<!-- C3 CHART JS -->
<script src="../../assets/plugins/charts-c3/d3.v5.min.js"></script>
<script src="../../assets/plugins/charts-c3/c3-chart.js"></script>
<!-- INTERNAL Notifications js -->
<script src="../../assets/plugins/notify/js/rainbow.js"></script>
<script src="../../assets/plugins/notify/js/sample.js"></script>
<script src="../../assets/plugins/notify/js/jquery.growl.js"></script>
<script src="../../assets/plugins/notify/js/notifIt.js"></script>

<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.2/velocity.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.2/velocity.ui.min.js"></script>


<script src="{{url('/')}}/assets/plugins/input-mask/jquery.mask.min.js"></script>
<script src="https://raw.githack.com/thdoan/magnify/master/dist/js/jquery.magnify.js"></script>
<script src="https://raw.githack.com/thdoan/magnify/master/dist/js/jquery.magnify-mobile.js"></script>






<script src="https://cdn.jsdelivr.net/npm/exif-js"></script>
<script>
    function afterPrintOrDelay() {
        // location.href = "{{url()->previous()}}";
    }
    if (window.matchMedia) {
        var mediaQueryList = window.matchMedia('print');
        mediaQueryList.addListener(function(mql) {
            if (!mql.matches) {
                afterPrintOrDelay();
            }
        });
    }

    window.onafterprint = function() {
        afterPrintOrDelay();
    };

    window.print();

    setTimeout(afterPrintOrDelay, 5000);
</script>

</body>

</html>