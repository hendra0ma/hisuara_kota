<div class="row">
    <div class="col-md-6 mt-3">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Admin Requestas</h5>
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
                        <div class="col">NIK : 1234567890123</div>
                        <div class="col">Kecamatan {{$kecamatan['name']}}/Kelurahan {{$kelurahan['name']}}</div>
                    </div>
                </p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md mb-3"><img src="{{asset('storage')}}/{{$saksi['c1_images']}}">
    </div>
    <div class="col-md">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Data Lama</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            <div class="row">
                                @foreach ($saksi_data as $ss)
                                <div class="col-md-6">
                                    <label for="suara01">Suara 0{{$ss['paslon_id']}}</label>
                                    <input type="text" id="suara01" class="form-control" value="{{$ss['voice']}}"
                                        disabled>
                                </div>
                                @endforeach


                            </div>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Pengajuan Data Baru</h5>
                    </div>
                    <form action="action_setujui/{{Crypt::encrypt($saksi['id'])}}" method="POST">
                        @csrf
                    <div class="card-body">
                        <p class="card-text">
                            <div class="row">
                                @foreach ($saksi_data_baru as $ss)
                                <div class="col-md-6">
                                    <label for="suara01">Suara 0{{$ss['paslon_id']}}</label>
                                    <input type="text" id="suara01" class="form-control" name="paslon{{$ss['paslon_id']}}" value="{{$ss['voice']}}">
                                </div>
                                @endforeach
                                <div class="col-md-12">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea class="form-control" id="keterangan" cols="30" rows="10"
                                        disabled>{{$saksi_data_baru_deskripsi['keterangan']}}</textarea>
                                </div>
                            </div>
                        </p>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn bg-success text-light w-100">Setujui</button>
                        <a href="tolak_koreksi/{{Crypt::encrypt($saksi['id'])}}" class="btn bg-danger mt-2 text-light w-100">Tolak</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
