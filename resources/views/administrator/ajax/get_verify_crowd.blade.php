<?php
use App\Models\Config;
use App\Models\District;
use App\Models\RegenciesDomain;
use App\Models\Regency;
use App\Models\SaksiData;
use App\Models\Tps;
use App\Models\Village;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

$config = Config::all()->first();

use App\Models\Configs;

$configs = Config::all()->first();
$currentDomain = request()->getHttpHost();
if (isset(parse_url($currentDomain)['port'])) {
    $url = substr($currentDomain, 0, strpos($currentDomain, ':8000'));
} else {
    $url = $currentDomain;
}
$regency_id = RegenciesDomain::where('domain', $url)->first();

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
?>
<div class="container" id="container-koreksi">
    <div class="row">
        <div class="col-md-6 mt-3">
            <div class="card">
                <div class="card-header bg-dark text-light">
                    <h5 class="card-title">Admin</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">
                    </p>
                    <div class="media">
                        <img class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover; margin-right: 10px;" src="{{asset('')}}storage/profile-photos/{{Auth::user()->profile_photo_path}}">


                        <div class="media-body">
                            <h5 class="mt-0">{{Auth::user()->name}}</h5>
                            NIK : {{Auth::user()->nik}}
                        </div>
                    </div>
                    <p></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <div class="card">
                <div class="card-header bg-primary text-light">
                    <h5 class="card-title">Petugas Crowd C1 KPU</h5>
                </div>
                <div class="card-body  text-center">
                    <p class="card-text">
                    </p>
                    <div class="row fw-bolder">
                        <div class="col">{{$user->name}}</div>
                        <div class="col">TPS {{$tps->number}}</div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">NIK : {{$user->nik}}</div>
                        <div class="col">Kecamatan {{$district->name}}/Kelurahan {{$village->name}}</div>
                    </div>
                    <p></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md mb-3"><img src="{{asset('')}}storage/c1_plano/{{$crowd->crowd_c1}}">
        </div>
        <div class="col-md">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-info text-light">
                            <h5 class="card-title">Masukan Suara C1 Crowd</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{route('superadmin.simpan_suara_crowd')}}" method="post">
                                @csrf
                                
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="row">
                                            @foreach ($paslon as $j => $pas)
                                            <div class="col-md-12 mt-3">
                                                <?php $j++ ?>
                                                <label for="suara01">Suara 0{{$j}} - {{$pas->candidate}} - {{$pas->deputy_candidate}}</label>
                                                <input type="text" id="suara0{{$pas->id}}" class="form-control suara-input" name="suara[]" placeholder="masukan Suara {{$j}}">
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-md-6 text-center">
                                        <div class="card h-100">
                                            <div class="card-header py-1">
                                                Total :
                                            </div>
                                            <div class="card-body d-flex display-2 fw-bold">
                                                <div class="my-auto mx-auto" id="sumDisplay">
                                                    {{-- {{$total_suara }} --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group mt-3">
                                        <select class="form-control select2-show-search form-select" name="kecamatan" id="kecamatan">
                                            <?php
                                            $district = App\Models\District::where('regency_id', $config->regencies_id)->get();
                                            ?>
                                            <option disabled selected>Pilih Kecamatan</option>
                                            @foreach ($district as $kc)
                                            <option value="{{ $kc->id }}">{{ $kc->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control select2-show-search form-select" name="kelurahan" id="kelurahan">
                                            <option disabled selected>Pilih Kelurahan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control select2-show-search form-select" name="tps" id="tps">
                                            <option disabled selected>Pilih TPS</option>
                                        </select>
                                    </div>
                                    <input type="hidden"name="crowd_id"value="{{$crowd->id}}">
                                    <input type="submit"value="Simpan" class="btn btn-dark mt-3">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
   
  
    $('#kecamatan').on('change', function() {
        let idKec = $(this).val();
        $.ajax({
            url: `{{url('')}}/api/public/get-village`,
            method: 'get',
            data: {
                id: idKec
            },
            dataType: "json",
            success: function(response) {
                $('#kelurahan').html("")
                console.log(response)
                response.forEach((item, id) => {
                    var option = $(`<option value="${item.id}">${item.name}</option>`); // Membuat elemen baru
                    $('#kelurahan').append(option)
                })
                // console.log(response)
            }
        });
    })
    $('#kelurahan').on('change', function() {
        let idKel = $(this).val();
        $.ajax({
            url: `{{url('')}}/api/public/get-tps-by-village-id2`,
            method: 'get',
            data: {
                village_id: idKel
            },
            dataType: "json",
            success: function(response) {
                $('#tps').html("")
                if (response.messages != null) {
                    var option = $(`<option disabled>Data Tps Kosong</option>`); // Membuat elemen baru
                    $('#tps').append(option)
                }
                $('#tps').html("<option disabled selected> Pilih TPS </option>")
                response.forEach((item, id) => {
                    var option = $(`<option value="${item.id}">${item.number}</option>`); // Membuat elemen baru
                    $('#tps').append(option)
                })
                // console.log(response)
            }
        });
    })
</script>

<script>
    $(document).ready(function() {
            $('.suara-input').on('input', function() {
                // Get all input values with the class 'suara-input'
                let allValues = $('.suara-input').map(function() {
                    return parseFloat($(this).val()) || 0;
                }).get();
    
                console.log(allValues);
                // Calculate the sum of all input values
                let sum = allValues.reduce(function(a, b) {
                    return a + b;
                }, 0);
                // Display the sum in the HTML document
                $('#sumDisplay').html(sum);
            });
        });
</script>