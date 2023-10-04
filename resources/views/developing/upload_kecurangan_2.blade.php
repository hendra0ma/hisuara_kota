
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
    <link rel="shortcut icon" type="image/x-icon" href="{{url('/')}}/assets/images/brand/favicon.ico" />

    <!-- TITLE -->
    <title>Rekapitung</title>
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

</head>

<body class="">

    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="{{url('/')}}/assets/images/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- End GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="container" id="card2">
        <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
        <div class="card mt-5">
            <div class="card-header text-center text-white bg-primary">
                <h4>Form Input Kecurangan</h4>
            </div>
            <div class="card-body">
               <center> 
               <div class="row mb-5">
                   <div class="col-12">
                        <div class="row justify-content-center">
                            <div class="col-3">
                                <img src="{{url('/')}}/images/logo/rekapitung_gold.png" alt="Avatar" class="hadow-4 mb-3" style="width: 157px;"  />
                                <h3 class="fw-bold">REKAPITUNG</h3>
                            </div>
                            <div class="col-3">
                                 <img src="https://jombang.bawaslu.go.id/wp-content/uploads/2019/04/Logo-Bawaslu-2018-Icon-PNG-HD.png" alt="Avatar" class="hadow-4 mb-3" style="width: 130px;"  />
                                 <h3 class="fw-bold">BAWASLU RI</h3>
                            </div>
                            <div class="col-3">
                                 <img src="https://contactmk.mkri.id/design/img/logo_mk_new.png" alt="Avatar" class="hadow-4 mb-3" style="width: 130px;"  />
                                 <h3 class="fw-bold">MAHKAMAH KONSTITUSI RI</h3>
                            </div>
                        </div>
                   </div>
               </div>
               
               
                </center>
                <h3 class="text-center fw-bold">Prosedur Laporan Kecurangan Pemilu</h3>
                <hr>
                <div class="container">
                        <p>Laporan Kecurangan Pemilu ini terintegrasi dengan sistem laporan kecurangan pada Bawaslu RI. Dimana seluruh laporan yang Anda buat dapat dilihat oleh Bawaslu RI Melalui akun Bawaslu pada Rekapitung.</p> 
                        <p>Setiap saksi yang melaporkan kecurangan akan terintegrasi langsung dengan sistem sidang online Mahkamah Konstitusi dan Anda dapat saja menjadi salah satu peserta dari sidang online Mahkamah Konstitusi tersebut <b>berdasarkan peraturan Mahkamah Konstitusi Republik Indonesia No.1 Tahun 2014 tentang pedoman beracara dalam perselisihan hasil pemilihan umum.</b></p>
                        <p>Berikut prosedur laporan kecurangan :</p>
                        
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
    </div>


    <div class="modal fade" id="extralargemodal" tabindex="-1" role="dialog">
        
<form action="action_upload_kecurangan" method="post" enctype="multipart/form-data">
    
      @csrf
               <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Laporan Kecurangan</h5>
                 
                </div>
                <div class="modal-body">
                         <x-jet-validation-errors class="mb-4" />
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
                                </div><input type="file" class="dropify" data-bs-height="180" name="foto"><button type="button" class="dropify-clear">Remove</button>
                                <div class="dropify-preview"><span class="dropify-render"></span>
                                    <div class="dropify-infos">
                                        <div class="dropify-infos-inner">
                                            <p class="dropify-filename"><span class="dropify-filename-inner"></span></p>
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
                                </div><input type="file" class="dropify" data-bs-height="180"><button type="button" class="dropify-clear">Remove</button>
                                <div class="dropify-preview"><span class="dropify-render"></span>
                                    <div class="dropify-infos">
                                        <div class="dropify-infos-inner">
                                            <p class="dropify-filename"><span class="dropify-filename-inner"></span></p>
                                            <p class="dropify-infos-message">Drag and drop or click to replace</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p>*Pilih 1  Video</p>
                        <b>Panduan Laporan : </b>
                        <p>Pilih salah satu kecurangan yang paling relevan, nyata, dan disaksikan sendiri.</p>
                    </div>
                    <br>
                     <b>Pilih TPS: </b>
                       
                    <select name="tps" id="" class="form-control">
            @foreach ($tps as $item)
            <option value="{{$item['id']}}">Tps {{$item['number']}}</option>@endforeach</select>
                    <table class="table mt-5">

                      <thead>
                            <input type="hidden" name="id_relawan">
                            <tr>
                                <td class="bg-dark text-light"></td>
                                <th class="bg-dark text-light">
                                    TAMBAHKAN JENIS PELANGGARAN UMUM (+)
                                </th>
                            </tr>
                            @foreach ($pelanggaran_umum as $item)
                            <tr>
                                <td><input type="checkbox" name="curang[]" value=" {{ $item['kecurangan'] }}" data-id="{{ $item['id'] }}" onclick="ajaxGetSolution(this)">
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
                                    TAMBAHKAN JENIS PELANGGARAN PETUGAS (+)
                                </th>
                            </tr>
                            @foreach ($pelanggaran_petugas as $item)
                            <tr>
                                <td><input type="checkbox" name="curang[]" value=" {{ $item['kecurangan'] }}" data-id="{{ $item['id'] }}" onclick="ajaxGetSolution(this)">
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
                        <thead>
                          
                        <tr>
                            <th>
                                <label for="LainnyaPetugas">lainnya</label>
                            </th>
                            <td>
                            <textarea name="kecurangan" placeholder="catatan hukum" class="form-control" cols="30" rows="10"></textarea>
                            </td>
                        </tr>

                        </thead>
                    </table>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
          </form>
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

            var extralargemodal = new bootstrap.Modal(document.getElementById('extralargemodal'), {
              keyboard: false,
              backdrop : "static"
            })
            $(document).ready(function(){
                extralargemodal.show() 
            });

        let checkBox = $('input[type=checkbox]');
        checkBox.on('click', function() {
            for (let i = 0; i < checkBox.length; i++) {
                const element = checkBox[i];
                if (element == this) {
                    continue;
                } else {
                    // (this.checked) ? $(element).attr('disabled', true): $(element).attr('disabled', false)
                }
            }
        });
        let ajaxGetSolution = function(ini) {
            let id_list = $(ini).data('id')
            if (ini.checked == true) {
                $.ajax({
                    url: "{{url('')}}/getsolution",
                    data: {
                        id_list
                    },
                    type: 'get',
                    success: function(res) {
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
