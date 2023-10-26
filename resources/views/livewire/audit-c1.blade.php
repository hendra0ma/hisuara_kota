<div>
    <h4 class="fw-bold fs-4 mt-1 mb-0">
    Jumlah Audit C1 : {{$jumlah_audit_c1}}
    </h4>
    <hr style="border: 1px solid">

    <div class="row">
        <div class="col-12 mb-3">
            <input wire:model="search" type="search" class="form-control border-1 border-dark" placeholder="Search posts by title...">
        </div>
    </div>
    <div class="row">
        @foreach($list_suara as $ls)
        <div class="col-md-6 col-xl-4">
            <div class="card periksa-c1-plano" style="border-radius: 10px; cursor: pointer; box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.25);
                    -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.25);
                    -moz-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.25);" data-bs-toggle="modal" data-bs-target="#periksaC1Verifikator" data-id="{{$ls->tps_id}}">
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
                                    <div class="col-md-12 bg-info text-white p-2 fs-6">
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
        </div>
        @endforeach
        <div class="mb-4">
            {{$list_suara->links()}}
        </div>
    </div>
</div>
