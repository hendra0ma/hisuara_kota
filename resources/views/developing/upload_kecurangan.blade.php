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
    <link rel="shortcut icon" type="image/x-icon" href="{{url('/')}}/assets/images/brand/favicon.ico" />

    <!-- TITLE -->
    <title>Hisuara</title>
    <!-- FILE UPLODE CSS -->
    <link href="{{url('/')}}/assets/plugins/fileuploads/css/fileupload.css" rel="stylesheet" type="text/css" />

    <!-- SELECT2 CSS -->

    <!-- INTERNAL Fancy File Upload css -->
    <link href="{{url('/')}}/assets/plugins/fancyuploder/fancy_fileupload.css" rel="stylesheet" />
    <!-- BOOTSTRAP CSS -->
    <link href="{{url('/')}}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="{{url('/')}}/assets/css/style.css" rel="stylesheet" />
    <link href="{{url('/')}}/assets/css/dark-style.css" rel="stylesheet" />
    <link href="{{url('/')}}/assets/css/skin-modes.css" rel="stylesheet" />

    <!-- SIDE-MENU CSS -->
    <link href="{{url('/')}}/assets/css/sidemenu.css" rel="stylesheet" id="sidemenu-theme">

    <!--C3.JS CHARTS CSS -->
    <link href="{{url('/')}}/assets/plugins/charts-c3/c3-chart.css" rel="stylesheet" />

    <!-- P-scroll bar css-->
    <link href="{{url('/')}}/assets/plugins/p-scroll/perfect-scrollbar.css" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="{{url('/')}}/assets/css/icons.css" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{url('/')}}/assets/colors/color1.css" />

    <style>
        .mobile-phone {
            margin: auto;
            margin-top: 170px;
            padding: 10px 10px 30px;
            width: 350px;
            height: 650px;
            box-shadow: 0 0 20px #000000;
            border-radius: 30px;
        }

        .screen {
            width: 100%;
            height: 100%;
            background: #f2f2f2;
            border-radius: 30px;
            overflow-y: auto;
        }

        .brove {
            width: 150px;
            height: 20px;
            background: white;
            position: absolute;
            margin: 0 100px;
            border-radius: 0 0 20px 20px;
        }

        .speaker {
            width: 60px;
            height: 5px;
            background: #d2d2d2;
            display: block;
            margin: auto;
            margin-top: 5px;
            border-radius: 20px;
        }

    </style>
</head>

