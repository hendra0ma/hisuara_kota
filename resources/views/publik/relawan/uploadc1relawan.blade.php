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
    <title>Upload C1 Relawan</title>
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
        .screen::-webkit-scrollbar {
            display: none
        }

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
            position: relative;
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

        .content-for-mobile {
            display: none;
        }

        /* Media query for mobile devices */
        @media screen and (max-width: 767px) {
            .content-for-mobile {
                display: block;
                /* Show the content on mobile devices */
            }

            .content-for-desktop {
                display: none;
            }
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
    <div class='mobile-phone content-for-desktop' style="position: relative;">
        <div class='brove' style="z-index: 100"><span class='speaker'></span></div>
        <div class='screen pt-5 px-0'>
            <div class="card">
                <div class="card-header text-center text-white bg-primary">
                    <h4 class="mb-0">Upload C1 Relawan</h4>
                </div>
                <div class="card-body px-3">

                    <div class="row">
                        <div class="px-0 col-12 text-center mb-3">
                            @if (Auth::user()->profile_photo_path == NULL)
                            <img style="width: 100px; height: 100px; object-fit: cover; margin-right: 10px;" src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&color=7F9CF5&background=EBF4FF">
                            @else
                            <img style="width: 100px; height: 100px; object-fit: cover; margin-right: 10px;" src="{{url("/storage/profile-photos/".Auth::user()->profile_photo_path) }}">
                            @endif
                        </div>
                        <div class="px-0 col-12 my-auto text-center">
                            <?php
                            $tps = App\Models\Tps::where('tps.id', '=', Auth::user()->tps_id)->first();
                            $kelurahan = App\Models\Village::where('villages.id', '=', Auth::user()->villages)->first();
                            ?>
                            <div class="mb-0 fw-bold" style="font-size: 20px">{{ Auth::user()->name }}</div>
                            <div style="font-size: 15px">NIK : {{ Auth::user()->nik }}</div>
                            <div style="font-size: 15px">SAKSI TPS {{ $tps }}</div>
                            <div style="font-size: 15px">KELURAHAN {{ $kelurahan }}</div>
                        </div>
                    </div>



                    <h1 class="text-center">
                        <img src="{{asset('')}}assets/icons/hisuara_new.png" class="hadow-4 mb-3 mt-3 rounded-2" style="width: 175px;" alt="Avatar" />
                    </h1>
                    {{-- <h5> Halo, {{Auth::user()->name}}</h5> --}}
                    <form action="{{url('')}}/upload-relawan" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row no-gutters">
                            <?php $i = 1; ?>
                            @foreach ($paslon as $item)
                            <div class="col-lg-12 mb-2">
                                Suara 0{{$i++}} - {{ $item['candidate']}}
                                <input type="number" class="form-control" id="suara[]" name="suara[]" required placeholder="Suara Paslon">
                            </div>
                            @endforeach
                            <h5 class="mt-3 header-title">Foto C1</h5>
                            <div class="col-lg-12 mt-2">
                                <div class="card ">
                                    <div class="card-header">
                                        <h5 class="card-title">Upload Foto C1</h5>
                                    </div>
                                    <div class="card-body text-center">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h1>
                                                    <a type="button ">
                                                        <i class="mdi mdi-camera"></i>
                                                    </a>
                                                </h1>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="file" class="dropify" data-height="300" name="c1_images" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid gap-2 col-lg-12">
                                <input type="submit" class="btn btn-block btn-primary mt-2">
                            </div>

                        </div>
                    </form>
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <a href="#" class="mt-3" onclick="this.closest('form').submit();">
                            Sign out
                        </a>
                    </form>
                </div>
            </div>
            {{-- <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" class="btn btn-danger">
                <span>
                    <i class="fa-solid fa-right-from-bracket"></i>
                </span> Logout
            </a>
            </form> --}}
            {{-- <x-jet-validation-errors /> --}}

        </div>
    </div>

    <div class="content-for-mobile">
        <div class="card">
            <div class="card-header text-center text-white bg-primary">
                <h4 class="mb-0">Upload C1 Relawan</h4>
            </div>
            <div class="card-body px-3">

                <div class="row">
                    <div class="px-0 col-12 text-center mb-3">
                        @if (Auth::user()->profile_photo_path == NULL)
                        <img style="width: 100px; height: 100px; object-fit: cover; margin-right: 10px;" src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&color=7F9CF5&background=EBF4FF">
                        @else
                        <img style="width: 100px; height: 100px; object-fit: cover; margin-right: 10px;" src="{{url("/storage/profile-photos/".Auth::user()->profile_photo_path) }}">
                        @endif
                    </div>
                    <div class="px-0 col-12 my-auto text-center">
                        <?php
                        $tps = App\Models\Tps::where('tps.id', '=', Auth::user()->tps_id)->first();
                        $kelurahan = App\Models\Village::where('villages.id', '=', Auth::user()->villages)->first();
                        ?>
                        <div class="mb-0 fw-bold" style="font-size: 20px">{{ Auth::user()->name }}</div>
                        <div style="font-size: 15px">NIK : {{ Auth::user()->nik }}</div>
                        <div style="font-size: 15px">SAKSI TPS {{ $tps }}</div>
                        <div style="font-size: 15px">KELURAHAN {{ $kelurahan }}</div>
                    </div>
                </div>



                <h1 class="text-center">
                    <img src="{{asset('')}}assets/icons/hisuara_new.png" class="hadow-4 mb-3 mt-3 rounded-2" style="width: 175px;" alt="Avatar" />
                </h1>
                {{-- <h5> Halo, {{Auth::user()->name}}</h5> --}}
                <form action="{{url('')}}/upload-relawan" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row no-gutters">
                        <?php $i = 1; ?>
                        @foreach ($paslon as $item)
                        <div class="col-lg-12 mb-2">
                            Suara 0{{$i++}} - {{ $item['candidate']}}
                            <input type="number" class="form-control" id="suara[]" name="suara[]" required placeholder="Suara Paslon">
                        </div>
                        @endforeach
                        <h5 class="mt-3 header-title">Foto C1</h5>
                        <div class="col-lg-12 mt-2">
                            <div class="card ">
                                <div class="card-header">
                                    <h5 class="card-title">Upload Foto C1</h5>
                                </div>
                                <div class="card-body text-center">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h1>
                                                <a type="button ">
                                                    <i class="mdi mdi-camera"></i>
                                                </a>
                                            </h1>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="file" class="dropify" data-height="300" name="c1_images" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2 col-lg-12">
                            <input type="submit" class="btn btn-block btn-primary mt-2">
                        </div>

                    </div>
                </form>
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    <a href="#" class="mt-3" onclick="this.closest('form').submit();">
                        Sign out
                    </a>
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

    <!-- CUSTOM JS-->
    <script src="{{url('/')}}/assets/js/custom.js"></script>

    <script src="{{url('/')}}/assets/js_custom.js"></script>

    </body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php if ($data_relawan != null) { ?>

            $(document).ready(function() {

                $('body').html("")

                Swal.fire({
                    title: 'Error!',
                    text: 'Anda sudah memasukan data C1 Relawan',
                    icon: 'error',
                    confirmButtonText: "Okay",
                }).then((result)=>{
                    location.href = "{{(url(''))}}/logout_v2"
                })
            })

            
            
            
            <?php } ?>

            @if(Session::has('success'))

                $(document).ready(function() {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Terima Kasih telah memasukan data C1',
                        icon: 'success',
                        confirmButtonText: "Okay",
                    }).then((result)=>{
                        location.href = "{{(url(''))}}/logout_v2"
                    })
                })

            @endif

            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop a file here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong happended.'
                }
            });
    </script>


</html>