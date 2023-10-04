@extends('layouts.main-patroli')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Patroli Mode</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Tracking</a></li>
            <li class="breadcrumb-item active" aria-current="page">Patroli Mode</li>
        </ol>
    </div>
</div>
<div class="card mg-b-20">
    <div class="card-header">
        <div class="card-title text-uppercase">election demography tracking  (EDT)</div>
        <!-- <div class="ms-auto card-title text-warning">Paten 5 (Teknologi Pelacakan Rekapitung)</div> -->
    </div>
    <div class="card-body">
        <div class="ht-300" id="mapid" style="height:800px"></div>
    </div>
</div>
@endsection