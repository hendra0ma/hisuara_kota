<div>
    <h4 class="fw-bold fs-4 mt-5 mb-0">
        Jumlah Barkode : {{$jumlah_barkode}}
    </h4>
    <hr style="border: 1px solid">
    
    <div class="row">
        <div class="col-12 mb-3">
            <input wire:model="search" type="search" class="form-control border-1 border-dark"
                placeholder="Search posts by title...">
        </div>
    </div>
    
    <div class="card shadow-lg">
        <div class="card-body">
            <div class="row">
            
                @foreach ($qrcode as $item)
                <?php $scan_url = "" . url('') . "/scanning-secure/" . Crypt::encrypt($item->id) . ""; ?>
                <div class="col-md-6">
                    <center>
                        <div class="card" onclick="window.location.href = '{{$scan_url}}'"
                            style="background-color:white; cursor: pointer;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="px-0 col-3 my-auto">
                                        {!! QrCode::size(125)->generate( $scan_url); !!}
                                    </div>
                                    <div class="px-0 col-3 text-center mb-3">
                                        @if ($item['profile_photo_path'] == NULL)
                                        <img style="width: 150px; height: 150px; object-fit: cover; margin-right: 10px;"
                                            src="https://ui-avatars.com/api/?name={{ $item['user_name'] }}&color=7F9CF5&background=EBF4FF">
                                        @else
                                        <img style="width: 150px; height: 150px; object-fit: cover; margin-right: 10px;"
                                            src="{{url("/storage/profile-photos/".$item['profile_photo_path']) }}">
                                        @endif
                                    </div>
                                    <div class="px-0 col-6 my-auto text-center">
                                        <div class="mb-0 fw-bold" style="font-size: 25px">{{ $item['user_name'] }}</div>
                                        <div style="font-size: 15px">NIK : {{ $item['user_nik'] }}</div>
                                        <div style="font-size: 15px">SAKSI TPS {{ $item['number'] }}</div>
                                        <div style="font-size: 15px">KELURAHAN {{ $item['village_name'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </center>
                </div>
                @endforeach
                {{$qrcode->links()}}
            </div>
        </div>
    </div>
</div>