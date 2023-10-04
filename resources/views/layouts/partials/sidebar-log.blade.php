<?php

use App\Models\Config;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Tps;
use Illuminate\Support\Facades\DB;

$config = Config::all()->first();
$regency = District::where('regency_id', $config['regencies_id'])->get();
$kota = Regency::where('id', $config['regencies_id'])->first();
$dpt = District::where('regency_id', $config['regencies_id'])->sum('dpt');
$tps = 2963;
?>
<!-- GLOBAL-LOADER -->
<div id="global-loader">
    <img src="{{url('/')}}/assets/images/loader.svg" class="loader-img" alt="Loader">
</div>
<!-- /GLOBAL-LOADER -->

<!-- PAGE -->
<div class="page">
    <div class="page-main">
        <!--APP-SIDEBAR-->
        <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
        <aside class="app-sidebar">
            <div class="side-header">
                <a class="header-brand1" href="{{url('')}}/administrator/index">

                    <h3 class="text-dark">
                        <b>
                            {{$config['jenis_pemilu']}}  {{$config['tahun']}}
                        </b>
                    </h3>
                </a>
            </div>
            <ul class="side-menu">
                <!-- <li class="my-2">
                    &nbsp;
                </li>
                <li class="mt-5">
                    <center>
                        <img src="{{asset('storage').'/'.$config['regencies_logo']}}" style="width:120px;height:auto">
                    </center>
                </li>
                <li class="mt-3">
                    <span>
                        <a href="#" class="text-dark">
                            <center>
                                <b>{{$kota['name']}}</b>
                            </center>
                        </a>
                    </span>
                </li> -->

                <li class="my-2">
                    &nbsp;
                </li>
                <li class="mt-5">
                    <center>
                        <img src="{{asset('images/logo')}}/rekapitung_gold.png" style="width:120px;height:auto">
                    </center>
                </li>
                <?php
                    $props = Province::where('id',$kota['province_id'])->first();
                    $cityProp = Regency::where('province_id',$kota['province_id'])->get();
                
                ?>
                

                <li>
                    <!-- <a class="side-menu__item" href="#"><i class="side-menu__icon mdi mdi-logout"></i><span class="side-menu__label">Logout</span></a> -->
                    <form action="{{ route('logout') }}" method="post">
                        @csrf


                        <a class="side-menu__item" onclick="$($(this).parent()).submit()" style="cursor: pointer">
                            <i class="side-menu__icon mdi mdi-logout"></i> Sign out
                        </a>
                    </form>
                </li>

            </ul>
        </aside>
        <div class="modal fade" style="background-image: url({{url('')}}/storage/satelit.jpg); background-repeat: no-repeat;
                background-size: cover;" id="modalCommander" tabindex="-1" aria-labelledby="modalCommanderLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content" style="background-color: black;">
                    <div class="modal-header">
                        <div class="row w-100 justify-content-end  align-items-center">
                            <div class="col-md">
                                <!--<h5 class="modal-title text-white my-auto" id="modalCommanderLabel"></h5>-->
                                <span><img src="{{url('')}}/images/logo/rekapitung_gold.png" style="width:100px" alt=""> <b
                                        class="text-white fs-3">COMMANDER MODE</b></span>
                            </div>
                            <div class="col-md-5">
                                <b class="text-white fs-5 d-flex justify-content-end align-items-center my-auto align-self-center"
                                    id="modalCommanderLabel"></b>
                            </div>
                        </div>

                    </div>
                    <form action="{{url('')}}/administrator/main-permission" id="form-izin" method="post">
                        @csrf
                        <input type="hidden" value="" name="izin">
                        <input type="hidden" value="" name="jenis">
                        <input type="hidden" name="order" value="{{Auth::user()->id}}">
                        <div class="modal-body">
                            <p id="text-container" class="text-white">

                            </p>
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="number" class="form-control" name="kode" placeholder="kode">
                                </div>
                            </div>
                            <input type="hidden" name="order" value="{{Auth::user()->id}}">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Commander Permission</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" style="background-image: url({{url('')}}/storage/satelit.jpg); background-repeat: no-repeat;
                background-size: cover;" id="modalMap" tabindex="-1" aria-labelledby="modalCommanderLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content bg-dark">
                    <div class="modal-header">
                        <div class="row w-100 justify-content-end  align-items-center">
                            <div class="col-md">
                                <span><img src="{{url('')}}/public/storage/alien.png" style="width:100px" alt=""> <b
                                        class="text-white fs-3" style="margin-left: -20px;">DETAIL TRACKING</b></span>
                            </div>
                            <div class="col-md-5">
                                <b class="text-white fs-5 d-flex justify-content-end align-items-center my-auto align-self-center"
                                    id="modalCommanderLabel"></b>
                            </div>
                        </div>

                    </div>
                    <form action="{{url('')}}/administrator/main-permission" id="form-izin" method="post">
                        @csrf
                        <input type="hidden" value="" name="izin">
                        <input type="hidden" value="" name="jenis">
                        <input type="hidden" name="order" value="{{Auth::user()->id}}">
                        <div class="modal-body">
                            <p id="text-container" class="text-white">

                            </p>
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="number" class="form-control" name="kode" placeholder="kode">
                                </div>
                            </div>
                            <input type="hidden" name="order" value="{{Auth::user()->id}}">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Commander Permission</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-dark">
                    <div class="modal-header">
                        <div class="row w-100 justify-content-end  align-items-center">
                            <div class="col-md">
                                <!--<h5 class="modal-title text-white my-auto" id="modalCommanderLabel"></h5>-->
                                <span><b
                                        class="text-white fs-3 p-2">COMMANDER CODE</b></span>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-white">
                        <h3>

                            @if ($message = Session::get('error'))
                            {{$message}}
                            @endif
                        </h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>

        <style>
            p#text-container {
                font-size: 16px;
            }

        </style>

        <script>
            @if($message = Session::get('error'))
            $(document).ready(function () {
                let alertModal = new bootstrap.Modal(document.getElementById('alertModal'), {
                    keyboard: false
                });
                alertModal.show();
            });
            @endif


            const buttonModal = $('.modal-action');
            buttonModal.on('click', function () {
                const title = $(this).data('title');
                const inputIzin = $($('form#form-izin').find('input[name=izin]'));
                const izin = $(this).data('izin');
                const jenis = $(this).data('jenis');
                const inputjenis = $($('form#form-izin').find('input[name=jenis]'));
                const deskripsi = $(this).data('deskripsi');
                const containerTitle = $('#modalCommanderLabel');
                const containerDeskripsi = $('#text-container');
                inputIzin.val(izin)
                containerDeskripsi.html(deskripsi)
                containerTitle.html(title)
                inputjenis.val(jenis);
            });

        </script>