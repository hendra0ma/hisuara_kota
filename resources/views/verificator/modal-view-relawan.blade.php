<img src="{{asset('public/storage/'.'/'.$relawan->c1_images)}}" alt="" class="img-fluid zoom" data-magnify-src="{{asset('public/storage/'.'/'.$relawan->c1_images)}}">


<div class="col-lg-12 mt-3">
    <h6>TPS {{$relawan->tps_id}} / Kelurahan </h6>

    <div class="form-row">


        <?php $i = 1;  ?>


        @foreach ($relawan->relawan_data as $dataTps)


        <div class="form-group col-md-6">
            <label>Suara 0{{$i++}}</label>
            <input type="number" class="form-control" readonly="" value="{{$dataTps->voice}}" name="suara[]" placeholder="Suara" readonly>
        </div>
        @endforeach


    </div>

    <!-- <button type="submit" class="btn btn-primary btn-block">Simpan</button> -->
    <div class="row" id="buttons">
        <div class="col-6">
            <a href="{{route('verifikator.verifikasiDataC1Relawan',Crypt::encrypt($relawan->id))}}" class="btn btn-success btn-block">
                Verifikasi C1 Relawan
            </a>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.zoom').magnify();
    });
</script>
