<style>
    /* width */
    .w-cus-sb::-webkit-scrollbar {
        width: 25px;
    }

    /* Track */
    .w-cus-sb::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    .w-cus-sb::-webkit-scrollbar-thumb {
        background: #888;
    }

    /* Handle on hover */
    .w-cus-sb::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>

<div class="col-lg-6 w-cus-sb" style="height: 100vh; overflow: scroll">
    <center>
        <img src="{{asset('storage'.'/'.$paslon[0]->saksi_data[0]->c1_images)}}" data-magnify-speed="200" alt="" data-magnify-magnifiedwidth="2500" data-magnify-magnifiedheight="2500" class="img-fluid zoom" data-magnify-src="{{asset('storage'.'/'.$paslon[0]->saksi_data[0]->c1_images)}}">
    </center>
</div>

<div class="col-lg-6" style="height: 100vh; overflow: scroll">

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
                            <a id="hubungiWhatsappButton" href="https://wa.me/{{$user->no_hp}}" class="btn btn-success h-100 w-100 d-flex">
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
                    <h4 class="card-title mx-auto">TPS {{$paslon[0]->saksi_data[0]->number}} / Kelurahan {{$village->name}}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <?php $i = 1;  ?>
                                @foreach($paslon as $pas)
                                <?php
                                $voice = 0;
                                ?>
                                @foreach ($pas->saksi_data as $dataTps)

                                <?php
                                $voice += $dataTps->voice;
                                $total_suara = App\Models\SaksiData::where('saksi_id', $dataTps->saksi_id)->sum('voice');
                                ?>

                                @endforeach
                                <div class="form-group col-md-12">
                                    <label>Suara 0{{$i++}}</label>
                                    <input type="number" class="form-control" readonly="" value="{{$voice}}" name="suara[]" placeholder="Suara" readonly>
                                </div>
                                <?php $voice = 0;  ?>

                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <div class="card h-100">
                                <div class="card-header py-1">
                                    Total :
                                </div>
                                <div class="card-body d-flex display-2 fw-bold">
                                    <div class="my-auto mx-auto">
                                        {{$total_suara }}
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="display-2 fw-bold">Total :</div>
                            <div class="display-2 fw-bold">{{$total_suara }}
                        </div> --}}
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
        <a id="verifikasiButton" data-url="{{ route('verifikator.verifikasiData', Crypt::encrypt($paslon[0]->saksi_data[0]->saksi_id)) }}" onclick="konfirmasiVerifikasi('{{ route('verifikator.verifikasiData', Crypt::encrypt($paslon[0]->saksi_data[0]->saksi_id)) }}')" class="btn btn-block btn-info text-white">Verifikasi</a>
    </div>
    <div class="col-6">
        <a id="koreksiButton" data-url="{{Crypt::encrypt($paslon[0]->saksi_data[0]->saksi_id)}}" href="{{url('verifikator/koreksidata')}}/{{Crypt::encrypt($paslon[0]->saksi_data[0]->saksi_id)}}" class="btn btn-primary btn-block openModalKoreksi">Koreksi</a>
    </div>
    @endif
</div>

<script>
    function konfirmasiVerifikasi(url) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan dapat mengembalikan tindakan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, saya yakin!',
            timer: 4000,
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengkonfirmasi, lakukan pengalihan ke URL verifikasi
                window.location.href = url;
            }
        });
    }
</script>

<div class="row mt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-success">
                <h4 class="mb-0 mx-auto text-white card-title">Data Pemlih Dan Penggunaan Hak Pilih (TPS {{$paslon[0]->saksi_data[0]->number}})</h4>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped">
                    <tr>
                        <td class="py-2 text-start" style="width: 50%">Jumlah Hak Pilih (DPT)</td>
                        <td class="py-2" style="width: 5%">:</td>
                        <td class="py-2" style="width: 40%">{{($surat_suara != NULL)?$surat_suara->dpt:"0"}}</td>
                    </tr>
                    <tr>
                        <td class="py-2 text-start" style="width: 50%">Surat Suara Sah</td>
                        <td class="py-2" style="width: 5%">:</td>
                        <td class="py-2" style="width: 40%">{{($surat_suara != NULL)?$surat_suara->surat_suara_sah:"0"}}</td>
                    </tr>
                    <tr>
                        <td class="py-2 text-start" style="width: 50%">Suara Tidak Sah</td>
                        <td class="py-2" style="width: 5%">:</td>
                        <td class="py-2" style="width: 40%">{{($surat_suara != NULL)?$surat_suara->surat_suara_tidak_sah:"0"}}</td>
                    </tr>
                    <tr>
                        <td class="py-2 text-start" style="width: 50%">Jumlah Suara Sah dan Suara Tidak Sah</td>
                        <td class="py-2" style="width: 5%">:</td>
                        <td class="py-2" style="width: 40%">{{($surat_suara != NULL)?$surat_suara->jumlah_sah_dan_tidak:"0"}}</td>
                    </tr>
                    <tr>
                        <td class="py-2 text-start" style="width: 50%">Total Surat Suara</td>
                        <td class="py-2" style="width: 5%">:</td>
                        <td class="py-2" style="width: 40%">{{($surat_suara != NULL)?$surat_suara->total_surat_suara:"0"}}</td>
                    </tr>
                    <tr>
                        <td class="py-2 text-start" style="width: 50%">Sisa Surat Suara</td>
                        <td class="py-2" style="width: 5%">:</td>
                        <td class="py-2" style="width: 40%">{{($surat_suara != NULL)?$surat_suara->sisa_surat_suara:"0"}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- <div class="row" style="margin-top: 50px;">
        <div class="col-12">
            <div class="alert alert-dark" role="alert">
                <h1 class="mb-0">SISA SURAT SUARA: TPS {{$paslon[0]->saksi_data[0]->number}} / Kelurahan {{$village->name}}: 0</h1>
</div>
</div>
</div> --}}
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