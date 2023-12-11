@extends('layouts.mainlayoutPusat')
@section('content')
    <?php
    
    use App\Models\Config;
    use App\Models\District;
    use App\Models\ProvinceDomain;
    use App\Models\Regency;
    use App\Models\SaksiData;
    use App\Models\Tps;
    use App\Models\Village;
    use App\Models\User;
    use Illuminate\Support\Facades\DB;
    
    $config = Config::first();
    
    ?>

    <style>
        .open-desktop {
            display: block;
        }

        .title-atas-table {
            line-height: 23px
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

    <div class="row">

        <div class="col-12">
            <div class="row justify-content-center">
                <div class="col-lg">
                    <h5 class="page-title mt-1 mb-5" style="font-size: 30px;">
                        <div class="row text-center">
                            <div class="col-12">
                                <img src="{{asset('images/logo/garuda.png')}}" style="width: 100px" class="mb-3" alt=""> <br>
                            </div>
                            <div class="col">
                                <div class="my-auto mx-auto">
                                    PERHITUNGAN SUARA <br>
                                    PRESIDEN & WAKIL PRESIDEN RI 2024 <br>
                                    TINGKAT NASIONAL
                                </div>
                            </div>
                        </div>
                    </h5>
                </div>
                
                {{-- <div class="col-lg-auto">
                    <img src="{{asset('images/logo/hisuara_new.png')}}" style="height: 60px" class="mb-3" alt="">
                </div> --}}
            </div>
        </div>

        <div class="col-lg-12">
            <style>
                ul.breadcrumb {
                    padding: 10px 16px;
                    list-style: none;
                    height: 50px;
                    background: linear-gradient(90deg, rgba(241,12,69,1) 0%, rgba(165,0,128,1) 100%);
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
                <?php $regencies = Regency::get(); ?>
                <li><a class="text-white fw-bold">DASHBOARD NASIONAL</a></li>
                {{-- <img src="{{ asset('') }}assets/icons/hisuara_new.png" style="position: absolute; top: -50px; left: 25px; width: 150px"
                    alt=""> --}}

            </ul>
        </div>

        <div class="col-12 mt-1">
            <div class="card">
                <div class="card-body" style="position: relative">
                    {{-- <img src="{{ asset('') }}assets/icons/hisuara_new.png"
                        style="position: absolute; top: 25px; left: 25px; width: 150px" alt=""> --}}
                    <div class="row">
                        {{-- <div class="col-8"></div> --}}

                        {{-- <div class="col-4">
                            <div class="row">
                                <div class="col">
                                    <div class="container">
                                        <div class="text-center fs-3 mb-3 fw-bold">Quick Count</div>
                                        <div class="text-center">Progress {{ substr($realcount, 0, 5) }}% dari 100%</div>
                                        <div class="text-center mt-2 mb-2"><span class="badge bg-success">{{ $total_incoming_vote }}
                                                /
                                                {{ $dpt }}</span></div>
                                        <div id="chart-quick" class="chartsh h-100 w-100"></div>
                                    </div>
                                </div>
                                <div class="col d-flex">
                                    <div class="row my-auto mt-2 d-flex">
                                        <?php $i = 1; ?>
                                        @foreach ($paslon as $pas)
                                        <div class="col-12 mb-3">
                                            <div class="card" style="margin-bottom: 0px;">
                                                <div class="card-body p-3">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mx-auto counter-icon box-shadow-secondary brround candidate-name text-white d-flex"
                                                                style="margin-bottom: 0; background-color: {{ $pas->color }}; overflow: hidden; position:relative">
                                                                <img style="bottom: -10px; position: absolute; left: 50%; transform: translateX(-50%)"
                                                                    class="my-auto" src="{{ asset('') }}storage/{{ $pas->picture }}" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="col text-center">
                                                            <h6 class="mt-4">{{ $pas->candidate }} - {{ $pas->deputy_candidate }}</h6>
                                                            @php
                                                            $voice = 0;
                                                            foreach ($regencies as $regency) {
                                                            $voice += $regency->{'suaraq' . $i};
                                                            }
                                                            @endphp
                                                            <h3 class="mb-2 number-font">{{ $voice }} Suara</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                        $i++;
                                        @endphp
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <div class="col-6">
                            <div class="row">
                                <div class="col-12">
                                    <div class="container">
                                        <div class="text-center fs-3 mb-3 fw-bold">REAL COUNT</div>
                                        <div class="text-center">Progress {{ substr($realcount, 0, 5) }}% dari 100%</div>
                                        <div id="chart-pie" style="height: 600px;" class="chartsh"></div>
                                        <div class="text-center mt-2 mb-2"><span class="badge bg-success">{{ $total_incoming_vote }}
                                                /
                                                {{ $dpt }}</span></div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex mt-3">
                                    <div class="row mx-auto my-auto mt-2 d-flex justify-content-center">
                                        <?php $i = 1; ?>
                                        @foreach ($paslon as $pas)
                                        <div class="col mb-3">
                                            <div class="card" style="margin-bottom: 0px;">
                                                <div class="card-body p-3">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="mx-auto counter-icon box-shadow-secondary brround candidate-name text-white d-flex"
                                                                style="margin-bottom: 0; background-color: {{ $pas->color }}; overflow: hidden; position:relative">
                                                                <img style="bottom: -10px; position: absolute; left: 50%; transform: translateX(-50%)"
                                                                    class="my-auto" src="{{ asset('') }}storage/{{ $pas->picture }}" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="col text-center">
                                                            <h6 class="mt-4">{{ $pas->candidate }} - {{ $pas->deputy_candidate }}</h6>
                                                            @php
                                                            $voice = 0;
                                                            foreach ($regencies as $regency) {
                                                            $voice += $regency->{'suara' . $i};
                                                            }
                                                            @endphp
                                                            <h3 class="mb-2 number-font">{{ $voice }} Suara</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                        $i++;
                                        @endphp
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col">
                                            <div class="container">
                                                <div class="text-center fs-3 mb-3 fw-bold">QUICK COUNT</div>
                                                <div class="text-center">Progress {{ substr($realcount, 0, 5) }}% dari 100%</div>
                                                <div class="text-center mt-2 mb-2"><span class="badge bg-success">{{ $total_incoming_vote }}
                                                        /
                                                        {{ $dpt }}</span></div>
                                                <div id="chart-quick" class="chartsh h-100 w-100"></div>
                                            </div>
                                        </div>
                                        <div class="col d-flex">
                                            <div class="row my-auto mt-2 d-flex">
                                                <?php $i = 1; ?>
                                                @foreach ($paslon as $pas)
                                                <div class="col-12 mb-3">
                                                    <div class="card" style="margin-bottom: 0px;">
                                                        <div class="card-body p-3">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="mx-auto counter-icon box-shadow-secondary brround candidate-name text-white d-flex"
                                                                        style="margin-bottom: 0; background-color: {{ $pas->color }}; overflow: hidden; position:relative">
                                                                        <img style="bottom: -10px; position: absolute; left: 50%; transform: translateX(-50%)"
                                                                            class="my-auto" src="{{ asset('') }}storage/{{ $pas->picture }}" alt="">
                                                                    </div>
                                                                </div>
                                                                <div class="col text-center">
                                                                    <h6 class="mt-4">{{ $pas->candidate }} - {{ $pas->deputy_candidate }}</h6>
                                                                    @php
                                                                    $voice = 0;
                                                                    foreach ($regencies as $regency) {
                                                                    $voice += $regency->{'suaraq' . $i};
                                                                    }
                                                                    @endphp
                                                                    <h3 class="mb-2 number-font">{{ $voice }} Suara</h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                $i++;
                                                @endphp
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="row">
                                        <div class="col">
                                            <div class="container">
                                                <div class="text-center fs-3 mb-3 fw-bold">TERVERIFIKASI</div>
                                                <div class="text-center">Progress {{ substr($realcount, 0, 5) }}% dari 100%</div>
                                                <div class="text-center mt-2 mb-2"><span class="badge bg-success">{{ $total_incoming_vote }}
                                                        /
                                                        {{ $dpt }}</span></div>
                                                <div id="chart-donut" class="chartsh h-100 w-100"></div>
                                            </div>
                                        </div>
                                        <div class="col d-flex">
                                            <div class="row my-auto mt-2 d-flex">
                                                <?php $i = 1; ?>
                                                @foreach ($paslon as $pas)
                                                <div class="col-12 mb-3">
                                                    <div class="card" style="margin-bottom: 0px;">
                                                        <div class="card-body p-3">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="mx-auto counter-icon box-shadow-secondary brround candidate-name text-white d-flex"
                                                                        style="margin-bottom: 0; background-color: {{ $pas->color }}; overflow: hidden; position:relative">
                                                                        <img style="bottom: -10px; position: absolute; left: 50%; transform: translateX(-50%)"
                                                                            class="my-auto" src="{{ asset('') }}storage/{{ $pas->picture }}" alt="">
                                                                    </div>
                                                                </div>
                                                                <div class="col text-center">
                                                                    <h6 class="mt-4">{{ $pas->candidate }} - {{ $pas->deputy_candidate }}</h6>
                                                                    @php
                                                                    $voice = 0;
                                                                    foreach ($regencies as $regency) {
                                                                    $voice += $regency->{'suarav' . $i};
                                                                    }
                                                                    @endphp
                                                                    <h3 class="mb-2 number-font">{{ $voice }} Suara</h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                $i++;
                                                @endphp
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="col-4">
                            <div class="row">
                                <div class="col">
                                    <div class="container">
                                        <div class="text-center fs-3 mb-3 fw-bold">Terverifikasi</div>
                                        <div class="text-center">Progress {{ substr($realcount, 0, 5) }}% dari 100%</div>
                                        <div class="text-center mt-2 mb-2"><span class="badge bg-success">{{ $total_incoming_vote }}
                                                /
                                                {{ $dpt }}</span></div>
                                        <div id="chart-donut" class="chartsh h-100 w-100"></div>
                                    </div>
                                </div>
                                <div class="col d-flex">
                                    <div class="row my-auto mt-2 d-flex">
                                        <?php $i = 1; ?>
                                        @foreach ($paslon as $pas)
                                        <div class="col-12 mb-3">
                                            <div class="card" style="margin-bottom: 0px;">
                                                <div class="card-body p-3">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mx-auto counter-icon box-shadow-secondary brround candidate-name text-white d-flex"
                                                                style="margin-bottom: 0; background-color: {{ $pas->color }}; overflow: hidden; position:relative">
                                                                <img style="bottom: -10px; position: absolute; left: 50%; transform: translateX(-50%)"
                                                                    class="my-auto" src="{{ asset('') }}storage/{{ $pas->picture }}" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="col text-center">
                                                            <h6 class="mt-4">{{ $pas->candidate }} - {{ $pas->deputy_candidate }}</h6>
                                                            @php
                                                            $voice = 0;
                                                            foreach ($regencies as $regency) {
                                                            $voice += $regency->{'suarav' . $i};
                                                            }
                                                            @endphp
                                                            <h3 class="mb-2 number-font">{{ $voice }} Suara</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                        $i++;
                                        @endphp
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <style>
                            .row:has(> .custom-urutan) {
                                margin-top: 75px
                            }

                            .custom-urutan::before {
                                position: absolute;
                                top: -80px;
                                left: 50%;
                                transform: translateX(-50%);
                                font-size: 60px;
                                color: black;
                            }

                            .custom-urutan:nth-child(1)::before {
                                content: '1'
                            }

                            .custom-urutan:nth-child(2)::before {
                                content: '2'
                            }

                            .custom-urutan:nth-child(3)::before {
                                content: '3'
                            }
                        </style>

                        <div class="col-12 mt-5 pt-5" style="border-top: 4px #eee solid">
                            {{-- <div class="text-center title-atas-table fs-1 mb-0 fw-bold my-3">Hasil Perhitungan Suara Pilpres 2024 Tingkat Nasional</div> --}}
                            <div class="row mx-auto" style="width: 884.5px;">

                            </div>
                            {{-- <style>
                                table.tabel-kustom tbody {
                                    display: block;
                                    height: 450px;
                                    overflow: auto;
                                }
                                table.tabel-kustom thead, table.tabel-kustom tbody tr {
                                    display: table;
                                    width: 100%;
                                    table-layout: fixed;/* even columns width , fix width of table too*/
                                }
                            </style> --}}
                            {{-- <div style="overflow-y:auto;height:500px"> --}}
                                @php
                                $provinsi_array = $provinsi->toArray();
                                @endphp
                                
                                <div class="row mt-4">
                                    @foreach([0, 1] as $tableIndex)
                                    <div class="col-6">
                                        <table class="table table-bordered table-hover mt-3 tabel-kustom">
                                            <thead class="bg-primary">
                                                <tr>
                                                    <th class="text-white text-center align-middle" style="width: 40% !important">PROVINSI</th>
                                                    @foreach ($paslon as $item)
                                                    <th class="text-white text-center align-middle"
                                                        style="background: {{ $item['color'] }}; position:relative">
                                                        <img style="width: 60px; position: absolute; left: 0; bottom: 0"
                                                            src="{{ asset('storage/' . $item['picture']) }}" alt="">
                                                        <div class="ms-7">
                                                            {{ $item['candidate'] }} - <br>
                                                            {{ $item['deputy_candidate'] }}
                                                        </div>
                                                    </th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach (array_slice($provinsi_array, $tableIndex * 19, 19) as $item)
                                                <tr>
                                                    <td class="align-middle" style="width: 40% !important">
                                                        @php
                                                        $regency = Regency::where('province_id', $item['id'])->select('id')->get();
                                                        $voice = 0;
                                                        foreach ($regency as $reg) {
                                                        $jumlah_tps = TPS::where('regency_id', $reg->id)->count();
                                                        $jumlah_terisi = TPS::where('setup', 'terisi')->where('regency_id', $reg->id)->count();
                                                        $persentase = ($jumlah_tps > 0 && $jumlah_terisi > 0) ? $jumlah_terisi / $jumlah_tps * 100 : 0;
                                                        }
                                                        @endphp
                                                        <a href="{{ route('provinsi' . $item['id'] . '.home', Crypt::encrypt($item['id'])) }}">{{
                                                            $item['name'] }}</a>
                                                        <span><small>({{ substr($persentase, 0, 4) }}/100%)</small></span>
                                                    </td>
                                                    <?php $i = 1; ?>
                                                    @foreach ($paslon as $cd)
                                                    <?php $saksi_dataa = Regency::where('province_id', $item['id'])->sum('suara' . $i); ?>
                                                    <td class="align-middle text-end">{{ $saksi_dataa }}</td>
                                                    @php $i++; @endphp
                                                    @endforeach
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @endforeach
                                </div>
                            {{-- </div> --}}
                        </div>

                    </div>
                </div>


            </div>

        </div>

        <div class="col-12">
            <div style="background: linear-gradient(90deg, rgba(204,61,189,1) 0%, rgba(119,42,220,1) 100%);"
                class="col-12 text-white p-2 fs-5 fw-bold text-center">
                PERHITUNGAN TINGKAT PROVINSI
            </div>
            <div class="row my-3 k" style="flex-wrap: nowrap; overflow-x: scroll">
                @foreach ($provinsi as $item)
                <div class="col-auto my-2">
                    <a href="{{route('provinsi' . $item->id . '.home',Crypt::encrypt($item['id']) )}}">
                        <div class="text-center mb-2">
                            <img src="{{asset('assets/imagesProvinsi/'. $item->logo_provinsi)}}" alt="">
                        </div>
                        <div class="text-center">
                            {{$item->name}}
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            
            <div class="col-12">
                <div class="row">
                    @foreach ($provinsi as $item)
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header text-white"
                                style="background: linear-gradient(90deg, rgba(39,109,231,1) 0%, rgba(119,42,220,1) 100%);">
                                <div class="card-title mx-auto">
                                    <a href="{{route('provinsi' . $item->id . '.home',Crypt::encrypt($item['id']) )}}">
                                        PROVINSI {{ $item['name'] }}
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="charture-{{ $item['id'] }}" class="chartsh asd h-100 w-100"></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

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
        })
    </script>
@endsection
