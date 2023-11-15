<div class="col-12">
    <div class="card rounded-0 mb-0">
        <div class="card-body">
            <div class="row">
                <?php
                    use App\Models\User;
                ?>
                @if ($saksi['kecurangan'] == "yes" && $qrcode != null)
                <?php $scan_url = url('') . "/scanning-secure/" . (string)Crypt::encrypt($qrcode->nomor_berkas); ?>
                <div class="col-auto my-auto">
                    {!! QrCode::size(100)->generate( $scan_url); !!}
                </div>
                @else
                @endif
                <div class="col mt-2">
                    <div class="media">
                        @if ($user['profile_photo_path'] == NULL)
                        <img class="rounded-circle"
                            style="width: 100px; height: 100px; object-fit: cover; margin-right: 10px;"
                            src="https://ui-avatars.com/api/?name={{ $user['name'] }}&color=7F9CF5&background=EBF4FF">
                        @else
                        <img class="rounded-circle"
                            style="width: 100px; height: 100px; object-fit: cover; margin-right: 10px;" src="{{url("/storage/profile-photos/".$user['profile_photo_path']) }}">
                        @endif

                        <div class="media-body my-auto">
                            <h5 class="mb-0">{{ $user['name'] }}</h5>
                            NIK : {{ $user['nik'] }}
                            <div>TPS {{$saksi->number}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-auto pt-2 my-auto px-1">
                    <a href="https://wa.me/{{$user->no_hp}}" class="btn btn-success text-white"><i
                            class="fa-solid fa-phone"></i>
                        Hubungi</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12" style="height: 100vh; overflow: scroll">
    <center>
        <img width="100%" src="{{asset('')}}storage/{{$saksi->c1_images}}" data-magnify-speed="200" alt=""
            data-magnify-magnifiedwidth="2500" data-magnify-magnifiedheight="2500" class="img-fluid zoom"
            data-magnify-src="{{asset('')}}storage/{{$saksi->c1_images}}">
    </center>
</div>