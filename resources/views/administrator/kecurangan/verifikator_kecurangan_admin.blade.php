@extends('layouts.mainlayoutKecurangan')

@section('content')
    <div class="row mt-5">
        <div class="col-lg-4">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
                </div>
            @endif

            <h1 class="page-title fs-1 mt-2">Verifikasi & Validasi Kecurangan
                <!-- Kota -->
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">{{ $kota->name }}
                    <!-- Kota -->
                </li>
            </ol>


        </div>
        <div class="col-lg-8">
            <div class="row justify-content-end">
                <div class="col-lg-4 parent-link">
                    <a href="{{ url('') }}/verifikator/verifikator_kecurangan"
                        class="btn btn-fdp text-white w-100 py-3 {{ url()->current() == url('') . '/verifikator/verifikator_kecurangan' ? 'active' : '' }}">Laporan
                        Saksi Kecurangan</a>
                </div>
                <div class="col-lg-4 parent-link">
                    <a href="{{ url('') }}/verifikator/verifikator_kecurangan_admin"
                        class="btn btn-fdp text-white w-100 py-3 {{ url()->current() == url('') . '/verifikator/verifikator_kecurangan_admin' ? 'active' : '' }}">Laporan
                        Kecurangan Umum</a>
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
            document.addEventListener("DOMContentLoaded", function() {
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

    </div>
    <div class="card-body p-0">
        <livewire:list-kecurangan-component-admin />
    </div>
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
    <div class="modal fade" id="periksaC1Verifikator" tabindex="-1" aria-labelledby="periksaC1VerifikatorLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header" style="padding-right: 3rem">
                    <h3 class="modal-title fw-bold" id="periksaC1VerifikatorLabel">Verifikasi Data C1 TPS</h3>
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
                    <h3 class="modal-title" id="periksaC1RelawanLabel">Data TPS</h3>
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

    <div class="modal fade" id="periksakecurangan" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-fullscreen" role="document">
            <div class="modal-header bg-primary" style="position: relative">
                <h3 class="modal-title fw-bold text-white mx-auto" id="periksaC1VerifikatorLabel">Proses Verifikasi &
                    Validasi Data Kecurangan</h3>
                <button class="btn btn-secondary" style="position: absolute; right: 3rem;"
                    data-bs-dismiss="modal">Close</button>
            </div>
            <div class="modal-content h-auto">
                <div id="container-view-modal-kecurangan">
                </div>
                {{-- <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div> --}}
            </div>
        </div>
    </div>
    {{-- 
<div class="modal fade" id="periksakecurangan" tabindex="-1" aria-labelledby="periksakecuranganLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container-md">
                    <h5 class="modal-title fw-bold fs-1" id="periksakecuranganLabel">Proses Verifikasi Data Kecurangan
                    </h5>
                </div>
                <button type="button" class="me-auto btn-close my-auto bg-danger btn-sm text-white"
                    data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body scrolled" style="overflow-y: scroll;">
                <div class="row" id="container-view-modal-kecurangan">

                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div> --}}

    <script>
        const buttonkecurangan = $(".periksa-c1-kecurangan");

        buttonkecurangan.on('click', function() {
            const id = $(this).data('id');
            $.ajax({
                url: "{{ route('verifikator.getKecuranganSaksi') }}",
                data: {
                    id
                },
                type: "get",
                success: function(data) {
                    $('#container-view-modal-kecurangan').html(data)
                    {{-- console.log(data) --}}

                }
            });
        })
    </script>
@endsection
