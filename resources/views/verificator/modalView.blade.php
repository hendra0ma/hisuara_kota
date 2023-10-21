<div class="col-lg-6" style="height: 100vh; overflow: scroll">
    <center>
        <img src="{{asset('storage'.'/'.$paslon[0]->saksi_data[0]->c1_images)}}" alt="" class="img-fluid zoom" data-magnify-src="{{asset('storage'.'/'.$paslon[0]->saksi_data[0]->c1_images)}}">
    </center>
</div>

<div class="col-lg-6" style="height: 100vh; overflow: hidden">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="card-title mx-auto">Data Saksi</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">NIK</div>
                        <div class="col-md">{{$user->nik}}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Nama</div>
                        <div class="col-md">{{$user->name}}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">No Wa</div>
                        <div class="col-md">{{$user->no_hp}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 fw-bold">Date</div>
                        <div class="col-md">{{$user->created_at}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h4 class="card-title mx-auto">TPS {{$paslon[0]->saksi_data[0]->number}} / Kelurahan {{$village->name}}</h4>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <?php $i = 1;  ?>
                        @foreach($paslon as $pas)
                        <?php
                        $voice = 0;
                        ?>
                        @foreach ($pas->saksi_data as $dataTps)

                        <?php
                        $voice += $dataTps->voice;
                        $total_suara = App\Models\SaksiData::where('saksi_id',$dataTps->saksi_id)->sum('voice');
                        ?>

                        @endforeach
                        <div class="form-group col-md-12">
                            <label>Suara 0{{$i++}}</label>
                            <input type="number" class="form-control" readonly="" value="{{$voice}}" name="suara[]" placeholder="Suara" readonly>
                        </div>
                        <?php $voice = 0;  ?>

                        @endforeach
                           <div class="form-group col-md-12">
                            <label><b>Total</b></label>
                            <input type="number" class="form-control" readonly="" value="{{$total_suara }}" name="suara[]" placeholder="Suara" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </div>

    <!-- <button type="submit" class="btn btn-primary btn-block">Simpan</button> -->
    <div class="row" id="buttons">

        @if($paslon[0]->saksi_data[0]->koreksi == 1)
        @else
        <div class="col-6">
            <a href="{{route('verifikator.verifikasiData',Crypt::encrypt($paslon[0]->saksi_data[0]->saksi_id))}}" class="btn btn-block btn-info">Verifikasi</a>
        </div>
        <div class="col-6">
            <button type="submit" class="btn btn-primary btn-block openModalKoreksi" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalPeriksa" data-id="{{Crypt::encrypt($paslon[0]->saksi_data[0]->saksi_id)}}">Koreksi</button>
        </div>
        @endif
    </div>

    <div class="row" style="margin-top: 50px;">
        <div class="col-12">
            <div class="alert alert-dark" role="alert">
                <h1 class="mb-0">SISA SURAT SUARA: TPS {{$paslon[0]->saksi_data[0]->number}} / Kelurahan {{$village->name}}: 0</h1>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.zoom').magnify();
    });
    $('button.openModalKoreksi').on('click', function() {
        const id = $(this).data('id');
        $('div.ajukanPerubahan').find('a.btn-primary').attr('href', `{{url("verifikator/koreksidata")}}/${id}`)
    });
    <?php if (Auth::user()->role_id == 1) :  ?>
        $('#buttons').show();
    <?php else :  ?>
        $('#buttons').show();
    <?php endif;  ?>
</script>