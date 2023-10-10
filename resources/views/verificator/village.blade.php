@extends('layouts.mainlayoutVerificatorVillage');

@section('content')

<div class="row mt-3">
    <div class="col-lg-4">
        @if ($message = Session::get('success'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
        </div>
        @endif

        <h1 class="page-title fs-1 mt-2">Dashboard Rekapitung
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">KELURAHAN {{$village->name}}
                <!-- Kota -->
            </li>
        </ol>
        <h4 class="fs-4 mt-2 fw-bold">Verifikasi Suara Saksi (2)</h4> <!-- This Dummy Data -->
    </div>
    <div class="col-lg-8">
        <div class="row">
            <div class="col-6">
                <div class="card bg-light text-dark">
                    <div class="card-header text-center bg-danger text-white">
                        <span> TPS MASUK </span>
                    </div>
                    <div class="card-body text-center" style="font-size:15px;font-weight:bolder">
                        <div class="row no-gutters">
                            <div class="col-10">
                                {{$jumlah_tps_masuk}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card bg-light text-dark">
                    <div class="card-header text-center bg-success text-white">
                        <span> TPS Terverifikasi </span>
                    </div>
                    <div class="card-body text-center" style="font-size:15px;font-weight:bolder">
                        <div class="row no-gutters">
                            <div class="col-10">
                                {{$jumlah_tps_terverifikai}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

</div>

<div class="tab mt-5">
    <div class="row">
        <div class="col-md">
            <?php
            $count_suara  = \App\Models\Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
                ->join('users', 'users.tps_id', '=', 'tps.id')
                ->where('tps.villages_id', (string)$village->id)
                ->where('saksi.verification', '')
                ->whereNull('saksi.pending')
                ->where('saksi.overlimit', 0)
                ->count();
            $count_kecurangan  =\App\Models\Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
                ->join('users', 'users.tps_id', '=', 'tps.id')
                ->where('saksi.kecurangan', 'yes')
                ->where('saksi.status_kecurangan', 'belum terverifikasi')
                ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
                ->count();

            ?>
            <button class="btn tablink w-100 rounded-0 c1saksi" onclick="openPage('C1-Saksi', this, '#45aaf2 ')" id="defaultOpen">C1 Saksi <span class="badge rounded-pill bg-danger">{{$count_suara}}</span></button>
        </div>
        <!-- <div class="col-md">
            <button class="btn tablink w-100 rounded-0 c1partai" onclick="openPage('C1-Partai', this, '#f7b731')">C1 Partai</button>
        </div> -->
        <div class="col-md">
            <button class="btn tablink w-100 rounded-0 c1relawan" onclick="openPage('C1-Relawan', this, '#f82649')">C1 Relawan Partai</button>
        </div>
        <div class="col-md">
            <button class="btn tablink w-100 rounded-0 c1saksipend" onclick="openPage('C1-Saksi-Pending', this, '#6259ca ')" style="background-color: rgb(98, 89, 202);">C1
                Saksi (Pending)</button>
        </div>
        <!-- <div class="col-md">
            <button class="btn tablink w-100 rounded-0 kecurangan" onclick="openPage('Kecurangan', this, '#09ad95')">Kecurangan <span class="badge rounded-pill bg-danger">{{$count_kecurangan}}</span></button>
        </div> -->
    </div>
</div>

<div id="C1-Saksi" class="tabcontent">
    <livewire:c1-saksi-verifikator-component :id_kel="$village->id" :district="$district->name" />
</div>


<div class="modal fade" id="periksaC1Verifikator" tabindex="-1" aria-labelledby="periksaC1VerifikatorLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="periksaC1VerifikatorLabel">Data C1 TPS</h5>
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
<div class="modal fade" id="periksaC1Relawan" tabindex="-1" aria-labelledby="periksaC1RelawanLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="periksaC1RelawanLabel">Data TPS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row" id="container-view-modal-relawan">

                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<style>
    .scrolled::-webkit-scrollbar{
          width: 15px !important;
    }
    /* Handle */
     .scrolled::-webkit-scrollbar-thumb {
  background: #888 !important; 
}

</style>
<div class="modal fade" id="periksakecurangan" tabindex="-1" aria-labelledby="periksakecuranganLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container-md">
                    <h5 class="modal-title fw-bold fs-1" id="periksakecuranganLabel">Proses Verifikasi Data Kecurangan</h5>
                </div>
                <button type="button" class="me-auto btn-close my-auto bg-danger btn-sm text-white" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body scrolled"style="overflow-y: scroll;">
                <div class="row" id="container-view-modal-kecurangan">

                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="periksaC1Pending" tabindex="-1" aria-labelledby="periksaC1PendingLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="periksaC1PendingLabel">Data C1 Pending</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <div class="row" id="container-view-modal-c1-pending">

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
    <livewire:c1-relawan-terverifikasi :village_id="$village->id" />
</div>
<div id="C1-Saksi-Pending" class="tabcontent">
    <livewire:c1-saksi-pending :village_id="$village->id" />
</div>

<div id="Kecurangan" class="tabcontent">
    <!-- <h3>Kecurangan</h3>
    <p>Who we are and what we do.</p> -->


</div>



<script>
    function openPage(pageName, elmnt, color) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].style.backgroundColor = "";
        }
        document.getElementById(pageName).style.display = "block";
        elmnt.style.backgroundColor = color;
    }
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>

<!-- SWEET-ALERT JS -->
<script src="../../assets/plugins/sweet-alert/sweetalert.min.js"></script>
<script src="../../assets/js/sweet-alert.js"></script>
@if ($message = Session::get('sukses_verif'))


<script>
    // this way when the ajax call completes quickly, the loader will still be shown for a bit
setTimeout(function() {
    swal({
            title: "Berhasil Verifikasi",
            text: "C1 Saksi Telah Dipindahkan Ke Auditor Forensik",
            type: "success",
            confirmButtonText: 'Ok',
        });
}, 500);

</script>
@endif



<script>
    $('.c1saksi').click(function() {
        $('body').removeClass('timer-alert');
        swal({
            title: "C1 Saksi",
            text: "C1 Saksi adalah hasil perhitungan suara di TPS yang dikirimkan oleh saksi resmi kandidat.",
            type: "warning",
            confirmButtonText: 'Ok',
        });
    })
</script>

<script>
    $('.c1partai').click(function() {
        $('body').removeClass('timer-alert');
        swal({
            title: "C1 Partai",
            text: "C1 Partai adalah hasil perhitungan suara di TPS yang dikirimkan oleh saksi resmi kandidat / partai.",
            type: "warning",
            confirmButtonText: 'Ok',
        });
    })
</script>

<script>
    $('.c1relawan').click(function() {
        $('body').removeClass('timer-alert');
        swal({
            title: "C1 Relawan Partai",
            text: "C1 Relawan Partai adalah hasil perhitungan suara di TPS yang dikirimkan oleh relawan.",
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
            title: "C1 Relawan Partai (Banding)",
            text: "C1 Banding adalah data C1 yang berbeda di TPS yang sama. Kiriman C1 Banding berasal dari masyarakat / relawan untuk dibandingkan dengan C1 Saksi.",
            type: "warning",
            confirmButtonText: 'Ok',
        });
    })
</script>

<script>
    $('.pengajuankoreksi').click(function() {
        $('body').removeClass('timer-alert');
        swal({
            title: "Pengajuan Koreksi",
            text: "Pengajuan koreksi adalah status dimana verifikator mendapati hasil input saksi dengan C1 berbeda sehingga verifikator dapat melakukan pengajuan koreksi kepada Otentifikasi Koreksi untuk disetujui.",
            type: "warning",
            confirmButtonText: 'Ok',
        });
    })
</script>

<script>
    $('.tpsdibatalkan').click(function() {
        $('body').removeClass('timer-alert');
        swal({
            title: "TPS Di Batalkan",
            text: "TPS di batalkan adalah status dimana hasil verifikasi yang dilakukan oleh verifikator dibatalkan auditor karena terjadi kesalahan perhitungan.",
            type: "warning",
            confirmButtonText: 'Ok',
        });
    })
</script>

<script>
    $('.koreksiditolak').click(function() {
        $('body').removeClass('timer-alert');
        swal({
            title: "Koreksi Ditolak",
            text: "Koreksi Ditolak adalah status dimana pengajuan koreksi verifikator telah di tolak oleh Otentifikasi Koreksi.",
            type: "warning",
            confirmButtonText: 'Ok',
        });
    })
</script>

<script>
    $('.kecurangan').click(function() {
        $('body').removeClass('timer-alert');
        swal({
            title: "Kecurangan",
            text: "Kecurangan adalah status dimana verifikator mendapatkan bukti berupa foto atau video kecurangan yang dikirimkan oleh saksi di TPS dengan menekan tombol konfirmasi kecurangan setelah melalui proses pemeriksaan oleh verifikator.",
            type: "warning",
            confirmButtonText: 'Ok',
        });
    })
</script>
@endsection