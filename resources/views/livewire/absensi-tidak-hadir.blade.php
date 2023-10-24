<div>
    <style>
        td {
            padding-top: 7.5px !important;
            padding-bottom: 7.5px !important;
        }

        .card .disabled {
            position: absolute;
            background: rgba(0, 0, 0, 0.25);
            width: 100%;
            height: 100%;
            z-index: 10;
        }

        .police-line {
            top: 50%;
            transform: translateY(-50%);
            width: 100%;
            background: repeating-linear-gradient(45deg, #f9cd1a, #f9cd1a 10px, #404042 10px, #404042 20px);
            position: absolute;
            z-index: 11;
            text-align: center;
            font-weight: bold;
            padding-top: 5px;
            padding-bottom: 5px;
            font-size: 25px
        }

        .inner-police {
            background: #f9cd1a;
        }
    </style>
    
    <div class="row">
        <div class="col-12 mb-3">
            <input wire:model="search" type="search" class="form-control border-1 border-dark" placeholder="Search posts by title...">
        </div>
    </div>

    <div class="row">
        @foreach ($absen as $ls)
        <?php $district = App\Models\District::where('id',$ls['districts'])->first(); ?>
        <?php $villages = App\Models\Village::where('id',$ls['villages'])->first(); ?>
        <?php $tps = App\Models\Tps::where('id',$ls['tps_id'])->first(); ?>
        <div class="col-xl-3">
            <div class="card">
                <div class="disabled"></div>
                <div class="police-line">
                    <div class="inner-police">Tidak Hadir</div>
                </div>
                <div class="card-header text-white border-0" style="background-color: #404042">
                    <span class="mx-auto py-6 fs-6">TPS {{ $ls->number }} / Kelurahan {{ $villages['name'] }}</span>
                </div>
                <div class="hiasan-1">
                    <div class="gambar-bulat">
                        @if ($ls->profile_photo_path == NULL)
                        <img class="rounded-circle" style="width: 125px; height: 125px; object-fit:cover;" src="https://ui-avatars.com/api/?name={{ $ls->name }}&color=7F9CF5&background=EBF4FF" alt="img">
                        @else
                        <img class="rounded-circle" style="width: 125px; height: 125px; object-fit:cover;" src="{{url("/storage/profile-photos/".$ls->profile_photo_path) }}">
                        @endif
                    </div>
                </div>
                <div class="card-body py-7">
                    <div class="text-center fs-4 fw-bold mb-3">{{$ls->name}}</div>
                    <div class="px-5">
                        <table class="table">
                            <tr>
                                <td class="text-primary fw-bold">
                                    Kecamatan
                                </td>
                                <td class="px-0">:</td>
                                <td class="ps-2">{{$district['name'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-primary fw-bold">
                                    Kelurahan
                                </td>
                                <td class="px-0">:</td>
                                <td class="ps-2">{{$villages['name'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-primary fw-bold">
                                    Email
                                </td>
                                <td class="px-0">:</td>
                                <td class="ps-2">{{$ls->email}}</td>
                            </tr>
                        </table>
                        <div class="row mt-2">
                            <div class="col-12 px-0">
                                <a class="btn btn-primary rounded-0 w-100 cekmodal" id="Cek" data-id="{{$ls['id']}}" data-bs-toggle="modal" id="" data-bs-target="#cekmodal">Detail Data Saksi</a>
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
    <div class="mb-4">
        {{$absen->links()}}
    </div>
</div>
