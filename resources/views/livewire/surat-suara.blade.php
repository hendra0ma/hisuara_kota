<div style="overflow-y:auto; overflow-x: hidden">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card border-0" style="position: relative">

                <div style="position: relative" class="card-header bg-primary text-light text-center fw-bold rounded-0">
                    <span style="position: absolute; left: 15px" class="fw-normal">3/4</span> Surat Suara
                </div>
                
                {{-- <form action="{{route('logout')}}" method="post">
                    @csrf
                    <button class="btn btn-danger" style="position: absolute; top: 51px; left: 10px;" type="submit">
                        Sign out
                    </button>
                </form> --}}
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
                    <form action="{{route('actionSuratSuara')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if(session()->has('error'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ session()->get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if(session('errors'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <ul>
                                @foreach (session('errors')->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <div class="row no-gutters mt-3">
                            <div class="col-lg-12 mb-2">
                                <label for="total_surat_suara">Jumlah Hak Pilih (DPT)</label>
                                <input type="number" class="form-control" id="" value="" name="" required>
                            </div>
                            <div class="col-lg-12 mb-2">
                                <label for="surat_suara_tidak_sah">Surat Suara Sah</label>
                                <input type="number" class="form-control" id="" value="" name="" required>
                            </div>
                            <div class="col-lg-12 mb-2">
                                <label for="surat_suara_tidak_sah">Suara Tidak Sah</label>
                                <input type="number" class="form-control" id="surat_suara_tidak_sah" value="{{old('surat_suara_tidak_sah')}}" name="surat_suara_tidak_sah" required>
                            </div>
                            <div class="col-lg-12 mb-2">
                                <label for="surat_suara_terpakai">Jumlah Suara Sah dan Suara Tidak Sah</label>
                                <input type="number" class="form-control" id="" value="" name="" required>
                            </div>
                            <div class="col-lg-12 mb-2">
                                <label for="total_surat_suara">Total Surat Suara</label>
                                <input type="number" class="form-control" id="total_surat_suara" value="{{old('total_surat_suara')}}" name="total_surat_suara" required>
                            </div>
                            <div class="col-lg-12 mb-2">
                                <label for="sisa_surat_suara">Sisa Surat Suara</label>

                                <input type="number" class="form-control" id="sisa_surat_suara" value="{{old('sisa_surat_suara')}}" name="sisa_surat_suara" required>
                            </div>
                            <div class="col-lg-12 mb-2">
                                <div class="card mt-2">
                                    <div class="card-header">
                                        <h5 class="card-title">Foto Surat Suara</h5>
                                    </div>
                                    <div class="card-body text-center">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h1>
                                                    <label for="Surat Suara" type="button">
                                                        <i class="mdi mdi-camera"></i>
                                                    </label>
                                                </h1>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="file" name="surat_suara[]" multiple required id="Surat Suara">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <input type="submit" class="btn btn-block btn-primary mt-2" value="Kirim" id="send">
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