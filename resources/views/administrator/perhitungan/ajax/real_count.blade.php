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

<style>
    /* Custom CSS to change the hover color of legend items */
    .c3-legend-item:hover text {
        fill: red !important;
        /* Change 'red' to your desired hover color */
    }
</style>

<div class="row">
    <div class="{{($config->otonom == 'yes')?'col-6':'col-12'}}">
        <div class="row">
            <div class="col-12">
                <div class="container">
                    <div class="text-center fs-3 mb-3 fw-bold">REAL COUNT</div>
                    <div class="text-center">Progress {{substr($realcount,0,5)}}% dari 100%</div>
                    <div class="text-center mt-2 mb-2"><span class="badge bg-success">{{$total_incoming_vote}} /
                            {{$dpt}}</span></div>
                    {{-- <div class="chart-teks">
                        Prabowo
                    </div> --}}
                    <div id="chart-realcount-ajax" class="chartsh h-100 w-100">
                    </div>
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
                                        <div class="mx-auto counter-icon box-shadow-secondary brround candidate-name text-white "
                                            style="margin-bottom: 0; background-color: {{$pas->color}};">
                                            {{$i++}}
                                        </div>
                                    </div>
                                    <div class="col text-center">
                                        <h6 class="mt-4">{{$pas->candidate}} </h6>
                                        <h6 class="">{{$pas->deputy_candidate}} </h6>
                                        @if (isset($url_first[3]))
                                            @php
                                            $data['url_id'] = Crypt::decrypt($url_first[3]);
                                            $id = $data['url_id'];
                                            @endphp
                                        @endif
                                        
                                        @if (isset($url_first[3]) && $url_first[2] == "perhitungan_kecamatan") {{-- Perhitungan Kecamatan --}}
                                            @php
                                            $total_saksi = SaksiData::where('regency_id',$config->regencies_id)->where('paslon_id',$pas->id)->where('district_id', (string)$id)->sum('voice');
                                            @endphp
                                        @elseif (isset($url_first[3]) && $url_first[2] == "perhitungan_kelurahan") {{-- Perhitungan Kelurahan --}}
                                            @php
                                            $total_saksi = SaksiData::where('regency_id',$config->regencies_id)->where('paslon_id',$pas->id)->where('village_id', (string)$id)->sum('voice');
                                            @endphp
                                        @else {{--  Perhitungan Kota --}}
                                            @php
                                            $total_saksi = SaksiData::where('regency_id',$config->regencies_id)->where('paslon_id',$pas->id)->sum('voice');
                                            @endphp
                                        @endif
                                        {{-- {{$url_first}} --}}
                                        <h3 class="mb-2 number-font">{{ $total_saksi }} suara</h3>
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
    @if (isset($url_first[3]) && $url_first[2] == "perhitungan_kecamatan")
    <div class="{{($config->otonom == 'yes')?'col-6':'col-12'}}">
        <table class="table table-bordered table-hover mb-0 {{($config->otonom == 'yes')?'h-100':''}}">
            <thead class="bg-primary">
                <tr>
                    <th class="text-white text-center align-middle">KELURAHAN</th>
                    @foreach ($paslon as $item)
                    <th class="text-white text-center align-middle"
                        style="background: {{$item->color}}; position:relative">
                        <img style="width: 60px; position: absolute; left: 0; bottom: 0"
                            src="{{asset('')}}storage/{{$item->picture}}" alt="">
                        <div class="ms-7">
                            {{ $item['candidate']}} - <br>
                            {{ $item['deputy_candidate']}}
                        </div>
                    </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($kel as $item)
                <tr onclick='check("{{Crypt::encrypt($item->id)}}")'>
                    <td class="align-middle"><a
                            href="{{url('/')}}/administrator/perhitungan_kelurahan/{{Crypt::encrypt($item['id'])}}">{{$item['name']}}</a>
                    </td>
                    @foreach ($paslon as $cd)
                    <?php $saksi_dataa = SaksiData::join('saksi', 'saksi.id', '=', 'saksi_data.saksi_id')->where('paslon_id', $cd['id'])->where('saksi_data.village_id', (string)$item['id'])->sum('voice'); ?>
                    <td class="align-middle text-end">{{$saksi_dataa}}</td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
            <script>
                let check = function(id) {
                            window.location = `{{url('/')}}/administrator/perhitungan_kelurahan/${id}`;
                        }
            </script>
        </table>
    </div>
    @elseif (isset($url_first[3]) && $url_first[2] == "perhitungan_kelurahan")
    @else
    <div class="{{($config->otonom == 'yes')?'col-6':'col-12'}}">
        <table class="table table-bordered table-hover mb-0 {{($config->otonom == 'yes')?'h-100':''}}">
            <thead class="bg-primary">
                <tr>
                    <th class="text-white text-center align-middle">KECAMATAN</th>
                    @foreach ($paslon as $item)
                    <th class="text-white text-center align-middle" style="background: {{$item->color}}; position:relative">
                        <img style="width: 60px; position: absolute; left: 0; bottom: 0"
                            src="{{asset('')}}storage/{{$item->picture}}" alt="">
                        <div class="ms-7">
                            {{ $item['candidate']}} - <br>
                            {{ $item['deputy_candidate']}}
                        </div>
                    </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($kec as $item)
                <tr onclick='check("{{Crypt::encrypt($item->id)}}")'>
                    <td class="align-middle"><a
                            href="{{url('/')}}/administrator/perhitungan_kecamatan/{{Crypt::encrypt($item['id'])}}">{{$item['name']}}</a>
                    </td>
                    @foreach ($paslon as $cd)
                    <?php $saksi_dataa = SaksiData::where('regency_id',$config->regencies_id)->where('paslon_id', $cd['id'])->where('saksi_data.district_id', $item['id'])->sum('voice'); ?>
                    <td class="align-middle text-end">{{$saksi_dataa}}</td>
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
    @endif
</div>

        
<script>
$(document).ready(function() {
    setTimeout(() => {
        
        var chartmode1 = c3.generate({
            bindto: '#chart-realcount-ajax', // id of chart wrapper
            data: {
                columns: [
                    // each columns data
            
                    <?php foreach ($paslon as $pas) :  ?>
                        <?php $voice = 0;  ?>
                        <?php foreach ($pas->saksi_data as $pak) :  ?>
                            <?php
                            $voice += $pak->voice;
                            ?>
                        <?php endforeach  ?>['data<?= $pas->id  ?>', <?= $voice ?>],
                    <?php endforeach  ?>
                ],
                type: 'pie', // default type of chart
                colors: {
                    <?php foreach ($paslon as $pas) :  ?> 'data<?= $pas->id  ?>': "<?= $pas->color ?>",
                    <?php endforeach  ?>
                },
                names: {
                    // name of each serie
                    <?php foreach ($paslon as $pas) :  ?> 'data<?= $pas->id  ?>': " <?= $pas->candidate ?> - <?= $pas->deputy_candidate ?>",
                    <?php endforeach  ?>
                }
            },
            axis: {},
            legend: {
                show: true, //hide legend
            },
            padding: {
                bottom: 0,
                top: 0
            },
        });
        
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
    }, 1000);
})

    
</script>