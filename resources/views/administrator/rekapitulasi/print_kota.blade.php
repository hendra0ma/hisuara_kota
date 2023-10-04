<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Komparasi KPU</title>
    <style>
         @media screen {
            div.divFooter {
                display: none;
            }
            body {
                display: none;
            }
        }
        @media print {
            div.divFooter {
                position: fixed;
                bottom: 0;
            }
            .stamp {
            position: fixed;
               top: 70%;
               bottom: 75%;
               left: 80%;
            }
        }
    </style>
</head>

<body>

    <?php

use App\Models\Saksi;
use App\Models\SaksiData;
use App\Models\Rekapitulator;
?>

    <div class="row mt-3" id="pdf">
        <div class="col-lg-10">
        <img src="{{asset('')}}assets/stamp.png"class="img-flluid stamp"style="width:150px;height:auto" alt="">
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <center>
                <h2 class="mt-2 text-danger text-uppercase" style="font-size: 40px;">Hasil Komparasi Perhitungan <br />
                    Rekapitung vs KPU
                </h2>
                <img style="width: 350px; height: auto; margin-top:75px"
                    src="{{asset('')}}images/logo/rekapitung_gold.png" alt="">
                    <h3 class="fs-2 text-uppercase mt-3">
                        {{$config['jenis_pemilu']}}  {{$config['tahun']}} {{$kotas->name}}
                    </h3>
            </center>
        </div>
    </div>
    <div style="break-after: page;"></div>


    <div class="row w-100">
        <div class="col-md-12 text-center">
            <h5><img style="width: 120px;" src="{{url('/')}}/assets/images/brand/logo_gold.png" alt=""></h5>
        </div>
        <div class="col-md-12 mt-2">
            <h5 class="card-title mx-auto">
                <center>
                    Hasil Rekapitulasi Rekapitung
                </center>
            </h5>
        </div>
    </div>
    <table class="table table-bordered table-hover">
        <thead class="bg-primary">
            <tr>
                <th class="text-center text-dark fw-bold">
                    Kecamatan
                </th>
                <th class="text-center text-dark fw-bold">
                    Suara Masuk (%)
                </th>

                @foreach ($paslon as $item)
                <th class="text-center text-dark fw-bold">
                    {{ $item['candidate']}} - <br>
                    {{ $item['deputy_candidate']}}
                </th>
                @endforeach

            </tr>
        </thead>
        @foreach ($kecamatan as $item)
        <?php
                        $saksi = App\Models\Saksi::where('district_id', $item['id'])->get();
                        $tps = App\Models\Tps::where('district_id',$item['id'])->count();
                        ?>
        <tr>
            <td>
                {{$item['name']}}
            </td>
            <td>
                <?php
                                if (count($saksi) == 0) {
                                    echo '0';
                                }else{
                                    $persen = count($saksi) /  $tps * 100;
                                    echo floor($persen);
                                } 
                            ?>%
            </td>
            @foreach ($paslon as $suar)
            <?php $saksi_data = App\Models\SaksiData::where('paslon_id', $suar['id'])->where('district_id', $item['id'])->sum('voice'); ?>
            <td>
                @if ($saksi_data == NULL)
                Belum ada data
                @else
                {{$saksi_data}}
                @endif
            </td>
            @endforeach

        </tr>
        @endforeach

    </table>

    <div style="break-after: page;"></div>




    <div class="row w-100">
        <div class="col-md-12 text-center">
            <h5><img style="width: 100px;"
                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/46/KPU_Logo.svg/925px-KPU_Logo.svg.png"
                    alt=""></h5>
        </div>
        <div class="col-md-12 mt-2">
            <h5 class="card-title mx-auto">
                <center>
                    Hasil Rekapitulasi KPU
                </center>
            </h5>
        </div>

    </div>

    <table class="table table-bordered table-hover">
        <thead class="bg-primary">
            <tr>
                <th class="text-center text-dark fw-bold">
                    Kelurahan
                </th>
                <th class="text-center text-dark fw-bold">
                    Suara Masuk (%)
                </th>
                @foreach ($paslon as $suar)
                <th class="text-center text-dark fw-bold">
                    {{$suar['candidate']}} - <br>
                    {{$suar['deputy_candidate']}}
                </th>
                @endforeach

            </tr>
        </thead>
        @foreach ($kecamatan as $kelurahan)
        <?php $rekapitulator = App\Models\Rekapitulator::where('district_id', $kelurahan['id'])->where('regency_id',$kelurahan['regency_id'])->get() ?>
        <tr>
            <td>
                {{$kelurahan['name']}}
            </td>
            <td>
                <?php
                             if (count($saksi) == 0) {
                                    echo '0';
                                }else{
                                    $persen = count($rekapitulator) /  $tps * 100;
                                   echo floor($persen);
                                } 
                           ?>


            </td>
         
             

                @foreach ($rekapitulator as $item)
                <td>{{$item['value']}}</td>
                @endforeach

      
        </tr>
        @endforeach
    </table>
    <div style="break-after: page;"></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->



    <script>
        var css = '@page { size: landscape; }',
            head = document.head || document.getElementsByTagName('head')[0],
            style = document.createElement('style');

        style.type = 'text/css';
        style.media = 'print';

        if (style.styleSheet) {
            style.styleSheet.cssText = css;
        } else {
            style.appendChild(document.createTextNode(css));
        }

        head.appendChild(style);

        window.print();
        window.onafterprint = back;

function back() {
    window.close()
}

    </script>
</body>

</html>
