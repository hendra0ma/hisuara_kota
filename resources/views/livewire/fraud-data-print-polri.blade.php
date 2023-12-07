<div>
    <div class="row mt-5">
        <div class="col-12 mb-3">
            <input wire:model="search" type="search" class="form-control border-1 border-dark"
                placeholder="Search posts by title...">
        </div>
    </div>

    <div class="row">
        @foreach ($list_suara as $ls)
        <div class="col-xl-3">
            <div class="card">
                <div class="card-header text-white border-0" style="background-color: #404042">
                    <span class="mx-auto py-6 fs-6">
                        BUKTI KECURANGAN SAKSI
                    </span>
                </div>
                <div class="hiasan-1">
                    <div class="gambar-bulat">
                        @if ($ls->profile_photo_path == NULL)
                        <img class="rounded-circle" style="width: 125px; height: 125px; object-fit:cover;"
                            src="https://ui-avatars.com/api/?name={{ $ls->name }}&color=7F9CF5&background=EBF4FF" alt="img">
                        @else
                        <img class="rounded-circle" style="width: 125px; height: 125px; object-fit:cover;" src="{{url("/storage/profile-photos/".$ls->profile_photo_path) }}">
                        @endif
                    </div>
                </div>
                <div class="card-body py-7">
                    <div class="text-center fs-4 fw-bold mb-3">{{$ls->name}}</div>
                    <div class="px-3">
                        <table class="table">
                            <tr>
                                <td class="text-primary fw-bold ps-0">
                                    NIK
                                </td>
                                <td class="px-0">:</td>
                                <td class="ps-2">{{$ls->nik}}</td>
                            </tr>
                            <tr>
                                <td class="text-primary fw-bold ps-0">
                                    No Wa
                                </td>
                                <td class="px-0">:</td>
                                <td class="ps-2">{{$ls->no_hp}}</td>
                            </tr>
                            <tr>
                                <td class="text-primary fw-bold ps-0">
                                    Date
                                </td>
                                <td class="px-0">:</td>
                                <td class="ps-2">{{$ls->date}}</td>
                            </tr>
                        </table>
    
                        <div class="row mt-2">
                            <div class="col-12 px-0">
                                <a onclick="openNewPage()" class="btn w-100 fotoKecuranganterverifikasi mt-2 rounded-0 text-white"
                                    id="Cek" style="background: #ff4f4e">
                                    Cetak Bukti Kecurangan</a>

                                <script>
                                    function openNewPage() {
                                            window.open('{{url('')}}/administrator/print/{{ Crypt::encrypt($ls->tps_id)}}', '_blank');
                                        }
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hiasan-2" style="height: 30px"></div>
                <div class="hiasan-1" style="height: 30px"></div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="mb-4">
        {{$list_suara->links()}}
    </div>
    
    {{-- <div class="row">
    
        @foreach($list_suara as $ls)
        <div class="col-md-6 col-xl-4">
            <div class="card">
                <div class="card-header bg-dark">
                    <div class="card-title text-white">Election Fraud Data Print</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md">
                            @if ($ls->profile_photo_path == NULL)
                            <img class="" style="width: 250px; height: 250px; object-fit:cover"
                                src="https://ui-avatars.com/api/?name={{ $ls->name }}&color=7F9CF5&background=EBF4FF"
                                alt="img">
                            @else
                            <img class="" style="width: 250px; height: 250px; object-fit:cover" src="{{url("/storage/profile-photos/".$ls->profile_photo_path) }}">
                            @endif
                        </div>
                        <div class="col-md">
                            <div class="row mb-2">
                                <div class="col-md-4 fw-bold">NIK</div>
                                <div class="col-md">{{$ls->nik}}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4 fw-bold">Nama</div>
                                <div class="col-md">{{$ls->name}}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4 fw-bold">No Wa</div>
                                <div class="col-md">{{$ls->no_hp}}</div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 fw-bold">Date</div>
                                <div class="col-md">{{$ls->date}}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md fw-bold">
                                    <a href="print/{{ Crypt::encrypt($ls->tps_id)}}"
                                        class="btn w-90 fotoKecuranganterverifikasi mt-2 rounded-0 text-white"
                                        id="Cek" style="background: #ababab">
                                        Print Kecurangan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div> --}}
</div>
