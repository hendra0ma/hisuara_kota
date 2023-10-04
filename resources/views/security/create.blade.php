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

            <!-- CONTAINER OPEN -->
            <div class="container-login100">
                <div class="wrap-login100 p-0">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <img src="{{url('/')}}/assets/images/brand/logo-2.png" alt="lockscreen image"
                                style="width: 75px" class="mb-2">
                            <h4 class="fw-bold">Daftar Password Baru</h4>
                        </div>
                        @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade show text-dark mt-2 mb-2" role="alert">
                            {{ Session::get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close">X</button>
                        </div>
                        @endif
                        <form action="{{ route('security.store', $village_id) }}" method="post"
                            class="login100-form validate-form">
                            @csrf
                            <x-jet-validation-errors class="mb-4" />
                            <div class="wrap-input100 validate-input" data-bs-validate="Password is required">
                                <input required class="input100" type="password" name="password" placeholder="Password">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="wrap-input100 validate-input" data-bs-validate="Password is required">
                                <input type="password" name="password_confirmation" id="" required class="input100"
                                    placeholder="Password Confirmation">
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
        </div>
    </div>
</div>
@endsection
