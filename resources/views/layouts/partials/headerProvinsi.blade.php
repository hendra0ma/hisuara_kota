<?php

use App\Models\Config;
use App\Models\District;
use App\Models\Regency;
use App\Models\SaksiData;
use App\Models\Tps;
use App\Models\Village;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Saksi;
use App\Models\Province;
use App\Models\ProvinceDomain;

$config = Config::all()->first();
use App\Models\Configs;
use App\Models\RegenciesDomain;
$configs = Config::all()->first();
$currentDomain = request()->getHttpHost();
if (isset(parse_url($currentDomain)['port'])) {
    $url = substr($currentDomain, 0, strpos($currentDomain, ':8000'));
}else{
    $url = $currentDomain;
}
$regency_id = RegenciesDomain::where('domain',"LIKE","%".$url."%")->first();

$config = new Configs;
$config->regencies_id =  (string) $regency_id->regency_id;
$config->provinces_id =  $configs->provinces_id;
$config->setup =  $configs->setup;
$config->darkmode =  $configs->darkmode;
$config->updated_at =  $configs->updated_at;
$config->created_at =  $configs->created_at;
$config->partai_logo =  $configs->partai_logo;
$config->date_overlimit =  $configs->date_overlimit;
$config->show_public =  $configs->show_public;
$config->darkmode =  $configs->darkmode;

$config->show_terverifikasi =  $configs->show_terverifikasi;
$config->lockdown =  $configs->lockdown;
$config->multi_admin =  $configs->multi_admin;
$config->otonom =  $configs->otonom;
$config->dark_mode =  $configs->dark_mode;
$config->jumlah_multi_admin =  $configs->jumlah_multi_admin;
$config->jenis_pemilu =  $configs->jenis_pemilu;
$config->tahun =  $configs->tahun;
$config->quick_count =  $configs->quick_count;
$config->default =  $configs->default;

$regency = District::where('regency_id', $config->regencies_id)->get();
$kota = Regency::where('id', $config->regencies_id)->first();
$dpt = District::where('regency_id', $config->regencies_id)->sum('dpt');
$tps = Tps::count();
$marquee = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->get();
$total_tps = Tps::where('setup', 'belum terisi')->count();;
$tps_masuk = Tps::where('setup', 'terisi')->count();
$tps_kosong = $total_tps - $tps_masuk;
$suara_masuk = SaksiData::count('voice');
$verification = Saksi::where('verification', 1)->with('saksi_data')->get();
$total_verification_voice = 0;
foreach ($verification as $key) {
    foreach ($key->saksi_data as $verif) {
        $total_verification_voice += $verif->voice;
    }
}
$paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id,SUM(voice) as total FROM saksi_data GROUP by paslon_id ORDER by total DESC'));
$urutan = $paslon_tertinggi;
$props = Province::where('id', $kota['province_id'])->first();
$cityProp = Regency::where('province_id', $kota['province_id'])->get();
?>


<style>
    .header .btn {
        margin-left: 0px !important;
        position: relative;
    }

    .for-kolapse-kurangin>.side-app>.row:first-child {
        margin-top: 90px !important;
        transition: all 0.5s ease-in-out;
    }

    .for-kolapse-kurangin>.side-app>.row.kurangin {
        margin-top: 0px !important;
        transition: all 0.5s ease-in-out;
    }

    .sidenav-toggled .header-baru {
        padding-left: 80px !important
    }

    .tooltip-inner {
        background-color: #f82649 !important;
    }

    .bs-tooltip-bottom .tooltip-arrow::before {
        border-bottom-color: #f82649 !important;
    }

    .active-button {
        background-color: #e1af0a !important;
    }

    .custom-urutan:nth-child(1) {
        border-radius: 25px 0px 0px 25px
    }

    .custom-urutan:nth-child(2) {
        border-radius: 0px
    }

    .custom-urutan:nth-child(3) {
        border-radius: 0px 25px 25px 0px
    }

    /* custom scrollbar */
    .row.items::-webkit-scrollbar {
        display: none
    }

    .kecurangan.active-button {
        background-color: #f82649 !important;
    }

    .featured.active-button {
        background-color: #f82649 !important;
    }

    /* ::-webkit-scrollbar-track {
      background-color: transparent;
    }
    
    ::-webkit-scrollbar-thumb {
      background-color: #d6dee1;
      border-radius: 20px;
      background-clip: content-box;
    }
    
    ::-webkit-scrollbar-thumb:hover {
      background-color: #a8bbbf;
    }

    ::-webkit-scrollbar-corner {
        background: transparent;
    } */
