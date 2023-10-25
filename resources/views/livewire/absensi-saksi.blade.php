<div style="overflow:auto">
    
        <div class="row justify-content-center ">
            <div class="col-lg-5">
                <div class="card border-0  mt-2">
                    <div class="card-body">

                        <!-- As a link -->
                        <nav class="navbar bg-primary py-1">
                            <b class="navbar-brand mx-auto  fw-bold text-light " style="font-size: 16px">Foto dan Kirim Absensi</b>
                        </nav>

                        <h1 class="text-center">
                            <img src="{{asset('')}}images/logo/hisuara.png" class="mb-3 mt-3 bg-dark rounded-2 shadow-sm" style="width: 150px;" alt="Avatar" />
                        </h1>
                        <h4> Halo, {{Auth::user()->name}}</h4>
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
                                            <h4 class="card-title">Upload Selfie Di Lokasi TPS</h4>
                                        </div>
                                        <div class="card-body text-center">
                                            <div class="row">
                                                <div class="col-md-12 ">
                                                    <h1>
                                                        <label for="selfie_lokasi" type="button">
                                                            <i class="mdi mdi-camera"></i>
                                                        </label>
                                                    </h1>
                                                </div>
                                                <div class="col-md-12">
                                                    <input type="file" name="selfie_lokasi" required id="selfie_lokasi">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid gap-2">
                                    <input type="submit" name="" class="btn btn-block btn-primary mt-2" value="Kirim Status Kehadiran" id="send">
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
  
</div>