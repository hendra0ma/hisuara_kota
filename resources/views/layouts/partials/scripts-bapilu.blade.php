<?php

use App\Models\User;
?>

<!-- BACK-TO-TOP -->
<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

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
<!-- INTERNAL Notifications js -->
<script src="../../assets/plugins/notify/js/rainbow.js"></script>
<script src="../../assets/plugins/notify/js/sample.js"></script>
<script src="../../assets/plugins/notify/js/jquery.growl.js"></script>
<script src="../../assets/plugins/notify/js/notifIt.js"></script>

<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@livewireScripts
@include('layouts.templateCommander.script-command')

<script>
    $(document).ready(function() {
        Pusher.logToConsole = true;
        var pusher = new Pusher('d3492f7a24c6c2d7ed0f', {
            cluster: 'ap1'
        });
        var channel = pusher.subscribe('messages');
        channel.bind('my-event', function(data) {
            show_count(data);
            playSound();
        });

        function show_count(data) {
            notif({
                type: "success",
                msg: data.message,
                width: "all",
                height: 70,
                position: "center"
            });
        }

        function playSound(url) {
            const audio = new Audio(url);
            audio.play();
            console.log(audio);
        }
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
                axis: {
                    rotated: true
                },
                legend: {
                    show: true, //hide legend
                },
                padding: {
                    bottom: 0,
                    top: 0
                },
                size: {
                    height: 300,
                    width: 300
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
                    height: 300,
                    width: 300
                }
            });
               var chart2 = c3.generate({
                bindto: '#chart-donut-et', // id of chart wrapper
                data: {
                    columns: [
                         <?php $i = 1 ?>
                                    <?php foreach ($index_tsm as $item): ?>
                                        <?php    if($item->jenis !=2){
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
                    height: 300,
                    width: 300
                }
            });
        </script>


</body>

</html>
