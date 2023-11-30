<?php

use App\Models\Config;
use App\Models\Configs;
use App\Models\District;
use App\Models\RegenciesDomain;
use App\Models\Regency;
use App\Models\SaksiData;
use App\Models\QuickSaksiData;
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



$regency = District::where('regency_id', $config->regencies_id)->get();
$kota = Regency::where('id', $config->regencies_id)->first();
$dpt = District::where('regency_id', $config->regencies_id)->sum('dpt');
$tps = Tps::count();
?>

<div class="row">
    <div class="col-6 d-flex">
        <div class="container my-auto">
            {{-- <div class="text-center fs-3 mb-3 fw-bold">QUICK COUNT</div>
            <div class="text-center">Progress {{substr($realcount,0,5)}}% dari 100%</div>
            <div class="text-center mt-2 mb-2"><span class="badge bg-success">{{$total_incoming_vote}} /
                    {{$dpt}}</span></div> --}}
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="alert alert-danger my-5 text-center">
                        <h3 class="fw-bold">Halaman Quick Count Kabupaten Kota dialihkan ke Quick Count Nasional</h3>
                        <a href="{{route('quickcount_pusat.quick_count_nasional')}}" class="btn btn-dark">Redirect</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="row mt-2">
            <?php $i = 1; ?>
            @foreach ($paslon as $pas)
            <div class="col-lg-12 mb-3">
                <div class="card" style="margin-bottom: 0px;">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-6 d-flex">
                                <div class="mx-auto my-auto counter-icon box-shadow-secondary brround candidate-name text-white "
                                    style="margin-bottom: 0; background-color: {{ $pas->color }}; overflow: hidden; position:relative">
                                    <img style="bottom: -10px; position: absolute; left: 50%; transform: translateX(-50%)" src="{{ asset('') }}storage/{{ $pas->picture }}" alt="">
                                </div>
                            </div>
                            <div class="col text-center">
                                <h6 class="mt-4">{{$pas->candidate}} - {{$pas->deputy_candidate}}</h6>
                                @if (isset($url_first[3]))
                                    @php
                                    $data['url_id'] = Crypt::decrypt($url_first[3]);
                                    $id = $data['url_id'];
                                    @endphp
                                @endif
                                
                                @if (isset($url_first[3]) && $url_first[2] == "perhitungan_kecamatan") {{-- Perhitungan Kecamatan --}}
                                    @php
                                    $total_saksi = QuickSaksiData::join('quick_saksi', 'quick_saksi.id', '=', 'quick_saksi_data.saksi_id')->where('paslon_id', $pas->id)->where('quick_saksi_data.district_id', (string)$id)->where('quick_saksi.verification', 1)->sum('voice');
                                    @endphp
                                @elseif (isset($url_first[3]) && $url_first[2] == "perhitungan_kelurahan") {{-- Perhitungan Kelurahan --}}
                                @php
                                    $total_saksi = QuickSaksiData::join('quick_saksi', 'quick_saksi.id', '=', 'quick_saksi_data.saksi_id')->where('paslon_id', $pas->id)->where('quick_saksi_data.village_id', (string)$id)->where('quick_saksi.verification', 1)->sum('voice');
                                    @endphp
                                @else {{--  Perhitungan Kota --}}
                                    @php
                                    $total_saksi = QuickSaksiData::where('regency_id',$config->regencies_id)->where('paslon_id',$pas->id)->sum('voice');
                                    @endphp
                                @endif
                                <h3 class="mb-2 number-font">{{ $total_saksi }} <br>suara</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
{{-- <table class="table table-bordered table-hover mb-0">
    <thead class="bg-primary">
        <tr>
            <th class="text-white text-center align-middle">Kecamatan</th>
            <th class="text-white text-center align-middle">Jumlah <br> TPS Quick Count</th>
            <th class="text-white text-center align-middle">Quick <br> Count</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($district_quick as $item)
        <?php $count_tps = Tps::where('district_id', (string)$item['id'])->count(); ?>
        <?php $count_tps_quick = Tps::where('district_id', (string)$item['id'])->where('quick_count', 1)->count(); ?>
        <?php $kecc = District::where('id', $item['district_id'])->first(); ?>
        <tr @if ( $count_tps_quick> 0)
            style="background-color: rgb(80,78, 78); color :white;" @else @endif>
            <td class="align-middle text">
                <a
                    href="{{url('/')}}/administrator/perhitungan_kecamatan/{{Crypt::encrypt($item['id'])}}">{{$item['name']}}</a>
            </td>
            <td class="align-middle">{{$count_tps}}</td>
            <td class="align-middle">@if ( $count_tps_quick > 0)
                {{$count_tps_quick}}
                @else
                0
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table> --}}

<script>
$(document).ready(function() {
    setTimeout(() => {

        /*chart-pie*/
        var chart = c3.generate({
            bindto: '#chart-quick-count', // id of chart wrapper
            data: {
                columns: [
                    // each columns data

                    <?php foreach ($paslon as $pas) :  ?>
                        <?php $voice = 0;  ?>
                        <?php foreach ($pas->quicksaksidata as $pak) :  ?>
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