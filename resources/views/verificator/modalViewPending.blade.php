<img src="{{asset('storage'.'/'.$paslon[0]->saksi_data[0]->c1_images)}}" alt="" class="img-fluid zoom" data-magnify-src="{{asset('storage'.'/'.$paslon[0]->saksi_data[0]->c1_images)}}">
<div class="col-lg-12 mt-3">
    <h6>TPS {{$paslon[0]->saksi_data[0]->number}} / Kelurahan {{$village->name}}</h6>
    <div class="form-row">
        <?php $i = 1;  ?>
        @foreach($paslon as $pas)
        <?php
        $voice = 0;

        ?>
        @foreach ($pas->saksi_data as $dataTps)
        <?php
        $voice += $dataTps->voice;
        ?>
        @endforeach
        <div class="form-group col-md-6">
            <label>Suara 0{{$i++}}</label>
            <input type="number" class="form-control" readonly="" value="{{$voice}}" name="suara[]" placeholder="Suara" readonly>
        </div>
        <?php $voice = 0;  ?>
        @endforeach
    </div>
    <!-- <button type="submit" class="btn btn-primary btn-block">Simpan</button> -->
    <div class="row" id="buttons">
        <div class="col-6">
            <a href="{{route('verifikator.verifikasiDataPending',Crypt::encrypt($paslon[0]->saksi_data[0]->saksi_id))}}" class="btn btn-block btn-info">Verifikasi Saksi Pending</a>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.zoom').magnify();
    });
</script>