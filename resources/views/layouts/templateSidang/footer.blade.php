</div>
</div>
<!-- CONTAINER END -->
</div>

<!-- Sidebar-right -->
<div class="sidebar sidebar-right sidebar-animate">
    <div class="panel panel-primary card mb-0 shadow-none border-0">
        <div class="tab-menu-heading border-0 d-flex p-3">
            <div class="card-title mb-0">Notifications</div>
            <div class="card-options ms-auto">
                <a href="#" class="sidebar-icon text-end float-end me-1" data-bs-toggle="sidebar-right"
                    data-target=".sidebar-right"><i class="fe fe-x text-white"></i></a>
            </div>
        </div>
        <div class="panel-body tabs-menu-body latest-tasks p-0 border-0">
            <div class="tab-content">
                
                <div class="tab-pane active" id="side1">
                    <div class="card-body text-center">
                        <div class="dropdown user-pro-body">
                            <div class="">
                                <img alt="user-img" class="avatar avatar-xl brround mx-auto text-center" src="{{ Auth::user()->profile_photo_url }}"><span class="avatar-status profile-status bg-green"></span>
                            </div>
                            <div class="user-info mg-t-20">
                                <h6 class="fw-semibold  mt-2 mb-0">{{ Auth::user()->name }}</h6>
                                <span class="mb-0 text-muted fs-12">{{ Auth::user()->role_id == 1 ?"Administrator":"uwon luyi"; }}</span>
                            </div>
                        </div>
                    </div>
                    <a class="dropdown-item d-flex border-bottom border-top" href="profile.html">
                        <div class="d-flex"><i class="fe fe-user me-3 tx-20 text-muted"></i>
                            <div class="pt-1">
                                <h6 class="mb-0">My Profile</h6>
                                <p class="tx-12 mb-0 text-muted">Profile Personal information</p>
                            </div>
                        </div>
                    </a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf

                        <a class="dropdown-item d-flex border-bottom" style="cursor: pointer" onclick="$($(this).parent()).submit()">
                            <div class="d-flex"><i class="fe fe-power me-3 tx-20 text-muted"></i>
                                <div class="pt-1">
                                    <h6 class="mb-0">Sign Out</h6>
                                    <p class="tx-12 mb-0 text-muted">Account Signout</p>
                                </div>
                            </div>
                        </a>
                    </form>
                </div>
                <div class="tab-pane" id="side2">
                    <div class="list-group list-group-flush ">
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="me-2">
                                <span class="avatar avatar-md brround cover-image"
                                    data-bs-image-src="../../assets/images/faces/9.jpg"><span
                                        class="avatar-status bg-success"></span></span>
                            </div>
                            <div class="">
                                <div class="fw-semibold" data-bs-toggle="modal" data-target="#chatmodel">
                                    Mozelle
                                    Belt</div>
                                <p class="mb-0 tx-12 text-muted">mozellebelt@gmail.com</p>
                            </div>
                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="me-2">
                                <span class="avatar avatar-md brround cover-image"
                                    data-bs-image-src="../../assets/images/faces/11.jpg"></span>
                            </div>
                            <div class="">
                                <div class="fw-semibold" data-bs-toggle="modal" data-target="#chatmodel">
                                    Florinda Carasco</div>
                                <p class="mb-0 tx-12 text-muted">florindacarasco@gmail.com</p>
                            </div>
                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="me-2">
                                <span class="avatar avatar-md brround cover-image"
                                    data-bs-image-src="../../assets/images/faces/10.jpg"><span
                                        class="avatar-status bg-success"></span></span>
                            </div>
                            <div class="">
                                <div class="fw-semibold" data-bs-toggle="modal" data-target="#chatmodel">
                                    Alina
                                    Bernier</div>
                                <p class="mb-0 tx-12 text-muted">alinaaernier@gmail.com</p>
                            </div>
                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="me-2">
                                <span class="avatar avatar-md brround cover-image"
                                    data-bs-image-src="../../assets/images/faces/2.jpg"><span
                                        class="avatar-status bg-success"></span></span>
                            </div>
                            <div class="">
                                <div class="fw-semibold" data-bs-toggle="modal" data-target="#chatmodel">
                                    Zula
                                    Mclaughin</div>
                                <p class="mb-0 tx-12 text-muted">zulamclaughin@gmail.com</p>
                            </div>
                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="me-2">
                                <span class="avatar avatar-md brround cover-image"
                                    data-bs-image-src="../../assets/images/faces/13.jpg"></span>
                            </div>
                            <div class="">
                                <div class="fw-semibold" data-bs-toggle="modal" data-target="#chatmodel">
                                    Isidro
                                    Heide</div>
                                <p class="mb-0 tx-12 text-muted">isidroheide@gmail.com</p>
                            </div>
                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="me-2">
                                <span class="avatar avatar-md brround cover-image"
                                    data-bs-image-src="../../assets/images/faces/12.jpg"><span
                                        class="avatar-status bg-success"></span></span>
                            </div>
                            <div class="">
                                <div class="fw-semibold" data-bs-toggle="modal" data-target="#chatmodel">
                                    Mozelle
                                    Belt</div>
                                <p class="mb-0 tx-12 text-muted">mozellebelt@gmail.com</p>
                            </div>
                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="me-2">
                                <span class="avatar avatar-md brround cover-image"
                                    data-bs-image-src="../../assets/images/faces/4.jpg"></span>
                            </div>
                            <div class="">
                                <div class="fw-semibold" data-bs-toggle="modal" data-target="#chatmodel">
                                    Florinda Carasco</div>
                                <p class="mb-0 tx-12 text-muted">florindacarasco@gmail.com</p>
                            </div>
                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="me-2">
                                <span class="avatar avatar-md brround cover-image"
                                    data-bs-image-src="../../assets/images/faces/7.jpg"></span>
                            </div>
                            <div class="">
                                <div class="fw-semibold" data-bs-toggle="modal" data-target="#chatmodel">
                                    Alina
                                    Bernier</div>
                                <p class="mb-0 tx-12 text-muted">alinabernier@gmail.com</p>
                            </div>
                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="me-2">
                                <span class="avatar avatar-md brround cover-image"
                                    data-bs-image-src="../../assets/images/faces/2.jpg"></span>
                            </div>
                            <div class="">
                                <div class="fw-semibold" data-bs-toggle="modal" data-target="#chatmodel">
                                    Zula
                                    Mclaughin</div>
                                <p class="mb-0 tx-12 text-muted">zulamclaughin@gmail.com</p>
                            </div>
                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="me-2">
                                <span class="avatar avatar-md brround cover-image"
                                    data-bs-image-src="../../assets/images/faces/14.jpg"><span
                                        class="avatar-status bg-success"></span></span>
                            </div>
                            <div class="">
                                <div class="fw-semibold" data-bs-toggle="modal" data-target="#chatmodel">
                                    Isidro
                                    Heide</div>
                                <p class="mb-0 tx-12 text-muted">isidroheide@gmail.com</p>
                            </div>
                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="me-2">
                                <span class="avatar avatar-md brround cover-image"
                                    data-bs-image-src="../../assets/images/faces/11.jpg"></span>
                            </div>
                            <div class="">
                                <div class="fw-semibold" data-bs-toggle="modal" data-target="#chatmodel">
                                    Florinda Carasco</div>
                                <p class="mb-0 tx-12 text-muted">florindacarasco@gmail.com</p>
                            </div>
                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="me-2">
                                <span class="avatar avatar-md brround cover-image"
                                    data-bs-image-src="../../assets/images/faces/9.jpg"></span>
                            </div>
                            <div class="">
                                <div class="fw-semibold" data-bs-toggle="modal" data-target="#chatmodel">
                                    Alina
                                    Bernier</div>
                                <p class="mb-0 tx-12 text-muted">alinabernier@gmail.com</p>
                            </div>
                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="me-2">
                                <span class="avatar avatar-md brround cover-image"
                                    data-bs-image-src="../../assets/images/faces/15.jpg"><span
                                        class="avatar-status bg-success"></span></span>
                            </div>
                            <div class="">
                                <div class="fw-semibold" data-bs-toggle="modal" data-target="#chatmodel">
                                    Zula
                                    Mclaughin</div>
                                <p class="mb-0 tx-12 text-muted">zulamclaughin@gmail.com</p>
                            </div>
                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="me-2">
                                <span class="avatar avatar-md brround cover-image"
                                    data-bs-image-src="../../assets/images/faces/4.jpg"></span>
                            </div>
                            <div class="">
                                <div class="fw-semibold" data-bs-toggle="modal" data-target="#chatmodel">
                                    Isidro
                                    Heide</div>
                                <p class="mb-0 tx-12 text-muted">isidroheide@gmail.com</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="side3">
                    <a class="dropdown-item bg-gray-100 pd-y-10" href="#">
                        Account Settings
                    </a>
                    <div class="card-body">
                        <div class="form-group mg-b-10">
                            <label class="custom-switch ps-0">
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                    checked>
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description mg-l-10">Updates Automatically</span>
                            </label>
                        </div>
                        <div class="form-group mg-b-10">
                            <label class="custom-switch ps-0">
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description mg-l-10">Allow Location Map</span>
                            </label>
                        </div>
                        <div class="form-group mg-b-10">
                            <label class="custom-switch ps-0">
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                    checked>
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description mg-l-10">Show Contacts</span>
                            </label>
                        </div>
                        <div class="form-group mg-b-10">
                            <label class="custom-switch ps-0">
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                    checked>
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description mg-l-10">Show Notication</span>
                            </label>
                        </div>
                        <div class="form-group mg-b-10">
                            <label class="custom-switch ps-0">
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description mg-l-10">Show Tasks Statistics</span>
                            </label>
                        </div>
                        <div class="form-group mg-b-10">
                            <label class="custom-switch ps-0">
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                    checked>
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description mg-l-10">Show Email
                                    Notification</span>
                            </label>
                        </div>
                    </div>
                    <a class="dropdown-item bg-gray-100 pd-y-10" href="#">
                        General Settings
                    </a>
                    <div class="card-body">
                        <div class="form-group mg-b-10">
                            <label class="custom-switch ps-0">
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                    checked>
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description mg-l-10">Show User Online</span>
                            </label>
                        </div>
                        <div class="form-group mg-b-10">
                            <label class="custom-switch ps-0">
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description mg-l-10">Website Notication</span>
                            </label>
                        </div>
                        <div class="form-group mg-b-10">
                            <label class="custom-switch ps-0">
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description mg-l-10">Show Recent activity</span>
                            </label>
                        </div>
                        <div class="form-group mg-b-10">
                            <label class="custom-switch ps-0">
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description mg-l-10">Logout Automatically</span>
                            </label>
                        </div>
                        <div class="form-group mg-b-10">
                            <label class="custom-switch ps-0">
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                    checked>
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description mg-l-10">Aloow All
                                    Notifications</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/Sidebar-right-->

