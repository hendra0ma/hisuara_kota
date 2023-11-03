@extends('layouts.main-hukum')

@section('content')

<div class="row mt-5">
    <div class="col-lg-4">
        @if ($message = Session::get('success'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
        </div>
        @endif

        <h1 class="page-title fs-1 mt-2">Validator Kecurangan
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">{{ $kota->name }}
                <!-- Kota -->
            </li>
        </ol>
    </div>

    <div class="col-md">
        <div class="row">
            <div class="col-12 mb-2">
                <div class="row">
                    <div class="col parent-link kecurangan">
                        <a class="btn btn-ver text-white w-100 py-3 c1saksi tablink" onclick="openPage('Data-Kecurangan-Masuk', this, '#ff4f4e')" id="defaultOpen">Data Kecurangan Masuk</a>
                    </div>
                    <div class="col parent-link kecurangan">
                        <a class="btn btn-ver text-white w-100 py-3 c1relawan tablink" onclick="openPage('Data-Kecurangan-Terverifikasi', this, '#ff4f4e')">Data Kecurangan Terverifikasi</a>
                    </div>
                    <div class="col parent-link kecurangan">
                        <a class="btn btn-ver text-white w-100 py-3 c1koreksi tablink" onclick="openPage('Data-Kecurangan-Ditolak', this, '#ff4f4e')">Data Kecurangan Ditolak</a>
                    </div>
                </div>
            </div>
            
            {{-- <div class="col-md-12 text-white mt-3">
                <div class="row">
                    <div class="col py-2 judul text-center bg-secondary text-white"
                        style="border-top-left-radius: 25px; border-bottom-left-radius: 25px">
                        <div class="text">Total TPS : <b>{{ $total_tps }}</b></div>
                    </div>
                    <div class="col py-2 judul text-center bg-danger text-white">
                        <div class="text">TPS Masuk : <b>{{ $jumlah_tps_masuk }}</b></div>
                    </div>
                    <div class="col py-2 judul text-center bg-primary text-white">
                        <div class="text">TPS Kosong : <b>{{ $jumlah_kosong }}</b></div>
                    </div>
                    <div class="col py-2 judul text-center bg-success text-white"
                        style="border-top-right-radius: 25px; border-bottom-right-radius: 25px">
                        <div class="text">TPS Terverifikasi : <b>{{$jumlah_tps_terverifikai}}</b></div>
                    </div>
                </div>
            </div> --}}
        </div>
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
                // Remove the "active-tab" class from all tab links
                tablinks[i].classList.remove("active-tab");
            }
            document.getElementById(pageName).style.display = "block";
            elmnt.style.backgroundColor = color;
            // Add the "active-tab" class to the selected tab link
            elmnt.classList.add("active-tab");
        }

        // Wrap this part in a DOMContentLoaded event listener
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("defaultOpen").click();
        });
    </script>

</div>

<style>
    /* Define a CSS class for the active tab text */
    .active-tab {
        color: white;
    }

    .active-tab:hover {
        color: white;
    }
</style>

<div class="row">

    {{-- <div class="tab">
        <div class="row">
            <div class="col-md">
                <?php
                $count_suara = \App\Models\Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
                    ->join('users', 'users.tps_id', '=', 'tps.id')
                    // ->where('tps.villages_id', (string)$village->id)
                    ->where('saksi.verification', '')
                    ->whereNull('saksi.pending')
                    ->where('saksi.overlimit', 0)
                    ->count();
                $count_kecurangan = \App\Models\Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
                    ->join('users', 'users.tps_id', '=', 'tps.id')
                    ->where('saksi.kecurangan', 'yes')
                    ->where('saksi.status_kecurangan', 'belum terverifikasi')
                    ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
                    ->count();
                
                ?>
                <button class="btn tablink w-100 rounded-0 c1saksi" onclick="openPage('Data-Kecurangan-Masuk', this, '#45aaf2 ')"
                    id="defaultOpen">C1 Saksi <span
                        class="badge rounded-pill bg-danger">{{ $count_suara }}</span></button>
            </div>
            <!-- <div class="col-md">
                <button class="btn tablink w-100 rounded-0 c1partai" onclick="openPage('C1-Partai', this, '#f7b731')">C1 Partai</button>
            </div> -->
            <div class="col-md">
                <button class="btn tablink w-100 rounded-0 c1relawan"
                    onclick="openPage('Data-Kecurangan-Terverifikasi', this, '#f82649')">C1 Relawan Partai</button>
            </div>

            <div class="col-md">
                <button class="btn tablink w-100 rounded-0 c1teraudit"
                    onclick="openPage('C1-Dibatalkan', this, '#fb6b25')">C1 Dibatalkan</button>
            </div>

            <div class="col-md">
                <button class="btn tablink w-100 rounded-0 c1koreksi"
                    onclick="openPage('Data-Kecurangan-Ditolak', this, '#09ad95')">C1 Koreksi</button>
            </div>
          
            <!-- <div class="col-md">
                <button class="btn tablink w-100 rounded-0 kecurangan" onclick="openPage('Kecurangan', this, '#09ad95')">Kecurangan <span class="badge rounded-pill bg-danger">{{ $count_kecurangan }}</span></button>
            </div> -->
        </div>
    </div> --}}
