@extends('layouts.mainlayout')

@section('content')
<?php

use App\Models\Config;
use App\Models\Configs;
use App\Models\District;
use App\Models\RegenciesDomain;
use App\Models\Regency;
use App\Models\SaksiData;
use App\Models\Tps;
use App\Models\Village;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

$configs = Config::all()->first();
$currentDomain = request()->getHttpHost();
if (isset(parse_url($currentDomain)['port'])) {
    $url = substr($currentDomain, 0, strpos($currentDomain, ':8000'));
} else {
    $url = $currentDomain;
}
$regency_id = RegenciesDomain::where('domain', "LIKE", "%" . $url . "%")->first();

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
?>

<style>
    .open-desktop {
        display: block;
    }

    @media (max-width: 1680px) {

        .open-desktop {
            display: none;
        }

        .break-point-1 {
            flex: 0 0 50%;
            max-width: 50%;
        }

        .break-point-2 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }

    @media (max-width: 1024px) {

        .open-desktop {
            display: none;
        }

        .break-point-1 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .break-point-2 {
            flex: 0 0 100%;
            max-width: 100%;
        }

    }
</style>

<style>
    .col.judul {
        display: flex;
        padding-top: 10px;
        padding-bottom: 10px;
        position: relative;
    }

    .col.judul .text {
        margin: auto;
    }

    .arrow-nav {
        border: 0;
        background: transparent;
    }

    .custom-prev {
        position: absolute;
        top: 7.5px;
        left: 0px;
    }

    .custom-next {
        position: absolute;
        top: 7.5px;
        right: 0px;
    }

    .carousel-item {
        transition: -webkit-transform .6s ease;
        transition: transform .6s ease;
        transition: transform .6s ease, -webkit-transform .6s ease;
    }

    .urutan-suara {
        position: absolute;
    }

    .urutan-suara::after {
        border-top: 1px black solid;
    }

    .urutan-suara:nth-child(1) {
        left: 50%;
        transform: translateX(-50%);
    }

    .urutan-suara:nth-child(2) {
        left: 0;
        top: 30px;
    }

    .urutan-suara:nth-child(3) {
        right: 0;
        top: 60px;
    }
</style>

