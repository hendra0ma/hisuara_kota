<div style="overflow-y:auto; overflow-x: hidden">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card border-0" style="position: relative">

                <div style="position: relative" class="card-header bg-primary text-light text-center fw-bold rounded-0">
                    <span style="position: absolute; left: 15px" class="fw-normal">4/4</span> Daftar Hadir Pemilih di TPS (C7)
                </div>

             
                <div class="card-body">

                    <div class="row">
                        <div class="px-0 col-12 text-center mb-3">
                            @if (Auth::user()->profile_photo_path == NULL)
                            <img class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover; margin-right: 10px;"
                                src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&color=7F9CF5&background=EBF4FF">
                            @else
                            <img class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover; margin-right: 10px;" src="{{url("/storage/profile-photos/".Auth::user()->profile_photo_path) }}">
                            @endif
                        </div>
                        <div class="px-0 col-12 my-auto text-center">
                            <?php
                                                    $tps = App\Models\Tps::where('tps.id', '=', Auth::user()->tps_id)->first();
                                                    $kelurahan = App\Models\Village::where('villages.id', '=', Auth::user()->villages)->first();
                                                ?>
                            <div class="mb-0 fw-bold" style="font-size: 20px">{{ Auth::user()->name }}</div>
                            <div style="font-size: 15px">NIK : {{ Auth::user()->nik }}</div>
                            @if($tps == null)
                            <div style="font-size: 15px">SAKSI TPS 1</div>
                            @else
                            <div style="font-size: 15px">SAKSI TPS {{ $tps->number }}</div>
                            @endif
                            @if ($kelurahan == null)
                            <div style="font-size: 15px">KELURAHAN CIPUTAT</div>
                            @else
                            <div style="font-size: 15px">KELURAHAN {{ $kelurahan->name }}</div>
                            @endif
                        </div>
                    </div>



                    {{-- <h1 class="text-center">
                        <img src="{{asset('')}}assets/icons/hisuara_new.png" class="hadow-4 mb-3 mt-3 rounded-2" style="width: 175px;"
                            alt="Avatar" />
                    </h1> --}}
                    {{-- <h5> Halo, {{Auth::user()->name}}</h5> --}}
                    <form action="{{route("actionSuratC7")}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="tps" value="{{$dev['number']}}" id="">
                        <input type="hidden" name="email" value="{{$dev['email']}}" id="">

                        @if(session()->has('error'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ session()->get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <div class="row no-gutters">
                            <div class="col-lg-12 mt-2">
                                <div class="row no-gutters">
                                    <div class="col-lg-12 mt-2 mb-2">
                                        <div class="card" style="height:30vh">
                                            <div class="card-header text-center">
                                                <span class="card-title">Upload Foto Formulir</span>
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
                                                        <input type="file" name="formulir" style="width: 205px;" required id="formulir">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="d-grid gap-2">
                                        <input type="submit" name="" class="btn btn-block btn-primary mt-2" value="Kirim" id="send">
                                    </div>
                                </div>

                            </div>

                        </div>
                    </form>
                    <form class="mt-2" action="{{route('logout')}}" method="post">
                        @csrf
                        <a href="#" onclick="this.closest('form').submit();">
                            Sign out
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>