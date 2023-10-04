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

<div class="row">
    <div class="col-lg-4 col-xl-4 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Edit Password</div>
            </div>
            <div class="card-body">
                <div class="d-flex mb-3">
                    <img alt="User Avatar" class="rounded-circle avatar-lg me-2" src="../../assets/images/users/8.jpg">
                    <div class="ms-auto mt-xl-2 mt-lg-0 me-lg-2">
                        <a href="editprofile.html" class="btn btn-primary btn-sm mt-1 mb-1"><i
                                class="fe fe-camera me-1"></i>Edit profile</a>
                        <a href="#" class="btn btn-danger btn-sm mt-1 mb-1"><i class="fe fe-camera-off me-1"></i>Delete
                            profile</a>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Current Password</label>
                    <input type="password" class="form-control" value="password">
                </div>
                <div class="form-group">
                    <label class="form-label">New Password</label>
                    <input type="password" class="form-control" value="password">
                </div>
                <div class="form-group">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" value="password">
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="#" class="btn btn-primary">Updated</a>
                <a href="#" class="btn btn-danger">Cancel</a>
            </div>
        </div>
        <div class="card panel-theme">
            <div class="card-header">
                <div class="float-start">
                    <h3 class="card-title">Contact</h3>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="card-body no-padding">
                <ul class="list-group no-margin">
                    <li class="list-group-item"><i
                            class="fa fa-envelope list-contact-icons border text-center br-100"></i> <span
                            class="contact-icons">support@demo.com</span></li>
                    <li class="list-group-item"><i
                            class="fa fa-globe list-contact-icons border text-center br-100"></i><span
                            class="contact-icons"> www.abcd.com</span></li>
                    <li class="list-group-item"><i class="fa fa-phone list-contact-icons border text-center br-100"></i>
                        <span class="contact-icons">+125 5826 3658 </span></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-xl-8 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Profile</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputname">Nama</label>
                    <input type="text" class="form-control" id="exampleInputname" placeholder="Nama">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Alamat Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Alamat Email">
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="#" class="btn btn-success mt-1">Save</a>
                <a href="#" class="btn btn-danger mt-1">Cancel</a>
            </div>
        </div>
    </div>
</div>
<!-- ROW-1 CLOSED -->
@endsection
