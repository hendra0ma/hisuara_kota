@extends('layouts.main-hukum')

@section('content')
<!-- PAGE-HEADER -->

<div class="row mt-3">
    <div class="col-lg-4">
        <h1 class="page-title fs-1 mt-2">Dashboard
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Administrator 1
                <!-- Kota -->
            </li>
        </ol>
    </div>
    <div class="col-lg-8 mt-2">
        <div class="row">
            <div class="col-lg-4 justify-content-end">
                <div class="card">
                    <div class="card-header bg-secondary">
                        <div class="card-title">Data Masuk</div>
                    </div>
                    <div class="card-body">
                        <p class="">{{ count($data_masuk) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-success">
                        <div class="card-title">Data Terverifikasi</div>
                    </div>
                    <div class="card-body">
                        <p class="">{{ count($terverifikasi) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="card-title">Data Ditolak</div>
                    </div>
                    <div class="card-body">
                        <p class="">{{ count($ditolak) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PAGE-HEADER END -->

<div class="row mt-5">

    <table class="table table-bordered text-nowrap border-bottom dataTable no-footer table-striped table-hover" id="basic-datatable" role="grid" aria-describedby="basic-datatable_info">
        <thead>
            <tr>
                <th width="30px">No</th>
                <th>Kecurangan</th>
                <th width="200px">Persen (TPS Masuk)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($index_tsm as $item)
            <tr>
                <td>{{ $item['id'] }}</td>
                <td>{{ $item['kecurangan'] }}</td>
                <td>0%</td>
            </tr>
            @endforeach
           
        </tbody>
    </table>
    

</div>

@endsection