</style>

<div class="app-header header header-baru py-0 pe-0" style="padding-left: 0px !important">
    <div class="container-fluid px-0">

        <div class="d-flex" style="position: relative">

            <div class="col-12 px-0">
                <div class="card mb-0 border-0">
                    <div class="card-body for-kolapse py-1 pl-5" style="background: #000; padding-right: 2.5rem">
                        <div class="row py-2 justify-content-between" style="gap: 15px">

                            <div class="col-auto col-hisuara" style="display:none;width:238px;height:54px">
                                <div class="row my-auto mx-auto">

                                    <div class="col-md ps-3 mb-0 text-light headerAnimate">
                                        <h2 class="text-white mb-0 text-center headerPojokan"></h2>
                                        <h2 class="text-white mb-0 text-center headerPojokanText1" style="display:none;font-size:medium"></h2>
                                        <h2 class="text-white mb-0 text-center headerPojokanText2" style="display:none;"> </h2>
                                    </div>
                                </div>
                            </div>

                            <div class="col-auto col-pilpres">
                                <div class="row">

                                    <div class="col-md-auto pe-0 my-auto">
                                       
                                    </div>
                                    <div class="col-lg-auto ps-3 mb-0">
                                        <h3 class="text-white mb-0">PILPRES 2024
                                            <!-- Kota -->
                                        </h3>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active text-white" aria-current="page">
                                               <h4> Indonesia</h4>
                                           
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>


                            <script>
                                function animateHeaderPojokan() {
                                    $container = $(".headerPojokan");
                                    const text = "HISUARA"
                                    const $elements = text.split("").map((s) => $(
                                        `<span style="margin-left:5px;text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #e60073, 0 0 40px #e60073, 0 0 50px #e60073, 0 0 60px #e60073, 0 0 70px #e60073;">${s}</span>`
                                    ));

                                    $container.html($elements);
                                    $container.show();
                                    // $("#gantiBackground").css({
                                    //     "background-color": "#007bff"
                                    // }, 1000);
                                    $elements.forEach(function($el, i) {
                                        $el
                                            .css({
                                                top: -60,
                                                opacity: 0
                                            })
                                            .delay(100 * i)
                                            .animate({
                                                top: 0,
                                                opacity: 1
                                            }, 200);
                                    });
                                    setTimeout(() => {
                                        $($(".headerPojokan").find('span')).remove();
                                        animateHeaderPojokanText1()
                                    }, 2000);

                                }

                                function animateHeaderPojokanText1() {
                                    $container = $(".headerPojokanText1");
                                    const text = "Vox Populi, Vox Dei"
                                    const $elements = text.split("").map((s) => $(
                                        `<span style="margin-left:5px;text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #e60073, 0 0 40px #e60073, 0 0 50px #e60073, 0 0 60px #e60073, 0 0 70px #e60073;">${s}${(s == ",")?'<br>':""}</span>`
                                    ));

                                    $container.html($elements);
                                    $container.show();
                                    // $("#gantiBackground").css({
                                    //     "background-color": "#007bff"
                                    // }, 1000);
                                    $elements.forEach(function($el, i) {
                                        $el
                                            .css({
                                                top: -60,
                                                opacity: 0
                                            })
                                            .delay(100 * i)
                                            .animate({
                                                top: 0,
                                                opacity: 1
                                            }, 200);
                                    });
                                    setTimeout(() => {
                                        $($(".headerPojokanText1").find('span')).remove();
                                        $('.col-hisuara').hide()
                                        $('.col-pilpres').show()
                                        setTimeout(() => {
                                            $('.col-hisuara').css('display') = 'flex'
                                            $('.col-pilpres').hide()

                                            animateHeaderPojokan()
                                        }, 1000 * 60);

                                    }, 4000);
                                }
                            </script>


                          
                            <div class="col-md my-auto">
                                <div class="row">
                                    <style>
                                        .items.active {
                                            cursor: grabbing;
                                            cursor: -webkit-grabbing;
                                        }
                                    </style>

                                    <div class="col-md text-white kota tugel-content" style="display: none">
                                        <div class="row">
                                            <div class="col-4 my-auto">
                                                <input type="text" class="w-100 form-control py-0 searchbar" style="border-radius: 25px; height: 30px" name="" id="" placeholder="Cari Provinsi...">
                                            </div>
                                            <div class="col-6">
                                                <?php $domainProvinsi = ProvinceDomain::join("provinces", 'province_domains.province_id', '=', 'provinces.id')->get(); ?>
                                                <div class="row items" style="width: 700px; overflow: scroll; flex-wrap: nowrap">
                                                    <div class="col-auto">
                                                        <a class="text-white btn rounded-0 item bg-danger" href="http://hisuara.id">DASHBOARD PUSAT</a>
                                                    </div>
                                                    @foreach($domainProvinsi as $dokota)
                                                    <div class="col-auto">
                                                        <a class="text-white btn rounded-0 item" style="background: #528bff" href="https://{{$dokota->domain}}">{{$dokota->name}}</a>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        $(document).ready(function() {
                                            $('.searchbar').on('input', function() {
                                                const searchText = $(this).val().toLowerCase().trim();
                                                $('.item').each(function() {
                                                    const itemText = $(this).text().toLowerCase();

                                                    if (itemText.includes(searchText)) {
                                                        $(this).parent('.col-auto').show(); // Show the parent column if the item matches the search text
                                                    } else {
                                                        $(this).parent('.col-auto').hide(); // Hide the parent column if the item doesn't match
                                                    }
                                                });
                                            });
                                        });

                                        const slider = document.querySelector('.items');
                                        let isDown = false;
                                        let startX;
                                        let scrollLeft;

                                        slider.addEventListener('mousedown', (e) => {
                                            isDown = true;
                                            slider.classList.add('active');
                                            startX = e.pageX - slider.offsetLeft;
                                            scrollLeft = slider.scrollLeft;
                                        });
                                        slider.addEventListener('mouseleave', () => {
                                            isDown = false;
                                            slider.classList.remove('active');
                                        });
                                        slider.addEventListener('mouseup', () => {
                                            isDown = false;
                                            slider.classList.remove('active');
                                        });
                                        slider.addEventListener('mousemove', (e) => {
                                            if (!isDown) return;
                                            e.preventDefault();
                                            const x = e.pageX - slider.offsetLeft;
                                            const walk = (x - startX) * 1; //scroll-fast
                                            slider.scrollLeft = scrollLeft - walk;
                                            console.log(walk);
                                        });
                                    </script>

                             
                                    
                                    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

                                    <script>
                                        function animate() {
                                            $('.judul-pertama').css("z-index", "900");
                                            $container = $("#text-effect");
                                            $('.tugel-content').hide(500);

                                            const text = "HISUARA"
                                            const $elements = text.split("").map((s) => $(
                                                `<span style="margin-left:20px" class="my-auto fw-normal">${s}</span>`
                                            ));

                                            $container.html($elements);
                                            $container.show();
                                            // $("#gantiBackground").css({
                                            //     "background-color": "#007bff"
                                            // }, 1000);
                                            $elements.forEach(function($el, i) {
                                                $el
                                                    .css({
                                                        top: -60,
                                                        opacity: 0
                                                    })
                                                    .delay(100 * i)
                                                    .animate({
                                                        top: 0,
                                                        opacity: 1
                                                    }, 200);
                                            });

                                            setTimeout(() => {
                                                $("#text-effect").hide();
                                                $("#text-effect").html("");
                                                animate2()
                                            }, 3000)

                                        }

                                        function animate2() {

                                            $container = $("#text-effect2");
                                            const text = "VOX POPULI,VOX DEI"
                                            const $elements = text.split("").map((s) => $(
                                                `<span style="margin-left:15px" class="my-auto">${s}</span>`));

                                            $container.html($elements);
                                            $container.show();
                                            // $("#gantiBackground").css({
                                            //     "background-color": "#007bff"
                                            // }, 1000);
                                            $elements.forEach(function($el, i) {
                                                $el
                                                    .css({
                                                        top: -60,
                                                        opacity: 0
                                                    })
                                                    .delay(100 * i)
                                                    .animate({
                                                        top: 0,
                                                        opacity: 1
                                                    }, 200);
                                            });
                                            setTimeout(() => {
                                                $("#text-effect2").html("")
                                                $("#text-effect2").hide()
                                                const dataTarget = getCookie('dataTarget');
                                                if (dataTarget != "") {
                                                    $(`[data-target='${dataTarget}']`).click();
                                                } else {
                                                    $('.active-button').click()
                                                }
                                                $('.col-hisuara').css('display', 'flex')
                                                $('.col-pilpres').hide()
                                                animateHeaderPojokan();

                                            }, 5000);
                                        }


                                        $(function() {


                                            <?php
                                            if (request()->segment(2) != "index") {  ?>
                                                const dataTarget = getCookie('dataTarget');
                                                if (dataTarget != "") {
                                                    $(`[data-target='${dataTarget}']`).click();
                                                } else {
                                                    $('.active-button').click()
                                                }

                                                setTimeout(() => {
                                                    $('.col-hisuara').css('display') = 'flex'
                                                    $('.col-pilpres').hide()
                                                    animateHeaderPojokan();
                                                }, 6000);



                                            <?php } else { ?>
                                                animate();
                                            <?php  } ?>

                                        });
                                    </script>

                                </div>
                            </div>

                            <div class="col-md-auto my-auto">
                                <div class="row h-100 justify-content-end" style="gap: 10px;">
                                 

                                    <div class="col-md-auto px-0">
                                        <button class="w-100 mx-auto btn tugel-kolaps text-white" style="background-color: #656064; width: 40px; height: 36px;" data-target="kota">
                                            <span class="dark-layout" data-bs-placement="bottom" data-bs-toggle="tooltip" title="">
                                                <i class="fa-solid fa-city"></i>
                                            </span>
                                        </button>
                                    </div>
                                    {{-- <div class="dropdown d-none d-md-flex">
                                        <a class="nav-link icon theme-layout nav-link-bg layout-setting" onclick="darktheme()">
                                            
                                        </a>
                                    </div><!-- Theme-Layout --> --}}
                                    <script>
                                        let darktheme = function() {
                                            setTimeout(function() {
                                                let body = document.body;
                                                let themes = body.className.split(" ");
                                                let theme = (themes.length == 3) ? "yes" : "no";
                                                $.ajax({
                                                    url: `{{ route('superadmin.theme') }}`,
                                                    data: {
                                                        theme,
                                                        "_token": "{{ csrf_token() }}"
                                                    },
                                                    type: "post",
                                                    success: function(res) {

                                                    }
                                                });
                                            }, 300);
                                        }
                                    </script>
                                    <!-- <div class="col-md-auto px-0" style="color: #212529 !important">
                                        <a class="w-100 mx-auto btn nav-link theme-layout nav-link-bg layout-setting px-3 text-white" onclick="darktheme()" style="background-color: #656064; width: 40px; height: 36px; margin: 0px; font-size: 16px" data-target="">
                                            <span class="dark-layout" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Dark Theme"><i class="fe fe-moon"></i></span>
                                            <span class="light-layout" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Light Theme"><i class="fe fe-sun"></i></span>
                                        </a>
                                    </div> -->
                                    <div class="col-md-auto px-0">
                                        <div class="dropdown d-none d-md-flex profile-1">
                                            <a href="#" data-bs-toggle="dropdown" class="nav-link pt-0 leading-none d-flex">
                                                <span>
                                                    @if (Auth::user()->profile_photo_path == NULL)
                                                    <img class="avatar profile-user brround" style="object-fit: cover; width: 33px; height: 33px" src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&color=7F9CF5&background=EBF4FF" alt="profile-user">
                                                    @else
                                                    <img class="avatar profile-user brround" style="object-fit: cover; width: 33px; height: 33px" src="{{url("/storage/profile-photos/".Auth::user()->profile_photo_path) }}" alt="profile-user" s>
                                                    @endif
                                                </span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                <div class="drop-heading">
                                                    <div class="text-center">
                                                        <h5 class="text-dark mb-0">{{ Auth::user()->name }}</h5>
                                                        <small class="text-muted">{{ Auth::user()->role_id == 1 ? 'Administrator' : 'uwon luyi' }}</small>
                                                    </div>
                                                </div>
                                                <div class="dropdown-divider m-0"></div>

                                                <form action="{{ route('logout') }}" method="post">
                                                    @csrf
                                                    <button class="dropdown-item" type="submit">
                                                        <i class="dropdown-icon fe fe-alert-circle"></i> Sign out
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="card-footer p-0 border-0" id="marquee1" style="position: relative; background-color: #343a40">
                    {{-- <button class="btn-dark btn-kolapse-sidebar text-white" style="background-color: #30304d; position: absolute; left: 0; z-index: 20; border-0"><i class="fa-solid fa-align-left"></i></button> --}}
                    <button class="btn-dark btn-kolapse text-white h-100" style="background-color: #30304d; position: absolute; left: 0; z-index: 20; border-0"><i class="fa-solid fa-bars"></i></button>
                    <button class="btn-danger text-white h-100 rounded-0" style="position: absolute; left: 28px; z-index: 20">Suara Masuk</button>
                    <a href="https://time.is/Jakarta" id="time_is_link" rel="nofollow"></a>
                    <button class="btn-dark text-white h-100 rounded-0" style="position: absolute; left: 123px; z-index: 20;"><span id="Jakarta_z41c" style="font-size:20px; color: #f7f700"></span> <span style="font-size: 20px; color: #f7f700">WIB</span></button>
                    <script src="//widget.time.is/t.js"></script>
                    <script>
                        time_is_widget.init({
                            Jakarta_z41c: {}
                        });
                    </script>



                    <span class="text-success"> .</span><span class="text-white" style="font-size: 20px;">

                    </span>


                </div>
            </div>

            <script>
                $('.btn-kolapse').on('click', function() {
                    $('.for-kolapse').toggle(500);
                    $('.for-kolapse-kurangin > .side-app > .row:first').toggleClass('kurangin')
                })

                // $('.btn-kolapse-sidebar').on('click', function() {
                //     $('body.app.sidebar-mini').toggleClass('sidenav-toggled')
                // })

                $('.tugel-kolaps').on('click', function() {

                    let target = $(this).data('target')

                    // $.cookie('dataTarget', `${target}`, { expires: 7, path: '/' });

                    setCookie("dataTarget", target, 30);

                    // console.log(target)
                    $('.tugel-content').hide()
                    $(`.${target}`).show(200)
                })

                $('.tugel-kolaps-menu').on('click', function() {

                    let target = $(this).data('target')
                    // console.log(target)
                    const cek = $(`.${target}`).css('display') == 'block';

                    $('.tugel-content-menu').hide(500)

                    if (cek) {
                        $('.tugel-content-menu').hide(500)
                    } else {
                        $(`.${target}`).show(500)
                    }
                })

                $('.tugel-kolaps').on('click', function() {
                    const btnIni = $(this);
                    $('.judul-pertama').css("z-index", "-900");
                    $('.tugel-kolaps').removeClass('active-button');
                    btnIni.addClass('active-button');
                });



                // $('.tugel-kolaps-menu.content-toggled').on('click', function() {

                // let target = $(this).data('target')
                // console.log(target)
                // $('.tugel-content-menu').removeClass('content-toggled')
                // $(`.${target}`).toggleClass('content-toggled')
                // })
            </script>

        </div>
    </div>
