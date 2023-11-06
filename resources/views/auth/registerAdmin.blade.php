@extends('layouts.auth')

@section('content')
<div class="login-img bg-dark">

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
                                <form class="justify-content-center  validate-form" method="POST" action="{{ route('storeRegister.admin') }}"enctype="multipart/form-data">
                                    @csrf
                                    <span class="login100-form-title">
                                        Registration
                                    </span>
                                    <x-jet-validation-errors class="mb-4" />

                                    @if(Session::flash("error"))
                                    <div class="alert alert-danger" role="alert">
                                        {{Session::flash('error')}}
                                    </div>
                                    @endif

                                    <div class="form-group">
                                        <select class="form-control select2-show-search form-select" name="role_id" id="role">
                                            <option disabled selected>Pilih Role</option>
                                            <option value="tps|8">Saksi</option>
                                            <option value="tps|16">Enumerator</option>
                                            <option value="tdk|17">Crowd C1</option>
                                            <option value="tdk|9">Rekapitulator</option>
                                            <option value="tps|14">Relawan Tps</option>
                                            <option value="tdk|1">Admin</option>
                                        </select>

                                    </div>
                                    <div class="wrap-input100 validate-input">
                                        <input class="input100" type="text" name="nik" placeholder="Masukkan Nomor Induk Kependudukan (No. KTP)" maxlength="16" autocomplete="nik">
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="mdi mdi-account-card-details" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="wrap-input100 validate-input">
                                        <input class="input100" type="text" name="name" placeholder="Masukkan Nama Lengkap">
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="mdi mdi-account" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="wrap-input100 validate-input">
                                        <input class="input100" type="text" name="alamat" placeholder="Masukkan Alamat Lengkap" :>
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="mdi mdi-home" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="wrap-input100 validate-input" data-bs-validate="Valid email is required: ex@abc.xyz">
                                        <input class="input100" type="text" name="email" placeholder="Masukkan Alamat Email">
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="zmdi zmdi-email" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="wrap-input100 validate-input">
                                        <input class="input100" type="text" name="no_hp" placeholder="Masukkan Nomor Handphone">
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="mdi mdi-cellphone" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="wrap-input100 validate-input" data-bs-validate="Password is required">
                                        <input class="input100" type="password" name="password" placeholder="Masukkan Password">
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="zmdi zmdi-lock" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="wrap-input100 validate-input" data-bs-validate="Password is required">
                                        <input class="input100" type="password" name="password_confirmation" placeholder="Masukkan Ulang Password">
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="zmdi zmdi-lock" aria-hidden="true"></i>
                                        </span>
                                    </div>

                                    <div class="wrap-input100 validate-input" data-bs-validate="Password is required">
                                        <label class="form-label mt-3">Upload Foto Ktp</label>
                                        <label class="picture" for="picture__input" tabIndex="0">
                                            <span class="picture__image"></span>
                                        </label>

                                        <input type="file" name="foto_ktp" id="picture__input" class="picture___input">
                                    </div>

                                    <div class="wrap-input100 validate-input" data-bs-validate="Password is required">
                                        <label class="form-label mt-3">Upload Foto Profile</label>
                                        <label class="picture" for="picture__input2" tabIndex="0">
                                            <span class="picture__image2"></span>
                                        </label>

                                        <input type="file" name="foto_profil" id="picture__input2" class="picture___input">
                                    </div>

                                    <div id="role-admin" style="display:none">
                                        <div class="form-group">
                                            <select class="form-control select2-show-search form-select" name="provinsi" id="provinsi">
                                                <?php
                                                $provinsi = App\Models\Province::get();
                                                ?>
                                                <option disabled selected>Pilih Provinsi</option>
                                                @foreach ($provinsi as $kc)
                                                <option value="{{ $kc->id }}">{{ $kc->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <select class="form-control select2-show-search form-select" name="kota" id="kota">
                                                <option disabled selected>Pilih Kota</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="role-saksi" style="display:none">
                                        <div class="form-group">
                                            <select class="form-control select2-show-search form-select" name="kecamatan" id="kecamatan">
                                                <option disabled selected>Pilih Kecamatan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control select2-show-search form-select" name="tps" id="kelurahan">
                                                <option disabled selected>Pilih Kelurahan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control select2-show-search form-select" name="tps" id="tps">
                                                <option disabled selected>Pilih Tps</option>
                                            </select>
                                        </div>

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
                                        <p class="text-dark mb-0">Already have account?<a href="{{url('')}}/login" class="text-primary ms-1">Sign In</a></p>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <section class="bg-light" style="height: 10px;">
                <div class="container">
                    <img style="display: block; margin-left: auto; margin-right: auto;" src="../../assets/images/acakey_new.png" width="250px" class="pt-5 mb-5">
                    <div class="text-center pb-5" style="font-size: 13px;">
                        © PT.Hisuara.id<br />
                        All Right Reserved 2023
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