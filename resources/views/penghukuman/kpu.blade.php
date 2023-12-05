@include('layouts.partials.head')
@include('layouts.partials.sidebar')
<?php
$solution = \App\Models\SolutionFraud::get();
?>

@include('layouts.partials.header')

<div class="row" style="margin-top: 90px; transition: all 0.5s ease-in-out;">
    <div class="col-lg-auto d-flex">
        <img style="width: 75px; height: 75px; object-fit: contain" class="my-auto"
            src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/46/KPU_Logo.svg/1200px-KPU_Logo.svg.png" alt="">
    </div>
    <div class="col-lg">
        @if ($message = Session::get('success'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
        </div>
        @endif

        <h1 class="page-title fs-1 mt-2">KPU
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
                <a class="btn text-white w-100 py-3 tablink" data-command-target="bukti-kecurangan"
                    onclick="openPage('bukti-kecurangan', this, '#6259ca')" id="defaultOpen">Bukti Kecurangan</a>
            </div>
              <div class="col parent-link">
                <a class="btn text-white w-100 py-3 tablink" data-command-target="kecurangan-tercetak"
                    onclick="openPage('kecurangan-tercetak', this, '#6259ca')" >Kecurangan Tercetak</a>
            </div>
            <div class="col parent-link">
                <a class="btn text-white w-100 py-3 tablink" data-command-target="barkode-kecurangan"
                    onclick="openPage('barkode-kecurangan', this, '#6259ca')">Barkode Kecurangan</a>
            </div>
            <div class="col parent-link">
                <a class="btn text-white w-100 py-3 tablink" data-command-target="rekomendasi-tindakan"
                    onclick="openPage('rekomendasi-tindakan', this, '#6259ca')">Rekomendasi Tindakan</a>
            </div>
            <div class="col parent-link">
                <a class="btn text-white w-100 py-3 tablink" data-command-target="index-tsm"
                    onclick="openPage('index-tsm', this, '#6259ca')">Index TSM</a>
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

<div id="index-tsm" class="tabcontent mt-0 pt-0 px-0">
    <div class="row">
        <div class="col-6 mt-5">
            <h2 class="fw-bold">Index TSM Pemilu</h2>
        </div>
        <div class="col-6 mt-5">
            <div class="row justify-content-end">
                <div class="col-4">
                    <a href="{{url('')}}/administrator/print-index-tsm" target="_blank"
                        class="btn btn-block btn-dark ml-2 mr-2 w-100"> Print &nbsp;&nbsp;<i class="fa fa-print"></i></a>
                </div>
        
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row justify-content-center">
                <div class="col-lg-12 ">
                    <div class="card">
                        <div class="card-header bg-danger">
                            <center>
                                <h4 class="mx-auto text-white mb-0 fw-bold">
                                    1. PELANGGARAN ADMINISTRASI PEMILU
                                </h4>
                            </center>
                        </div>
                        <div class="card-body">

                            <center>
                                <div id="chart-pie"></div>
                            </center>
                            <div class="table-responsive">
                                <table
                                    class="table table-bordered text-nowrap border-bottom dataTable no-footer table-striped table-hover datable"
                                    role="grid" id="responsive-datatable_info">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th class="text-white">No</th>
                                            <th class="text-white">Kode</th>
                                            <th class="text-white">Persentase</th>
                                            <th class="text-white">Kecurangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        @foreach ($index_tsm as $item)
                                        <?php if ($item->jenis != 0) {
                                                    continue;
                                                } ?>
                                        <tr>
                                            <?php
                                                        $totalKec =  App\Models\Bukti_deskripsi_curang::join('list_kecurangan', 'list_kecurangan.id', '=', 'bukti_deskripsi_curang.list_kecurangan_id')
                                                            ->join('saksi', 'saksi.tps_id', '=', 'bukti_deskripsi_curang.tps_id')
                                                            ->where('saksi.status_kecurangan', "terverifikasi")
                                                            ->where('bukti_deskripsi_curang.list_kecurangan_id', $item->id)
                                                            ->where('list_kecurangan.jenis', 0)
                                                            ->count();
                                                        $jumlahSaksi =        App\Models\Saksi::whereNull('pending')->count();
                                                        $persen = ($totalKec / $jumlahSaksi) * 100;
            
                                                    ?>
                                            <td>{{ $i++ }}</td>
                                            <td>{{$item->kode}}</td>
                                            <td>{{substr($persen,0,4)}}%</td>
                                            <td>{{ $item['kecurangan'] }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-6">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-danger">
                            <center>
                                <h4 class="mx-auto text-white mb-0 fw-bold">
                                    2. PELANGGARAN TINDAK PIDANA
                                </h4>
                            </center>
                        </div>
                        <div class="card-body">

                            <center>
                                <div id="chart-donut"></div>
                            </center>

                            <div class="table-responsive">
                                <table
                                    class="table table-bordered text-nowrap border-bottom dataTable no-footer table-striped table-hover datable"
                                    role="grid" id="responsive-datatable_info">
                                    <thead class="bg-dark">
                                        <tr>
                                            <th class="text-white">No</th>
                                            <th class="text-white">Kode</th>
                                            <th class="text-white">Persentase</th>
                                            <th class="text-white">Kecurangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        @foreach ($index_tsm as $item)
                                        <?php if ($item->jenis != 1) {
                                                    continue;
                                                } ?>
                                        <tr>
                                            <?php
                                                        $totalKec =  App\Models\Bukti_deskripsi_curang::join('list_kecurangan', 'list_kecurangan.id', '=', 'bukti_deskripsi_curang.list_kecurangan_id')
                                                            ->join('saksi', 'saksi.tps_id', '=', 'bukti_deskripsi_curang.tps_id')
                                                            ->where('saksi.status_kecurangan', "terverifikasi")
                                                            ->where('bukti_deskripsi_curang.list_kecurangan_id', $item->id)
                                                            ->where('list_kecurangan.jenis', 1)
                                                            ->count();
                                                        $jumlahSaksi = App\Models\Saksi::whereNull('pending')->count();
                                                        $persen = ($totalKec / $jumlahSaksi) * 100;
                                                    ?>
                                            <td>{{ $i++ }}</td>
                                            <td>{{$item->kode}}</td>
                                            <td>{{substr($persen,0,4)}}%</td>
                                            <td>{{ $item['kecurangan'] }}</td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-danger">
                            <center>
                                <h4 class="mx-auto text-white mb-0 fw-bold">
                                    3. PELANGGARAN KODE ETIK
                                </h4>
                            </center>
                        </div>
                        <div class="card-body">

                            <center>
                                <div id="chart-donut-et"></div>
                            </center>

                            <div class="table-responsive">
                                <table
                                    class="table table-bordered text-nowrap border-bottom dataTable no-footer table-striped table-hover datable"
                                    role="grid" id="responsive-datatable_info">
                                    <thead class="bg-dark">
                                        <tr>
                                            <th class="text-white">No</th>
                                            <th class="text-white">Kode</th>
                                            <th class="text-white">Persentase</th>
                                            <th class="text-white">Kecurangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        @foreach ($index_tsm as $item)
                                        <?php if ($item->jenis != 2) {
                                                            continue;
                                                        } ?>
                                        <tr>
                                            <?php
                                                        $totalKec =  App\Models\Bukti_deskripsi_curang::join('list_kecurangan', 'list_kecurangan.id', '=', 'bukti_deskripsi_curang.list_kecurangan_id')
                                                            ->join('saksi', 'saksi.tps_id', '=', 'bukti_deskripsi_curang.tps_id')
                                                            ->where('saksi.status_kecurangan', "terverifikasi")
                                                            ->where('bukti_deskripsi_curang.list_kecurangan_id', $item->id)
                                                            ->where('list_kecurangan.jenis', 1)
                                                            ->count();
                                                        $jumlahSaksi =        App\Models\Saksi::whereNull('pending')->count();
                                                        $persen = ($totalKec / $jumlahSaksi) * 100;
                                                    ?>
                                            <td>{{ $i++ }}</td>
                                            <td>{{$item->kode}}</td>
                                            <td>{{substr($persen,0,4)}}%</td>
                                            <td>{{ $item['kecurangan'] }}</td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-danger">
                            <center>
                                <h4 class="mx-auto fw-bold text-white mb-0">
                                    4. PELANGGARAN APARATUR SIPIL NEGARA
                                </h4>
                            </center>
                        </div>
                        <div class="card-body">

                            <center>
                                <div id="chart-donut-panrb"></div>
                            </center>

                            <div class="table-responsive">
                                <table
                                    class="table table-bordered text-nowrap border-bottom dataTable no-footer table-striped table-hover datable"
                                    role="grid" id="responsive-datatable_info">
                                    <thead class="bg-dark">
                                        <tr>
                                            <th class="text-white">No</th>
                                            <th class="text-white">Kode</th>
                                            <th class="text-white">Persentase</th>
                                            <th class="text-white">Kecurangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        @foreach ($index_tsm as $item)
                                        <?php if ($item->jenis != 3) {
                                                                continue;
                                                            } ?>
                                        <tr>
                                            <?php
                
                                                                $totalKec =  App\Models\Bukti_deskripsi_curang::join('list_kecurangan', 'list_kecurangan.id', '=', 'bukti_deskripsi_curang.list_kecurangan_id')
                                                                     ->join('saksi', 'saksi.tps_id', '=', 'bukti_deskripsi_curang.tps_id')
                                                                     ->where('saksi.status_kecurangan', "terverifikasi")
                                                                    ->where('bukti_deskripsi_curang.list_kecurangan_id', $item->id)
                                                                    ->where('list_kecurangan.jenis', 1)
                                                                    ->count();
                                                               $jumlahSaksi =        App\Models\Saksi::whereNull('pending')->count();
                                                                $persen = ($totalKec / $jumlahSaksi) * 100;
                                                                ?>
                                            <td>{{ $i++ }}</td>
                                            <td>{{$item->kode}}</td>
                                            <td>{{substr($persen,0,4)}}%</td>
                                            <td>{{ $item['kecurangan'] }}</td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Keterangan Kode</div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered w-100">
                        <?php 
                                $kodeF = DB::table('solution_frauds')->get();
                                ?>
                        <tr>
                            @foreach($kodeF as $kod)

                            <td><b class="text-danger">{{$kod->kode}}</b> ({{$kod->solution}})</td>

                            @endforeach
                        </tr>

                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="row justify-content-end">
                <div class="col-4">
                    <a href="{{url('')}}/administrator/print-index-tsm" target="_blank"
                        class="btn btn-block btn-dark ml-2 mr-2 w-100"> Print &nbsp;&nbsp;<i
                            class="fa fa-print"></i></a>
                </div>

            </div>
        </div>
    </div>
</div>
<div id="rekomendasi-tindakan" class="tabcontent mt-0 pt-0 px-0">
    <div class="col-12 px-0 mt-5">
        <h2 class="fw-bold">
            Rekomendasi Tindakan
        </h2>
    </div>
    <div class="col-lg-12 px-0">
        <div class="card">
            <div class="card-body">
                <div class="row">

                    @foreach($solution as $solut)
                    <?php $jmlh_kecurangan =  \App\Models\Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
                                                        ->join('users', 'users.tps_id', '=', 'tps.id')
                                                        ->join('bukti_deskripsi_curang', 'bukti_deskripsi_curang.tps_id', '=', 'tps.id')
                                                        ->join('list_kecurangan', 'list_kecurangan.id', '=', 'bukti_deskripsi_curang.list_kecurangan_id')
                                                        ->where('list_kecurangan.solution_fraud_id',$solut->id)
                                                        ->where('saksi.kecurangan', 'yes')
                                                        ->where('saksi.status_kecurangan', 'terverifikasi')
                                                        ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
                                                        ->get();
                                                        
                                                        
                                                        ?>


                    <div class="col-lg justify-content-end">
                        <div class="card">
                            <div class="card-header bg-primary">
                                <div class="card-title text-white">{{$solut->solution}}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mx-auto text-center">
                                        <b class="fs-4 mx-auto target-container<?=$solut->id?>"> </b>
                                        <script>
                                            data = [@foreach($jmlh_kecurangan as $jmlh)
                                                        '{{$jmlh->tps_id}}', @endforeach
                                                    ];
                                                    uniqueArray = data.filter(function (item, pos) {
                                                        return data.indexOf(item) == pos;
                                                    });
                                                    document.querySelector('b.target-container<?=$solut->id?>').innerHTML =
                                                        uniqueArray.length
        
                                        </script>
                                    </div>
                                    <div class="col my-auto text-end">
                                        <a {{-- href="{{ route('superadmin.solution', encrypt($solut->id)) }}" --}}
                                            style="cursor: pointer"
                                            data-target="{{ preg_replace('/\([^)]+\)/', '', str_replace(' ', '-', strtolower($solut->solution))) }}" class="my-auto rekom-tindakan">
                                            Lihat
                                            <i class="mdi mdi-eye"></i>
                                        </a>
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

    <script>
        $('.rekom-tindakan').on('click', function () {
            let target = $(this).data('target');
            let $targetElement = $(`.konten-rekom-tindakan#${target}`);
            
            if ($targetElement.hasClass('active')) {
            // If it has the 'active' class, do nothing or perform the required action
            // For example, you might want to toggle the 'active' class or perform other actions
            } else {
            // If it doesn't have the 'active' class, hide others and show the selected one
            $('.konten-rekom-tindakan').not($targetElement).hide(500).removeClass('active');
                $targetElement.show(200).addClass('active');
            }
        }) 
    </script>

    <div class="col-12 konten-rekom-tindakan" id="perhitungan-suara-ulang" style="display: none">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="card-title text-white">Perhitungan Suara Ulang</div>
            </div>
            <div class="card-body">
                <livewire:rekom-tindakan-p-s-u>
            </div>
        </div>
    </div>

    <div class="col-12 konten-rekom-tindakan" id="pemungutan-suara-ulang" style="display: none">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="card-title text-white">Pemungutan Suara Ulang</div>
            </div>
            <div class="card-body">
                <livewire:rekom-tindakan-p-s-u2>
            </div>
        </div>
    </div>

    <div class="col-12 konten-rekom-tindakan" id="kasus-administrasi-pemilu" style="display: none">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="card-title text-white">Kasus Administrasi Pemilu</div>
            </div>
            <div class="card-body">
                <livewire:rekom-tindakan-k-a-p>
            </div>
        </div>
    </div>

    <div class="col-12 konten-rekom-tindakan" id="pelanggaran-tindak-pidana" style="display: none">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="card-title text-white">Pelanggaran Tindak Pidana</div>
            </div>
            <div class="card-body">
                <livewire:rekom-tindakan-p-t-p>
            </div>
        </div>
    </div>

    <div class="col-12 konten-rekom-tindakan" id="pelanggaran-kode-etik" style="display: none">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="card-title text-white">Pelanggaran Kode Etik</div>
            </div>
            <div class="card-body">
                <livewire:rekom-tindakan-p-k-e>
            </div>
        </div>
    </div>

    <div class="col-12 konten-rekom-tindakan" id="pelanggaran-aparatur-sipil-negara-" style="display: none">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="card-title text-white">Pelanggaran Aparatur Sipil Negara (ASN)</div>
            </div>
            <div class="card-body">
                <livewire:rekom-tindakan-p-a-s-n>
            </div>
        </div>
    </div>
</div>
<div id="barkode-kecurangan" class="tabcontent mt-0 pt-0 px-0">
    <div class="col-12 px-0 mt-5">
        <h2 class="fw-bold">
            Barkode Kecurangan
        </h2>
    </div>
    <div class="card">
        <div class="card-body">
            <livewire:fraud-barcode-report-component />
            {{-- <div class="row">
                @foreach ($qrcode as $item)
                <?php $scan_url = "" . url('/') . "/scanning-secure/" . Crypt::encrypt($item['nomor_berkas']) . ""; ?>
                <div class="col-md-3">
                    <center>
                        <div class="card" style="background-color:white">
                            <div class="card-body">
                                <a href="{{url('/') . " /scanning-secure/" . Crypt::encrypt($item['nomor_berkas'])}}"
                                    target="_blank" rel="noopener noreferrer">
                                    {!! QrCode::size(200)->generate($scan_url); !!}
                                </a>
                            </div>
                        </div>
                    </center>
                </div>
                @endforeach
                <div class="col-lg-12">
                    <div class="row justify-content-end">
                        <div class="col-lg-2">
                            <a href="{{url('')}}/administrator/fraud-data-report"
                                class="btn btn-dark btn-block">Selengkapnya</a>
                        </div>
                    </div>
                </div>

            </div> --}}

        </div>
    </div>
</div>
<div id="bukti-kecurangan" class="tabcontent mt-0 pt-0 px-0">
    <div class="col-12 px-0 mt-5">
        <h2 class="fw-bold">
            Bukti Kecurangan
        </h2>
    </div>
    <div class="row">
        <livewire:kpu>

            <div class="col-lg-12">
                <div class="row justify-content-end">
                    <div class="col-lg-2">
                        <a href="{{url('')}}/administrator/fraud-data-print"
                            class="btn btn-dark btn-block">Selengkapnya</a>
                    </div>
                </div>
            </div>

    </div>
</div>
<div id="kecurangan-tercetak" class="tabcontent mt-0 pt-0 px-0">
    <div class="col-12 px-0 mt-5">
        <h2 class="fw-bold">
           Kecurangan Tercetak
        </h2>
    </div>
    <div class="row">
        <livewire:kpu-tercetak>

       

    </div>
</div>

<div id="fotoKecuranganterverifikasi" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bukti</h5>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <div id="container-hukum-verifikasi"></div>
            </div>
        </div>
    </div>
</div>




<script>
    $('a.fotoKecuranganterverifikasi').on('click', function () {
        let id = $(this).data('id');
        $.ajax({
            url: `{{route('superadmin.ajaxKecuranganTerverifikasi')}}`,
            type: "GET",
            data: {
                id
            },
            success: function (response) {
                if (response) {
                    $('#container-hukum-verifikasi').html(response);
                }
            }
        });
    });

</script>


<script>
    $(document).ready(function () {
        $('#responsive-datatable_info').dataTable({
            "pageLength": 50
        });
    });

</script>
@include('layouts.partials.footer')
@include('layouts.partials.scripts-bapilu')