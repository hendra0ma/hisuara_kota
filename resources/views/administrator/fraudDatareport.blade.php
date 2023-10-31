@include('layouts.partials.head')
{{-- @include('layouts.partials.sidebar-fbr') --}}
        @include('layouts.partials.header')

<div class="row mt-3 justify-content-end">
    <div class="col-lg">
        <h1 class="page-title fs-1 mt-2">Dashboard Hisuara
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Barcode Data Kecurangan
                <!-- Kota -->
            </li>
        </ol>
        <h4 class="fs-4 mt-2 fw-bold">Barcode Data Kecurangan</h4>
    </div>
    
     <div class="col-lg-3 mt-4">
        <div class="row justify-content-end">
            <div class="col-md-4">
                <a href="{{route('superadmin.print_qr')}}"target="_blank" class="btn btn-block btn-dark">
                    Print &nbsp; <i class="fa fa-print"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<h4 class="fs-4 mt-5 fw-bold">Election Fraud Barcode Report (EFBR)  <div>Dilindungi Paten Rekapitung</div> </h4>
<hr style="border: 1px solid;">

<div class="col-lg-12">
    <div class="card mt-5">
            <div class="card-header">
                <h4 class="card-title text-center mx-auto">Election Fraud Barcode Report (EFBR)</h4>

            </div>
            <div class="card-body">
                 <livewire:fraud-barcode-report-component />
            </div>
        </div>
</div>

</div>
@include('layouts.partials.footer')
@include('layouts.partials.scripts-bapilu')
@include('layouts.templateCommander.script-command')
