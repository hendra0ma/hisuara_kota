<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Not Setup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        body {
            background-color: #232323;
        }

        .glitch {
            font-size: 8.125em;
            font-family: 'Raleway', sans-serif !important;
            font-weight: 700 !important;
            text-decoration: none !important;
            text-transform: uppercase;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            margin: 0;
            color: #fff;
            letter-spacing: 5px !important;
        }

        .glitch:before,
        .glitch:after {
            display: block;
            content: attr(data-glitch);
            text-transform: uppercase;
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            opacity: 0.8;
        }

        .glitch:after {
            color: #f0f;
            z-index: -2;
        }

        .glitch:before {
            color: #0ff;
            z-index: -1;
        }

        .glitch:hover:before {
            animation: glitch 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94) both 5;
      
        }

        .glitch:hover:after {
            animation: glitch 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94) reverse both 5;
       
        }

        @media only screen and (max-width: 400px) {
            .glitch {
                font-size: 3em;
            }
        }

        @keyframes glitch {
            0% {
                transform: translate(0);
            }

            20% {
                transform: translate(-5px, 5px);
            }

            40% {
                transform: translate(-5px, -5px);
            }

            60% {
                transform: translate(5px, 5px);
            }

            80% {
                transform: translate(5px, -5px);
            }

            to {
                transform: translate(0);
            }
        }

    </style>
</head>

<body class="bg-dark">


    <div class="container-fluid mt-3">
    <img src="{{asset('assets/images/brand/logo-1.png')}}" style="width:200px;height:auto; display: block;
            position: fixed;
            top: 250px;
            left: 87vh;">
    <a href="#" class="glitch text-white"style="font-size:60px !important" data-glitch="Website Belum Di Set Up">Website Belum Di Set Up</a>
                  
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