</div>
<div class="card-body p-0">
    <div id="Data-Kecurangan-Masuk" class="tabcontent mt-0 px-0">
        <livewire:data-kecurangan-masuk />
    </div>
    <div id="Data-Kecurangan-Terverifikasi" class="tabcontent mt-0 px-0">
        <livewire:data-kecurangan-terverifikasi />
    </div>
    <div id="Data-Kecurangan-Ditolak" class="tabcontent mt-0 px-0">
        <livewire:data-kecurangan-ditolak />
    </div>
    
</div>

<div id="fotoKecurangan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button aria-label="Close" class="btn-close bg-danger text-white rounded-0" data-bs-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <div id="container-hukum-foto"></div>
            </div>

        </div>
    </div>
</div>

<div id="fotoKecuranganterverifikasi" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" class="btn-close bg-danger text-white rounded-0" data-bs-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <div id="container-hukum-verifikasi"></div>
            </div>

        </div>
    </div>
</div>
<div id="fotoKecuranganditolak" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" class="btn-close bg-danger text-white rounded-0" data-bs-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <div id="container-hukum-ditolak"></div>
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="cekKecurangan" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laporan Kecurangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Ciputat - TPS 87</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">List Kecurangan</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="catatanAdmin" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Catatan Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Body
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    const buttonperiksaC1Relawan = $("button.periksa-c1-relawan");
    //   const buttonkecurangan = $("button.periksa-c1-kecurangan");
    // const buttonC1Pending = $("button.periksa-c1-pending");
    const buttonperiksaC1 = $(".periksa-c1-plano");
    buttonperiksaC1.on('click', function() {
        const id = $(this).data('id');
        $.ajax({
            url: "{{ route('verifikator.getSaksiData') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                id
            },
            type: "post",
            dataType: "html",
            success: function(data) {
                $('#container-view-modal').html(data)
            }
        });
    });
    buttonC1Pending.on('click', function() {
        const id = $(this).data('id');
        $.ajax({
            url: "{{ route('verifikator.getSaksiPending') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                id
            },
            type: "get",
            dataType: "html",
            success: function(data) {
                $('#container-view-modal-c1-pending').html(data)
            }
        });
    });

    // buttonperiksaC1Relawan.on('click', function() {
    //     const id = $(this).data('id');
    //     $.ajax({
    //         url: "{{ route('verifikator.getRelawanData') }}",
    //         data: {
    //             "_token": "{{ csrf_token() }}",
    //             id
    //         },
    //         type: "post",
    //         dataType: "html",
    //         success: function(data) {
    //             $('#container-view-modal-relawan').html(data)
    //         }
    //     });
    // });

    //   buttonkecurangan.on('click', function() {
    //     const id = $(this).data('id');
    //     $.ajax({
    //       url: "{{ route('verifikator.getKecuranganSaksi') }}",
    //       data: {
    //         id
    //       },
    //       type: "get",
    //       dataType: "html",
    //       success: function(data) {
    //         $('#container-view-modal-kecurangan').html(data)
    //       }
    //     });
    //   })
</script>

    </div>

</div>

@endsection