</div>
<div class="mb-1 navbar navbar-expand-lg  responsive-navbar navbar-dark d-md-none bg-white">
    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
        <div class="d-flex order-lg-2 ms-auto">


            <div class="dropdown d-md-flex message">
                <a class="nav-link icon text-center" data-bs-toggle="dropdown">
                    <i class="fe fe-message-square"></i><span class=" pulse-danger"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">

                    <div class="message-menu">
                        <?php
                        $allUser = App\Models\User::where('id', '!=', Auth::user()->id)
                            ->where('role_id', '!=', 8)
                            ->where('role_id', '!=', 0)
                            ->where('role_id', '!=', 14)
                            ->get(); ?>
                        @foreach ($allUser as $usr)
                        <a class="dropdown-item d-flex" href="#" onclick="openForm(`<?= $usr->id ?>`)">
                            <span class="avatar avatar-md brround me-3 align-self-center cover-image" data-bs-image-src="{{ url('/') }}/assets/images/users/1.jpg"></span>
                            <div class="wd-90p">
                                <div class="d-flex">
                                    <h5 class="mb-1">{{ $usr->name }}</h5>
                                    <small class="text-muted ms-auto text-end">

                                    </small>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    <div class="dropdown-divider m-0"></div>

                </div>
            </div><!-- MESSAGE-BOX -->
            <div class="dropdown d-md-flex profile-1">
                <a href="#" data-bs-toggle="dropdown" class="nav-link pe-2 leading-none d-flex pt-0">
                    <span>
                        @if (Auth::user()->profile_photo_path == NULL)
                        <img class="avatar profile-user brround" style="object-fit: cover" src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&color=7F9CF5&background=EBF4FF" alt="profile-user">
                        @else
                        <img class="avatar profile-user brround" style="object-fit: cover" src="{{url("/storage/profile-photos/".Auth::user()->profile_photo_path) }}" alt="profile-user" s>
                        @endif
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <div class="drop-heading">
                        <div class="text-center">
                            <h5 class="text-dark mb-0">{{ Auth::user()->name }}</h5>
                            <small class="text-muted">{{ Auth::user()->role_id == 1 ? 'Administrator' : 'uwon luyi' }}</small>
                        </div>
                    </div>
                    <div class="dropdown-divider m-0"></div>
                    <a class="dropdown-item" href="/user/profile">
                        <i class="dropdown-icon fe fe-user"></i> Profile
                    </a>

                    <form action="{{ route('logout') }}" method="post">
                        @csrf


                        <button class="dropdown-item" type="submit">
                            <i class="dropdown-icon fe fe-alert-circle"></i> Sign out
                        </button>
                    </form>
                </div>
            </div>
            <div class="dropdown d-md-flex header-settings">
                <a href="#" class="nav-link icon " data-bs-toggle="sidebar-right" data-target=".sidebar-right">
                    <i class="fe fe-menu"></i>
                </a>
            </div><!-- SIDE-MENU -->
        </div>
    </div>
</div>
<!-- /Mobile Header -->

<!--app-content open-->
<div class="app-content for-kolapse-kurangin" style="margin-top: 40px; margin-left: 0px !important">
    <div class="side-app">