<!-- Mobile Header -->
<style>
    .mid {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    /* The switch - the box around the slider */
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }
    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }
    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }
    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }
    input:checked+.slider {
        background-color: #2196F3;
    }
    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }
    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }
    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }
    .slider.round:before {
        border-radius: 50%;
    }
    .btn-dark-custom {
        background: rgb(113, 56, 150);
        background: linear-gradient(180deg, rgba(113, 56, 150, 1) 0%, rgba(108, 48, 147, 1) 2%, rgba(96, 29, 140, 1) 9%, rgba(78, 0, 130, 1) 25%, rgba(64, 0, 107, 1) 84%, rgba(60, 0, 101, 1) 88%, rgba(65, 0, 109, 1) 93%, rgba(15, 0, 25, 1) 100%, rgba(0, 0, 0, 1) 100%, rgba(0, 0, 0, 0.5) 100%, rgba(0, 0, 0, 0.75) 100%);
    }
    .bg-dark-custom {
        background: rgb(78, 0, 130);
        background: linear-gradient(180deg, rgba(78, 0, 130, 1) 0%, rgba(78, 0, 130, 1) 68%, rgba(15, 0, 25, 1) 100%, rgba(0, 0, 0, 1) 100%, rgba(0, 0, 0, 0.5) 100%, rgba(0, 0, 0, 0.75) 100%);
    }
    
    .c3-legend-item text{
        font-size: 11px;
    }
</style>

<div class="app-header header">
    <div class="container-fluid">

        <div class="d-flex" style="position: relative">
            <div class="col-auto" style="position: absolute; top: 50%; transform: translateY(-50%)">
                <h3 class="mb-0 fw-bold">
                    Settings
                </h3>
            </div>
            <div class="vr"></div>
            <div class="row" style="position: absolute; left: 50%; transform: translateX(-50%)">
                <div class="col-auto">
                    <div class="mid">
                    
                        <label class="switch">
                            <input type="checkbox" {{($config->default == "yes")?'disabled':''}} data-target="mode" onclick="settings('multi_admin',this)"
                                {{($config->multi_admin == "no") ? "":"checked"; }}>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="text-center" style="font-size:13px">
                        Multi
                    </div>
                </div>
            
                <div class="col-auto">
                    <div class="mid">
                    
                        <label class="switch">
                            <input type="checkbox" data-target="mode" onclick="settings('otonom',this)"
                                {{($config->otonom == "no") ? "":"checked"; }}>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="text-center" style="font-size:13px">
                        Otonom
                    </div>
                </div>
            
                <div class="col-auto">
                    <div class="mid">
                        <label class="switch">
                            <input type="checkbox" {{($config->default == "yes")?'disabled':''}} data-target="mode" onclick="settings('show_terverifikasi',this)"
                                {{($config->show_terverifikasi == "hide") ? "":"checked"; }}>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="text-center" style="font-size:13px">
                        Verifikasi
                    </div>
                </div>
            
                <div class="col-auto">
                    <div class="mid">
                        <label class="switch">
                            <input type="checkbox" {{($config->default == "yes")?'disabled':''}} data-target="mode" onclick="settings('show_public',this)"
                                {{($config->show_public == "hide") ? "":"checked"; }}>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="text-center" style="font-size:13px">
                        Publish C1
                    </div>
                </div>
            
                <div class="col-auto">
                    <div class="mid">
                    
                        <label class="switch">
                            <input type="checkbox" {{($config->default == "yes")?'disabled':''}} data-target="mode" onclick="settings('lockdown',this)"
                                {{($config->lockdown == "no") ? "":"checked"; }}>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="text-center" style="font-size:13px">
                        Lockdown
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
            
            <div class="d-flex order-lg-2 ms-auto header-right-icons">



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
            </div>



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
<div class="app-content">
    <div class="side-app">
