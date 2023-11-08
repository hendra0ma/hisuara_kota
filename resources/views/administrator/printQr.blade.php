<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Fraud Barcode Report</title>
    <style>
        .pages {
            position: relative;
            width: 100%;
            height: 100%;
            page-break-before: always;
            page-break-after: always;
            page-break-inside: avoid;
        }

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
               left: 75%;
            }
        }

    </style>
</head>

<body>


    <div class="asdf"
        style="position: relative;width:100%;height:700px;page-break-before: auto;page-break-after: always;page-break-inside: avoid;">
{{-- 
        <div class="col-12 text-center mb-3 mt-5">
            @if ($user['profile_photo_path'] == NULL)
            <img class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover; margin-right: 10px;"
                src="https://ui-avatars.com/api/?name={{ $user['name'] }}&color=7F9CF5&background=EBF4FF">
            @else
            <img class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover; margin-right: 10px;" src="{{url("/storage/profile-photos/".$user['profile_photo_path']) }}">
            @endif
        </div>
        <div class="col-12 my-auto text-center mb-5">
            <div class="mb-0 fw-bold" style="font-size: 30px">{{ $user['name'] }}</div>
            <div style="font-size: 20px">NIK : {{ $user['nik'] }}</div>
        </div> --}}
        <div class="col-12 py-3 text-center" style="margin-top: 300px;">
            <h1 class="fw-bold mb-0 text-danger" style="font-size: 36px">
                BARKODE KECURANGAN SAKSI
            </h1>
        </div>
        <div class="col-9 text-center py-3 mb-5 mx-auto" style="border: 1px black solid">
        
            <h2>
                {{$kota->name }}<br>
                {{-- Kec
                {{$kecamatan->name}} / Kel
                {{$kelurahan->name}} <br> --}}
            </h2>
            {{-- <h2 class="text-danger" style="font-size:40px">TPS {{ $tps->number }} <br></h2> --}}
        
        </div>
        
        <div class="col-12 text-center mb-5 mt-5">
            <img src="{{asset('')}}assets/icons/hisuara_new.png" width="350px" alt="">
        </div>
        
        {{-- <div class="col-12 text-center" style="position: absolute; bottom: -90px">
            <h3>PILPRES 2024 {{$kota->name }}</h3>
        </div> --}}

        {{-- <div class="row">
            <div class="col-12 mt-5">
                <center>
                    <h1 class="mt-2 text-danger text-uppercase" style="font-size: 40px;">Barkode Kecurangan
                    </h1>

                    <img src="{{asset('')}}assets/icons/hisuara_new.png" width="350px" alt="">

                <center>
            </div>
        </div>
        <hr>

        <div class="row justify-content-center border border-dark border-3" style="align-items:center;margin-top:75px">
            <div class="col-6 text-center mt-2 mb-2">
                <img src="{{url('')}}/storage/{{$config->regencies_logo}}" alt="" class="img-fluid"
                    style="height: 150px;">
            </div>

            <div class="col-6 mt-2 mb-2">
                <h3 class="text-right">
                    {{$kota->name }}
                </h3>
            </div>
        </div>
        <div class="row">

            <div class="col-12">

                <center>
                    <h3 class="fixed-bottom text-uppercase">
                        {{$config['jenis_pemilu']}}  {{$config['tahun']}} {{$kota->name }}
                    </h3> 
                </center>
            </div>
        </div> --}}

    </div>

    <div class="row">
        <div>
            <h1 class="mt-2 mb-4 text-danger text-center text-uppercase fs-3 " style="font-size: 40px;">
                Barkode Kecurangan
            </h1>
        </div>

        <?php $i  = 1;  ?>
        @foreach ($qrcode as $item)
        <?php $i++  ?>
        <div class="px-0 col-3 my-auto">
            <?php $scan_url = "" . url('') . "/scanning-secure/" . Crypt::encrypt($item->id) . ""; ?>
            {!! QrCode::size(125)->generate( $scan_url); !!}
        </div>
        <div class="px-0 col-3 text-center mb-3">
            @if ($item['profile_photo_path'] == NULL)
            <img style="width: 175px; height: 175px; object-fit: cover; margin-right: 10px;"
                src="https://ui-avatars.com/api/?name={{ $item['name'] }}&color=7F9CF5&background=EBF4FF">
            @else
            <img style="width: 175px; height: 175px; object-fit: cover; margin-right: 10px;" src="{{url("/storage/profile-photos/".$item['profile_photo_path']) }}">
            @endif
        </div>
        <div class="px-0 col-6 my-auto text-center">
            <div class="mb-0 fw-bold" style="font-size: 30px">{{ $item['name'] }}</div>
            <div style="font-size: 20px">NIK : {{ $item['nik'] }}</div>
            <div style="font-size: 20px">SAKSI TPS {{ $item['number'] }}</div>
            <div style="font-size: 20px">KELURAHAN {{ $item['village_name'] }}</div>
        </div>
        {{-- @if($i % 9 == 0)
        <div class="pages"></div>
        @endif --}}
        @endforeach
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
        // setTimeout(function() {
        window.print();
        window.onafterprint = back;

        function back() {
            window.close()
        }



        // },300)

    </script>
</body>

</html>
