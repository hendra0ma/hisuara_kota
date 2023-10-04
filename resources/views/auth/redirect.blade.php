

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Zanex – Bootstrap  Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords" content="admin, dashboard, dashboard ui, admin dashboard template, admin panel dashboard, admin panel html, admin panel html template, admin panel template, admin ui templates, administrative templates, best admin dashboard, best admin templates, bootstrap 4 admin template, bootstrap admin dashboard, bootstrap admin panel, html css admin templates, html5 admin template, premium bootstrap templates, responsive admin template, template admin bootstrap 4, themeforest html">
    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/images/brand/favicon.ico" />
    <!-- TITLE -->
    <title>Rekapitung</title>

    <!-- BOOTSTRAP CSS -->
    <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="../../assets/css/style.css" rel="stylesheet" />
    <link href="../../assets/css/dark-style.css" rel="stylesheet" />
    <link href="../../assets/css/skin-modes.css" rel="stylesheet" />

    <!-- SIDE-MENU CSS -->
    <link href="../../assets/css/sidemenu.css" rel="stylesheet" id="sidemenu-theme">

    <!--C3 CHARTS CSS -->
    <link href="../../assets/plugins/charts-c3/c3-chart.css" rel="stylesheet" />

    <!-- P-scroll bar css-->
    <link href="../../assets/plugins/p-scroll/perfect-scrollbar.css" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="../../assets/css/icons.css" rel="stylesheet" />

    <!-- SIDEBAR CSS -->
    <link href="../../assets/plugins/sidebar/sidebar.css" rel="stylesheet">

    <!-- SELECT2 CSS -->
    <link href="../../assets/plugins/select2/select2.min.css" rel="stylesheet" />

    <!-- DATA TABLE CSS -->
    <link href="../../assets/plugins/datatable/css/dataTables.bootstrap5.css" rel="stylesheet" />
    <link href="../../assets/plugins/datatable/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link href="../../assets/plugins/datatable/responsive.bootstrap5.css" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="../../assets/colors/color1.css" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />

    <link href="../../assets/plugins/sweet-alert/sweetalert.css" rel="stylesheet" />
    <!-- INTERNAL Notifications  Css -->
    <link href="../../assets/plugins/notify/css/jquery.growl.css" rel="stylesheet" />
    <link href="../../assets/plugins/notify/css/notifIt.css" rel="stylesheet" />
<x-guest-layout>
<div id="global-loader">
    <img src="https://paslon1.tangsel.pilwalkot.rekapitung.id/assets/images/loader.svg" class="loader-img" alt="Loader">
</div>
   
    <br>


    {{-- Kecamatan --}}
    {{-- kelurahan --}}
    <script>
      $(document).ready(function() {
        setTimeout(function() {
          @if(auth() -> user() -> role_id == 1)
              @if(Cookie::get("commander"))
              window.location.href = "{{route('superadmin.commander-index')}}";
              @else
              window.location.href = "{{route('superadmin.index')}}";
              @endif
          @elseif(auth() -> user() -> role_id == 2)
          window.location.href = "{{route('verifikator.index')}}"
          @elseif(auth() -> user() -> role_id == 3)
          window.location.href = "{{route('auditor.index')}}"
          @elseif(auth() -> user() -> role_id == 20)
          window.location.href = "{{route('huver.index')}}"
          @elseif(auth() -> user() -> role_id == 9)
          window.location.href = "{{route('rekapitulator.index')}}"
          @elseif(auth() -> user() -> role_id == 5)
          window.location.href = "{{route('checking.index')}}"
          @elseif(auth() -> user() -> role_id == 6)
          window.location.href = "{{route('hunter.index')}}"
          @elseif(auth() -> user() -> role_id == 8)
          window.location.href = "{{url('upload_c1')}}"
          @elseif(auth() -> user() -> role_id == 7)
          window.location.href = "{{route('hukum.index')}}"
          @elseif(auth() -> user() -> role_id == 10)
          window.location.href = "{{route('validator_hukum.index')}}"
          @elseif(auth() -> user() -> role_id == 11)
          window.location.href = "{{route('banwaslu.index')}}"
          @elseif(auth() -> user() -> role_id == 12)
          window.location.href = "{{route('payrole.index')}}"
          @endif
        }, 7000);
        getLocation();
        showPosition();
      });
    </script>
    <script>
        function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
      }
    }
    
    function showPosition(position) {
        // document.getElementById("latitude").value = position.coords.latitude;
        // document.getElementById("longitude").value = position.coords.longitude;
        let long =  position.coords.longitude;
        let lat = position.coords.latitude;
        $.ajax({
                    url: '{{url("/")}}/login/tracking',
                    type: "GET",
                    data: {
                      long,
                      lat,
                    },
                    success: function (response) {
                        if (response) {
                            $('#container-verifikasi').html(response);
                        }
                    }
                });
  
    }
    </script>
    <script>
      var timeleft = 0;
      var downloadTimer = setInterval(function() {
        if (timeleft <= 0) {
          clearInterval(downloadTimer);
          document.getElementById("countdown").innerHTML = "Please Wait..";
        } else {
          document.getElementById("countdown").innerHTML = timeleft + " Detik";
        }
        timeleft -= 1;
      }, 1000);
    </script>

</x-guest-layout>