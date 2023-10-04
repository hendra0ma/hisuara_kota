@extends('layouts.mainlayoutChecking')

@section('content')

<div class="row mt-3">
    <div class="col-lg-11">
        <h1 class="page-title fs-1 mt-2">Dashboard Rekapitung
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Verifikator Overtime
                <!-- Kota -->
            </li>
        </ol>
        <h4 class="fs-4 mt-2 fw-bold">Verifikator Overtime (2)</h4>
    </div>
    <div class="col-lg-1">
        <div class="ms-auto pageheader-btn mt-5">
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class=" btn btn-danger btn-icon text-white">
                    <span>
                        <i class="fe fe-log-out"></i>
                    </span> Logout
                </a>

            </form>

        </div>
    </div>
</div>

<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-xl-10">
            @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show text-dark mt-2 mb-2" role="alert">
                {{ Session::get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
            </div>
            @endif
            @if ($message = Session::get('success'))
            <div class="alert alert-danger alert-dismissible fade show text-dark mt-2 mb-2" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
            </div>
            @endif
        </div>
        <div class="col-xl-7">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Tim Verifikasi Suara Overtime</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md">
                            <div class="card">
                                <div class="card-body text-center">
                                    <p class="card-text">
                                        <img src="{{ Auth::user()->profile_photo_url }}" alt="" class="img-circle rounded" style="width: 150px; height: 150px; object-fit: cover;">
                                    <h4>{{Auth::user()->name}}</h4>
                                    <p class="pt-3 text-start"><i class="fa fa-envelope mr-2"></i> {{Auth::user()->email}}</p>
                                    <p class="text-start"><i class="fa fa-phone mr-2"></i> {{Auth::user()->no_hp}}</p>
                                    <p class="text-start"><i class="fa fa-map-marker mr-2"></i> 106.8532496, -6.5544207
                                    </p>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md" style='overflow: scroll;height:423px;'>
                            @foreach($team as $people)
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-text">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <img class="rounded" width="80px" src="https://ui-avatars.com/api/?name={{$people['name']}}&color=7F9CF5&background=EBF4FF" alt="" width="">
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
        <div class="col-xl-5">
            <div class="card custom-card">
                <div class="main-content-app pt-0">
                    <div class="main-content-body main-content-body-chat">
                        <div class="main-chat-header pt-3">
                            <div class="main-chat-msg-name mt-2 mx-auto">
                                <h6><i class="fa-solid fa-user"></i> &nbsp;Live Chat (Sesama Verifikator)</h6>
                            </div>
                        </div><!-- main-chat-header -->
                        <livewire:chat-group-component />




                        <livewire:chat-component />

                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">

        @foreach($list_suara as $ls)
        <div class="col-md-6 col-xl-4">
            <div class="card item-card">



                <div class=" product-grid6 card-body">
                    <div class="product-image6">
                        @if ($ls->profile_photo_path == NULL)
                        <img class="img-fluid" style="width: 250px;" src="https://ui-avatars.com/api/?name={{ $ls->name }}&color=7F9CF5&background=EBF4FF" alt="img">
                        @else
                        <img class="img-fluid" style="width: 250px;" src="{{url("/storage/profile-photos/".$ls->profile_photo_path) }}">
                        @endif
                    </div>
                    <div class="product-content text-center">

                        <h4 class="mb-3 fw-bold"><a href="#">TPS {{$ls->number}}</a></h4>
                        <h4 class="price">Data C1 Masuk</h4>
                    </div>
                    <ul class="icons z-index3" style="background: rgb(0,0,0); background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.65) 15%, rgba(0,0,0,0.75) 25%, rgba(0,0,0,1) 100%);
                        height: 110%; transform: translateY(115px);">
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
                        <button type="button" class="btn btn-primary w-75 mb-4 periksa-c1-plano" data-bs-toggle="modal" data-bs-target="#periksaC1Verifikator" data-id="{{$ls->tps_id}}">
                            Periksa C1
                            Plano
                        </button>

                    </ul>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>



<div class="modal fade" id="periksaC1Verifikator" tabindex="-1" aria-labelledby="periksaC1VerifikatorLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="periksaC1VerifikatorLabel">Data TPS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <div class="row" id="container-view-modal">

                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

@endsection