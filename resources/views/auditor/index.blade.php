@extends('layouts.mainlayoutAuditor');

@section('content')
<style>
    .dark-mode .text-name {
        color: white;
    }
</style>

<div class="row mt-3">
    <div class="col-lg-11">
        <h1 class="page-title fs-1 mt-2">Dashboard
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Auditor
                <!-- Kota -->
            </li>
        </ol>
        <h4 class="fs-4 mt-2 fw-bold">Auditor Suara Masuk ({{count($team)}})</h4>
    </div>
    <div class="col-lg-1">
        <div class="ms-auto pageheader-btn mt-5">
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <input type="hidden" value="{{$district->id}}" name="district_id">
                <input type="hidden" value="{{Auth::user()->role_id}}" name="role_id">
                <input type="hidden" value="{{Auth::user()->id}}" name="id">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="btn btn-danger btn-icon text-white">
                    <span>
                        <i class="fe fe-log-out"></i>
                    </span> Logout
                </a>

            </form>

        </div>
    </div>
</div>

<div class="container-fluid mt-4 px-0">
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
                    <h5 class="card-title">Tim Audit Suara Saksi</h5>
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
        <div class="col-xl-5">
            <div class="card custom-card">
                <div class="main-content-app pt-0">
                    <div class="main-content-body main-content-body-chat">
                        <div class="main-chat-header pt-3">
                            <div class="main-chat-msg-name mt-2 mx-auto">
                                <h6><i class="fa-solid fa-user"></i> &nbsp;Live Chat (Sesama Auditor)</h6>
                            </div>
                        </div><!-- main-chat-header -->
                        <livewire:chat-group-component />




                        <livewire:chat-component />

                    </div>
                </div>
            </div>

        </div>
        <div class="row justify-content-center px-0">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h3>
                            {{ $district->name }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            @foreach ($villages as $village)
                            <div class="col-xl-3">
                                <?php
                                $cek = App\Models\Security::where('district_id', $village->id)
                                    ->where('security', 2)
                                    ->where('user_id', Auth::user()->id)
                                    ->count();
                                ?>
                                <a href="{{route('auditor.village', Crypt::encrypt($village->id))}}">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row justify-content-center no-gutters">
                                                <div class="col-12">
                                                    <center>
                                                        <i class="fa fa-map-marker fa-3x"></i> <br>
                                                        <div class="mt-2">KEL. {{ $village->name }}</div>
                                                        <ul class="text-light mt-2">
                                                            @foreach ($team as $tim)
                                                            @if (Cache::get('some_user' . $village->id . $tim->role_id . $tim->id))

                                                            <li><span class="text-success">&#9679;</span> {{$tim->name}}</li>
                                                            @endif
                                                            @endforeach

                                                            @if (Cache::get('some_user' . $village->id . Auth::user()->role_id . Auth::user()->id) == Auth::user()->id)
                                                            <li class="text-dark"> <span class="text-success">&#9679;</span> {{ Auth::user()->name }}</li>
                                                            @endif
                                                        </ul>
                                                    </center>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection