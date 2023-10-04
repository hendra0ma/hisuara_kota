        <!-- JQUERY JS -->
        <script src="../../assets/js/jquery.min.js"></script>

        <!-- BOOTSTRAP JS -->
        <script src="../../assets/plugins/bootstrap/js/popper.min.js"></script>
        <script src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

        <!-- SPARKLINE JS-->
        <script src="../../assets/js/jquery.sparkline.min.js"></script>

        <!-- CHART-CIRCLE JS-->
        <script src="../../assets/js/circle-progress.min.js"></script>

        <!-- CHARTJS CHART JS-->
        <script src="../../assets/plugins/chart/Chart.bundle.js"></script>
        <script src="../../assets/plugins/chart/utils.js"></script>

        <!-- PIETY CHART JS-->
        <script src="../../assets/plugins/peitychart/jquery.peity.min.js"></script>
        <script src="../../assets/plugins/peitychart/peitychart.init.js"></script>

        <!-- INTERNAL SELECT2 JS -->
        <script src="../../assets/plugins/select2/select2.full.min.js"></script>
        <script src="../../assets/plugins/sweet-alert/sweetalert.min.js"></script>
        <!-- DATA TABLE JS-->
        <script src="../../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
        <script src="../../assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
        <script src="../../assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
        <script src="../../assets/plugins/datatable/js/buttons.bootstrap5.min.js"></script>
        <script src="../../assets/plugins/datatable/js/jszip.min.js"></script>
        <script src="../../assets/plugins/datatable/pdfmake/pdfmake.min.js"></script>
        <script src="../../assets/plugins/datatable/pdfmake/vfs_fonts.js"></script>
        <script src="../../assets/plugins/datatable/js/buttons.html5.min.js"></script>
        <script src="../../assets/plugins/datatable/js/buttons.print.min.js"></script>
        <script src="../../assets/plugins/datatable/js/buttons.colVis.min.js"></script>
        <script src="../../assets/plugins/datatable/dataTables.responsive.min.js"></script>
        <script src="../../assets/plugins/datatable/responsive.bootstrap5.min.js"></script>
        <script src="../../assets/js/table-data.js"></script>

        <!-- ECHART JS-->
        <script src="../../assets/plugins/echarts/echarts.js"></script>

        <!-- SIDE-MENU JS-->
        <script src="../../assets/plugins/sidemenu/sidemenu.js"></script>

        <!-- SIDEBAR JS -->
        <script src="../../assets/plugins/sidebar/sidebar.js"></script>

        <!-- Perfect SCROLLBAR JS-->
        <script src="../../assets/plugins/p-scroll/perfect-scrollbar.js"></script>
        <script src="../../assets/plugins/p-scroll/pscroll.js"></script>
        <script src="../../assets/plugins/p-scroll/pscroll-1.js"></script>

        <!-- APEXCHART JS -->
        <script src="../../assets/js/apexcharts.js"></script>

        <!-- INDEX JS -->
        <script src="../../assets/js/index1.js"></script>

        <!-- CUSTOM JS -->
        <script src="../../assets/js/custom.js"></script>

        <!-- C3 CHART JS -->
        <script src="../../assets/plugins/charts-c3/d3.v5.min.js"></script>
        <script src="../../assets/plugins/charts-c3/c3-chart.js"></script>

        <!-- Make sure you put this AFTER Leaflet's CSS -->
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

        <!-- CHART-CIRCLE JS-->
        <script src="../../assets/js/circle-progress.min.js"></script>
        <script src="../../assets/js/chat.js"></script>

        <!-- GALLERY JS -->
        <script src="../../assets/plugins/gallery/picturefill.js"></script>
        <script src="../../assets/plugins/gallery/lightgallery.js"></script>
        <script src="../../assets/plugins/gallery/lightgallery-1.js"></script>
        <script src="../../assets/plugins/gallery/lg-pager.js"></script>
        <script src="../../assets/plugins/gallery/lg-autoplay.js"></script>
        <script src="../../assets/plugins/gallery/lg-fullscreen.js"></script>
        <script src="../../assets/plugins/gallery/lg-zoom.js"></script>
        <script src="../../assets/plugins/gallery/lg-hash.js"></script>
        <script src="../../assets/plugins/gallery/lg-share.js"></script>
        @include('layouts.templateCommander.script-command')
