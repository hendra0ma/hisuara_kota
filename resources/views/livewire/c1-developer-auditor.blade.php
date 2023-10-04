     <div class="row mt-5">
            @foreach($list_suara as $ls)
            <div class="col-md-6 col-xl-4">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="card-title text-white">DATA C1 SAKSI</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md">
                                @if ($ls->profile_photo_path == NULL)
                                <img class="" style="width: 250px;" src="https://ui-avatars.com/api/?name={{ $ls->name }}&color=7F9CF5&background=EBF4FF" alt="img">
                                @else
                                <img class="" style="width: 250px;" src="{{url("/storage/profile-photos/".$ls->profile_photo_path) }}">
                                @endif
                            </div>
                            <div class="col-md">
                                <div class="row mb-2">
                                    <div class="col-md-4 fw-bold">NIK</div>
                                    <div class="col-md">{{$ls->nik}}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-4 fw-bold">Nama</div>
                                    <div class="col-md">{{$ls->name}}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-4 fw-bold">No Wa</div>
                                    <div class="col-md">{{$ls->no_hp}}</div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-4 fw-bold">Date</div>
                                    <div class="col-md">{{$ls->date}}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md fw-bold">
                                       <button type="button" class="btn btn-primary w-75 mb-4 periksa-c1-plano" data-bs-toggle="modal" data-bs-target="#periksaC1Verifikator" data-id="{{$ls->tps_id}}">
                    Audit C1
                    Plano
                </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {{$list_suara->links()}}
