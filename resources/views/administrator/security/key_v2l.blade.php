
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
    
    @if($judul == "Fraud Data Print (FDP)")
     <style>
     .login-img {
    background: #000000;
}
 </style>
 
    @endif
     @if($judul == "Fraud Barcode Report (FBR)")
     <style>
     .login-img {
    background: #000000;
}
 </style>
 
    @endif
      @if($judul == "Indeks TSM Pemilu")
     <style>
     .login-img {
    background: #000000;
}
 </style>
 
    @endif
        @if($judul == "Komparasi KPU Tingkat Kota")
     <style>
     .login-img {
    background: #000000;
}
 </style>
 
    @endif

</head>

<body class="">

<div class="login-img">
	<!-- GLOABAL LOADER -->
	<div id="global-loader">
		<img src="{{url('/')}}/assets/images/loader.svg" class="loader-img" alt="Loader">
	</div>
	<!-- /GLOABAL LOADER -->
	<!-- PAGE -->
	<div class="page">
		<div class="">
			<!-- <div class="col col-login mx-auto">
				<div class="text-center">
					<img src="{{url('/')}}/assets/images/brand/logo.png" class="header-brand-img" alt="">
				</div>
			</div> -->
			<!-- CONTAINER OPEN -->
			<div class="container-login100">
				<div class="wrap-login100 p-0">
					<div class="card-body">
						<form class="login100-form validate-form" action="/action_v2l_security/{{$role}}" method="post">
							@csrf
							<div class="text-center mb-4">
								<img src="{{url('/')}}/assets/images/brand/logo-2.png" alt="lockscreen image" style="width: 75px" class="mb-2">
								<h4 class="fw-bold"style="line-height: 1.3">
                                    {{$config['jenis_pemilu']}}  {{$config['tahun']}} <br>    
                                {{ $judul }}</h4>
																
    @if($judul == "Fraud Data Print (FDP)")
     <img src="https://t4.ftcdn.net/jpg/02/94/39/47/360_F_294394705_O7dz4ofzsaioltW7rkXkFyRa6Vj4ZIco.jpg" class="img-fluid">
 
    @endif
    @if($judul == "Fraud Barcode Report (FBR)")
     <img src="https://t4.ftcdn.net/jpg/02/94/39/47/360_F_294394705_O7dz4ofzsaioltW7rkXkFyRa6Vj4ZIco.jpg" class="img-fluid">
 
    @endif
     @if($judul == "Indeks TSM Pemilu")
     <img src="https://t4.ftcdn.net/jpg/02/94/39/47/360_F_294394705_O7dz4ofzsaioltW7rkXkFyRa6Vj4ZIco.jpg" class="img-fluid">
 
    @endif
      @if($judul == "Komparasi KPU Tingkat Kota")
     <img src="https://t4.ftcdn.net/jpg/02/94/39/47/360_F_294394705_O7dz4ofzsaioltW7rkXkFyRa6Vj4ZIco.jpg" class="img-fluid">
 
    @endif
    
    
							</div>
							@if ($message = Session::get('success'))
							<div class="alert alert-success alert-block">
								<button type="button" class="close" data-dismiss="alert">×</button>
								<strong>{{ $message }}</strong>
							</div>
							@endif
							@if ($message = Session::get('error'))
							<div class="alert alert-danger alert-block">
								<button type="button" class="close" data-dismiss="alert">×</button>
								<strong>{{ $message }}</strong>
							</div>
							@endif
							<div class="wrap-input100 validate-input" data-bs-validate="Password is required">
								<input required class="input100" type="password" name="password" placeholder="Password">
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<i class="fa fa-lock" aria-hidden="true"></i>
								</span>
							</div>
							<div class="container-login100-form-btn">
								<button type="submit" class="login100-form-btn btn-primary">
									Unlock
								</button>
							</div>
						</form>
					</div>
					<div class="card-footer pt-0">
						<div class="d-flex justify-content-center my-3">
                            <h5 class="fw-bold mb-0">www.rekapitung.id</h5>
							{{-- <a href="" class="social-login  text-center me-4">
								<i class="fa fa-google"></i>
							</a>
							<a href="" class="social-login  text-center me-4">
								<i class="fa fa-facebook"></i>
							</a>
							<a href="" class="social-login  text-center">
								<i class="fa fa-twitter"></i>
							</a> --}}
						</div>
					</div>
				</div>
			</div>
			<!-- CONTAINER CLOSED -->
		</div>
	</div>
	<!-- End GLOABAL LOADER -->
</div>
<!-- BACKGROUND-IMAGE CLOSED -->

    <!-- BACKGROUND-IMAGE CLOSED -->

    <!-- JQUERY JS -->
    <script src="../../assets/js/jquery.min.js"></script>

    <!-- BOOTSTRAP JS -->
    <script src="../../assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

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
