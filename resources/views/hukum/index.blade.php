@extends('layouts.main-hukum')

@section('content')

<div class="row mt-3">
    <div class="col-lg-4">
        <h1 class="page-title fs-1 mt-2">Dashboard Rekapitung
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Validator Kecurangan
                <!-- Kota -->
            </li>
        </ol>
        <?php $usertotal = App\Models\User::where('role_id',7)->count(); ?>
        <h4 class="fs-4 mt-2 fw-bold">Validator Kecurangan ({{$usertotal}})</h4>
    </div>
    <div class="col-lg-8 mt-2">
        <div class="row">
            <div class="col-lg-4 justify-content-end">
                <div class="card">
                    <div class="card-header bg-secondary">
                        <div class="card-title text-white">Total Kecurangan Masuk</div>
                    </div>
                    <div class="card-body">
                        <p class="">{{ count($list_suara) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-success">
                        <div class="card-title text-white">Total Kecurangan Terverifikasi</div>
                    </div>
                    <div class="card-body">
                        <p class="">{{ count($terverifikasi) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="card-title text-white">Total Kecurangan Ditolak</div>
                    </div>
                    <div class="card-body">
                        <p class="">{{ count($ditolak) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- PAGE-HEADER END -->

<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Tim Validasi Kecurangan</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md">
                        <div class="card">
                            <div class="card-body text-center">
                                <p class="card-text">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/d/d3/Foto_Formal_Sudharmono.jpg" alt="" class="img-circle rounded" style="width: 150px; height: 150px; object-fit: cover;">
                                <h4>{{Auth::user()->name}}</h4>
                                <p class="pt-3 text-start"><i class="fa fa-envelope mr-2"></i> {{Auth::user()->email}}</p>
                                <p class="text-start"><i class="fa fa-phone mr-2"></i> {{Auth::user()->no_hp}}</p>
                                <p class="text-start"><i class="fa fa-map-marker mr-2"></i> 106.8532496, -6.5544207
                                </p>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md" style='overflow: scroll;height:408px;'>
                        @foreach($team as $people)
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                             <img class="rounded" style="width:100px; height :100px"  src="{{asset('storage/')}}/profile-photos/{{$people['profile_photo_path']}}" alt="" >
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="mt-0">{{$people->name}}</h5>
                                        <p>
                                            @if(Cache::has('is_online' . $people->id))
                                            <span class="badge bg-success">online</span>
                                            @else
                                            <span class="badge bg-danger">offline</span>
                                            @endif
                                        </p>
                                        <p style="font-size: 12px;">{{ \Carbon\Carbon::parse($people->last_seen)->diffForHumans() }}</p>
                                    </div>
                                </div>
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-7 col-xl-6">
        <div class="card custom-card">
            <div class="main-content-app pt-0">
                <div class="main-content-body main-content-body-chat">
                    <div class="main-chat-header pt-3">
                        <div class="main-chat-msg-name mt-2 mx-auto">
                            <h6><i class="fa-solid fa-user"></i> &nbsp;Live Chat (Sesama Validator Kecurangan)</h6>
                        </div>
                    </div><!-- main-chat-header -->
                    <livewire:chat-group-component />
                    <livewire:chat-component />
                </div>
            </div>
        </div>
    </div>
</div>
<hr style="border: 1px solid;">
<div class="row">
    @foreach($list_suara as $ls)
    <div class="col-md-6 col-xl-4">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="card-title text-white">DATA LAPORAN KECURANGAN SAKSI</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md">
                        @if ($ls->profile_photo_path == NULL)
                        <img class="" style="width: 250px;" src="https://ui-avatars.com/api/?name={{ $ls->name }}&color=7F9CF5&background=EBF4FF" alt="img">
                        @else
                        <img class="" style="width: 250px;" src="{{url("/storage/profile-photos/".$ls->profile_photo_path) }}">
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
                                <a href="fotomasalah" class="btn btn-secondary w-100 fotoKecurangan mt-2 rounded-0" id="Cek" data-bs-toggle="modal" id="" data-bs-target="#fotoKecurangan" data-id="{{$ls->tps_id}}">
                                    Validasi Kecurangan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>
@endsection