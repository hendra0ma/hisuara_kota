<div style="overflow-y:auto; overflow-x: hidden">
    <div class="row halaman-1">
        <center>
            <div class="row mt-3">
                <div class="col-12">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <img src="{{asset('')}}assets/icons/hisuara_new.png" alt="Avatar" class="hadow-4 mb-3"
                                style="width: 157px;" />
                            <h3 class="fw-bold mb-0">HISUARA</h3>
                            <h3 class="fw-bold mb-0">Selamat Datang!</h3>
                        </div>
                    </div>
                </div>
            </div>
        </center>
        <hr style="border: 1px solid">
        <h5 class="text-center fw-bold text-danger">Prosedur Laporan Kecurangan Pemilu</h5>
        <hr style="border: 1px solid">
        <center>
            <h4 class="text-center fw-bold">ELECTION WITNESS FRAUD TAGGING (EWFT)</h4>
            <h5 class="text-center fw-bold">36 Jenis Pelanggaran Pemilu</h5>
        </center>
        <hr>
        <div class="container">
            <p style="text-align: justify">Laporan Kecurangan Pemilu ini terintegrasi dengan sistem laporan kecurangan pada
                Bawaslu RI.
                Dimana seluruh laporan yang Anda buat dapat dilihat oleh Bawaslu RI Melalui akun Bawaslu pada
                Hisuara.</p>
            <p style="text-align: justify">Setiap saksi yang melaporkan kecurangan juga akan terintegrasi langsung dengan
                sidang
                online
                Mahkamah Konstitusi melalui sistem Hisuara dan Anda dapat saja menjadi salah satu peserta
                dari sidang online Mahkamah Konstitusi tersebut. <b>Berdasarkan peraturan Mahkamah Konstitusi
                    Republik Indonesia No.1 Tahun 2014 tentang pedoman beracara dalam perselisihan hasil
                    pemilihan umum,</b> bukti elektronik yang Anda kirimkan adalah alat bukti yang sah di mata
                hukum.</p>
            <p style="text-align: justify"><b>Berikut prosedur laporan kecurangan Hisuara :</b></p>
            <ol>
                <li>
                    Saksi diwajibkan melakukan dokumentasi kecurangan pada TPS masing-masing jika menemukan
                    bukti kecurangan.
                </li>
                <li>
                    Saksi dapat mengirim foto dan video kecurangan melalui form upload di bawah.
                </li>
                <li>
                    Saksi diwajibkan memberikan keterangan/deskripsi kecurangan yang terjadi pada kolom yang
                    tersedia.
                </li>
                <li>
                    Dengan mengirimkan data kecurangan TPS, nama/identitas saksi akan di rahasiakan, kecuali
                    hanya untuk keperluan hukum dan proses persidangan.
                </li>
            </ol>
        </div>
        <div class="row">
            <button class="btn btn-secondary mt-3 btn-halaman" data-bs-toggle="modal" data-bs-target="#extralargemodal">
                Upload Bukti Kecurangan</button>
        </div>
    </div>

    <div class="row halaman-2" style="display: none">
        <div class="modal-header">
            <h5 class="modal-title">Laporan Kecurangan</h5>
        </div>
        <form action="{{route('action_upload_kecurangan')}}" method="post" enctype="multipart/form-data">
            <div class="modal-body">

                @csrf
                <h4 class="mt-3 header-title">Foto Kecurangan</h4>
                <div class="col-lg-12 col-sm-12 mb-4 mb-lg-0">
                    <div class="dropify-wrapper">
                        <div class="dropify-message"><span class="file-icon">
                                <p>Drag and drop a file here or click</p>
                            </span>
                            <p class="dropify-error">Ooops, something wrong appended.</p>
                        </div>
                        <div class="dropify-loader"></div>
                        <div class="dropify-errors-container">
                            <ul></ul>
                        </div><input type="file" class="dropify" data-bs-height="180" name="foto[]" multiple><button
                            type="button" class="dropify-clear">Remove</button>
                        <div class="dropify-preview"><span class="dropify-render"></span>
                            <div class="dropify-infos">
                                <div class="dropify-infos-inner">
                                    <p class="dropify-filename"><span class="dropify-filename-inner"></span>
                                    </p>
                                    <p class="dropify-infos-message">Drag and drop or click to replace</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p>*Pilih Beberapa Foto</p>
                <h4 class="mt-2 header-title">Video Kecurangan</h4>
                <div class="col-lg-12 col-sm-12 mb-4 mb-lg-0">
                    <div class="dropify-wrapper">
                        <div class="dropify-message"><span class="file-icon">
                                <p>Drag and drop a file here or click</p>
                            </span>
                            <p class="dropify-error">Ooops, something wrong appended.</p>
                        </div>
                        <div class="dropify-loader"></div>
                        <div class="dropify-errors-container">
                            <ul></ul>
                        </div><input type="file" class="dropify" name="video[]" multiple data-bs-height="180"><button
                            type="button" class="dropify-clear">Remove</button>
                        <div class="dropify-preview"><span class="dropify-render"></span>
                            <div class="dropify-infos">
                                <div class="dropify-infos-inner">
                                    <p class="dropify-filename"><span class="dropify-filename-inner"></span>
                                    </p>
                                    <p class="dropify-infos-message">Drag and drop or click to replace</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p>*Pilih 1 Video</p>
                <h4 class="mt-2 header-title">Video Pernyataan</h4>
                <div class="col-lg-12 col-sm-12 mb-4 mb-lg-0">
                    <div class="dropify-wrapper">
                        <div class="dropify-message"><span class="file-icon">
                                <p>Drag and drop a file here or click</p>
                            </span>
                            <p class="dropify-error">Ooops, something wrong appended.</p>
                        </div>
                        <div class="dropify-loader"></div>
                        <div class="dropify-errors-container">
                            <ul></ul>
                        </div><input type="file" class="dropify" name="video_pernyataan" data-bs-height="180"><button
                            type="button" class="dropify-clear">Remove</button>
                        <div class="dropify-preview"><span class="dropify-render"></span>
                            <div class="dropify-infos">
                                <div class="dropify-infos-inner">
                                    <p class="dropify-filename"><span class="dropify-filename-inner"></span>
                                    </p>
                                    <p class="dropify-infos-message">Drag and drop or click to replace</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <b>Panduan Laporan : </b>
                <p>Pilih salah satu kecurangan yang paling relevan, nyata, dan disaksikan sendiri.</p>
                <table class="table mt-5">
                    <thead>
                        <input type="hidden" name="id_relawan">
                        <tr>
                            <td class="bg-dark text-light"></td>
                            <th class="bg-dark text-light">
                                TAMBAHKAN JENIS PELANGGARAN ADMINISTRASI PEMILU (+)
                            </th>
                        </tr>
                        @foreach ($pelanggaran_umum as $item)
                        <tr>
                            <td><input type="checkbox" name="curang[]"
                                    value=" {{ $item['kecurangan'] }}|{{$item['jenis']}}" data-id="{{ $item['id'] }}"
                                    onclick="ajaxGetSolution(this)">
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
                                TAMBAHKAN JENIS PELANGGARAN TINDAK PIDANA (+)
                            </th>
                        </tr>
                        @foreach ($pelanggaran_petugas as $item)
                        <tr>
                            <td><input type="checkbox" name="curang[]"
                                    value=" {{ $item['kecurangan'] }}|{{$item['jenis']}}" data-id="{{ $item['id'] }}"
                                    onclick="ajaxGetSolution(this)">
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
                                TAMBAHKAN JENIS PELANGGARAN KODE ETIK (+)
                            </th>
                        </tr>
                        @foreach ($pelanggaran_etik as $item)
                        <tr>
                            <td><input type="checkbox" name="curang[]"
                                    value=" {{ $item['kecurangan'] }}|{{$item['jenis']}}" data-id="{{ $item['id'] }}"
                                    onclick="ajaxGetSolution(this)">
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
                                TAMBAHKAN JENIS PELANGGARAN APARATUR SIPIL NEGARA (ASN) (+)
                            </th>
                        </tr>
                        @foreach ($pelanggaran_apartur as $item)
                        <tr>
                            <td><input type="checkbox" name="curang[]"
                                    value=" {{ $item['kecurangan'] }}|{{$item['jenis']}}" data-id="{{ $item['id'] }}"
                                    onclick="ajaxGetSolution(this)">
                            </td>
                            <td><label>{{ $item['kecurangan'] }} </label></td>
                        </tr>
                        @endforeach
                    </thead>


                    <tbody>
                        <tr class="bg-primary text-light">
                            <td></td>
                            <td>Rekomendasi Tindakan</td>
                        </tr>
                    </tbody>
                    <tbody id="container-rekomendasi">

                    </tbody>
                    <tr>
                        <th>
                            <label for="LainnyaPetugas">lainnya</label>
                        </th>
                        <td>
                            <textarea class="form-control" name="deskripsi" id="LainnyaPetugas" rows="3"></textarea>
                        </td>
                    </tr>

                    </thead>
                </table>

                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>

    {{-- <div class="modal fade" id="extralargemodal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Laporan Kecurangan</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

            </div>
        </div>
    </div> --}}

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    $('.btn-halaman').on('click', function() {
        $('.halaman-1').hide();
        $('.halaman-2').show()
    })
</script>