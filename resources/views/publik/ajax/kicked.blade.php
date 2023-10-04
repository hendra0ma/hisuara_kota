<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
   <link href="../../assets/css/icons.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
 	<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="Zanex – Bootstrap  Admin & Dashboard Template">
		<meta name="author" content="Spruko Technologies Private Limited">
		<meta name="keywords" content="admin, dashboard, dashboard ui, admin dashboard template, admin panel dashboard, admin panel html, admin panel html template, admin panel template, admin ui templates, administrative templates, best admin dashboard, best admin templates, bootstrap 4 admin template, bootstrap admin dashboard, bootstrap admin panel, html css admin templates, html5 admin template, premium bootstrap templates, responsive admin template, template admin bootstrap 4, themeforest html">

		<!-- FAVICON -->
		<link rel="shortcut icon" type="image/x-icon" href="../../assets/images/brand/favicon.ico" />

		<!-- TITLE -->
		<title>Zanex – Bootstrap  Admin & Dashboard Template</title>

		<!-- BOOTSTRAP CSS -->
		<link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

		<!-- STYLE CSS -->
		<link href="../../assets/css/style.css" rel="stylesheet"/>
		<link href="../../assets/css/dark-style.css" rel="stylesheet"/>
		<link href="../../assets/css/skin-modes.css" rel="stylesheet" />

		<!-- SIDE-MENU CSS -->
		<link href="../../assets/css/sidemenu.css" rel="stylesheet" id="sidemenu-theme">

		<!--C3.JS CHARTS PLUGIN -->
		<link href="../../assets/plugins/charts-c3/c3-chart.css" rel="stylesheet"/>

		<!-- P-scroll bar css-->
		<link href="../../assets/plugins/p-scroll/perfect-scrollbar.css" rel="stylesheet" />

		<!--- FONT-ICONS CSS -->
		<link href="../../assets/css/icons.css" rel="stylesheet"/>

		<!-- COLOR SKIN CSS -->
		<link id="theme" rel="stylesheet" type="text/css" media="all" href="../../assets/colors/color1.css" />
    <title>Checked!</title>
</head>


<body>
    <div class="container">
        <div class="col-lg-12 mt-4">
            <div class="card">
                <div class="card-header bg-danger">
                  <h3 class="text-white mx-auto">Akun Anda Telah Dikeluarkan!!!</h3>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center mb-3">
                        <!--<div class="col-lg-12 text-center mb-3">-->
                        <!--    <i class="mdi mdi-account-multiple text-danger"></i>-->
                        <!--</div>-->
                        <div class="col-lg-12 text-center">
                           <div class="card">
                               <div class="card-body text-danger">
                             <b>  <h4 class="text-uppercase">Anda diduga telah melakukan pelanggaran dengan memasuki sistem <b>REKAPITUNG</b> Tapa izin.
                            Anda dapat dikenakan pidana berdasarkan "Pasal 30 UU No 11 Tahun 2008 Tentang Informasi dan transaksi elektronik (UU ITE)".
                            Ancaman Berupa pidana penjara paling lama 8 (Delapan) Tahun dan atau denda paling banyak 800 Juta Rupiah (Pasal 51 Ayat 1 UU ITE).</h5></b>
                               </div>
                           </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-lg-6">
                            <div id="mapid" style="width: auto; height: 400px;"></div>
                        </div>
                        <div class="col-lg-6">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Track</th>
                                        <th scope="col">Hasil</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Longtitude</td>
                                        <td> <?= $track['longitude'] ?></td>

                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Latitude</td>
                                        <td> <?= $track['latitude'] ?></td>

                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>IP ADDRESS</td>
                                        <td> <?= $track['ip_address'] ?></td>

                                    </tr>
                                   
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-12 mt-3">
                             <form action="{{ route('logout') }}" method="post">
                        @csrf


                        <a  class="btn btn-primary btn-block" onclick="$($(this).parent()).submit()" style="cursor: pointer;">
                            <i class="side-menu__icon mdi mdi-logout"></i> Sign out
                        </a>
                    </form>

                         
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

		<!-- SPARKLINE -->
		<script src="../../assets/js/jquery.sparkline.min.js"></script>

		<!-- CHART-CIRCLE -->
		<script src="../../assets/js/circle-progress.min.js"></script>

		<!-- Perfect SCROLLBAR JS-->
		<script src="../../assets/plugins/p-scroll/perfect-scrollbar.js"></script>

		<!-- INPUT MASK PLUGIN-->
		<script src="../../assets/plugins/input-mask/jquery.mask.min.js"></script>

		<!-- CUSTOM JS-->
		<script src="../../assets/js/custom.js"></script>

	</body>
</html>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
<script>
    var mymap = L.map('mapid').setView([<?= $track['latitude'] ?>, <?= $track['longitude'] ?>], 13);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiaXNhYTIxIiwiYSI6ImNsZnc5dmQ3NDBmMjUzcW8zZzg0c2RnazgifQ.mphOBqpgqHl5ONLL092Txw', {
        maxZoom: 18,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1
    }).addTo(mymap);

    L.marker([<?= $track['latitude'] ?>, <?= $track['longitude'] ?>]).addTo(mymap)
        .bindPopup("<b>Lokasi Anda").openPopup();
    var popup = L.popup();

    // function onMapClick(e) {
    //     popup
    //         .setLatLng(e.latlng)
    //         .setContent("You clicked the map at " + e.latlng.toString())
    //         .openOn(mymap);
    // }

    mymap.on('click', onMapClick);
</script>

</html>