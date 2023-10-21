<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <style>
    html,
    body {
      height: 100%;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .centered-content {
      text-align: center;
    }
  </style>
</head>

<body>


  <!-- <form action="{{route('login')}}" method="post" style="display:none">
    @csrf
 
    <input type="hidden" id="latitude" name="latitude">
    <input type="hidden" id="longitude" name="longitude">
  </form> -->
  <div class="centered-content">
    <h4>
      <div class="spinner-border" role="status" style="width: 4rem; height: 4rem;">
      </div> <br>
      Sedang Login. Mohon Tunggu
    </h4>
  </div>


  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script>
    // var x = document.getElementById("demo");
    $(window).on('load', function() {
      getLocation()

    });

    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else {
        $('body').html(`
          <h1>
              anda harus konfirmasi lokasi untuk melanjutkan
          </h1>`)
      }
    }
    var long = "";
    var la = "";

    function showPosition(position) {
     la = position.coords.latitude;
      long = position.coords.longitude;

      $.ajax({
      url : "{{route('login')}}",
      data: {
        "_token": "{{ csrf_token() }}",
        "email" : atob("{{$email}}"),
        "password" : atob("{{$password}}"),
        "longitude": long,
        "latitude": la,
      },
      success:function(res){
      window.location.href = "{{url('redirect')}}"
      }
    })
    }
 


    
  </script>
</body>

</html>