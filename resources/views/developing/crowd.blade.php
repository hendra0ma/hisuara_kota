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
    <title>Crowd C1</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- SIDE-MENU CSS -->
    <link href="{{url('/')}}/assets/css/sidemenu.css" rel="stylesheet" id="sidemenu-theme">

    <!--C3.JS CHARTS CSS -->
    <link href="{{url('/')}}/assets/plugins/charts-c3/c3-chart.css" rel="stylesheet" />

    <!-- P-scroll bar css-->
    <link href="{{url('/')}}/assets/plugins/p-scroll/perfect-scrollbar.css" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="{{url('/')}}/assets/css/icons.css" rel="stylesheet" />
    <link href="{{url('/')}}/assets/css_custom.js" rel="stylesheet" />


    <!-- COLOR SKIN CSS -->

    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{url('/')}}/assets/colors/color1.css" />
    <style>
        .picture___input {
            display: none;
        }

        .picture {
            width: 300px;
            aspect-ratio: 16/9;
            background: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #aaa;
            border: 2px dashed currentcolor;
            cursor: pointer;
            font-family: sans-serif;
            transition: color 300ms ease-in-out, background 300ms ease-in-out;
            outline: none;
            overflow: hidden;
        }

        .picture:hover {
            color: #777;
            background: #ccc;
        }

        .picture:active {
            border-color: turquoise;
            color: turquoise;
            background: #eee;
        }

        .picture:focus {
            color: #777;
            background: #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .picture__img {
            max-width: 100%;
        }
    </style>

</head>

