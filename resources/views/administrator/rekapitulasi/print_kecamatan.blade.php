<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Komparasi KPU</title>
  </head>
  <body>
   
   <?php

use App\Models\Saksi;
use App\Models\SaksiData;
use App\Models\Rekapitulator;
?>

<div class="row mt-3" id="pdf">
    <div class="col-lg-10">
      
    </div>
</div>

       
           <div class="row">
                <div class="col-12">
                    <center>
                        <h2 class="mt-2 text-danger text-uppercase" style="font-size: 40px;">Hasil Komparasi Perhitungan <br />
                            Rekapitung vs KPU
                        </h2>
                        <h3> {{$data_kota->name}}, KECAMATAN {{$data_kec->name}}.</h3>
        
                        <img style="width: 350px; height: auto; margin-top:75px"
                            src="{{url('')}}/images/logo/rekapitung_gold.png" alt="">
        
                    <center>
                </div>
            </div>
       <div style="break-after: page;"></div>
    
       
                <div class="row w-100">
                    <div class="col-md-12 text-center">
                        <h5><img style="width: 145px;" src="{{url('/')}}/assets/images/brand/logo_gold.png" alt=""></h5>
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
                    <thead >
                        <tr>
                            <th class="text-center align-middle">
                                Kelurahan
                            </th>
                            <th class="text-center align-middle">
                                Suara Masuk (%)
                            </th>
                            @foreach ($suara as $suar)
                            <th class="text-center align-middle">
                                {{$suar['candidate']}} - <br>
                                {{$suar['deputy_candidate']}}
                            </th>
                            @endforeach
                          
                        </tr>
                    </thead>

                    @foreach ($kecamatan as $item)
                    <?php $saksi  = Saksi::where('village_id', $item['id'])->get(); ?>
                    <?php $persen = count($saksi)  /   $item['tps'] * 100;
                    ?>
                    <tr>
                        <td>
                            {{$item['name']}}
                        </td>
                        <td>
                            {{floor($persen)}}%
                        </td>
                        @foreach ($suara as $suar)
                        <?php $saksi_data = SaksiData::where('paslon_id', $suar['id'])->where('village_id', $item['id'])->sum('voice'); ?>
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
                        <h5><img style="width: 100px;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/46/KPU_Logo.svg/925px-KPU_Logo.svg.png" alt=""></h5>
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
                    <thead >
                        <tr>
                            <th class="text-center  align-middle">
                                Kelurahan
                            </th>
                            <th class="text-center align-middle">
                                Suara Masuk (%)
                            </th>
                            @foreach ($suara as $suar)
                            <th class="text-center align-middle">
                                {{$suar['candidate']}} - <br>
                                {{$suar['deputy_candidate']}}
                            </th>
                            @endforeach
                         
                        </tr>
                    </thead>
                    @foreach ($kecamatan as $kelurahan)
                    <?php $rekapitulator = Rekapitulator::where('village_id', (string)$kelurahan['id'])->get() ?>
                    <tr>
                        <td>
                            {{$kelurahan['name']}}
                        </td>
                        <td>
                            {{floor($persen)}}%
                        </td>
                        <form action="action_rekapitulator/{{Crypt::encrypt($kelurahan['id'])}}" method="post">
                            @csrf
                            <input class="form-control" type="hidden" name="id" value="{{$id}}">
                            @foreach ($rekapitulator as $item)
                            <td> <input class="form-control" type="text" name="{{$item['id']}}" value="{{$item['value']}}"></td>
                            @endforeach
                            <td>
                          
                            </td>
                        </form>

                    </tr>
                    @endforeach
                </table>
<div style="break-after: page;"></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

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

if (style.styleSheet){
  style.styleSheet.cssText = css;
} else {
  style.appendChild(document.createTextNode(css));
}

head.appendChild(style);

window.print();

   
</script>
  </body>
</html>


