<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card" style="height: 500px; overflow: scroll;">
                <div class="card-header">
                    <h4 class="card-title">Bukti Foto Kecurangan</h4>
                </div>
                <div class="card-body">
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
                <div class="card-header">
                    <h4 class="card-title">Bukti Video Kecurangan</h4>
                </div>
                <div class="card-body">
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