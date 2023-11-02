@include('layouts.partials.head')
@include('layouts.partials.sidebar-log')
@include('layouts.partials.header')

<!-- PAGE-HEADER -->
<div class="row mt-5">
    <div class="col-lg">
        <h1 class="page-title fs-1 mt-2">Verifikasi Saksi
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                {{ $kota->name }}
                <!-- Kota -->
            </li>
        </ol>
    </div>
</div>

<hr style="border: 1px solid">

<div class="col-lg-12" style="margin-top: 50px">

    <div class="card">
        <div class="card-body">
            <div class="table-responsive export-table">
                <table class="table w-100" id="file-datatable">
                    <thead class="bg-primary">
                        <tr>
                            <th class="text-white">no</th>
                            <th class="text-white">Foto Profil</th>
                            <th class="text-white">Nama</th>
                            <th class="text-white">Email</th>
                            <th class="text-white">History</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;  ?>
                        @foreach ($history as $item)
                        <tr>
                            <td>{{$i++}}</td>
                            <td class="text-center">
                                @if ($item['profile_photo_path'] == NULL)
                                <img class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;" src="https://ui-avatars.com/api/?name={{ $item['name'] }}&color=7F9CF5&background=EBF4FF">
                                @else
                                <img class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;" src="{{url("/storage/profile-photos/".$item['profile_photo_path']) }}">
                                @endif
                            </td>
                            <td class="align-middle">{{$item['name']}}</td>
                            <td class="align-middle">{{$item['email']}}</td>
                            <td class="align-middle">{{$item['action']}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>



@include('layouts.partials.footer')
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
@include('layouts.templateCommander.script-command')
</body>

</html>