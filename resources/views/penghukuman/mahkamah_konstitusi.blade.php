@extends('layouts.main-verifikasi-akun')

@section('content')

<div class="row" style="margin-top: 90px; transition: all 0.5s ease-in-out;">
    <div class="col-lg-auto d-flex">
        <img style="width: 75px; height: 75px; object-fit: contain" class="my-auto" src="https://contactmk.mkri.id/design/img/logo_mk_new.png" alt="">
    </div>
    <div class="col-lg">
        @if ($message = Session::get('success'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
        </div>
        @endif

        <h1 class="page-title fs-1 mt-2">Mahkamah Konstitusi
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">{{ $kota->name }}
                <!-- Kota -->
            </li>
        </ol>
    </div>

    <div class="col-md-8">
        <div class="row mt-2">
            <div class="col parent-link">
                <a data-command-target="kecurangan-masuk" class="btn text-white w-100 py-3 kecurangan-masuk tablink" onclick="openPage('kecurangan-masuk', this, '#6259ca')"
                    id="defaultOpen">Kecurangan Masuk</a>
            </div>
            <div class="col parent-link">
                <a data-command-target="kecurangan-ditolak" class="btn text-white w-100 py-3 kecurangan-ditolak tablink"
                    onclick="openPage('kecurangan-ditolak', this, '#6259ca')">Kecurangan Ditolak</a>
            </div>
            <div class="col parent-link">
                <a data-command-target="peserta-sidang-online" class="btn text-white w-100 py-3 peserta-sidang-online tablink"
                    onclick="openPage('peserta-sidang-online', this, '#6259ca')">Peserta Sidang Online</a>
            </div>
            <div class="col parent-link">
                <a data-command-target="sidang-tidak-menjawab" class="btn text-white w-100 py-3 sidang-tidak-menjawab tablink"
                    onclick="openPage('sidang-tidak-menjawab', this, '#6259ca')">Sidang Tidak Menjawab</a>
            </div>
            <div class="col parent-link">
                <a data-command-target="semua-kecurangan" class="btn text-white w-100 py-3 semua-kecurangan tablink"
                    onclick="openPage('semua-kecurangan', this, '#6259ca')">Semua Kecurangan</a>
            </div>
        </div>
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

<style>
    /* Define a CSS class for the active tab text */
    .active-tab {
        color: white;
    }

    .active-tab:hover {
        color: white;
    }
</style>

<div id="kecurangan-masuk" class="tabcontent mt-0 pt-0 px-0">
    <livewire:m-k-kecurangan-masuk>
</div>
<div id="kecurangan-ditolak" class="tabcontent mt-0 pt-0 px-0">
    <livewire:m-k-kecurangan-ditolak>
</div>
<div id="peserta-sidang-online" class="tabcontent mt-0 pt-0 px-0">
    <livewire:m-k-peserta-sidang>
</div>
<div id="sidang-tidak-menjawab" class="tabcontent mt-0 pt-0 px-0">
    <livewire:m-k-peserta-tidak-jawab>    
</div>
<div id="semua-kecurangan" class="tabcontent mt-0 pt-0 px-0">
    <livewire:m-k-semua-kecurangan>
</div>

<div id="fotoKecuranganterverifikasi" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content" id="qrSidangOnline">


        </div>
    </div>
</div>
<div id="modalQrCode" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="qrSidang">


        </div>
    </div>
</div>

<script>
    let qrsidang = function(ini){
                        let id_tps = $(ini).data('id');
                        $.ajax({
                            url : "{{url('')}}/administrator/get_qrsidang",
                            data : {
                                    id_tps,
                                },
                            type : 'GET',
                            success : function(response){
                                document.querySelector('div#qrSidang').innerHTML = response;
                            }
                        })
                    }
</script>
<script>
    let sidang_online = function(ini){
                        let id_tps = $(ini).data('id');
                        $.ajax({
                            url : "{{url('')}}/administrator/get_sidang_online",
                            data : {
                                    id_tps,
                                },
                            type : 'GET',
                            success : function(response){
                                document.querySelector('div#qrSidangOnline').innerHTML = response;
                            }
                        })
                    }
</script>
@endsection