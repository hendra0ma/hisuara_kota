<div class="row">
    <div class="col-md-6 mt-3">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Admin Request</h5>
            </div>
            <div class="card-body">
                <p class="card-text">
                    <div class="media">
                        @if ($admin_req['profile_photo_path'] == NULL)
                        <img class="rounded-circle"
                            style="width: 70px; height: 70px; object-fit: cover; margin-right: 10px;"
                            src="https://ui-avatars.com/api/?name={{ $admin_req['name'] }}&color=7F9CF5&background=EBF4FF">
                        @else
                        <img class="rounded-circle"
                            style="width: 70px; height: 70px; object-fit: cover; margin-right: 10px;"
                            src="{{url("/storage/profile-photos/".$admin_req['profile_photo_path']) }}">
                        @endif


                        <div class="media-body">
                            <h5 class="mt-0">{{$admin_req['name']}}</h5>
                            NIK : {{$admin_req['nik']}}
                        </div>
                    </div>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-6 mt-3">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Saksi</h5>
            </div>
            <div class="card-body  text-center">
                <p class="card-text">
                    <div class="row fw-bolder">
                        <div class="col">{{$saksi_koreksi['name']}}</div>
                        <div class="col">TPS {{$tps['number']}}</div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">NIK : {{$saksi_koreksi['nik']}}</div>
                        <div class="col">Kecamatan {{$kecamatan['name']}}/Kelurahan {{$kelurahan['name']}}</div>
                    </div>
                </p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md mb-3"><img src="{{asset('storage')}}/{{$riwayat_koreksi['c1_images']}}">
    </div>
    <div class="col-md">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Data Lama</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    @php
                                    $totalSuara = 0;
                                    @endphp
                                    @if (isset($riwayat_koreksi_data))
                                        @foreach ($riwayat_koreksi_data as $ss)
                                        <div class="col-md-12">
                                            <label for="suara01">Suara 0{{$ss['paslon_id'] + 1}}</label>
                                            <input type="text" id="suara01" class="form-control" value="{{$ss['voice']}}" disabled>
                                            @php
                                            $totalSuara += $ss['voice'];
                                            @endphp
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6 text-center">
                                <div class="card h-100">
                                    <div class="card-header py-1">
                                        Total :
                                    </div>
                                    <div class="card-body d-flex display-2 fw-bold">
                                        <div class="my-auto mx-auto">
                                            {{$totalSuara}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Perubahan Suara</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    @php
                                    $totalSuara = 0;
                                    @endphp
                                    @if (isset($saksi_data))
                                        @foreach ($saksi_data as $ss)
                                        <div class="col-md-12">
                                            <label for="suara01">Suara 0{{$ss['paslon_id'] + 1}}</label>
                                            <input type="text" id="suara01" class="form-control" value="{{$ss['voice']}}" disabled>
                                            @php
                                            $totalSuara += $ss['voice'];
                                            @endphp
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6 text-center">
                                <div class="card h-100">
                                    <div class="card-header py-1">
                                        Total :
                                    </div>
                                    <div class="card-body d-flex display-2 fw-bold">
                                        <div class="my-auto mx-auto">
                                            {{$totalSuara}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
