@extends('layouts.main-sidang-online')


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
    $regency_id = RegenciesDomain::where('domain', $url)->first();
    
$reg = App\Models\Regency::where('id', $regency_id->regency_id)->first();

$config = new Configs;
$config->regencies_id =  (string) $regency_id->regency_id;
    $config->provinces_id = $configs->provinces_id;
    $config->setup = $configs->setup;
    $config->darkmode = $configs->darkmode;
    $config->updated_at = $configs->updated_at;
    $config->created_at = $configs->created_at;
    $config->partai_logo = $configs->partai_logo;
    $config->date_overlimit = $configs->date_overlimit;
    $config->show_public = $configs->show_public;
    $config->show_terverifikasi = $configs->show_terverifikasi;
    $config->lockdown = $configs->lockdown;
    $config->multi_admin = $configs->multi_admin;
    $config->otonom = $configs->otonom;
    $config->dark_mode = $configs->dark_mode;
    $config->jumlah_multi_admin = $configs->jumlah_multi_admin;
    $config->jenis_pemilu = $configs->jenis_pemilu;
    $config->tahun = $configs->tahun;
    $config->quick_count = $configs->quick_count;
    $config->default = $configs->default;
    
    $regency = District::where('regency_id', $config->regencies_id)->get();
    $kota = Regency::where('id', $config->regencies_id)->first();
    $dpt = District::where('regency_id', $config->regencies_id)->sum('dpt');
    $tps = Tps::count();
    ?>

<div class="row">
    <div class="container mt-3">
        <div class="row align-items-center">
            <div class="col-auto">
                <img style="width: 250px;" src="{{url('/')}}/images/logo/hisuara_new.png" class="img-fluid mr-3" alt="">
            </div>
            <div class="col">
                <h1 class="fw-bold mb-0">Sidang MK Gugatan Pemilu Presiden 2024</h1><br>
                Online
            </div>
        </div>
    </div>
    <div class="display-cover" id="card1">
        <video autoplay></video>
        <canvas class="d-none"></canvas>
    
        <div class="video-options">
            <select name="" id="" class="custom-select form-control">
                <option value="">Select camera</option>
            </select>
        </div>
        <img class="screenshot-image d-none" alt="">
        <div class="controls">
            <button class="btn btn-danger play" title="Play"><i data-feather="play-circle"></i></button>
            <button class="btn btn-info pause d-none" title="Pause"><i data-feather="pause"></i></button>
            <button class="btn btn-outline-success screenshot d-none" title="ScreenShot"><i
                    data-feather="image"></i></button>
        </div>
        {{-- <div class="filter-controls">
            <button class="btn btn-primary rounded-0">Buramkan Wajah</button>
            <button class="btn btn-secondary rounded-0">Efek Suara</button>
            <button class="btn btn-dark rounded-0">Ganti Latar Belakang</button>
        </div> --}}
    </div>
    <div class="display-cover bg-dark" style="height : 500px; display : none" id="card2">
        <h5 class="text-white"> Memanggil</h5>
    </div>
    <div class="container">
        <div class="row">
    
            <div class="col text-center">
                <a id="panggil" class="w-100 btn btn-info">Panggil</a>
                <a id="batalkan" style="display : none;" class="w-100 btn btn-danger">Batalkan</a>
            </div>
            <div class="col text-center">
                <a href="{{url('/')}}/administrator/sidang_online/action/{{encrypt($tps_id)}}/{{encrypt(" Tidak
                    Menjawab")}}" class="w-100 btn btn-danger">Tidak Menjawab</a>
            </div>
            <div class="col text-center">
                <a href="{{url('/')}}/administrator/sidang_online/action/{{encrypt($tps_id)}}/{{encrypt(" Selesai")}}"
                    class="w-100 btn btn-success">Selesai</a>
            </div>
            <div class="col text-center">
                <a href="{{url('/')}}/administrator/sidang_online" class="w-100 btn btn-dark">Close</a>
    
            </div>
    
    
    
    
        </div>
    </div>
</div>
@endsection