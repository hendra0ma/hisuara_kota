@extends('layouts.main-hukum')

@section('content')

<div class="row mt-3">
    <div class="col-lg-4">
        <h1 class="page-title fs-1 mt-2">Dashboard
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Administrator 1
                <!-- Kota -->
            </li>
        </ol>
    </div>
    <div class="col-lg-8 mt-2">
        <div class="row">
            <div class="col-lg-4 justify-content-end">
                <div class="card">
                    <div class="card-header bg-secondary">
                        <div class="card-title">Data Masuk</div>
                    </div>
                    <div class="card-body">
                        <p class="">{{ count($data_masuk) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-success">
                        <div class="card-title">Data Terverifikasi</div>
                    </div>
                    <div class="card-body">
                        <p class="">{{ count($terverifikasi) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="card-title">Data Ditolak</div>
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
                <h5 class="card-title">Tim Admin Hukum</h5>
            </div>
            <div class="card-body">
                <p>Admin Terdaftar : 2</p>
                <div class="row">
                    <div class="col-md">
                        <div class="card">
                            <div class="card-body text-center">
                                <p class="card-text">
                                    <img class="rounded" src="https://randomuser.me/api/portraits/women/17.jpg" alt="">
                                    <h4>Amelia Natasha</h4>
                                    <p class="pt-3 text-start"><i class="fa fa-envelope mr-2"></i> email@gmail.com</p>
                                    <p class="text-start"><i class="fa fa-phone mr-2"></i> 081234567899</p>
                                    <p class="text-start"><i class="fa fa-map-marker mr-2"></i> 106.8532496, -6.5544207
                                    </p>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <img class="rounded" width="80px"
                                                src="https://randomuser.me/api/portraits/women/17.jpg" alt="" width="">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h5 class="mt-0">Amelia Natasha</h5>
                                            <p><span class="badge bg-danger">offline</span></p>
                                            <p style="font-size: 12px;">Last Online 2 Years ago</p>
                                        </div>
                                    </div>
                                </p>
                            </div>
                        </div>
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
                        <div class="main-chat-msg-name mt-2">
                            <h6>Live Chat</h6>
                        </div>
                    </div><!-- main-chat-header -->
                    <div class="main-chat-body" style="overflow:scroll;height:400px" id="ChatBody">
                        <div class="content-inner">
                            <label class="main-chat-time"><span>3 days ago</span></label>
                            <div class="media flex-row-reverse chat-right">
                                <div class="main-img-user online"><img alt="avatar"
                                        src="../../assets/images/users/2.jpg"></div>
                                <div class="media-body">
                                    <div class="main-msg-wrapper">
                                        Nulla consequat massa quis enim. Donec pede justo, fringilla vel...
                                    </div>
                                    <div class="main-msg-wrapper">
                                        rhoncus ut, imperdiet a, venenatis vitae, justo...
                                    </div>
                                    <div>
                                        <span>9:48 am</span> <a href=""><i
                                                class="icon ion-android-more-horizontal"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="media chat-left">
                                <div class="main-img-user online"><img alt="avatar"
                                        src="../../assets/images/users/1.jpg"></div>
                                <div class="media-body">
                                    <div class="main-msg-wrapper">
                                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula
                                        eget dolor.
                                    </div>
                                    <div>
                                        <span>9:32 am</span> <a href=""><i
                                                class="icon ion-android-more-horizontal"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="media flex-row-reverse chat-right">
                                <div class="main-img-user online"><img alt="avatar"
                                        src="../../assets/images/users/2.jpg"></div>
                                <div class="media-body">
                                    <div class="main-msg-wrapper">
                                        Nullam dictum felis eu pede mollis pretium
                                    </div>
                                    <div>
                                        <span>11:22 am</span> <a href=""><i
                                                class="icon ion-android-more-horizontal"></i></a>
                                    </div>
                                </div>
                            </div><label class="main-chat-time"><span>Yesterday</span></label>
                            <div class="media chat-left">
                                <div class="main-img-user online"><img alt="avatar"
                                        src="../../assets/images/users/1.jpg"></div>
                                <div class="media-body">
                                    <div class="main-msg-wrapper">
                                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula
                                        eget dolor.
                                    </div>
                                    <div>
                                        <span>9:32 am</span> <a href=""><i
                                                class="icon ion-android-more-horizontal"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="media flex-row-reverse chat-right">
                                <div class="main-img-user online"><img alt="avatar"
                                        src="../../assets/images/users/2.jpg"></div>
                                <div class="media-body">
                                    <div class="main-msg-wrapper">
                                        Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla
                                        consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec. In enim
                                        justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
                                    </div>
                                    <div class="main-msg-wrapper">
                                        Nullam dictum felis eu pede mollis pretium
                                    </div>
                                    <div>
                                        <span>9:48 am</span> <a href=""><i
                                                class="icon ion-android-more-horizontal"></i></a>
                                    </div>
                                </div>
                            </div><label class="main-chat-time"><span>Today</span></label>
                            <div class="media chat-left">
                                <div class="main-img-user online"><img alt="avatar"
                                        src="../../assets/images/users/1.jpg"></div>
                                <div class="media-body">
                                    <div class="main-msg-wrapper">
                                        Maecenas tempus, tellus eget condimentum rhoncus
                                    </div>
                                    <div class="pd-0">
                                        <img alt="avatar" class="w-10 h-10 mb-1" src="../../assets/images/media/3.jpg">
                                        <img alt="avatar" class="w-10 h-10 mb-1" src="../../assets/images/media/4.jpg">
                                        <img alt="avatar" class="w-10 h-10 mb-1" src="../../assets/images/media/5.jpg">
                                    </div>
                                    <div>
                                        <span>10:12 am</span> <a href=""><i
                                                class="icon ion-android-more-horizontal"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="media flex-row-reverse chat-right">
                                <div class="main-img-user online"><img alt="avatar"
                                        src="../../assets/images/users/2.jpg"></div>
                                <div class="media-body">
                                    <div class="main-msg-wrapper">
                                        Maecenas tempus, tellus eget condimentum rhoncus
                                    </div>
                                    <div class="main-msg-wrapper">
                                        Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec
                                        odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus.
                                    </div>
                                    <div>
                                        <span>09:40 am</span> <a href=""><i
                                                class="icon ion-android-more-horizontal"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="main-chat-footer">
                        <input class="form-control" placeholder="Type your message here..." type="text">
                        <a class="main-msg-send" href=""><i class="fa fa-paper-plane-o"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">

    @foreach($list_suara as $ls)
    <div class="col-md-6 col-xl-3">
        <div class="card item-card" style="height: 450px">
            <div class="product-grid6 card-body">
                <div class="product-image6">
                    @if ($ls->profile_photo_path == NULL)
                    <img class="img-fluid" style="width: 300px;"
                        src="https://ui-avatars.com/api/?name={{ $ls->name }}&color=7F9CF5&background=EBF4FF" alt="img">
                    @else
                    <img class="rounded-circle" style="width: 300px;"
                        src="{{url("/storage/profile-photos/".$ls->profile_photo_path) }}">
                    @endif

                </div>
                <div class="product-content text-center">

                    <h4 class="mb-3 fw-bold"><a href="#">TPS {{$ls->number}}</a></h4>
                    <div class="alert alert-primary">
                        <strong>Data Masuk</strong>
                    </div>
                    
                </div>
                <ul class="icons z-index3" style="background: rgb(0,0,0); background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.65) 15%, rgba(0,0,0,0.75) 25%, rgba(0,0,0,1) 100%);
                        height: 100%; transform: translateY(115px);">
                    <div class="container">
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
                        <a href="fotomasalah" class="btn btn-secondary w-90 fotoKecurangan mt-2 rounded-0" id="Cek"
                            data-bs-toggle="modal" id="" data-bs-target="#fotoKecurangan" data-id="{{$ls->tps_id}}">
                            List Kecurangan</a>
                    </div>
                </ul>
            </div>
        </div>
    </div>
    @endforeach


</div>
@endsection