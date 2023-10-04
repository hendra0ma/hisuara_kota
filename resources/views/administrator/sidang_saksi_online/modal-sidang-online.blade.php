 @extends('layouts.main-sidang-online')


@section('content')


<div class="container mt-3">
    <div class="row align-items-center">
        <div class="col-auto">
            <img style="width: 100px;" src="{{url('/')}}/images/logo/rekapitung_gold.png" class="img-fluid" alt=""> 
        </div>
        <div class="col">
            <h1 class="fw-bold mb-0">Sidang MK Gugatan Pemilu Presiden 2024</h1><br>
            Online
        </div>
    </div>
</div>
   <div class="display-cover" id="card1">
                    <video autoplay></video>
                    <canvas class="d-none"></canvas>

                    <div class="video-options">
                        <select name="" id="" class="custom-select form-control">
                            <option value="">Select camera</option>
                        </select>
                    </div>
                    <img class="screenshot-image d-none" alt="">
                    <div class="controls">
                        <button class="btn btn-danger play" title="Play"><i data-feather="play-circle"></i></button>
                        <button class="btn btn-info pause d-none" title="Pause"><i data-feather="pause"></i></button>
                        <button class="btn btn-outline-success screenshot d-none" title="ScreenShot"><i
                                data-feather="image"></i></button>
                    </div>
                    {{-- <div class="filter-controls">
                        <button class="btn btn-primary rounded-0">Buramkan Wajah</button>
                        <button class="btn btn-secondary rounded-0">Efek Suara</button>
                        <button class="btn btn-dark rounded-0">Ganti Latar Belakang</button>
                    </div> --}}
   </div>
   <div class="display-cover bg-dark" style="height : 500px; display : none" id="card2">
                 <h5 class="text-white"> Memanggil</h5>
   </div>
                <div class="container">
                    <div class="row">
                       
                        <div class="col text-center">
                            <a id="panggil" class="w-100 btn btn-info">Panggil</a>
                             <a id="batalkan" style="display : none;" class="w-100 btn btn-danger">Batalkan</a>
                        </div>
                        <div class="col text-center">
                            <a href="{{url('/')}}/administrator/sidang_online/action/{{encrypt($tps_id)}}/{{encrypt("Tidak Menjawab")}}" class="w-100 btn btn-danger">Tidak Menjawab</a>
                        </div>
                        <div class="col text-center">
                            <a href="{{url('/')}}/administrator/sidang_online/action/{{encrypt($tps_id)}}/{{encrypt("Selesai")}}" class="w-100 btn btn-success">Selesai</a>
                        </div>
                         <div class="col text-center">
                           <a href="{{url('/')}}/administrator/sidang_online" class="w-100 btn btn-dark">Close</a>
                        
                        </div>


 

                    </div>
                </div>
@endsection

