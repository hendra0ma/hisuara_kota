    <?php
    use App\Models\Config;
    use App\Models\District;
use App\Models\Tracking;

    $config = Config::all()->first();
    $regency = District::where('regency_id',$config['regencies_id'])->get();
    ?>
    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="<?= url('/') ?>/assets/images/loader.svg" class="loader-img" alt="Loader">
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
                <ul class="side-menu mt-5">
                <li class="mt-5">
                        <center>
                            <img src="{{asset('')}}assets/radar2.gif"class="img-fluid ms-3" style="width:100%;height:auto;border-radius:5px">
                        </center>
                    </li>
                    <div id="data-hekel"class="mt-4"style="height:500px;overflow:hidden">

                    </div>
                
                        </ul>
                        <?php
                            $tracking = Tracking::join('users','tracking.id_user','=','users.id')->select('tracking.*','users.*')->get();
                        ?>
                        <script>
                            const DATAIP = [<?php foreach ($tracking as $track):?>  `{{$track->ip_address}}`,`{{$track->email}}`,`{{$track->name}}`, `{{$track->longititude}},{{$track->latitude}}`, <?php endforeach ?>];
                               
                                let iaja = 0;
                                setInterval(()=>{
                                    $('#data-hekel').append(`
                                    <li style="margin-top:-10px;">
                                    <a class="side-menu__item" href="#">
                                        <i class="side-menu__icon mdi mdi-settings"></i><span class="side-menu__label">
                                        ${DATAIP[iaja]}
                                        </span></a>
                                    </li>
                                    `)
                                    $('#data-hekel').scrollTop($('#data-hekel')[0].scrollHeight)


                                    if(DATAIP.length == iaja){
                                        iaja=0;
                                    }
                                    iaja++
                                },150)
                           
                        </script>
    
            </aside>
            <!--/APP-SIDEBAR-->
