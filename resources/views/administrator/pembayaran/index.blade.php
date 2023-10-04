@extends('layouts.main-pembayaran')

@section('content')

<div class="container-fluid" style="padding-right: 1.75rem !important; padding-left: 1.75rem !important">
    <div class="row justify-content-center align-items-center" style="height: 80vh;">
        <div class="col-md-7">
            <article class="postcard dark blue shadow-xl">
                <a class="postcard__img_link" href="#">
                    <img class="postcard__img" src="{{asset('')}}/xm.png" alt="Image Title" />
                </a>
                <div class="postcard__text">
                    <h1 class="postcard__title blue"><a href="#"> Pembayaran Saksi</a></h1>
                    <!-- <div class="postcard__subtitle small">
                        <time datetime="2024-05-25 12:00:00">
                            <i class="fas fa-calendar-alt mr-2"></i>May 25th 2024
                        </time>
                    </div> -->
                    <div class="postcard__bar"></div>
                    <div class="postcard__preview-txt">pembayaran saksi akan menggunakan dashboard dari third party
                        seperti midtrans dan xendit dan atau lainnya yang akan terhubung via API Rekapitung. </div>
                </div>
            </article>
        </div>
    </div>
</div>

@endsection
