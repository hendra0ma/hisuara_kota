<div>
    <h4 class="fw-bold fs-4 mt-5 mb-0">
    Jumlah C1 Saksi : {{$jumlah_c1_koreksi}}
    </h4>
    <hr style="border: 1px solid">

    <div class="row">
        <div class="col-12 mb-3">
            <input wire:model="search" type="search" class="form-control border-1 border-dark" placeholder="Search posts by title...">
        </div>
    </div>

    <div class="row">
        <style>
            .inner-card {
                border-radius: 10px;
                background-color: #cbd7ff;
                box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5) inset;
                -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5) inset;
                -moz-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5) inset;
            }
        </style>
        @foreach($list_suara as $ls)
        <div class="col-md-6 col-xl-4">
            <div class="card periksa-c1-plano" style="border-radius: 10px; cursor: pointer; box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.25);
                        -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.25);
                        -moz-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.25);" data-bs-toggle="modal" data-bs-target="#periksaC1Verifikator" data-id="{{$ls->tps_id}}">
                {{-- @if($ls['batalkan'] == 1)
                <div class="ribbone">
												 <div class="ribbon bg-dager"><span>Dibatalkan</span></div>
											</div>
                @endif
                  @if($ls['koreksi'] == 1)
                <div class="ribbone">
												 <div class="ribbon bg-dager"><span>Koreksi</span></div>
											</div>
                @endif --}}
                {{-- <div class="card-header bg-primary">
                    <div class="card-title text-white">DATA C1 SAKSI</div>
                </div> --}}
                <div class="card-body p-3">
                    <div class="inner-card p-4">
                        <div class="row">
                            <div class="col-md">
                                @if ($ls->profile_photo_path == NULL)
                                <img class="shadow-lg" style="width: 250px;" src="https://ui-avatars.com/api/?name={{ $ls->name }}&color=7F9CF5&background=EBF4FF" alt="img">
                                @else
                                <img class="shadow-lg" style="width: 250px;" src="{{url("/storage/profile-photos/".$ls->profile_photo_path) }}">
                                @endif
                            </div>
                            <div class="col-md my-auto">
                                <div class="row mb-2">
                                    <div class="col-md-12 bg-danger text-white p-2 fs-6">
                                        TPS {{ $ls->number }} / Kelurahan {{ $village->name }}
                                    </div>
                                </div>
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
                                <div class="row">
                                    <div class="col-md-4 fw-bold">Date</div>
                                    <div class="col-md">{{$ls->date}}</div>
                                </div>
                                {{-- <div class="row mb-2">
                                    <div class="col-md fw-bold">
                                        <button type="button" class="btn periksa-c1-plano w-100 text-white" style="background-color: #7f9cf5;" data-bs-toggle="modal" data-bs-target="#periksaC1Verifikator" data-id="{{$ls->tps_id}}">
                                            Periksa C1 </button>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="card item-card" style="height: 450px">
                <div class="product-grid6 card-body">
                    <div class="product-image6">
                        @if ($ls->profile_photo_path == NULL)
                        <img class="img-fluid" style="width: 250px;" src="https://ui-avatars.com/api/?name={{ $ls->name }}&color=7F9CF5&background=EBF4FF" alt="img">
                        @else
                        <img class="img-fluid" style="width: 250px;" src="{{url("/storage/profile-photos/".$ls->profile_photo_path) }}">
                        @endif

                    </div>
                    <div class="product-content text-center">
                        <h4 class="fw-bold">Kecamatan {{$village}}</h4>
                        <h4 class="mb-3 fw-bold"><a href="#">TPS {{$ls->number}}</a></h4>
                        <h4 class="price">Data C1 Masuk</h4>
                    </div>
                    <ul class="icons z-index3 text-white rounded-0" style="background: #6259ca;  height: 115%; transform: translateY(115px);">
                        <div class="row">
                            <div class="col-md  mt-8">
                                <h3 class="fw-bold">DATA SAKSI</h3>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">NIK :</div>
                            <div class="col-md">{{$ls->nik}}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">Nama :</div>
                            <div class="col-md">{{$ls->name}}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">No Wa :</div>
                            <div class="col-md">{{$ls->no_hp}}</div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12">Date :</div>
                            <div class="col-md">{{$ls->date}}</div>
                        </div>
                        <button type="button" class="btn btn-secondary w-75 mb-4 periksa-c1-plano" data-bs-toggle="modal" data-bs-target="#periksaC1Verifikator" data-id="{{$ls->tps_id}}">
                            Periksa C1
                            Plano
                        </button>
                        <button class="btn btn-success w-75 mb-4">Status Pembayaran Saksi</button>
                    </ul>
                </div>
            </div> -->
        </div>
        @endforeach
        @if($list_suara->lastItem())
            <!-- <div class="row justify-content-center mb-2 mt-2">
                <div class="col-md-12">
                    <a href="{{route('security.logoutKelurahan',Crypt::encrypt($id_kel))}}" class="btn btn-block btn-success mb-3">Kelurahan Selesai</a>
                </div>
            </div> -->
            @endif
    </div>
    {{$list_suara->links()}}
</div>