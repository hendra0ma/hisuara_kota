<div style="margin-top: 143px;">
    <style>
        td {
            padding-top: 7.5px !important;
            padding-bottom: 7.5px !important;
        }
    </style>
    <div class="row" style="position: fixed; width: 98.1%; z-index: 10; background: #f2f3f9">
        <div class="col-12 mb-3">
            <input wire:model="search" type="search" class="form-control border-1 border-dark" placeholder="Search posts by title...">
        </div>
    </div>

    <div class="row" style="margin-top: 50px;">
        @foreach ($absen as $ls)
        <?php $district = App\Models\District::where('id', $ls['districts'])->first(); ?>
        <?php $villages = App\Models\Village::where('id', $ls['villages'])->first(); ?>
        <?php $tps = App\Models\Tps::where('id', $ls['tps_id'])->first(); ?>
        <div class="col-xl-3">
            <div class="card">
                <div class="card-header text-white border-0" style="background-color: #404042">
                    <span class="mx-auto py-6 fs-6">TPS {{$tps['number']}} / Kelurahan {{ $villages['name'] }}</span>
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
                    <div id="{{$ls['id']}}" class="nama-saksi text-center fs-4 fw-bold mb-3">{{$ls->name}}</div>
                    <div class="px-3">
                        <table class="table">
                            <tr>
                                <td class="text-primary fw-bold ps-0">
                                    Kecamatan
                                </td>
                                <td class="px-0">:</td>
                                <td class="ps-2">{{$district['name'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-primary fw-bold ps-0">
                                    Kelurahan
                                </td>
                                <td class="px-0">:</td>
                                <td class="ps-2">{{$villages['name'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-primary fw-bold ps-0">
                                    TPS
                                </td>
                                <td class="px-0">:</td>
                                <td class="ps-2">{{$tps['number']}}</td>
                            </tr>
                            <tr>
                                <td class="text-primary fw-bold ps-0">
                                    Jam Absen
                                </td>
                                <td class="px-0">:</td>
                                <td class="ps-2">{{$ls->created_at}}</td>
                            </tr>
                            {{-- <tr>
                                <td class="text-primary fw-bold ps-0">
                                    Email
                                </td>
                                <td class="px-0">:</td>
                                <td class="ps-2">{{$ls->email}}</td>
                            </tr> --}}
                            <tr>
                                <td class="text-primary fw-bold ps-0">
                                    Longitude
                                </td>
                                <td class="px-0">:</td>
                                <td class="ps-2">{{$ls->longitude}}</td>
                            </tr>
                            <tr>
                                <td class="text-primary fw-bold ps-0">
                                    Latitude
                                </td>
                                <td class="px-0">:</td>
                                <td class="ps-2">{{$ls->latitude}}</td>
                            </tr>
                        </table>

                        {{-- <div class="row px-0">
                            <div class="col-md px-0">
                                <button class="btn rounded-0 btn-success w-100" type="submit">Diterima</button>
                            </div>
                        </div> --}}

                        <div class="row mt-2">
                            <div class="col-12 px-0">
                                <a class="btn btn-primary rounded-0 w-100 cekmodal" data-id="{{$ls['id']}}" data-bs-toggle="modal" data-bs-target="#cekmodal" onclick="cekModal(this,{{$ls['id']}})">Detail Data Saksi</a>
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