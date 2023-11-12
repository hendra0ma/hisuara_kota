@extends('layouts.mainlayout')

@section('content')

<div class="row mt-5">
    <div class="col-lg-4">
        @if ($message = Session::get('success'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
        </div>
        @endif

        <h1 class="page-title fs-1 mt-2">Verifikasi C1
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">{{ $kota->name }}
                <!-- Kota -->
            </li>
        </ol>
    </div>

    <div class="col-md-4">
        <div class="row mt-2">
            <div class="col parent-link">
                <a class="btn text-white w-100 py-3 c1saksi tablink" onclick="openPage('C1-Saksi', this, '#6259ca')"
                    id="defaultOpen">C1 Saksi</a>
            </div>
            <div class="col parent-link">
                <a class="btn text-white w-100 py-3 c1relawan tablink"
                    onclick="openPage('C1-Relawan', this, '#6259ca')">C1 Relawan TPS</a>
            </div>
            {{-- <div class="col parent-link">
                <a class="btn text-white w-100 py-3 c1teraudit tablink"
                    onclick="openPage('C1-Dibatalkan', this, '#6259ca')">C1 Dibatalkan</a>
            </div> --}}
            <!-- <div class="col parent-link">
                <a class="btn text-white w-100 py-3 c1koreksi tablink"
                    onclick="openPage('C1-Koreksi', this, '#6259ca')">Pengajuan Koreksi C1</a>
            </div> -->
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

<div id="C1-Saksi" class="tabcontent mt-0 pt-0 px-0">
    <livewire:c1-saksi-kota />
</div>
<div id="C1-Relawan" class="tabcontent mt-0 pt-0 px-0">
    <livewire:c1-relawan-kota />
 
</div>
<!-- <div id="C1-Koreksi" class="tabcontent mt-0 pt-0 px-0">
    <livewire:c1-koreksi />
</div> -->

<div class="modal fade" id="periksaC1Verifikator" tabindex="-1" aria-labelledby="periksaC1VerifikatorLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header" style="padding-right: 3rem">
                <h3 class="modal-title fw-bold" id="periksaC1VerifikatorLabel">VERIFIKASI DATA C1 TPS</h3>
                <button type="button" class="btn-close btn-danger text-white mr-5" style="width: 50px"
                    data-bs-dismiss="modal" aria-label="Close">Close</button>
            </div>
            <div class="modal-body">
                <div class="row" id="container-view-modal">

                </div>
            </div>
            {{-- <div class="modal-footer">
            </div> --}}
        </div>
    </div>
</div>
<div class="modal fade" id="periksaC1Relawan" tabindex="-1" aria-labelledby="periksaC1RelawanLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="periksaC1RelawanLabel">Data TPS Relawan</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Close</button>
            </div>
            <div class="modal-body">
                <div class="row" id="container-view-modal-relawan">

                </div>
            </div>
            {{-- <div class="modal-footer">
            </div> --}}
        </div>
    </div>
</div>

<div class="modal fade" id="modalPeriksa" tabindex="-1" aria-labelledby="modalPeriksaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalPeriksaLabel">Persetujuan Koreksi</h3>
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
        // console.log(id)
    });

  

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

@endsection