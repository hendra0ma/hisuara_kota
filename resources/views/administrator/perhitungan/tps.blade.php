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

@extends('layouts.main-perhitungan')
@section('content')
<!-- PAGE-HEADER -->
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
            <?php
            $desa = Village::where('id', (string)$village->id)->first();
            $regency = Regency::where('id',(string) $config->regencies_id)->first();
            $kcamatan = District::where('id', (string)$desa->district_id)->first();
            ?>
            <li><a href="{{url('')}}/administrator/index" class="text-white">{{$regency->name}}</a></li>
            <li><a href="{{url('')}}/administrator/perhitungan_kecamatan/{{Crypt::encrypt($district->id)}}" class="text-white">{{$district->name}}</a></li>
            <li><a href="{{url('')}}/administrator/perhitungan_kelurahan/{{Crypt::encrypt($village->id)}}" class="text-white">{{$desa->name}}</a></li>
            <li><a href="{{url('')}}/administrator/perhitungan_tps/{{Crypt::encrypt($data_tps->id)}}" class="text-white">TPS {{$data_tps->number}}</a></li>

        </ul>
    </div>

    <div class="col-lg-6" style="{{($config->quick_count == 'yes')?'':'display:none'}}">
        <div class="card" style="margin-bottom: 1rem">
            <div class="card-body" style="position: relative">
                <img src="{{asset('')}}assets/icons/hisuara_new.png" style="position: absolute; top: 25px; left: 25px; width: 100px" alt="">
                <div class="row">
                    <div class="col-12">
                        <div class="container">
                            <div class="text-center fs-3 mb-3 fw-bold">QUICK COUNT</div>
                            <div class="text-center">Progress {{substr($realcount,0,5)}}% dari 100%</div>
                            <div class="text-center mt-2 mb-2"><span class="badge bg-success">{{$total_incoming_vote}} /
                                    {{$dpt}}</span></div>
                            <div id="chart-pie2" style="height: 320px" class="chartsh h-100 w-100"></div>
                        </div>
                    </div>
                    <div class="col-xxl">
                        <div class="row mt-2">
                            <?php $i = 1; ?>
                            @foreach ($paslon as $pas)
                            <div class="col-lg col-md col-sm col-xl mb-3">
                                <div class="card" style="margin-bottom: 0px;">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mx-auto counter-icon box-shadow-secondary brround candidate-name text-white " style="margin-bottom: 0; background-color: {{$pas->color}};">
                                                    {{$i++}}
                                                </div>
                                            </div>
                                            <div class="col text-center">
                                                <h6 class="mt-4">{{$pas->candidate}} </h6>
                                                <h6 class="">{{$pas->deputy_candidate}} </h6>
                                                <?php
                                                $voice = 0;
                                                ?>
                                                @foreach ($pas->quicksaksidata as $dataTps)
                                                <?php
                                                $voice += $dataTps->voice;
                                                ?>
                                                @endforeach
                                                <h3 class="mb-2 number-font">{{ $voice }} suara</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8 mt-4">
        <div class="card">
            <div class="card-header bg-dark">
                <h3 class="card-title text-white">Hasil Perhitungan Suara</h3>
            </div>
            <div class="card-body" style="position: relative;">
                <img src="{{asset('')}}assets/icons/hisuara_new.png" style="position: absolute; top: 25px; left: 25px; width: 100px" alt="">
                <div class="row">
                    <div class="col-8">
                        <div class="container">
                            <div class="text-center fs-3 mb-3 fw-bold">REAL COUNT</div>
                            <div class="text-center">Progress {{substr($realcount,0,5)}}% dari 100%</div>
                            <div class="text-center mt-2 mb-2"><span class="badge bg-success">{{$total_incoming_vote}} /
                                    {{$dpt}}</span></div>
                            <div id="chart-pie" style="height: 450px" class="chartsh h-100 w-100"></div>
                        </div>
                    </div>
                    <div class="col my-auto">
                        <div class="row mt-2">
                            <?php $i = 1; ?>
                            @foreach ($paslon as $pas)
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12 mb-3">
                                <div class="card" style="margin-bottom: 0px;">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-12 my-auto">
                                                <div class="mx-auto mb-3 counter-icon box-shadow-secondary brround candidate-name text-white " style="margin-bottom: 0; background-color: {{$pas->color}};">
                                                    {{$i++}}
                                                </div>
                                            </div>
                                            <div class="col text-center">
                                                <h6>{{$pas->candidate}} </h6>
                                                <h6>{{$pas->deputy_candidate}} </h6>
                                                <?php
                                                $voice = 0;
                                                ?>
                                                @foreach ($pas->saksi_data as $dataTps)
                                                <?php
                                                $voice += $dataTps->voice;
                                                ?>
                                                @endforeach
                                                <h3 class="mb-2 number-font">{{ $voice }} suara</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
    <!-- Popper.js, required for Bootstrap 4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
    <div class="col-md mt-4">
        <div class="card">
            <div class="card-header bg-dark">
                <h3 class="card-title text-white">Salinan C1</h3>
            </div>
            <div class="card-body text-center">
                <a href="#" data-toggle="modal" data-target="#imgBig">
                    <img style="height: 594.92px" src="{{asset('')}}storage/{{$saksi[0]->c1_images}}" alt="">
                </a>
            </div>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" style="background: rgba(0, 0, 0, 0.65)" id="imgBig" tabindex="-1" aria-labelledby="imgBigLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="col-lg-12" style="height: 100vh; overflow: scroll">
                        <center>
                            <img width="100%" src="{{asset('')}}storage/{{$saksi[0]->c1_images}}" data-magnify-speed="200"
                                alt="" data-magnify-magnifiedwidth="2500" data-magnify-magnifiedheight="2500"
                                class="img-fluid zoom"
                                data-magnify-src="{{asset('')}}storage/{{$saksi[0]->c1_images}}">
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function () {
            $('#imgBig').modal();
        });
    </script>
    <?php $i = 1;?>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Urutan Pemenang</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="bg-dark">
                            <tr>
                                <th scope="col" class="text-white">NO</th>
                                <th scope="col" class="text-white">URAIAN</th>
                                <th scope="col" class="text-white">JUMLAH SUARA</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($urutan as $urutPaslon)
                            <?php $pasangan = App\Models\Paslon::where('id', $urutPaslon->paslon_id)->first(); ?>
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$pasangan->candidate}} - {{$pasangan->deputy_candidate}}</td>
                                <td>{{$urutPaslon->total}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <div class="card-header" style="background-color: #eee">
                    <h4 class="mb-0 mx-auto text-black card-title">Data Pemilih dan Hak Pilih</h4>
                </div>
                <table class="table table-striped">
                    <tr>
                        <td style="width: 50%">Jumlah Hak Pilih (DPT)</td>
                        <td style="width: 10%">:</td>
                        <td style="width: 40%">(dummy)</td>
                    </tr>
                    <tr>
                        <td style="width: 50%">Surat Suara Sah</td>
                        <td style="width: 10%">:</td>
                        <td style="width: 40%">(dummy)</td>
                    </tr>
                    <tr>
                        <td style="width: 50%">Suara Tidak Sah</td>
                        <td style="width: 10%">:</td>
                        <td style="width: 40%">(dummy)</td>
                    </tr>
                    <tr>
                        <td style="width: 50%">Jumlah Suara Sah dan Suara Tidak Sah</td>
                        <td style="width: 10%">:</td>
                        <td style="width: 40%">(dummy)</td>
                    </tr>
                    <tr>
                        <td style="width: 50%">Total Surat Suara</td>
                        <td style="width: 10%">:</td>
                        <td style="width: 40%">(dummy)</td>
                    </tr>
                    <tr>
                        <td style="width: 50%">Sisa Surat Suara</td>
                        <td style="width: 10%">:</td>
                        <td style="width: 40%">(dummy)</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>


    <?php

        $id_wilayah = Crypt::decrypt(request()->segment(3));
        $tipe_wilayah = "tps";
    

    ?>
    <livewire:dpt-pemilih-component :id_wilayah="$id_wilayah" :tipe_wilayah="$tipe_wilayah" />




</div>



<!-- SWEET-ALERT JS -->
<script src="../../assets/plugins/sweet-alert/sweetalert.min.js"></script>
<script src="../../assets/js/sweet-alert.js"></script>

<script>
    $('.c1saksi').click(function() {
        $('body').removeClass('timer-alert');
        swal({
            title: "C1 Saksi",
            text: "C1 Saksi adalah hasil perhitungan suara di TPS yang dikirimkan oleh saksi resmi partai.",
            type: "warning",
            confirmButtonText: 'Ok',
        });
    })
</script>

<script>
    $('.c1relawan').click(function() {
        $('body').removeClass('timer-alert');
        swal({
            title: "C1 Relawan",
            text: "C1 Relawan adalah hasil perhitungan suara di TPS yang dikirimkan oleh relawan.",
            type: "warning",
            confirmButtonText: 'Ok',
        });
    })
</script>

<script>
    $('.c1saksipend').click(function() {
        $('body').removeClass('timer-alert');
        swal({
            title: "C1 Saksi (Pending)",
            text: "C1 Saksi (Pending) adalah kiriman data TPS dari saksi yang tertahan karena adanya data C1 dari TPS yang sama telah dikirimkan oleh Relawan setempat. Hal ini biasanya terjadi karena C1 Saksi terlambat dikirimkan dan atau tidak adanya Saksi di TPS tersebut.",
            type: "warning",
            confirmButtonText: 'Ok',
        });
    })
</script>

<script>
    $('.c1relawanband').click(function() {
        $('body').removeClass('timer-alert');
        swal({
            title: "C1 Relawan (Banding)",
            text: "C1 Banding adalah data C1 yang berbeda di TPS yang sama. Kiriman C1 Banding berasal dari masyarakat / relawan untuk dibandingkan dengan C1 Saksi.",
            type: "warning",
            confirmButtonText: 'Ok',
        });
    })
</script>
<!-- CONTAINER END -->
</div>

</div>

<!-- Modal -->
<div class="modal fade" id="periksaModal1" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Foto C1 Plano</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <a>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12"><img width="550px" src="https://demo.tangsel.pilwalkot.rekapitung.id/assets/upload/c1plano.jpg" class="zoom" data-magnify-src="https://demo.tangsel.pilwalkot.rekapitung.id/assets/upload/c1plano.jpg">
                        </div>
                    </div>
                    <form>
                        <div class="row justify-content-between mt-4 mb-4">
                            <div class="col-md-3 text-center">
                                <label for="suara01 w-100">Suara 01</label>
                                <input class="form-control" type="text" value="12" size="10" disabled>
                            </div>
                            <div class="col-md-3 text-center">
                                <label for="suara02">Suara 02</label>
                                <input class="form-control" type="text" value="23" size="10" disabled>
                            </div>
                            <div class="col-md-3 text-center">
                                <label for="suara03">Suara 03</label>
                                <input class="form-control" type="text" value="0" size="10" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="jumlahsuarasah">Jumlah Suara Sah :</label>
                                <input class="form-control" id="jumlahsuarasah" type="text" value="35" size="10" disabled>
                            </div>
                        </div>
                    </form>
                </div>
            </a>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="periksaModal2" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Foto C2 Plano</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <a>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12"><img width="550px" src="https://demo.tangsel.pilwalkot.rekapitung.id/assets/upload/c1plano.jpg" class="zoom" data-magnify-src="https://demo.tangsel.pilwalkot.rekapitung.id/assets/upload/c1plano.jpg">
                        </div>
                    </div>
                    <form>
                        <div class="row justify-content-between mt-4 mb-4">
                            <div class="col-md-3 text-center">
                                <label for="suara01 w-100">Suara 01</label>
                                <input class="form-control" type="text" value="12" size="10" disabled>
                            </div>
                            <div class="col-md-3 text-center">
                                <label for="suara02">Suara 02</label>
                                <input class="form-control" type="text" value="23" size="10" disabled>
                            </div>
                            <div class="col-md-3 text-center">
                                <label for="suara03">Suara 03</label>
                                <input class="form-control" type="text" value="0" size="10" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="jumlahsuarasah">Jumlah Suara Sah :</label>
                                <input class="form-control" id="jumlahsuarasah" type="text" value="35" size="10" disabled>
                            </div>
                        </div>
                    </form>
                </div>
            </a>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



@endsection