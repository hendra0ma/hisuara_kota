@extends('layouts.auth')

@section('content')
    <div class="login-img" style="background: transparent">

        <!-- GLOABAL LOADER -->
        <div id="global-loader">
            <img src="{{ asset('') }}assets/images/loader.svg" class="loader-img" alt="Loader">
        </div>
        <!-- /GLOABAL LOADER -->

        <!-- PAGE -->
        <div class="page">
            <div class="">
                <!-- CONTAINER OPEN -->
                {{-- <div class="col col-login mx-auto">
                    <div class="text-center">
                        <img src="{{ asset('') }}images/logo/hisuara.png"
                            class="img-fluid img-thumbnail bg-dark shadow-lg border-0" style="width:100px;height:auto;"
                            alt="">
                    </div>
                </div> --}}
                <div class="container-login100 d-flex">
                    <div class="wrap-login100 p-0">
                        <div class="card-body">
                            
                            <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                                @csrf
                                <input type="hidden" id="latitude" name="latitude">
                                <input type="hidden" id="longitude" name="longitude">
                                <span class="login100-form-title">
                                    Login
                                </span>
                                <div class="alert alert-success" id="kodeAlert" style="display:none">
                                    Berhasil Generate kode akses, Silahkan cek Email Anda.
                                </div>

                                <x-jet-validation-errors class="mb-4" />
                                <div class="wrap-input100 validate-input">
                                    <input class="input100" type="text" name="email"
                                        placeholder="Masukkan No. KTP/No. Hp/Email" required>
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                        <i class="zmdi zmdi-email" aria-hidden="true"></i>
                                    </span>
                                </div>

                                <div class="wrap-input100 validate-input" data-bs-validate="Password is required">
                                    <input class="input100" type="password" name="password" placeholder="Password" required>
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                        <i class="zmdi zmdi-lock" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <center>




                                    <!-- <div class="wrap-input100 validate-input">
                                        <div class="otp-input-wrapper">
                                            <input type="text" maxlength="6" pattern="[0-9]*" autocomplete="off"
                                                name="acakey" required>
                                            <svg viewBox="0 0 240 2" xmlns="http://www.w3.org/2000/svg">
                                                <line x1="0" y1="0" x2="400" y2="1" stroke="#3e3e3e" stroke-width="2"
                                                    stroke-dasharray="20" />
                                            </svg>
                                        </div>
                                    </div> -->
                                    <div class="col-lg-12">
                                        <p class="containerTime text-danger text-center">

                                        </p>
                                    </div>
                                    <!-- <div class="container-login100-form-btn">
                                        <button class="login100-form-btn btn-danger text-white p-1 mt-2" id="pengajuan">
                                            <img src="<?= asset('') ?>assets/acakey_new_icon_key.png"
                                                style="width:20px;height:auto;">&nbsp;
                                            Get Kode ACA
                                        </button>
                                    </div> -->
                                </center>

                                <div class="row justify-content-end">
                                    <!-- <div class="col-6">
                                        <a href="https://www.acakey.com/info" class="text-primary ms-1">Apa Itu Acakey?</a>
                                    </div> -->
                                    <div class="col-6 text-end">
                                        <a href="#" class="text-primary ms-1">Forgot Password?</a>
                                    </div>
                                </div>

                                <div class="container-login100-form-btn">
                                    <button type="submit"
                                        class="login100-form-btn"style="background-color: #6c757d!important;color:white">
                                        Login
                                    </button>
                                </div>
                                <div class="text-center pt-3">
                                    <p class="text-dark mb-0">Not a member?<a href="register-admin"
                                            class="text-primary ms-1">Create an Account</a></p>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <h5 class="fw-semibold text-center">
                                www.hisuara.id
                            </h5>
                        </div>
                    </div>
                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
    

    </div>
    
    <!-- End PAGE -->
    <script>
        var x = document.getElementById("demo");
        $(window).on('load', function() {
            getLocation()

        });

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            document.getElementById("latitude").value = position.coords.latitude;
            document.getElementById("longitude").value = position.coords.longitude;

        }


        $("#pengajuan").on("click", function() {
            let email = $("form").find('input[name="email"]');
            if (email.val() == "") {
                alert("untuk melakukan pengajuan kode,email wajib di isi");
            } else {
                $(this).attr("disabled", true);
                $(this).html(`
            <lord-icon
            src="https://cdn.lordicon.com/ymrqtsej.json"
            trigger="loop"
            colors="primary:#121331"
            style="width:40px;height:40px">
            </lord-icon>  Sedang Meminta Kode
            `);
                let Containertime = $("p.containerTime");

                $.ajax({
                    url: "{{ route('getAca') }}",
                    type: "get",
                    data: {
                        email: email.val(),
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(res) {
                        if (res.success != null) {
                            $("div#kodeAlert")
                                .removeClass("alert-danger")
                                .addClass("alert-success");
                            $("div#kodeAlert").html(res.success);
                            $("#pengajuan").html(`   <img src="<?= asset('') ?>assets/acakey_new_icon_key.png" style="width:20px;height:auto;">&nbsp;
                                    Get Kode ACA`);
                            let time = 60;
                            $("#pengajuan").attr("disabled", true);
                            let timeOut = setInterval(function() {
                                Containertime.html(
                                    `Kamu dapat mengajukan Kode Lagi <br> setelah ${time--} detik.`
                                );
                            }, 1000);
                            setTimeout(function() {
                                $("#pengajuan").attr("disabled", false);
                                $("#pengajuan").html(`   <img src="<?= asset('') ?>assets/acakey_new_icon_key.png" style="width:20px;height:auto;">&nbsp;
                                    Get Kode ACA`);
                                clearInterval(timeOut);
                                Containertime.html("");
                            }, time * 1000 + 2000);
                        } else {
                            $("div#kodeAlert")
                                .removeClass("alert-success")
                                .addClass("alert-danger");
                            $("#pengajuan").attr("disabled", false);
                            $("#pengajuan").html(`   <img src="<?= asset('') ?>assets/acakey_new_icon_key.png" style="width:20px;height:auto;">&nbsp;
                                    Get Kode ACA`);
                            $("div#kodeAlert").html(res.error);
                        }

                        $("div#kodeAlert").show(100, function() {
                            setTimeout(function() {
                                $("div#kodeAlert").hide(200);
                            }, 10000);
                        });
                    },
                });
            }
        });
    </script>
@endsection
