<?php

use App\Models\Saksi;
use App\Models\SaksiData;
use App\Models\Rekapitulator;
?>

@extends('layouts.main-rekapitulator')

@section('content')

<div class="row mt-3">
    <div class="col-lg-4">
        <h1 class="page-title fs-1 mt-2">Dashboard
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Rekapitulator
                <!-- Kota -->
            </li>
        </ol>
        <h4 class="fs-4 mt-2 fw-bold">Administrator Rekapitulator (2)</h4>
    </div>
</div>

<div class="row mt-5">
    <div class="col-xl-10">
        @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show text-dark mt-2 mb-2" role="alert">
            {{ Session::get('error')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
        </div>
        @endif
    </div>
    <div class="col-xl-6">
        <div class="card bg-light">
            <div class="card-header">
                <h3>
                    Dashboard Admin Rekapitulator
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row no-gutters justify-content-center">
                                    <div class="col-xl-5">
                                        <img src="{{ Auth::user()->profile_photo_url }}" alt="" class="img-circle rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                                    </div>
                                    <div class="col-12">
                                        <div class="text-dark text-center mt-2 text-bold">
                                            <h2>
                                                {{Auth::user()->name}}
                                            </h2>
                                        </div>
                                        <div class="text-left mb-4">
                                            <p class="mb-2">
                                                <i class="fa fa-envelope mr-2"></i>
                                                {{Auth::user()->email}}
                                            </p>
                                            <p class="mb-2">
                                                <i class="fa fa-phone mr-2"></i>
                                                {{Auth::user()->no_hp}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6" style='overflow: scroll;height:418px;'>
                        @foreach($team as $people)
                        <div class="card">
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <div class="col-xl-4">
                                        <img src="{{asset('storage/profile-photos').'/'.$people->profile_photo_path}}" style="width: 60px; height: 60px; object-fit: cover;" class="rounded-circle">
                                    </div>
                                    <div class="col-xl-7">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <h6>{{$people->name}}</h6>
                                            </div>
                                            <div class="col-xl-12">
                                                @if(Cache::has('is_online' . $people->id))
                                                <span class="text-success">Online</span>
                                                @else
                                                <span class="text-secondary">Offline</span>
                                                @endif
                                            </div>
                                        </div>
                                        {{ \Carbon\Carbon::parse($people->last_seen)->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card-footer">

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-danger btn-block" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        <i class="fa fa-sign-out"></i> &nbsp;logout
                    </button>

                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-7 col-xl-6">
        <div class="card custom-card">
            <div class="main-content-app pt-0">
                <div class="main-content-body main-content-body-chat">
                    <div class="main-chat-header pt-3">
                        <div class="main-chat-msg-name mt-2">
                            <h6>Live Chat</h6>
                        </div>
                    </div><!-- main-chat-header -->
                    <livewire:chat-group-component />
                    <livewire:chat-component />

                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-lg-6 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Data Rekapitung</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <tr>
                        <td>
                            Kelurahan
                        </td>
                        <td>
                            %
                        </td>
                        @foreach ($suara as $suar)
                        <td>
                            {{$suar['id']}}
                        </td>
                        @endforeach
                        <td>
                            Unduh
                        </td>
                    </tr>

                    @foreach ($kecamatan as $item)
                    <?php $saksi  = Saksi::where('village_id', $item['id'])->get(); ?>
                    <?php $persen = count($saksi)  /   $item['tps'] * 100;
                    ?>
                    <tr>
                        <td>
                            {{$item['name']}}
                        </td>
                        <td>
                            {{floor($persen)}}%
                        </td>
                        @foreach ($suara as $suar)
                        <?php $saksi_data = SaksiData::where('paslon_id', $suar['id'])->where('village_id', $item['id'])->sum('voice'); ?>
                        <td>
                            @if ($saksi_data == NULL)
                            Belum ada data
                            @else
                            {{$saksi_data}}
                            @endif
                        </td>
                        @endforeach
                        <td>
                            <a class="btn btn-success" href="#">Unduh</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Data Rekapitung</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <tr>
                        <td>
                            Kelurahan
                        </td>
                        @foreach ($suara as $suar)
                        <td>
                            {{$suar['candidate']}}
                        </td>
                        @endforeach
                        <td>
                            Action
                        </td>
                        <td>
                            GAP
                        </td>
                    </tr>
                    @foreach ($kecamatan as $kelurahan)
                    <?php $rekapitulator = Rekapitulator::where('village_id', $kelurahan['id'])->get() ?>
                    <tr>
                        <td>
                            {{$kelurahan['name']}}
                        </td>
                        <form action="action_rekapitulator/{{Crypt::encrypt($kelurahan['id'])}}" method="post">
                            @csrf
                            <input class="form-control" type="hidden" name="id" value="{{$id}}">
                            @foreach ($rekapitulator as $item)
                            <td> <input class="form-control" type="text" name="{{$item['id']}}" value="{{$item['value']}}"></td>
                            @endforeach
                            <td>
                                <button class="btn btn-success" type="submit">Submit</button>
                            </td>
                        </form>

                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>




Data KPU


@endsection