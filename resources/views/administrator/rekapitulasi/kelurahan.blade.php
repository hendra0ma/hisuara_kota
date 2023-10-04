@extends('layouts.mainlayoutVerificator');
@section('content')

<!-- PAGE-HEADER -->
<div class="row">
    <div class="col-lg-4">
        <h1 class="page-title fs-1 mt-2">Dashboard Rekapitung
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard
                <!-- Kota -->
            </li>
        </ol>
    </div>
    <div class="col-lg-8 justify-content-end mt-2">
        <div class="row">
            <div class="col"></div>
            <div class="col-lg-9 justify-content-end">
                <div class="card" style="margin-bottom: 0px;">
                    <div class="card-body">
                        <div class="row mx-auto">
                            <div class="col-5 ">
                                <div class="counter-icon box-shadow-secondary brround candidate-name text-white bg-danger" style="margin-bottom: 0;">
                                    1
                                </div>
                            </div>
                            <div class="col me-auto">
                                <h6 class="">Suara Tertinggi</h6>
                                <h3 class="mb-2 number-font">Benyamin Davnie /
                                    Pilar Saga ichsan</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PAGE-HEADER END -->
<div class="row mt-3">
    <div class="col-lg-6 col-md-12">
        <div class="card">
            <div class="card-header bg-info-gradient">
                <h3 class="card-title text-white">Suara TPS Masuk</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md">
                        <div class="container" style="margin-left: 3%; margin-top: 10%;">
                            <div class="text-center">Progress {{substr($realcount,0,5)}}% dari 100%</div>
                            <div id="chart-pie" class="chartsh h-100 w-100"></div>
                        </div>
                    </div>
                    <div class="col-md">
                        <?php $i = 1; ?>
                        @foreach ($paslon as $pas)
                        <div class="row mt-2">
                            <div class="col-lg col-md col-sm col-xl mb-3">
                                <div class="card" style="margin-bottom: 0px;">
                                    <div class="card-body">
                                        <div class="row me-auto">
                                            <div class="col-4">
                                                <div class="counter-icon box-shadow-secondary brround candidate-name text-white " style="margin-bottom: 0; background-color: {{$pas->color}};">
                                                    {{$i++}}
                                                </div>
                                            </div>
                                            <div class="col me-auto">
                                                <h6 class="">{{$pas->candidate}} </h6>
                                                <h6 class="">{{$pas->deputy_candidate}} </h6>
                                                <?php
                                                $voice = 0;
                                                ?>
                                                @foreach ($pas->saksi_data as $dataTps)
                                                <?php
                                                $voice += $dataTps->voice;
                                                ?>
                                                @endforeach
                                                <h3 class="mb-2 number-font">{{ $voice }} suara</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-12">
        <div class="card">
            <div class="card-header bg-secondary-gradient">
                <h3 class="card-title text-white">Suara Terverifikasi</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md">
                        <div class="container" style="margin-left: 3%; margin-top: 10%;">
                            <div class="text-center">Terverifikasi 6 TPS dari 1 TPS Masuk</div>
                            <div id="chart-donut" class="chartsh h-100 w-100"></div>
                        </div>
                    </div>
                    <div class="col-md">
                        <?php $i = 1; ?>
                        @foreach ($paslon_terverifikasi as $pas)
                        <div class="row mt-2">
                            <div class="col-lg col-md col-sm col-xl mb-3">
                                <div class="card" style="margin-bottom: 0px;">
                                    <div class="card-body">
                                        <div class="row me-auto">
                                            <div class="col-4">
                                                <div class="counter-icon box-shadow-secondary brround candidate-name text-white ms-auto" style="margin-bottom: 0; background-color: {{$pas->color}};">
                                                    {{$i++}}
                                                </div>
                                            </div>
                                            <div class="col me-auto">
                                                <h6 class="">{{$pas->candidate}} </h6>
                                                <h6 class="">{{$pas->deputy_candidate}} </h6>
                                                <?php
                                                $voice = 0;
                                                ?>
                                                @foreach ($pas->saksi_data as $dataTps)
                                                <?php
                                                $voice += $dataTps->voice;
                                                ?>
                                                @endforeach
                                                <h3 class="mb-2 number-font">{{ $voice }} suara</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg justify-content-end">
        <div class="card">
            <div class="card-header bg-secondary">
                <div class="card-title text-white">Total TPS</div>
            </div>
            <div class="card-body">
                <p class="">454</p>
            </div>
        </div>
    </div>
    <div class="col-lg">
        <div class="card">
            <div class="card-header bg-danger">
                <div class="card-title text-white">TPS Masuk</div>
            </div>
            <div class="card-body">
                <p class="">478</p>
            </div>
        </div>
    </div>
    <div class="col-lg">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="card-title text-white">TPS Kosong</div>
            </div>
            <div class="card-body">
                <p class="">-24</p>
            </div>
        </div>
    </div>
    <div class="col-lg">
        <div class="card">
            <div class="card-header bg-cyan">
                <div class="card-title text-white">Suara Masuk</div>
            </div>
            <div class="card-body">
                <p class="">86905</p>
            </div>
        </div>
    </div>
    <div class="col-lg">
        <div class="card">
            <div class="card-header bg-success">
                <div class="card-title text-white">Suara Terverifikasi</div>
            </div>
            <div class="card-body">
                <p class="">0</p>
            </div>
        </div>
    </div>