<div class="row" style="margin-top: 90px; transition: all 0.5s ease-in-out;">

    <div class="col-lg-12">
        <style>
            ul.breadcrumb {
                padding: 10px 16px;
                list-style: none;
                background-color: #0d6efd !important;
            }

            ul.breadcrumb li {
                display: inline;
                font-size: 18px;
            }

            ul.breadcrumb li+li:before {
                padding: 8px;
                color: white;
                content: "/\00a0";
            }

            ul.breadcrumb li a {

                text-decoration: none;
            }

            ul.breadcrumb li a:hover {
                color: #01447e;
                text-decoration: underline;
            }
        </style>

        <ul class="breadcrumb">
            <?php $regency =Regency::where('id',$config->regencies_id)->select('name')->first(); ?>
            <li><a href="" class="text-white">{{$regency->name}}</a></li>

        </ul>
    </div>

    <div class="{{($config->otonom == 'yes')?'col-lg-12 col-md-12':'col-lg-6 col-md-12'}}">
        <div class="card">
            <img src="{{asset('')}}assets/icons/hisuara_new.png"
                style="position: absolute; top: 25px; left: 25px; width: 100px" alt="">
            {{-- <div class="card-header bg-info">
                <h3 class="card-title text-white">Suara TPS Masuk</h3>
            </div> --}}
            <div class="card-body" style="position: relative;">
                <div id="container-realcount" class="kontainer"></div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md" style="display:{{($config->otonom == 'yes')?'none':'block'}}">
        <div class="card">
            {{-- <div class="card-header bg-info">
                <h3 class="card-title text-white">Suara TPS Masuk</h3>
            </div> --}}
            <div class="card-body" style="position: relative;">
                <img src="{{asset('')}}assets/icons/hisuara_new.png"
                    style="position: absolute; top: 25px; left: 25px; width: 100px" alt="">
                <div id="container-terverifikasi" class="kontainer"></div>
            </div>
        </div>
    </div>



    @if ($config->quick_count == 'yes')

    <div class="col-lg" style="{{($config->quick_count == 'yes')?'':'display:none'}}">
        <div class="card" style="margin-bottom: 1rem">
            <div class="card-header bg-info">
                <h3 class="card-title text-white mx-auto">
                    <a href="{{url('')}}/administrator/quick_count2" class="text-white">
                        QUICK COUNT
                    </a>
                </h3>
            </div>
            <div class="card-body" style="position: relative">
                <img src="{{asset('')}}assets/icons/hisuara_new.png"
                    style="position: absolute; top: 25px; left: 25px; width: 100px" alt="">
                <div id="container-quickcount" class="kontainer"></div>
            </div>
        </div>
    </div>

    <div class="col-lg">
        <div class="card">
            <div class="card-header bg-info">
                <h3 class="card-title text-white mx-auto">
                    <a href="{{url('')}}/administrator/rekapitulasi" class="text-white">
                        REKAPITULASI
                    </a>
                </h3>
            </div>
            <div class="card-body" style="position: relative;">
                <img src="{{asset('')}}assets/icons/hisuara_new.png"
                    style="position: absolute; top: 25px; left: 25px; width: 100px" alt="">
                <div id="container-rekapitulasi" class="kontainer"></div>

            </div>
        </div>
    </div>

    <div class="col-lg">
        <div class="card">
            <div class="card-header bg-info">
                <h3 class="card-title text-white mx-auto">
                    <a href="{{url('')}}/administrator/hitung_kpu" class="text-white">
                        HITUNG ULANG KPU
                    </a>
                </h3>
            </div>
            <div class="card-body" style="position: relative;">
                <img src="{{asset('')}}assets/icons/hisuara_new.png"
                    style="position: absolute; top: 25px; left: 25px; width: 100px" alt="">
                <div id="container-kpu" class="kontainer"></div>

            </div>
        </div>
    </div>
    @else
    <div class="col-lg" style="{{($config->quick_count == 'yes')?'':'display:none'}}">
        <div class="card" style="margin-bottom: 1rem">
            <div class="card-header bg-info">
                <h3 class="card-title text-white mx-auto">
                    <a href="{{url('')}}/administrator/quick_count2" class="text-white">
                        QUICK COUNT
                    </a>
                </h3>
            </div>
            <div class="card-body" style="position: relative">
                <img src="{{asset('')}}assets/icons/hisuara_new.png"
                    style="position: absolute; top: 25px; left: 25px; width: 100px" alt="">
                <div id="container-quickcount" class="kontainer"></div>
            </div>
        </div>
    </div>
    
    <div class="col-lg">
        <div class="card">
            <div class="card-header bg-info">
                <h3 class="card-title text-white mx-auto">
                    <a href="{{url('')}}/administrator/rekapitulasi" class="text-white">
                        REKAPITULASI
                    </a>
                </h3>
            </div>
            <div class="card-body" style="position: relative;">
                <img src="{{asset('')}}assets/icons/hisuara_new.png"
                    style="position: absolute; top: 25px; left: 25px; width: 100px" alt="">
                <div id="container-rekapitulasi" class="kontainer"></div>
    
            </div>
        </div>
    </div>
    
    <div class="col-lg">
        <div class="card">
            <div class="card-header bg-info">
                <h3 class="card-title text-white mx-auto">
                    <a href="{{url('')}}/administrator/hitung_kpu" class="text-white">
                        HITUNG ULANG KPU
                    </a>
                </h3>
            </div>
            <div class="card-body" style="position: relative;">
                <img src="{{asset('')}}assets/icons/hisuara_new.png"
                    style="position: absolute; top: 25px; left: 25px; width: 100px" alt="">
                <div id="container-kpu" class="kontainer"></div>
    
            </div>
        </div>
    </div>
    @endif


    <?php

