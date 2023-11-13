<!DOCTYPE html>
<!--Codingthai.com-->
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous" />
    <!-- <link rel="stylesheet" href="style.css" /> -->
    <title>Upload C1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!--- FONT-ICONS CSS -->
    <link href="{{url('/')}}/assets/css/icons.css" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{url('/')}}/assets/colors/color1.css" />
    <style>
        @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');


        /* .phone {
            border-radius: 15px;
            height: 600px;
            width: 340px;
        } */

        .phone .content {
            display: none;
            object-fit: cover;
            /* position: absolute; */
            /* top: 0; */
            /* left: 0; */
            /* height: calc(100% - 60px); */
            /* width: 100%; */
            transition: opacity 0.4s ease;
        }

        .phone .content.show {
            display: block;
        }

        nav {
            position: absolute;
            bottom: 0;
            left: 0;
            margin-top: -5px;
            width: 100%;
        }

        nav ul {
            background-color: #fff;
            display: flex;
            list-style-type: none;
            padding: 0;
            margin: 0;
            height: 60px;
        }

        nav li {
            color: #777;
            cursor: pointer;
            flex: 1;
            padding: 10px;
            text-align: center;
        }

        nav ul li p {
            font-size: 12px;
            margin: 2px 0;
        }

        nav ul li:hover,
        nav ul li.active {
            color: #8e44ad;
        }

        .mobile-phone {
            margin: auto;
            margin-top: 120px;
            margin-bottom: 120px;
            padding: 10px 10px 30px;
            width: 350px;
            height: 650px;
            box-shadow: 0 0 20px #000000;
            border-radius: 30px;
            position: relative;
        }

        .screen {
            padding-top: 20px;
            width: 100%;
            height: 100%;
            background: #f2f2f2;
            border-radius: 30px;
            overflow-y: auto;
            padding-bottom: 60px;
        }

        .screen::-webkit-scrollbar {
            display: none
        }

        .brove {
            width: 150px;
            height: 20px;
            background: white;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
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

        .nav-on-desktop {
            position: absolute;
            /* width: 100%; */
            bottom: 30px;
        }

        /* Default style: hide the content for desktop */
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
    @livewireStyles
</head>

<body>

    <div class='mobile-phone content-for-desktop'>
        <div class='brove' style="z-index: 100"><span class='speaker'></span></div>
        <div class='screen'>
            <div class="phone">
                @if (Auth::user()->absen == "hadir")
                @else
                <div alt="home" class="content show">
                    <livewire:absensi-saksi>
                </div>
                @endif
                <div alt="work" class="content {{Auth::user()->absen == 'hadir'?'show':''}}">

                    <?php
                        $cekSaksi = App\Models\Saksi::where('tps_id', Auth::user()->tps_id)->count('id'); ?>
                    @if( $cekSaksi == null)

                    <livewire:upload-c1>

                    @else
                    <div class="container mt-3">
                        <div class="row">
                            <div class="col-lg">
                                <div class="card border-0 shadow">
                                    <div class="card-body text-center">
                                        <h3>
                                            Terima Kasih telah mengirim data C1.
                                        </h3>
                                        <form action="{{route('logout')}}" method="post" class="py-2 pe-2 ps-3">
                                            @csrf
                                            <div class="d-grid gap-2 mx-auto">
                                                <button class="btn btn-danger" type="submit">
                                                    Sign out
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div alt="blog" class="content ">

                    <livewire:surat-suara>
                </div>
                <div alt="blog" class="content ">

                    <livewire:clainnya>
                </div>

                <nav class="nav-on-desktop">
                    <ul>
                        @if (Auth::user()->absen == "hadir")
                        @else
                        <li class="active">
                            <i class="fas fa-home"></i>
                            <p>Absensi</p>
                        </li>
                        @endif
                        <li>
                            <i class="fas fa-box"></i>
                            <p>Upload C1</p>
                        </li>
                        <li>
                            <i class="fas fa-book"></i>
                            <p>Surat Suara</p>
                        </li>
                        <li>
                            <i class="fas fa-book-open"></i>
                            <p>Upload C6</p>
                        </li>

                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="phone content-for-mobile" style="padding-bottom: 60px;">

        @if (Auth::user()->absen == "hadir")
        @else
        <div alt="home" class="content show">
            <livewire:absensi-saksi>
        </div>
        @endif
        <div alt="work" class="content {{Auth::user()->absen == 'hadir'?'show':''}}">

            <?php
            $cekSaksi = App\Models\Saksi::where('tps_id', Auth::user()->tps_id)->count('id'); ?>
            @if( $cekSaksi == null)

            <livewire:upload-c1>

                @else
                <div class="container mt-3">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="card border-0 shadow">
                                <div class="card-body text-center">
                                    <h3>
                                        Terima Kasih telah mengirim data C1.
                                    </h3>
                                    <form action="{{route('logout')}}" method="post" class="py-2 pe-2 ps-3">
                                        @csrf
                                        <div class="d-grid gap-2 mx-auto">
                                            <button class="btn btn-danger" type="submit">
                                                Sign out
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
        </div>
        <div alt="blog" class="content ">

            <livewire:surat-suara>
        </div>
        <div alt="blog" class="content ">

            <livewire:clainnya>
        </div>

        <nav class="position-fixed">
            <ul>
                @if (Auth::user()->absen == "hadir")
                @else
                <li class="active">
                    <i class="fas fa-home"></i>
                    <p>Absensi</p>
                </li>
                @endif
                <li>
                    <i class="fas fa-box"></i>
                    <p>Upload C1</p>
                </li>
                <li>
                    <i class="fas fa-book"></i>
                    <p>Surat Suara</p>
                </li>
                <li>
                    <i class="fas fa-book-open"></i>
                    <p>Upload C6</p>
                </li>

            </ul>
        </nav>
    </div>

    <div class="modal fade" id="validasi" tabindex="-1" aria-labelledby="validasiLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="validasiLabel">Validation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        @if(session()->has('error'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ session()->get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if(session('errors'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <ul>
                                @foreach (session('errors')->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    @livewireScripts
    <script>
        const contents = document.querySelectorAll('.content')
        const listItems = document.querySelectorAll('nav ul li')

        listItems.forEach((item, idx) => {
            item.addEventListener('click', () => {
                hideAllContents()
                hideAllItems()

                item.classList.add('active')
                contents[idx].classList.add('show')
            })
        })

        function hideAllContents() {
            contents.forEach(content => content.classList.remove('show'))
        }


        function hideAllItems() {
            listItems.forEach(item => item.classList.remove('active'))
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    @if(session()->has('error') || session('errors'))
    <script>
        var modalvalidasi = new bootstrap.Modal(document.getElementById("validasi"), {});
        document.onreadystatechange = function() {
            modalvalidasi.show();
        };
    </script>
    @endif
    {{-- <script>
        var modalvalidasi = new bootstrap.Modal(document.getElementById("validasi"), {});
            document.onreadystatechange = function() {
                modalvalidasi.show();
            };
    </script> --}}
</body>

</html>