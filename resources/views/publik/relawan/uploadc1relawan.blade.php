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
                display: block; /* Show the content on mobile devices */
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
        <div class='screen pt-5 px-3'>
            <div class="container" id="card2" style="left: 50%; top: 50%; transform: translate(-50%, -50%); position: absolute;">
                <div class="card mt-5">
                    <div class="card-header text-center text-white bg-primary">
                        <h4 class="mb-0">Upload C1 Relawan</h4>
            
                    </div>
                    <div class="card-body">
                        {{-- <div class="row justify-content-center">
                            <div class="col-lg-2">
            
            
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="#" onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="btn btn-danger">
                                        <span>
                                            <i class="fa-solid fa-right-from-bracket"></i>
                                        </span> Logout
                                    </a>
                                </form>
            
                            </div>
                        </div>
                        <x-jet-validation-errors class="mb-4" /> --}}
                        <div class="row justify-content-center">
            
                            <img src="{{asset('assets/icons/hisuara_new.png')}}" alt="Avatar" class="shadow-4 mb-3 p-2 rounded-2"
                                style="width: 175px;" />
            
                        </div>
                        <h5 class="text-center">Input C1 Relawan</h5>
                        <hr>
                        <div class="row">
            
                            <div class="col-md-12">
                                <button class="btn btn-secondary mt-3 btn-block" data-bs-toggle="modal"
                                    data-bs-target="#extralargemodal1">
                                    Upload C1 Relawan
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
                <x-jet-validation-errors />
                
            </div>
            
            
            <div class="modal fade" style="position: absolute;" id="extralargemodal1" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Input C1 Relawan</h5>
                            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
            
                        <form action="{{url('')}}/upload-relawan" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="row justify-content-center">
                                            <?php $i=1; ?>
                                            @foreach ($paslon as $item)
                                            <div class="col-lg-12 mb-2">
                                                Suara 0{{$i++}} - {{ $item['candidate']}}
                                                <input type="number" class="form-control" id="suara[]" name="suara[]" required
                                                    placeholder="Suara Paslon">
                                            </div>
                                            @endforeach
                                            <h5 class="mt-3 header-title">Foto C1</h5>
                                            <div class="col-lg-12 col-sm-12 mb-4 mb-lg-0">
                                                <input type="file" class="dropify" data-height="300" name="c1_images" />
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-for-mobile">
        <div class="container" id="card2" style="left: 50%; top: 50%; transform: translate(-50%, -50%); position: absolute;">
            <div class="card mt-5">
                <div class="card-header text-center text-white bg-primary">
                    <h4>Upload C1 Relawan</h4>
    
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
    
                        <img src="{{asset('assets/icons/hisuara_new.png')}}" alt="Avatar" class="shadow-4 mb-3 p-2 rounded-2" style="width: 175px;" />
    
                    </div>
                    <h5 class="text-center">Input C1 Relawan</h5>
                    <hr>
                    <div class="row">
    
                        <div class="col-md-12">
                            <button class="btn btn-secondary mt-3 btn-block" data-bs-toggle="modal" data-bs-target="#extralargemodal">
                                Upload C1 Relawan
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
            <x-jet-validation-errors />
        </div>
    
        <div class="modal fade" id="extralargemodal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Input C1 Relawan</h5>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
    
                    <form action="{{url('')}}/upload-relawan" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row justify-content-center">
                                    <?php $i=1; ?> 
                                    @foreach ($paslon as $item)
                                    <div class="col-lg-12 mb-2">
                                        Suara 0{{$i++}} - {{ $item['candidate']}}
                                        <input type="number" class="form-control" id="suara[]" name="suara[]" required placeholder="Suara Paslon">
                                    </div>
                                    @endforeach
                                    <h5 class="mt-3 header-title">Foto C1</h5>
                                    <div class="col-lg-12 col-sm-12 mb-4 mb-lg-0">
                                        <input type="file" class="dropify" data-height="300" name="c1_images" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
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


    <script>
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });
    </script>

</body>

</html>