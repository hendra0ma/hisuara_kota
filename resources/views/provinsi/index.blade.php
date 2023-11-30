@extends('layouts.mainlayoutProvinsi')
@section('content')
    <?php
    
    use App\Models\Config;
    use App\Models\District;
    use App\Models\ProvinceDomain;
    use App\Models\RegenciesDomain;
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

        <div class="col-lg-12">
            <center>
                <h5 class="page-title mt-1 mb-5" style="font-size: 30px;">
                    <img src="{{asset('images/logo/garuda.png')}}" style="width: 100px" class="mb-3" alt=""> <br>
                    <div class="my-auto mx-auto">
                        PERHITUNGAN SUARA <br>
                        PRESIDEN & WAKIL PRESIDEN RI 2024
                    </div>
                </h5>
            </center>
        </div>
        
        <div class="col-lg-12">
            <style>
                ul.breadcrumb {
                    padding: 10px 16px;
                    list-style: none;
                    height: 50px;
                    background: linear-gradient(90deg, rgba(241, 12, 69, 1) 0%, rgba(165, 0, 128, 1) 100%);
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
                {{-- <?php $regencies = Regency::get(); ?> --}}
                <li><a href="" class="text-white"></a></li>
        
            </ul>
        </div>

        <div class="col-12 mt-1">
            <div class="card">
                <div class="card-body" style="position: relative">
                    <img src="{{ asset('') }}assets/icons/hisuara_new.png"
                        style="position: absolute; top: 25px; left: 25px; width: 100px" alt="">
                    <div class="row">
                        <div class="col-xxl-6">
                            <div class="container">
                                <div class="text-center fs-3 mb-3 fw-bold">Suara Masuk</div>
                                <div class="text-center">Progress {{ substr($realcount, 0, 5) }}% dari 100%</div>
                                <div class="text-center mt-2 mb-2"><span class="badge bg-success">{{ $total_incoming_vote }}
                                        /
                                        {{ $dpt }}</span></div>
                                <div id="chart-pie" class="chartsh h-100 w-100"></div>
                            </div>
                            <div class="row mt-2">
                                <?php $i = 1; ?>
                                @foreach ($paslon as $pas)
                                    <div class="col-lg col-md col-sm col-xl mb-3">
                                        <div class="card" style="margin-bottom: 0px;">
                                            <div class="card-body p-3">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="mx-auto counter-icon box-shadow-secondary brround candidate-name text-white "
                                                            style="margin-bottom: 0; background-color: {{ $pas->color }};position:relative; overflow: hidden">
                                                            <img style="bottom: -10px; position: absolute; left: 50%; transform: translateX(-50%);"
                                                                src="{{ asset('') }}storage/{{ $pas->picture }}" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="col text-center">
                                                        <h6 class="mt-4">{{$pas->candidate}} - {{$pas->deputy_candidate}}</h6>
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

                        <div class="col-xxl-6">
                            <div class="text-center title-atas-table fs-5 mb-0 fw-bold">Hasil Perhitungan Suara</div>
                            <div class="text-center title-atas-table fs-5 mb-0 fw-bold">Pemilihan Presiden dan Wakil
                                Presiden</div>
                            <div class="text-center title-atas-table fs-5 fw-bold">Tingkat Provinsi</div>
                            <div class="row mx-auto" style="width: 884.5px;">

                            </div>
                            <div style="overflow-y:auto;height:500px">
                                <table class="table table-bordered table-hover mt-3">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th class="text-white text-center align-middle">KECAMATAN</th>
                                            @foreach ($paslon as $item)
                                                <th class="text-white text-center align-middle"
                                                    style="background: {{ $item->color }}; position:relative">
                                                    <img style="width: 60px; position: absolute; left: 0; bottom: 0"
                                                        src="{{ asset('') }}storage/{{ $item->picture }}"
                                                        alt="">
                                                    <div class="ms-7">
                                                        {{ $item['candidate'] }} - <br>
                                                        {{ $item['deputy_candidate'] }}
                                                    </div>
                                                </th>
                                            @endforeach
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($regencies as $item)
                                            @php
                                                $regDom = RegenciesDomain::where('regency_id', $item->id)->first();
                                            @endphp
                                            <tr>
                                                <td class="align-middle">
                                                    <a
                                                        href="{{ env('HTTP_SSL') . $regDom->domain . env('HTTP_PORT', '') }}/administrator/index">{{ $item['name'] }}</a>
                                                </td>
                                                <?php $i = 1; ?>
                                                @foreach ($paslon as $cd)
                                                    <td class="align-middle text-end">{{ $item->{'suara' . $i} }}</td>
                                                    @php
                                                        $i++;
                                                    @endphp
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>


                                </table>
                            </div>
                        </div>

                    </div>
                </div>


            </div>

            <div class="col-12 mt-5" style="">
                <div class="row">
                    <div class="col-12 text-center pt-2">
                        <img src="{{asset('assets/imagesProvinsi/'. $provinsi_ini->logo_provinsi)}}" alt="">
                    </div>
                    <div class="col-12 text-black p-2 fs-5 fw-bold text-center">
                        PERHITUNGAN TINGKAT KABUPATEN / KOTA <br>
                        PROVINSI {{$provinsi_ini->name}}
                    </div>
                </div>
            </div>

            <div class="col-12 mb-2">
                <div class="row my-3" style="flex-wrap: nowrap; overflow-x: scroll">
                    @foreach ($regencies as $item)
                    <div class="col-auto my-2">
                        <div class="text-center mb-2">
                            <img src="{{asset('assets/imagesKota/'. $item->logo_kota)}}" alt="">
                        </div>
                        <div class="text-center">
                            {{$item->name}}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="col-12">
                <div class="row">
                    @foreach ($regencies as $item)
                        <div class="col-3">
                            <div class="card">
                                @php
                                    $regDom = RegenciesDomain::where('regency_id', $item->id)->first();
                                @endphp
                                <div class="card-header text-white" style="background: linear-gradient(90deg, rgba(39,109,231,1) 0%, rgba(119,42,220,1) 100%);">
                                    <div class="card-title mx-auto">
                                        <a
                                            href="{{ env('HTTP_SSL') . $regDom->domain . env('HTTP_PORT', '') }}/administrator/index">{{ $item['name'] }}
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="charture-{{ $item['id'] }}" class="chartsh h-100 w-100"></div>
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
 