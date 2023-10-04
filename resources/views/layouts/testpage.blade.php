@extends('layouts/mainlayout')

@section('content')

                    <!-- PAGE-HEADER -->
                    <div class="page-header">
                        <div class="col-lg-12">

                            <div class="row">
                                <div class="col-lg-4">
                                    <h1 class="page-title fs-1 mt-2">Dashboard
                                        <!-- Kota -->
                                    </h1>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Dashboard
                                            <!-- Kota -->
                                        </li>
                                    </ol>
                                </div>
                                <div class="col-lg-8 justify-content-end mt-2">
                                    <div class="row">
                                        <div class="col-lg-4 justify-content-end" style="padding-left: 0;">
                                            <div class="card">
                                                <div class="card-header bg-secondary">
                                                    <div class="card-title">Real Count</div>
                                                </div>
                                                <div class="card-body">
                                                    <p class="">8.999999%</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4" style="padding-right: 0.5rem; padding-left: 0.5rem;">
                                            <div class="card">
                                                <div class="card-header bg-success">
                                                    <div class="card-title">TPS Masuk</div>
                                                </div>
                                                <div class="card-body">
                                                    <p class="">4764</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4" style="padding-right: 0;">
                                            <div class="card">
                                                <div class="card-header bg-primary">
                                                    <div class="card-title">Suara Masuk</div>
                                                </div>
                                                <div class="card-body">
                                                    <p class="">87841</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- PAGE-HEADER END -->

                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Suara TPS Masuk</h3>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">Progress 8.999% dari 100%</div>
                                    <div id="chart-pie" class="chartsh"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Suara TPS Terverifikasi</h3>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">Terverifikasi 4 TPS dari 476 TPS Masuk</div>
                                    <div id="chart-donut" class="chartsh"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-header">
                                        <div class="card-title">Suara Masuk</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-lg-4 col-md-12 col-sm-12 col-xl-3">
                                                <div class="card overflow-hidden" style="margin-bottom: 0px;">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h6 class="">Suara Paslon 01</h6>
                                                                <h3 class="mb-2 number-font">36478</h3>
                                                            </div>
                                                            <div class="col col-auto">
                                                                <div class="counter-icon bg-primary-gradient box-shadow-primary brround ms-auto"
                                                                    style="margin-bottom: 0;">
                                                                    A
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-12 col-sm-12 col-xl-3">
                                                <div class="card overflow-hidden" style="margin-bottom: 0px;">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h6 class="">Suara Paslon 02</h6>
                                                                <h3 class="mb-2 number-font">21431</h3>
                                                            </div>
                                                            <div class="col col-auto">
                                                                <div class="counter-icon bg-danger-gradient box-shadow-danger brround ms-auto"
                                                                    style="margin-bottom: 0;">
                                                                    B
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12 col-xl-3">
                                                <div class="card overflow-hidden" style="margin-bottom: 0px;">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h6 class="">Suara Paslon 03</h6>
                                                                <h3 class="mb-2 number-font">29850</h3>
                                                            </div>
                                                            <div class="col col-auto">
                                                                <div class="counter-icon bg-secondary-gradient box-shadow-secondary brround ms-auto"
                                                                    style="margin-bottom: 0;">
                                                                    C
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12 col-xl-3">
                                                <div class="card overflow-hidden" style="margin-bottom: 0px;">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h6 class="">Suara Paslon 04</h6>
                                                                <h3 class="mb-2 number-font">36478</h3>
                                                            </div>
                                                            <div class="col col-auto">
                                                                <div class="counter-icon bg-success-gradient box-shadow-success brround ms-auto"
                                                                    style="margin-bottom: 0;">
                                                                    D
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-header">
                                        <div class="card-title">
                                            Suara Terverifikasi
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-12 col-sm-12 col-xl-3">
                                                <div class="card overflow-hidden" style="margin-bottom: 0;">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h6 class="">Suara Paslon 01</h6>
                                                                <h3 class="mb-2 number-font">36478</h3>
                                                            </div>
                                                            <div class="col col-auto">
                                                                <div class="counter-icon bg-primary-gradient box-shadow-primary brround ms-auto"
                                                                    style="margin-bottom: 0;">
                                                                    A
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12 col-xl-3">
                                                <div class="card overflow-hidden" style="margin-bottom: 0;">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h6 class="">Suara Paslon 02</h6>
                                                                <h3 class="mb-2 number-font">21431</h3>
                                                            </div>
                                                            <div class="col col-auto">
                                                                <div class="counter-icon bg-danger-gradient box-shadow-danger brround ms-auto"
                                                                    style="margin-bottom: 0;">
                                                                    B
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12 col-xl-3">
                                                <div class="card overflow-hidden" style="margin-bottom: 0;">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h6 class="">Suara Paslon 03</h6>
                                                                <h3 class="mb-2 number-font">29850</h3>
                                                            </div>
                                                            <div class="col col-auto">
                                                                <div class="counter-icon bg-secondary-gradient box-shadow-secondary brround ms-auto"
                                                                    style="margin-bottom: 0;">
                                                                    C
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12 col-xl-3">
                                                <div class="card overflow-hidden" style="margin-bottom: 0;">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h6 class="">Suara Paslon 04</h6>
                                                                <h3 class="mb-2 number-font">36478</h3>
                                                            </div>
                                                            <div class="col col-auto">
                                                                <div class="counter-icon bg-success-gradient box-shadow-success brround ms-auto"
                                                                    style="margin-bottom: 0;">
                                                                    D
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Suara Masuk (Seluruh Kecamatan)</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <td>Wilayah</td>
                                            <td>Suara 01</td>
                                            <td>Suara 02</td>
                                            <td>Suara 03</td>
                                        </thead>
                                        <tbody>
                                            <!-- Foreach here -->
                                            <tr>
                                                <td>Serpong</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Suara Terverifikasi (Seluruh Kecamatan)</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <td>Wilayah</td>
                                            <td>Suara 01</td>
                                            <td>Suara 02</td>
                                            <td>Suara 03</td>
                                        </thead>
                                        <tbody>
                                            <!-- Foreach here -->
                                            <tr>
                                                <td>Serpong</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mg-b-20">
                        <div class="card-header">
                            <div class="card-title">Admin Tracking</div>
                        </div>
                        <div class="card-body">
                            <div class="ht-300" id="map" style="height:300px"></div>
                        </div>
                    </div>
                
@endsection