<style>
    td:has(input[type=checkbox]) {
        position: relative;
    }

    td>input[type=checkbox] {
        position: absolute;
        top: 14px
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<div style="position: relative" class="card-header bg-danger text-light text-center fw-bold rounded-0 col-12">
    Laporan Kecurangan Pemilu 2024
</div>
<div style="overflow-y:auto; overflow-x: hidden">
    <div class="row halaman-1 px-3">
        <center>
            <div class="row mt-3">
                <div class="col-12">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <img src="{{ asset('') }}assets/icons/hisuara_new.png" alt="Avatar"
                                class="hadow-4 mb-3" style="width: 157px;" />
                        </div>
                    </div>
                </div>
            </div>
        </center>
        <hr style="border: 1px solid">
        <h5 class="text-center fw-bold text-danger">Prosedur Laporan Kecurangan Pemilu 2024</h5>
        <hr style="border: 1px solid">
        <center>
            <h5 class="text-center fw-bold">59 Jenis Pelanggaran Pemilu</h5>
        </center>
        <hr>
        <div class="container">
            <p style="text-align: justify">
                <b>Jenis-jenis pelanggaran pemilu</b>
            <ol>
                <li>
                    <b>
                        Pelanggaran administrasi
                    </b><br>
                    Pelanggaran Administrasi Pemilu adalah pelanggaran yang meliputi tata cara, prosedur, dan mekanisme
                    yang berkaitan
                    dengan administrasi pelaksanaan Pemilu dalam setiap tahapan Penyelenggaraan Pemilu.
                </li>
                <li>
                    <b>
                        Pelanggaran Tindak pidana pemilu
                    </b><br>
                    Tindak Pidana Pemilu adalah tindak pidana pelanggaran dan/atau kejahatan terhadap ketentuan tindak
                    pidana Pemilu
                    sebagaimana diatur dalam Undang-Undang tentang Pemilihan umum dan Undang- Undang tentang Pemilihan
                    Gubernur, Bupati, dan
                    Walikota
                </li>
                <li>
                    <b>
                        Pelanggran kode etik pemilu
                    </b><br>
                    Pelanggaran Kode Etik adalah pelanggaran terhadap etika Penyelenggara Pemilu yang berpedoman pada
                    sumpah dan/atau janji
                    sebelum menjalankan tugas sebagai Penyelenggara Pemilu.
                </li>
                <li>
                    <b>
                        Pelanggran Aparatur Sipil Negara (ASN)
                    </b><br>
                    Pasal 2 UU No 5 Tahun 2014 “Setiap pegawai ASN harus patuh pada asas netralitas dengan tidak
                    berpihak dari segala bentuk
                    pengaruh manapun dan tidak memihak kepada kepentingan tertentu”.
                </li>
            </ol>
            </p>
            <p><b>Berdasarkan peraturan Mahkamah Konstitusi
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
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-secondary btn-halaman w-100" data-bs-toggle="modal"
                        data-bs-target="#extralargemodal">
                        Upload Bukti Kecurangan</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row halaman-2" style="display: none">
        <div class="col-12 mt-3">
            <div class="row">
                <div class="px-0 col-12 text-center mb-3">
                    @if (Auth::user()->profile_photo_path == null)
                        <img class="rounded-circle"
                            style="width: 100px; height: 100px; object-fit: cover; margin-right: 10px;"
                            src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&color=7F9CF5&background=EBF4FF">
                    @else
                        <img class="rounded-circle"
                            style="width: 100px; height: 100px; object-fit: cover; margin-right: 10px;"
                            src="{{ url('/storage/profile-photos/' . Auth::user()->profile_photo_path) }}">
                    @endif
                </div>
                <div class="px-0 col-12 my-auto text-center">
                    <?php
                    $tps = App\Models\Tps::where('tps.id', '=', Auth::user()->tps_id)->first();
                    $kelurahan = App\Models\Village::where('villages.id', '=', Auth::user()->villages)->first();
                    ?>
                    <div class="mb-0 fw-bold" style="font-size: 20px">{{ Auth::user()->name }}</div>
                    <div style="font-size: 15px">NIK : {{ Auth::user()->nik }}</div>
                    @if ($tps == null)
                        <div style="font-size: 15px">SAKSI TPS 1</div>
                    @else
                        <div style="font-size: 15px">SAKSI TPS {{ $tps->number }}</div>
                    @endif
                    @if ($kelurahan == null)
                        <div style="font-size: 15px">KELURAHAN CIPUTAT</div>
                    @else
                        <div style="font-size: 15px">KELURAHAN {{ $kelurahan->name }}</div>
                    @endif
                </div>
            </div>
        </div>
        <form action="{{ route('action_upload_kecurangan') }}" method="post" enctype="multipart/form-data"id="form-kecurangan">
            <div class="modal-body">

                @csrf
                <div class="col-lg-12 text-white p-2" style="background: #6a9cce!important">
                    <h5 class="mb-0 header-title">Foto Kecurangan</h5>
                </div>
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
                {{-- <p>*Pilih Beberapa Foto</p> --}}
                <div class="col-lg-12 text-white p-2 mt-3" style="background: #6a9cce!important">
                    <h5 class="mb-0 header-title">Video Kecurangan</h5>
                </div>
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
                {{-- <p>*Pilih 1 Video</p> --}}
                <div class="col-lg-12 text-white p-2 mt-3" style="background: #6a9cce!important">
                    <h5 class="mb-0 header-title">Video Pernyataan Saksi</h5>
                </div>
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
                        </div><input type="file" class="dropify" name="video_pernyataan"
                            data-bs-height="180"><button type="button" class="dropify-clear">Remove</button>
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
                <div class="mt-3">
                    <b>Panduan Laporan : </b>
                    <p>Centang deskripsi kecurangan yang paling relevan dengan kejadian dan disaksikan sendiri.</p>
                    <div class="col-12 bg-danger mt-3 text-white p-2 text-center fw-bold">
                        TAMBAHKAN JENIS PELANGGARAN
                    </div>
                </div>
                <table class="table mt-2">
                    <thead>
                        <tr>
                            <td class="bg-dark text-light"></td>
                            <th class="bg-dark text-light">
                                PELANGGARAN ADMINISTRASI PEMILU (+)
                            </th>
                        </tr>
                        @foreach ($pelanggaran_umum as $item)
                            <tr>
                                <td><input type="checkbox" name="curang[]"
                                        value=" {{ $item['kecurangan'] }}|{{ $item['jenis'] }}"data-jenis="{{ $item['jenis'] }}"
                                        data-id="{{ $item['id'] }}" onclick="ajaxGetSolution(this)">
                                </td>
                                <td><label>{{ $item['kecurangan'] }} </label></td>
                            </tr>
                        @endforeach
                    </thead>
                    <thead>
                        <tr>
                            <td class="bg-dark text-light"></td>
                            <th class="bg-dark text-light">
                                PELANGGARAN TINDAK PIDANA (+)
                            </th>
                        </tr>
                        @foreach ($pelanggaran_petugas as $item)
                            <tr>
                                <td><input type="checkbox" name="curang[]"
                                        value=" {{ $item['kecurangan'] }}|{{ $item['jenis'] }}"data-jenis="{{ $item['jenis'] }}"
                                        data-id="{{ $item['id'] }}" onclick="ajaxGetSolution(this)">
                                </td>
                                <td><label>{{ $item['kecurangan'] }} </label></td>
                            </tr>
                        @endforeach
                    </thead>
                    <thead>
                        <tr>
                            <td class="bg-dark text-light"></td>
                            <th class="bg-dark text-light">
                                PELANGGARAN KODE ETIK (+)
                            </th>
                        </tr>
                        @foreach ($pelanggaran_etik as $item)
                            <tr>
                                <td><input type="checkbox" name="curang[]"
                                        value=" {{ $item['kecurangan'] }}|{{ $item['jenis'] }}"data-jenis="{{ $item['jenis'] }}"
                                        data-id="{{ $item['id'] }}" onclick="ajaxGetSolution(this)">
                                </td>
                                <td><label>{{ $item['kecurangan'] }} </label></td>
                            </tr>
                        @endforeach
                    </thead>
                    <thead>
                        <tr>
                            <td class="bg-dark text-light"></td>
                            <th class="bg-dark text-light">
                                PELANGGARAN APARATUR SIPIL NEGARA (ASN) (+)
                            </th>
                        </tr>
                        @foreach ($pelanggaran_apartur as $item)
                            <tr>
                                <td><input type="checkbox" name="curang[]"
                                        value=" {{ $item['kecurangan'] }}|{{ $item['jenis'] }}"data-jenis="{{ $item['jenis'] }}"
                                        data-id="{{ $item['id'] }}" onclick="ajaxGetSolution(this)">
                                </td>
                                <td><label>{{ $item['kecurangan'] }} </label></td>
                            </tr>
                        @endforeach
                    </thead>
                    <tr>
                        <th>
                            <label for="LainnyaPetugas">Deskripsi Kecurangan</label>
                        </th>
                        <td>
                            <textarea class="form-control" name="deskripsi" id="LainnyaPetugas" rows="3"></textarea>
                        </td>
                    </tr>

                    <tbody>
                        <tr class="bg-success text-light">
                            <td></td>
                            <td>Rekomendasi Tindakan</td>
                        </tr>
                    </tbody>
                    <tbody id="container-rekomendasi">

                    </tbody>

                    <tr>
                        <td colspan="2" class="fw-bold">Tambahkan Pesan Suara</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button class="btn btn-info text-white"id="startRecording" type="button">
                            <i class="fa-solid fa-microphone"></i> Rekam
                            </button>
                      
                            <button class="btn btn-dark text-white" id="stopRecording" type="button" disabled>
                            <i class="fa-solid fa-microphone"></i> Berhenti Merekam
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <audio controls id="audioPlayer" style="display:none;"></audio>
                            <input type="file" accept="audio/*" name="audioFile" id="audioFile"
                                style="display:none;">
                        </td>
                    </tr>

                    </thead>
                </table>

                <button type="button" class="btn btn-secondary"id="simpan">Simpan</button>
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
<script src="https://cdn.rawgit.com/mattdiamond/Recorderjs/08e7abd9/dist/recorder.js"></script>

<script>
    $('.btn-halaman').on('click', function() {
        $('.halaman-1').hide();
        $('.halaman-2').show()
    })
    $('button#simpan').on('click',function(){
        let form = $('form#form-kecurangan')
         // Asumsi ada input field dengan nama "audioFile" di dalam form
    let audioFileInput = form.find('input[name="audioFile"]')[0];

    if (audioFileInput.files.length > 0) {
        // Ada file audio terlampir, lanjutkan dengan tindakan yang diinginkan
        // Misalnya, Anda dapat mengirimkan formulir dengan menggunakan form.submit();
        form.submit()
      
    } else {
       alert('Mohon mengisi deskripsi kecurangan menggunakan opsi tombol rekam atau menyampaikan deskripsi kecurangan melalui formulir kecurangan yang tersedia');
    }
    })


    $(document).ready(function() {

        var audioContext;
        var recorder;

        navigator.mediaDevices.getUserMedia({
                audio: true
            })
            .then(function(stream) {
                audioContext = new(window.AudioContext || window.webkitAudioContext)();
                var input = audioContext.createMediaStreamSource(stream);
                recorder = new Recorder(input);
            })
            .catch(function(err) {
                console.error('Error accessing microphone:', err);
            });

        $('#startRecording').click(function() {
            recorder && recorder.record();
            $('#startRecording').prop('disabled', true);
            $('#stopRecording').prop('disabled', false);
        });

        $('#stopRecording').click(function() {
            recorder && recorder.stop();
            $('#startRecording').prop('disabled', false);
            $('#stopRecording').prop('disabled', true);

            recorder.exportWAV(function(blob) {
                var audioURL = URL.createObjectURL(blob);
                $('#audioPlayer').attr('src', audioURL);
                $('#audioPlayer').css('display', 'block');

                var formData = new FormData();
                formData.append('audioFile', blob, 'recordedAudio.wav');
                let fileInput = document.getElementById('audioFile');
                fileInput.files = [new File([blob], 'recordedAudio.wav')];

            });
        });

    });
</script>
