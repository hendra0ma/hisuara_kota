<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card">


            
            <div class="card-body">
                <h3 class="mx-auto text-center text-uppercase">
                    Daftar Pemilih Tetap, <br> {{$wilayah->name}} tahun 2024
                </h3>
                <div class="col-12 mb-3 px-0">
                    <input wire:model="search" type="search" class="form-control border-1 border-dark" placeholder="Search posts by nama...">
                </div>

                <table class="table table-striped">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th class="text-white">
                                No
                            </th>
                            <td>
                                Nama Pemilih
                            </td>
                            <td>
                                Kecamatan
                            </td>
                            <td>
                                Kelurahan
                            </td>
                            <td>
                                TPS
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dpt_i as $i => $dpt)
                        <tr>
                            <th>
                                {{$i+1}}
                            </th>
                            <td>
                                {{$dpt->nama_pemilih}}
                            </td>
                            <td>
                                {{$dpt->district_name}}
                            </td>
                            <td>
                                {{$dpt->village_name}}
                            </td>
                            <td>
                                {{$dpt->tps}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="container">
                    {{$dpt_i->links()}}
                </div>
            </div>
        </div>
    </div>
</div>