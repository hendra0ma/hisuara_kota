@extends('layouts.main-bantuan')
@section('content')

<div class="row mt-3">
    <div class="col-lg-4">
        <h1 class="page-title fs-1 mt-2">Pusat Bantuan
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pusat Bantuan
                <!-- Kota -->
            </li>
        </ol>
    </div>
</div>

<div class="row mt-5">
    <div class="col-md-12 col-lg-12">
        <div id="accordion">
            <div class="card">
                <div class="card-header" id="heading1">
                    <h5 class="mb-0">
                        <button class="btn btn-primary" data-toggle="collapse" data-target="#collapse1"
                            aria-expanded="true" aria-controls="collapse1">
                            Apa itu Rekapitung
                        </button>
                    </h5>
                </div>

                <div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#accordion">
                    <div class="card-body">
                        Rekapitung adalah sistem rekapitulasi dan perhitungan suara versi kandidat tercanggih untuk
                        pemilu diberbagai tingkatan, mulai dari Pilpres, Pilkada dan Pileg.
                        Rekapitung menggunakan teknik termutahir dalam mengolah dan memproses hasil pemungutan suara
                        secara real time dan berjenjang sehingga menghasilkan akurasi yang sangat tinggi. Ini adalah
                        sebuah sistem yang benar-benar baru dan revolusioner tanpa analog yang sama diseluruh dunia.
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="heading2">
                    <h5 class="mb-0">
                        <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapse2"
                            aria-expanded="false" aria-controls="collapse2">
                            11 Jenis Admin Rekapitung
                        </button>
                    </h5>
                </div>

                <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#accordion">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="listunorder text-white">Saksi adalah seseorang yang ditunjuk dan atau diberi
                                surat mandat
                                secara tertulis dari Peserta Pemilu untuk bertugas mengikuti dan menyaksikan pelaksanaan
                                pemungutan dan penghitungan suara di TPS, serta rekapitulasi perolehan hasil suara di
                                setiap tingkatan (PPS, PPK dan KPU/KIP).</li>
                            <li class="listunorder text-white">Relawan adalah simpatisan pendukung paslon yang dapat
                                mengirimkan C1
                                di berbagai TPS sebagai pelapis dari Saksi. Relawan juga bisa melakukan banding terhadap
                                C1 yang tidak sesuai dengan TPS aslinya.</li>
                            <li class="listunorder text-white">Verifikator bertugas memeriksa hasil suara masuk yang
                                dikirimkan
                                oleh saksi di TPS. Verifikator dapat mengesahkan dan mengkoreksi suara yang masuk serta
                                melaporkan data kecurangan pada bagian hukum Rekapitung.</li>
                            <li class="listunorder text-white">Auditor bertugas untuk memeriksa kembali hasil
                                perhitungan yang
                                dilakukan oleh Verifikator. Auditor dapat membatalkan hasil verifikasi yang di lakukan
                                oleh verifikator jika terjadi perbedaan data (tidak akurat). Verifikator berasal dari
                                PIHAK KETIGA (netral).</li>
                            <li class="listunorder text-white">Rekapitulator bertugas untuk mengkomparasi hasil suara
                                Rekapitung
                                yang telah diperiksa oleh Verifikator dan Auditor untuk dibandingkan dengan hasil suara
                                pleno KPU disemua tingkatan. </li>
                            <li class="listunorder text-white">Admin Checking bertugas untuk memeriksa hasil suara masuk
                                yang
                                dikirim kan oleh saksi di TPS diluar waktu dan jam pemilu yang ditetapkan.</li>
                            <li class="listunorder text-white">Hunter bertugas untuk memeriksa hasil suara masuk yang
                                dikirim kan
                                oleh Relawan di TPS. Hunter dapat mengesahkan dan mengkoreksi suara yang masuk serta
                                melaporkan data kecurangan pada bagian hukum Rekapitung.</li>
                            <li class="listunorder text-white">Admin Hukum merupakan admin internal yang mewakili
                                partai/pengguna
                                sistem Rekapitung. Admin hukum bertugas untuk memeriksa dan memverifikasi seluruh data
                                kecurangan yang masuk untuk dilaporkan kembali pada Tim Hukum Koalisi dalam rangka
                                proses gugatan hukum perselisihan hasil pemilu.</li>
                            <li class="listunorder text-white">Admin Pembayaran Saksi disebut Payroll. Admin ini
                                merupakan petugas
                                administrasi untuk melakukan pembayaran kepada saksi yang telah mengirim hasil suara TPS
                                dan telah di verifikasi oleh Verifikator.</li>
                            <li class="listunorder text-white">Admin Human Verification adalah admin setingkat
                                Administrator yang
                                bertugas untuk Memeriksa, menyetujui dan menolak semua jenis admin di bawahnya, seperti
                                saksi dan semua admin di Rekapitung. Human Verification juga bertanggung jawab atas
                                koreksi hasil perhitungan suara pada TPS yang terjadi kesalahan input.</li>
                            <li class="listunorder text-white">Validator Hukum merupakan Tim Hukum Koalisi yang dibentuk
                                untuk
                                menangani gugatan pemilu. Validator hukum bertugas untuk memeriksa dan memverifikasi
                                seluruh data kecurangan yang masuk dari Admin Hukum untuk dibuatkan dokumentasinya dalam
                                rangka proses gugatan hukum perselisihan hasil pemilu.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="heading3">
                    <h5 class="mb-0">
                        <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapse3"
                            aria-expanded="false" aria-controls="collapse3">
                            Mode Gelap
                        </button>
                    </h5>
                </div>

                <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#accordion">
                    <div class="card-body">
                        Rekapitung memiliki 2 tampilan, yaitu mode terang (default) dan mode gelap. Anda bisa
                        mengaktifkan firur ini pada bar navigasi dashboard tepat dibawah nama kota/kab, sudut kiri atas.
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="heading4">
                    <h5 class="mb-0">
                        <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapse4"
                            aria-expanded="false" aria-controls="collapse4">
                            Verifikasi Admin
                        </button>
                    </h5>
                </div>

                <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordion">
                    <div class="card-body">
                        Verifikasi admin adalah halaman dimana Anda dapat melakukan verifikasi pada saksi dan admin yang
                        mendaftar. Pada bagian ini, Anda dapat menyetujui, menolak dan memblokir pendaftar yang tidak
                        terdaftar pada database saksi dan database admin.
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="heading5">
                    <h5 class="mb-0">
                        <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapse5"
                            aria-expanded="false" aria-controls="collapse5">
                            DPT/TPS
                        </button>
                    </h5>
                </div>

                <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#accordion">
                    <div class="card-body">
                        DPT/TPS adalah papan informasi berisi total daftar pemilih tetap dan total tempat pemungutan
                        suara suatu wilayah kab/kota, kecamatan dan atau kelurahan tergantung dimana papan DPT/TPS itu
                        muncul.
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="heading6">
                    <h5 class="mb-0">
                        <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapse6"
                            aria-expanded="false" aria-controls="collapse6">
                            Kecamatan
                        </button>
                    </h5>
                </div>

                <div id="collapse6" class="collapse" aria-labelledby="heading6" data-parent="#accordion">
                    <div class="card-body">
                        Kecamatan adalah tempat dimana Anda bisa bernavigasi antar kecamatan dalam satu kota/kab. Pada
                        saat Anda berada disebuah kecamatan, Anda bisa bernavigasi ke semua kelurahan dalam kecamatan
                        tersebut.
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="heading7">
                    <h5 class="mb-0">
                        <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapse7"
                            aria-expanded="false" aria-controls="collapse7">
                            Live Count
                        </button>
                    </h5>
                </div>

                <div id="collapse7" class="collapse" aria-labelledby="heading7" data-parent="#accordion">
                    <div class="card-body">

                        <ul class="list-group">
                            <li class="listunorder text-white">Real Count adalah sistem perhitungan suara yang sedang
                                terjadi
                                secara langsung diseluruh TPS yang menjadi wilayah pemilihan.</li>
                            <li class="listunorder text-white">Quick count atau hitung cepat adalah metode verifikasi
                                hasil
                                pemilihan umum yang dilakukan dengan menghitung persentase hasil pemilu di tempat
                                pemungutan suara (TPS) yang dijadikan sampel. Dalam hal ini Rekapitung mengambil sample
                                menggunakan sistem komupter random sebesar 30% dari semua sebaran TPS kelurahan.</li>
                            <li class="listunorder text-white">Map Count adalah mode perhitungan berbasis peta yang
                                menampilkan
                                kemenganan pasangan calon dalam bentuk warna dengan basis demografi per kecamatan.</li>
                        </ul>

                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="heading8">
                    <h5 class="mb-0">
                        <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapse8"
                            aria-expanded="false" aria-controls="collapse8">
                            Over Limit
                        </button>
                    </h5>
                </div>

                <div id="collapse8" class="collapse" aria-labelledby="heading8" data-parent="#accordion">
                    <div class="card-body">
                        Over Limit adalah status dimana hasil suara yang masuk pada server melewati jam pemilu yang
                        telah ditetapkan.
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="heading9">
                    <h5 class="mb-0">
                        <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapse9"
                            aria-expanded="false" aria-controls="collapse9">
                            Pembayaran Saksi
                        </button>
                    </h5>
                </div>

                <div id="collapse9" class="collapse" aria-labelledby="heading9" data-parent="#accordion">
                    <div class="card-body">
                        Pembayaran Saksi adalah admin yang bertugas untuk melakukan pembayaran pada saat suara saksi
                        sudah terverifikasi oleh Verifikator.
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="heading10">
                    <h5 class="mb-0">
                        <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapse10"
                            aria-expanded="false" aria-controls="collapse10">
                            Histori Admin
                        </button>
                    </h5>
                </div>

                <div id="collapse10" class="collapse" aria-labelledby="heading10" data-parent="#accordion">
                    <div class="card-body">
                        Histori Admin adalah tempat untuk melihat seluruh riwayat aktifitas semua admin dalam
                        Rekapitung.
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