</div>

<div class="tab">
    <div class="row">
        <div class="col-md">
            <button class="btn tablink w-100 rounded-0 c1saksi" onclick="openPage('C1-Saksi', this, '#fb6b25', 'white')" id="defaultOpen">C1 Saksi</button>
        </div>
        <div class="col-md">
            <button class="btn tablink w-100 rounded-0 c1relawan" onclick="openPage('C1-Relawan', this, '#f82649')">C1 Relawan</button>
        </div>
        <div class="col-md">
            <button class="btn tablink w-100 rounded-0 c1saksipend" onclick="openPage('C1-Saksi-Pending', this, '#6259ca ')">C1
                Saksi (Pending)</button>
        </div>
        <div class="col-md">
            <button class="btn tablink w-100 rounded-0 c1relawanband" onclick="openPage('C1-Relawan-Banding', this, '#007ea7')">C1 Relawan
                (Banding)</button>
        </div>
        <div class="col-md">
            <button class="btn tablink w-100 rounded-0" onclick="openPage('Kecurangan', this, '#09ad95')">Kecurangan</button>
        </div>
    </div>
</div>

<div id="C1-Saksi" class="tabcontent">
    <div class="row">
        @foreach($list_suara as $ls)
        <div class="col-md-6 col-xl-4">
            <div class="card item-card" style="height: 450px">
                <div class="product-grid6 card-body">
                    <div class="product-image6">
                        @if ($ls->profile_photo_path == NULL)
                        <img class="img-fluid" style="width: 250px;" src="https://ui-avatars.com/api/?name={{ $ls->name }}&color=7F9CF5&background=EBF4FF" alt="img">
                        @else
                        <img class="rounded-circle" style="width: 250px;" src="{{url("/storage/profile-photos/".$ls->profile_photo_path) }}">
                        @endif

                    </div>
                    <div class="product-content text-center">
                        <h4 class="fw-bold">Kecamatan {{$district->name}}</h4>
                        <h4 class="mb-3 fw-bold"><a href="#">TPS {{$ls->number}}</a></h4>
                        <h4 class="price">Data C1 Masuk</h4>
                    </div>
                    <ul class="icons z-index3" style="background: rgb(0,0,0); background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.65) 15%, rgba(0,0,0,0.75) 25%, rgba(0,0,0,1) 100%);
                        height: 110%; transform: translateY(115px);">
                        <div class="row mb-3 mt-8">
                            <div class="col-md-12">NIK :</div>
                            <div class="col-md">{{$ls->nik}}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">Nama :</div>
                            <div class="col-md">{{$ls->name}}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">No Wa :</div>
                            <div class="col-md">{{$ls->no_hp}}</div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12">Date :</div>
                            <div class="col-md">{{$ls->date}}</div>
                        </div>
                        <button type="button" class="btn btn-primary w-75 mb-4 periksa-c1-plano" data-bs-toggle="modal" data-bs-target="#periksaC1Verifikator" data-id="{{$ls->tps_id}}">
                            Periksa C1
                            Plano
                        </button>
                        <button class="btn btn-success w-75 mb-4">Status Pembayaran Saksi</button>
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


