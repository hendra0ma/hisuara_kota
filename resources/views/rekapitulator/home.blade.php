<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Rekapitulator</title>
</head>

<body>

  <div class="container mt-2">
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <h3 class="text-center">
          Rekapitulasi Kecamatan {{ucwords(strtolower($district->name))}}, <br> {{ucwords(strtolower($village->name))}}
        </h3>
      </div>
      <div class="col-lg-8">
        <select id="selectTps"class="form-select">
          @foreach ($tps as $tp)
            <option value="show{{$tp->id}}">TPS {{$tp->number}}</option>
          @endforeach
        </select>
      </div>
      <?php $j = 1; ?>
      @foreach ($tps as $tp)
      <div class="col-lg-8 hideForm show{{$tp->id}}"style="display:{{($j == 1)?'block':'none'}};">
        <div class="card border-0 shadow-sm mt-2">
          <div class="card-header border-0 bg-primary text-white ">
           <h5>
           TPS {{$tp->number}}
           </h5>
          </div>
          <div class="card-body">
            <?php $i = 1; ?>
            <form action="{{route('rekapitulator.actionTambah',$tp->id)}}" method="post">
              @foreach ($paslon as $pas)
              <label for="paslon{{$pas->id}}"> {{$pas->candidate}} - {{$pas->deputy_candidate}}</label>
              <input type="number" id="paslon{{$pas->id}}" name="suara{{$i}}" class="form-control" placeholder="Masukan Suara {{$i}}">

              <?php $i++ ?>

              @endforeach
              <div class="d-grid gap-2">
              <button type="submit" class="btn btn-success mt-2">Kirim</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <?php $j++; ?>
      @endforeach
    </div>
  </div>



  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <script>
      $('#selectTps').on('change',function(){
          let idCol = $(this).val();
          $('.hideForm').hide();
          $(`.${idCol}`).show();
        
      });
  </script>
</body>

</html>