<div class="container-fluid">
    <div class="mb-5" style="padding: 0 10rem">
        <div class="card mb-5" >
            <div class="card-body">
                <div class="row justify-content-center">
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
                            <img class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover; margin-right: 10px;"
                                src="https://ui-avatars.com/api/?name={{ $user['name'] }}&color=7F9CF5&background=EBF4FF">
                            @else
                            <img class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover; margin-right: 10px;"
                                src="{{url("/storage/profile-photos/".$user['profile_photo_path']) }}">
                            @endif
                    
                            <div class="media-body my-auto">
                                <h5 class="mb-0">{{ $user['name'] }}</h5>
                                NIK : {{ $user['nik'] }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-auto pt-2 my-auto px-1">
                        <a href="https://wa.me/{{$user->no_hp}}" class="btn btn-success text-white"><i class="fa-solid fa-phone"></i>
                            Hubungi</a>
                    </div>
                </div>
            </div>
        </div>
        
                <div class="card">
                    <div class="card-header" style="border: 1px #eee solid !important; background-color: #eee">
                        <h3 class="mb-0 card-title">Pelapor dan Pemeriksa</h3>
                    </div>
                    <div class="card-body" style="border: 1px #eee solid !important">
                        <table class="table table-bordered">
                            <tr>
                                <td class="fw-bold">
                                    <div class="text-center">Petugas Saksi</div>
                                </td>
                                <td class="fw-bold">
                                    <div class="text-center">Petugas Verifikator</div>
                                </td>
                                <td class="fw-bold">
                                    <div class="text-center">Petugas Validasi Kecurangan</div>
                                </td>
                                <td class="fw-bold">
                                    <div class="text-center">Tanggal Dokumen</div>
                                </td>
                            </tr>
                            <tr>
                                <td> {{$user->name}}</td>
                                <td> {{ $verifikator->name }}</td>
                                <td> {{ $hukum->name }}</td>
                                <td rowspan="2" class="align-middle text-center"> {{ $qrcode->created_at }}</td>
                            </tr>
                            <tr>
                                <td> {{$user->no_hp}}</td>
                                <td> {{ $verifikator->no_hp}}</td>
                                <td> {{ $hukum->no_hp }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
        
    </div>

    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card" style="height: 500px; overflow: scroll;">
                <div class="card-header" style="border: 1px #eee solid !important; background-color: #eee">
                    <h4 class="card-title">Bukti Foto Kecurangan</h4>
                </div>
                <div class="card-body" style="border: 1px #eee solid !important">
                    <div id="carousel-controls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php $i = 0;
                            foreach ($foto_kecurangan as $foto) : ?>
                                <?php if ($i == 0) {
                                    $set_ = 'active';
                                } else {
                                    $set_ = '';
                                } ?>
                                <div class="carousel-item <div class='carousel-item <?php echo $set_; ?>">
                                    <img class="d-block w-100" alt="" src="{{asset('storage')}}\{{ $foto['url'] }}" data-bs-holder-rendered="true">
                                </div>
                            <?php $i++;
                            endforeach ?>
                        </div>
                        <a class="carousel-control-prev" href="#carousel-controls" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-controls" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header" style="border: 1px #eee solid !important; background-color: #eee">
                    <h4 class="card-title">Bukti Video Kecurangan</h4>
                </div>
                <div class="card-body" style="border: 1px #eee solid !important">
                    <p class="card-text">
                    <ul id="lightgallery" class="list-unstyled row">
                        <video style="width: 100%; height: auto;" controls>
                            <source src="{{asset('storage/'.$vidio_kecurangan->url)}}" type=video/ogg>
                            <source src="{{asset('storage/'.$vidio_kecurangan->url)}}" type=video/mp4>
                        </video>
                    </ul>
                    </p>
                </div>
            </div>
        </div>



        <div class="col-md-10">
            <div class="row">
                <div class="col-md-6">
                    <table class="table">
                        <thead class="thead thead-dark">
                            <tr>
                                <th width="50px">no</th>
                                <th>Kecurangan Umum</th>
                            </tr>
                        </thead>
                        <?php $i = 1;  ?>
                        @foreach($list_kecurangan as $lk)


                        <tr>
                            @if($lk->jenis == 0)
                            <td width="50px">{{$i++}}</td>
                            <td>{{$lk->kecurangan}}</td>
                            @endif
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table">
                        <thead class="thead thead-dark">
                            <tr>
                                <th width="50px">no</th>
                                <th>Kecurangan Petugas</th>
                            </tr>
                        </thead>
                        <?php $i = 1;  ?>
                        @foreach($list_kecurangan as $lk)

                        <tr>
                            @if($lk->jenis == 1)
                            <td width="50px">{{$i++}}</td>
                            <td>{{$lk->kecurangan}}</td>
                            @endif
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table">
                        <thead class="thead thead-dark">
                            <tr>
                                <th width="50px">no</th>
                                <th>Rekomendasi Tindakan</th>
                            </tr>
                        </thead>
                        <tbody id="container-rekomendasi">

                        </tbody>
                    </table>
                </div>

            </div>

            <div class="row justify-content-end">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{route('verifikator.verifikasiKecurangan',Crypt::encrypt($list_kecurangan[0]->tps_id))}}" class="btn btn-block btn-success">
                                Verifikasi Kecurangan
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{route('verifikator.tolakKecurangan',Crypt::encrypt($list_kecurangan[0]->tps_id))}}" class="btn btn-block btn-danger">
                                Tolak Kecurangan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    setTimeout(function() {
        let uniqueData = [@foreach($list_kecurangan as $item)
            '{{$item->solution}}', @endforeach
        ];
        let uniqueDataId = [@foreach($list_kecurangan as $item)
            '{{$item->list_kecurangan_id}}', @endforeach
        ];
        let dataMerge = [];
        uniqueArrayText = uniqueData.filter(function(item, pos) {
            return uniqueData.indexOf(item) == pos;
        });
        uniqueArrayId = uniqueDataId.filter(function(item, pos) {
            return uniqueDataId.indexOf(item) == pos;
        });
        for (let i = 0; i < uniqueDataId.length; i++) {
            dataMerge.push([uniqueArrayId[i], uniqueArrayText[i]]);
        }

        dataMerge.forEach(function(item, index) {
            
            if (item[1] == undefined) {
                return;
            }
             index +=1;
            $('#container-rekomendasi').append(`
            
                    <tr id="solution${item[0]}">
                        <td width="50px">
                        ${index}
                        </td>
                        <td>
                            ${item[1]}
                        </td>
                    </tr>
                    `)
        });
    }, 300)
</script>