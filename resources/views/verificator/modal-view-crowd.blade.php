<div class="col-lg-6" style="height: 100vh; overflow: scroll">
    <center>
        <img src="{{asset('storage'.'/c1_plano/'.$relawan->crowd_c1)}}" data-magnify-speed="200" alt="" data-magnify-magnifiedwidth="1500" data-magnify-magnifiedheight="1500" class="img-fluid zoom" data-magnify-src="{{asset('storage'.'/c1_plano/'.$relawan->crowd_c1)}}">
    </center>
</div>

<div class="col-lg-6" style="height: 100vh; overflow: scroll">
    <?php



    $user = App\Models\User::where('id', $relawan->user_id)->first();
    $tps = App\Models\Tps::where('id', $relawan->tps_id)->first();

    $village = App\Models\Village::where('id', $relawan->village_id)->first();

    ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="card-title mx-auto">DATA RELAWAN</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-auto">
                            @if ($user['profile_photo_path'] == NULL)
                            <img style="width: 108px; height: 108px; object-fit: cover; margin-right: 10px;" src="https://ui-avatars.com/api/?name={{ $user['name'] }}&color=7F9CF5&background=EBF4FF">
                            @else
                            <img style="width: 108px; height: 108px; object-fit: cover; margin-right: 10px;" src="{{url("/storage/profile-photos/".$user['profile_photo_path']) }}">
                            @endif
                        </div>
                        <div class="col-md">
                            <div class="row mb-2">
                                <div class="col-md-3 fw-bold">NIK</div>
                                <div class="col-auto">:</div>
                                <div class="col-md-auto">{{$user->nik}}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 fw-bold">Nama</div>
                                <div class="col-auto">:</div>
                                <div class="col-md-auto">{{$user->name}}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 fw-bold">No Wa</div>
                                <div class="col-auto">:</div>
                                <div class="col-md-auto">{{$user->no_hp}}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 fw-bold">Date</div>
                                <div class="col-auto">:</div>
                                <div class="col-md-auto">{{$user->created_at}}</div>
                            </div>
                        </div>
                        <div class="col-md">
                            <a href="https://wa.me/{{$user->no_hp}}" class="btn btn-success h-100 w-100 d-flex">
                                <div class="row mx-auto my-auto">
                                    <div class="col-md-12">
                                        <i class="fa-brands fa-whatsapp fs-1"></i>
                                    </div>
                                    <div class="col-md fs-5">
                                        Hubungi
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h4 class="card-title mx-auto">TPS {{$tps->number}} / Kelurahan {{ucwords(strtolower($village->name))}}</h4>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <?php $i = 1;  ?>
                        <?php $voice = 0;  ?>
                        @foreach ($relawan->crowd_data as $dataTps)

                        <div class="form-group col-md-6">
                            <label>Suara 0{{$i++}}</label>
                            <input type="number" class="form-control" readonly="" value="{{$dataTps->voice}}" name="suara[]" placeholder="Suara" readonly>
                        </div>
                        <?php $voice += $dataTps->voice; ?>
                        @endforeach
                        <div class="form-group col-md-12">
                            <label><b>Total</b></label>
                            <input type="number" class="form-control" readonly="" value="{{$voice }}"  placeholder="Suara" readonly>
                            <a href="{{route('verifikator.verifikasiDataC1Crowd',Crypt::encrypt($relawan->id))}}" class="btn btn-success btn-block mt-4">
                                Verifikasi C1 Crowd
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <script>
        $(document).ready(function() {
            $('img.zoom').magnify();
        });
    </script>