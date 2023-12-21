<div style="margin-top: 143px;">
    <style>
        td {
            padding-top: 7.5px !important;
            padding-bottom: 7.5px !important;
        }

        .ribbon-baru::before {
            position: absolute;
            content: '';
            background: #625ca0cb;
            height: 28px;
            width: 28px;
            /* Added lines */
            top: 23px;
            right: 6px;
            transform: rotate(45deg);
            z-index: -20;
        }

        .ribbon-baru {
            position: absolute;
            content: "";
            top: 7px;
            right: -17px;
            padding: 0.5rem;
            width: 10rem;
            background: #817ad5;
            color: white;
            text-align: center;
            font-family: 'Roboto', sans-serif;
            box-shadow: 4px 4px 15px rgba(26, 35, 126, 0.2);
        }
    </style>
    <div class="row" style="position: fixed; width: 98.1%; z-index: 10; background: #f2f3f9">
        <div class="col-12 mb-3">
            <input wire:model="search" type="search" class="form-control border-1 border-dark" placeholder="Search posts by title...">
        </div>
    </div>

    <div class="row" style="margin-top: 50px;">
        @foreach ($admin_data as $ls)
        <?php $district = App\Models\District::where('id', $ls['districts'])->first(); ?>
        <?php $villages = App\Models\Village::where('id', $ls['villages'])->first(); ?>
        <?php $tps = App\Models\Tps::where('id', $ls['tps_id'])->first(); ?>
        <div class="col-xl-3">
            <div class="card">
                <div class="card-header text-white border-0" style="background-color: #404042">
                    <span class="mx-auto py-6 fs-6">TPS <?php if ($tps == null) { ?> <?php } else { ?> {{$tps['number']}}<?php } ?> / Kelurahan </span>
                </div>
                {{-- <div class="ribbon-baru">
                    @if ($ls['is_active'] == 2)
                    Belum Terverifikasi
                    @else
                    Terverifikasi
                    @endif
                </div> --}}
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
                    <div id="<?= $ls->id ?>" class="nama-saksi text-center fs-4 fw-bold mb-3">{{$ls->name}}</div>
                    <div class="px-3">
                        <table class="table">
                            <tr>
                                <td class="text-primary px-0 fw-bold">
                                    NIK
                                </td>
                                <td class="px-0">:</td>
                                <td class="ps-2">{{$ls->nik}}</td>
                            </tr>
                            <tr>
                                <td class="text-primary px-0 fw-bold">
                                    Email
                                </td>
                                <td class="px-0">:</td>
                                <td class="ps-2">{{$ls->email}}</td>
                            </tr>
                            <tr>
                                <td class="text-primary px-0 fw-bold">
                                    No. Hp
                                </td>
                                <td class="px-0">:</td>
                                <td class="ps-2">{{$ls->no_hp}}</td>
                            </tr>
                        </table>

                        {{-- <div class="row px-0">

                            <div class="col-md px-0">
                                <form action="action_verifikasi/{{ encrypt($ls['id']) }}" method="post">
                        @csrf
                        <input type="hidden" name="aksi" value="{{ encrypt(1) }}">
                        <button class="btn w-100 rounded-0 btn-success" type="submit">Diterima</button>
                        </form>
                    </div>

                    <div class="col-md px-0">
                        <form action="action_verifikasi/{{ encrypt($ls['id']) }}" method="post">
                            @csrf
                            <input type="hidden" name="aksi" value="{{ encrypt(5) }}">
                            <button class="btn w-100 rounded-0 btn-danger" type="submit">Ditolak</button>
                        </form>
                    </div>

                    <div class="col-md px-0">
                        <a href="https://wa.me/{{$ls->no_hp}}" class="btn w-100 text-white btn-info rounded-0">Hubungi</a>
                    </div>
                </div> --}}

                <div class="row mt-2">
                    <div class="col-12 px-0">
                        <a id="lihatAktivitas<?= $ls->id ?>" class="btn btn-primary rounded-0 w-100" href="{{url('/')}}/administrator/patroli_mode/tracking/detail/<?= encrypt($ls['id']) ?>">Lihat Aktifitas</a>
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
    {{$admin_data->links()}}
</div>
</div>