$currentDomain = request()->getHttpHost();
if (isset(parse_url($currentDomain)['port'])) {
    $url = substr($currentDomain, 0, strpos($currentDomain, ':8000'));
} else {
    $url = $currentDomain;
}
$regency_id = RegenciesDomain::where('domain', "LIKE", "%" . $url . "%")->first();

if (request()->segment(1) == "administrator" && request()->segment(2) == "perhitungan_kecamatan") {
    $id_wilayah = Crypt::decrypt(request()->segment(3));
    $tipe_wilayah = "kecamatan";
} elseif (request()->segment(1) == "administrator" && request()->segment(2) == "index") {
    $id_wilayah = $regency_id->regency_id;
    $tipe_wilayah = "kota";
} else {
    $id_wilayah = Crypt::decrypt(request()->segment(3));
    $tipe_wilayah = "kelurahan";
}

?>
    <livewire:dpt-pemilih-component :id_wilayah="$id_wilayah" :tipe_wilayah="$tipe_wilayah" />





</div>


<!-- <div class="card mg-b-20"style="display:{{($config->otonom == 'yes')?' none':'block'}}">
    <div class="card-header">
        <div class="card-title">Admin Demography Tracking</div>

        <div class="ms-auto">
            <a class="nav-link icon full-screen-link nav-link-bg"id="ikon-map-full">
                <i class="fe fe-minimize"></i>
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="ht-300" id="map" style="height:600px; z-index: 2"></div>
    </div>
</div> -->

{{-- <div style="
                                height: 320px;
                                width: 260px;
                                background: transparent;
                                position: absolute;
                                z-index: 1;
                            "></div>
<div style="
                                height: 320px;
                                width: 260px;
                                background: transparent;
                                position: absolute;
                                right: 25px;
                                z-index: 1;
                            "></div> --}}
<script>
    $(document).ready(function() {
        const createChartContainer = (style) => {
            return `<div style="${style}"></div>`;
        };

        const chartStyle = `
            height: 320px;
            width: 260px;
            background: transparent;
            position: absolute;
            z-index: 1;
        `;

        const chartContainer1 = createChartContainer(chartStyle);
        const chartContainer2 = createChartContainer(`${chartStyle} right: 25px;`);

        $('.chartsh').prepend(chartContainer1, chartContainer2);

        $('.kontainer').html('<div class="spinner"></div>');

        var ajaxRequests = [
            { url: "{{url('')}}/administrator/get_realcount_ajax", container: "#container-realcount" },
            { url: "{{url('')}}/administrator/get_terverifikasi_ajax", container: "#container-terverifikasi" },
            { url: "{{url('')}}/administrator/get_quickcount_ajax", container: "#container-quickcount" },
            { url: "{{url('')}}/administrator/get_rekapitulasi_ajax", container: "#container-rekapitulasi" },
            { url: "{{url('')}}/administrator/get_kpu_ajax", container: "#container-kpu" },
            // Add more requests as needed
        ];

        // Function to show a loading spinner in the specified container
        // function showLoadingSpinner(container) {
            
        // }

        // Function to make a single Ajax request
        function makeAjaxRequest(request) {
            // Show the loading spinner for the current request
            // showLoadingSpinner(request.container);

            return $.ajax({
                url: request.url,
                method: "GET",
                data: {
                    url: location.pathname
                },
                success: function(data) {
                    // Update the content of the specified container with the response data using fadeIn effect
                    $(request.container).hide().html(data).show(700);
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error("Ajax request failed: " + status + ", " + error);
                }
            });
        }

        // Use jQuery's Deferred and Promise objects to handle requests sequentially
        var requestQueue = $.Deferred().resolve();

        // Iterate through each Ajax request
        $.each(ajaxRequests, function(index, request) {
            requestQueue = requestQueue.then(function() {
                // Make the Ajax request and return the Promise
                return makeAjaxRequest(request);
            });
        });
    });
</script>

@endsection