<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-md-12 col-sm-12 text-center">
                Copyright © 2024 <a href="#">Mahadaya Swara Teknologi</a>. Designed with <span class="fa fa-heart text-danger"></span>
                by <a href="https://yudicp.com"> Yudi C Prawira </a> All rights reserved
            </div>
        </div>
    </div>
</footer>
<!-- FOOTER END -->
</div>

<style>
    .screenshot-image {
        width: 150px;
        height: 90px;
        border-radius: 4px;
        border: 2px solid whitesmoke;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
        position: absolute;
        bottom: 5px;
        left: 10px;
        background: white;
    }

    .display-cover {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 70%;
        margin: 25px auto;
        position: relative;
    }

    video {
        //margin: 5% auto;
        width: 100%;
        background: rgba(0, 0, 0, 0.2);
    }

    .video-options {
        position: absolute;
        left: 20px;
        top: 30px;
    }

    .controls {
        position: absolute;
        right: 20px;
        top: 20px;
        display: flex;

    }

    .filter-controls {
        position: absolute;
        left: 20px;
        bottom: 20px;
        display: flex;
    }

    .controls>button {
        width: 45px;
        height: 45px;
        text-align: center;
        border-radius: 100%;
        margin: 0 6px;
        background: transparent;

        &:hover {
            svg {
                color: white !important;
            }
        }
    }

    .filter-controls>.btn-head {
        text-align: center;
        margin: 0 6px;
        background: transparent;
    }


    @media (min-width: 300px) and (max-width: 400px) {
        .controls {
            flex-direction: column;

            button {
                margin: 5px 0 !important;
            }
        }
    }

    .controls>button>svg {
        height: 20px;
        width: 18px;
        text-align: center;
        margin: 0 auto;
        padding: 0;
    }

    .controls button:nth-child(1) {
        border: 2px solid #D2002E;

        svg {
            color: #D2002E;

        }
    }

    .controls button:nth-child(2) {
        border: 2px solid #008496;

        svg {
            color: #008496;
        }
    }

    .controls button:nth-child(3) {
        border: 2px solid #00B541;

        svg {
            color: #00B541;
        }
    }

    .controls>button {
        width: 45px;
        height: 45px;
        text-align: center;
        border-radius: 100%;
        margin: 0 6px;
        background: transparent;

        &:hover {
            svg {
                color: white;
            }
        }
    }

</style>

<div id="fotoKecuranganterverifikasi" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content"  id="qrSidangOnline">
           

        </div>
    </div>
</div>
<div id="modalQrCode" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="qrSidang">
            

        </div>
    </div>
</div>

<script>
    feather.replace();

    const controls = document.querySelector('.controls');
    const cameraOptions = document.querySelector('.video-options>select');
    const video = document.querySelector('video');
    const canvas = document.querySelector('canvas');
    const screenshotImage = document.querySelector('img');
    const buttons = [...controls.querySelectorAll('button')];
    let streamStarted = false;

    const [play, pause, screenshot] = buttons;

    const constraints = {
        video: {
            width: {
                min: 1280,
                ideal: 1920,
                max: 2560,
            },
            height: {
                min: 720,
                ideal: 1080,
                max: 1440
            },
        }
    };

    cameraOptions.onchange = () => {
        const updatedConstraints = {
            ...constraints,
            deviceId: {
                exact: cameraOptions.value
            }
        };

        startStream(updatedConstraints);
    };

    play.onclick = () => {
        if (streamStarted) {
            video.play();
            play.classList.add('d-none');
            pause.classList.remove('d-none');
            return;
        }
        if ('mediaDevices' in navigator && navigator.mediaDevices.getUserMedia) {
            const updatedConstraints = {
                ...constraints,
                deviceId: {
                    exact: cameraOptions.value
                }
            };
            startStream(updatedConstraints);
        }
    };

    const pauseStream = () => {
        video.pause();
        play.classList.remove('d-none');
        pause.classList.add('d-none');
    };

    const doScreenshot = () => {
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        canvas.getContext('2d').drawImage(video, 0, 0);
        screenshotImage.src = canvas.toDataURL('image/webp');
        screenshotImage.classList.remove('d-none');
    };

    pause.onclick = pauseStream;
    screenshot.onclick = doScreenshot;

    const startStream = async (constraints) => {
        const stream = await navigator.mediaDevices.getUserMedia(constraints);
        handleStream(stream);
    };


    const handleStream = (stream) => {
        video.srcObject = stream;
        play.classList.add('d-none');
        pause.classList.remove('d-none');
        screenshot.classList.remove('d-none');

    };


    const getCameraSelection = async () => {
        const devices = await navigator.mediaDevices.enumerateDevices();
        const videoDevices = devices.filter(device => device.kind === 'videoinput');
        const options = videoDevices.map(videoDevice => {
            return `<option value="${videoDevice.deviceId}">${videoDevice.label}</option>`;
        });
        cameraOptions.innerHTML = options.join('');
    };

    getCameraSelection();

</script>

<!-- BACK-TO-TOP -->
<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>
