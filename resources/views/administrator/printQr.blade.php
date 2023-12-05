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
        <div class="col-12 py-3 text-center" style="margin-top: 100px;">
            <img src="{{asset('assets/imagesKota/'. $kota->logo_kota)}}" alt="">
        </div>
        <div class="col-12 text-center">
            <h2>
                {{$kota->name }}
            </h2>
        </div>
        <div class="col-9 text-center py-3 mb-5 mt-3 mx-auto" style="border: 1px black solid">
        
            <h2 class="fw-bold mb-0 text-danger" style="font-size: 36px">
                BARKODE KECURANGAN PEMILU 2024
            </h2>
        
        </div>
        
        <div class="col-12 text-center mb-5" style="margin-top: 50px">
            <h3>JUMLAH DATA : {{$jumlah_qrcode}}</h3>
        </div>

        <div class="col-12 text-center mb-5" style="margin-top: 150px">
            <img src="{{asset('')}}assets/icons/hisuara_new.png" width="350px" alt="">
        </div>

        <div class="col-12 text-center" style="position: absolute; bottom: -50px">
            <h3>PILPRES 2024 {{ $kota->name }}</h3>
        </div>

    </div>

    <div class="row">
        <div>
            <h1 class="mt-2 mb-4 text-danger text-center text-uppercase fs-3 " style="font-size: 40px;">
                Barkode Kecurangan Pemilu 2024
            </h1>
        </div>

        <?php 
            $i = 1;
            $a = 1;
        ?>
        @foreach ($qrcode as $item)
        <?php $i++  ?>
        <div class="row py-2" style="border-bottom: 1px solid black; border-top: 1px solid black">
            <div class="col-12">
                <div class="row">
                    <div class="col-1 px-4 fs-4 d-flex">
                        <div class="my-auto">
                            {{$a++}}
                        </div>
                    </div>
                    <div class="px-0 col-auto text-center">
                        @if ($item['profile_photo_path'] == NULL)
                        <img style="width: 125px; height: 125px; object-fit: cover; margin-right: 10px;"
                            src="https://ui-avatars.com/api/?name={{ $item['name'] }}&color=7F9CF5&background=EBF4FF">
                        @else
                        <img style="width: 125px; height: 125px; object-fit: cover; margin-right: 10px;" src="{{url("/storage/profile-photos/".$item['profile_photo_path']) }}">
                        @endif
                    </div>
                    <div class="px-0 col">
                        <div class="mb-0 fw-bold" style="font-size: 20px">{{ $item['name'] }}</div>
                        <div style="font-size: 20px">NIK : {{ $item['nik'] }}</div>
                        <div style="font-size: 20px">SAKSI TPS {{ $item['number'] }}</div>
                        <div style="font-size: 20px">KELURAHAN {{ $item['village_name'] }}</div>
                    </div>
                    <div class="px-0 col-auto my-auto">
                        <?php $scan_url = "" . url('') . "/scanning-secure/" . Crypt::encrypt($item->id) . ""; ?>
                        {!! QrCode::size(125)->generate( $scan_url); !!}
                    </div>
                </div>
            </div>
        </div>
        {{-- <hr style="border: 1px black solid"> --}}
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
