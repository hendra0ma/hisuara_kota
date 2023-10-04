<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Zanex – Bootstrap  Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords" content="admin, dashboard, dashboard ui, admin dashboard template, admin panel dashboard, admin panel html, admin panel html template, admin panel template, admin ui templates, administrative templates, best admin dashboard, best admin templates, bootstrap 4 admin template, bootstrap admin dashboard, bootstrap admin panel, html css admin templates, html5 admin template, premium bootstrap templates, responsive admin template, template admin bootstrap 4, themeforest html">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/images/brand/favicon.ico" />

    <!-- TITLE -->
    <title>Zanex – Bootstrap Admin & Dashboard Template</title>

    <!-- BOOTSTRAP CSS -->
    <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        @media screen {
            div.divFooter {
                display: none;
            }
        }

        @media print {
            div.divFooter {
                position: fixed;
                bottom: 0;
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

    <div class="asdf" style="position: relative;width:100%;height:100%;page-break-before: auto;page-break-after: auto;page-break-inside: avoid;">

        <div class="row">
            <div class="col-12">
                <center>
                    <h1 class="mt-2 text-danger text-uppercase" style="font-size: 40px;">bukti kecurangan rekapitung
                    </h1>
                    <h3 class="mt-1 mb-1">
                        NO BERKAS : {{ $qrcode['nomor_berkas'] }}
                    </h3>

                    <img style="width: 350px; height: auto; margin-top:75px" src="https://www.pngitem.com/pimgs/m/22-229723_fancy-badge-transparent-circle-logo-template-hd-png.png" alt="">

                    <center>
            </div>
        </div>


        <div class="row justify-content-center border border-dark" style="align-items:center;height:100%;margin-top:75px">
            <?php $scan_url = "" . url('/') . "/scanning-secure/" . Crypt::encrypt($qrcode['nomor_berkas']) . ""; ?>
            <div class="col-6">
                {!! QrCode::size(200)->generate($scan_url); !!}
            </div>

            <div class="col-6">

                <h3>
                    {{$kota['name'] }}<br>
                    kec
                    {{$kecamatan['name']}} / Kel
                    {{$kelurahan['name']}} <br>
                </h3>
                <h2 class="text-danger" style="font-size:40px">TPS {{ $tps['number'] }} <br></h2>

            </div>
        </div>

    </div>

    <div style="width:100%;height:100%;page-break-before: auto;page-break-after: auto;page-break-inside: avoid;">
        <center>
            <h1 class="mt-2 text-danger">DOKUMEN REKAPITUNG</h1>
            <center>
                <h2 style="margin-top : -5px;text-transform:uppercase;">Berkas Laporan Kecurangan</h2>
                <h3 style="margin-top : -10px;text-transform:uppercase;"> {{$config['jenis_pemilu']}}   {{$config['jenis_pemilu']}}</h3>
            </center>
        </center>
        <div style="margin-left: 10px;">
            NO BERKAS : {{ $qrcode['nomor_berkas'] }}
        </div>
        <center>

            <hr />

            <center>
                <h4>
                    Kota Tanggerang Selatan - Kecamatan
                    {{$kecamatan['name']}} - Kelurahan
                    {{$kelurahan['name']}}- TPS
                    TPS {{ $tps['number'] }} <br>
                </h4>
            </center>
            <hr />
            <br />

            <table class="table table-bordered">
                <tr>
                    <td colspan="4" class="font-weight-bold">
                        <center>Data Saksi</center>
                    </td>
                    <td colspan="4" class="font-weight-bold">
                        <center>Data Verivikator</center>
                    </td>
                    <td colspan="4" class="font-weight-bold">
                        <center>Data Admin Hukum</center>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">Nama</td>
                    {{$user['name']}}
                    <td colspan="2">Nama</td>
                    {{ $verifikator['name'] }}
                    <td colspan="2">Nama</td>
                    {{ $hukum['name'] }}
                </tr>

                <tr>
                    <td colspan="2">No wa</td>
                    {{$user['no_hp']}}
                    <td colspan="2">No wa</td>
                    {{ $verifikator['no_hp']}}
                    <td colspan="2">No wa</td>
                    {{ $hukum['no_hp'] }}
                </tr>

                <tr>
                    <td colspan="2">Kecamatan</td>
                    {{$kecamatan['name']}}
                    <td colspan="2">Tanggal Input</td>
                    {{ $qrcode['created_at'] }}
                    <td colspan="2">Tanggal Print</td>
                    <td colspan="2  "> {{ date("d - M - Y") }}</td>
                </tr>
            </table>
            <table class="table">
                <tr>
                    <td class="font-weight-bold text-center bg-dark text-light">
                        Daftar Kecurangan
                    </td>
                </tr>
                @foreach ($list_kecurangan as $item)
                <tr>
                    <td>{{ $item['text'] }} </td>
                </tr>
                @endforeach
                <tr>
                    <td class="font-weight-bold text-center bg-dark text-light">
                        Rekomendasi Tindakan
                    </td>
                </tr>
                <tbody id="appendDataSolution">

                </tbody>

                <script>



                </script>
            </table>
        </center>
    </div>

    <div style="width:100%;height:100%;page-break-before: auto;page-break-after: auto;page-break-inside: avoid;">
        <table style="table-layout: fixed;" class="table text-center">
            <thead>
                <tr>
                    <td width="350px">Bukti Foto</td>
                    <td>Bukti Video</td>
                </tr>
            </thead>
            <tbody>
                @if ($databukti['bukti'] == "1")
                <tr>
                    <td>V</td>
                    <td>X</td>
                </tr>
                <tr>
                    <td>
                        @foreach ($foto_kecurangan as $foto)
                        <img style="width: 100%; height: auto" class="d-block w-100" alt="" src="{{asset('storage\hukum\bukti_foto')}}\{{ $foto['url'] }}" data-bs-holder-rendered="true">
                        @endforeach
                    </td>
                </tr>


                @elseif($databukti['bukti'] == "2")
                <tr>
                    <td>X</td>
                    <td>V</td>
                </tr>
                <tr>
                    <td>Bukti Vidio</td>
                    <td>{{asset('storage\hukum\bukti_video/'.$vidio_kecurangan['url'])}}</td>
                </tr>
                @else
                <tr>
                    <td>V</td>
                    <td>V</td>
                </tr>
                <tr>
                    <td>@foreach ($foto_kecurangan as $foto)
                        <img class="d-block w-100" alt="" src="{{asset('storage\hukum\bukti_foto')}}\{{ $foto['url'] }}" data-bs-holder-rendered="true">
                        @endforeach
                    </td>
                    <td>
                        {{asset('storage\hukum\bukti_video/'.$vidio_kecurangan['url'])}}
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="page-content-wrapper" style="width:100%;height:100%;page-break-before: auto;page-break-after: auto;page-break-inside: avoid;">
        <div class="row mt-2">
            <div class="container">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h3 class="text-center"><u>SURAT PERNYATAAN</u></h3>
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
                                                <td>{{$user['nik']}}</td>
                                            </tr>
                                            <tr>
                                                <td>Nama</td>
                                                <td>:</td>
                                                <td>{{$user['name']}}</td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td>:</td>
                                                <td>{{$user['address']}}</td>
                                            </tr>
                                            <tr>
                                                <td>No Hp</td>
                                                <td>:</td>
                                                <td>{{$user['no_hp']}}</td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>:</td>
                                                <td>{{$user['email']}}</td>
                                            </tr>
                                            <tr>
                                                <td>Kecamatan</td>
                                                <td>:</td>
                                                <td>{{ $kecamatan['name'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>Kelurahan</td>
                                                <td>:</td>
                                                <td>{{ $kelurahan['name'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>TPS</td>
                                                <td>:</td>
                                                <td>{{ $tps['number'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>Kota</td>
                                                <td>:</td>

                                                <td class="text-capitalize">{{ $kota['name'] }}</td>

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
                                        <p class="mt-5"><u> {{$user['name']}}</u></p>
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
        </div>
    </div>

    <div class="divFooter">{{ $qrcode['nomor_berkas'] }}</div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
    </script>
    <script>
        setTimeout(function() {
            let uniqueData = [@foreach($list_kecurangan as $item)
                '{{$item->solution}} | {{$item->kode}}', @endforeach
            ];

            uniqueArray = uniqueData.filter(function(item, pos) {
                return uniqueData.indexOf(item) == pos;
            });
            uniqueArray.forEach(function(item, index) {
                $('#appendDataSolution').append(`
        <tr>
            <td>
                ${item}    
            </td>
        </tr>
        `)
            });
        }, 200)



        setTimeout(function() {

            window.print();
            window.onafterprint = back;

            function back() {
                window.close()
            }

        }, 400)
    </script>
</body>

</html>