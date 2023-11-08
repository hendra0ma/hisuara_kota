<div style="overflow-y:auto; overflow-x: hidden">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card border-0" style="position: relative">

                <div class="card-header bg-primary text-light text-center fw-bold rounded-0">
                    Foto dan Kirim Absensi
                </div>

                {{-- <form action="{{route('logout')}}" method="post">
                    @csrf
                    <button class="btn btn-danger" style="position: absolute; top: 51px; left: 10px;" type="submit">
                        Sign out
                    </button>
                </form> --}}
                <div class="card-body">

                    <!-- As a link -->

                    <h1 class="text-center">
                        <img src="{{asset('')}}assets/icons/hisuara_new.png" class="hadow-4 mb-3 mt-3 rounded-2" style="width: 175px;"
                            alt="Avatar" />
                    </h1>
                    <h5> Halo, {{Auth::user()->name}}</h5>
                    <form action="{{route('actionAbsensiSaksi')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if(session()->has('error'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ session()->get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <div class="row no-gutters">
                            <div class="col-lg-12 mt-2">
                                <div class="card" style="height:30vh">
                                    <div class="card-header">
                                        <h5 class="card-title">Upload Selfie Di Lokasi TPS</h5>
                                    </div>
                                    <div class="card-body d-flex">
                                        <div class="row my-auto mx-auto">
                                            <div class="col-md-12 text-center">
                                                <h1>
                                                    <label for="selfie_lokasi" type="button">
                                                        <i class="mdi mdi-camera"></i>
                                                    </label>
                                                </h1>
                                            </div>
                                            <div class="col-md-12 text-center">
                                                <input type="file" name="selfie_lokasi" style="width: 205px;" required id="selfie_lokasi">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <input type="submit" name="" class="btn btn-block btn-primary mt-2"
                                    value="Kirim Status Kehadiran" id="send">
                            </div>
                        </div>
                    </form>
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <a href="#" class="mt-3" onclick="this.closest('form').submit();">
                            Sign out
                        </a>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>