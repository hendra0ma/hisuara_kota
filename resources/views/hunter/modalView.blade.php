<img src="{{ asset('public/storage/' . '/' . $relawan->c1_images) }}" alt="" class="img-fluid zoom" data-magnify-src="{{ asset('public/storage/' . '/' .$relawan->c1_images) }}">

<div class="col-lg-12 mt-3">
    <h6>TPS {{ $relawan->tps_id }} / Kelurahan {{ $relawan->village_name }}</h6>
    <form action="{{route('hunter.verifikasiRelawan',Crypt::encrypt($relawan->relawan_id))}}" method="post">
        @csrf
        <?php $i = 1; ?>
        <div class="row">
            @foreach ($paslon as $pas)
            <div class="form-group col-md-6">
                <label>Suara 0{{ $i++ }}</label>
                <input type="number" class="form-control" name="suara[]" placeholder="Suara" required>
            </div>
            @endforeach
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary btn-block">
                    Submit
                </button>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        $('.zoom').magnify();
    });
</script>