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
        @foreach ($list_suara as $ls)
        <div class="col-xl-3">
            <div class="card">
                <div class="card-header text-white border-0" style="background-color: #404042">
                    <span class="mx-auto py-6 fs-6">
                        DATA SAKSI
                    </span>
                </div>
                <div class="hiasan-1">
                    <div class="gambar-bulat">
                        @if ($ls->profile_photo_path == NULL)
                        <img class="rounded-circle" style="width: 125px; height: 125px; object-fit:cover;"
                            src="https://ui-avatars.com/api/?name={{ $ls->name }}&color=7F9CF5&background=EBF4FF" alt="img">
                        @else
                        <img class="rounded-circle" style="width: 125px; height: 125px; object-fit:cover;" src="{{url("/storage/profile-photos/".$ls->profile_photo_path) }}">
                        @endif
                    </div>
                </div>
                <div class="card-body py-7">
                    <div class="text-center fs-4 fw-bold mb-3">{{$ls->name}}</div>
                    <div class="px-3">
                        <table class="table">
                            <tr>
                                <td class="text-primary fw-bold ps-0">
                                    NIK
                                </td>
                                <td class="px-0">:</td>
                                <td class="ps-2">{{$ls->nik}}</td>
                            </tr>
                            <tr>
                                <td class="text-primary fw-bold ps-0">
                                    No Wa
                                </td>
                                <td class="px-0">:</td>
                                <td class="ps-2">{{$ls->no_hp}}</td>
                            </tr>
                            <tr>
                                <td class="text-primary fw-bold ps-0">
                                    Date
                                </td>
                                <td class="px-0">:</td>
                                <td class="ps-2">{{$ls->date}}</td>
                            </tr>
                        </table>
    
                        <div class="row mt-2">
                            <div class="col-12 px-0">
                                <button class="btn rounded-0 w-100 fotoKecuranganterverifikasi mt-2 rounded-0 text-white" id="Cek"
                                    data-bs-toggle="modal" id="" data-bs-target="#fotoKecuranganterverifikasi" data-id="{{$ls->tps_id}}"
                                    style="background-color: #ff4f4e;">Validasi Kecurangan</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hiasan-2" style="height: 30px"></div>
                <div class="hiasan-1" style="height: 30px"></div>
            </div>
        </div>
        @endforeach
    </div>
    {{$list_suara->links()}}
</div>
