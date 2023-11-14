<?php
use App\Models\User;
use App\Models\Koreksi;
?>

<div>
    <h4 class="fw-bold fs-4 mt-5 mb-0">
    Jumlah Data Koreksi C1 : {{$jumlah_koreksi_c1}}
    </h4>
    <hr style="border: 1px solid">

    <div class="row">
        <div class="col-12 mb-3">
            <input wire:model="search" type="search" class="form-control border-1 border-dark" placeholder="Search posts by title...">
        </div>
    </div>

    <div class="row">
        @foreach ($saksi_data as $ls)
       
        <?php $request_by = User::where('id',$ls['kecurangan_id_users'])->first(); ?>
        <?php $koreksi_by = Koreksi::where('user_id',(string)$ls['id'])->first(); ?>
        <div class="col-xl-3">
            <div class="card">
                <div class="card-header text-white border-0" style="background-color: #404042">
                    <span class="mx-auto py-6 fs-6">TPS
                        @if ($ls['number'] == null)
                        @else
                        {{$ls['number']}}
                        @endif
                        / Kelurahan {{ $village->name }}
                    </span>
                </div>
                <div class="hiasan-1" style="background-color: rgba(248, 38, 73, 0.8)">
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
                                    Kecamatan
                                </td>
                                <td class="px-0">:</td>
                                <td class="ps-2">{{ $district->name }}</td>
                            </tr>
                            <tr>
                                <td class="text-primary fw-bold ps-0">
                                    Kelurahan
                                </td>
                                <td class="px-0">:</td>
                                <td class="ps-2">{{ $village->name }}</td>
                            </tr>
                            <tr>
                                <td class="text-primary fw-bold ps-0">
                                    Date
                                </td>
                                <td class="px-0">:</td>
                                <td class="ps-2">{{$ls->created_at}}</td>
                            </tr>
                        </table>
                        {{-- koreksi:{{$ls->koreksi}}
                        dibatalkan:{{$ls->batalkan}} --}}
                        @if ($ls->koreksi == 1 && $ls->batalkan != 1)
                        <div class="row mt-2">
                            <div class="col-12 px-0">
                                <button class="btn rounded-0 w-100 disetujuimodal text-white" id="Cek"
                                    data-id="{{$ls['saksi_id']}}" data-bs-toggle="modal" id=""
                                    data-bs-target="#disetujuimodal"
                                    style="background-color: rgb(248, 38, 73)">Periksa Koreksi C1</button>
                            </div>
                        </div>
                        @endif
                        @if ($ls->batalkan == 1 && $ls->koreksi != 1)
                        <div class="row mt-2">
                            <div class="col-12 px-0">
                                <button class="btn rounded-0 w-100 c1-dibatalkan text-white" id="Cek" data-id="{{$ls->tps_id}}"
                                    data-bs-toggle="modal" id="" data-bs-target="#periksaC1Verifikator"
                                    style="background-color: rgb(248, 38, 73)">Periksa Koreksi C1</button>
                            </div>
                        </div>
                        @endif
                        @if ($ls->koreksi == 1 && $ls->batalkan == 1)
                        <div class="row mt-2">
                            <div class="col-12 px-0">
                                <button class="btn rounded-0 w-100 disetujuimodal text-white" id="Cek" data-id="{{$ls['saksi_id']}}"
                                    data-bs-toggle="modal" id="" data-bs-target="#disetujuimodal"
                                    style="background-color: rgb(248, 38, 73)">Periksa Koreksi C1</button>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="hiasan-2" style="height: 30px"></div>
                <div class="hiasan-1" style="height: 30px; background-color: rgba(248, 38, 73, 0.8)"></div>
            </div>
        </div>
        @endforeach
    </div>
    
    {{$saksi_data->links()}}
    
</div>