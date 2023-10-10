@extends('layouts.mainlayout')

@section('content')
    <?php
    
    use App\Models\Config;
    use App\Models\District;
    use App\Models\Regency;
    use App\Models\SaksiData;
    use App\Models\Tps;
    use App\Models\Village;
    use App\Models\User;
    use Illuminate\Support\Facades\DB;
    
    $config = Config::all()->first();
    $regency = District::where('regency_id', $config['regencies_id'])->get();
    $kota = Regency::where('id', $config['regencies_id'])->first();
    $dpt = District::where('regency_id', $config['regencies_id'])->sum('dpt');
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

    <div class="row mt-3">
        <div class="col-lg-3 col-md-6 break-point-1">
            <div class="row g-0">
                <div class="col-md-4">

                    <img src="{{ asset('assets/images/brand/logo_gold.png') }}"class="img-fluid">
                </div>
                <div class="col-md-8">

<<<<<<< HEAD
{{-- <div class="row mt-3">
    <div class="col-lg-3 col-md-6 break-point-1">
    <div class="row g-0">
        <div class="col-md-4">
        
            <img src="{{asset('assets/images/brand/logo_gold.png')}}"class="img-fluid">
        </div>
        <div class="col-md-8">
            
=======
>>>>>>> 8a75ea6a3818f052d428ac2e73a28571df8fe1bf
                    <h1 class="page-title fs-3 mt-2">DASHBOARD HISUARA
                    </h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $kota['name'] }}
                            <!-- Kota -->
                        </li>
                    </ol>
                </div>
            </div>


            @if ($config->multi_admin == 'yes')
                <?php
                $userOnline = User::where('role_id', 1)->count();
                $jumlahOrang = 0;
                // foreach($userOnline as $user){
                //     if(Cache::has('is_online' . $user->id)){
                //         $jumlahOrang +=1;
                //     }
                // }
                ?>
                <h4 class="fs-4 mt-2 fw-bold">Multi Administator ({{ $userOnline }}) </h4> <!-- This Dummy Data -->
            @else
                <h4 class="fs-4 mt-2 fw-bold">Multi Administator (1) </h4> <!-- This Dummy Data -->
            @endif
            <h5>
                {{ Auth::user()->name }}
            </h5>
        </div>

        <div class="col-lg-9 col-xxl-0 justify-content-end mt-2 break-point-1">
            <div class="row">


                <div class="col open-desktop">

                    <div class="">
                        <div class="card" style="margin-bottom: 0px;">
                            <div class="card-body" style="padding: 5px; padding-bottom: 0px">
                                <div class="card-header text-center" style="padding: 0px; padding-bottom: 10px">
                                    <div class="card-title mx-auto">

                                        Mode Sistem <i class="fa fa-question-circle" data-bs-placement="top"
                                            data-bs-toggle="tooltip" title=""
                                            data-bs-original-title="Mode sistem adalah status sistem HISUARA yang dibagi menjadi tiga bagian, yaitu : mode saksi, mode relawan dan mode overtime (Antisipasi Hacker). Ketiga mode ini berjalan pada hari yang sama dengan pembagian waktu yang telah di tetapkan."></i>
                                    </div>
                                </div>
                                <div class="row mx-auto text-center">
                                    <div class="col-xxl-3 my-auto">
                                        <a href="https://time.is/Jakarta" id="time_is_link" rel="nofollow"
                                            style="font-size:25px"></a>
                                        <span id="Jakarta_z41c" style="font-size:27px"></span>
                                        <div style="font-size:27px">WIB</div>
                                        <script src="//widget.time.is/t.js"></script>
                                        <script>
                                            time_is_widget.init({
                                                Jakarta_z41c: {}
                                            });
                                        </script>
                                    </div>
                                    <div class="col-md me-auto">
                                        <div class="row">

                                            <div class="col mt-2">
                                                <div class="card" style="margin-bottom: 0px;">
                                                    <div class="card-body text-center" style="padding: 0px;">
                                                        <i class="fe fe-user fs-4"></i>
                                                    </div>
                                                    <div class="card-footer text-center" style="color: black; padding: 0px">
                                                        @if ($jam > 8 && $jam < 21)
                                                            <div class="badge bg-success">Saksi : Aktif</div>
                                                        @else
                                                            <div class="badge bg-danger">Saksi : Nonaktif</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <h5 style="font-size:13px" class="text-center mt-3">09.00 - 21.00</h5>
                                            </div>
                                            <div class="col mt-2">
                                                <div class="card" style="margin-bottom: 0px;">
                                                    <div class="card-body text-center" style="padding: 0px;">
                                                        <i class="fe fe-user fs-4"></i>
                                                    </div>
                                                    <div class="card-footer text-center" style="color: black; padding: 0px">

                                                        @if ($jam > 14 && $jam < 21)
                                                            <div class="badge bg-success">Relawan : aktif</div>
                                                        @else
                                                            <div class="badge bg-danger">Relawan : Nonaktif</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <h5 style="font-size:13px" class="text-center mt-3">14.00 - 21.00</h5>
                                            </div>
                                            <div class="col mt-2">
                                                <div class="card" style="margin-bottom: 0px;">
                                                    <div class="card-body text-center" style="padding: 0px;">
                                                        <i class="fe fe-user fs-4"></i>
                                                    </div>
                                                    <div class="card-footer text-center" style="color: black; padding: 0px">
                                                        @if ($jam >= 21)
                                                            <div class="badge bg-success">Overtime : Aktif</div>
                                                        @else
                                                            <div class="badge bg-danger">Overtime : Nonaktif</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <h5 style="font-size:13px" class="text-center mt-3">21.00 - dst</h5>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>




                <div class="col-lg-6 col-md-6 justify-content-end  break-point-2">
                    <div class="card" style="margin-bottom: 0px;">
                        <div class="card-body">
                            <div class="row mx-auto">
                                <div class="col-3 ">
                                    <div class="counter-icon box-shadow-secondary brround candidate-name text-white bg-danger"
                                        style="margin-bottom: 0;">
                                        1
                                    </div>
                                </div>
                                <div class="col me-auto">
                                    <h6 class="">Suara Tertinggi</h6>
                                    <h3 class="mb-2 number-font">{{ $paslon_tertinggi['candidate'] }} /
                                        {{ $paslon_tertinggi['deputy_candidate'] }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-lg-8 justify-content-end mt-2">
            <div class="row">
                <div class="col-lg-4 justify-content-end">
                    <div class="card">
                        <div class="card-header bg-secondary">
                            <div class="card-title text-white">Real Count</div>
                        </div>
                        <div class="card-body">
                            <p class="">{{ substr($realcount, 0, 5) }}%</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header bg-success">
                            <div class="card-title text-white">TPS Masuk</div>
                        </div>
                        <div class="card-body">
                            <p class="">{{ $total_verification_voice }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <div class="card-title text-white">Suara Masuk</div>
                        </div>
                        <div class="card-body">
                            <p class="">{{ $total_incoming_vote }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>

    <div class="row" id="marquee1">
        <div class="input-group input-group-sm">
            <div class="input-group-prepend">
                <button class="btn btn-danger text-white rounded-0 mt-5">Suara Masuk</button>
            </div>
            <div class="form-control mt-5 bg-dark" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                <marquee id="cobamarq1">
                    @foreach ($marquee as $item)
                        // <?php $kecamatan = District::where('id', $item['districts'])->first(); ?>
                        // <?php $kelurahan = Village::where('id', $item['villages'])->first(); ?>
                        // <?php $tps = Tps::where('id', $item['tps_id'])->first(); ?>
                        <span class="text-success">▼ </span><span class="text-white"
                            style="font-size: 20px;">{{ $item['name'] }} Kecamatan {{ $kecamatan['name'] }}, Kelurahan
                            {{ $kelurahan['name'] }}, TPS {{ $tps['number'] }}
                        </span>
                    @endforeach
                </marquee>


            </div>
        </div>
    </div>

    
        @if($config->multi_admin == "yes")
        // <?php
        // $userOnline = User::where('role_id',1)->count();
        // $jumlahOrang = 0;
        // foreach($userOnline as $user){
        //     if(Cache::has('is_online' . $user->id)){
        //         $jumlahOrang +=1;
        //     }
        // }
        // ?>
        <h4 class="fs-4 mt-2 fw-bold">Multi Administator ({{$userOnline}}) </h4> <!-- This Dummy Data -->
        @else
        <h4 class="fs-4 mt-2 fw-bold">Multi Administator (1) </h4> <!-- This Dummy Data -->
        
        @endif
        <h5>
            {{Auth::user()->name}}
        </h5>
    </div>
    
    <div class="col-lg-9 col-xxl-0 justify-content-end mt-2 break-point-1">
        <div class="row">
            

            <div class="col open-desktop">
                
                <div class="">
                    <div class="card" style="margin-bottom: 0px;">
                        <div class="card-body" style="padding: 5px; padding-bottom: 0px">
                            <div class="card-header text-center" style="padding: 0px; padding-bottom: 10px">
                                <div class="card-title mx-auto">
                                    
                                    Mode Sistem <i class="fa fa-question-circle"  data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Mode sistem adalah status sistem HISUARA yang dibagi menjadi tiga bagian, yaitu : mode saksi, mode relawan dan mode overtime (Antisipasi Hacker). Ketiga mode ini berjalan pada hari yang sama dengan pembagian waktu yang telah di tetapkan."></i>
                                </div>
                                <div id="chart-pie" class="chartsh h-100 w-100"></div>
                            </div>
                        </div>
                        <div class="col-xxl-6">
                            <?php $i = 1; ?>
                            @foreach ($paslon as $pas)
                                <div class="row mt-2">
                                    <div class="col-lg col-md col-sm col-xl mb-3">
                                        <div class="card" style="margin-bottom: 0px;">
                                            <div class="card-body">
                                                <div class="row me-auto">
                                                    <div class="col-4">
                                                        <div class="counter-icon box-shadow-secondary brround candidate-name text-white "
                                                            style="margin-bottom: 0; background-color: {{ $pas->color }};">
                                                            {{ $i++ }}
                                                        </div>
                                                    </div>
                                                    <div class="col me-auto">
                                                        <h6 class="">{{ $pas->candidate }} </h6>
                                                        <h6 class="">{{ $pas->deputy_candidate }} </h6>
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
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12" style="display:{{ $config->otonom == 'yes' ? 'none' : 'block' }}">
            <div class="card">
                <div class="card-header bg-secondary-gradient">
                    <h3 class="card-title text-white">Suara TPS Terverifikasi</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xxl-6">
                            <div class="container" style="margin-left: 3%; margin-top: 2.5%;">
                                <div class="text-center fs-3 mb-3 fw-bold">SUARA TERVERIFIKASI</div>
                                <div class="text-center">Terverifikasi {{ $saksi_terverifikasi }} TPS dari
                                    {{ $saksi_masuk }} TPS Masuk</div>
                                <div class="text-center mt-2 mb-2"><span
                                        class="badge bg-success">{{ $total_verification_voice }} /
                                        {{ $dpt }}</span></div>
                                <div id="chart-donut" class="chartsh h-100 w-100"></div>
                            </div>
                        </div>
                        <div class="col-xxl-6">
                            <?php $i = 1; ?>
                            @foreach ($paslon_terverifikasi as $pas)
                                <div class="row mt-2">
                                    <div class="col-lg col-md col-sm col-xl mb-3">
                                        <div class="card" style="margin-bottom: 0px;">
                                            <div class="card-body">
                                                <div class="row me-auto">
                                                    <div class="col-4">
                                                        <div class="counter-icon box-shadow-secondary brround candidate-name text-white ms-auto"
                                                            style="margin-bottom: 0; background-color: {{ $pas->color }};">
                                                            {{ $i++ }}
                                                        </div>
                                                    </div>
                                                    <div class="col me-auto">
                                                        <h6 class="">{{ $pas->candidate }} </h6>
                                                        <h6 class="">{{ $pas->deputy_candidate }} </h6>
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
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="{{ $config->otonom == 'yes' ? 'col-lg-12 col-md-12' : 'col-lg-6 col-md-12' }}">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Suara TPS Masuk (

                        Seluruh Kecamatan)</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="bg-primary">
                            <tr>
                                <th class="text-white text-center align-middle">KECAMATAN</th>
                                @foreach ($paslon as $item)
                                    <th class="text-white text-center align-middle">{{ $item['candidate'] }} - <br>
                                        {{ $item['deputy_candidate'] }}</th>
                                @endforeach

                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($kec as $item)
                                <tr onclick='check("{{ Crypt::encrypt($item->id) }}")'>
                                    <td><a
                                            href="{{ url('/') }}/administrator/perhitungan_kecamatan/{{ Crypt::encrypt($item['id']) }}">{{ $item['name'] }}</a>
                                    </td>
                                    @foreach ($paslon as $cd)
                                        <?php $saksi_dataa = SaksiData::join('saksi', 'saksi.id', '=', 'saksi_data.saksi_id')
                                            ->where('paslon_id', $cd['id'])
                                            ->where('saksi_data.district_id', $item['id'])
                                            ->sum('voice'); ?>
                                        <td>{{ $saksi_dataa }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>

                        <script>
                            let check = function(id) {
                                window.location = `{{ url('/') }}/administrator/perhitungan_kecamatan/${id}`;
                            }
                        </script>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12" style="display:{{ $config->otonom == 'yes' ? 'none' : 'block' }}">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Suara TPS Terverifikasi (Seluruh Kecamatan)</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="bg-primary">
                            <td class="text-white text-center align-middle">KECAMATAN</td>
                            @foreach ($paslon as $item)
                                <th class="text-white text-center align-middle">{{ $item['candidate'] }} - <br>
                                    {{ $item['deputy_candidate'] }}</th>
                            @endforeach
                        </thead>
                        <tbody>
                            @foreach ($kec as $item)
                                <tr onclick='check("{{ Crypt::encrypt($item->id) }}")'>
                                    <td><a
                                            href="{{ url('/') }}/administrator/perhitungan_kecamatan/{{ Crypt::encrypt($item['id']) }}">{{ $item['name'] }}</a>
                                    </td>
                                    @foreach ($paslon as $cd)
                                        <?php $saksi_dataa = SaksiData::join('saksi', 'saksi.id', '=', 'saksi_data.saksi_id')
                                            ->where('paslon_id', $cd['id'])
                                            ->where('saksi_data.district_id', $item['id'])
                                            ->where('saksi.verification', 1)
                                            ->sum('voice'); ?>
                                        <td>{{ $saksi_dataa }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="card-title">Tabulasi ({{ ucwords(strtolower($kota->name)) }})</div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg justify-content-end">
                    <div class="card">
                        <div class="card-header bg-secondary">
                            <div class="card-title text-white">Total TPS</div>
                        </div>
                        <div class="card-body">
                            <h3 class="">{{ $total_tps }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg">
                    <div class="card">
                        <div class="card-header bg-danger">
                            <div class="card-title text-white">TPS Masuk</div>
                        </div>
                        <div class="card-body">
                            <h3 class="">{{ $tps_masuk }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <div class="card-title text-white">TPS Kosong</div>
                        </div>
                        <div class="card-body">
                            <h3 class="">{{ $tps_kosong }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg">
                    <div class="card">
                        <div class="card-header bg-cyan">
                            <div class="card-title text-white">Suara Masuk</div>
                        </div>
                        <div class="card-body">
                            <h3 class="">{{ $suara_masuk }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg">
                    <div class="card">
                        <div class="card-header bg-success">
                            <div class="card-title text-white">Suara Terverifikasi</div>
                        </div>
                        <div class="card-body">
                            <h3 class="">{{ $total_verification_voice }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<<<<<<< HEAD
    
</div> --}}



<div class="row" id="marquee1">
    <div class="input-group input-group-sm">
        <div class="input-group-prepend">
            <button class="btn btn-danger text-white rounded-0 mt-5">Suara Masuk</button>
        </div>
        <div class="form-control mt-5 bg-dark" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
            <marquee id="cobamarq1">
                @foreach ($marquee as $item)
                <?php $kecamatan =  District::where('id', $item['districts'])->first(); ?>
                <?php $kelurahan =  Village::where('id', $item['villages'])->first(); ?>
                <?php $tps =  Tps::where('id', $item['tps_id'])->first(); ?>
                <span class="text-success">▼ </span><span class="text-white" style="font-size: 20px;">{{$item['name']}} Kecamatan {{$kecamatan['name']}}, Kelurahan {{$kelurahan['name']}}, TPS {{$tps['number']}}
                </span>     
                @endforeach
            </marquee>


        </div>
    </div>
</div>

<style>
    .col.judul {
        padding-top: 10px;
        padding-bottom: 10px;
    }
</style>

<div class="card mb-0 mt-3">
    <div class="card-header">
        <div class="card-title">Tabulasi (Kota Tangerang Selatan)</div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col h4 judul text-center bg-secondary text-white" style="border-top-left-radius: 25px; border-bottom-left-radius: 25px">Total TPS</div>
            <div class="col h4 judul text-center bg-danger text-white">TPS Masuk</div>
            <div class="col h4 judul text-center bg-primary text-white">TPS Kosong</div>
            <div class="col h4 judul text-center bg-info text-white">Suara Masuk</div>
            <div class="col h4 judul text-center bg-success text-white" style="border-top-right-radius: 25px; border-bottom-right-radius: 25px">Suara Terverifikasi</div>
        </div>
        <div class="row">
            <div class="col h3 text-center"><h3 class="">{{ $total_tps }}</h3></div>
            <div class="col h3 text-center"><h3 class="">{{ $tps_masuk }}</h3></div>
            <div class="col h3 text-center"><h3 class="">{{ $tps_kosong }}</h3></div>
            <div class="col h3 text-center"><h3 class="">{{ $suara_masuk }}</h3></div>
            <div class="col h3 text-center"><h3 class="">{{$total_verification_voice}}</h3></div>
        </div>
    </div>
</div>

{{-- <div class="card mb-0 mt-3">
    <div class="card-header">
        <div class="card-title">Tabulasi (Kota Tangerang Selatan)</div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg justify-content-end">
                <div class="card mb-0">
                    <div class="card-header bg-secondary">
                        <div class="card-title text-white">Total TPS</div>
                    </div>
                    <div class="card-body">
                        <h3 class="">{{ $total_tps }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="card mb-0">
                    <div class="card-header bg-danger">
                        <div class="card-title text-white">TPS Masuk</div>
                    </div>
                    <div class="card-body">
                        <h3 class="">{{ $tps_masuk }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="card mb-0">
                    <div class="card-header bg-primary">
                        <div class="card-title text-white">TPS Kosong</div>
                    </div>
                    <div class="card-body">
                        <h3 class="">{{ $tps_kosong }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="card mb-0">
                    <div class="card-header bg-cyan">
                        <div class="card-title text-white">Suara Masuk</div>
                    </div>
                    <div class="card-body">
                        <h3 class="">{{ $suara_masuk }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="card mb-0">
                    <div class="card-header bg-success">
                        <div class="card-title text-white">Suara Terverifikasi</div>
                    </div>
                    <div class="card-body">
                        <h3 class="">{{$total_verification_voice}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}


<div class="row mt-3">
    <div class="{{($config->otonom == 'yes')?'col-lg-12 col-md-12':'col-lg-6 col-md-12'}}">
        <div class="card">
            <div class="card-header bg-info-gradient">
                <h3 class="card-title text-white">Suara TPS Masuk</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xxl-6">
                        <div class="container" style="margin-left: 3%; margin-right: 3%; margin-top: 2.5%;">
                            <div class="text-center fs-3 mb-3 fw-bold">SUARA MASUK</div>
                            <div class="text-center">Progress {{substr($realcount,0,5)}}% dari 100%</div>
                            <div class="text-center mt-2 mb-2"><span class="badge bg-success">{{$total_incoming_vote}} / {{$dpt}}</span></div>
                            <div id="chart-pie" class="chartsh h-100 w-100"></div>
                        </div>
                    </div>
                    <div class="col-xxl-6">
                        <?php $i = 1; ?>
                        @foreach ($paslon as $pas)
                        <div class="row mt-2">
                            <div class="col-lg col-md col-sm col-xl mb-3">
                                <div class="card" style="margin-bottom: 0px;">
                                    <div class="card-body">
                                        <div class="row me-auto">
                                            <div class="col-4">
                                                <div class="counter-icon box-shadow-secondary brround candidate-name text-white " style="margin-bottom: 0; background-color: {{$pas->color}};">
                                                    {{$i++}}
                                                </div>
                                            </div>
                                            <div class="col me-auto">
                                                <h6 class="">{{$pas->candidate}} </h6>
                                                <h6 class="">{{$pas->deputy_candidate}} </h6>
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
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-12" style="display:{{($config->otonom == 'yes')?'none':'block'}}">
        <div class="card">
            <div class="card-header bg-secondary-gradient">
                <h3 class="card-title text-white">Suara TPS Terverifikasi</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xxl-6">
                        <div class="container" style="margin-left: 3%; margin-top: 2.5%;">
                            <div class="text-center fs-3 mb-3 fw-bold">SUARA TERVERIFIKASI</div>
                            <div class="text-center">Terverifikasi {{$saksi_terverifikasi}} TPS dari {{$saksi_masuk}} TPS Masuk</div>
                            <div class="text-center mt-2 mb-2"><span class="badge bg-success">{{$total_verification_voice}} / {{$dpt}}</span></div>
                            <div id="chart-donut" class="chartsh h-100 w-100"></div>
                        </div>
                    </div>
                    <div class="col-xxl-6">
                        <?php $i = 1; ?>
                        @foreach ($paslon_terverifikasi as $pas)
                        <div class="row mt-2">
                            <div class="col-lg col-md col-sm col-xl mb-3">
                                <div class="card" style="margin-bottom: 0px;">
                                    <div class="card-body">
                                        <div class="row me-auto">
                                            <div class="col-4">
                                                <div class="counter-icon box-shadow-secondary brround candidate-name text-white ms-auto" style="margin-bottom: 0; background-color: {{$pas->color}};">
                                                    {{$i++}}
                                                </div>
                                            </div>
                                            <div class="col me-auto">
                                                <h6 class="">{{$pas->candidate}} </h6>
                                                <h6 class="">{{$pas->deputy_candidate}} </h6>
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
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="{{($config->otonom == 'yes')?'col-lg-12 col-md-12':'col-lg-6 col-md-12'}}">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Suara TPS Masuk (
                    
                    Seluruh Kecamatan)</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="bg-primary">
                        <tr>
                            <th class="text-white text-center align-middle">KECAMATAN</th>
                            @foreach ($paslon as $item)
                            <th class="text-white text-center align-middle">{{ $item['candidate']}} - <br> {{ $item['deputy_candidate']}}</th>
                            @endforeach

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($kec as $item)
                        <tr onclick='check("{{Crypt::encrypt($item->id)}}")'>
                            <td><a href="{{url('/')}}/administrator/perhitungan_kecamatan/{{Crypt::encrypt($item['id'])}}">{{$item['name']}}</a></td>
                            @foreach ($paslon as $cd)
                            <?php $saksi_dataa = SaksiData::join('saksi', 'saksi.id', '=', 'saksi_data.saksi_id')->where('paslon_id', $cd['id'])->where('saksi_data.district_id', $item['id'])->sum('voice'); ?>
                            <td>{{$saksi_dataa}}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>

                    <script>
                        let check = function(id) {
                            window.location = `{{url('/')}}/administrator/perhitungan_kecamatan/${id}`;
                        }
                    </script>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-12" style="display:{{($config->otonom == 'yes')?'none':'block'}}">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Suara TPS Terverifikasi (Seluruh Kecamatan)</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="bg-primary">
                        <td class="text-white text-center align-middle">KECAMATAN</td>
                        @foreach ($paslon as $item)
                        <th class="text-white text-center align-middle">{{ $item['candidate']}} - <br> {{ $item['deputy_candidate']}}</th>
                        @endforeach
                    </thead>
                    <tbody>
                        @foreach ($kec as $item)
                        <tr onclick='check("{{Crypt::encrypt($item->id)}}")'>
                            <td><a href="{{url('/')}}/administrator/perhitungan_kecamatan/{{Crypt::encrypt($item['id'])}}">{{$item['name']}}</a></td>
                            @foreach ($paslon as $cd)
                            <?php $saksi_dataa = SaksiData::join('saksi', 'saksi.id', '=', 'saksi_data.saksi_id')->where('paslon_id', $cd['id'])->where('saksi_data.district_id', $item['id'])->where('saksi.verification',1)->sum('voice'); ?>
                            <td>{{$saksi_dataa}}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
=======

    <div class="card">
        <div class="tab mt-5">
            <div class="row">
                <div class="col-md">
                    <?php
                    $count_suara = \App\Models\Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
                        ->join('users', 'users.tps_id', '=', 'tps.id')
                        // ->where('tps.villages_id', (string)$village->id)
                        ->where('saksi.verification', '')
                        ->whereNull('saksi.pending')
                        ->where('saksi.overlimit', 0)
                        ->count();
                    $count_kecurangan = \App\Models\Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
                        ->join('users', 'users.tps_id', '=', 'tps.id')
                        ->where('saksi.kecurangan', 'yes')
                        ->where('saksi.status_kecurangan', 'belum terverifikasi')
                        ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
                        ->count();
                    
                    ?>
                    <button class="btn tablink w-100 rounded-0 c1saksi" onclick="openPage('C1-Saksi', this, '#45aaf2 ')"
                        id="defaultOpen">C1 Saksi <span
                            class="badge rounded-pill bg-danger">{{ $count_suara }}</span></button>
                </div>
                <!-- <div class="col-md">
                <button class="btn tablink w-100 rounded-0 c1partai" onclick="openPage('C1-Partai', this, '#f7b731')">C1 Partai</button>
            </div> -->
                <div class="col-md">
                    <button class="btn tablink w-100 rounded-0 c1relawan"
                        onclick="openPage('C1-Relawan', this, '#f82649')">C1 Relawan Partai</button>
                </div>
                <div class="col-md">
                    <button class="btn tablink w-100 rounded-0 c1saksipend"
                        onclick="openPage('C1-Saksi-Pending', this, '#6259ca ')"
                        style="background-color: rgb(98, 89, 202);">C1
                        Saksi (Pending)</button>
                </div>
                <!-- <div class="col-md">
                <button class="btn tablink w-100 rounded-0 kecurangan" onclick="openPage('Kecurangan', this, '#09ad95')">Kecurangan <span class="badge rounded-pill bg-danger">{{ $count_kecurangan }}</span></button>
            </div> -->
            </div>
        </div>
    </div>
    <div class="card-body">
        <div id="C1-Saksi" class="tabcontent">
            <livewire:c1-saksi-kota />
        </div>
        <div id="C1-Relawan" class="tabcontent">
        <livewire:c1-relawan-kota />
        </div>
        <div id="C1-Saksi-Pending" class="tabcontent">
        <livewire:c1-saksi-pending-kota />
        </div>
    </div>

    <script>
    function openPage(pageName, elmnt, color) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].style.backgroundColor = "";
        }
        document.getElementById(pageName).style.display = "block";
        elmnt.style.backgroundColor = color;
    }
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>
    


<div class="modal fade" id="periksaC1Verifikator" tabindex="-1" aria-labelledby="periksaC1VerifikatorLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="periksaC1VerifikatorLabel">Data C1 TPS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row" id="container-view-modal">

                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="periksaC1Relawan" tabindex="-1" aria-labelledby="periksaC1RelawanLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="periksaC1RelawanLabel">Data TPS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row" id="container-view-modal-relawan">

                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="periksaC1Pending" tabindex="-1" aria-labelledby="periksaC1PendingLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="periksaC1PendingLabel">Data C1 Pending</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <div class="row" id="container-view-modal-c1-pending">

                </div>
            </div>
            <div class="modal-footer">
>>>>>>> 8a75ea6a3818f052d428ac2e73a28571df8fe1bf
            </div>
        </div>
    </div>
</div>

<<<<<<< HEAD
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


@endsection
=======

    <script>
  const buttonperiksaC1Relawan = $("button.periksa-c1-relawan");
//   const buttonkecurangan = $("button.periksa-c1-kecurangan");
  const buttonC1Pending = $("button.periksa-c1-pending");
  const buttonperiksaC1 = $("button.periksa-c1-plano");
  buttonperiksaC1.on('click', function() {
    const id = $(this).data('id');
    $.ajax({
      url: "{{route('verifikator.getSaksiData')}}",
      data: {
        "_token": "{{ csrf_token() }}",
        id
      },
      type: "post",
      dataType: "html",
      success: function(data) {
        $('#container-view-modal').html(data)
      }
    });
  });
  buttonC1Pending.on('click', function() {
    const id = $(this).data('id');
    $.ajax({
      url: "{{route('verifikator.getSaksiPending')}}",
      data: {
        "_token": "{{ csrf_token() }}",
        id
      },
      type: "get",
      dataType: "html",
      success: function(data) {
        $('#container-view-modal-c1-pending').html(data)
      }
    });
  });

  buttonperiksaC1Relawan.on('click', function() {
    const id = $(this).data('id');
    $.ajax({
      url: "{{route('verifikator.getRelawanData')}}",
      data: {
        "_token": "{{ csrf_token() }}",
        id
      },
      type: "post",
      dataType: "html",
      success: function(data) {
        $('#container-view-modal-relawan').html(data)
      }
    });
  });

//   buttonkecurangan.on('click', function() {
//     const id = $(this).data('id');
//     $.ajax({
//       url: "{{route('verifikator.getKecuranganSaksi')}}",
//       data: {
//         id
//       },
//       type: "get",
//       dataType: "html",
//       success: function(data) {
//         $('#container-view-modal-kecurangan').html(data)
//       }
//     });
//   })
    </script>


    <!-- <div class="card mg-b-20"style="display:{{ $config->otonom == 'yes' ? ' none' : 'block' }}">
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
@endsection
>>>>>>> 8a75ea6a3818f052d428ac2e73a28571df8fe1bf
