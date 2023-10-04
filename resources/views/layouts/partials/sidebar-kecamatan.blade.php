    <?php

    use App\Models\Config;
    use App\Models\Village;

    $config = Config::all()->first();
    $district = Village::where('district_id', $kecamatan['id'])->get();
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


                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="/adminsitrator/index"><i class="side-menu__icon fe fe-home"></i><span class="side-menu__label">DPT/TPS
                                2020</span></a>
                    </li>
                    <li>
                        <h3>Navigasi</h3>
                    </li>
                    <li class="slide is-expanded">
                        <a class="side-menu__item " data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-globe"></i><span class="side-menu__label">Kelurahan</span><i class="angle fa fa-angle-right"></i></a>
                        <ul class="slide-menu open" style="display: block;">
                            @foreach ($district as $dc)
                            <li><a href="/key_kelurahan/{{encrypt($dc['id'])}}" class="slide-item">{{$dc['name']}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </aside>
            <!--/APP-SIDEBAR-->