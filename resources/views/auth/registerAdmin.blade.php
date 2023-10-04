@extends('layouts.auth')

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
            <div class="col col-login mx-auto mt-9">
                <div class="text-center">
                    <img src="../../assets/images/brand/logo.png" class="header-brand-img" alt="">
                </div>
            </div>
            <div class="container mt-3 mb-7">
                <div class="row justify-content-sm-center">
                    <div class="col-lg-6">
                        <div class="wrap-login100 p-0">
                         
                            <div class="card-body">
                                <form class="justify-content-center  validate-form" method="POST" action="{{ route('storeRegister.admin') }}">
                                    @csrf
                                    <span class="login100-form-title">
                                        Registration
                                    </span>
                                       <x-jet-validation-errors class="mb-4" />
                                    <div class="wrap-input100 validate-input">
                                        <input class="input100" type="text" name="nik"
                                            placeholder="Masukkan Nomor Induk Kependudukan (No. KTP)"
                                            maxlength="16" :value="old('nik')" autocomplete="nik">
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="mdi mdi-account-card-details" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="wrap-input100 validate-input">
                                        <input class="input100" type="text"  name="name"
                                            placeholder="Masukkan Nama Lengkap" :value="old('name')">
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="mdi mdi-account" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="wrap-input100 validate-input">
                                        <input class="input100" type="text" name="alamat"
                                            placeholder="Masukkan Alamat Lengkap" :value="old('alamat')">
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="mdi mdi-home" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="wrap-input100 validate-input"
                                        data-bs-validate="Valid email is required: ex@abc.xyz">
                                        <input class="input100" type="text" name="email"
                                            placeholder="Masukkan Alamat Email" :value="old('email')">
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="zmdi zmdi-email" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="wrap-input100 validate-input">
                                        <input class="input100" type="text" name="no_hp"
                                            placeholder="Masukkan Nomor Handphone" :value="old('no_hp')">
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="mdi mdi-cellphone" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="wrap-input100 validate-input"
                                        data-bs-validate="Password is required">
                                        <input class="input100" type="password" name="password"
                                            placeholder="Masukkan Password">
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="zmdi zmdi-lock" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="wrap-input100 validate-input"
                                        data-bs-validate="Password is required">
                                        <input class="input100" type="password" name="password_confirmation"
                                            placeholder="Masukkan Ulang Password">
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="zmdi zmdi-lock" aria-hidden="true"></i>
                                        </span>
                                    </div>
          
                                    <div class="form-group">
                                        <select class="form-control select2-show-search form-select" name="role_id" id="kecamatan">
                                            <option value="{{Crypt::encryptString('2')}}">Verifikator</option>
                                            <option value="{{Crypt::encryptString('3')}}">Auditor Forensik</option>
                                            <option value="{{Crypt::encryptString('9')}}">Komparasi</option>
                                            <option value="{{Crypt::encryptString('5')}}">Checking Overlimit</option>
                                            <option value="{{Crypt::encryptString('6')}}">Checking Hunter</option>
                                            <option value="{{Crypt::encryptString('20')}}">Otentifikasi</option>
                                            <option value="{{Crypt::encryptString('26')}}">Luar Negeri</option>
                                              <option value="{{Crypt::encryptString('12')}}">Payrole Saksi</option>
                              <option value="{{Crypt::encryptString('7')}}">Validator Hukum</option>
                               <option value="{{Crypt::encryptString('7')}}">Tim Hukum Paslon</option>
                                <option value="{{Crypt::encryptString('7')}}">Bawaslu</option>
                                 <option value="{{Crypt::encryptString('25')}}">Mahkamah Konstitusi</option>
                                        </select>
                                     
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control select2-show-search form-select" name="kecamatan" id="kecamatan">
                                            <option hidden>Pilih Kecamatan</option>
                                            @foreach ($kec as $kc)
                                            <option value="{{ $kc->id }}">{{ $kc->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        {!! Geetest::render() !!}
                                    </div>
                                 
                                    <label class="custom-control custom-checkbox mt-4">
                                        <input type="checkbox" class="custom-control-input">
                                        <span class="custom-control-label">Agree the <a href="terms.html">terms and
                                                policy</a></span>
                                    </label>
                                    <div class="container-login100-form-btn">
                                        <button type="submit" class="login100-form-btn btn-primary">
                                            Register
                                        </button>
                                    </div>
                                    <div class="text-center pt-3">
                                        <p class="text-dark mb-0">Already have account?<a href="login.html"
                                                class="text-primary ms-1">Sign In</a></p>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-center my-3">
                                    <a href="" class="social-login  text-center me-4">
                                        <i class="fa fa-google"></i>
                                    </a>
                                    <a href="" class="social-login  text-center me-4">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                    <a href="" class="social-login  text-center">
                                        <i class="fa fa-whatsapp"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <section class="bg-light" style="height: 10px;">
                <div class="container">
                    <img style="display: block; margin-left: auto; margin-right: auto;"
                        src="../../assets/images/acakey_new.png" width="250px" class="pt-5 mb-5">
                    <div class="text-center pb-5" style="font-size: 13px;">
                        © PT.Mahadaya Swara Teknologi <br />
                        All Right Reserved 2021
                    </div>
                </div>
            </section>
            <!-- CONTAINER CLOSED -->
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <!-- END PAGE -->

</div>
@endsection