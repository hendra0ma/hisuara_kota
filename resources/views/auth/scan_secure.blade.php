@extends('layouts.auth')

@section('content')


<div class="login-img bg-dark">

    <!-- GLOABAL LOADER -->
    <div id="global-loader">
        <img src="{{ asset('') }}assets/images/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOABAL LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="">
            <!-- CONTAINER OPEN -->
            <div class="col col-login mx-auto">
                <div class="text-center">
                    <img src="{{ asset('') }}images/logo/hisuara.png"
                        class="img-fluid img-thumbnail bg-dark shadow-lg border-0" style="width:100px;height:auto;"
                        alt="">
                </div>
            </div>
            <div class="container-login100 d-flex">
                <div class="wrap-login100 p-0">
                    <div class="card-body">
                        @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        <form class="login100-form validate-form" method="get" action="{{ url('')}}/scanning/{{$nomor_berkas}}">
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
                </div>
            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>

</div>
<section class="bg-light" style="height: 10gitpx;">
    <div class="container">
        <div class="text-center py-5 " style="font-size: 13px;">
            © PT.Hisuara Smart Count <br />
            All Right Reserved 2021
        </div>
    </div>
</section>


@endsection
