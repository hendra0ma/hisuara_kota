@extends('layouts.main-patroli-detail')

@section('content')
<style>
    .app-content {
        margin-left: 0px !important;
    }
</style>
<div class="row" style="margin-top: 90px; transition: all 0.5s ease-in-out;">

    <div class="col-12">
        <div class="row w-100">
            <div class="col-md">
                <h1 class="page-title fs-1">Detail Data Admin</h1>
            </div>
            {{-- <div class="col-md">
                <div class="ms-auto text-uppercase d-flex justify-content-end fs-1 fw-bold text-warning">Admin demography tracking  (ADT)</div>
            </div> --}}
        </div>
    </div>

    <div class="mt-3">
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-md-6 mb-3">
                    <div class="card" style="height: 100%">
                        <div class="card-body">
                            <div class="row align-items-center text-center">
                                <div class="col-md-7">
                                    @if ($profile['profile_photo_path'] == NULL)
                                    <img class="rounded-circle"
                                        style="width: 150px; height: 150px; object-fit: cover; margin-right: 10px;"
                                        src="https://ui-avatars.com/api/?name={{ $profile['name'] }}&color=7F9CF5&background=EBF4FF">
                                    @else
                                    <img class="rounded-circle"
                                        style="width: 150px; height: 150px; object-fit: cover; margin-right: 10px;"
                                        src="{{url("/storage/profile-photos/".$profile['profile_photo_path']) }}">
                                    @endif
                                    <div class="mt-3">
                                        <h4>{{$profile['name']}}</h4>
                                        @if(Cache::has('is_online' . $profile['id']))
                                        <span class="badge bg-success  me-1 mb-1 mt-1">Online</span>
                                        @else
                                        <span class="badge bg-danger  me-1 mb-1 mt-1">Offline</span>
                                        @endif
                                        {{-- <p class="text-muted font-size-sm">{{$profile['address']}}</p> --}}
                                    </div>
                                </div>

                                <div class="col-md">

                                    <div class="row">
                                        <div class="col-12 mt-1 mb-1">
                                            <a type="button" href="tel:{{$profile['no_hp']}}" class="btn btn-info w-100 rounded-0"><i class="mdi mdi-phone"></i> Telepon</a>
                                        </div>
                                        <div class="col-12 mt-1 mb-1">
                                            <a type="button" href="https://wa.me/{{$profile['no_hp']}}" class="btn btn-success w-100 rounded-0"><i class="mdi mdi-whatsapp"></i> Whatsapp</a>
                                        </div>
                                        <div class="col-12 mt-1 mb-1">
                                            <a type="button" href="/administrator/kick/{{Crypt::encrypt($profile['id'])}}" class="btn btn-warning w-100 rounded-0"><i class="mdi mdi-do-not-disturb"></i> Kick</a>
                                        </div>
                                        <div class="col-12 mt-1 mb-1">
                                            <a type="button" href="/administrator/blokir/{{Crypt::encrypt($profile['id'])}}" class="btn btn-danger w-100 rounded-0"><i class="mdi mdi-block-helper"></i> Blokir</a>
                                        </div>
                                        <div class="col-12 mt-1 mb-1">
                                            <button id="lihatRiwayat" type="button" class="btn btn-primary w-100 rounded-0" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                <i class="mdi mdi-history"></i> History
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-3" style="height:308px">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">NIK</h6>
                                </div>
                                <div class="col-sm-9">
                                    {{$profile['nik']}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9">
                                    {{$profile['name']}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9">
                                    {{$profile['email']}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Phone</h6>
                                </div>
                                <div class="col-sm-9">
                                    {{$profile['no_hp']}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Address</h6>
                                </div>
                                <div class="col-sm-9">
                                    {{$profile['address']}}
                                </div>
                            </div>
                            <hr>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <div class="card mg-b-20">
        <div class="card-header">
            <div class="card-title">Tracking</div>
        </div>
        <div class="card-body">
            <div class="ht-300" id="mapid" style="height:500px"></div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">History User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php $history = App\Models\History::where('user_id',(string)$profile['id'])->get(); ?>
                    <table class="table border text-nowrap text-md-nowrap table-striped mg-b-0">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Catatan</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($history) == 0)
                               <tr>
                                <td colspan="3"><center>Tidak Ada Data</center></td>

                            </tr>
                           @else
                            @foreach($history as $hs)
                            <tr>
                                <td>{{$hs['id']}}</td>
                                <td>{{$hs['action']}}</td>
                                @if($hs['status'] == 0)
                                 <td><a class="btn btn-lg btn-warning" href="#">Dibatalkan</a></td>
                                @else
                                 <td><a class="btn btn-lg btn-danger" href="{{url('/')}}/administrator/action/batalkan_history/{{encrypt($hs['id'])}}/{{encrypt($profile['id'])}}">Batalkan</a></td>
                                @endif

                            </tr>
                            @endforeach
                           @endif

                        </tbody>
                    </table>

                </div>
                <div class="modal-footer">
                    <td><a  href="{{url('/')}}/administrator/patroli/batalkan_semua/{{encrypt($profile['id'])}}" class="btn btn-lg btn-danger" href="#">Batalkan Semua</a></td>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection