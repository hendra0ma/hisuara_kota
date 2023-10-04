<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Lockdown Sistem</title>
  </head>
  <body class="bg-dark">
  <div class="container mt-3">
    <div class="row justify-content-center"style="align-items: center;  display: flex;height:1000px">
        <div class="col-lg-7">
            <div class="card bg-danger text-light"style="height:250px">
                <div class="card-header">
                    <h2 class="fw-bold text-center">
                        Lockdown
                    </h2>
                </div>
                <div class="card-body"style="align-items: center;  display: flex;height:100%">
                    <div class="alert alert-danger justify-content-center">
                        <p  class="fw-bold text-center">
                            Sistem telah di lockdown oleh Administrator. dan semua kegiatan admin telah di berhentikan.
                        </p>
                        <p  class="fw-bold text-center">
                            Anda akan ke redirect dalam <span id="hitung">5</span>
                        </p>

                    </div>

                </div>
            </div>
        </div>
    </div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


    <script>
        let detik = parseInt(document.querySelector('span#hitung').innerHTML);
        setTimeout(function(){
            window.location.href = "{{url('')}}/index";
        },detik * 1000);
        setInterval(function(){
            document.querySelector('span#hitung').innerHTML = detik;
            detik --
            
        },1000);
    </script>


  </body>
</html>