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

        <h1 class="page-title fs-1 mt-2">Kepolisian Republik Indonesia
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">{{ $kota->name }}
                <!-- Kota -->
            </li>
        </ol>
    </div>
     <div class="col-md-4">
        <div class="row mt-2">
            <div class="col parent-link">
                <a data-command-target="kecurangan-masuk" class="btn text-white w-100 py-3 kecurangan-masuk tablink"
                    onclick="openPage('kecurangan-masuk', this, '#6259ca')" id="defaultOpen">Bukti Kecurangan</a>
            </div>
            <div class="col parent-link">
                <a class="btn text-white w-100 py-3 tablink" data-command-target="kecurangan-tercetak"
                    onclick="openPage('kecurangan-tercetak', this, '#6259ca')">Kecurangan Tercetak</a>
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
            // Remove the "active-tab" class from all tab links
            tablinks[i].classList.remove("active-tab");
        }
        document.getElementById(pageName).style.display = "block";
        elmnt.style.backgroundColor = color;
        // Add the "active-tab" class to the selected tab link
        elmnt.classList.add("active-tab");
    }
    // Wrap this part in a DOMContentLoaded event listener
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("defaultOpen").click();
    });
</script>

<div id="kecurangan-masuk" class="tabcontent mt-0 pt-0 px-0">
    <livewire:fraud-data-print-polri>
</div>
<div id="kecurangan-tercetak" class="tabcontent mt-0 pt-0 px-0">
    <livewire:panrb-tercetak>
</div>



@include('layouts.partials.footer')
@include('layouts.partials.scripts-bapilu')