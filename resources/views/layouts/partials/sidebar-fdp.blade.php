<?php

use App\Models\Config;
use App\Models\District;
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
                </li> -->
            <!--   <li class="mt-3">
                    <span>
                        <a href="#" class="text-dark">
                            <center>
                                <b>{{$kota['name']}}</b>
                            </center>
                        </a>
                    </span>
                </li> -->
                <li class="mt-5">
                    <center>
                        <img src="{{asset('images/logo')}}/rekapitung_gold.png" style="width:120px;height:auto">
                    </center>
                </li>
                <li>
                    <h3>Main</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="{{url('/')}}/administrator/fraud-data-print"><i class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Data Kecurangan Masuk</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="{{url('/')}}/administrator/fraud-data-print-tercetak"><i class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Data Tercetak</span></a>
                </li>
                <hr>
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
        <div class="modal fade" id="modalCommander" tabindex="-1" aria-labelledby="modalCommanderLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCommanderLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p id="text-container">

                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form action="{{url('')}}/administrator/main-permission" id="form-izin" method="post">
                            @csrf
                            <input type="hidden" value="" name="izin">
                            <input type="hidden" value="" name="jenis">
                            @if(Cookie::get('multi') != null)
                            <input type="hidden" name="order" value="{{Cookie::get('multi')}}">
                            @endif
                            <button type="submit" class="btn btn-dark">Minta Izin Fitur</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const buttonModal = $('.side-menu__item.modal-action');
            buttonModal.on('click', function() {
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



        <!--/APP-SIDEBAR-->