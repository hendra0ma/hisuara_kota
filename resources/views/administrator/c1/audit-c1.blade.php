@extends('layouts.mainlayoutAuditor')

@section('content')

<div class="row mt-5 mb-5">
    <div class="col-lg">
        <h1 class="page-title fs-1 mt-2">Audit C1
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">{{ $kota->name }}
                <!-- Kota -->
            </li>
        </ol> <!-- This Dummy Data -->
    </div>
    <div class="col-md-4">
        <div class="row mt-2">
            <div class="col parent-link">
                <a class="btn text-white w-100 py-3 c1saksi tablink" onclick="openPage('C1-Saksi', this, '#6259ca')"
                    id="defaultOpen">Audit C1</a>
            </div>
            <div class="col parent-link">
                <a class="btn text-white w-100 py-3 c1relawan tablink" onclick="openPage('C1-Relawan', this, '#6259ca')">
                    C1 Lolos Audit</a>
            </div>
            {{-- <div class="col parent-link">
                <a class="btn text-white w-100 py-3 c1teraudit tablink"
                    onclick="openPage('C1-Dibatalkan', this, '#6259ca')">C1 Dibatalkan</a>
            </div> --}}
            {{-- <div class="col parent-link">
                <a class="btn text-white w-100 py-3 c1koreksi tablink"
                    onclick="openPage('C1-Koreksi', this, '#6259ca')">C1 Tidak Lolos Audit</a>
            </div> --}}
        </div>
    </div>

</div>


<style>
    .inner-card {
        border-radius: 10px;
        background-color: #cbd7ff;
        box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5) inset;
        -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5) inset;
        -moz-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5) inset;
    }
</style>

<div id="C1-Saksi" class="tabcontent mt-0 pt-0 px-0">
    <livewire:audit-c1>
</div>
<div id="C1-Relawan" class="tabcontent mt-0 pt-0 px-0">
    <livewire:c1-lolos-audit />
</div>
<div id="C1-Koreksi" class="tabcontent mt-0 pt-0 px-0">
    <livewire:c1-tidak-lolos-audit />
</div>

<div class="modal fade" id="periksaC1Verifikator" tabindex="-1" aria-labelledby="periksaC1VerifikatorLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header" style="padding-right: 3rem">
                <h3 class="modal-title fw-bold" id="periksaC1VerifikatorLabel">AUDIT DATA C1 TPS</h3>
                <button type="button" class="btn-close btn-danger text-white mr-5" style="width: 50px" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
            </div>
            <div class="modal-body">
                <div class="row" id="container-view-modal">
                    
                </div>
            </div>
            <div class="modal-footer">

                <input type="hidden" class="urlCurrent">

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
                <button type="button" class="btn-close btn-danger text-white mr-5" style="width: 50px" data-bs-dismiss="modal" aria-label="Close">Close</button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <ul>
                        <li>Setiap perubahan data yang di lakukan wajib memerlukan izin dan persetujuan dari administrator (Human Verifikasi)</li>
                        <li>Aktifitas perubahan data yang anda lakukan akan di tampilkan pada history publik yang dapat di lihat oleh masyarakat
                            . Segala perbuatan yang melanggar hukum dengan merubah hasil perhitungan suara yang sah dapat di kenakan Pasal 505 UU No.7 Tahun 2017</li>
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

<div class="modal fade" style="overflow: scroll" id="periksaC1Auditor" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl scrollable" role="document">
        <div class="modal-header bg-primary text-white">
            <div class="modal-title mx-auto">
                <h4 class="mb-0 fw-bold">C1 Koreksi (Auditor)</h4>
            </div>
        </div>
        <div class="modal-content">
            <div class="container" id="container-view-dibatalkan">
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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

@endsection