<?php
    
    use App\Models\Config;
    use App\Models\District;
    use App\Models\Regency;
    use App\Models\SaksiData;
    use App\Models\Tps;
    use App\Models\Village;
    use App\Models\User;
    use Illuminate\Support\Facades\DB;
    use App\Models\Saksi;
    
    $config = Config::all()->first();
    $regency = District::where('regency_id', $config['regencies_id'])->get();
    $kota = Regency::where('id', $config['regencies_id'])->first();
    $dpt = District::where('regency_id', $config['regencies_id'])->sum('dpt');
    $tps = Tps::count();
    $marquee = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->get();
    $total_tps = Tps::where('setup','belum terisi')->count();;
    $tps_masuk = Tps::where('setup','terisi')->count();
    $tps_kosong = $total_tps - $tps_masuk;
    $suara_masuk = SaksiData::count('voice');
    $verification = Saksi::where('verification', 1)->with('saksi_data')->get();
    $total_verification_voice = 0;
    foreach ($verification as $key) {
        foreach ($key->saksi_data as $verif) {
            $total_verification_voice += $verif->voice;
        }
    }
    $paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id,SUM(voice) as total FROM saksi_data GROUP by paslon_id ORDER by total DESC'));
    $urutan = $paslon_tertinggi;
?>

<style>
    .header .btn {
        margin-left: 0px !important;
        position: relative;
    }

    .for-kolapse-kurangin > .side-app > .row:first-child {
        margin-top: 75px !important;
        transition: all 0.5s ease-in-out;
    }

    .for-kolapse-kurangin > .side-app > .row.kurangin {
        margin-top: 0px !important;
        transition: all 0.5s ease-in-out;
    }
    .sidenav-toggled .header-baru {
        padding-left: 80px !important
    }
</style>

