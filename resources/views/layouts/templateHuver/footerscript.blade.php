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

<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>

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
<script>
    $('a.kecamatanModal').on('click', function () {
        let id = $(this).data('id');
        $.ajax({
            url: '{{url("/")}}/huver/ajax/get_kecamatan_tracking',
            type: "GET",
            data: {
                id
            },
            success: function (response) {
                if (response) {
                    $('#container-kecamatan-tracking').html(response);
                }
            }
        });
    });

</script>
<script>
    $('a.cekmodal').on('click', function () {
        let id = $(this).data('id');
        $.ajax({
            url: '{{url("/")}}/huver/ajax/get_verifikasi_saksi',
            type: "GET",
            data: {
                id
            },
            success: function (response) {
                if (response) {
                    $('#container-verifikasi').html(response);
                }
            }
        });
    });

</script>
<script>
    $('a.cekmodalakun').on('click', function () {
        let id = $(this).data('id');
        $.ajax({
            url: '{{url("/")}}/huver/ajax/get_verifikasi_akun',
            type: "GET",
            data: {
                id
            },
            success: function (response) {
                if (response) {
                    $('#container-akun').html(response);
                }
            }
        });
    });

</script>


<script>
    $('a.cekmodalhistory').on('click', function () {
        let id = $(this).data('id');
        $.ajax({
            url: '{{url("/")}}/huver/ajax/get_history_user',
            type: "GET",
            data: {
                id
            },
            success: function (response) {
                if (response) {
                    $('#container-history').html(response);
                }
            }
        });
    });

</script>
<script>
    $('a.fotoKecurangan').on('click', function () {
        let id = $(this).data('id');
        $.ajax({
            url: 'ajax/get_foto_kecurangan',
            type: "GET",
            data: {
                id
            },
            success: function (response) {
                if (response) {
                    $('#container-hukum-foto').html(response);
                }
            }
        });
    });

</script>
<!-- Internal Chat js-->
