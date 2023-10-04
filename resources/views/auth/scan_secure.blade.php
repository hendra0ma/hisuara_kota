@extends('layouts.auth')

@section('content')



<div class="login-img">

    <!-- GLOABAL LOADER -->
    <div id="global-loader">
        <img src="{{asset('')}}assets/images/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOABAL LOADER -->

    <!-- PAGE -->
    <div class="page" style="min-height: 80vh;">
        
     
        <div class="">
            <div class="text-center mx-auto mb-5">
                <img src="{{asset('')}}assets/images/brand/logo.png" class="img-fluid" style="width:200px;height:auto;"
                    alt="">
            </div>
            <!-- CONTAINER OPEN -->
            <div class="col col-login mx-auto">

            </div>
            <div class="container-login100 d-flex">
                <div class="wrap-login100 p-0">
                    <div class="card-body">
                        @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        <form class="login100-form validate-form" method="get"
                            action="{{ url('')}}/scanning/{{$nomor_berkas}}">
                            @csrf
                            <div class="wrap-input100 validate-input" data-bs-validate="Password is required">
                                <input class="input100" type="password" name="password" placeholder="Password" required>
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="zmdi zmdi-lock" aria-hidden="true"></i>
                                </span>
                            </div>

                            <div class="container-login100-form-btn">
                                <button type="submit" class="login100-form-btn"
                                    style="background-color: #6c757d!important;color:white">
                                    Submit
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
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <section class="bg-light" style="height: 2px;">
        <div class="container">
            <img style="display: block; margin-left: auto; margin-right: auto;"
                src="{{asset('/')}}assets/acakey_new.png" width="150px" class="pt-5 mb-5">
            <div class="text-center pb-5" style="font-size: 13px;">
                © PT.Mahadaya Swara Teknologi <br />
                All Right Reserved 2021
            </div>
        </div>
    </section>
    <!-- End PAGE -->

</div>


@endsection
