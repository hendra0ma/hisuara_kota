@extends('layouts.auth-login')

@section('content')
    <div class="login-img" style="background: transparent; position: relative;">

        <!-- GLOABAL LOADER -->
        
        <div style="position: absolute; top: 63%; left: 50%; transform: translate(-50%, 0%) !important">
            <form class="login100-form validate-form" style="width: auto" method="POST" action="{{ route('login') }}">
                @csrf
                <input type="hidden" id="latitude" name="latitude">
                <input type="hidden" id="longitude" name="longitude">
                <div class="alert alert-success" id="kodeAlert" style="display:none">
                    Berhasil Generate kode akses, Silahkan cek Email Anda.
                </div>
            
                <x-jet-validation-errors class="mb-4" />
                <div class="row">
                    <div class="col-4">
                        <div class="wrap-input100 validate-input">
                            <input class="input100" type="text" name="email" placeholder="Masukkan No. KTP/No. Hp/Email" required>
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="zmdi zmdi-email" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="wrap-input100 validate-input" data-bs-validate="Password is required">
                            <input class="input100" type="password" name="password" placeholder="Password" required>
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="zmdi zmdi-lock" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="login100-form-btn" style="background-color: #6c757d!important;color:white">
                            Login
                        </button>
                    </div>
                    <div class="col-4">
                        <a href="#" class="text-primary ms-1" style="color: white !important">Forgot Password?</a>
                    </div>
                    <div class="col-4">
                        <p class="text-dark mb-0 text-white">Not a member?<a href="register-admin" class="text-primary ms-1"
                                style="color: white !important">Create an Account</a></p>
                    </div>
                </div>
            
                {{-- <div class="row justify-content-end">
                    <div class="col-6 text-end">
                        <a href="#" class="text-primary ms-1" style="color: white !important">Forgot Password?</a>
                    </div>
                </div>

                <div class="text-center pt-3">
                    <p class="text-dark mb-0 text-white">Not a member?<a href="register-admin"
                            class="text-primary ms-1" style="color: white !important">Create an Account</a></p>
                </div> --}}
            </form>
        </div>
    

    </div>
    
    <!-- End PAGE -->
    <script>
        // var x = document.getElementById("demo");
        // $(window).on('load', function() {
        //     getLocation()

        // });

        // function getLocation() {
        //     if (navigator.geolocation) {
        //         navigator.geolocation.getCurrentPosition(showPosition);
        //     } else {
        //         x.innerHTML = "Geolocation is not supported by this browser.";
        //     }
        // }

        // function showPosition(position) {
        //     document.getElementById("latitude").value = position.coords.latitude;
        //     document.getElementById("longitude").value = position.coords.longitude;

        // }


        // $("#pengajuan").on("click", function() {
        //     let email = $("form").find('input[name="email"]');
        //     if (email.val() == "") {
        //         alert("untuk melakukan pengajuan kode,email wajib di isi");
        //     } else {
        //         $(this).attr("disabled", true);
        //         $(this).html(`
        //     <lord-icon
        //     src="https://cdn.lordicon.com/ymrqtsej.json"
        //     trigger="loop"
        //     colors="primary:#121331"
        //     style="width:40px;height:40px">
        //     </lord-icon>  Sedang Meminta Kode
        //     `);
        //         let Containertime = $("p.containerTime");

        //         $.ajax({
        //             url: "{{ route('getAca') }}",
        //             type: "get",
        //             data: {
        //                 email: email.val(),
        //                 _token: "{{ csrf_token() }}"
        //             },
        //             dataType: "json",
        //             success: function(res) {
        //                 if (res.success != null) {
        //                     $("div#kodeAlert")
        //                         .removeClass("alert-danger")
        //                         .addClass("alert-success");
        //                     $("div#kodeAlert").html(res.success);
        //                     $("#pengajuan").html(`   <img src="<?= asset('') ?>assets/acakey_new_icon_key.png" style="width:20px;height:auto;">&nbsp;
        //                             Get Kode ACA`);
        //                     let time = 60;
        //                     $("#pengajuan").attr("disabled", true);
        //                     let timeOut = setInterval(function() {
        //                         Containertime.html(
        //                             `Kamu dapat mengajukan Kode Lagi <br> setelah ${time--} detik.`
        //                         );
        //                     }, 1000);
        //                     setTimeout(function() {
        //                         $("#pengajuan").attr("disabled", false);
        //                         $("#pengajuan").html(`   <img src="<?= asset('') ?>assets/acakey_new_icon_key.png" style="width:20px;height:auto;">&nbsp;
        //                             Get Kode ACA`);
        //                         clearInterval(timeOut);
        //                         Containertime.html("");
        //                     }, time * 1000 + 2000);
        //                 } else {
        //                     $("div#kodeAlert")
        //                         .removeClass("alert-success")
        //                         .addClass("alert-danger");
        //                     $("#pengajuan").attr("disabled", false);
        //                     $("#pengajuan").html(`   <img src="<?= asset('') ?>assets/acakey_new_icon_key.png" style="width:20px;height:auto;">&nbsp;
        //                             Get Kode ACA`);
        //                     $("div#kodeAlert").html(res.error);
        //                 }

        //                 $("div#kodeAlert").show(100, function() {
        //                     setTimeout(function() {
        //                         $("div#kodeAlert").hide(200);
        //                     }, 10000);
        //                 });
        //             },
        //         });
        //     }
        // });
    </script>
@endsection
