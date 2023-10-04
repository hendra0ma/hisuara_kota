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

    <!-- INTERNAL Data tables js-->
    <script src="../../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="../../assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
    <script src="../../assets/plugins/datatable/dataTables.responsive.min.js"></script>

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

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>

    <!-- CHART-CIRCLE JS-->
    <script src="../../assets/js/circle-progress.min.js"></script>

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>

    <!-- CHART-CIRCLE JS-->
    <script src="../../assets/js/circle-progress.min.js"></script>
    <script>
    var map = L.map('map').setView([-6.261223099846002, 106.69325190584601], 9);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    @foreach ($tracking as $track)
    <?php $user = User::where('id',$track['id_user'])->first(); ?>
    L.marker([{{$track['latitude']}},{{$track['longitude']}}]).bindPopup('{{$user['name']}}').addTo(map);
    @endforeach

</script>

    
<!-- C3 CHART JS -->
<script src="../../assets/plugins/charts-c3/d3.v5.min.js"></script>
<script src="../../assets/plugins/charts-c3/c3-chart.js"></script>
    
<script>
    /*chart-pie*/
    var chart = c3.generate({
        bindto: '#chart-donut', // id of chart wrapper
        data: {
            columns: [
                // each columns data
              
           <?php foreach($paslon_terverifikasi as $pas):  ?>
            <?php $voice = 0;  ?>
            <?php foreach($pas->saksi_data as $pak):  ?>
                 <?php
                $voice += $pak->voice;
                ?>
            <?php endforeach  ?>
            ['data<?= $pas->id  ?>', <?=  $voice ?>],
          
           <?php endforeach  ?>
              
            ],
            type: 'donut', // default type of chart
            colors: {
              <?php foreach($paslon_terverifikasi as $pas):  ?>
            'data<?= $pas->id  ?>': "<?=  $pas->color ?>",
           <?php endforeach  ?>
              
            },
            names: {
                // name of each serie
               <?php foreach($paslon_terverifikasi as $pas):  ?>
            
                'data<?= $pas->id  ?>':" <?=  $pas->candidate ?>",
          
           <?php endforeach  ?>
            }
        },
        axis: {},
        legend: {
            show: true, //hide legend
        },
        padding: {
            bottom: 0,
            top: 0
        },
    });

</script>

<script>
    /*chart-pie*/
    var chart = c3.generate({
        bindto: '#chart-pie', // id of chart wrapper
         data: {
            columns: [
                // each columns data
              
           <?php foreach($paslon as $pas):  ?>
            <?php $voice = 0;  ?>
            <?php foreach($pas->saksi_data as $pak):  ?>
                 <?php
                $voice += $pak->voice;
                ?>
            <?php endforeach  ?>
            ['data<?= $pas->id  ?>', <?=  $voice ?>],
         
           <?php endforeach  ?>
              
            ],
            type: 'pie', // default type of chart
            colors: {
              <?php foreach($paslon as $pas):  ?>
            'data<?= $pas->id  ?>': "<?=  $pas->color ?>",
           <?php endforeach  ?>
              
            },
            names: {
                // name of each serie
               <?php foreach($paslon as $pas):  ?>
            
                'data<?= $pas->id  ?>':" <?=  $pas->candidate ?>",
          
           <?php endforeach  ?>
            }
        },
        axis: {},
        legend: {
            show: true, //hide legend
        },
        padding: {
            bottom: 0,
            top: 0
        },
    });

</script>

<!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>

    <!-- CHART-CIRCLE JS-->
    <script src="../../assets/js/circle-progress.min.js"></script>

    <script>
        function openPage(pageName, elmnt, color) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].style.backgroundColor = "";
            }
            document.getElementById(pageName).style.display = "block";
            elmnt.style.backgroundColor = color;
        }

        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();

    </script>

    <!-- SWEET-ALERT JS -->
    <script src="../../assets/plugins/sweet-alert/sweetalert.min.js"></script>
    <script src="../../assets/js/sweet-alert.js"></script>
    <script>
        $('.c1saksi').click(function () {
            $('body').removeClass('timer-alert');
            swal({
                title: "C1 Saksi",
                text: "C1 Saksi adalah hasil perhitungan suara di TPS yang dikirimkan oleh saksi resmi partai.",
                type: "warning",
                confirmButtonText: 'Ok',
            });
        })

    </script>

    <script>
        $('.c1relawan').click(function () {
            $('body').removeClass('timer-alert');
            swal({
                title: "C1 Relawan",
                text: "C1 Relawan adalah hasil perhitungan suara di TPS yang dikirimkan oleh relawan.",
                type: "warning",
                confirmButtonText: 'Ok',
            });
        })

    </script>

    <script>
        $('.c1saksipend').click(function () {
            $('body').removeClass('timer-alert');
            swal({
                title: "C1 Saksi (Pending)",
                text: "C1 Saksi (Pending) adalah kiriman data TPS dari saksi yang tertahan karena adanya data C1 dari TPS yang sama telah dikirimkan oleh Relawan setempat. Hal ini biasanya terjadi karena C1 Saksi terlambat dikirimkan dan atau tidak adanya Saksi di TPS tersebut.",
                type: "warning",
                confirmButtonText: 'Ok',
            });
        })

    </script>

    <script>
        $('.c1relawanband').click(function () {
            $('body').removeClass('timer-alert');
            swal({
                title: "C1 Relawan (Banding)",
                text: "C1 Banding adalah data C1 yang berbeda di TPS yang sama. Kiriman C1 Banding berasal dari masyarakat / relawan untuk dibandingkan dengan C1 Saksi.",
                type: "warning",
                confirmButtonText: 'Ok',
            });
        })

    </script>

    <script src="../../assets/plugins/input-mask/jquery.mask.min.js"></script>

    <script src="https://raw.githack.com/thdoan/magnify/master/dist/js/jquery.magnify.js"></script>
    <script src="https://raw.githack.com/thdoan/magnify/master/dist/js/jquery.magnify-mobile.js"></script>

    <script>
        $(document).ready(function () {
            $('.zoom').magnify();
        });

    </script>

</body>

</html>
