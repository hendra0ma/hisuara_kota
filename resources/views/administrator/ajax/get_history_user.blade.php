<div class="container mt-5">
    @foreach ($profiles as $profile)
    <div class="card">
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
                        <p class="text-muted font-size-sm">{{$profile['address']}}</p>
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
                            <button type="button" class="btn btn-primary  w-100 rounded-0" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <i class="mdi mdi-history"></i> History
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endforeach
    @foreach ($user as $us)
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"> {{$us['created_at']}}</h5>
            <p class="card-text">{{$us['action']}}</p>
        </div>
    </div>
    @endforeach
</div>