

		<!-- JQUERY JS -->
		<script src="../../assets/js/jquery.min.js"></script>

        <!-- C3 CHART JS -->
		<script src="../../assets/plugins/charts-c3/d3.v5.min.js"></script>
		<script src="../../assets/plugins/charts-c3/c3-chart.js"></script>
        
        <!-- JQUERY JS -->
        <script src="../../assets/js/jquery.min.js"></script>
        <!-- C3 CHART JS -->
        
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
        <script>
            var pusher = new Pusher('d3492f7a24c6c2d7ed0f', {
                cluster: 'ap1'
            });
            Pusher.logToConsole = true;
            var commander = pusher.subscribe('pesan');
            const acceptAdminSetting = function(elmnt){
                elmnt = $(elmnt);
                const order = elmnt.data('order');
                const jenis = elmnt.data('jenis');
                const izin = elmnt.data('izin');
                $(elmnt.parent()).html("");
                 $.ajax({
                    url: `{{url('')}}/administrator/commander-settings`,
                    data: {
                        '_token': '{{csrf_token()}}',
                        set:izin,
                        order,
                        itu: 'true'
                    },
                    type: "post",
                    success: function (res) {
                        // $($(this).closest('.col-lg-12')).html('')
                    }
                });
                elment.remove()

            }
            const acceptAdminRedirect = function(elmnt){
                const elment = $(elmnt);
                
                const order = elment.data('order');
                const jenis = elment.data('jenis');
                const izin = elment.data('izin');
                 $.ajax({
                    url: `{{url('')}}/administrator/commander-redirect`,
                    data: {
                        '_token': '{{csrf_token()}}',
                        page : izin,
                        order
                    },
                    type: "post",
                    success: function (res) {
                        // $($(this).closest('.col-lg-12')).html('')
                    }
                });
                elment.remove()
               
            }
            commander.bind('command-event', function (data) {
                const cmd =data.command;
                console.log(cmd)
                if(cmd.jenis){
                    let count = parseInt($('#count-notif').html());
                    $('#count-notif').html(count+1);
                }
                if(cmd.jenis == "setting"){
                    
                    $('div#container-notification').append(`
                        <div class="col-lg-12  mt-2 mb-2">
                           <div class="alert alert-warning" role="alert">
                             Administrator urutan ${cmd.order} ingin mengubah setting <span
                                class="text-info">${cmd.jenis}</span>
                            <button class="btn btn-dark" onclick="acceptAdminSetting(this)" data-order="${cmd.order}"data-jenis="${cmd.jenis}"data-izin="${cmd.izin}">
                                Terima
                            </button>
                            </div>
                        </div>
                    `)
                }else{
                    $('div#container-notification').append(`
                        <div class="col-lg-12  mt-2 mb-2">
                           <div class="alert alert-warning" role="alert">
                             Administrator urutan ${cmd.order} ingin redirect ke halaman <span
                                class="text-info">${cmd.jenis}</span>
                            <button class="btn btn-dark" onclick="acceptAdminRedirect(this)" data-order="${cmd.order}"data-jenis="${cmd.jenis}"data-izin="${cmd.izin}">
                                Terima
                            </button>
                            </div>
                        </div>
                    `)
                }
            });

         



            /*chart-pie*/
            var chart = c3.generate({
                bindto: '#chart-pie', // id of chart wrapper
                data: {
                    columns: [
                        // each columns data

                        <?php foreach($paslon as $pas) : ?>
                        <?php $voice = 0; ?>
                        <?php foreach($pas->saksi_data as $pak) : ?>
                        <?php
                        $voice += $pak ->voice; ?>
                        <?php endforeach ?> ['data<?= $pas->id  ?>', <?= $voice ?> ],

                        <?php endforeach ?>

                    ],
                    type: 'pie', // default type of chart
                    colors: {
                        <?php foreach($paslon as $pas) : ?> 'data<?= $pas->id  ?>' : "<?= $pas->color ?>",
                        <?php endforeach ?>

                    },
                    names: {
                        // name of each serie
                        <?php foreach($paslon as $pas) : ?>

                            'data<?= $pas->id  ?>' : " <?= $pas->candidate ?> | <?= $pas->deputy_candidate ?>",

                        <?php endforeach ?>
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
                size: {
                    height: 250,
                    width: 250
                }
            });
            
            /*chart-pie*/
            var chart = c3.generate({
                bindto: '#chart-donut', // id of chart wrapper
                data: {
                    columns: [
                        // each columns data

                        <?php foreach($paslon as $pas) : ?>
                        <?php $voice = 0; ?>
                        <?php foreach($pas->saksi_data as $pak) : ?>
                        <?php
                        $voice += $pak ->voice; ?>
                        <?php endforeach ?> ['data<?= $pas->id  ?>', <?= $voice ?> ],

                        <?php endforeach ?>

                    ],
                    type: 'pie', // default type of chart
                    colors: {
                        <?php foreach($paslon as $pas) : ?> 'data<?= $pas->id  ?>' : "<?= $pas->color ?>",
                        <?php endforeach ?>

                    },
                    names: {
                        // name of each serie
                        <?php foreach($paslon as $pas) : ?>

                            'data<?= $pas->id  ?>' : " <?= $pas->candidate ?> | <?= $pas->deputy_candidate ?>",

                        <?php endforeach ?>
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
                size: {
                    height: 250,
                    width: 250
                }
            });

        </script>
        <script src="../../assets/plugins/charts-c3/d3.v5.min.js"></script>
        <script src="../../assets/plugins/charts-c3/c3-chart.js"></script>

        <script src="https://kit.fontawesome.com/5e9db0172a.js" crossorigin="anonymous"></script>





        <script>
           const redirect = function(page) {
                $.ajax({
                    url: `{{url('')}}/administrator/commander-redirect`,
                    data: {
                        '_token': '{{csrf_token()}}',
                        page,
                        user_id: '{{Auth::user()->id}}'
                    },
                    type: "post",
                    success: function(res) {

                    }
                });
            }
            const scrollCommand = function(dist) {
                $.ajax({
                    url: `{{url('')}}/administrator/commander-scroll`,
                    data: {
                        '_token': '{{csrf_token()}}',
                        dist,
                        user_id: '{{Auth::user()->id}}'
                    },
                    type: "post",
                    success: function(res) {

                    }
                });
            }

            const settings = function(set, ini) {

                $.ajax({
                    url: `{{url('')}}/administrator/commander-settings`,
                    data: {
                        '_token': '{{csrf_token()}}',
                        set,
                        itu: ini.checked,
                        user_id: '{{Auth::user()->id}}'
                    },
                    type: "post",
                    success: function(res) {

                    }
                });
            }
            const defaults = function(ini) {

                $.ajax({
                    url: `{{url('')}}/administrator/commander-defaults`,
                    data: {
                        '_token': '{{csrf_token()}}',
             
                        itu: ini.checked,
                        user_id: '{{Auth::user()->id}}'
                    },
                    type: "get",
                    dataType : "json",
                    success: function(res) {
                        
                            window.location.reload()
                     
                    }
                });
            }

        </script>

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
        </body>

        </html>
