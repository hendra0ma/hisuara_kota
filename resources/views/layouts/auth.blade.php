<!doctype html>
<html lang="en" dir="ltr">

<head>

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
  <title>Authentication</title>

  <!-- BOOTSTRAP CSS -->
  <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

  <!-- STYLE CSS -->
  <link href="../../assets/css/style.css" rel="stylesheet" />
  <link href="../../assets/css/dark-style.css" rel="stylesheet" />
  <link href="../../assets/css/skin-modes.css" rel="stylesheet" />

  <!-- SIDE-MENU CSS -->
  <link href="../../assets/css/sidemenu.css" rel="stylesheet" id="sidemenu-theme">

  <!-- SINGLE-PAGE CSS -->
  <link href="../../assets/plugins/single-page/css/main.css" rel="stylesheet" type="text/css">

  <!--C3 CHARTS CSS -->
  <link href="../../assets/plugins/charts-c3/c3-chart.css" rel="stylesheet" />

  <!-- P-scroll bar css-->
  <link href="../../assets/plugins/p-scroll/perfect-scrollbar.css" rel="stylesheet" />

  <!--- FONT-ICONS CSS -->
  <link href="../../assets/css/icons.css" rel="stylesheet" />

  <!-- COLOR SKIN CSS -->
  <link id="theme" rel="stylesheet" type="text/css" media="all" href="../../assets/colors/color1.css" />

  <!-- SELECT2 CSS -->
  <link href="../../assets/plugins/select2/select2.min.css" rel="stylesheet" />

  <!-- INTERNAL Sumoselect css-->
  <link rel="stylesheet" href="../../assets/plugins/sumoselect/sumoselect.css">

  <!-- MULTI SELECT CSS -->
  <link rel="stylesheet" href="../../assets/plugins/multipleselect/multiple-select.css">
  <style>
    body {
      overflow-x: hidden
    }

    .otp-input-wrapper {
      width: 240px;
      text-align: left;
      display: inline-block;
    }

    .otp-input-wrapper input {
      padding: 0;
      width: 264px;
      font-size: 20px;
      font-weight: 600;
      color: #3e3e3e;
      background-color: transparent;
      border: 0;
      margin-left: 2px;
      letter-spacing: 30px;
      font-family: sans-serif !important;
    }

    .otp-input-wrapper input:focus {
      box-shadow: none;
      outline: none;
    }

    .otp-input-wrapper svg {
      position: relative;
      display: block;
      width: 240px;
      height: 2px;
    }
  </style>
  <style>
    .picture___input {
      display: none;
    }

    .picture {
      width: 300px;
      aspect-ratio: 16/9;
      background: #ddd;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #aaa;
      border: 2px dashed currentcolor;
      cursor: pointer;
      font-family: sans-serif;
      transition: color 300ms ease-in-out, background 300ms ease-in-out;
      outline: none;
      overflow: hidden;
    }

    .picture:hover {
      color: #777;
      background: #ccc;
    }

    .picture:active {
      border-color: turquoise;
      color: turquoise;
      background: #eee;
    }

    .picture:focus {
      color: #777;
      background: #ccc;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }

    .picture__img {
      max-width: 100%;
    }
  </style>
</head>

<body class="" style="background-color: #343a40">


  <!-- JQUERY JS -->
  <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>

  <!-- BOOTSTRAP JS -->
  <script src="../../assets/plugins/bootstrap/js/popper.min.js"></script>
  <script src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
  <div class="row justify-content-end" 
    style="margin: 0;
      padding: 0;
      height: 100vh; /* Set the height of the body to 100% of the viewport height */
      display: flex;
      align-items: center; /* Center items vertically */
      justify-content: center; /* Center items horizontally */
      background-image: url({{asset('')}}assets/img/bg-login.jpg); /* Replace 'your-image-url.jpg' with the URL or path to your image */
      background-size: cover; /* Ensure the background image covers the entire container */
      background-position: center; /* Center the background image */
      background-repeat: no-repeat; /* Do not repeat the background image */">
    <div class="col-md-3 col-sm-12 p-0 m-0" style="height: 100vh; overflow-y: auto">
      @yield('content')
    </div>
    <div class="col-12">
      <section style="background: #5bb8e0">
        <div class="container">
          <img style="display: block; margin-left: auto; margin-right: auto;" src="{{asset('')}}images/logo/hisuara_new.png"
            width="100px" class="pt-5 mb-5">
          <div class="text-center pb-5" style="font-size: 13px;">
            © PT.Hisuara Smart Count <br />
            All Right Reserved 2021
          </div>
        </div>
      </section>
    </div>
  </div>

  <!-- BACKGROUND-IMAGE CLOSED -->


  <!-- CHART-CIRCLE JS -->
  <script src="../../assets/js/circle-progress.min.js"></script>

  <!-- Perfect SCROLLBAR JS-->
  <script src="../../assets/plugins/p-scroll/perfect-scrollbar.js"></script>

  <!-- INPUT MASK JS -->
  <script src="../../assets/plugins/input-mask/jquery.mask.min.js"></script>

  <!-- CUSTOM JS-->
  <script src="../../assets/js/custom.js"></script>

  <!-- SELECT2 JS -->
  <script src="../../assets/plugins/select2/select2.full.min.js"></script>
  <script src="../../assets/js/select2.js"></script>
  <script src="../../assets/js/form-elements.js"></script>

  <!-- MULTI SELECT JS-->
  <script src="../../assets/plugins/multipleselect/multiple-select.js"></script>
  <script src="../../assets/plugins/multipleselect/multi-select.js"></script>

  <script>
    // $('#koor_id').on('change', function() {
    //   const korId = $(this).val();
    //   $.ajax({
    //     url: "{{route('getKoordinator')}}",
    //     type: "get",
    //     data: {
    //       id: korId
    //     },
    //     success: function(res) {
    //       $('#container-koordinator').html(res);
    //     }
    //   })
    // });


    $('#role').on('change', function() {

      let cekTps = $(this).val().split("|");
      
      
      if (cekTps[0] == "tdk") {
        $('.prov-con').show();
        $('.kota-con').show();
        $('.kec-con').hide();
        $('.kel-con').hide();
        $('.rw-con').hide();
        $('.rt-con').hide();
        $('.tps-con').hide();
        $('#koor-form').hide();
        $('#cek_koor').val("")
        
    
      } else if (cekTps[0] == "tps") {
        $('.prov-con').show();
        $('.kota-con').show();
        $('.kec-con').show();
        $('.kel-con').show();
        $('.rw-con').hide();
        $('.rt-con').hide();
        $('#tps-con').show();

       $('#koor-form').hide();
       $('#cek_koor').val("")
      } else if (cekTps[0] == "kor") {
        $('.prov-con').hide();
        $('.kota-con').hide();
        $('.kec-con').hide();
        $('.kel-con').hide();
        $('.rw-con').hide();
        $('.rt-con').hide();
        $('.tps-con').hide();
        $('#koor-form').show();
        $('#cek_koor').val("yes")

      }
    });

    $("#koor_id").on('change', function() {
      let dataKoor = parseInt($(this).val());

      if (dataKoor == 1) {
        $('.prov-con').show();
        $('.kota-con').show();
        $('.kec-con').hide();
        $('.kel-con').hide();
        $('.rw-con').hide();
        $('.rt-con').hide();
        $('.tps-con').hide();

      } else if (dataKoor == 2) {
        $('.prov-con').show();
        $('.kota-con').show();
        $('.kec-con').show();
        $('.kel-con').hide();
        $('.rw-con').hide();
        $('.rt-con').hide();
        $('.tps-con').hide();
      } else if (dataKoor == 3) {
        $('.prov-con').show();
        $('.kota-con').show();
        $('.kec-con').show();
        $('.kel-con').show();
        $('.rw-con').hide();
        $('.rt-con').hide();
        $('.tps-con').hide();
      } else if (dataKoor == 4) {
        $('.prov-con').show();
        $('.kota-con').show();
        $('.kec-con').show();
        $('.kel-con').show();
        $('.rw-con').show();
        $('.rt-con').hide();
        $('.tps-con').hide();
      } else if (dataKoor == 5) {
        $('.prov-con').show();
        $('.kota-con').show();
        $('.kec-con').show();
        $('.kel-con').show();
        $('.rw-con').show();
        $('.rt-con').show();
        $('.tps-con').hide();
      }
    });


    $('#provinsi').on('change', function() {
      let idProvinsi = $(this).val();
      // console.log(idProvinsi)
      $.ajax({
        url: `{{url('')}}/getKota/${idProvinsi}`,
        method: 'get',

        success: function(response) {
          $('#kota').html("")
          response.forEach((item, id) => {
            var option = $(`<option value="${item.id}">${item.name}</option>`); // Membuat elemen baru
            $('#kota').append(option)
          })
          // console.log(response)
        }

      });
    })
    $('#kota').on('change', function() {
      let idKota = $(this).val();

      $.ajax({
        url: `{{url('')}}/api/public/get-district`,
        method: 'get',
        data: {
          id: idKota
        },
        dataType: "json",
        success: function(response) {
          $('#kecamatan').html("")
          response.forEach((item, id) => {
            var option = $(`<option value="${item.id}">${item.name}</option>`); // Membuat elemen baru
            $('#kecamatan').append(option)
          })
        }

      });

    })

    $('#kecamatan').on('change', function() {

      let idKec = $(this).val();

      $.ajax({
        url: `{{url('')}}/api/public/get-village`,
        method: 'get',
        data: {
          id: idKec
        },
        dataType: "json",
        success: function(response) {
          $('#kelurahan').html("")
          console.log(response)

          response.forEach((item, id) => {
            var option = $(`<option value="${item.id}">${item.name}</option>`); // Membuat elemen baru
            $('#kelurahan').append(option)
          })

          // console.log(response)
        }

      });
    })
    $('#kelurahan').on('change', function() {

      let idKel = $(this).val();

      $.ajax({
        url: `{{url('')}}/api/public/get-tps-by-village-id`,
        method: 'get',
        data: {
          village_id: idKel
        },
        dataType: "json",
        success: function(response) {
          $('#tps').html("")
          if (response.messages != null) {
            var option = $(`<option disabled>Data Tps Kosong</option>`); // Membuat elemen baru
            $('#tps').append(option)
          }
          $('#tps').html("<option disabled selected> Pilih TPS </option>")
          response.forEach((item, id) => {
            var option = $(`<option value="${item.id}">${item.number}</option>`); // Membuat elemen baru
            $('#tps').append(option)
          })
          // console.log(response)
        }

      });
    })

    const inputFile = document.querySelector("#picture__input");
    const inputFile2 = document.querySelector("#picture__input2");
    const pictureImage = document.querySelector(".picture__image");
    const pictureImage2 = document.querySelector(".picture__image2");
    // const pictureImageTxt = "Choose an image";
    pictureImage.innerHTML = "Pilih Foto Ktp";
    pictureImage2.innerHTML = "Pilih Foto Profile";

    inputFile.addEventListener("change", function(e) {
      const inputTarget = e.target;
      const file = inputTarget.files[0];

      if (file) {
        const reader = new FileReader();

        reader.addEventListener("load", function(e) {
          const readerTarget = e.target;

          const img = document.createElement("img");
          img.src = readerTarget.result;
          img.classList.add("picture__img");

          pictureImage.innerHTML = "";
          pictureImage.appendChild(img);
        });

        reader.readAsDataURL(file);
      } else {
        pictureImage.innerHTML = "Pilih Foto Ktp";
      }
    });

    inputFile2.addEventListener("change", function(e) {
      const inputTarget = e.target;
      const file = inputTarget.files[0];

      if (file) {
        const reader = new FileReader();

        reader.addEventListener("load", function(e) {
          const readerTarget = e.target;

          const img = document.createElement("img");
          img.src = readerTarget.result;
          img.classList.add("picture__img");

          pictureImage2.innerHTML = "";
          pictureImage2.appendChild(img);
        });

        reader.readAsDataURL(file);
      } else {
        pictureImage2.innerHTML = "Pilih Foto Profile";
      }
    });
  </script>
</body>

</html>