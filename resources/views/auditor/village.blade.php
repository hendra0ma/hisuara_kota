@extends('layouts/mainlayoutAuditor');

@section('content')

<div class="row mt-3">
    <div class="col-lg-4">
       

        <h1 class="page-title fs-1 mt-2">Dashboard Rekapitung
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">KELURAHAN {{$village->name}}
                <!-- Kota -->
            </li>
        </ol>
        <h4 class="fs-4 mt-2 fw-bold">Audit Suara Masuk (2)</h4> <!-- This Dummy Data -->
    </div>
    <div class="col-lg-8">
        <div class="row">
            <div class="col-4">
                <div class="card bg-light text-dark">
                    <div class="card-header text-center bg-success text-white">
                        <span> TPS Terverifikasi </span>
                    </div>
                    <div class="card-body text-center" style="font-size:15px;font-weight:bolder">
                        <div class="row no-gutters">
                            <div class="col-10">
                                {{count($list_suara)}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card bg-light text-dark">
                    <div class="card-header text-center bg-secondary text-white">
                        <span> TPS Teraudit </span>
                    </div>
                    <div class="card-body text-center" style="font-size:15px;font-weight:bolder">
                        <div class="row no-gutters">
                            <div class="col-10">
                                {{count($list_suara_audit)}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card bg-light text-dark">
                    <div class="card-header text-center bg-danger text-white">
                        <span> TPS Dibatalkan </span>
                    </div>
                    <div class="card-body text-center" style="font-size:15px;font-weight:bolder">
                        <div class="row no-gutters">
                            <div class="col-10">
                                {{count($list_suara_batal)}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

</div>



<div class="tab mt-5 d-none">
    <div class="row">
        
        <div class="col-md">
            <button class="btn tablink w-100 rounded-0 c1relawan" onclick="openPage('home', this, '#fb6b25 ')"  id="defaultOpen">Lolos Audit</button>
        </div>
        <div class="col-md">
            <button class="btn tablink w-100 rounded-0 c1saksipend" onclick="openPage('Dibatalkan', this, '#f82649 ')">Dibatalkan</button>
        </div>
    </div>
</div>



<div id="home" class="tabcontent">
    <div>
            <div class="row">
                <h2 class="fw-bold mb-0">  TPS Terverifikasi</h2>
            </div>
            <hr style="border: 1px solid">
        <div class="row mt-5">
            @foreach($list_suara as $ls)
            <div class="col-md-6 col-xl-4">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="card-title text-white">DATA C1 SAKSI</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md">
                                @if ($ls->profile_photo_path == NULL)
                                <img class="" style="width: 250px;" src="https://ui-avatars.com/api/?name={{ $ls->name }}&color=7F9CF5&background=EBF4FF" alt="img">
                                @else
                                <img class="" style="width: 250px;" src="{{url("/storage/profile-photos/".$ls->profile_photo_path) }}">
                                @endif
                            </div>
                            <div class="col-md">
                                <div class="row mb-2">
                                    <div class="col-md-4 fw-bold">NIK</div>
                                    <div class="col-md">{{$ls->nik}}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-4 fw-bold">Nama</div>
                                    <div class="col-md">{{$ls->name}}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-4 fw-bold">No Wa</div>
                                    <div class="col-md">{{$ls->no_hp}}</div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-4 fw-bold">Date</div>
                                    <div class="col-md">{{$ls->date}}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md fw-bold">
                                       <button type="button" class="btn btn-primary w-75 mb-4 periksa-c1-plano" data-bs-toggle="modal" data-bs-target="#periksaC1Verifikator" data-id="{{$ls->tps_id}}">
                    Audit C1
                    Plano
                </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {{$list_suara->links()}}
    </div>
</div>



<div id="teraudit" class="tabcontent">
    <div>
         <div class="row">
              <h2 class="fw-bold mb-0">  TPS Teraudit</h2>
                </div>
                <hr style="border: 1px solid">
        <div class="row mt-5">
            @foreach($list_suara_audit as $ls)
            <div class="col-md-6 col-xl-4">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="card-title text-white">DATA C1 SAKSI</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md">
                                @if ($ls->profile_photo_path == NULL)
                                <img class="" style="width: 250px;" src="https://ui-avatars.com/api/?name={{ $ls->name }}&color=7F9CF5&background=EBF4FF" alt="img">
                                @else
                                <img class="" style="width: 250px;" src="{{url("/storage/profile-photos/".$ls->profile_photo_path) }}">
                                @endif
                            </div>
                            <div class="col-md">
                                <div class="row mb-2">
                                    <div class="col-md-4 fw-bold">NIK</div>
                                    <div class="col-md">{{$ls->nik}}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-4 fw-bold">Nama</div>
                                    <div class="col-md">{{$ls->name}}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-4 fw-bold">No Wa</div>
                                    <div class="col-md">{{$ls->no_hp}}</div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-4 fw-bold">Date</div>
                                    <div class="col-md">{{$ls->date}}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md fw-bold">
                                       <button type="button" class="btn btn-primary w-75 mb-4 periksa-c1-plano" data-bs-toggle="modal" data-bs-target="#periksaC1Verifikator" data-id="{{$ls->tps_id}}">
                    Periksa C1
                    Plano
                </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {{$list_suara->links()}}
    </div>
</div>

<div id="dibatalkan" class="tabcontent">
    <div>
          <div class="row">
              <h2 class="fw-bold mb-0">  TPS Dibatalkan</h2>
                </div>
                <hr style="border: 1px solid">
        <div class="row mt-5">
            @foreach($list_suara_batal as $ls)
            <div class="col-md-6 col-xl-4">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="card-title text-white">DATA C1 SAKSI</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md">
                                @if ($ls->profile_photo_path == NULL)
                                <img class="" style="width: 250px;" src="https://ui-avatars.com/api/?name={{ $ls->name }}&color=7F9CF5&background=EBF4FF" alt="img">
                                @else
                                <img class="" style="width: 250px;" src="{{url("/storage/profile-photos/".$ls->profile_photo_path) }}">
                                @endif
                            </div>
                            <div class="col-md">
                                <div class="row mb-2">
                                    <div class="col-md-4 fw-bold">NIK</div>
                                    <div class="col-md">{{$ls->nik}}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-4 fw-bold">Nama</div>
                                    <div class="col-md">{{$ls->name}}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-4 fw-bold">No Wa</div>
                                    <div class="col-md">{{$ls->no_hp}}</div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-4 fw-bold">Date</div>
                                    <div class="col-md">{{$ls->date}}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md fw-bold">
                                       <button type="button" class="btn btn-primary w-75 mb-4 periksa-c1-plano" data-bs-toggle="modal" data-bs-target="#periksaC1Verifikator" data-id="{{$ls->tps_id}}">
                    Periksa C1
                    Plano
                </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {{$list_suara->links()}}
    </div>
</div>


<div class="modal fade" id="periksaC1Verifikator" tabindex="-1" aria-labelledby="periksaC1VerifikatorLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="periksaC1VerifikatorLabel">Data TPS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row" id="container-view-modal">
                      
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalPeriksa" tabindex="-1" aria-labelledby="modalPeriksaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPeriksaLabel">Persetujuan Koreksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <ul>
                        <li>Setiap perubahan data yang di lakukan wajib memerlukan izin dan persetujuan dari administrator (Human Verifikasi)</li>
                        <li>Aktifitas perubahan data yang anda lakukan akan di tampilkan pada history publik yang dapat di lihat oleh masyarakat
                            . Segala perbuatan yang melanggar hukum dengan merubah hasil perhitungan suara yang sah dapat di kenakan Pasal 505 UU No.7 Tahun 2017</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer ajukanPerubahan">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="" class="btn btn-primary">Ajukan Perubahan</a>
            </div>
        </div>
    </div>
</div>


<script>
    function openPage(pageName, elmnt, color) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].style.backgroundColor = "";
        }
        document.getElementById(pageName).style.display = "block";
        elmnt.style.backgroundColor = color;
    }
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>

<!-- SWEET-ALERT JS -->
<script src="../../assets/plugins/sweet-alert/sweetalert.min.js"></script>
<script src="../../assets/js/sweet-alert.js"></script>

@endsection