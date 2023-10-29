@extends('layouts.setup')

@section('content')
<div class="row mt-5 text-white">
    <div class="col-lg-12">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h1>DPT - TPS KECAMATAN {{$kecamatan['name']}}</h1>
                {{-- <h6>Isi Jumlah TPS Tiap - Tiap Kelurahan Dengan Benar Dan Sesuai Dengan Jumlah TPS Yang Di Keluarkan Oleh KPU Tahun 2024</h6> --}}
                <h6>Anda Harus Melakukan Input DPT Setiap Kecamatan Di Kota/Kabupaten Pemilihan. DPT Terbaru Dapat Di
                    Peroleh Melalui Website KPU Setempat.</h6>
            </div>
            <div class="col-lg-2">
                <div class="card bg-white">
                    <center>
                        <h1 style="color: #013b80; padding: 1rem; justify-content: center">{{$sisa_count}}/{{count($count_kecamatan)}}</h1>
                    </center>
                </div>
            </div>
            <div class="container">
                <ul>
                    {{-- <li>Isi Form Sesuai TPS Masing Masing kelurahan (Satu Per Satu)</li> --}}
                    {{-- <li>Klik tombol Kirim data jika tombol berubah warna menjadi hijau anda dapat melanjutkan mengirim data di kelurahan selanjutnya</li> --}}
                    {{-- <li>Pastikan semua form terisi dengan benar lalu klik </li> --}}
                </ul>
            </div>
            {{-- <div class="container">
                <div class="row justify-content-center">

                    <div class="col-lg-10 mt-4">
                        <div class="card">
                            <div class="card-header  bg-pri text-white text-center">
                                KECAMATAN - {{$sisa_count}}/{{count($count_kecamatan)}}
        </div>


        <div class="card-body">
            <form action="action_setup_tps/{{$kecamatan['id']}}" method="post">
                @csrf
                <div class="row text-dark">

                    @foreach ($kelurahan as $kl)
                    <div class="col-lg-3 mt-2">
                        <div class="form-group">
                            <label class="mb-2" for="inputAddress"><b>{{ $kl['name'] }}</b></label>

                        </div>
                    </div>
                    @endforeach
                    <button type="submit" class="btn btn-outline-primary my-5">Lanjutkan</button>
                </div>

            </form>
        </div>
    </div>
</div>


</div>
</div> --}}
<div class="container">
    <div class="card">
        <div class="card-body">
            <form action="action_setup_tps/{{$kecamatan['id']}}" method="post">
                @csrf
                <div class="row justify-content my-2">

                    @foreach ($kelurahan as $kl)

                    <div class="col-lg-3 mt-4">
                        <div class="card">
                            <div class="card-header  bg-pri text-white text-center">
                                {{ $kl['name']}}
                            </div>
                            <div class="card-body">
                                <div class="row text-dark">
                                    <div class="input-group mt-3">
                                        @if ($kl['tps'] < 0) <input readonly type="number" required class="form-control" name="{{ $kl['id'] }}" id="inputAddress" value="{{$kl['tps']}}" placeholder="Jumlah TPS">
                                            <input readonly type="number" required class="form-control" name="dpt-{{ $kl['id'] }}" id="inputAddress" value="{{$kl['dpt']}}" placeholder="Jumlah DPT">

                                            @else
                                            <input type="number" required class="form-control" name="{{ $kl['id'] }}" id="inputAddress" placeholder="Jumlah TPS">
                                            <input type="number" required class="form-control" name="dpt-{{ $kl['id'] }}" id="inputAddress" placeholder="Jumlah DPT">
                                            @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach


                    <button type="submit" class="btn bg-pri text-white my-5">Lanjutkan</button>
                </div>.
                

            </form>
        </div>
    </div>
</div>

</div>


</div>
</div>
@endsection