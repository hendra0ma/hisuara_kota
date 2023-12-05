<?php
use App\Models\District;
use App\Models\Village;
use App\Models\Tps;
use App\Models\Regency;
use App\Models\Config;

$data['config'] = Config::first();
$config = Config::first();
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

$reg = App\Models\Regency::where('id', $regency_id->regency_id)->first();

$config = new Configs;
$config->regencies_id =  (string) $regency_id->regency_id;
$config->regencies_logo =  (string) $reg->logo_kota;
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

$kota = Regency::where('id', $config->regencies_id)->first();
?>

@include('layouts.partials.head')
@include('layouts.partials.sidebar')
@include('layouts.partials.header')

<div class="row mt-3">
    <div class="col-lg">
        <h1 class="page-title fs-1 mt-2">Bukti Kecurangan
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            {{-- <li class="breadcrumb-item"><a href="#">Bukti Kecurangan</a></li> --}}
            <li class="breadcrumb-item active" aria-current="page">
                {{$kota->name}}
                <!-- Kota -->
            </li>
        </ol>
    </div>
    <div class="col-lg-4">
        <div class="row mt-2">

            {{-- <div class="col parent-link">
                <a href="{{url('')}}/administrator/verifikasi_saksi" class="btn text-white w-100 py-3">Verifikasi
                    Saksi</a>
            </div>
            <div class="col parent-link">
                <a href="{{url('')}}/administrator/absensi" class="btn text-white w-100 py-3">Saksi Teregristrasi</a>
            </div>
            <div class="col parent-link">
                <a href="{{url('')}}/administrator/absensi/hadir" class="btn text-white w-100 py-3">Saksi Hadir</a>
            </div>
            <div class="col parent-link">
                <a href="{{url('')}}/administrator/absensi/tidak_hadir" class="btn text-white w-100 py-3">Saksi Tidak
                    Hadir</a>
            </div> --}}
            <div class="col parent-link">
                <a href="{{url('')}}/administrator/fraud-data-print"
                    class="btn btn-fdp text-white w-100 py-3 {{ (url()->current() == url('').'/administrator/fraud-data-print')?'active' : '' }}">Data
                    Kecurangan Masuk</a>
            </div>
            <div class="col parent-link">
                <a href="{{url('')}}/administrator/fraud-data-print-tercetak"
                    class="btn btn-fdp text-white w-100 py-3 {{ (url()->current() == url('').'/administrator/fraud-data-print-tercetak')?'active' : '' }}">Data
                    Tercetak</a>
            </div>

            {{-- <div class="col-lg-12 mt-2">
                <div class="row">

                    <div class="col-lg-4">

                    </div>
                    <div class="col-lg-4 justify-content-end">
                        <div class="card">
                            <div class="card-header bg-secondary">
                                <div class="card-title text-white">Total Kecurangan Masuk : {{count($list_suara)}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header bg-success">
                                <div class="card-title text-white">Total Data Tercetak : {{count($print)}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>

<h4 class="fw-bold fs-4 mt-5 mb-0">
    {{-- Jumlah Admin Terverifikasi : --}} {{$title}}
</h4>
<hr style="border: 1px solid">

<livewire:panrb-tercetak>


<div id="fotoKecuranganterverifikasi" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bukti</h5>
                <button aria-label="Close" class="btn-close bg-danger text-white rounded-0" data-bs-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <div id="container-hukum-verifikasi"></div>
            </div>
        </div>
    </div>
</div>


<script>
    $('a.fotoKecuranganterverifikasi').on('click', function () {
        let id = $(this).data('id');
        $.ajax({
            url: `{{route('superadmin.ajaxKecuranganTerverifikasi')}}`,
            type: "GET",
            data: {
                id
            },
            success: function (response) {
                if (response) {
                    $('#container-hukum-verifikasi').html(response);
                }
            }
        });
    });
</script>
</div>
@include('layouts.partials.footer')
@include('layouts.partials.scripts-bapilu')
@include('layouts.templateCommander.script-command')