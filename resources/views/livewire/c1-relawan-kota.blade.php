<div>
    <h4 class="fw-bold fs-4 mt-5 mb-0">
        Jumlah C1 Relawan : {{$jumlah_c1_relawan}}
    </h4>
    <hr style="border: 1px solid">
    
    <div class="row">
        <div class="col-12 mb-3">
            <input wire:model="search" type="search" class="form-control border-1 border-dark"
                placeholder="Search posts by title...">
        </div>
    </div>
    <div class="row">
        @foreach($list_suara as $ls)
        <div class="col-md-6 col-xl-4">
            <div class="card item-card" style="height: 450px">
                <div class="product-grid6 card-body">
                    <div class="product-image6">
                        @if ($ls->profile_photo_path == NULL)
                        <img class="img-fluid" style="width: 250px; height: 250px; object-fit:cover" src="https://ui-avatars.com/api/?name={{ $ls->name }}&color=7F9CF5&background=EBF4FF" alt="img">
                        @else
                        <img class="img-fluid" style="width: 250px; height: 250px; object-fit:cover" src="{{url("/storage/profile-photos/".$ls->profile_photo_path) }}">
                        @endif

                    </div>
                    <div class="product-content text-center">

                        <h4 class="mb-3 fw-bold"><a href="#">TPS {{$ls->number}}</a></h4>
                        <h4 class="price">Data C1 Relawan Masuk</h4>
                    </div>
                    <ul class="icons z-index3 text-white" style="background: #6259ca;  height: 115%; transform: translateY(115px);">
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
                        <button type="button" class="btn btn-primary w-75 mb-4 periksa-c1-relawan" data-bs-toggle="modal" data-bs-target="#periksaC1Relawan" data-id="{{$ls->tps_id}}">
                            Periksa C1
                            Relawan
                        </button>
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{$list_suara->links()}}
</div>