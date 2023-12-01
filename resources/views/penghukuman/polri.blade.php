@include('layouts.partials.head')
@include('layouts.partials.sidebar')
<?php
$solution = \App\Models\SolutionFraud::get();
?>

@include('layouts.partials.header')

<div class="row" style="margin-top: 90px; transition: all 0.5s ease-in-out;">
    <div class="col-lg-auto d-flex">
        <img style="width: 75px; height: 75px; object-fit: contain" class="my-auto"
            src="https://upload.wikimedia.org/wikipedia/commons/6/6e/Lambang_Polri.png" alt="">
    </div>  
    <div class="col-lg">
        @if ($message = Session::get('success'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
        </div>
        @endif

        <h1 class="page-title fs-1 mt-2">Polri
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">{{ $kota->name }}
                <!-- Kota -->
            </li>
        </ol>
    </div>

</div>

<div class="row mt-5">
    <livewire:fraud-data-print-polri>
</div>


@include('layouts.partials.footer')
@include('layouts.partials.scripts-bapilu')