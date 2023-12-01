<div class="row mx-0">

    <div class="col-12 px-5" style="overflow: scroll">
        <div class="card mb-2">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="row justify-content-center">
                            @if ($saksi['kecurangan'] == 'yes' && $qrcode != null)
                                <?php $scan_url = url('') . '/scanning-secure/' . (string) Crypt::encrypt($qrcode->nomor_berkas); ?>
                                <div class="col-auto my-auto">
                                    {!! QrCode::size(100)->generate($scan_url) !!}
                                </div>
                            @else
                            @endif
                            <div class="col mt-2">
                                <div class="media">
                                    @if ($user['profile_photo_path'] == null)
                                        <img class="rounded-circle"
                                            style="width: 100px; height: 100px; object-fit: cover; margin-right: 10px;"
                                            src="https://ui-avatars.com/api/?name={{ $user['name'] }}&color=7F9CF5&background=EBF4FF">
                                    @else
                                        <img class="rounded-circle"
                                            style="width: 100px; height: 100px; object-fit: cover; margin-right: 10px;"
                                            src="{{ url('/storage/profile-photos/' . $user['profile_photo_path']) }}">
                                    @endif

                                    <div class="media-body my-auto">
                                        <h5 class="mb-0">{{ $user['name'] }}</h5>
                                        NIK : {{ $user['nik'] }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-auto pt-2 my-auto px-1">
                                <a href="https://wa.me/{{ $user->no_hp }}" class="btn btn-success text-white"><i
                                        class="fa-solid fa-phone"></i>
                                    Hubungi</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-auto px-5">
                        <img src="{{ asset('') }}images/logo/timbangan.png" style="height: 110px" alt="">
                    </div>
                    <div class="col-lg d-flex">
                        <div class="alert alert-danger my-auto" role="alert">
                            <div class="row my-auto">
                                <div class="col-auto">
                                    <i class="fa-solid fa-circle-exclamation" style="font-size: 50px"></i>
                                </div>
                                <div class="col">
                                    Verifikasi dan Validasi Kecurangan hanya bisa dilakukan oleh admin yang memiliki
                                    wawasan hukum atau sekurang
                                    kurangnya berpendidikan sarjana hukum.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6" style="border-right: 0.5px#eee solid;">

        <div class="row">
            <div class="col-12 bg-danger text-white py-3 text-center mb-3">
                <h4 class="fw-bold mb-0">
                    Verifikasi
                </h4>
            </div>
            <div style="height: 800px; overflow: scroll;">

                <div class="col-12 py-0">
                    <div class="card">
                        <div class="card-header" style="border: 1px #eee solid !important; background-color: #eee">
                            <h3 class="mb-0 card-title">1. Daftar Laporan Kecurangan</h3>
                        </div>
                        <div class="card-body" style="border: 1px #eee solid !important">
                            <ul class="list-group">
                                @foreach ($list_kecurangan as $item)
                                    <li class="list-group-item">{{ $item->text }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 py-0">
                    <div class="card">
                        <div class="card-header" style="border: 1px #eee solid !important; background-color: #eee">
                            <h3 class="mb-0 card-title">2. Rekomendasi Tindakan</h3>
                        </div>
                        <div class="card-body" style="border: 1px #eee solid !important">
                            <ul class="list-group" id="appendDataSolution">

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 py-0">
                    <div class="card">
                        <div class="card-header" style="border: 1px #eee solid !important; background-color: #eee">
                            <h3 class="mb-0 card-title">3. Pelapor dan Pemeriksa</h3>
                        </div>
                        <div class="card-body" style="border: 1px #eee solid !important">
                            <table class="table table-bordered">
                                <tr>
                                    <td class="fw-bold">
                                        <div>A. Pengirim Kecurangan</div>
                                    </td>
                                    <td class="fw-bold">
                                        <div>B. Petugas Verifikator</div>
                                    </td>
                                    <td class="fw-bold">
                                        <div>Tanggal Dokumen</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td> {{ $user->name }}</td>
                                    <td> {{ Auth::user()->name }}</td>
                                    <td rowspan="2" class="align-middle"> {{ $kecurangan->created_at }}</td>
                                </tr>
                                <tr>
                                    <td> {{ $user->no_hp }}</td>
                                    <td> {{ Auth::user()->no_hp }}</td>

                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="border: 1px #eee solid !important; background: #eee">
                            <h3 class="mb-0 card-title">4. Barang Bukti</h3>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-body p-0" style="border: 1px #eee solid !important">
                                <table class="table table-bordered mb-0">
                                    <tr>
                                        <td class="fw-bold">Foto</td>
                                        <td class="fw-bold">Metadata</td>
                                    </tr>
                                    @foreach ($bukti_foto as $bf)
                                        <tr>
                                            <td class="text-center" style="width: 50%">
                                                <img class="image" style="height: 350px; object-fit: cover"
                                                    src="{{ asset('storage/' . $bf->url) }}"
                                                    data-url="{{ asset('storage/' . $bf->url) }}" alt="">
                                            </td>
                                            <td class="exifResultsPhoto" style="width: 50%">

                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                <script>
                                    $(document).ready(function() {
                                        setTimeout(() => {
                                            $(".image").each(function(index) {

                                                var currentImage = this;
                                                EXIF.getData(currentImage, function() {
                                                    var exifData = EXIF.getAllTags(this);
                                                    var locationInfo = "Image " + (index + 1) + " EXIF Data:<br>";

                                                    if (exifData && (exifData.DateTimeOriginal || (exifData
                                                            .GPSLatitude && exifData.GPSLongitude))) {
                                                        if (exifData.DateTimeOriginal) {
                                                            locationInfo += "Date taken: " + exifData.DateTimeOriginal +
                                                                "<br>";
                                                        }
                                                        if (exifData.GPSLatitude && exifData.GPSLongitude) {
                                                            var latitude = exifData.GPSLatitude[0] + exifData
                                                                .GPSLatitude[1] / 60 + exifData.GPSLatitude[2] / 3600;
                                                            var longitude = exifData.GPSLongitude[0] + exifData
                                                                .GPSLongitude[1] / 60 + exifData.GPSLongitude[2] / 3600;
                                                            locationInfo += "Location: Latitude " + latitude +
                                                                ", Longitude " + longitude + "<br>";
                                                        }
                                                        if (exifData.Make) {
                                                            locationInfo += "Camera Make: " + exifData.Make + "<br>";
                                                        }
                                                        if (exifData.Model) {
                                                            locationInfo += "Camera Model: " + exifData.Model + "<br>";
                                                        }
                                                        if (exifData.ApertureValue) {
                                                            locationInfo += "Aperture: f/" + exifData.ApertureValue +
                                                                "<br>";
                                                        }
                                                        if (exifData.ExposureTime) {
                                                            locationInfo += "Exposure Time: " + exifData.ExposureTime +
                                                                " sec<br>";
                                                        }
                                                        if (exifData.ISO) {
                                                            locationInfo += "ISO: " + exifData.ISO + "<br>";
                                                        }
                                                        if (exifData.FocalLength) {
                                                            locationInfo += "Focal Length: " + exifData.FocalLength +
                                                                "mm<br>";
                                                        }
                                                        if (exifData.Flash) {
                                                            locationInfo += "Flash: " + exifData.Flash + "<br>";
                                                        }
                                                        if (exifData.ImageWidth && exifData.ImageHeight) {
                                                            locationInfo += "Image Resolution: " + exifData.ImageWidth +
                                                                "x" + exifData.ImageHeight + "<br>";
                                                        }
                                                        // Include more EXIF tags as needed
                                                    } else {
                                                        locationInfo += "EXIF data not found";
                                                    }

                                                    // Display the information in the console to ensure it's being correctly constructed
                                                    console.log(locationInfo);

                                                    // Find the corresponding .exifResults element related to the current image and update its content
                                                    $(currentImage).closest('tr').find('.exifResultsPhoto').html(
                                                        locationInfo);
                                                });
                                            });
                                        }, 100)
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3 px-0">
                        <div class="card">
                            <div class="card-body p-0" style="border: 1px #eee solid !important">
                                <table class="table table-bordered">
                                    <tr>
                                        <td class="fw-bold">Video</td>
                                        <td class="fw-bold">Metadata</td>
                                    </tr>
                                    @foreach ($bukti_vidio as $bv)
                                        <tr>
                                            <td class="text-center" style="width: 50%">
                                                <video width="100%" controls>
                                                    <source src="{{ asset('') }}storage/{{ $bv->url }}"
                                                        type="video/mp4">
                                                    <source src="{{ asset('') }}storage/{{ $bv->url }}"
                                                        type="video/ogg">
                                                </video>
                                            </td>
                                            <td class="exifResults" style="width: 50%">

                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                <script></script>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 px-0">
                        <div class="card">
                            <div class="card-header"
                                style="border: 1px #eee solid !important; background-color: #eee">
                                <h3 class="card-title">5. Video Pernyataan Saksi (Bahwa ada kecurangan)</h3>
                            </div>
                            <div class="card-body" style="border: 1px #eee solid !important">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 px-0">

                        <div class="card">
                            <div class="card-header"
                                style="border: 1px #eee solid !important; background-color: #eee">
                                <h3 class="card-title">6. Surat Pernyataan</h3>
                            </div>
                            <div class="card-body" style="border: 1px #eee solid !important">
                                <div class="page-content-wrapper" style="width:100%;height:100%;">
                                    <div class="row mt-2">

                                        <div class="container">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <h3 class="text-center"><u>SURAT PERNYATAAN</u></h3>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-lg-12">

                                                    </div>
                                                </div>
                                                <div class="row mt-1">
                                                    <div class="col-lg-12">
                                                        <div class="col-lg-6">
                                                            <h6>Yang bertanda tangan dibawah ini :</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-md">
                                                        <div class="row mt-2">
                                                            <div class="col-12">
                                                                <b>Detail Akun <i class="fa fa-info-circle"></i></b>
                                                            </div>

                                                            <hr class="mt-1 ms-3"
                                                                style="margin-bottom: 0px; background: #000; height: 2px; width: 300px">

                                                            <div class="col-12">
                                                                <table class="table table-stripped">
                                                                    <tr>
                                                                        <td class="ps-0 pe-2" style="width: 200px">NIK
                                                                        </td>
                                                                        <td class="px-0">:</td>
                                                                        <td class="ps-2">{{ $user->nik }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="ps-0 pe-2" style="width: 200px">
                                                                            Nama
                                                                        </td>
                                                                        <td class="px-0">:</td>
                                                                        <td class="ps-2">{{ $user->name }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="ps-0 pe-2" style="width: 200px">
                                                                            Alamat</td>
                                                                        <td class="px-0">:</td>
                                                                        <td class="ps-2">{{ $user->address }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="ps-0 pe-2" style="width: 200px">No
                                                                            Hp
                                                                        </td>
                                                                        <td class="px-0">:</td>
                                                                        <td class="ps-2">{{ $user->no_hp }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="ps-0 pe-2" style="width: 200px">
                                                                            Email
                                                                        </td>
                                                                        <td class="px-0">:</td>
                                                                        <td class="ps-2">{{ $user->email }}</td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @if ($kecurangan->tps_id != null)
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <b>Lokasi <i class="fa fa-info-circle"></i></b>
                                                                </div>

                                                                <hr class="mt-1 ms-3"
                                                                    style="margin-bottom: 0px; background: #000; height: 2px; width: 300px">

                                                                <div class="col-12">
                                                                    <table class="table">
                                                                        <tr>
                                                                            <td class="ps-0 pe-2"
                                                                                style="width: 200px">
                                                                                Kecamatan</td>
                                                                            <td class="px-0">:</td>
                                                                            <td class="ps-0">{{ $district->name }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="ps-0 pe-2"
                                                                                style="width: 200px">
                                                                                Kelurahan</td>
                                                                            <td class="px-0">:</td>
                                                                            <td class="ps-0">{{ $village->name }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="ps-0 pe-2"
                                                                                style="width: 200px">TPS
                                                                            </td>
                                                                            <td class="px-0">:</td>
                                                                            <td class="ps-0">{{ $tps->number }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="ps-0 pe-2"
                                                                                style="width: 200px">Kota
                                                                            </td>
                                                                            <td class="px-0">:</td>
                                                                            <td class="ps-0">{{ $kota->name }}
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 text-justify" style="line-height:1.8">
                                                        {{ $surat_pernyataan->deskripsi }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row mt-5">
                                                    <div class="col-lg-12">
                                                        <b>Tanggal Kirim </b>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 text-left">
                                                        <p>Yang Membuat Pernyataan Ini:</p>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-lg-12 text-left">
                                                        <p class="mt-5"><u> {{ $user->name }}</u></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <p class="mb-3 text-center mt-2">
                                            <i>Laporan Ini Dicetak Oleh Komputer Dan Tidak Memerlukan Tanda Tangan.
                                                Berkas Terlampir</i>
                                        </p> --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    @if ($kecurangan->tps_id != null)
                        <div class="col-12 px-0">
                            <div class="card">
                                <div class="card-header"
                                    style="border: 1px #eee solid !important; background-color: #eee">
                                    <h3 class="card-title">7. Data C1</h3>
                                </div>
                                <div class="card-body" style="border: 1px #eee solid !important">
                                    <img alt="" class="d-block w-100"
                                        src="{{ url('') }}/storage/{{ $saksi->c1_images }}"
                                        data-bs-holder-rendered="true">
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header" style="background-color: #eee">
                                    <h4 class="mb-0 text-black card-title">Data Pemilih dan Hak Pilih (TPS
                                        {{ $tps['number'] }} / Kelurahan
                                        {{ $village['name'] }})</h4>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-striped">
                                        <tr>
                                            <td class="py-2 text-start" style="width: 50%">Jumlah Hak Pilih (DPT)</td>
                                            <td class="py-2" style="width: 5%">:</td>
                                            <td class="py-2" style="width: 40%">
                                                {{ $surat_suara != null ? $surat_suara->dpt : '0' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 text-start" style="width: 50%">Surat Suara Sah</td>
                                            <td class="py-2" style="width: 5%">:</td>
                                            <td class="py-2" style="width: 40%">
                                                {{ $surat_suara != null ? $surat_suara->surat_suara_sah : '0' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 text-start" style="width: 50%">Suara Tidak Sah</td>
                                            <td class="py-2" style="width: 5%">:</td>
                                            <td class="py-2" style="width: 40%">
                                                {{ $surat_suara != null ? $surat_suara->surat_suara_tidak_sah : '0' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 text-start" style="width: 50%">Jumlah Suara Sah dan Suara
                                                Tidak Sah</td>
                                            <td class="py-2" style="width: 5%">:</td>
                                            <td class="py-2" style="width: 40%">
                                                {{ $surat_suara != null ? $surat_suara->jumlah_sah_dan_tidak : '0' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 text-start" style="width: 50%">Total Surat Suara</td>
                                            <td class="py-2" style="width: 5%">:</td>
                                            <td class="py-2" style="width: 40%">
                                                {{ $surat_suara != null ? $surat_suara->total_surat_suara : '0' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 text-start" style="width: 50%">Sisa Surat Suara</td>
                                            <td class="py-2" style="width: 5%">:</td>
                                            <td class="py-2" style="width: 40%">
                                                {{ $surat_suara != null ? $surat_suara->sisa_surat_suara : '0' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-12 mt-3">
                    <hr>
                    <div class="row">
                        <div class="col"> <strong>Admin Mengirim Data Kecurangan:</strong> <br>29 nov 2019 </div>
                        <div class="col"> <strong>Status:</strong> <br> Selesai </div>
                    </div>
                    <div class="track">
                        @if ($saksi['status_kecurangan'] == 'belum terverifikasi')
                            <div class="step active secondary"> <span class="icon"> <i class="fa fa-user"></i>
                                </span> <span class="text">Admin Mengirim Kecurangan</span> </div>
                            <div class="step secondary"> <span class="icon"> <i class="fa fa-send"></i> </span>
                                <span class="text">Terverifikasi/Selesai</span>
                            </div>
                        @elseif($saksi['status_kecurangan'] == 'terverifikasi')
                            <div class="step active secondary"> <span class="icon"> <i class="fa fa-user"></i>
                                </span> <span class="text">Admin Mengirim Kecurangan</span> </div>
                            <div class="step active secondary"> <span class="icon"> <i class="fa fa-send"></i>
                                </span> <span class="text">Terverifikasi/Selesai</span> </div>
                        @elseif($saksi['status_kecurangan'] == 'ditolak')
                            <div class="step active danger"> <span class="icon"> <i class="fa fa-user"></i> </span>
                                <span class="text">Admin
                                    Mengirim Kecurangan</span>
                            </div>
                            <div class="step active danger"> <span class="icon"> <i class="fa fa-send"></i> </span>
                                <span class="text">Ditolak</span>
                            </div>
                        @endif
                    </div>
                    <hr>
                </div>

            </div>
        </div>

    </div>
    <div class="col-6" style="border-left: 0.5px #eee solid;">
        <div class="row">
            <div class="col-12 bg-dark text-white py-3 text-center mb-3">
                <h4 class="fw-bold mb-0">
                    Validasi
                </h4>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h4 class="card-title mx-auto text-white">PANDUAN VALIDASI</h4>
                    </div>
                    @if ($kecurangan->tps_id != null)
                        <form action="action/proses_kecurangan/{{ Crypt::encrypt($tps['id']) }}" method="post">
                        @else
                            <form action="#" method="post">
                    @endif
                    @csrf
                    <div class="card-body" style="height: 800px; overflow: scroll;">
                        <p class="card-text">
                        <div class="row">
                            <div class="col-12">
                                @if ($kecurangan->tps_id != null)
                                 
                                <h6> {{ $kecamatan['name'] }} - TPS {{ $tps['number'] }} </h6>
                                    @else
                                <h6> </h6>
                                  
                                @endif
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
                            <thead class="bg-dark text-light">
                                <tr>
                                    <th class="text-white">Cek</th>
                                    <th class="text-white">Deskripsi Kecurangan Saksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_kecurangan as $item)
                                    <tr>
                                        <td><input type="checkbox" name="bukti_text[]" checked=""
                                                value="{{ $item['text'] }}"
                                                data-id="{{ $item['list_kecurangan_id'] }}"
                                                onclick="ajaxGetSolution(this)"></td>
                                        <td>{{ $item['text'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <thead>
                                <input type="hidden" name="id_relawan">
                                <tr>
                                    <td class="bg-dark text-light"></td>
                                    <th class="bg-dark text-light">
                                        PELANGGARAN ADMINISTRASI PEMILU (+)
                                    </th>
                                </tr>
                                @foreach ($pelanggaran_umum as $item)
                                    <tr>
                                        <td><input type="checkbox" name="curang[]"
                                                value=" {{ $item['kecurangan'] }}" data-id="{{ $item['id'] }}"
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
                                        PELANGGARAN TINDAK PIDANA (+)
                                    </th>
                                </tr>
                                @foreach ($pelanggaran_petugas as $item)
                                    <tr>
                                        <td><input type="checkbox" name="curang[]"
                                                value=" {{ $item['kecurangan'] }}" data-id="{{ $item['id'] }}"
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
                                        PELANGGARAN KODE ETIK (+)
                                    </th>
                                </tr>
                                @foreach ($pelanggaran_etik as $item)
                                    <tr>
                                        <td><input type="checkbox" name="curang[]"
                                                value=" {{ $item['kecurangan'] }}" data-id="{{ $item['id'] }}"
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
                                        PELANGGARAN APARATUR SIPIL NEGARA (ASN) (+)
                                    </th>
                                </tr>
                                @foreach ($pelanggaran_aparatur as $item)
                                    <tr>
                                        <td><input type="checkbox" name="curang[]"
                                                value=" {{ $item['kecurangan'] }}" data-id="{{ $item['id'] }}"
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


                            <tbody>
                                <tr class="bg-primary text-light">
                                    <td></td>
                                    <td>BAP Admin Hukum</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <textarea name="kecurangan" placeholder="catatan hukum" class="form-control" cols="30" rows="10"></textarea>
                                    </td>
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
                                            <input type="checkbox" name="bukti[]" value="1" checked="">
                                        </td>
                                        <td>
                                            <label for="bukti_foto">Bukti Foto</label>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="bukti[]" value="1">
                                        </td>
                                        <td>
                                            <label for="bukti_foto">Bukti Foto</label>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td>
                                        <input type="checkbox" checked name="bukti[]" value="2">
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
                        <?php if ($saksi['status_kecurangan'] == "diproses") : ?>
                        <a href="action_verifikasi_kecurangan/{{ Crypt::encrypt($tps['id']) }}"
                            class="btn mt-2 ml-3 btn-success">Validasi Kecurangan</a>
                        {{-- <a href="print/{{ Crypt::encrypt($tps['id']); }}"
                                class="btn mt-2 ml-3 btn-success">Print
                                Kecurangan</a> --}}
                        <?php else : ?>
                        <button type="submit" class="btn btn-success">Validasi Kecurangan</button>
                        <a href="action_tolak_kecurangan/{{ Crypt::encrypt($tps['id']) }}"
                            class="btn btn-danger">Tolak
                            Kecurangan</a>
                        <?php endif; ?>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
</div>

<script>
    setTimeout(function() {
        let uniqueData = [
            @foreach ($list_kecurangan as $item)
                '{{ $item->solution }} | {{ $item->kode }}',
            @endforeach
        ];

        uniqueArray = uniqueData.filter(function(item, pos) {
            return uniqueData.indexOf(item) == pos;
        });

        uniqueArray.forEach(function(item, index) {
            $('#appendDataSolution').append(`
                    <li class="list-group-item">
                        ${item}
                    </li>
                `)
        });
    }, 200)
</script>
<script>
    let ajaxGetSolution = function(ini) {
        let id_list = $(ini).data('id')

        if (ini.checked == true) {
            $.ajax({
                url: "{{ url('') }}/hukum/getsolution",
                data: {
                    id_list
                },
                type: 'get',
                success: function(res) {
                    $('tbody#container-rekomendasi').append(`
                        <tr id="solution${id_list}">
                            <td>
                            </td>
                            <td>
                                ${res.solution}
                            </td>
                        </tr>
                    `)
                }
            });
        } else {
            $(`#solution${id_list}`).remove();
        }
    }
</script>
<script>
    setTimeout(function() {
        let uniqueData = [
            @foreach ($list_kecurangan as $item)
                '{{ $item->solution }}',
            @endforeach
        ];
        let uniqueDataId = [
            @foreach ($list_kecurangan as $item)
                '{{ $item->id_list }}',
            @endforeach
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
            $('#container-rekomendasi').append(`
            <tr id="solution${item[0]}">
                <td>
                </td>
                <td>
                    ${item[1]}
                </td>
            </tr>
            `)
        });
    }, 300)
</script>
