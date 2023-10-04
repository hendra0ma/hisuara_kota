<!-- {{$kelurahan['name']}}


<form action="/action_generate_security_kelurahan/{{encrypt($kelurahan['id'])}}" method="post">
    @csrf
    <x-jet-validation-errors class="mb-4" />
    <input type="text" name="password" required placeholder="Password" id="">
    <input type="text" name="password_confirmation" required id="" placeholder="Ulangi Password">
    <button type="submit">Submit</button>
</form> -->

@extends('layouts/auth')

@section('content')
<!-- BACKGROUND-IMAGE -->
<div class="login-img">
	<!-- GLOABAL LOADER -->
	<div id="global-loader">
		<img src="../../assets/images/loader.svg" class="loader-img" alt="Loader">
	</div>
	<!-- /GLOABAL LOADER -->
	<!-- PAGE -->
	<div class="page">
		<div class="">
			<!-- <div class="col col-login mx-auto">
				<div class="text-center">
					<img src="../../assets/images/brand/logo.png" class="header-brand-img" alt="">
				</div>
			</div> -->
		    <!-- CONTAINER OPEN -->
			<div class="container-login100">
				<div class="wrap-login100 p-0">
					<div class="card-body">
						<form class="login100-form validate-form" action="/action_generate_security_kelurahan/{{encrypt($kelurahan['id'])}}" method="post">
                            @csrf
							<div class="text-center mb-4">
								<img src="{{url('/')}}/assets/images/brand/logo-2.png" alt="lockscreen image" style="width: 75px" class="mb-2">
								<h4 class="fw-bold">Kelurahan {{$kelurahan['name']}}</h4>
							</div>
							<div class="wrap-input100 validate-input" data-bs-validate="Password is required">
								<input required class="input100" type="password" name="password" placeholder="Password">
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<i class="fa fa-lock" aria-hidden="true"></i>
								</span>
							</div>
							<div class="wrap-input100 validate-input" data-bs-validate="Password is required">
								<input required class="input100" type="password" name="password_confirmation" placeholder="Ulangi Password">
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
@endsection