<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Indikator TSM</title>
</head>
<style>
    .pages {
        position: relative;
        width: 100%;
        height: 100%;
        page-break-before: always;
        page-break-after: always;
        page-break-inside: avoid;
    }

    @media screen {
        div.divFooter {
            display: none;
        }

        body {
            display: none;
        }
    }

    @media print {
        div.divFooter {
            position: fixed;
            bottom: 0;
        }

        .stamp {
            position: fixed;
            top: 70%;
            bottom: 75%;
            left: 75%;
        }
    }
</style>

<body>



    {{-- <div class="asdf"
        style="position: relative;width:100%;height:700px;page-break-before: auto;page-break-after: always;page-break-inside: avoid;">

        <div class="row">
            <div class="col-12">
                <center>
                    <h1 class="mt-2 text-danger text-uppercase" style="font-size: 40px;">indikator kecurangan tsm
                    </h1>
                    <h3 class="mt-1 mb-1 text-uppercase">
                        INDEX TSM
                    </h3>

                    <img style="width: 350px; height: auto; margin-top:75px"
                        src="{{url('')}}/assets/images/brand/logo.png" alt="">

                    <center>
            </div>
        </div>
        <hr>

        <div class="row justify-content-center border border-dark border-3" style="align-items:center;margin-top:75px;">
            <div class="col-6 mt-2 mb-2">
                <center>

                    <img src="{{url('')}}/assets/imagesKota/{{$config->regencies_logo}}" alt="" class="img-fluid"
                        style="height: 150px;">
                </center>
            </div>

            <div class="col-6 mt-2 mb-2">
                <h3>
                    {{$kota->name }}<br>
                </h3>
            </div>
            <div class="col-12">


                <h3 class="fixed-bottom text-uppercase text-center">
                    {{$config['jenis_pemilu']}} {{$config['tahun']}} {{$kota->name }}
                </h3>

            </div>
        </div>

    </div> --}}

    <div class="asdf row"
        style="position: relative;width:100%;height:700px;page-break-before: auto;page-break-after: always;page-break-inside: avoid;">
        <div class="col-12 py-3 text-center" style="margin-top: 100px;">
            <img src="{{asset('assets/imagesKota/'. $kota->logo_kota)}}" alt="">
        </div>
        <div class="col-12 text-center">
            <h2>
                {{$kota->name }}
            </h2>
        </div>
        <div class="col-9 text-center py-3 mb-5 mt-3 mx-auto" style="border: 1px black solid">

            <h2 class="fw-bold mb-0 text-danger" style="font-size: 36px">
                INDIKATOR TSM
            </h2>

        </div>

        <div class="col-12 text-center mb-5" style="margin-top: 50px">
            <h3>JUMLAH INDIKATOR KECURANGAN : 4</h3>
        </div>

        <div class="col-12 text-center mb-5" style="margin-top: 150px">
            <img src="{{asset('')}}assets/icons/hisuara_new.png" width="350px" alt="">
        </div>

        <div class="col-12 text-center" style="position: absolute; bottom: -50px">
            <h3>PILPRES 2024 {{ $kota->name }}</h3>
        </div>

    </div>

    <div class="row mt-5"
        style="position: relative;width:100%;height:1000px;page-break-before: auto;page-break-after: always;page-break-inside: avoid;">
        <div class="col-lg-12">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <h3 class="text-uppercase mb-3 mt-3 mx-auto">
                        Pelanggaran Administrasi PEMILU
                    </h3>
                </div>
                <div class="col-lg-12">

                    <table
                        class="table table-bordered text-nowrap border-bottom dataTable no-footer table-striped table-hover"
                        id="basic-datatable" role="grid" aria-describedby="basic-datatable_info">
                        <thead class="bg-primary">
                            <tr>
                                <th class="text-white">No</th>
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
                                <td>{{substr($persen,0,4)}}%</td>
                                <td class="crop">{{ $item['kecurangan'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>



                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5"
        style="position: relative;width:100%;height:1000px;page-break-before: auto;page-break-after: always;page-break-inside: avoid;">
        <div class="col-lg-12">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <h3 class="text-uppercase mb-3 mt-3 mx-auto">
                        Pelanggaran Tindak Pidana
                    </h3>
                </div>
                <div class="col-lg-12">

                    <table
                        class="table table-bordered text-nowrap border-bottom dataTable no-footer table-striped table-hover"
                        id="basic-datatable" role="grid" aria-describedby="basic-datatable_info">
                        <thead class="bg-primary">
                            <tr>
                                <th class="text-white">No</th>
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
                                    ->where('list_kecurangan.jenis', 0)
                                    ->count();
                                $jumlahSaksi =        App\Models\Saksi::whereNull('pending')->count();
                                $persen = ($totalKec / $jumlahSaksi) * 100;

                                ?>

                                <td>{{ $i++ }}</td>
                                <td>{{substr($persen,0,4)}}%</td>
                                <td class="crop">{{ $item['kecurangan'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>



                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5"
        style="position: relative;width:100%;height:1000px;page-break-before: auto;page-break-after: always;page-break-inside: avoid;">
        <div class="col-lg-12">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <h3 class="text-uppercase mb-3 mt-3 mx-auto">
                        Pelanggaran Kode Etik
                    </h3>
                </div>
                <div class="col-lg-12">

                    <table
                        class="table table-bordered text-nowrap border-bottom dataTable no-footer table-striped table-hover"
                        id="basic-datatable" role="grid" aria-describedby="basic-datatable_info">
                        <thead class="bg-primary">
                            <tr>
                                <th class="text-white">No</th>
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
                                    ->where('list_kecurangan.jenis', 0)
                                    ->count();
                                $jumlahSaksi =        App\Models\Saksi::whereNull('pending')->count();
                                $persen = ($totalKec / $jumlahSaksi) * 100;

                                ?>

                                <td>{{ $i++ }}</td>
                                <td>{{substr($persen,0,4)}}%</td>
                                <td class="crop">{{ $item['kecurangan'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>



                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5"
        style="position: relative;width:100%;height:1000px;page-break-before: auto;page-break-after: always;page-break-inside: avoid;">
        <div class="col-lg-12">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <h3 class="text-uppercase mb-3 mt-3 mx-auto">
                        Pelanggaran Aparatur Sipil Negara (ASN)
                    </h3>
                </div>
                <div class="col-lg-12">

                    <table
                        class="table table-bordered text-nowrap border-bottom dataTable no-footer table-striped table-hover"
                        id="basic-datatable" role="grid" aria-describedby="basic-datatable_info">
                        <thead class="bg-primary">
                            <tr>
                                <th class="text-white">No</th>
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
                                    ->where('list_kecurangan.jenis', 0)
                                    ->count();
                                $jumlahSaksi =        App\Models\Saksi::whereNull('pending')->count();
                                $persen = ($totalKec / $jumlahSaksi) * 100;

                                ?>

                                <td>{{ $i++ }}</td>
                                <td>{{substr($persen,0,4)}}%</td>
                                <td class="crop">{{ $item['kecurangan'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>



                </div>
            </div>
        </div>
    </div>
    {{--
    </div>
    <div class="col-lg-12 page-break">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <h4 class="mx-auto text-uppercase">
                    Pelanggaran Tindak PIDANA
                </h4>


                <table
                    class="table table-bordered text-nowrap border-bottom dataTable no-footer table-striped table-hover"
                    role="grid" id="responsive-datatable">
                    <thead class="bg-dark">
                        <tr>
                            <th class="text-white">No</th>
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
                        $jumlahSaksi =        App\Models\Saksi::whereNull('pending')->count();
                            $persen = ($totalKec / $jumlahSaksi) * 100;
                            ?>
                            <td>{{ $i++ }}</td>
                            <td>{{substr($persen,0,4)}}%</td>
                            <td class="crop">{{ $item['kecurangan'] }}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <div class="col-lg-12 page-break">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">

                        <h4 class="mx-auto ">
                            PELANGGARAN KODE ETIK
                        </h4>

                    </div>
                    <div class="card-body">




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
                                    <td class="crop">{{ $item['kecurangan'] }}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div> <!-- Optional JavaScript; choose one of the two! -->
    <div class="col-lg-12 page-break">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">

                        <h4 class="mx-auto ">
                            PELANGGARAN APARATUR SIPIL NEGARA (PASN)
                        </h4>

                    </div>
                    <div class="card-body">




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
                                    <td class="crop">{{ $item['kecurangan'] }}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    script  
    -->
    <script>
        text = "Petugas KPPS Memotret Surat Suara Yang Telah Di Coblos Lalu Ditunjukan Pada TimSes atau Salah Satu Kandidat"
        // console.log(text.slice(0,60));
        let cropText = document.querySelectorAll('td.crop');
        for (let o = 0; o < cropText.length; o++) {
            const text = cropText[o].innerText;
            const text1 = text.slice(0, 55)
            const text2 = text.slice(55, text.length);
            cropText[o].innerHTML = `${text1} <br> ${text2}`;
        }

        window.print();

        window.onafterprint = back;

        function back() {
            window.close()
        }
    </script>
</body>

</html>