<div class="modal fade" id="periksaC1Verifikator" tabindex="-1" aria-labelledby="periksaC1VerifikatorLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="periksaC1VerifikatorLabel">Data TPS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row" id="container-view-modal">

                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalPeriksa" tabindex="-1" aria-labelledby="modalPeriksaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPeriksaLabel">Persetujuan Koreksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <ul>
                        <li>Setiap perubahan data yang di lakukan wajib memerlukan izin dan persetujuan dari
                            administrator (Human Verifikasi)</li>
                        <li>Aktifitas perubahan data yang anda lakukan akan di tampilkan pada history publik yang dapat
                            di lihat oleh masyarakat
                            . Segala perbuatan yang melanggar hukum dengan merubah hasil perhitungan suara yang sah
                            dapat di kenakan Pasal 505 UU No.7 Tahun 2017</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer ajukanPerubahan">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="" class="btn btn-primary">Ajukan Perubahan</a>
            </div>
        </div>
    </div>
</div>




<div id="C1-Relawan" class="tabcontent">
    <h3>C1-Relawan</h3>
    <p>Some news this fine day!</p>
</div>
<div id="C1-Saksi-Pending" class="tabcontent">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title" style="margin-right: auto; margin-left: auto;">Ciputat</h5>
                </div>
                <div class="card-body">
                    <h4>TPS 64</h4>
                    <div class="row">
                        <div class="col-md">Nama :</div>
                        <div class="col-md">Saksi Pertama</div>
                    </div>
                    <div class="row">
                        <div class="col-md">No Wa :</div>
                        <div class="col-md">0898678467845</div>
                    </div>
                    <div class="row">
                        <div class="col-md">Tanggal Kirim :</div>
                        <div class="col-md">2022/01/10</div>
                    </div>
                    <form class="form">
                        <div class="row">
                            <div class="col-md-4 mt-4">
                                <label for="suara01">Suara 01</label>
                                <input class="form-control" type="text" id="suara01" value="12" disabled>
                            </div>
                            <div class="col-md-4 mt-4">
                                <label for="suara02">Suara 02</label>
                                <input class="form-control" type="text" id="suara03" value="12" disabled>
                            </div>
                            <div class="col-md-4 mt-4">
                                <label for="suara03">Suara 03</label>
                                <input class="form-control" type="text" id="suara03" value="12" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md mt-4">
                                <label for="jumlahsuarasah">Jumlah Suara Sah</label>
                                <input class="form-control" type="text" id="jumlahsuarasah" value="36" disabled>
                            </div>
                        </div>
                    </form>
                    <button class="btn btn-primary w-100 mt-4">Periksa C1 Relawan</button>
                    <div class="row">
                        <div class="col-md">
                            <button class="btn btn-primary w-100 mt-4">Periksa C1 Plano</button>
                        </div>
                        <div class="col-md">
                            <button class="btn btn-primary w-100 mt-4">Setuju</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="C1-Relawan-Banding" class="tabcontent">
    <h3>C1-Relawan-Banding</h3>
    <p>Who we are and what we do.</p>
</div>
<div id="Kecurangan" class="tabcontent">
    <h3>Kecurangan</h3>
    <p>Who we are and what we do.</p>
</div>



<script>
    function openPage(pageName, elmnt, color) {
        var i, tabcontent, tablinks;

        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";

        }
        tablinks = document.getElementsByClassName("tablink");
        let darkmode = document.body.className.split(' ');

        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].style.backgroundColor = "";
            (darkmode.length == 3) ? tablinks[i].style.color = "white": tablinks[i].style.color = "black";
        }

        document.getElementById(pageName).style.display = "block";




        elmnt.style.backgroundColor = color;
        elmnt.style.color = 'white';
    }
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>

<!-- SWEET-ALERT JS -->
<script src="../../assets/plugins/sweet-alert/sweetalert.min.js"></script>
<script src="../../assets/js/sweet-alert.js"></script>

