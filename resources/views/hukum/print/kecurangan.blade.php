<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Zanex – Bootstrap  Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
        content="admin, dashboard, dashboard ui, admin dashboard template, admin panel dashboard, admin panel html, admin panel html template, admin panel template, admin ui templates, administrative templates, best admin dashboard, best admin templates, bootstrap 4 admin template, bootstrap admin dashboard, bootstrap admin panel, html css admin templates, html5 admin template, premium bootstrap templates, responsive admin template, template admin bootstrap 4, themeforest html">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/images/brand/favicon.ico" />

    <!-- TITLE -->
    {{-- <title>Laporan Kecurangan {{ $qrcode->nomor_berkas }}</title> --}}

    <!-- BOOTSTRAP CSS -->
    <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        body {
            font-size: 18px
        }

        .page-break {
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
                bottom: 0px;
                top: 75%;
                left: 75%;

            }
        }

        @media print {
            section.vendorListHeading {
                background-color: #fff !important;
                -webkit-print-color-adjust: exact;
            }
        }

        @media print {
            .vendorListHeading p {
                color: white !important;
            }
        }
    </style>
</head>

<body>


    <div class="asdf" style="position: relative;width:100%;height:100%;">

        {{-- <img src="{{asset('')}}assets/stamp.png" class="img-flluid stamp"
            style="width:150px;height:auto; z-index: 2000;" alt=""> --}}
        <div class="row">
            <div class="col-12">
                <center>
                    <h1 class="mt-2 text-danger text-uppercase" style="font-size: 40px;">bukti kecurangan rekapitung
                    </h1>
                    <h5 class="mt-1 mb-1">
                        NO BERKAS : {{ $qrcode->nomor_berkas }}
                    </h5>

                    <img style="width: 350px; height: auto; margin-top:75px"
                        src="{{url('/')}}/images/logo/rekapitung_gold.png" alt="">

                    <center>
            </div>
        </div>


        <div class="row justify-content-center border border-dark"
            style="align-items:center;height:100%;margin-top:75px">
            <?php $scan_url = url('') . "/scanning-secure/" . (string)Crypt::encrypt($qrcode->nomor_berkas); ?>
            <div class="col-6">
                {!! QrCode::size(200)->generate( $scan_url); !!}
            </div>
            <div class="col-6">

                <h5>
                    {{$kota->name }}<br>
                    kec
                    {{$kecamatan->name}} / Kel
                    {{$kelurahan->name}} <br>
                </h5>
                <h2 class="text-danger" style="font-size:40px">TPS {{ $tps->number }} <br></h2>

            </div>
        </div>

    </div>


    <div style="width:100%;height:100%;" class="page-break">
        <div class="col-12 px-0 py-0 mb-3">
            <div class="card">
                <div class="card-header" style="border: 1px #eee solid !important; background-color: #eee">
                    <h5 class="mb-0 card-title">1. Daftar Laporan Kecurangan</h5>
                </div>
                <div class="card-body" style="border: 1px #eee solid !important">
                    <ul class="list-group">
                        @foreach ($list_kecurangan as $item)
                        <li class="list-group-item">{{ $item->text }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 px-0 py-0 mb-3">
            <div class="card">
                <div class="card-header" style="border: 1px #eee solid !important; background-color: #eee">
                    <h5 class="mb-0 card-title">2. Rekomendasi Tindakan</h5>
                </div>
                <div class="card-body" style="border: 1px #eee solid !important">
                    <ul class="list-group" id="appendDataSolution">

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 px-0 py-0 mb-3">
            <div class="card">
                <div class="card-header" style="border: 1px #eee solid !important; background-color: #eee">
                    <h5 class="mb-0 card-title">3. Pelapor dan Pemeriksa</h5>
                </div>
                <div class="card-body" style="border: 1px #eee solid !important">
                    <table class="table table-bordered">
                        <tr>
                            <td class="fw-bold">
                                <div class="text-center">Petugas Saksi</div>
                            </td>
                            <td class="fw-bold">
                                <div class="text-center">Petugas Verifikator</div>
                            </td>
                            <td class="fw-bold">
                                <div class="text-center">Petugas Validasi Kecurangan</div>
                            </td>
                        </tr>
                        <tr>
                            <td> {{$user->name}}</td>
                            <td> {{ $verifikator->name }}</td>
                            <td> {{ $hukum->name }}</td>
                        </tr>
                        <tr>
                            <td> {{$user->no_hp}}</td>
                            <td> {{ $verifikator->no_hp}}</td>
                            <td> {{ $hukum->no_hp }}</td>
                        </tr>
                    </table>
                    <table class="table table-bordered">
                        <tr>
                            <td class="fw-bold">
                                <div class="text-center">Tanggal Dokumen</div>
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="2" class="align-middle text-center"> {{ $qrcode->created_at }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        {{-- <center>
            <h1 class="mt-2 text-danger">DOKUMEN REKAPITUNG</h1>
            <center>
                <h2 style="margin-top : -5px;text-transform:uppercase;">Berkas Laporan Kecurangan</h2>
                <h5 style="margin-top : -10px;text-transform:uppercase;">Pilpres 2024</h5>
            </center>
        </center>
        <div class="text-center">
            NO BERKAS : {{ $qrcode->nomor_berkas }}
        </div>
        <center>

            <hr />
            <center>
                <h4>
                    Kota Tanggerang Selatan - Kecamatan
                    {{$kecamatan->name}} - Kelurahan
                    {{$kelurahan->name}}- TPS
                    TPS {{ $tps->name }} <br>
                </h4>
            </center>
            <hr />
            <br />

            <table class="table table-bordered">
                <tr>
                    <td class="font-weight-bold">
                        <div class="text-center">Petugas Saksi</div>
                    </td>
                    <td class="font-weight-bold">
                        <div class="text-center">Petugas Verifikator</div>
                    </td>
                    <td class="font-weight-bold">
                        <div class="text-center">Petugas Validasi Kecurangan</div>
                    </td>
                    <td class="font-weight-bold">
                        <div class="text-center">Tanggal</div>
                    </td>
                </tr>
                <tr>
                    <td> {{$user->name}}</td>
                    <td> {{ $verifikator->name }}</td>
                    <td> {{ $hukum->name }}</td>
                    <td rowspan="2" class="align-middle text-center"> {{ $qrcode->created_at }} </td>
                </tr>
                <tr>
                    <td> {{$user->no_hp}}</td>
                    <td> {{ $verifikator->no_hp}}</td>
                    <td> {{ $hukum->no_hp }}</td>
                </tr>
            </table>
            <table class="table">

                <tr>
                    <td class="font-weight-bold text-danger fw-bolder">
                        Daftar Kecurangan
                    </td>
                </tr>
                @foreach ($list_kecurangan as $item)
                <tr>
                    <td>{{ $item->text }} </td>
                </tr>
                @endforeach
                <tr>
                    <td class="font-weight-bold text-danger fw-bolder border-0">
                        Rekomendasi Tindakan
                    </td>
                </tr>
                <tbody id="appendDataSolution">

                </tbody>

                <script>



                </script>
            </table>
        </center> --}}
    </div>

    <div style="width:100%;height:100%;">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/exif-js"></script>
                        <table class="table">
                            <tr>
                                <td>
                                    <h3>Bukti Foto</h3>
                                </td>
                                <td>
                                    <h3>Metadata</h3>
                                </td>
                            </tr>
                            @foreach ($foto_kecurangan as $bf)
                            <tr>
                                <td>
                                    <img class="w-100 image" src="{{asset('storage/' . $bf->url)}}" data-url="{{asset('storage/' . $bf->url)}}"
                                        alt="">
                                </td>
                                <td class="exifResults">
                        
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <script>
                            $(document).ready(function () {
                                $(".image").each(function (index) {
                                    var currentImage = this;

                                    EXIF.getData(currentImage, function () {
                                        var dateTaken = EXIF.getTag(this, "DateTimeOriginal");
                                        var result = $("<p>").text(
                                            " - Date taken: " + (dateTaken ? dateTaken : "Date taken not found")
                                        );
                                        $(currentImage).closest('tr').find('.exifResults').html(result);
                                    });
                                });
                            });
                        </script>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-6">

                        <div class="card">
                            <div class="card-header" style="border: 1px #eee solid !important">
                                <h5 class="card-title">Bukti Foto</h5>
                            </div>
                            <div class="card-body" style="border: 1px #eee solid !important">
                                <div class="row">
                                    @foreach ($foto_kecurangan as $bf)
                                    <div class="col-12 mt-1">
                                        <center>
                                            <img class="image my-1" style="width: 250px" src="{{asset('storage/' . $bf->url)}}"
                                                data-url="{{asset('storage/' . $bf->url)}}" alt="">
                                        </center>
                                    </div>
                                    @endforeach
                                    <div id="metadataDisplay"></div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-6">
                        <div class="card">
                            <div class="card-header" style="border: 1px #eee solid !important">
                                <h5 class="card-title">Metadata</h5>
                            </div>
                            <div class="card-body" style="border: 1px #eee solid !important">

                            </div>
                        </div>
                    </div>

                </div> --}}
            </div>
        </div>
        {{-- <table style="table-layout: fixed;" class="table text-center">
            <thead>
                <tr>
                    <td width="350px">Bukti Foto</td>
                    <td>Bukti Video</td>
                </tr>
            </thead>
            <tbody>
                @if ($databukti->bukti == "1")
                <tr>
                    <td>V</td>
                    <td>X</td>
                </tr>
                <tr>
                    <td>
                        @foreach ($foto_kecurangan as $foto)
                        <img style="width: 70%; height: auto" class="d-block w-100" alt=""
                            src="{{url('')}}/storage/{{ $foto->url }}" data-bs-holder-rendered="true">
                        @endforeach
                    </td>
                </tr>


                @elseif($databukti->bukti == "2")
                <tr>
                    <td>X</td>
                    <td>V</td>
                </tr>
                <tr>
                    <td>Bukti Vidio</td>
                    <td>{!! QrCode::size(200)->generate( $scan_url); !!}</td>
                </tr>
                @else
                <tr>
                    <td>V</td>
                    <td>V</td>
                </tr>
                <tr>
                    <td>@foreach ($foto_kecurangan as $foto)
                        <img class="d-block w-100" alt="" src="{{url('')}}/storage/{{ $foto->url }}"
                            data-bs-holder-rendered="true">
                        @endforeach
                    </td>
                    <td>
                        {!! QrCode::size(200)->generate( $scan_url); !!}
                    </td>
                </tr>
                @endif
            </tbody>
        </table> --}}
    </div>
    <div class="page-content-wrapper page-break">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header" style="border: 1px #eee solid !important">
                        <h5 class="card-title">Bukti Video</h5>
                    </div>
                    <div class="card-body" style="border: 1px #eee solid !important">
                        <div class="mx-auto">
                            <center>{!! QrCode::size(200)->generate( $scan_url); !!}</center>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header" style="border: 1px #eee solid !important">
                        <h5 class="card-title">Metadata</h5>
                    </div>
                    <div class="card-body" style="border: 1px #eee solid !important">
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- @foreach ($foto_kecurangan as $foto)

    <img style="width:100%;" class="d-block page-break" alt="" src="{{url('')}}/storage/{{ $foto->url }}"
        data-bs-holder-rendered="true">

    @endforeach --}}


    <div class="page-content-wrapper page-break" style="width:100%;height:100%;">
        <div class="col-12">

            <div class="row mt-2">

                <div class="container">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <h5 class="text-center"><u>SURAT PERNYATAAN</u></h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12">

                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-lg-12">
                                <div class="col-lg-6">
                                    <h6>Yang bertanda tangan dibawah ini :</h6>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="col-lg-12 mb-2">
                                    <table class="w-100">
                                        <tr>
                                            <td style="width: 85px">NIK</td>
                                            <td>:</td>
                                            <td> {{$user->nik}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 85px">Nama</td>
                                            <td>:</td>
                                            <td> {{$user->name}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 85px">Alamat</td>
                                            <td>:</td>
                                            <td> {{$user->address}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 85px">No Hp</td>
                                            <td>:</td>
                                            <td> {{$user->no_hp}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 85px">Email</td>
                                            <td>:</td>
                                            <td>{{$user->email}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 85px">Kecamatan</td>
                                            <td>:</td>
                                            <td>{{ $kecamatan->name }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 85px">Kelurahan</td>
                                            <td>:</td>
                                            <td>{{ $kelurahan->name }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 85px">TPS</td>
                                            <td>:</td>
                                            <td>{{ $tps->number }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 85px">Kota</td>
                                            <td>:</td>
                                            <td class="text-capitalize">{{ $kota->name }}</td>

                                        </tr>
                                    </table>

                                </div>
                            </div>

                        </div>
                        <div class="row mt-5">
                            <div class="col-lg-12">
                                <div class="col-lg-12 text-justify" style="line-height:1.8">
                                    {{$surat_pernyataan->deskripsi}}
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-lg-12">
                                <div class="col-lg-12">
                                    <b>Tanggal Kirim </b>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-11">
                                <div class="col-lg-12 text-left">
                                    <p>Yang Membuat Pernyataan Ini:</p>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-11">
                                <div class="col-lg-12 text-left">
                                    <p class="mt-5"><u> {{$user->name}}</u></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="mb-3 text-center mt-2">
                    <i>Laporan Ini Dicetak Oleh Komputer Dan Tidak Memerlukan Tanda Tangan.
                        Berkas Terlampir</i>
                </p>
            </div>

        </div>
        {{-- <div class="row mt-2">
            <div class="container">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5 class="text-center"><u>SURAT PERNYATAAN</u></h5>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12">

                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-lg-12">
                                    <div class="col-lg-6">
                                        <h6>Yang bertanda tangan dibawah ini :</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">

                                    <div class="col-lg-12 mb-2">
                                        <table>
                                            <tr>
                                                <td>NIK</td>
                                                <td>:</td>
                                                <td>{{$user->nik}}</td>
                                            </tr>
                                            <tr>
                                                <td>Nama</td>
                                                <td>:</td>
                                                <td>{{$user->name}}</td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td>:</td>
                                                <td>{{$user->address}}</td>
                                            </tr>
                                            <tr>
                                                <td>No Hp</td>
                                                <td>:</td>
                                                <td>{{$user->no_hp}}</td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>:</td>
                                                <td>{{$user->email}}</td>
                                            </tr>
                                            <tr>
                                                <td>Kecamatan</td>
                                                <td>:</td>
                                                <td>{{ $kecamatan->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Kelurahan</td>
                                                <td>:</td>
                                                <td>{{ $kelurahan->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>TPS</td>
                                                <td>:</td>
                                                <td>{{ $tps->number }}</td>
                                            </tr>
                                            <tr>
                                                <td>Kota</td>
                                                <td>:</td>

                                                <td class="text-capitalize">{{ $kota->name }}</td>

                                            </tr>
                                        </table>

                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-lg-12 text-justify" style="line-height:1.8">
                                        <p>
                                            Dengan ini menyatakan bahwa saya siap bertanggung jawab atas data dan
                                            bukti-bukti yang saya kirimkan dari TPS tempat saya bertugas dan bisa
                                            dipertanggung jawabkan kebenaranya.
                                        </p>
                                        <p>
                                            Saya bersedia hadir untuk memberikan keterangan sebagai saksi pada
                                            pihak-pihak terkait jika diperlukan. Demikian pernyataan ini dibuat dalam
                                            keadaan sadar sehat jasmani raohani serta tidak ada paksaan dari pihak
                                            manapun.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-lg-12">
                                    <div class="col-lg-12">
                                        <b>Tanggal Kirim </b>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-11">
                                    <div class="col-lg-12 text-left">
                                        <p>Yang Membuat Pernyataan Ini:</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-11">
                                    <div class="col-lg-12 text-left">
                                        <p class="mt-5"><u> {{$user->name}}</u></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="mb-3 text-center mt-2">
                        <i>Laporan Ini Dicetak Oleh Komputer Dan Tidak Memerlukan Tanda Tangan.
                            Berkas Terlampir</i>
                    </p>
                </div>
            </div>
        </div> --}}
    </div>

    <div class="row page-content-wrapper page-break">
        <div class="col-md-12 mb-2">
            <h1 class="fs-3 text-center"> Lampiran C1</h1>
        </div>
        <div class="col-md-12">
            <img alt="" class="d-block mx-auto" style="width: 90%; height: 90%;" src="{{url('')}}/storage/{{ $saksi->c1_images }}"
                data-bs-holder-rendered="true">
        </div>
    </div>



    {{-- <div class="divFooter" style="font-size: 18px">{{ $qrcode->nomor_berkas }} <br /> <small class="text-danger">
            Dokumen ini telah dihasilkan
            dari rekapitung.id dengan nomor berkas : {{ $qrcode->nomor_berkas }}
            Untuk Paslon Muhammad - Saraswati. Hasil cetak dokumen ini dapat diverifikasi berdasarkan kode
            barcode di rekapitung.id </small> </div> --}}

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
    </script>
    <script>
        setTimeout(function () {
            let uniqueData = [@foreach($list_kecurangan as $item)
                '{{$item->solution}} | {{$item->kode}}', @endforeach
            ];

            uniqueArray = uniqueData.filter(function (item, pos) {
                return uniqueData.indexOf(item) == pos;
            });
            uniqueArray.forEach(function (item, index) {
                $('#appendDataSolution').append(`
        <tr>
            <td>
                ${item}    
            </td>
        </tr>
        `)
            });
        }, 200)



        setTimeout(function () {

            window.print();
            window.onafterprint = back;

            function back() {
                window.close()
            }

        }, 400)

    </script>
</body>

</html>