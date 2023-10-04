<div class="row justify-content-center">

    @foreach($relawan as $ls)
    <div class="col-md-6 col-xl-4">
        <div class="card item-card" style="height: 450px">
            <div class="product-grid6 card-body">
                <div class="product-image6">
                    @if ($ls->profile_photo_path == NULL)
                    <img class="img-fluid" style="width: 250px;" src="https://ui-avatars.com/api/?name={{ $ls->name }}&color=7F9CF5&background=EBF4FF" alt="img">
                    @else
                    <img class="img-fluid" style="width: 250px;" src="{{url("/storage/profile-photos/".$ls->profile_photo_path) }}">
                    @endif

                </div>
                <div class="product-content text-center">
                    <h4 class="fw-bold">Kecamatan {{$ls->district_name}}</h4>
                    <h4 class="mb-3 fw-bold"><a href="#">TPS {{$ls->number}}</a></h4>
                    <h4 class="price">Data C1 Masuk</h4>
                </div>
                <ul class="icons z-index3" style="background: rgb(0,0,0); background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.65) 15%, rgba(0,0,0,0.75) 25%, rgba(0,0,0,1) 100%);
                            height: 110%; transform: translateY(115px);">
                    <div class="row mb-3 mt-8">
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
                    <button type="button" class="btn btn-primary w-75 mb-4 periksa-c1-plano" data-bs-toggle="modal" data-bs-target="#periksaC1Relawan" data-id="{{$ls->tps_id}}">
                        Periksa C1
                        Relawan
                    </button>

                </ul>
            </div>
        </div>
    </div>
    @endforeach
    <div class="mt-2 mb-2">
        {{$relawan->links()}}
    </div>
</div>