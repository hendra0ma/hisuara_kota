@extends('layouts.main-user')

@section('content')

<div class="row mt-3">
    <div class="col-lg-4">
        <h1 class="page-title fs-1 mt-2">Dashboard
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Administrator 1
                <!-- Kota -->
            </li>
        </ol>
    </div>
</div>


<div class="row mt-5" id="user-profile">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="wideget-user">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xl-6">
                            <div class="wideget-user-desc d-sm-flex">
                                <div class="wideget-user-img">
                                    <img class="" src="{{ Auth::user()->profile_photo_url }}" alt="img">
                                </div>
                                <div class="user-wrap">
                                    <h4>{{Auth::user()->name}}</h4>
                                    <?php $date = Carbon\Carbon::createFromFormat('Y-m-d', explode(" ",Auth::user()->created_at)[0]) ?>
                                    <h6 class="text-muted mb-3">Member Since: {{$date->format("Y F d")}}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-xl-6">
                            <div class="text-xl-right mt-4 mt-xl-0">
                                <a href="emailservices.html" class="btn btn-white">Message</a>
                                <a href="edit_profile" class="btn btn-primary">Edit Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-top">
                <div class="wideget-user-tab">
                    <div class="tab-menu-heading">
                        <div class="tabs-menu1">
                            <ul class="nav">
                                <li class=""><a href="#tab-51" class="active show" data-bs-toggle="tab">Profile</a></li>
                                <li><a href="#tab-61" data-bs-toggle="tab" class="">Friends</a></li>
                                <li><a href="#tab-71" data-bs-toggle="tab" class="">Gallery</a></li>
                                <li><a href="#tab-81" data-bs-toggle="tab" class="">Followers</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane active show" id="tab-51">
                <div id="profile-log-switch">
                    <div class="card">
                        <div class="card-body">
                            <div class="media-heading">
                                <h5><strong>Personal Information</strong></h5>
                            </div>
                            <div class="table-responsive ">
                                <table class="table row table-borderless">
                                    <tbody class="col-lg-12 col-xl-6 p-0">
                                        <tr>
                                            <td><strong>Full Name :</strong> Elizabeth Dyer</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Location :</strong> USA</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Languages :</strong> English, German, Spanish.</td>
                                        </tr>
                                    </tbody>
                                    <tbody class="col-lg-12 col-xl-6 p-0">
                                        <tr>
                                            <td><strong>Website :</strong> abcdz.com</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Email :</strong> georgemestayer@abcdz.com</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Phone :</strong> +125 254 3562 </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row profie-img">
                                <div class="col-md-12">
                                    <div class="media-heading">
                                        <h5><strong>Biography</strong></h5>
                                    </div>
                                    <p>
                                        Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo
                                        minus id quod maxime placeat facere possimus, omnis voluptas assumenda est,
                                        omnis dolor repellendus</p>
                                    <p class="mb-0">because it is pleasure, but because those who do not know how to
                                        pursue pleasure rationally encounter but because those who do not know how to
                                        pursue consequences that are extremely painful. Nor again is there anyone who
                                        loves or pursues or desires to obtain pain of itself, because it is pain, but
                                        because occasionally circumstances occur in which toil and pain can procure him
                                        some great pleasure.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab-61">
                <ul class="widget-users row  mb-5">
                    <li class="col-lg-4  col-md-6 col-sm-12 col-12">
                        <div class="card border p-0">
                            <a href="profile.html">
                                <div class="card-body text-center">
                                    <span class="avatar avatar-xxl brround cover-image"
                                        data-bs-image-src="../../assets/images/users/15.jpg"></span>
                                    <h4 class="fs-16 mb-0 mt-3 text-dark fw-semibold">James Thomas</h4>
                                    <span class="text-muted">Web designer</span>
                                </div>
                            </a>
                            <div class="card-footer text-center">
                                <div class="row user-social-detail">
                                    <a href="#" class="social-profile me-4 rounded text-center">
                                        <i class="fa fa-google"></i>
                                    </a>
                                    <a href="#" class="social-profile me-4 rounded text-center">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                    <a href="#" class="social-profile  rounded text-center">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="card border p-0">
                            <a href="profile.html">
                                <div class="card-body text-center">
                                    <span class="avatar avatar-xxl brround cover-image"
                                        data-bs-image-src="../../assets/images/users/9.jpg"></span>
                                    <h4 class="fs-16 mb-0 mt-3 text-dark fw-semibold">George Clooney</h4>
                                    <span class="text-muted">Web designer</span>
                                </div>
                            </a>
                            <div class="card-footer text-center">
                                <div class="row user-social-detail">
                                    <a href="#" class="social-profile me-4 rounded text-center">
                                        <i class="fa fa-google"></i>
                                    </a>
                                    <a href="#" class="social-profile me-4 rounded text-center">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                    <a href="#" class="social-profile  rounded text-center">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="card border p-0">
                            <a href="profile.html">
                                <div class="card-body text-center">
                                    <span class="avatar avatar-xxl brround cover-image"
                                        data-bs-image-src="../../assets/images/users/20.jpg"></span>
                                    <h4 class="fs-16 mb-0 mt-3 text-dark fw-semibold">Robert Downey Jr.</h4>
                                    <span class="text-muted">Web designer</span>
                                </div>
                            </a>
                            <div class="card-footer text-center">
                                <div class="row user-social-detail">
                                    <a href="#" class="social-profile me-4 rounded text-center">
                                        <i class="fa fa-google"></i>
                                    </a>
                                    <a href="#" class="social-profile me-4 rounded text-center">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                    <a href="#" class="social-profile  rounded text-center">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="card border p-0 mb-lg-0">
                            <a href="profile.html">
                                <div class="card-body text-center">
                                    <span class="avatar avatar-xxl brround cover-image"
                                        data-bs-image-src="../../assets/images/users/12.jpg"></span>
                                    <h4 class="fs-16 mb-0 mt-3 text-dark fw-semibold">Emma Watson</h4>
                                    <span class="text-muted">Web designer</span>
                                </div>
                            </a>
                            <div class="card-footer text-center">
                                <div class="row user-social-detail">
                                    <a href="#" class="social-profile me-4 rounded text-center">
                                        <i class="fa fa-google"></i>
                                    </a>
                                    <a href="#" class="social-profile me-4 rounded text-center">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                    <a href="#" class="social-profile  rounded text-center">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="card border p-0 mb-lg-0">
                            <a href="profile.html">
                                <div class="card-body text-center">
                                    <span class="avatar avatar-xxl brround cover-image"
                                        data-bs-image-src="../../assets/images/users/4.jpg"></span>
                                    <h4 class="fs-16 mb-0 mt-3 text-dark fw-semibold">Mila Kunis</h4>
                                    <span class="text-muted">Web designer</span>
                                </div>
                            </a>
                            <div class="card-footer text-center">
                                <div class="row user-social-detail">
                                    <a href="#" class="social-profile me-4 rounded text-center">
                                        <i class="fa fa-google"></i>
                                    </a>
                                    <a href="#" class="social-profile me-4 rounded text-center">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                    <a href="#" class="social-profile  rounded text-center">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="card border p-0 mb-0">
                            <div class="card-body text-center">
                                <span class="avatar avatar-xxl brround cover-image"
                                    data-bs-image-src="../../assets/images/users/6.jpg"></span>
                                <a href="profile.html">
                                    <h4 class="fs-16 mb-0 mt-3 text-dark fw-semibold">Ryan Gossling</h4>
                                </a>
                                <span class="text-muted">Web designer</span>
                            </div>
                            <div class="card-footer text-center">
                                <div class="row user-social-detail">
                                    <a href="#" class="social-profile me-4 rounded text-center">
                                        <i class="fa fa-google"></i>
                                    </a>
                                    <a href="#" class="social-profile me-4 rounded text-center">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                    <a href="#" class="social-profile  rounded text-center">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="tab-pane" id="tab-71">
                <div class="row  mb-5 img-gallery" id="lightgallery">
                    <div class="col-lg-3 col-md-6" data-responsive="../../assets/images/media/8.jpg"
                        data-src="../../assets/images/media/8.jpg">
                        <a href="#"><img class="img-fluid mb-2 br-7" src="../../assets/images/media/8.jpg "
                                alt="banner image"></a>
                    </div>
                    <div class="col-lg-3 col-md-6" data-responsive="../../assets/images/media/10.jpg"
                        data-src="../../assets/images/media/10.jpg">
                        <a href="#"><img class="img-fluid mb-2 br-7" src="../../assets/images/media/10.jpg"
                                alt="banner image "></a>
                    </div>
                    <div class="col-lg-3 col-md-6" data-responsive="../../assets/images/media/11.jpg"
                        data-src="../../assets/images/media/11.jpg">
                        <a href="#"><img class="img-fluid  mb-2 br-7" src="../../assets/images/media/11.jpg"
                                alt="banner image "></a>
                    </div>
                    <div class="col-lg-3 col-md-6" data-responsive="../../assets/images/media/12.jpg"
                        data-src="../../assets/images/media/12.jpg">
                        <a href="#"><img class="img-fluid  mb-2 br-7" src="../../assets/images/media/12.jpg"
                                alt="banner image "></a>
                    </div>
                    <div class="col-lg-3 col-md-6" data-responsive="../../assets/images/media/13.jpg"
                        data-src="../../assets/images/media/13.jpg">
                        <a href="#"><img class="img-fluid  mb-2 br-7" src="../../assets/images/media/13.jpg "
                                alt="banner image"></a>
                    </div>
                    <div class="col-lg-3 col-md-6" data-responsive="../../assets/images/media/14.jpg"
                        data-src="../../assets/images/media/14.jpg">
                        <a href="#"><img class="img-fluid  mb-2 br-7" src="../../assets/images/media/14.jpg "
                                alt="banner image"></a>
                    </div>
                    <div class="col-lg-3 col-md-6" data-responsive="../../assets/images/media/15.jpg"
                        data-src="../../assets/images/media/15.jpg">
                        <a href="#"><img class="img-fluid mb-2 br-7" src="../../assets/images/media/15.jpg "
                                alt="banner image"></a>
                    </div>
                    <div class="col-lg-3 col-md-6" data-responsive="../../assets/images/media/16.jpg"
                        data-src="../../assets/images/media/16.jpg">
                        <a href="#"><img class="img-fluid mb-0 br-7" src="../../assets/images/media/16.jpg "
                                alt="banner image"></a>
                    </div>
                    <div class="col-lg-3 col-md-6" data-responsive="../../assets/images/media/17.jpg"
                        data-src="../../assets/images/media/17.jpg">
                        <a href="#"><img class="img-fluid mb-0 br-7" src="../../assets/images/media/17.jpg "
                                alt="banner image"></a>
                    </div>
                    <div class="col-lg-3 col-md-6" data-responsive="../../assets/images/media/18.jpg"
                        data-src="../../assets/images/media/18.jpg">
                        <a href="#"><img class="img-fluid mb-0 br-7" src="../../assets/images/media/18.jpg "
                                alt="banner image"></a>
                    </div>
                    <div class="col-lg-3 col-md-6" data-responsive="../../assets/images/media/19.jpg"
                        data-src="../../assets/images/media/19.jpg">
                        <a href="#"><img class="img-fluid mb-0 br-7" src="../../assets/images/media/19.jpg "
                                alt="banner image"></a>
                    </div>
                    <div class="col-lg-3 col-md-6" data-responsive="../../assets/images/media/20.jpg"
                        data-src="../../assets/images/media/20.jpg">
                        <a href="#"><img class="img-fluid br-7" src="../../assets/images/media/20.jpg "
                                alt="banner image"></a>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab-71">
                <div class="row  mb-5">
                    <div class=" col-lg-6 col-md-12">
                        <div class="card border p-0 over-flow-hidden">
                            <div class="media card-body media-xs overflow-visible ">
                                <img class="avatar brround avatar-md me-3" src="../../assets/images/users/18.jpg"
                                    alt="avatar-img">
                                <div class="media-body valign-middle">
                                    <a href="" class=" fw-semibold text-dark">John Paige</a>
                                    <p class="text-muted mb-0">johan@gmail.com</p>
                                </div>
                                <div class="media-body valign-middle text-end overflow-visible mt-2">
                                    <button class="btn btn-primary" type="button">Follow</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-6 col-md-12">
                        <div class="card border p-0 over-flow-hidden">
                            <div class="media card-body media-xs overflow-visible ">
                                <span class="avatar cover-image avatar-md brround bg-pink me-3">LQ</span>
                                <div class="media-body valign-middle mt-0">
                                    <a href="" class="fw-semibold text-dark">Lillian Quinn</a>
                                    <p class="text-muted mb-0">lilliangore</p>
                                </div>
                                <div class="media-body valign-middle text-end overflow-visible mt-1">
                                    <button class="btn btn-primary" type="button">Follow</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-6 col-md-12">
                        <div class="card border p-0 over-flow-hidden mb-lg-0">
                            <div class="media card-body media-xs overflow-visible ">
                                <span class="avatar cover-image avatar-md brround me-3 bg-primary">IH</span>
                                <div class="media-body valign-middle mt-0">
                                    <a href="" class="fw-semibold text-dark">Irene Harris</a>
                                    <p class="text-muted mb-0">ireneharris@gmail.com</p>
                                </div>
                                <div class="media-body valign-middle text-end overflow-visible mt-1">
                                    <button class="btn btn-primary" type="button">Follow</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-6 col-md-12">
                        <div class="card border p-0 over-flow-hidden mb-lg-0">
                            <div class="media card-body media-xs overflow-visible ">
                                <img class="avatar brround avatar-md me-3" src="../../assets/images/users/2.jpg"
                                    alt="avatar-img">
                                <div class="media-body valign-middle mt-0">
                                    <a href="" class="text-dark fw-semibold">Harry Fisher</a>
                                    <p class="text-muted mb-0">harryuqt</p>
                                </div>
                                <div class="media-body valign-middle text-end overflow-visible mt-1">
                                    <button class="btn btn-primary" type="button">Follow</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-6 col-md-12">
                        <div class="card border p-0 over-flow-hidden">
                            <div class="media card-body media-xs overflow-visible ">
                                <span class="avatar cover-image avatar-md brround bg-pink me-3">AB</span>
                                <div class="media-body valign-middle mt-0">
                                    <a href="" class="fw-semibold text-dark">Aida Bugg</a>
                                    <p class="text-muted mb-0">Aidasr</p>
                                </div>
                                <div class="media-body valign-middle text-end overflow-visible mt-1">
                                    <button class="btn btn-primary" type="button">Follow</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-6 col-md-12">
                        <div class="card border p-0 over-flow-hidden">
                            <div class="media card-body media-xs overflow-visible ">
                                <span class="avatar cover-image avatar-md brround bg-pink me-3">LQ</span>
                                <div class="media-body valign-middle mt-0">
                                    <a href="" class="fw-semibold text-dark">Lillian Quinn</a>
                                    <p class="text-muted mb-0">lilliangore</p>
                                </div>
                                <div class="media-body valign-middle text-end overflow-visible mt-1">
                                    <button class="btn btn-primary" type="button">Follow</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab-81">
                <div class="row">
                    <div class=" col-lg-6 col-md-12">
                        <div class="card border p-0 over-flow-hidden">
                            <div class="media card-body media-xs overflow-visible ">
                                <img class="avatar brround avatar-md me-3" src="../../assets/images/users/18.jpg"
                                    alt="avatar-img">
                                <div class="media-body valign-middle">
                                    <a href="" class=" fw-semibold text-dark">John Paige</a>
                                    <p class="text-muted mb-0">johan@gmail.com</p>
                                </div>
                                <div class="media-body valign-middle text-end overflow-visible mt-2">
                                    <button class="btn btn-primary" type="button">Follow</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-6 col-md-12">
                        <div class="card border p-0 over-flow-hidden">
                            <div class="media card-body media-xs overflow-visible ">
                                <span class="avatar cover-image avatar-md brround bg-pink me-3">LQ</span>
                                <div class="media-body valign-middle mt-0">
                                    <a href="" class="fw-semibold text-dark">Lillian Quinn</a>
                                    <p class="text-muted mb-0">lilliangore</p>
                                </div>
                                <div class="media-body valign-middle text-end overflow-visible mt-1">
                                    <button class="btn btn-primary" type="button">Follow</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-6 col-md-12">
                        <div class="card border p-0 over-flow-hidden mb-lg-0">
                            <div class="media card-body media-xs overflow-visible ">
                                <span class="avatar cover-image avatar-md brround me-3 bg-primary">IH</span>
                                <div class="media-body valign-middle mt-0">
                                    <a href="" class="fw-semibold text-dark">Irene Harris</a>
                                    <p class="text-muted mb-0">ireneharris@gmail.com</p>
                                </div>
                                <div class="media-body valign-middle text-end overflow-visible mt-1">
                                    <button class="btn btn-primary" type="button">Follow</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-6 col-md-12">
                        <div class="card border p-0 over-flow-hidden">
                            <div class="media card-body media-xs overflow-visible ">
                                <img class="avatar brround avatar-md me-3" src="../../assets/images/users/3.jpg"
                                    alt="avatar-img">
                                <div class="media-body valign-middle mt-0">
                                    <a href="" class="text-dark fw-semibold">Saureen Bgist</a>
                                    <p class="text-muted mb-0">harryuqt</p>
                                </div>
                                <div class="media-body valign-middle text-end overflow-visible mt-1">
                                    <button class="btn btn-primary" type="button">Follow</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-6 col-md-12">
                        <div class="card border p-0 over-flow-hidden">
                            <div class="media card-body media-xs overflow-visible ">
                                <img class="avatar brround avatar-md me-3" src="../../assets/images/users/2.jpg"
                                    alt="avatar-img">
                                <div class="media-body valign-middle mt-0">
                                    <a href="" class="text-dark fw-semibold">Maureen Biologist</a>
                                    <p class="text-muted mb-0">harryuqt</p>
                                </div>
                                <div class="media-body valign-middle text-end overflow-visible mt-1">
                                    <button class="btn btn-primary" type="button">Follow</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-6 col-md-12">
                        <div class="card border p-0 over-flow-hidden">
                            <div class="media card-body media-xs overflow-visible ">
                                <span class="avatar cover-image avatar-md brround me-3 bg-info">PF</span>
                                <div class="media-body valign-middle mt-0">
                                    <a href="" class="fw-semibold text-dark">Paddy O'Furniture.</a>
                                    <p class="text-muted mb-0">ireneharris@gmail.com</p>
                                </div>
                                <div class="media-body valign-middle text-end overflow-visible mt-1">
                                    <button class="btn btn-primary" type="button">Follow</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- COL-END -->
</div>
<!-- ROW-1 CLOSED -->

@endsection
