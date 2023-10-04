@extends('layouts/auth')

@section('content')


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
                        <form class="login100-form validate-form" action="{{route('security.actionLog',$village_id)}}" method="post">
                            @csrf
                            <div class="text-center mb-4">
                                <img src="{{url('/')}}/assets/images/brand/logo-2.png" alt="lockscreen image" style="width: 75px" class="mb-2">
                                <h4 class="fw-bold">Masukkan Password</h4>
                            </div>
                            @if ($message = Session::get('success'))
                            <div class="alert alert-danger alert-block">
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
                                    submit
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                            <h5 class="fw-semibold text-center">
                                www.rekapitung.id
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <!-- End GLOABAL LOADER -->
</div>



@endsection