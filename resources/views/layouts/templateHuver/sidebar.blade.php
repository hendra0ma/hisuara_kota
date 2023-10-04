    <?php
    use App\Models\Config;
    use App\Models\District;
    
    $config = Config::all()->first();
    $regency = District::where('regency_id',$config['regencies_id'])->get();
    ?>
    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="../../assets/images/loader.svg" class="loader-img" alt="Loader">
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
                    </a><!-- LOGO -->
                </div>
                <ul class="side-menu">
                    <!-- <li class="my-2">
                        &nbsp;
                    </li>
                    <li class="mt-5">
                        <center>
                            <img src="{{asset('storage').'/'.$config['regencies_logo']}}"
                                style="width:120px;height:auto">
                        </center>
                    </li>
                    <li>
                        <span>
                            <a href="#" class="text-dark">
                                <center>
                                    <b>KOTA TANGERANG SELATAN </b>
                                </center>
                            </a>
                        </span>
                        
                    </li>    -->
                    <li class="mt-5">
                    <center>
                        <img src="{{asset('images/logo')}}/rekapitung_gold.png" style="width:120px;height:auto">
                    </center>
                </li>
                    <li>
                        <h3>Navigasi</h3>
                    </li>
                    <li class="slide is-expanded">
                        <a class="side-menu__item active" data-bs-toggle="slide" href="#"><i
                                class="side-menu__icon fe fe-grid"></i><span class="side-menu__label">Verifikasi
                                Akun</span><i class="angle fa fa-angle-right"></i></a>
                        <ul class="slide-menu open">
                            <li><a href="verifikasi_saksi" class="slide-item">Verifikasi Saksi</a></li>
                            <li><a href="verifikasi_akun" class="slide-item">Verifikasi Admin</a></li>
                        </ul>
                    </li>
                   
                </ul>
            </aside>
            <!--/APP-SIDEBAR-->
