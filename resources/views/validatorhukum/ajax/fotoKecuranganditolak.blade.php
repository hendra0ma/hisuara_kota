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
                                <?php $i=0; foreach ($foto_kecurangan as $foto): ?>
                                <?php if ($i==0) {$set_ = 'active'; } else {$set_ = ''; } ?> 
                                <div class="carousel-item <div class='carousel-item <?php echo $set_; ?>">
                                    <img class="d-block w-100" alt=""
                                        src="{{asset('storage\hukum\bukti_foto')}}\{{ $foto['url'] }}"
                                        data-bs-holder-rendered="true">
                                </div>
                                <?php $i++; endforeach ?>
                            </div>
                            <a class="carousel-control-prev" href="#carousel-controls" role="button"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-controls" role="button"
                                data-bs-slide="next">
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
                                    <source src="{{asset('storage\hukum\bukti_video/'.$vidio_kecurangan['url'])}}"
                                        type=video/ogg> 
                                    <source
                                        src="{{asset('storage\hukum\bukti_video/'.$vidio_kecurangan['url'])}}"
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
            <form action="action/proses_kecurangan/{{ Crypt::encrypt($tps['id']); }}"
                method="post">
                @csrf
                <div class="card-body" style="height: 1000px; overflow: scroll;">
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
                                    <td><input type="checkbox" name="bukti_text[]"
                                            checked="" value="{{ $item['text'] }}"></td>
                                    <td>{{ $item['text'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <thead>
                                <input type="hidden" name="id_relawan">
                                <tr>
                                    <td class="bg-dark text-light"></td>
                                    <th class="bg-dark text-light">
                                         JENIS PELANGGARAN UMUM (+)
                                    </th>
                                </tr>
                                @foreach ($pelanggaran_umum as $item)
                                <tr>
                                    <td><input type="checkbox" disabled name="curang[]"
                                            value=" {{ $item['kecurangan'] }}">
                                    </td>
                                    <td><label>{{ $item['kecurangan'] }} </label></td>
                                </tr>
                                @endforeach
                            </thead>
                            <thead>
                                <input type="hidden" name="id_relawan">
                                <tr>
                                    <td class="bg-dark text-light"></td>
                                    <th class="bg-dark text-light">
                                         JENIS PELANGGARAN PETUGAS (+)
                                    </th>
                                </tr>
                                @foreach ($pelanggaran_petugas as $item)
                                <tr>
                                    <td><input type="checkbox" disabled name="curang[]"
                                            value=" {{ $item['kecurangan'] }}">
                                    </td>
                                    <td><label>{{ $item['kecurangan'] }} </label></td>
                                </tr>
                                @endforeach
                            </thead>
                            <tbody>
                                <tr class="bg-primary text-light">
                                    <td></td>
                                    <td>BAP Admin Hukum</td>
                                </tr>
                                <tr>
                                    <td colspan="2"><textarea name="kecurangan"
                                            placeholder="catatan hukum" disabled class="form-control"
                                            cols="30" rows="10"></textarea></td>
                                </tr>
                                <tr>
                                    <td class="bg-dark text-light"></td>
                                    <th class="bg-dark text-light">
                                        Bukti Kejadian TPS
                                    </th>
                                </tr>
                                @if (count($bukti_foto) > 0)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="bukti[]" value="1"
                                            checked="">
                                    </td>
                                    <td>
                                        <label for="bukti_foto">Bukti Foto</label>
                                    </td>
                                </tr>
                                @else
                                <tr>
                                    <td>
                                        <input disabled type="checkbox" name="bukti[]" value="1">
                                    </td>
                                    <td>
                                        <label for="bukti_foto">Bukti Foto</label>
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td>
                                        <input disabled type="checkbox" name="bukti[]" value="2">
                                    </td>
                                    <td>
                                        <label for="bukti_video">Bukti Video</label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </p>
                </div>
                <div class="card-footer">
                    <?php if ($saksi['status_kecurangan'] == "terverifikasi") : ?>
                  
                    <a href="print/{{ Crypt::encrypt($tps['id']); }}" class="btn mt-2 ml-3 btn-success">Print Kecurangan</a>
                    <?php else :?>
                   
                    <?php endif;?>
                </div>
            </form>
        </div>

    </div>
</div>
