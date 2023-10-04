@extends('layouts.mainLayouthunter');

@section('content')

<div class="row mt-3">
    <div class="col-lg-11">
        <h1 class="page-title fs-1 mt-2">Dashboard
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Relawan
                <!-- Kota -->
            </li>
        </ol>
        <h4 class="fs-4 mt-2 fw-bold">Verifikator Suara Relawan Partai ({{$team_count}})</h4>
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

        </div>
        <div class="col-xl-7">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Tim Verifikasi Suara Relawan</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md">
                            <div class="card">
                                <div class="card-body text-center">
                                    <p class="card-text">
                                        <img src="{{asset("public/storage/profile-photos")."/". Auth::user()->profile_photo_path }}" alt="" class="img-circle rounded" style="width: 150px; height: 150px; object-fit: cover;">
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
                                            <img class="rounded" style="width:80px;height:80px;object-fit:cover" src="{{ asset("public/storage/profile-photos")."/".$people->profile_photo_path }}" alt="" width="">
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
    <livewire:c1-hunter-component />
</div>



<div class="modal fade" id="periksaC1Relawan" tabindex="-1" aria-labelledby="periksaC1RelawanLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="periksaC1RelawanLabel">Data TPS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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



<script>
    function openPage(pageName, elmnt, color) {


        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].style.backgroundColor = "";
        }
        elmnt.style.backgroundColor = color;
        document.getElementById(pageName).style.display = "block";

    }
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>
@endsection