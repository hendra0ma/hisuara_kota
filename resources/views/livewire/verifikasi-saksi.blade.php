<div>

    <style>
        td {
            padding-top: 7.5px !important;
            padding-bottom: 7.5px !important;
        }
    </style>
    
    <div class="row">
        <div class="col-12 mb-3">
            <input wire:model="search" type="search" class="form-control border-1 border-dark" placeholder="Search posts by title...">
        </div>
    </div>

    <div class="row">
        @foreach ($saksi_data as $ls)
        <?php $kecamatan = \App\Models\District::where('id',(string)$ls['districts'])->first(); ?>
        <?php $kelurahan = \App\Models\Village::where('id',(string)3674040006)->first(); ?>
        <?php $tps = \App\Models\Tps::where('user_id',$ls['id'])->first(); ?>
        <div class="col-xl-3">
            <div class="card">
                <div class="card-header text-white border-0" style="background-color: #404042">
                    <span class="mx-auto py-6 fs-6">TPS <?php if($tps == null){?> <?php }else{ ?> {{$tps['number']}}<?php } ?> / Kelurahan {{ $kelurahan['name'] }}</span>
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
                                    NIK
                                </td>
                                <td class="px-0">:</td>
                                <td class="ps-2">{{$ls->nik}}</td>
                            </tr>
                            <tr>
                                <td class="text-primary fw-bold">
                                    No HP
                                </td>
                                <td class="px-0">:</td>
                                <td class="ps-2">{{$ls->no_hp}}</td>
                            </tr>
                            <tr>
                                <td class="text-primary fw-bold">
                                    Kecamatan
                                </td>
                                <td class="px-0">:</td>
                                <td class="ps-2">{{$kecamatan['name'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-primary fw-bold">
                                    Kelurahan
                                </td>
                                <td class="px-0">:</td>
                                <td class="ps-2">{{$kelurahan['name'] }}</td>
                            </tr>
                        </table>
                        
                        <div class="row px-0">
                            @if ($ls['is_active'] == 1)
                                <div class="col-md-auto px-0">
                                    <form action="action_verifikasi/{{ encrypt($ls['id']) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="aksi" value="{{ encrypt(0) }}">
                                        <button class="btn rounded-0 btn-danger" type="submit">Hapus Saksi</button>
                                    </form>
                                </div>
                            @endif

                            @if ($ls['is_active'] == 0)
                                <div class="col-md-auto px-0">
                                    <form action="action_verifikasi/{{ encrypt($ls['id']) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="aksi" value="{{ encrypt(1) }}">
                                        <button class="btn rounded-0 btn-success" type="submit">Diterima</button>
                                    </form>
                                </div>

                                <div class="col-md-auto px-0">
                                    <form action="action_verifikasi/{{ encrypt($ls['id']) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="aksi" value="{{ encrypt(0) }}">
                                        <button class="btn rounded-0 btn-warning" type="submit">Dihapus</button>
                                    </form>
                                </div>
                                
                            @endif
                            <div class="col-md-auto px-0">
                                <a class="btn text-white btn-danger rounded-0">Ditolak</a>
                            </div>
                            <div class="col-md-auto px-0">
                                <a href="https://wa.me/{{$ls->no_hp}}" class="btn text-white btn-info rounded-0">Hubungi</a>
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
        {{$saksi_data->links()}}
    </div>

</div>
