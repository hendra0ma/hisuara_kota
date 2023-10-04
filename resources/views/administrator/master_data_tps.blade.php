@extends('layouts.main-mastertps')

@section('content')

<div class="row mt-3">
    <div class="col-lg-4">
        <h1 class="page-title fs-1 mt-2">Dashboard Rekapitung
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard Rekapitung
                <!-- Kota -->
            </li>
        </ol>
        <h4 class="fs-4 mt-2 fw-bold">Rekam Data TPS</h4>
    </div>
</div>
<br>
    <div class="row mt-3">
       
            <div class="row">
                
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h4 class="card-title">Saksi</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md my-auto">Total TPS</div>
                                <?php $tps = App\Models\Tps::count(); ?>
                                <div class="col-md-3"><a class="btn btn-gray" href="#"
                                        role="button">{{$tps}}</a></div>
                            </div>
                            <hr>
                            <div class="row mt-3">
                                <div class="col-md my-auto">Foto C1 Plano</div>
                                  <?php $saksi = App\Models\Saksi::count(); ?>
                                <div class="col-md-3"><a class="btn btn-gray" href="{{url('')}}/administrator/all-c1-plano"
                                        role="button">{{$saksi}}</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-dark  text-white">
                            <h4 class="card-title">Relawan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md my-auto">Foto C1 Plano</div>
                                <div class="col-md-3"><a class="btn btn-gray" href="{{url('')}}/administrator/all-c1-relawan"
                                        role="button">0</a></div>
                            </div>
                            <hr>
                            
                        </div>
                    </div>
                </div>
            
                
         
                
            </div>
    
        
       
</div>

@endsection
