<?php

use App\Models\Config;
use App\Models\District;
use App\Models\Province;
use App\Models\RegenciesDomain;
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

<style>
    .side-menu__item {
        color: white
    }

    .page .page-main ul li h3 {
        color: white
    }
</style>

<!-- PAGE -->
<div class="page">
    <div class="page-main">
        