<body class="">

    <div class='mobile-phone'>
        <div class='brove' style="z-index: 100"><span class='speaker'></span></div>
        <div class='screen pt-5 px-3'>

            <center>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <img src="{{asset('')}}assets/icons/hisuara_new.png" alt="Avatar"
                                    class="hadow-4 mb-3" style="width: 157px;" />
                                <h3 class="fw-bold mb-0">HISUARA</h3>
                                <h3 class="fw-bold mb-0">Selamat Datang!</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </center>
            <hr style="border: 1px solid">
                <h5 class="text-center fw-bold text-danger">Prosedur Laporan Kecurangan Pemilu</h5>
            <hr style="border: 1px solid">
            <center>
                <h4 class="text-center fw-bold">ELECTION WITNESS FRAUD TAGGING (EWFT)</h4>
                <h5 class="text-center fw-bold">36 Jenis Pelanggaran Pemilu</h5>
            </center>
            <hr>
            <div class="container">
                <p style="text-align: justify">Laporan Kecurangan Pemilu ini terintegrasi dengan sistem laporan kecurangan pada Bawaslu RI.
                    Dimana seluruh laporan yang Anda buat dapat dilihat oleh Bawaslu RI Melalui akun Bawaslu pada
                    Hisuara.</p>
                <p style="text-align: justify">Setiap saksi yang melaporkan kecurangan juga akan terintegrasi langsung dengan sidang online
                    Mahkamah Konstitusi melalui sistem Hisuara dan Anda dapat saja menjadi salah satu peserta
                    dari sidang online Mahkamah Konstitusi tersebut. <b>Berdasarkan peraturan Mahkamah Konstitusi
                        Republik Indonesia No.1 Tahun 2014 tentang pedoman beracara dalam perselisihan hasil
                        pemilihan umum,</b> bukti elektronik yang Anda kirimkan adalah alat bukti yang sah di mata
                    hukum.</p>
                <p style="text-align: justify"><b>Berikut prosedur laporan kecurangan Hisuara :</b></p>
                <ol>
                    <li>
                        Saksi diwajibkan melakukan dokumentasi kecurangan pada TPS masing-masing jika menemukan
                        bukti kecurangan.
                    </li>
                    <li>
                        Saksi dapat mengirim foto dan video kecurangan melalui form upload di bawah.
                    </li>
                    <li>
                        Saksi diwajibkan memberikan keterangan/deskripsi kecurangan yang terjadi pada kolom yang
                        tersedia.
                    </li>
                    <li>
                        Dengan mengirimkan data kecurangan TPS, nama/identitas saksi akan di rahasiakan, kecuali
                        hanya untuk keperluan hukum dan proses persidangan.
                    </li>
                </ol>
            </div>
            <div class="row">
                <button class="btn btn-secondary mt-3" data-bs-toggle="modal" data-bs-target="#extralargemodal">
                    Upload Bukti Kecurangan</button>
            </div>

            <div class="modal fade" id="extralargemodal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Laporan Kecurangan</h5>
                            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form action="#" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                            
                                @csrf
                                <div class="container-fluid">
                                    <h4 class="mt-3 header-title">Foto Kecurangan</h4>
                                    <div class="col-lg-12 col-sm-12 mb-4 mb-lg-0">
                                        <div class="dropify-wrapper">
                                            <div class="dropify-message"><span class="file-icon">
                                                    <p>Drag and drop a file here or click</p>
                                                </span>
                                                <p class="dropify-error">Ooops, something wrong appended.</p>
                                            </div>
                                            <div class="dropify-loader"></div>
                                            <div class="dropify-errors-container">
                                                <ul></ul>
                                            </div><input type="file" class="dropify" data-bs-height="180" name="foto"><button
                                                type="button" class="dropify-clear">Remove</button>
                                            <div class="dropify-preview"><span class="dropify-render"></span>
                                                <div class="dropify-infos">
                                                    <div class="dropify-infos-inner">
                                                        <p class="dropify-filename"><span class="dropify-filename-inner"></span>
                                                        </p>
                                                        <p class="dropify-infos-message">Drag and drop or click to replace</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p>*Pilih Beberapa Foto</p>
                                    <h4 class="mt-2 header-title">Video Kecurangan</h4>
                                    <div class="col-lg-12 col-sm-12 mb-4 mb-lg-0">
                                        <div class="dropify-wrapper">
                                            <div class="dropify-message"><span class="file-icon">
                                                    <p>Drag and drop a file here or click</p>
                                                </span>
                                                <p class="dropify-error">Ooops, something wrong appended.</p>
                                            </div>
                                            <div class="dropify-loader"></div>
                                            <div class="dropify-errors-container">
                                                <ul></ul>
                                            </div><input type="file" class="dropify" data-bs-height="180"><button type="button"
                                                class="dropify-clear">Remove</button>
                                            <div class="dropify-preview"><span class="dropify-render"></span>
                                                <div class="dropify-infos">
                                                    <div class="dropify-infos-inner">
                                                        <p class="dropify-filename"><span class="dropify-filename-inner"></span>
                                                        </p>
                                                        <p class="dropify-infos-message">Drag and drop or click to replace</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p>*Pilih 1 Video</p>
                                    <b>Panduan Laporan : </b>
                                    <p>Pilih salah satu kecurangan yang paling relevan, nyata, dan disaksikan sendiri.</p>
                                </div>
                                <table class="table mt-5">
                                    <thead>
                                        <input type="hidden" name="id_relawan">
                                        <tr>
                                            <td class="bg-dark text-light"></td>
                                            <th class="bg-dark text-light">
                                                TAMBAHKAN JENIS PELANGGARAN ADMINISTRASI PEMILU (+)
                                            </th>
                                        </tr>
                                        @foreach ($pelanggaran_umum as $item)
                                        <tr>
                                            <td><input type="checkbox" name="curang[]" value=" {{ $item['kecurangan'] }}"
                                                    data-id="{{ $item['id'] }}" onclick="ajaxGetSolution(this)">
                                            </td>
                                            <td><label>{{ $item['kecurangan'] }} </label></td>
                                        </tr>
                                        @endforeach
                                    </thead>
                                    <thead>
                                        <input type="hidden" name="id_relawan">
                                        <tr>
                                            <td class="bg-dark text-light"></td>
                                            <th class="bg-dark text-light">
                                                TAMBAHKAN JENIS PELANGGARAN TINDAK PIDANA (+)
                                            </th>
                                        </tr>
                                        @foreach ($pelanggaran_petugas as $item)
                                        <tr>
                                            <td><input type="checkbox" name="curang[]" value=" {{ $item['kecurangan'] }}"
                                                    data-id="{{ $item['id'] }}" onclick="ajaxGetSolution(this)">
                                            </td>
                                            <td><label>{{ $item['kecurangan'] }} </label></td>
                                        </tr>
                                        @endforeach
                                    </thead>
                                    <thead>
                                        <input type="hidden" name="id_relawan">
                                        <tr>
                                            <td class="bg-dark text-light"></td>
                                            <th class="bg-dark text-light">
                                                TAMBAHKAN JENIS PELANGGARAN KODE ETIK (+)
                                            </th>
                                        </tr>
                                        @foreach ($pelanggaran_etik as $item)
                                        <tr>
                                            <td><input type="checkbox" name="curang[]" value=" {{ $item['kecurangan'] }}"
                                                    data-id="{{ $item['id'] }}" onclick="ajaxGetSolution(this)">
                                            </td>
                                            <td><label>{{ $item['kecurangan'] }} </label></td>
                                        </tr>
                                        @endforeach
                                    </thead>
                                
                                
                                    <tbody>
                                        <tr class="bg-primary text-light">
                                            <td></td>
                                            <td>Rekomendasi Tindakan</td>
                                        </tr>
                                    </tbody>
                                    <tbody id="container-rekomendasi">
                                    
                                    </tbody>
                                    <tr>
                                        <th>
                                            <label for="LainnyaPetugas">lainnya</label>
                                        </th>
                                        <td>
                                            <textarea class="form-control" name="deskripsi" id="LainnyaPetugas"
                                                rows="3"></textarea>
                                        </td>
                                    </tr>
                                
                                    </thead>
                                </table>
                            
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary"type="button" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <!--<a href="{{url('')}}/upload_kecurangan_2" class="btn btn-danger">Demo</a>-->
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="{{url('/')}}/assets/images/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- End GLOBAL-LOADER -->

    <!-- PAGE -->
    {{-- <div class="container mt-5" id="card2">
        <div class="card">
            <div class="card-header text-center text-white bg-primary">
                <h4>Form Input Kecurangan</h4>
            </div>
            <div class="card-body">
                <center>
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="row justify-content-center">
                                <div class="col-3">
                                    <img src="{{url('/')}}/images/logo/Hisuara_gold.png" alt="Avatar"
                                        class="hadow-4 mb-3" style="width: 157px;" />
                                    <h3 class="fw-bold">Hisuara</h3>
                                </div>
                                <div class="col-3">
                                    <img src="https://jombang.bawaslu.go.id/wp-content/uploads/2019/04/Logo-Bawaslu-2018-Icon-PNG-HD.png"
                                        alt="Avatar" class="hadow-4 mb-3" style="width: 130px;" />
                                    <h3 class="fw-bold">BAWASLU RI</h3>
                                </div>
                                <div class="col-3">
                                    <img src="https://contactmk.mkri.id/design/img/logo_mk_new.png" alt="Avatar"
                                        class="hadow-4 mb-3" style="width: 130px;" />
                                    <h3 class="fw-bold">MAHKAMAH KONSTITUSI RI</h3>
                                </div>
                            </div>
                        </div>
                    </div>


                </center>
                <center>
                    <h3 class="text-center fw-bold">Prosedur Laporan Kecurangan Pemilu</h3>
                    <b class="text-center fw-bold fs-1">ELECTION WITNESS FRAUD TAGGING</b>
                    <h3 class="text-center fw-bold fs-1">(EWFT)</h3>
                    <h3 class="text-center fw-bold">36 Jenis Pelanggaran Pemilu</h3>
                </center>
                <hr>
                <div class="container">
                    <p>Laporan Kecurangan Pemilu ini terintegrasi dengan sistem laporan kecurangan pada Bawaslu RI.
                        Dimana seluruh laporan yang Anda buat dapat dilihat oleh Bawaslu RI Melalui akun Bawaslu pada
                        Hisuara.</p>
                    <p><b>Berdasarkan peraturan Mahkamah Konstitusi
                            Republik Indonesia No.1 Tahun 2014 tentang pedoman beracara dalam perselisihan hasil
                            pemilihan umum,</b> bukti elektronik yang Anda kirimkan adalah alat bukti yang sah di mata
                        hukum.</p>
                    <p><b>Berikut prosedur laporan kecurangan Hisuara :</b></p>

                    <ol>

                        <li>
                            Saksi diwajibkan melakukan dokumentasi kecurangan pada TPS masing-masing jika menemukan
                            bukti kecurangan.
                        </li>
                        <li>

                            Saksi dapat mengirim foto dan video kecurangan melalui form upload di bawah.
                        </li>
                        <li>

                            Saksi diwajibkan memberikan keterangan/deskripsi kecurangan yang terjadi pada kolom yang
                            tersedia.
                        </li>
                        <li>
                            Dengan mengirimkan data kecurangan TPS, nama/identitas saksi akan di rahasiakan, kecuali
                            hanya untuk keperluan hukum dan proses persidangan.

                        </li>
                    </ol>


                </div>

                <div class="row">
                    <button class="btn btn-secondary mt-3" data-bs-toggle="modal" data-bs-target="#extralargemodal">
                        Upload Bukti Kecurangan</button>
                </div>
            </div>
        </div>
    </div> --}}



    

    </div>




    <!-- End PAGE -->
    <!-- FILE UPLOADES JS -->
    <script src="{{url('/')}}/assets/plugins/fileuploads/js/fileupload.js"></script>
    <script src="{{url('/')}}/assets/plugins/fileuploads/js/file-upload.js"></script>
    <!-- INTERNAL File-Uploads Js-->
    <script src="{{url('/')}}/assets/plugins/fancyuploder/jquery.ui.widget.js"></script>
    <script src="{{url('/')}}/assets/plugins/fancyuploder/jquery.fileupload.js"></script>
    <script src="{{url('/')}}/assets/plugins/fancyuploder/jquery.iframe-transport.js"></script>
    <script src="{{url('/')}}/assets/plugins/fancyuploder/jquery.fancy-fileupload.js"></script>
    <script src="{{url('/')}}/assets/plugins/fancyuploder/fancy-uploader.js"></script>
    <!-- JQUERY JS -->
    <script src="{{url('/')}}/assets/js/jquery.min.js"></script>

    <!-- BOOTSTRAP JS -->
    <script src="{{url('/')}}/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="{{url('/')}}/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- SPARKLINE JS-->
    <script src="{{url('/')}}/assets/js/jquery.sparkline.min.js"></script>

    <!-- CHART-CIRCLE JS-->
    <script src="{{url('/')}}/assets/js/circle-progress.min.js"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="{{url('/')}}/assets/plugins/p-scroll/perfect-scrollbar.js"></script>

    <!-- INPUT MASK JS-->
    <script src="{{url('/')}}/assets/plugins/input-mask/jquery.mask.min.js"></script>

    <!-- CUSTOM JS-->
    <script src="{{url('/')}}/assets/js/custom.js"></script>

    <script>
        let checkBox = $('input[type=checkbox]');
        checkBox.on('click', function () {
            for (let i = 0; i < checkBox.length; i++) {
                const element = checkBox[i];
                if (element == this) {
                    continue;
                } else {
                    // (this.checked) ? $(element).attr('disabled', true): $(element).attr('disabled', false)
                }
            }
        });
        let ajaxGetSolution = function (ini) {
            let id_list = $(ini).data('id')
            if (ini.checked == true) {
                $.ajax({
                    url: "{{url('')}}/getsolution",
                    data: {
                        id_list
                    },
                    type: 'get',
                    success: function (res) {
                        $('tbody#container-rekomendasi').append(`
                        <tr class="bg-danger text-light solution${id_list}">
                            <td>
                          
                            </td>
                            <td>
                               <i class="fa-solid fa-arrow-right"></i>   ${res.solution}
                            </td>
                        </tr>
                    `)
                    }
                });
            } else {
                $(`tr.solution${id_list}`).remove();
            }
        }

    </script>

    <script>

    </script>

</body>

</html>