<script>
$(document).ready(function(){
  $("#panggil").click(function(){
    $("#card1").hide();
       $("#card2").show();
        $("#panggil").hide();
              $("#batalkan").show();
  });
    $("#batalkan").click(function(){
    $("#card1").show();
       $("#card2").hide();
        $("#panggil").show();
              $("#batalkan").hide();
  });
});
</script>
        <script>
               var chart = c3.generate({
                bindto: '#chart-pie', // id of chart wrapper
                data: {
                    columns: [
                         <?php $i = 1 ?>
                                    <?php foreach ($index_tsm as $item): ?>
                                        <?php    if($item->jenis !=0){
                                            continue;
                                        } ?>
                                        <?php
                                    $totalKec =  App\Models\Bukti_deskripsi_curang::join('list_kecurangan','list_kecurangan.id','=','bukti_deskripsi_curang.list_kecurangan_id')
                                    ->where('bukti_deskripsi_curang.list_kecurangan_id',$item->id)
                                    ->where('list_kecurangan.jenis',0)
                                    ->count();
                                    $jumlahSaksi = App\Models\Saksi::where('kecurangan',"yes")->count();
                                    $persen = ($totalKec/ $jumlahSaksi)*100;
                                      ?>
                                      ['{{$i++}}',<?=$persen?>],
                                    <?php endforeach ?>
                    ],
                                type: 'pie',
                },
                axis: {},
                legend: {
                    show: true, //hide legend
                },
                padding: {
                    bottom: 0,
                    top: 0
                },
                size: {
                    height: 250,
                    width: 250
                }
            });
               var chart2 = c3.generate({
                bindto: '#chart-donut', // id of chart wrapper
                data: {
                    columns: [
                         <?php $i = 1 ?>
                                    <?php foreach ($index_tsm as $item): ?>
                                        <?php    if($item->jenis !=1){
                                            continue;
                                        } ?>
                                        <?php
                                    $totalKec =  App\Models\Bukti_deskripsi_curang::join('list_kecurangan','list_kecurangan.id','=','bukti_deskripsi_curang.list_kecurangan_id')
                                    ->where('bukti_deskripsi_curang.list_kecurangan_id',$item->id)
                                    ->where('list_kecurangan.jenis',1)
                                    ->count();
                                    $jumlahSaksi = App\Models\Saksi::where('kecurangan',"yes")->count();
                                    $persen = ($totalKec/ $jumlahSaksi)*100;
                                      ?>
                                      ['{{$i++}}',<?=$persen?>],
                                    <?php endforeach ?>
                    ],
                                type: 'donut',
                },
                axis: {},
                legend: {
                    show: true, //hide legend
                },
                padding: {
                    bottom: 0,
                    top: 0
                },
                size: {
                    height: 250,
                    width: 250
                }
            });
        </script>
        


        @livewireScripts
        @if ($message = Session::get('success'))
        <script>
            $(document).ready(function() {
                swal('Berhasil Terverifikasi!', 'Data TPS Kecurangan Berada Di Tab Terverifikasi', 'success');
            });
        </script>
        @endif
        @if ($message = Session::get('error'))
        <script>
            $(document).ready(function() {
                swal('Berhasil Ditolak!', 'Data TPS Kecurangan Berada Di Tab Ditolak', 'danger');
            });
        </script>
        @endif
        <script>
            $('a.fotoKecuranganterverifikasi').on('click', function() {
                let id = $(this).data('id');
                $.ajax({
                    url: 'ajax/get_fotoKecuranganterverifikasi',
                    type: "GET",
                    data: {
                        id
                    },
                    success: function(response) {
                        if (response) {
                            $('#container-hukum-verifikasi').html(response);
                        }
                    }
                });
            });
        </script>
        <script>
            $('a.fotoKecuranganditolak').on('click', function() {
                let id = $(this).data('id');
                $.ajax({
                    url: 'ajax/get_fotoKecuranganditolak',
                    type: "GET",
                    data: {
                        id
                    },
                    success: function(response) {
                        if (response) {
                            $('#container-hukum-ditolak').html(response);
                        }
                    }
                });
            });
        </script>
        <script>
            $('a.fotoKecurangan').on('click', function() {
                let id = $(this).data('id');
                $.ajax({
                    url: 'ajax/get_foto_kecurangan',
                    type: "GET",
                    data: {
                        id
                    },
                    success: function(response) {
                        if (response) {
                            $('#container-hukum-foto').html(response);
                        }
                    }
                });
            });
        </script>
        <script>
            $('a.videoKecurangan').on('click', function() {
                let id = $(this).data('id');
                $.ajax({
                    url: 'ajax/get_vidio_kecurangan',
                    type: "GET",
                    data: {
                        id
                    },
                    success: function(response) {
                        if (response) {
                            $('#container-hukum-vidio').html(response);
                        }
                    }
                });
            });
        </script>
        <script>
            $('a.listkecurangan').on('click', function() {
                let id = $(this).data('id');
                $.ajax({
                    url: 'ajax/get_list_kecurangan',
                    type: "GET",
                    data: {
                        id
                    },
                    success: function(response) {
                        if (response) {
                            $('#container-hukum-list').html(response);
                        }
                    }
                });
            });
        </script>
        <!-- Internal Chat js-->