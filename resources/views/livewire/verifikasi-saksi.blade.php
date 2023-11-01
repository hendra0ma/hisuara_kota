<div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        td {
            padding-top: 7.5px !important;
            padding-bottom: 7.5px !important;
        }

        .card .disabled {
            position: absolute;
            background: rgba(0, 0, 0, 0.25);
            width: 100%;
            height: 100%;
            z-index: 10;
        }

        .police-line {
            top: 50%;
            transform: translateY(-50%);
            width: 100%;
            background: repeating-linear-gradient(45deg, #f9cd1a, #f9cd1a 10px, #404042 10px, #404042 20px);
            position: absolute;
            z-index: 11;
            text-align: center;
            font-weight: bold;
            padding-top: 5px;
            padding-bottom: 5px;
            font-size: 25px
        }

        .inner-police {
            background: #f9cd1a;
        }

        .btn {
            margin-right: 2.5px;
            margin-left: 2.5px;
        }
    </style>
    
    <div class="row">
        <div class="col-12 mb-3">
            <input wire:model="search" type="search" class="form-control border-1 border-dark" placeholder="Search posts by title...">
        </div>
    </div>

    <div class="row">
        @foreach ($saksi_data as $ls)
        <?php $kecamatan = \App\Models\District::where('id',(string)$ls['districts'])->first(); ?>
        <?php $kelurahan = \App\Models\Village::where('id',(string)3674040006)->first(); ?>
        <?php $tps = \App\Models\Tps::where('user_id',$ls['id'])->first(); ?>
        {{-- @if($ls['is_active'] == 0) --}}
        <div class="col-xl-3">
            <div class="card">
                <div class="card-header text-white border-0" style="background-color: #404042">
                    <span class="mx-auto py-6 fs-6">TPS <?php if($tps == null){?> <?php }else{ ?> {{$tps['number']}}<?php } ?> / Kelurahan {{ $kelurahan['name'] }}</span>
                </div>
                <div class="hiasan-1">
                    <div class="gambar-bulat">
                        @if ($ls->profile_photo_path == NULL)
                        <img class="rounded-circle" style="width: 125px; height: 125px; object-fit:cover;" src="https://ui-avatars.com/api/?name={{ $ls->name }}&color=7F9CF5&background=EBF4FF" alt="img">
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
                                    No HP
                                </td>
                                <td class="px-0">:</td>
                                <td class="ps-2">{{$ls->no_hp}}</td>
                            </tr>
                            <tr>
                                <td class="text-primary fw-bold ps-0">
                                    Kecamatan
                                </td>
                                <td class="px-0">:</td>
                                <td class="ps-2">{{$kecamatan['name']}}</td>
                            </tr>
                            <tr>
                                <td class="text-primary fw-bold ps-0">
                                    Kelurahan
                                </td>
                                <td class="px-0">:</td>
                                <td class="ps-2">{{$kelurahan['name']}}</td>
                            </tr>
                            <tr>
                                <td class="text-primary fw-bold ps-0">
                                    Email
                                </td>
                                <td class="px-0">:</td>
                                <td class="ps-2">{{$ls->email}}</td>
                            </tr>
                        </table>
                        
                        <div class="row px-0">

                            <div class="col-md px-0">
                                <form action="action_verifikasi/{{ encrypt($ls['id']) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="aksi" value="{{ encrypt(1) }}">
                                    <button class="btn w-100 rounded-0 btn-success" onclick="konfirmasi(this)" type="button">Diterima</button>
                                </form>
                            </div>

                            <div class="col-md px-0">
                                <form action="action_verifikasi/{{ encrypt($ls['id']) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="aksi" value="{{ encrypt(5) }}">
                                    <button class="btn w-100 rounded-0 btn-danger" onclick="konfirmasi(this)" type="button">Ditolak</button>
                                </form>
                            </div>

                            <div class="col-md px-0">
                                <a href="https://wa.me/{{$ls->no_hp}}" class="btn w-100 text-white btn-info rounded-0">Hubungi</a>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12 px-0">
                                <button class="btn btn-primary rounded-0 w-100 cekmodal" id="Cek" data-id="{{$ls['id']}}" data-bs-toggle="modal" id="" data-bs-target="#cekmodal">Foto E-KTP</button>
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
        {{$saksi_data->links()}}
    </div>
    
    {{-- <button onclick="konfirmasi()"></button> --}}
    <script>
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })  

        function konfirmasi(btn) {
           var form = $(btn).closest("form");
            swalWithBootstrapButtons.fire({
                title: 'Apakah Anda Yakin?',
                text: "Aksi ini tidak bisa di batalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // swalWithBootstrapButtons.fire(
                    //     'Deleted!',
                    //     'success'
                    // )
                    $(form).submit();
                    // console.log(form)
                    
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Perubahan dibatalkan',
                        'error'
                    )
                }
            })  
        }
       
        
    $("#diterima").on('submit', function(e){
               
        })
    </script>

</div>