<script>
    $('.c1saksi').click(function() {
        $('body').removeClass('timer-alert');
        swal({
            title: "C1 Saksi",
            text: "C1 Saksi adalah hasil perhitungan suara di TPS yang dikirimkan oleh saksi resmi partai.",
            type: "warning",
            confirmButtonText: 'Ok',
        });
    })
</script>

<script>
    $('.c1relawan').click(function() {
        $('body').removeClass('timer-alert');
        swal({
            title: "C1 Relawan",
            text: "C1 Relawan adalah hasil perhitungan suara di TPS yang dikirimkan oleh relawan.",
            type: "warning",
            confirmButtonText: 'Ok',
        });
    })
</script>

<script>
    $('.c1saksipend').click(function() {
        $('body').removeClass('timer-alert');
        swal({
            title: "C1 Saksi (Pending)",
            text: "C1 Saksi (Pending) adalah kiriman data TPS dari saksi yang tertahan karena adanya data C1 dari TPS yang sama telah dikirimkan oleh Relawan setempat. Hal ini biasanya terjadi karena C1 Saksi terlambat dikirimkan dan atau tidak adanya Saksi di TPS tersebut.",
            type: "warning",
            confirmButtonText: 'Ok',
        });
    })
</script>

<script>
    $('.c1relawanband').click(function() {
        $('body').removeClass('timer-alert');
        swal({
            title: "C1 Relawan (Banding)",
            text: "C1 Banding adalah data C1 yang berbeda di TPS yang sama. Kiriman C1 Banding berasal dari masyarakat / relawan untuk dibandingkan dengan C1 Saksi.",
            type: "warning",
            confirmButtonText: 'Ok',
        });
    })
</script>
<!-- CONTAINER END -->
</div>

</div>

<!-- Modal -->
<div class="modal fade" id="periksaModal1" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Foto C1 Plano</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <a>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12"><img width="550px" src="https://demo.tangsel.pilwalkot.rekapitung.id/assets/upload/c1plano.jpg" class="zoom" data-magnify-src="https://demo.tangsel.pilwalkot.rekapitung.id/assets/upload/c1plano.jpg">
                        </div>
                    </div>
                    <form>
                        <div class="row justify-content-between mt-4 mb-4">
                            <div class="col-md-3 text-center">
                                <label for="suara01 w-100">Suara 01</label>
                                <input class="form-control" type="text" value="12" size="10" disabled>
                            </div>
                            <div class="col-md-3 text-center">
                                <label for="suara02">Suara 02</label>
                                <input class="form-control" type="text" value="23" size="10" disabled>
                            </div>
                            <div class="col-md-3 text-center">
                                <label for="suara03">Suara 03</label>
                                <input class="form-control" type="text" value="0" size="10" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="jumlahsuarasah">Jumlah Suara Sah :</label>
                                <input class="form-control" id="jumlahsuarasah" type="text" value="35" size="10" disabled>
                            </div>
                        </div>
                    </form>
                </div>
            </a>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="periksaModal2" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Foto C2 Plano</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <a>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12"><img width="550px" src="https://demo.tangsel.pilwalkot.rekapitung.id/assets/upload/c1plano.jpg" class="zoom" data-magnify-src="https://demo.tangsel.pilwalkot.rekapitung.id/assets/upload/c1plano.jpg">
                        </div>
                    </div>
                    <form>
                        <div class="row justify-content-between mt-4 mb-4">
                            <div class="col-md-3 text-center">
                                <label for="suara01 w-100">Suara 01</label>
                                <input class="form-control" type="text" value="12" size="10" disabled>
                            </div>
                            <div class="col-md-3 text-center">
                                <label for="suara02">Suara 02</label>
                                <input class="form-control" type="text" value="23" size="10" disabled>
                            </div>
                            <div class="col-md-3 text-center">
                                <label for="suara03">Suara 03</label>
                                <input class="form-control" type="text" value="0" size="10" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="jumlahsuarasah">Jumlah Suara Sah :</label>
                                <input class="form-control" id="jumlahsuarasah" type="text" value="35" size="10" disabled>
                            </div>
                        </div>
                    </form>
                </div>
            </a>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection