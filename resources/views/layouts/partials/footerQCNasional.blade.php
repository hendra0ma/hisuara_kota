</div>
</div>
<!-- CONTAINER END -->
</div>

<style>
    /* Button used to open the chat form - fixed at the bottom of the page */
    .open-button {
        background-color: #555;
        color: white;
        padding: 16px 20px;
        border: none;
        cursor: pointer;
        opacity: 0.8;
        position: fixed;
        bottom: 23px;
        right: 28px;
        width: 280px;
    }

    /* The popup chat - hidden by default */
    .chat-popup {
        display: none;
        position: fixed;
        bottom: 0;
        right: 15px;
        border: 3px solid #f1f1f1;
        z-index: 9;
    }

    /* Add styles to the form container */
    .form-container {
        width: 400px;
        padding: 10px;
        background-color: white;
    }

    /* Full-width textarea */
    .form-container textarea {
        width: 500px;
        padding: 15px;
        margin: 5px 0 22px 0;
        border: none;
        background: #f1f1f1;
        resize: none;
        min-height: 200px;
    }

    /* When the textarea gets focus, do something */
    .form-container textarea:focus {
        background-color: #ddd;
        outline: none;
    }
</style>

<!-- Modal -->
<div class="modal fade" id="chat" tabindex="-1" role="dialog" aria-labelledby="chatMessage" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chat Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="message-menu" style="overflow-y:scroll;height:500px">
                        <?php

 $allUser = App\Models\User::where('id',"!=",Auth::user()->id)->where('role_id','!=',8)->where('role_id','!=',0)->where('role_id','!=',14)->get(); ?>
                        @foreach($allUser as $usr)
                        <button class="btn btn-primary rounded-0 w-100 mb-2" data-bs-dismiss="modal" type="button"
                            onclick="openForm('{{$usr->id}}')">{{$usr->name}}</button>
                        @endforeach
                    </div>
                </div>
             </div>
               
        </div>
    </div>
</div>

<div class="chat-popup" style="z-index: 1070;" id="myForm">
    <div class="form-container text-center">
        <h1 class="mb-0 mt-2 mb-2"><img src="{{url('/')}}/images/logo/rekapitung_gold.png" style="width:75px;height:auto"></h1>
        <h5 class="fw-bold">Live Chat Support Sistem</h5>

        <div class="main-content-app pt-0">
            <div class="main-content-body main-content-body-chat">
                <hr>
                <livewire:chat-person />

                <livewire:chat-input-person />
                <button onclick="closeForm()" class="btn btn-danger">TUTUP</button>
            </div>
        </div>
    </div>
</div>




<script>
    var chat = document.getElementById('chat');

    chat.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        let button = event.relatedTarget;
        // Extract info from data-bs-* attributes
        let recipient = button.getAttribute('data-bs-whatever');

        // Use above variables to manipulate the DOM
    });

</script>


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
                                <img alt="user-img" class="avatar avatar-xl brround mx-auto text-center"
                                    src="{{ Auth::user()->profile_photo_url }}"><span
                                    class="avatar-status profile-status bg-green"></span>
                            </div>
                            <div class="user-info mg-t-20">
                                <h6 class="fw-semibold  mt-2 mb-0">{{ Auth::user()->name }}</h6>
                                <span
                                    class="mb-0 text-muted fs-12">{{ Auth::user()->role_id == 1 ?"Administrator":"uwon luyi"; }}</span>
                            </div>
                        </div>
                    </div>
                    <a class="dropdown-item d-flex border-bottom border-top" href="/user/profile">
                        <div class="d-flex"><i class="fe fe-user me-3 tx-20 text-muted"></i>
                            <div class="pt-1">
                                <h6 class="mb-0">My Profile</h6>
                                <p class="tx-12 mb-0 text-muted">Profile Personal information</p>
                            </div>
                        </div>
                    </a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf

                        <a class="dropdown-item d-flex border-bottom" style="cursor: pointer"
                            onclick="$($(this).parent()).submit()">
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
                Copyright © 2024 <a href="#">Hisuara Smart Count</a>. Designed with <span
                    class="fa fa-heart text-danger"></span>
                by <a href="https://yudicp.com"> Yudi C Prawira </a> All rights reserved
            </div>
        </div>
    </div>
</footer>
<!-- FOOTER END -->
</div>

<!-- BACK-TO-TOP -->
<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>
