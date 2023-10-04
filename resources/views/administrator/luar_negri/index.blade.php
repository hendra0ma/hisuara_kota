@extends('layouts.main-luarNegri')
@section('content')

<div class="row mt-3">
    <div class="col-lg-4">
        <h1 class="page-title fs-1 mt-2">Dashboard Rekapitung
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Admin Luar Negri
                <!-- Kota -->
            </li>
        </ol>
        <h4 class="fs-4 mt-2 fw-bold">Admin Luar Negeri</h4>
    </div>
</div>

<div class="row mt-3">
    <button class="btn btn-danger btn-icon text-white me-2" data-bs-toggle="modal" data-bs-target="#extralargemodal">
        <span>
            <i class="fe fe-plus"></i>
        </span> Tambah Perhitungan Suara Luar Negri
    </button>
    <div class="row mt-4">
        @foreach($luarnegri as $ls)
        <div class="col-md-6 col-xl-4">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="card-title text-white">HASIL PEMILU LUAR NEGRI </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md">
                            <img class="" style="width: 250px;" src="https://ui-avatars.com/api/?name={{ $ls->printable_name }}&color=7F9CF5&background=EBF4FF" alt="img">
                        </div>
                        <div class="col-md">
                            <div class="row mb-2">
                                <div class="col-md-4 fw-bold">Negara </div>
                                <div class="col-md">{{$ls->printable_name}}</div>
                            </div>
                            <hr>
                            @foreach ($paslon_can as $ps)
                            <?php $saksi_data = App\Models\SaksiData::where('paslon_id',$ps['id'])->where('saksi_id',$ls['id'])->first(); ?>
                            <div class="row mb-2">
                                <div class="fw-bold"> {{$ps['candidate']}}</div>
                                <div class="col-md"><input type="text" class="form-control" value="{{$saksi_data['voice']}}" disabled></div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <hr>
                    <div class="fw-bold">Petugas Input : {{Auth::user()->name}} </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="extralargemodal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b>Formulir Input Pemilu Luar Negri</b></h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{url('/')}}/administrator/action_luar_negri" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row mb-4 mb-0">
                        <div class="form-group m-0">
                            <label class="form-label">Negara</label>
                            <div class="row ">
                                <div class="col-5">
                                    <select name="negara" class="form-control form-select select2" required data-bs-placeholder="Select Month">
                                        <option selected disable value="">------------ Pilih Negara -------------</option>
                                        @foreach ($country as $item)
                                        <option value="{{$item['id']}}">{{$item['printable_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @foreach ($paslon_can as $ss)
                        <div class="col-md-6">
                            <label for="suara01">{{$ss['candidate']}} - {{$ss['deputy_candidate']}}</label>
                            <input type="text" id="suara01" class="form-control" name="paslon{{$ss['id']}}" required value="{{$ss['voice']}}">
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
