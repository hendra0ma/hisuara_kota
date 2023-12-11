@extends('layouts.main-verifikasi-akun')

@section('content')

<?php

use App\Models\District;
use App\Models\Village;
use App\Models\TPS;

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

<div class="row mt-5">
    <div class="col-lg-4">
        <h1 class="page-title fs-1 mt-2">Data C1
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">{{ $kota->name }}
                <!-- Kota -->
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col">
        <h4 class="fw-bold fs-4 mt-5 mb-0">
            Jumlah C1 Saksi : {{$jumlah_c1}}
        </h4>
        
    </div>
    <div class="col-auto mt-auto">
        <div class="btn btn-success">
            <i class="fa-solid fa-download"></i>
            Unduh
        </div>
    </div>
</div>

<hr style="border: 1px solid">

<livewire:all-c1-plano />

<!-- Modal -->
<div class="modal fade" style="background: rgba(0, 0, 0, 0.65)" id="modaCek1" tabindex="-1" aria-labelledby="modaCek1Label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background: transparent; border: 0px">
            <div class="modal-body p-0" id="modalContent">
                {{-- <ul class="breadcrumb">
                    <?php
                        $desa = Village::where('id', (string)$village->id)->first();
                        $regency = Regency::where('id',(string) $config->regencies_id)->first();
                        $kcamatan = District::where('id', (string)$desa->district_id)->first();
                        ?>
                    <li><a href="{{url('')}}/administrator/terverifikasi" class="text-white">{{$regency->name}}</a></li>
                    <li><a href="{{url('')}}/administrator/terverifikasi_kecamatan/{{Crypt::encrypt($district->id)}}"
                            class="text-white">{{$district->name}}</a></li>
                    <li><a href="{{url('')}}/administrator/terverifikasi_kelurahan/{{Crypt::encrypt($village->id)}}"
                            class="text-white">{{$desa->name}}</a></li>
                    <li><a href="{{url('')}}/administrator/terverifikasi_tps/{{Crypt::encrypt($data_tps->id)}}"
                            class="text-white">TPS
                            {{$data_tps->number}}</a></li>

                </ul>
                <div class="col-12">
                    <div class="card rounded-0 mb-0">
                        <div class="card-body">
                            <div class="row">
                                @if ($saksi[0]['kecurangan'] == "yes" && $qrcode != null)
                                <?php $scan_url = url('') . "/scanning-secure/" . (string)Crypt::encrypt($qrcode->nomor_berkas); ?>
                                <div class="col-auto my-auto">
                                    {!! QrCode::size(100)->generate( $scan_url); !!}
                                </div>
                                @else
                                @endif
                                <div class="col mt-2">
                                    <div class="media">
                                        <?php
                                                                                                            $user = User::where('tps_id')->first();  
                                                                                                        ?>
                                        @if ($user['profile_photo_path'] == NULL)
                                        <img class="rounded-circle"
                                            style="width: 100px; height: 100px; object-fit: cover; margin-right: 10px;"
                                            src="https://ui-avatars.com/api/?name={{ $user['name'] }}&color=7F9CF5&background=EBF4FF">
                                        @else
                                        <img class="rounded-circle"
                                            style="width: 100px; height: 100px; object-fit: cover; margin-right: 10px;"
                                            src="{{url("/storage/profile-photos/".$user['profile_photo_path']) }}">
                                        @endif

                                        <div class="media-body my-auto">
                                            <h5 class="mb-0">{{ $user['name'] }}</h5>
                                            NIK : {{ $user['nik'] }}
                                            <div>TPS {{$data_tps->number}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-auto pt-2 my-auto px-1">
                                    <a href="https://wa.me/{{$user->no_hp}}" class="btn btn-success text-white"><i
                                            class="fa-solid fa-phone"></i>
                                        Hubungi</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12" style="height: 100vh; overflow: scroll">
                    <center>
                        <img width="100%" src="{{asset('')}}storage/c1_plano/{{$saksi[0]->c1_images}}" data-magnify-speed="200"
                            alt="" data-magnify-magnifiedwidth="2500" data-magnify-magnifiedheight="2500"
                            class="img-fluid zoom" data-magnify-src="{{asset('')}}storage/c1_plano/{{$saksi[0]->c1_images}}">
                    </center>
                </div> --}}
            </div>
        </div>
    </div>
</div>

<script>
    // Function to load content dynamically using AJAX
    $('.moda-cek-1').on('click', function(event) {
        // Extract the ID from the clicked element or any other relevant source
        var id = $(this).data('id');
        
        // Call the function to load modal content
        loadModalContent(id);
    });
    
    function loadModalContent(id) {
        $.ajax({
            url: '{{url('')}}/administrator/get-moda-cek-1/', // Replace with the actual URL and include the id parameter
            type: 'GET',
            data:{
                id:id
            },
            success: function(data) {
                $('#modalContent').html(data);
            },
            error: function() {
                $('#modalContent').html('<p>Error loading content.</p>');
            }
        });
        console.log(id);
    };

</script>



@endsection