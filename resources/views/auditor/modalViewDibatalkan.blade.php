<div class="row">
    <div class="halamanKoreksi" style="display: none">
        <div class="row">
            <div class="col-md-6 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Admin Request</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                        <div class="media">
                            @if($url == url('')."/auditor/audit-c1")
                            @else
                            @if ($admin_req['profile_photo_path'] == NULL)
                            <img class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover; margin-right: 10px;"
                            src="https://ui-avatars.com/api/?name={{ $admin_req['name'] }}&color=7F9CF5&background=EBF4FF">
                            @else
                            <img class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover; margin-right: 10px;"
                            src="{{url("/storage/profile-photos/".$admin_req['profile_photo_path']) }}">
                            @endif
                            <div class="media-body">
                                <h5 class="mt-0">{{$admin_req['name']}}</h5>
                                NIK : {{$admin_req['nik']}}
                            </div>
                            @endif
                            
                            
            
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
    </div>
    
    <div class="halamanAudit" style="display: none">
        <div class="row">
            <div class="col-md mt-3">
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
                        {{-- <p class="card-text"> --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    @foreach ($saksi_data as $ss)
                                    <div class="col-md-12">
                                        <label for="suara01">Suara 0{{$ss['paslon_id'] + 1}}</label>
                                        <input type="text" class="form-control" value="{{$ss['voice']}}" disabled>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-md-6 text-center">
                                <div class="card h-100">
                                    <div class="card-header py-1">
                                        Total :
                                    </div>
                                    <div class="card-body d-flex display-2 fw-bold">
                                        <div class="my-auto mx-auto">
                                            <?php
                                            // Mengonversi Collection ke array dan kemudian menghitung total suara
                                            $saksi_data_array = $saksi_data->toArray();
                                            $total_suara = array_reduce($saksi_data_array, function ($carry, $item) {
                                                return $carry + $item['voice'];
                                            }, 0);
                                            ?>
                                            {{ $total_suara }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- </p> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row halamanAudit" style="display: none">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Isi Data Baru</h5>
                    </div>
                    <form action="{{route('superadmin.actionSetujuKoreksiAuditor',Crypt::encrypt($saksi['id']))}}" method="POST">
                        @csrf
                        <div class="card-body">
                            {{-- <p class="card-text"> --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        @foreach ($saksi_data as $ss)
                                        <div class="col-md-12">
                                            <label for="suara01">Suara 0{{$ss['paslon_id'] + 1}}</label>
                                            <input type="text" id="suara" class="form-control suara-input" name="paslon{{$ss['paslon_id']}}">
                                        </div>
                                        @endforeach 
                                    </div>
                                </div>
                                {{-- <div class="col-md-12">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea class="form-control" id="keterangan" cols="30" rows="10"
                                        disabled>{{$saksi_data_baru_deskripsi['keterangan']}}</textarea>
                                </div> --}}
                                <div class="col-md-6 text-center">
                                    <div class="card h-100">
                                        <div class="card-header py-1">
                                            Total :
                                        </div>
                                        <div class="card-body d-flex display-2 fw-bold">
                                            <div class="my-auto mx-auto" id="sumDisplay">
                                                {{-- {{$total_suara }} --}}
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="display-2 fw-bold">Total :</div>
                                    <div class="display-2 fw-bold">{{$total_suara }}</div> --}}
                                </div>
                            </div>
                            {{-- </p> --}}
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn bg-success text-light w-100">Terbitkan</button>
                            {{-- {{$url}} --}}
                            {{-- <a href="tolak_koreksi/{{Crypt::encrypt($saksi['id'])}}"
                                class="btn bg-danger mt-2 text-light w-100">Tolak</a> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        const url = window.location.href;
        if (url == '{{url('')}}/auditor/audit-c1') {
            $('.halamanAudit').show();
        } else if (url == '{{url('')}}/administrator/dokumen_lain') {
            $('.halamanKoreksi').show();
        }
    })
</script>

<script>
    $(document).ready(function() {
        $('.suara-input').on('input', function() {
            // Get all input values with the class 'suara-input'
            let allValues = $('.suara-input').map(function() {
                return parseFloat($(this).val()) || 0;
            }).get();

            console.log(allValues);
            // Calculate the sum of all input values
            let sum = allValues.reduce(function(a, b) {
                return a + b;
            }, 0);
            // Display the sum in the HTML document
            $('#sumDisplay').html(sum);
        });
    });
</script>