
<div class="p-0 mt-3">
    <div class="col-lg-12 p-0">
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
                                <img style="width: 108px; height: 108px; object-fit: cover; margin-right: 10px;"
                                    src="https://ui-avatars.com/api/?name={{ $user['name'] }}&color=7F9CF5&background=EBF4FF">
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
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <img src="{{asset('storage/').'/'.$saksi[0]->c1_images}}" class="img-fluid"
                            alt="Responsive image">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-lg-12">
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
                                                <input type="number" class="form-control" id="inputname1" readonly=""
                                                    value="{{$saksi_data->voice}}" name="suara[]"
                                                    placeholder="Suara 01">
                                            </div>
                                            @endforeach
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-md-6 text-center">
                                        <div class="card h-100">
                                            <div class="card-header py-1">
                                                Jumlah Suara Sah :
                                            </div>
                                            <div class="card-body d-flex display-2 fw-bold">
                                                <div class="my-auto mx-auto">
                                                    {{$voice}}
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="display-2 fw-bold">Total :</div>
                                        <div class="display-2 fw-bold">{{$total_suara }}</div> --}}
                                    </div>

                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header bg-success text-center text-white h6">
                                    Data Terbaru
                                </div>
                                <div class="card-body">

                                    <x-jet-validation-errors class="mb-4" />
                                    <form action="{{route('verifikator.actionKoreksiData',Crypt::encrypt($id))}}"
                                        method="post">
                                        @csrf

                                        <div class="row">

                                            <div class="col-6">
                                                <div class="row">
                                                    <?php $i = 1;  ?>
                                                    @foreach($saksi as $saksidata)
                                                    @foreach($saksidata->saksi_data as $saksi_data)
                                                    <div class="form-group col-md-12">
                                                        <label>Suara 0{{$i}}</label>
                                                        <input type="number" class="form-control suara-input"
                                                            id="suara[]" name="suara[]" required
                                                            placeholder="Total Suara 0{{$i}}">
                                                    </div>
                                                    <?php $i++ ?>
                                                    @endforeach
                                                    @endforeach

                                                </div>
                                            </div>

                                            <div class="col-md-6 text-center">
                                                <div class="card h-100">
                                                    <div class="card-header py-1">
                                                        Jumlah Suara Sah :
                                                    </div>
                                                    <div class="card-body d-flex display-2 fw-bold">
                                                        <div class="my-auto mx-auto" id="sumDisplay">
                                                            0
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="display-2 fw-bold">Total :</div>
                                                <div class="display-2 fw-bold">{{$total_suara }}</div> --}}
                                            </div>

                                        </div>

                                        <small>
                                            Perubahan data yang saya lakukan sesuai dengan data C1. Saya menyatakan
                                            tunduk dan
                                            patuh terhadap Undang-Undang Pemilu yang berlaku dan siap mempertanggung
                                            jawabkan
                                            perubahan data ini.
                                        </small>
                                        <div class="custom-control custom-checkbox mt-2 mb-1">
                                            <input type="checkbox" required="" class="custom-control-input"
                                                id="customCheck2" name="persetujuan" data-parsley-multiple="groups"
                                                data-parsley-mincheck="2">
                                            <label class="custom-control-label" for="customCheck2">Setuju</label>
                                        </div>
                                        <button class="btn btn-primary btn-block mt-2" id="send" type="submit">Koreksi
                                            Data</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.suara-input').on('input', function() {
            // Get all input values with the class 'suara-input'
            let allValues = $('.suara-input').map(function() {
                return parseFloat($(this).val()) || 0;
            }).get();

            console.log(allValues);
            // Calculate the sum of all input values
            let sum = allValues.reduce(function(a, b) {
                return a + b;
            }, 0);
            // Display the sum in the HTML document
            $('#sumDisplay').html(sum);
        });
    });
</script>