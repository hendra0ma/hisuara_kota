<img src="{{ asset('public/storage/' . '/' . $paslon[0]->saksi_data[0]->c1_images) }}" alt="" class="img-fluid zoom" data-magnify-src="{{ asset('public/storage/' . '/' . $paslon[0]->saksi_data[0]->c1_images) }}">



<div class="col-lg-12 mt-3">
    <h6>TPS {{ $paslon[0]->saksi_data[0]->tps_id }} / Kelurahan {{ $village->name }}</h6>

    <div class="form-row">


        <?php $i = 1; ?>
        @foreach ($paslon as $pas)
        <?php
        $voice = 0;

        ?>
        @foreach ($pas->saksi_data as $dataTps)
        <?php
        $voice += $dataTps->voice;
        ?>
        @endforeach
        <div class="form-group col-md-6">
            <label>Suara 0{{ $i++ }}</label>
            <input type="number" class="form-control" readonly="" value="{{ $voice }}" name="suara[]" placeholder="Suara" readonly>
        </div>
        <?php $voice = 0; ?>
        @endforeach
    </div>
    <div class="row">
        <div class="col-lg-6 mt-1">
            <a href="{{route('checking.verifikasi', Crypt::encrypt($paslon[0]->saksi_data[0]->saksi_id))}}" class="btn btn-block btn-info">Verifikasi</a>
        </div>
        <div class="col-lg-6 mt-1">
            <a href="{{route('checking.tolakOverlimit', Crypt::encrypt($paslon[0]->saksi_data[0]->saksi_id))}}" class="btn btn-block btn-danger">Tolak Overlimit</a>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.zoom').magnify();
    });
</script>