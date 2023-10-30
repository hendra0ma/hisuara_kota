<div class="col-lg-6" style="height: 100vh; overflow: scroll">
    <center>
        <img src="{{ asset('storage/' . '/' . $paslon[0]->saksi_data[0]->c1_images) }}" alt="" class="img-fluid zoom" data-magnify-src="{{ asset('storage/' . '/' . $paslon[0]->saksi_data[0]->c1_images) }}">
    </center>
</div>

<div class="col-lg-6 mt-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="card-title mx-auto">DATA SAKSI</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-auto">
                            @if ($user['profile_photo_path'] == NULL)
                            <img style="width: 108px; height: 108px; object-fit: cover; margin-right: 10px;" src="https://ui-avatars.com/api/?name={{ $user['name'] }}&color=7F9CF5&background=EBF4FF">
                            @else
                            <img style="width: 108px; height: 108px; object-fit: cover; margin-right: 10px;" src="{{url("/storage/profile-photos/".$user['profile_photo_path']) }}">
                            @endif
                        </div>
                        <div class="col-md">
                            <div class="row mb-2">
                                <div class="col-md-3 fw-bold">NIK</div>
                                <div class="col-auto">:</div>
                                <div class="col-md-auto">{{$user->nik}}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 fw-bold">Nama</div>
                                <div class="col-auto">:</div>
                                <div class="col-md-auto">{{$user->name}}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 fw-bold">No Wa</div>
                                <div class="col-auto">:</div>
                                <div class="col-md-auto">{{$user->no_hp}}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 fw-bold">Date</div>
                                <div class="col-auto">:</div>
                                <div class="col-md-auto">{{$user->created_at}}</div>
                            </div>
                        </div>
                        <div class="col-md">
                            <a href="https://wa.me/{{$user->no_hp}}" class="btn btn-success h-100 w-100 d-flex">
                                <div class="row mx-auto my-auto">
                                    <div class="col-md-12">
                                        <i class="fa-brands fa-whatsapp fs-1"></i>
                                    </div>
                                    <div class="col-md fs-5">
                                        Hubungi
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h4 class="card-title mx-auto">TPS {{ $paslon[0]->saksi_data[0]->tps_id }} / Kelurahan {{ $village->name }}</h4>
                </div>
                <div class="card-body">
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
                        <div class="form-group col-md-12">
                            <label>Suara 0{{ $i++ }}</label>
                            <input type="number" class="form-control" readonly="" value="{{ $voice }}" name="suara[]" placeholder="Suara" readonly>
                        </div>
                        <?php $voice = 0; ?>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="buttons">

        @if ($paslon[0]->saksi_data[0]->audit == 1)
        @else
        <div class="col-lg-6 mt-1">
            <a href="{{ route('auditor.auditData', Crypt::encrypt($paslon[0]->saksi_data[0]->saksi_id)) }}" class="btn btn-block btn-info">Lolos Audit</a>
        </div>
        <div class="col-lg-6 mt-1">
            <a href="{{ route('auditor.batalkanData', Crypt::encrypt($paslon[0]->saksi_data[0]->saksi_id)) }}" class="btn btn-block btn-danger">Batalkan</a>
        </div>
        @endif
    </div>

</div>
<script>
    $(document).ready(function() {
        $('.zoom').magnify();
    });
</script>