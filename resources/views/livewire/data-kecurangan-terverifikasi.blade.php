<div>
    <h4 class="fw-bold fs-4 mt-5 mb-0">
    Jumlah Data Kecurangan Terverifikasi : {{$jumlah_data_kecurangan_terverifikasi}}
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
            <div class="card">
                <div class="card-header" style="background-color: #ff4f4e">
                    <div class="card-title text-white">ARSIP LAPORAN KECURANGAN SAKSI</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md">
                            @if ($ls->profile_photo_path == NULL)
                            <img class="" style="width: 250px; height: 250px; object-fit:cover"
                                src="https://ui-avatars.com/api/?name={{ $ls->name }}&color=7F9CF5&background=EBF4FF"
                                alt="img">
                            @else
                            <img class="" style="width: 250px; height: 250px; object-fit:cover"
                                src="{{url("/storage/profile-photos/".$ls->profile_photo_path) }}">
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
                                    <a href="fotomasalah"
                                        class="btn w-90 fotoKecuranganterverifikasi mt-2 rounded-0 text-white" id="Cek"
                                        data-bs-toggle="modal" id="" data-bs-target="#fotoKecuranganterverifikasi"
                                        style="background-color: #ff4f4e"
                                        data-id="{{$ls->tps_id}}">
                                        Arsip Kecurangan</a>
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
</div>