<div class="app-header header header-baru py-0 pe-0" style="padding-left: 270px">
    <div class="container-fluid px-0">

        <div class="d-flex" style="position: relative">

            <div class="col-12 px-0">
                <div class="card mb-0 border-0">
                    <div class="card-header p-0 border-0" id="marquee1" style="position: relative; background-color: #343a40">
                        <button class="btn-dark btn-kolapse-sidebar text-white" style="background-color: #30304d; position: absolute; left: 0; z-index: 20; border-0"><i class="fa-solid fa-align-left"></i></button>
                        <button class="btn-dark btn-kolapse text-white" style="background-color: #30304d; position: absolute; left: 28px; z-index: 20; border-0"><i class="fa-solid fa-bars"></i></button>
                        <button class="btn-danger text-white rounded-0" style="position: absolute; left: 56px; z-index: 20">Suara Masuk</button>
                        {{-- <button class="btn btn-kolapse text-white" style="background-color: #30304d; z-index: 20"><i class="fa-solid fa-bars"></i></button>
                        <button class="btn btn-danger text-white rounded-0" style="z-index: 20">Suara Masuk</button> --}}
                        <marquee>
                            @foreach ($marquee as $item)
                            <?php $kecamatan =  District::where('id', $item['districts'])->first(); ?>
                            <?php $kelurahan =  Village::where('id', $item['villages'])->first(); ?>
                            <?php $tps =  Tps::where('id', $item['tps_id'])->first(); ?>
                            <span class="text-success">▼ </span><span class="text-white" style="font-size: 20px;">{{$item['name']}}
                                Kecamatan {{$kecamatan['name']}}, Kelurahan {{$kelurahan['name']}}, TPS {{$tps['number']}}
                            </span>
                            @endforeach
                        </marquee>
                    </div>
                    <div class="card-body for-kolapse py-1 pl-5" style="background: #000; padding-right: 2.5rem">
                        <div class="row py-4 justify-content-between">
                        
                            <div class="col-md-auto my-auto">
                                <h4 class="mb-0 text-white tabulasi tugel-content">
                                    Tabulasi
                                </h4>
                                <h4 class="mb-0 text-white support tugel-content" style="display: none;">
                                    Support
                                </h4>
                                <h4 class="mb-0 text-white setting tugel-content" style="display: none;">
                                    Settings
                                </h4>
                                <h4 class="mb-0 text-white suara tugel-content" style="display: none;">
                                    Urutan Suara
                                </h4>
                            </div>

                            <div class="col-md-8">
                                <div class="row">
                                
                                    <div class="col-md-12 text-white tabulasi tugel-content">
                                        <div class="row">
                                            <div class="col py-2 judul text-center bg-secondary text-white"
                                                style="border-top-left-radius: 25px; border-bottom-left-radius: 25px">
                                                <div class="text">Total TPS : <b>{{ $total_tps }}</b></div>
                                            </div>
                                            <div class="col py-2 judul text-center bg-danger text-white">
                                                <div class="text">TPS Masuk : <b>{{ $tps_masuk }}</b></div>
                                            </div>
                                            <div class="col py-2 judul text-center bg-primary text-white">
                                                <div class="text">TPS Kosong : <b>{{ $tps_kosong }}</b></div>
                                            </div>
                                            <div class="col py-2 judul text-center bg-info text-white">
                                                <div class="text">Suara Masuk : <b>{{ $suara_masuk }}</b></div>
                                            </div>
                                            <div class="col py-2 judul text-center bg-success text-white"
                                                style="border-top-right-radius: 25px; border-bottom-right-radius: 25px">
                                                <div class="text">Suara Terverifikasi : <b>{{$total_verification_voice}}</b></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-white support tugel-content" style="display: none">
                                        <div class="row">
                                            <div class="col-md-auto px-1 my-auto">
                                                <img src="https://plus.unsplash.com/premium_photo-1661510749856-47c47ea10fc7?auto=format&fit=crop&q=80&w=1932&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="avatar profile-user brround" style="width: 40px; height: 40px; object-fit: cover" alt="">
                                            </div>
                                            <div class="col-md my-auto">
                                                <input class="w-100 form-control" style="border-radius: 25px" type="text" name="" id="" placeholder="Kirim pesan ...">
                                            </div>
                                            <div class="col-md-auto px-0">
                                                <button class="btn text-white fs-5"><i class="fa-solid fa-paper-plane"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="col-md-12 mb-2 setting tugel-content settings" style="display: none;position: relative;">
                                        {{-- Settings --}}
                                        <div class="row px-5 my-auto" style="gap: 25px; position: absolute;">
                                            <div class="col-auto mb-2">
                                                <div class="mid">
                                                
                                                    <label class="switch">
                                                        <input type="checkbox" {{($config->default == "yes")?'disabled':''}} data-target="mode" onclick="settings('multi_admin',this)"
                                                            {{($config->multi_admin == "no") ? "":"checked"; }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                                <div class="text-center" style="font-size:13px; font-family: 'Roboto', sans-serif !important;">
                                                    Multi
                                                </div>
                                            </div>
                                        
                                            <div class="col-auto mb-2">
                                                <div class="mid">
                                                
                                                    <label class="switch">
                                                        <input type="checkbox" data-target="mode" onclick="settings('otonom',this)"
                                                            {{($config->otonom == "no") ? "":"checked"; }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                                <div class="text-center" style="font-size:13px; font-family: 'Roboto', sans-serif !important;">
                                                    Otonom
                                                </div>
                                            </div>
                                        
                                            <div class="col-auto mb-2">
                                                <div class="mid">
                                                    <label class="switch">
                                                        <input type="checkbox" {{($config->default == "yes")?'disabled':''}} data-target="mode" onclick="settings('show_terverifikasi',this)"
                                                            {{($config->show_terverifikasi == "hide") ? "":"checked"; }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                                <div class="text-center" style="font-size:13px; font-family: 'Roboto', sans-serif !important;">
                                                    Verifikasi
                                                </div>
                                            </div>
                                        
                                            <div class="col-auto mb-2">
                                                <div class="mid">
                                                    <label class="switch">
                                                        <input type="checkbox" {{($config->default == "yes")?'disabled':''}} data-target="mode" onclick="settings('show_public',this)"
                                                            {{($config->show_public == "hide") ? "":"checked"; }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                                <div class="text-center" style="font-size:13px; font-family: 'Roboto', sans-serif !important;">
                                                    Publish C1
                                                </div>
                                            </div>
                                        
                                            <div class="col-auto mb-2">
                                                <div class="mid">
                                                
                                                    <label class="switch">
                                                        <input type="checkbox" {{($config->default == "yes")?'disabled':''}} data-target="mode" onclick="settings('lockdown',this)"
                                                            {{($config->lockdown == "no") ? "":"checked"; }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                                <div class="text-center" style="font-size:13px; font-family: 'Roboto', sans-serif !important;">
                                                    Lockdown
                                                </div>
                                            </div>
                                        
                                            <div class="col-md-auto">
                                                <div class="mid">
                                                    <label class="switch">
                                                        <input type="checkbox" {{($config->default == "yes")?'disabled':''}} data-target="mode" onclick="settings('quick_count',this)"
                                                            {{($config->quick_count == "no") ? "":"checked"; }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                                <div class="text-center" style="font-size:13px; font-family: 'Roboto', sans-serif !important;">
                                                    Quick Count
                                                </div>
                                            </div>
                                        
                                        </div>
                                    </div>
                                
                                    <div class="col-md suara tugel-content"style="display: none">
                                        <div class="row">
                                            {{-- <div class="col-4 text-center mb-2 fw-bold fs-3">
                                                <span style="-webkit-text-stroke: 0.75px #00000036; color: #ffd700">1</span>
                                            </div>
                                            <div class="col-4 text-center mb-2 fw-bold fs-3">
                                                <span style="-webkit-text-stroke: 0.75px #00000036; color: #c0c0c0">2</span>
                                            </div>
                                            <div class="col-4 text-center mb-2 fw-bold fs-3">
                                                <span style="-webkit-text-stroke: 0.75px #00000036; color: #cd7f32">3</span>
                                            </div> --}}
                                            @foreach ($urutan as $urutPaslon)
                                                <?php $pasangan = App\Models\Paslon::where('id', $urutPaslon->paslon_id)->first(); ?>
                                                {{-- <div class="col-md"> --}}
                                                <div class="col-auto">
                                                    <div class="card shadow text-center mb-0 mx-auto mt-1 border-0">
                                                        <div class="card-header pt-1 pb-1 px-2 border-0" style="background: {{ $pasangan->color }}">
                                                            <span class="card-title text-white mx-auto">{{ $pasangan->candidate }} || {{ $pasangan->deputy_candidate }} : {{$urutPaslon->total}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- </div> --}}
                                            @endforeach
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
                        
                            <div class="col-md-auto my-auto">
                                <div class="row h-100 justify-content-end" style="gap: 10px;">
                                    <div class="col-md-auto px-0">
                                        <button class="w-100 mx-auto btn tugel-kolaps" style="background-color: #bababa; width: 40px; height: 36px;" data-target="suara">
                                            <span class="dark-layout" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Urutan Suara">    
                                                <i class="fa-solid fa-ranking-star"></i>
                                            </span>
                                        </button>
                                    </div>
                                    <div class="col-md-auto px-0">
                                        <button class="w-100 mx-auto btn tugel-kolaps" style="background-color: #bababa; width: 40px; height: 36px;" data-target="tabulasi">
                                            <span class="dark-layout" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Tabulasi">    
                                                <i class="fa-solid fa-database"></i>
                                            </span>
                                        </button>
                                    </div>
                                    <div class="col-md-auto px-0">
                                        <button class="w-100 mx-auto btn tugel-kolaps" style="background-color: #bababa; width: 40px; height: 36px;">
                                            
                                                <i class="fa-solid fa-database"></i>
                                            
                                        </button>
                                    </div>
                                    <div class="col-md-auto px-0" style="color: #212529 !important">
                                        <a class="w-100 mx-auto btn nav-link theme-layout nav-link-bg layout-setting px-3" onclick="darktheme()" style="background-color: #bababa; width: 40px; height: 36px; margin: 0px; font-size: 16px" data-target="">
                                            <span class="dark-layout" data-bs-placement="bottom" data-bs-toggle="tooltip"
                                                title="Dark Theme"><i class="fe fe-moon"></i></span>
                                            <span class="light-layout" data-bs-placement="bottom" data-bs-toggle="tooltip"
                                                title="Light Theme"><i class="fe fe-sun"></i></span>
                                        </a>
                                    </div>
                                    {{-- <div class="dropdown d-none d-md-flex">
                                        <a class="nav-link icon theme-layout nav-link-bg layout-setting" onclick="darktheme()">
                                            
                                        </a>
                                    </div><!-- Theme-Layout --> --}}
                                    <script>
                                        let darktheme = function() {
                                            setTimeout(function() {
                                                let body = document.body;
                                                let themes = body.className.split(" ");
                                                let theme = (themes.length == 3) ? "yes" : "no";
                                                $.ajax({
                                                    url: `{{ route('superadmin.theme') }}`,
                                                    data: {
                                                        theme,
                                                        "_token": "{{ csrf_token() }}"
                                                    },
                                                    type: "post",
                                                    success: function(res) {
                                                    
                                                    }
                                                });
                                            }, 300);
                                        }
                                    </script>

                                    <div class="col-md-auto px-0">
                                        <button class="w-100 mx-auto btn tugel-kolaps" style="background-color: #bababa; width: 40px; height: 36px;" data-target="support">
                                            <span class="dark-layout" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Support">
                                                <i class="fa-solid fa-headset"></i>
                                            </span>
                                        </button>
                                    </div>
                                    <div class="col-md-auto px-0">
                                        <button class="w-100 mx-auto btn tugel-kolaps" style="background-color: #bababa; width: 40px; height: 36px;" data-target="setting">
                                            <span class="dark-layout" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Settings">
                                                <i class="fa-solid fa-gear"></i>
                                            </span>
                                        </button>
                                    </div>
                                    <div class="col-md-auto px-0">
                                        <div class="dropdown d-none d-md-flex profile-1">
                                            <a href="#" data-bs-toggle="dropdown" class="nav-link pt-0 leading-none d-flex">
                                                <span>
                                                    @if (Auth::user()->profile_photo_path == NULL)
                                                    <img class="avatar profile-user brround" style="object-fit: cover; width: 33px; height: 33px" src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&color=7F9CF5&background=EBF4FF" alt="profile-user">
                                                    @else
                                                    <img class="avatar profile-user brround" style="object-fit: cover; width: 33px; height: 33px" src="{{url("/storage/profile-photos/".Auth::user()->profile_photo_path) }}" alt="profile-user"s>
                                                    @endif
                                                </span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                <div class="drop-heading">
                                                    <div class="text-center">
                                                        <h5 class="text-dark mb-0">{{ Auth::user()->name }}</h5>
                                                        <small
                                                            class="text-muted">{{ Auth::user()->role_id == 1 ? 'Administrator' : 'uwon luyi' }}</small>
                                                    </div>
                                                </div>
                                                <div class="dropdown-divider m-0"></div>
                                                <a class="dropdown-item" href="/user/profile">
                                                    <i class="dropdown-icon fe fe-user"></i> Profile
                                                </a>
                                            
                                                <form action="{{ route('logout') }}" method="post">
                                                    @csrf
                                                
                                                
                                                    <button class="dropdown-item"type="submit">
                                                        <i class="dropdown-icon fe fe-alert-circle"></i> Sign out
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                    
                        <script>
                            $('.btn-kolapse').on('click', function() {
                                $('.for-kolapse').toggle(500);
                                $('.for-kolapse-kurangin > .side-app > .row:first').toggleClass('kurangin')
                            })

                            $('.btn-kolapse-sidebar').on('click', function() {
                                $('body.app.sidebar-mini').toggleClass('sidenav-toggled')
                            })
                        
                            $('.tugel-kolaps').on('click', function() {
                            
                                let target = $(this).data('target')
                                console.log(target)
                                $('.tugel-content').hide()
                                $(`.${target}`).show(200)
                            })
                        
                        </script>

                    </div>
                </div>
            </div>
            <!-- <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar" href="#"></a> -->
            <!-- sidebar-toggle-->
            <!-- <a class="header-brand1 d-flex d-md-none">
                <img src="{{ url('/') }}/assets/images/brand/logo.png" class="header-brand-img desktop-logo" alt="logo">
                <img src="{{ url('/') }}/assets/images/brand/logo-1.png" class="header-brand-img toggle-logo" alt="logo">
                <img src="{{ url('/') }}/assets/images/brand/logo-2.png" class="header-brand-img light-logo" alt="logo">
                <img src="{{ url('/') }}/assets/images/brand/logo-3.png" class="header-brand-img light-logo1" alt="logo">
            </a> -->
            <!-- LOGO -->
            
            {{-- <div class="d-flex order-lg-2 ms-auto header-right-icons">



                <button class="navbar-toggler navresponsive-toggler d-md-none ms-auto" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
                    aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon fe fe-more-vertical text-dark"></span>
                </button>
                <div class="dropdown d-none d-md-flex">
                    <a class="nav-link icon theme-layout nav-link-bg layout-setting" onclick="darktheme()">
                        <span class="dark-layout" data-bs-placement="bottom" data-bs-toggle="tooltip"
                            title="Dark Theme"><i class="fe fe-moon"></i></span>
                        <span class="light-layout" data-bs-placement="bottom" data-bs-toggle="tooltip"
                            title="Light Theme"><i class="fe fe-sun"></i></span>
                    </a>
                </div><!-- Theme-Layout -->
                <script>
                    let darktheme = function() {
                        setTimeout(function() {
                            let body = document.body;
                            let themes = body.className.split(" ");
                            let theme = (themes.length == 3) ? "yes" : "no";
                            $.ajax({
                                url: `{{ route('superadmin.theme') }}`,
                                data: {
                                    theme,
                                    "_token": "{{ csrf_token() }}"
                                },
                                type: "post",
                                success: function(res) {

                                }
                            });
                        }, 300);
                    }
                </script>
                <div class="dropdown d-none d-md-flex">
                    <a class="nav-link icon full-screen-link nav-link-bg">
                        <i class="fe fe-minimize fullscreen-button"></i>
                    </a>
                </div><!-- FULL-SCREEN -->

                <div class="dropdown  d-none d-md-flex message">
                    <a class="nav-link icon text-center" data-bs-toggle="dropdown">
                        <i class="fe fe-message-square"></i><span class=" pulse-danger"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">

                        <div class="message-menu"style="overflow-y:scroll;height:300px">
                            <?php
                            
                            $allUser = App\Models\User::where('id', '!=', Auth::user()->id)
                                ->where('role_id', '!=', 8)
                                ->where('role_id', '!=', 0)
                                ->where('role_id', '!=', 14)
                                ->get(); ?>
                            @foreach ($allUser as $usr)
                                <a class="dropdown-item d-flex" href="#" onclick="openForm(`<?= $usr->id ?>`)">
                                    <span class="avatar avatar-md brround me-3 align-self-center cover-image"
                                        data-bs-image-src="{{ url('/') }}/assets/images/users/1.jpg"></span>
                                    <div class="wd-90p">
                                        <div class="d-flex">
                                            <h5 class="mb-1">{{ $usr->name }}</h5>
                                            <small class="text-muted ms-auto text-end">

                                            </small>
                                        </div>
                                    </div>
                                </a>
                            @endforeach

                        </div>
                        <div class="dropdown-divider m-0"></div>
                    </div>
                </div><!-- MESSAGE-BOX -->
                <div class="dropdown d-none d-md-flex profile-1">
                    <a href="#" data-bs-toggle="dropdown" class="nav-link pt-0 leading-none d-flex">
                        <span>
                            @if (Auth::user()->profile_photo_path == NULL)
                            <img class="avatar profile-user brround" style="object-fit: cover" src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&color=7F9CF5&background=EBF4FF" alt="profile-user">
                            @else
                            <img class="avatar profile-user brround" style="object-fit: cover" src="{{url("/storage/profile-photos/".Auth::user()->profile_photo_path) }}" alt="profile-user"s>
                            @endif
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <div class="drop-heading">
                            <div class="text-center">
                                <h5 class="text-dark mb-0">{{ Auth::user()->name }}</h5>
                                <small
                                    class="text-muted">{{ Auth::user()->role_id == 1 ? 'Administrator' : 'uwon luyi' }}</small>
                            </div>
                        </div>
                        <div class="dropdown-divider m-0"></div>
                        <a class="dropdown-item" href="/user/profile">
                            <i class="dropdown-icon fe fe-user"></i> Profile
                        </a>

                        <a class="dropdown-item" href="#">
                            <i class="dropdown-icon fe fe-settings"></i> Settings
                        </a>

                        <form action="{{ route('logout') }}" method="post">
                            @csrf


                            <button class="dropdown-item"type="submit">
                                <i class="dropdown-icon fe fe-alert-circle"></i> Sign out
                            </button>
                        </form>
                    </div>
                </div>
                <div class="dropdown d-none d-md-flex header-settings">
                    <a href="#" class="nav-link icon " data-bs-toggle="sidebar-right"
                        data-target=".sidebar-right">
                        <i class="fe fe-menu"></i>
                    </a>
                </div><!-- SIDE-MENU -->
            </div> --}}



        </div>
    </div>
</div>
<div class="mb-1 navbar navbar-expand-lg  responsive-navbar navbar-dark d-md-none bg-white">
    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
        <div class="d-flex order-lg-2 ms-auto">


            <div class="dropdown d-md-flex message">
                <a class="nav-link icon text-center" data-bs-toggle="dropdown">
                    <i class="fe fe-message-square"></i><span class=" pulse-danger"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">

                    <div class="message-menu">
                        <?php
                        $allUser = App\Models\User::where('id', '!=', Auth::user()->id)
                            ->where('role_id', '!=', 8)
                            ->where('role_id', '!=', 0)
                            ->where('role_id', '!=', 14)
                            ->get(); ?>
                        @foreach ($allUser as $usr)
                            <a class="dropdown-item d-flex" href="#" onclick="openForm(`<?= $usr->id ?>`)">
                                <span class="avatar avatar-md brround me-3 align-self-center cover-image"
                                    data-bs-image-src="{{ url('/') }}/assets/images/users/1.jpg"></span>
                                <div class="wd-90p">
                                    <div class="d-flex">
                                        <h5 class="mb-1">{{ $usr->name }}</h5>
                                        <small class="text-muted ms-auto text-end">

                                        </small>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="dropdown-divider m-0"></div>

                </div>
            </div><!-- MESSAGE-BOX -->
            <div class="dropdown d-md-flex profile-1">
                <a href="#" data-bs-toggle="dropdown" class="nav-link pe-2 leading-none d-flex pt-0">
                    <span>
                        @if (Auth::user()->profile_photo_path == NULL)
                        <img class="avatar profile-user brround" style="object-fit: cover" src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&color=7F9CF5&background=EBF4FF" alt="profile-user">
                        @else
                        <img class="avatar profile-user brround" style="object-fit: cover" src="{{url("/storage/profile-photos/".Auth::user()->profile_photo_path) }}" alt="profile-user"s>
                        @endif
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <div class="drop-heading">
                        <div class="text-center">
                            <h5 class="text-dark mb-0">{{ Auth::user()->name }}</h5>
                            <small
                                class="text-muted">{{ Auth::user()->role_id == 1 ? 'Administrator' : 'uwon luyi' }}</small>
                        </div>
                    </div>
                    <div class="dropdown-divider m-0"></div>
                    <a class="dropdown-item" href="/user/profile">
                        <i class="dropdown-icon fe fe-user"></i> Profile
                    </a>

                    <form action="{{ route('logout') }}" method="post">
                        @csrf


                        <button class="dropdown-item"type="submit">
                            <i class="dropdown-icon fe fe-alert-circle"></i> Sign out
                        </button>
                    </form>
                </div>
            </div>
            <div class="dropdown d-md-flex header-settings">
                <a href="#" class="nav-link icon " data-bs-toggle="sidebar-right"
                    data-target=".sidebar-right">
                    <i class="fe fe-menu"></i>
                </a>
            </div><!-- SIDE-MENU -->
        </div>
    </div>
</div>
<!-- /Mobile Header -->

<!--app-content open-->
<div class="app-content for-kolapse-kurangin" style="margin-top: 40px;">
    <div class="side-app">