<body class="">

    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="{{url('/')}}/assets/images/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- End GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="container" id="card2" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%)">
        <div class="card mt-5">
            <div class="card-header text-center text-white bg-primary">
                <h4>Upload C1 Crowd</h4>

            </div>
            <div class="card-body">


                <div class="row justify-content-center">

                    <img src="{{asset('assets/icons/hisuara_new.png')}}" alt="Avatar" class="shadow-4 mb-3 p-2 rounded-2" style="width: 175px;" />

                </div>
                <h5 class="text-center">Input C1 Crowd</h5>
                <hr>
                <div class="row">

                    <div class="col-md-12">
                        <button class="btn btn-secondary mt-3 btn-block" data-bs-toggle="modal" data-bs-target="#extralargemodal">
                            Upload C1 Crowd
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" class="btn btn-danger">
                <span>
                    <i class="fa-solid fa-right-from-bracket"></i>
                </span> Logout
            </a>
        </form>
        <x-jet-validation-errors class="mb-4" />
    </div>


    <div class="modal fade" id="extralargemodal" tabindex="-1" role="dialog">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Input Crowd C1</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form action="{{url('')}}/c1Crowd/upload" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row justify-content-center">
                                <div class="col-lg">

                                    <h4 class="mt-3 header-title">Foto C1 Crowd</h4>
                                    <div class="col-lg-12 col-sm-12 mb-4 mb-lg-0">
                                        <div class="wrap-input100 validate-input" data-bs-validate="Password is required">
                                            <label class="form-label mt-3">Upload Foto Profile</label>
                                            <label class="picture" for="picture__input2" tabIndex="0">
                                                <span class="picture__image2"></span>
                                            </label>

                                            <input type="file" name="c1_images" id="picture__input2" class="picture___input">
                                        </div>


                                        <div class="form-group">
                                            <select class="form-control select2-show-search form-select" name="provinsi" id="provinsi">
                                                <?php
                                                $provinsi = App\Models\Province::get();
                                                ?>
                                                <option disabled selected>Pilih Provinsi</option>
                                                @foreach ($provinsi as $kc)
                                                <option value="{{ $kc->id }}">{{ $kc->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control select2-show-search form-select" name="kota" id="kota">
                                                <option disabled selected>Pilih Kota</option>
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <select class="form-control select2-show-search form-select" name="kecamatan" id="kecamatan">
                                                <option disabled selected>Pilih Kecamatan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control select2-show-search form-select" name="kelurahan" id="kelurahan">
                                                <option disabled selected>Pilih Kelurahan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control select2-show-search form-select" name="tps" id="tps">
                                                <option disabled selected>Pilih Tps</option>
                                            </select>
                                        </div>




                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Kirim C1</button>
                    </div>
                </form>
            </div>
        </div>


      
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- CUSTOM JS-->
    <script src="{{url('/')}}/assets/js/custom.js"></script>



    <script>
        @if(Session::has('success'))
        Swal.fire({
            title: 'SUCCESS!',
            text: '{{ Session::get('success') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        })
        @if(Auth::user()->role_id == "1")
            location.href = "logout_v2";
        @endif
        
        @endif


        $('#provinsi').on('change', function() {
            let idProvinsi = $(this).val();
            // console.log(idProvinsi)
            $.ajax({
                url: `{{url('')}}/getKota/${idProvinsi}`,
                method: 'get',

                success: function(response) {
                    $('#kota').html("")
                    response.forEach((item, id) => {
                        var option = $(`<option value="${item.id}">${item.name}</option>`); // Membuat elemen baru
                        $('#kota').append(option)
                    })
                    // console.log(response)
                }

            });
        })
        $('#kota').on('change', function() {
            let idKota = $(this).val();

            $.ajax({
                url: `{{url('')}}/api/public/get-district`,
                method: 'get',
                data: {
                    id: idKota
                },
                dataType: "json",
                success: function(response) {
                    $('#kecamatan').html("")
                    response.forEach((item, id) => {
                        var option = $(`<option value="${item.id}">${item.name}</option>`); // Membuat elemen baru
                        $('#kecamatan').append(option)
                    })
                }

            });

        })

        $('#kecamatan').on('change', function() {

            let idKec = $(this).val();

            $.ajax({
                url: `{{url('')}}/api/public/get-village`,
                method: 'get',
                data: {
                    id: idKec
                },
                dataType: "json",
                success: function(response) {
                    $('#kelurahan').html("")
                    console.log(response)

                    response.forEach((item, id) => {
                        var option = $(`<option value="${item.id}">${item.name}</option>`); // Membuat elemen baru
                        $('#kelurahan').append(option)
                    })

                    // console.log(response)
                }

            });
        })
        $('#kelurahan').on('change', function() {

            let idKel = $(this).val();

            $.ajax({
                url: `{{url('')}}/api/public/get-tps-by-village-id2`,
                method: 'get',
                data: {
                    village_id: idKel
                },
                dataType: "json",
                success: function(response) {
                    $('#tps').html("")
                    if (response.messages != null) {
                        var option = $(`<option disabled>Data Tps Kosong</option>`); // Membuat elemen baru
                        $('#tps').append(option)
                    }
                    $('#tps').html("<option disabled selected> Pilih TPS </option>")
                    response.forEach((item, id) => {
                        var option = $(`<option value="${item.id}">${item.number}</option>`); // Membuat elemen baru
                        $('#tps').append(option)
                    })
                    // console.log(response)
                }

            });
        })


        const inputFile2 = document.querySelector("#picture__input2");

        const pictureImage2 = document.querySelector(".picture__image2");
        // const pictureImageTxt = "Choose an image";

        pictureImage2.innerHTML = "Pilih Foto C1";

        inputFile2.addEventListener("change", function(e) {
            const inputTarget = e.target;
            const file = inputTarget.files[0];

            if (file) {
                const reader = new FileReader();

                reader.addEventListener("load", function(e) {
                    const readerTarget = e.target;

                    const img = document.createElement("img");
                    img.src = readerTarget.result;
                    img.classList.add("picture__img");

                    pictureImage2.innerHTML = "";
                    pictureImage2.appendChild(img);
                });

                reader.readAsDataURL(file);
            } else {
                pictureImage2.innerHTML = "Pilih Foto Profile";
            }
        });
    </script>

</body>

</html>