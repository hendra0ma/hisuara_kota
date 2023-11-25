<div>
    <h4 class="fw-bold fs-4 mt-5 mb-0">
        Jumlah Peserta Sidang : {{$jumlah_peserta_sidang}}
    </h4>
    <hr style="border: 1px solid">
    
    <div class="row">
        <div class="col-12 mb-3">
            <input wire:model="search" type="search" class="form-control border-1 border-dark"
                placeholder="Search posts by title...">
        </div>
    </div>

    <div class="row">
        @foreach($list_suara as $ls)
        
        <?php
                $qr_code =  App\Models\Qrcode::where('tps_id',$ls->tps_id)->first();
                
                $scan_url = "" . url('/') . "/scanning-secure/" . Crypt::encrypt($qr_code['nomor_berkas']) . ""; ?>
        <div class="col-md-6 col-xl-4">
            <a id="Cek" data-bs-toggle="modal" onclick="qrsidang(this)" data-bs-target="#modalQrCode" data-id="{{$ls->tps_id}}"
                href="#">
                <div class="card">
                    @if ($tag == 2)
                    @if ($ls->makamah_konsitusi == "Ditolak")
                    <div class="ribbone">
                        <div class="ribbon"><span>{{ $ls->makamah_konsitusi }}</span></div>
                    </div>
                    @elseif ($ls->makamah_konsitusi == "Panggil")
                    <div class="ribbone">
                        <div class="ribbon"><span>{{ $ls->makamah_konsitusi }}</span></div>
                    </div>
                    @elseif ($ls->makamah_konsitusi == "Tidak Menjawab")
                    <div class="ribbone">
                        <div class="ribbon"><span>{{ $ls->makamah_konsitusi }}</span></div>
                    </div>
                    @elseif ($ls->makamah_konsitusi == "Selesai")
                    <div class="ribbone">
                        <div class="ribbon"><span>{{ $ls->makamah_konsitusi }}</span></div>
                    </div>
                    @else
                
                    @endif
                
                
                    @endif
                
                    <div class="card-header bg-primary">
                        <div class="card-title text-white">Saksi Pelapor : {{$ls['name']}}</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md text-center">
                                @if ($ls->profile_photo_path == NULL)
                                <img class="" style="width: 175px;"
                                    src="https://ui-avatars.com/api/?name={{ $ls->name }}&color=7F9CF5&background=EBF4FF" alt="img">
                                @else
                                <img class="" style="width: 175px;" src="{{url("/storage/profile-photos/".$ls->profile_photo_path)
                                }}">
                                @endif
                            </div>
                            <div class="col-6 my-auto text-center">
                                <?php $village = App\Models\Village::where('id', $ls->village_id)->first(); ?>
                                <div class="mb-0 fw-bold" style="font-size: 25px">{{ $ls['name'] }}</div>
                                <div style="font-size: 15px">NIK : {{ $ls['nik'] }}</div>
                                <div style="font-size: 15px">SAKSI TPS {{ $ls['number'] }}</div>
                                <div style="font-size: 15px">KELURAHAN {{ $village['name'] }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
        
        {{-- <script>
            let qrsidang = function(ini){
                        let id_tps = $(ini).data('id');
                        $.ajax({
                            url : "{{url('')}}/administrator/get_qrsidang",
                            data : {
                                    id_tps,
                                },
                            type : 'GET',
                            success : function(response){
                                document.querySelector('div#qrSidang').innerHTML = response;
                            }
                        })
                    }
        </script>
        <script>
            let sidang_online = function(ini){
                        let id_tps = $(ini).data('id');
                        $.ajax({
                            url : "{{url('')}}/administrator/get_sidang_online",
                            data : {
                                    id_tps,
                                },
                            type : 'GET',
                            success : function(response){
                                document.querySelector('div#qrSidangOnline').innerHTML = response;
                            }
                        })
                    }
        </script> --}}
    </div>
</div>
