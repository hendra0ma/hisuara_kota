    
    <?php
    use App\Models\Config;
    use App\Models\Village;
    
    $config = Config::all()->first();
    // $district = Village::where('district_id',$kecamatan['id'])->get();
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
                    <li>
                        <span>
                            <a href="http://tangsel.rekapitung.com/input/login" class="text-dark">
                                <center>
                                    <b>
                                        KOTA TANGERANG SELATAN </b>
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
                        <a class="side-menu__item" data-bs-toggle="slide" href="index.html"><i
                                class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Admin Kecamatan</span></a>
                    </li>
                   
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="#"><i
                                class="side-menu__icon fe fe-globe"></i><span class="side-menu__label">Log Admin</span><i class="angle fa fa-angle-right"></i></a>
                        <ul class="slide-menu">
                            <li><a href="real-count.html" class="slide-item">Real Count</a></li>
                            <li><a href="maps2.html" class="slide-item">Quick Count</a></li>
                            <li><a href="maps.html" class="slide-item">Map Count</a></li>
                        </ul>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="#"><i
                                class="side-menu__icon fe fe-globe"></i><span class="side-menu__label">Keterangan </span><i class="angle fa fa-angle-right"></i></a>
                        <ul class="slide-menu">
                            <li><a href="real-count.html" class="slide-item">Real Count</a></li>
                            <li><a href="maps2.html" class="slide-item">Quick Count</a></li>
                            <li><a href="maps.html" class="slide-item">Map Count</a></li>
                        </ul>
                    </li>

                 
                 
                </ul>
            </aside>
            <!--/APP-SIDEBAR-->
