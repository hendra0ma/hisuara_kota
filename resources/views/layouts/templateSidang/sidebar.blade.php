       <?php

        use App\Models\Config;
        use App\Models\District;
        use App\Models\Regency;

        $config = Config::all()->first();
        $kota = Regency::where('id', $config['regencies_id'])->first();

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
                               <img src="{{asset('storage').'/'.$config['regencies_logo']}}" style="width:120px;height:auto">
                           </center>
                       </li>
                       <li class="mt-3">
                           <span>
                               <a href="http://tangsel.rekapitung.com/input/login" class="text-dark">
                                   <center>
                                       <b>
                                           {{$kota['name']}} </b>
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
                           <a class="side-menu__item" data-bs-toggle="slide" href="{{url('/')}}/administrator/sidang_online"><i class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Data Kecurangan Masuk</span></a>
                       </li>
                       <li class="slide">
                           <a class="side-menu__item" data-bs-toggle="slide" href="{{url('/')}}/administrator/sidang_online_status/{{encrypt("Ditolak")}}"><i class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Data Kecurangan Ditolak</span></a>
                       </li>
                       <li class="slide">
                           <a class="side-menu__item" data-bs-toggle="slide" href="{{url('/')}}/administrator/sidang_online_status/{{encrypt("Selesai")}}"><i class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Peserta Sidang Online</span></a>
                       </li>
                       <li class="slide">
                           <a class="side-menu__item" data-bs-toggle="slide" href="{{url('/')}}/administrator/sidang_online_status/{{encrypt("Tidak Menjawab")}}"><i class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Sidang Tidak Menjawab</span></a>
                       </li>
                       <li class="slide">
                           <a class="side-menu__item" data-bs-toggle="slide" href="{{url('/')}}/administrator/sidang_online_all"><i class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Data Semua Kecurangan</span></a>
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
               <!--/APP-SIDEBAR-->