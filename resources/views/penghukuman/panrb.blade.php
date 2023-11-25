@include('layouts.partials.head')
@include('layouts.partials.sidebar')
<?php
$solution = \App\Models\SolutionFraud::get();
?>

@include('layouts.partials.header')

<div class="row" style="margin-top: 90px; transition: all 0.5s ease-in-out;">
    <div class="col-lg">
        @if ($message = Session::get('success'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
        </div>
        @endif

        <h1 class="page-title fs-1 mt-2">Pelanggaran Aparatur Sipil Negara
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">{{ $kota->name }}
                <!-- Kota -->
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-danger">
                        <center>
                            <h4 class="mx-auto fw-bold text-white mb-0">
                                PELANGGARAN APARATUR SIPIL NEGARA
                            </h4>
                        </center>
                    </div>
                    <div class="card-body">
                        <center>
                            <div id="chart-donut-et"></div>
                        </center>
                        <div class="table-responsive">
                            <table
                                class="table table-bordered text-nowrap border-bottom dataTable no-footer table-striped table-hover datable"
                                role="grid" id="responsive-datatable_info">
                                <thead class="bg-dark">
                                    <tr>
                                        <th class="text-white">No</th>
                                        <th class="text-white">Kode</th>
                                        <th class="text-white">Persentase</th>
                                        <th class="text-white">Kecurangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>
                                    @foreach ($index_tsm as $item)
                                    <?php if ($item->jenis != 3) {
                                                            continue;
                                                        } ?>
                                    <tr>
                                        <?php
            
                                                            $totalKec =  App\Models\Bukti_deskripsi_curang::join('list_kecurangan', 'list_kecurangan.id', '=', 'bukti_deskripsi_curang.list_kecurangan_id')
                                                                 ->join('saksi', 'saksi.tps_id', '=', 'bukti_deskripsi_curang.tps_id')
                                                                 ->where('saksi.status_kecurangan', "terverifikasi")
                                                                ->where('bukti_deskripsi_curang.list_kecurangan_id', $item->id)
                                                                ->where('list_kecurangan.jenis', 1)
                                                                ->count();
                                                           $jumlahSaksi =        App\Models\Saksi::whereNull('pending')->count();
                                                            $persen = ($totalKec / $jumlahSaksi) * 100;
                                                            ?>
                                        <td>{{ $i++ }}</td>
                                        <td>{{$item->kode}}</td>
                                        <td>{{substr($persen,0,4)}}%</td>
                                        <td>{{ $item['kecurangan'] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    $('a.fotoKecuranganterverifikasi').on('click', function () {
        let id = $(this).data('id');
        $.ajax({
            url: `{{route('superadmin.ajaxKecuranganTerverifikasi')}}`,
            type: "GET",
            data: {
                id
            },
            success: function (response) {
                if (response) {
                    $('#container-hukum-verifikasi').html(response);
                }
            }
        });
    });

</script>


<script>
    $(document).ready(function () {
        $('#responsive-datatable_info').dataTable({
            "pageLength": 50
        });
    });

</script>
@include('layouts.partials.footer')
@include('layouts.partials.scripts-bapilu')