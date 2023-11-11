@extends('layouts.mainlayoutVerificatorkoreksi');

@section('content')

<div class="row">
    <div class="col-lg-4">

        <h1 class="page-title fs-1 mt-2">Koreksi C1
            <!-- Kota -->
        </h1>
    </div>

</div>

<div class="p-0 mt-5">
    <div class="col-lg-12 p-0">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <img src="{{asset('storage/').'/'.$saksi[0]->c1_images}}" class="img-fluid" alt="Responsive image">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                {{-- <div class="card">
                    <div class="card-header bg-danger text-center text-white h6 text-uppercase">
                        Peringatan
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>Setiap perubahan data yang di lakukan wajib memerlukan izin dan persetujuan dari administrator (Human Verifikasi)</li>
                            <li>Aktifitas perubahan data yang anda lakukan akan di tampilkan pada history publik yang dapat di lihat oleh masyarakat. Segala perbuatan yang melanggar hukum dengan merubah hasil perhitungan suara yang sah dapat di kenakan Pasal 505 UU No.7 Tahun 2017</li>
                        </ul>
                    </div>
                </div> --}}
                <div class="card">
                    <div class="card-header bg-primary text-center text-white h6">
                        Data Lama
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-row">
                                    <?php $i = 1;
                                    $voice = 0;
                                    ?>
                                    @foreach($saksi as $saksidata)
                                        @foreach($saksidata->saksi_data as $saksi_data)
                                        <?php $voice += $saksi_data->voice  ?>
                                        <div class="form-group col-md-12">
                                            <label>Suara 0{{$i++}}</label>
                                            <input type="number" class="form-control" id="inputname1" readonly="" value="{{$saksi_data->voice}}" name="suara[]" placeholder="Suara 01">
                                        </div>
                                        @endforeach
                                    @endforeach
                              
                                </div>
                        </div>
                        <div class="col-6">
                            
                            <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Jumlah Suara Sah</label>
                                        <textarea type="number" class="form-control" id="inputnom4" readonly="" name="suaraSah" placeholder="Jumlah suara" rows="9">{{$voice}}</textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-success text-center text-white h6">
                        Data Terbaru
                    </div>
                    <div class="card-body">

                        <x-jet-validation-errors class="mb-4" />
                        <form action="{{route('verifikator.actionKoreksiData',Crypt::encrypt($id))}}" method="post">
                            @csrf

                            <div class="row">

                                <div class="col">
                                    <div class="form-row">
                                        <?php $i = 1;  ?>
                                        @foreach($saksi as $saksidata)
                                        @foreach($saksidata->saksi_data as $saksi_data)
                                        <div class="form-group col-md-6">
                                            <label>Suara 0{{$i}}</label>
                                            <input type="number" class="form-control" id="suara[]" name="suara[]" required placeholder="Total Suara 0{{$i}}">
                                        </div>
                                        <?php $i++ ?>
                                        @endforeach
                                        @endforeach
                                    
                                    </div>
                                </div>
    
                              
                            </div>

                            <small>
                                Perubahan data yang saya lakukan sesuai dengan data C1. Saya menyatakan tunduk dan patuh terhadap Undang-Undang Pemilu yang berlaku dan siap mempertanggung jawabkan perubahan data ini.
                            </small>
                            <div class="custom-control custom-checkbox mt-2 mb-1">
                                <input type="checkbox" required="" class="custom-control-input" id="customCheck2" name="persetujuan" data-parsley-multiple="groups" data-parsley-mincheck="2">
                                <label class="custom-control-label" for="customCheck2">Setuju</label>
                            </div>
                            <button class="btn btn-primary btn-block mt-2" id="send" type="submit">Koreksi Data</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
