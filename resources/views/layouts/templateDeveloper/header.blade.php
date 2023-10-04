<!-- Mobile Header -->
<div class="app-header header">
    <div class="container-fluid">
        <div class="d-flex">
            <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar" href="#"></a>
            <!-- sidebar-toggle-->
            <a class="header-brand1 d-flex d-md-none" href="index.html">
                <!-- <img src="../../assets/images/brand/logo.png" class="header-brand-img desktop-logo" alt="logo">
                <img src="../../assets/images/brand/logo-1.png" class="header-brand-img toggle-logo" alt="logo">
                <img src="../../assets/images/brand/logo-2.png" class="header-brand-img light-logo" alt="logo">
                <img src="../../assets/images/brand/logo-3.png" class="header-brand-img light-logo1" alt="logo"> -->
            </a><!-- LOGO -->
            <div class="d-flex order-lg-2 ms-auto header-right-icons">
                <button class="navbar-toggler navresponsive-toggler d-md-none ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon fe fe-more-vertical text-dark"></span>
                </button>
                <div class="dropdown d-none d-md-flex">
                    <a class="nav-link icon theme-layout nav-link-bg layout-setting" onclick="tablinkColor()">
                        <span class="dark-layout" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Dark Theme"><i class="fe fe-moon"></i></span>
                        <span class="light-layout" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Light Theme"><i class="fe fe-sun"></i></span>
                    </a>
                </div><!-- Theme-Layout -->
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
                        <div class="drop-heading border-bottom">
                            <div class="d-flex">
                                <h6 class="mt-1 mb-0 fs-16 fw-semibold">You have Messages</h6>
                                <div class="ms-auto">
                                    <span class="badge bg-danger rounded-pill">4</span>
                                </div>
                            </div>
                        </div>
                        <div class="message-menu">
                            <a class="dropdown-item d-flex" href="chat.html">
                                <span class="avatar avatar-md brround me-3 align-self-center cover-image" data-bs-image-src="../../assets/images/users/1.jpg"></span>
                                <div class="wd-90p">
                                    <div class="d-flex">
                                        <h5 class="mb-1">Madeleine</h5>
                                        <small class="text-muted ms-auto text-end">
                                            3 hours ago
                                        </small>
                                    </div>
                                    <span>Hey! there I' am available....</span>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex" href="chat.html">
                                <span class="avatar avatar-md brround me-3 align-self-center cover-image" data-bs-image-src="../../assets/images/users/12.jpg"></span>
                                <div class="wd-90p">
                                    <div class="d-flex">
                                        <h5 class="mb-1">Anthony</h5>
                                        <small class="text-muted ms-auto text-end">
                                            5 hour ago
                                        </small>
                                    </div>
                                    <span>New product Launching...</span>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex" href="chat.html">
                                <span class="avatar avatar-md brround me-3 align-self-center cover-image" data-bs-image-src="../../assets/images/users/4.jpg"></span>
                                <div class="wd-90p">
                                    <div class="d-flex">
                                        <h5 class="mb-1">Olivia</h5>
                                        <small class="text-muted ms-auto text-end">
                                            45 mintues ago
                                        </small>
                                    </div>
                                    <span>New Schedule Realease......</span>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex" href="chat.html">
                                <span class="avatar avatar-md brround me-3 align-self-center cover-image" data-bs-image-src="../../assets/images/users/15.jpg"></span>
                                <div class="wd-90p">
                                    <div class="d-flex">
                                        <h5 class="mb-1">Sanderson</h5>
                                        <small class="text-muted ms-auto text-end">
                                            2 days ago
                                        </small>
                                    </div>
                                    <span>New Schedule Realease......</span>
                                </div>
                            </a>
                        </div>
                        <div class="dropdown-divider m-0"></div>
                        <a href="#" class="dropdown-item text-center p-3 text-muted">See all Messages</a>
                    </div>
                </div><!-- MESSAGE-BOX -->
                <div class="dropdown d-none d-md-flex profile-1">
                    <a href="#" data-bs-toggle="dropdown" class="nav-link pe-2 leading-none d-flex">
                        <span>
                            <img src="{{ Auth::user()->profile_photo_url }}" alt="profile-user" class="avatar  profile-user brround cover-image">
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <div class="drop-heading">
                            <div class="text-center">
                                <h5 class="text-dark mb-0">Elizabeth Dyer</h5>
                                <small class="text-muted">Administrator</small>
                            </div>
                        </div>
                        <div class="dropdown-divider m-0"></div>
                        <a class="dropdown-item" href="profile.html">
                            <i class="dropdown-icon fe fe-user"></i> Profile
                        </a>
                        <a class="dropdown-item" href="email.html">
                            <i class="dropdown-icon fe fe-mail"></i> Inbox
                            <span class="badge bg-primary float-end">3</span>
                        </a>
                        <a class="dropdown-item" href="emailservices.html">
                            <i class="dropdown-icon fe fe-settings"></i> Settings
                        </a>
                        <a class="dropdown-item" href="faq.html">
                            <i class="dropdown-icon fe fe-alert-triangle"></i> Need help??
                        </a>
                        <form action="{{ route('logout') }}" method="post">

                            @csrf
                            <!--<input type="hidden" value="$village->district_id" name="district_id">-->
                            <input type="hidden" value="{{Auth::user()->role_id}}" name="role_id">
                            <input type="hidden" value="{{Auth::user()->id}}" name="id">
                            <button class="dropdown-item">
                                <i class="dropdown-icon fe fe-alert-circle"></i> Sign out
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="mb-1 navbar navbar-expand-lg  responsive-navbar navbar-dark d-md-none bg-white">
    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
        <div class="d-flex order-lg-2 ms-auto">
            <div class="dropdown d-md-flex">
                <a class="nav-link icon theme-layout nav-link-bg layout-setting" onclick="tablinkColor()">
                    <span class="dark-layout" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Dark Theme"><i class="fe fe-moon"></i></span>
                    <span class="light-layout" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Light Theme"><i class="fe fe-sun"></i></span>
                </a>
            </div><!-- Theme-Layout -->

            <script>
                let tablinkColor = function() {
                    // console.log('kontol')
                    setTimeout(function() {
                        tablinks = document.getElementsByClassName("tablink");
                        let darkmode = document.body.className.split(' ');
                        console.log(darkmode)
                        for (i = 0; i < tablinks.length; i++) {
                            (darkmode.length == 3) ? tablinks[i].style.color = "white": tablinks[i].style.color = "black";
                        }
                    }, 10)
                }
            </script>
            <div class="dropdown d-md-flex">
                <a class="nav-link icon full-screen-link nav-link-bg">
                    <i class="fe fe-minimize fullscreen-button"></i>
                </a>
            </div><!-- FULL-SCREEN -->
            <div class="dropdown d-md-flex header-settings">
                <a href="#" class="nav-link icon " data-bs-toggle="sidebar-right" data-target=".sidebar-right">
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