<?php

use App\Models\Config;
use App\Models\Configs;
use App\Models\RegenciesDomain;

$currentDomain = request()->getHttpHost();

if (isset(parse_url($currentDomain)['port'])) {
    $url = substr($currentDomain, 0, strpos($currentDomain, ':8000'));
} else {
    $url = $currentDomain;
}
$regency_id = RegenciesDomain::where('domain', "LIKE", "%" . $url . "%")->first();

$configs = Config::first();
$config = new Configs;
$config->regencies_id =  (string) $regency_id->regency_id;
$config->provinces_id =  $configs->provinces_id;
$config->regencies_logo =  $configs->regencies_logo;

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
?>


    <div class="col-lg-12">
        <div class="card">



            <div class="card-body pt-3">
                <div class="row justify-content-center mb-3">
                    <div class="col-2">
    
                        <img src="{{asset('')}}storage/{{$config->regencies_logo}}" style="width: 100px" class="float-end">
                    </div>
                    <div class="col-4 d-flex">
                        <h3 class="mx-auto text-center text-uppercase fw-bold my-auto">
                            {!!$judul!!}
                        </h3>
                    </div>
                    <div class="col-2">
                        <img src="{{asset('')}}images/logo/kpu_logo.png" style="width: 100px;height:100px;object-fit:cover" class="float-start">
                    </div>
                </div>
                <div class="col-12 mb-3 px-0">
                    <input wire:model="search" type="search" class="form-control border-1 border-dark" placeholder="Cari nama dalam DPT 2024...">
                </div>

                <table class="table table-striped">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th class="text-white">
                                No
                            </th>
                            <td>
                                Nama Pemilih
                            </td>
                            <td>
                                Kecamatan
                            </td>
                            <td>
                                Kelurahan
                            </td>
                            <td>
                                TPS
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dpt_i as $i => $dpt)
                        <tr>
                            <th>
                                {{$i+1}}
                            </th>
                            <td>
                                {{$dpt->nama_pemilih}}
                            </td>
                            <td>
                                {{$dpt->district_name}}
                            </td>
                            <td>
                                {{$dpt->village_name}}
                            </td>
                            <td>
                                {{$dpt->tps}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="container">
                    {{$dpt_i->links()}}
                </div>
            </div>
        </div>
    </div>
