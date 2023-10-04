<div class="modal-header">
    <div class="modal-title">Tracking</div>
</div>
<div class="container">
    <div class="row">
        @foreach ($user as $item)
        <div class="col-md-4">
            <div class="card-profile-container mt-3 mb-3">
                @if ($item['profile_photo_path'] == NULL)
                <img class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover; margin-right: 10px;" src="https://ui-avatars.com/api/?name={{ $item['name'] }}&color=7F9CF5&background=EBF4FF">
                @else
                <img class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover; margin-right: 10px;" src="{{url("/storage/profile-photos/".$item['profile_photo_path']) }}">
                @endif
                <h3>{{$item['name']}}</h3>
                @if ($item['role_id'] == 2)
                <h6>Admin Verifikasi</h6>
                @elseif ($item['role_id'] == 3)
                <h6>Admin Auditor</h6>
                @else
                    {{$item['role_id']}}
                @endif
                <p>@if(Cache::has('is_online' . $item['id']))
                    <span class="badge bg-success  me-1 mb-1 mt-1">Online</span>
                    @else
                    <span class="badge bg-danger  me-1 mb-1 mt-1">Offline</span>
                    @endif</p>
                <a href="tracking/detail/{{encrypt($item['id'])}}" target="_blank" class="btn bg-primary rounded-0 text-light">
                    Lacak
                </a>
                <a href="/administrator/blokir/{{Crypt::encrypt($item['id'])}}" class="btn btn-outline-danger rounded-0">
                    Kick
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>
