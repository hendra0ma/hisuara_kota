<div style="overflow-y:auto; overflow-x: hidden">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card border-0" style="position: relative">

                <div class="card-header bg-primary text-light text-center fw-bold rounded-0">
                    Foto dan Kirim Data C6
                </div>

                {{-- <form action="{{route('logout')}}" method="post" class="pe-2 ps-3">
                    @csrf
                    <button class="btn btn-danger" style="position: absolute; top: 51px; left: 10px;" type="submit">
                        Sign out
                    </button>
                </form> --}}
                <div class="card-body">

                    <div class="row">
                        <div class="px-0 col-12 text-center mb-3">
                            @if (Auth::user()->profile_photo_path == NULL)
                            <img style="width: 100px; height: 100px; object-fit: cover; margin-right: 10px;"
                                src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&color=7F9CF5&background=EBF4FF">
                            @else
                            <img style="width: 100px; height: 100px; object-fit: cover; margin-right: 10px;" src="{{url("/storage/profile-photos/".Auth::user()->profile_photo_path) }}">
                            @endif
                        </div>
                        <div class="px-0 col-12 my-auto text-center">
                            <?php
                                                    $tps = App\Models\Tps::where('tps.id', '=', Auth::user()->tps_id)->first();
                                                    $kelurahan = App\Models\Village::where('villages.id', '=', Auth::user()->villages)->first();
                                                ?>
                            <div class="mb-0 fw-bold" style="font-size: 20px">{{ Auth::user()->name }}</div>
                            <div style="font-size: 15px">NIK : {{ Auth::user()->nik }}</div>
                            <div style="font-size: 15px">SAKSI TPS {{ $tps }}</div>
                            <div style="font-size: 15px">KELURAHAN {{ $kelurahan }}</div>
                        </div>
                    </div>



                    <h1 class="text-center">
                        <img src="{{asset('')}}assets/icons/hisuara_new.png" class="hadow-4 mb-3 mt-3 rounded-2" style="width: 175px;"
                            alt="Avatar" />
                    </h1>
                    {{-- <h5> Halo, {{Auth::user()->name}}</h5> --}}
                    <form action="dev/action_saksi" method="post" enctype="multipart/form-data">
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

                                <!-- <div class="col-lg-12">
                                    <label for="pilih-c">Pilih Dokumen</label>
                                    <select name="dokumen" id="dokumen" class="form-select">

                                        <option value="c2">C2</option>
                                        <option value="c3">C3</option>
                                        <option value="c4">C4</option>
                                        <option value="c5">C5</option>
                                        <option value="c6">C6</option>
                                        <option value="c7">C7</option>
                                        <option value="c8">C8</option>
                                    </select>
                                </div> -->
                                <input type="hidden" name="dokumen"value="c6">

                                @foreach ($paslon as $item)
                                <div class="col-lg-12">
                                    Suara 0{{$item['id']}} - {{ $item['candidate']}}
                                    <input type="number" class="form-control" id="suara[]" name="suara[]" required placeholder="Suara Paslon">
                                </div>
                                @endforeach
                                <div class="col-lg-12 mt-2">
                                    <div class="card   ">
                                        <div class="card-header   ">
                                            <h5 class="card-title">Upload Foto C1</h5>
                                        </div>
                                        <div class="card-body text-center">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h1>
                                                        <a type="button ">
                                                            <i class="mdi mdi-camera"></i>
                                                        </a>
                                                    </h1>
                                                </div>
                                                <div class="col-md-12">
                                                    <input type="file" name="c1_plano" required id="c1_plano">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid gap-2">
                                    <input type="submit" class="btn btn-block btn-primary mt-2" value="Kirim" id="send">
                                </div>

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