<div class="row">
    <div class="col-md-6">

        <div class="row">
            <div class="col-md">

                <div class="card" style="width: 100%; height: auto;">
                    <div class="card-header">
                        <h3 class="card-title">Bukti Kecurangan</h3>
                    </div>
                    <div class="card-body h-100">
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
                                        <img class="d-block w-100" alt="" src="{{asset('storage\hukum\bukti_foto')}}\{{ $foto['url'] }}" data-bs-holder-rendered="true">
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
        </div>

        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Bukti Kecurangan</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">

                            <ul id="lightgallery" class="list-unstyled row">
                                <video style="width: 100%; height: auto;" controls>
                                    <source src="{{asset('storage/'.$vidio_kecurangan['url'])}}"
                                        type=video/ogg> 
                                    <source
                                        src="{{asset('storage/'.$vidio_kecurangan['url'])}}"
                                        type=video/mp4> 
                                </video> 
                            </ul> 
                        </p> 
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Laporan Kejadian TPS</h4>
            </div>
            <form action="action/proses_kecurangan/{{ Crypt::encrypt($tps['id']); }}" method="post">
                @csrf
                <div class="card-body" style="overflow: scroll;">
                    <p class="card-text">
                    <div class="row">
                        <div class="col-12">
                            <h6> {{ $kecamatan['name'] }} - TPS {{$tps['number']}} </h6>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-justify">Admin Hukum dapat
                                        mengkoreksi / menghapus dan atau menambahkan
                                        item
                                        kecurangan jika data kecurangan yang dikirimkan
                                        saksi kurang lengkap atau salah. Admin Hukum
                                        juga dapat memberi keterangan yang relevan pada
                                        kolom BAP Admin Hukum atau abaikan jika
                                        keterangan saksi dirasa cukup. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <table class="table">
                        <thead class="bg-danger text-light">
                            <tr>
                                <th>Cek</th>
                                <th>Deskripsi Kecurangan Saksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_kecurangan as $item)
                            <tr>
                                <td><input type="hidden" name="bukti_text[]" checked="" value="{{ $item['text'] }}"></td>
                                <td>{{ $item['text'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tbody>
                            <tr class="bg-danger text-light">
                                <td colspan="2">
                                    Rekomendasi
                                </td>
                            </tr>  
                          <tbody id="appendDataSolution">
                               <tr>
                                <td>
                                </td>
                                <td>
                                     {{$solution->solution}} ({{$solution->kode}})
                                </td>
                                </tr>
                          </tbody>
                         
                            <script>
                                // setTimeout(() => {
                                 
                                //     let uniqueData =  [@foreach ($list_kecurangan as $item) '{{$item->solution}} | {{$item->kode}}', @endforeach];
                                 
                                //     uniqueArray = uniqueData.filter(function(item, pos) {
                                //         return uniqueData.indexOf(item) == pos;
                                //     });
                                //   uniqueArray.forEach(function (item,index){
                                //         $('#appendDataSolution').append(`
                                       
                                //         `)
                                //   });
                                 
                                // }, 200);
                               
                            </script>  


                        </tbody>
                      
                    </table>
                    </p>
                </div>
                <div class="card-footer">
                    <?php if ($saksi['status_kecurangan'] == "terverifikasi") : ?>

                        <a href="{{route('superadmin.printKecurangan',Crypt::encrypt($tps['id']))}}" target="_blank" class="btn mt-2 ml-3 btn-success">Print Kecurangan</a>
                    <?php else : ?>

                    <?php endif; ?>
                </div>
            </form>
        </div>

    </div>
</div>