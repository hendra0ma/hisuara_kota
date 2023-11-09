<div class="container" id="container-koreksi">
    <div class="row">
        <div class="col-md-6 mt-3">
            <div class="card">
                <div class="card-header bg-dark text-light">
                    <h5 class="card-title">Admin</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">
                    </p>
                    <div class="media">
                        <img class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover; margin-right: 10px;" src="{{asset('')}}storage/profile-photos/{{Auth::user()->profile_photo_path}}">


                        <div class="media-body">
                            <h5 class="mt-0">{{Auth::user()->name}}</h5>
                            NIK : {{Auth::user()->nik}}
                        </div>
                    </div>
                    <p></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <div class="card">
                <div class="card-header bg-primary text-light">
                    <h5 class="card-title">Saksi</h5>
                </div>
                <div class="card-body  text-center">
                    <p class="card-text">
                    </p>
                    <div class="row fw-bolder">
                        <div class="col">{{$user->name}}</div>
                        <div class="col">TPS {{$tps->number}}</div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">NIK : {{$user->nik}}</div>
                        <div class="col">Kecamatan {{$district->name}}/Kelurahan {{$village->name}}</div>
                    </div>
                    <p></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md mb-3"><img src="{{asset('')}}storage/c1_plano/{{$crowd->crowd_c1}}">
        </div>
        <div class="col-md">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-info text-light">
                            <h5 class="card-title">Masukan Suara C1 Crowd</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                            </p>
                            <form action="{{route('superadmin.simpan_suara_crowd')}}" method="post">
                                @csrf
                           
                                <div class="row">

                                    @foreach ($paslon as $j => $pas)
                                    <div class="col-md-6">
                                        <?php $j++ ?>
                                        <label for="suara01">Suara 0{{$j}}. {{$pas->candidate}},{{$pas->deputy_candidate}}</label>
                                        <input type="text" id="suara0{{$pas->id}}" class="form-control" name="suara[]" placeholder="masukan Suara {{$j}}">
                                    </div>
                                    @endforeach
                                    <input type="hidden"name="crowd_id"value="{{$crowd->id}}">
                                    <input type="submit"value="Simpan"class="btn btn-dark">
                                </div>
                            </form>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>