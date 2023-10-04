<?php
use App\Models\User;
?>

<!-- BACK-TO-TOP -->
<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

<!-- JQUERY JS -->
<script src="<?= url('/') ?>/assets/js/jquery.min.js"></script>

<!-- BOOTSTRAP JS -->
<script src="<?= url('/') ?>/assets/plugins/bootstrap/js/popper.min.js"></script>
<script src="<?= url('/') ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- SPARKLINE JS-->
<script src="<?= url('/') ?>/assets/js/jquery.sparkline.min.js"></script>

<!-- CHART-CIRCLE JS-->
<script src="<?= url('/') ?>/assets/js/circle-progress.min.js"></script>

<!-- CHARTJS CHART JS-->
<script src="<?= url('/') ?>/assets/plugins/chart/Chart.bundle.js"></script>
<script src="<?= url('/') ?>/assets/plugins/chart/utils.js"></script>

<!-- PIETY CHART JS-->
<script src="<?= url('/') ?>/assets/plugins/peitychart/jquery.peity.min.js"></script>
<script src="<?= url('/') ?>/assets/plugins/peitychart/peitychart.init.js"></script>

<!-- INTERNAL SELECT2 JS -->
<script src="<?= url('/') ?>/assets/plugins/select2/select2.full.min.js"></script>

<!-- INTERNAL Data tables js-->
<script src="<?= url('/') ?>/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?= url('/') ?>/assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
<script src="<?= url('/') ?>/assets/plugins/datatable/dataTables.responsive.min.js"></script>

<!-- ECHART JS-->
<script src="<?= url('/') ?>/assets/plugins/echarts/echarts.js"></script>

<!-- SIDE-MENU JS-->
<script src="<?= url('/') ?>/assets/plugins/sidemenu/sidemenu.js"></script>

<!-- SIDEBAR JS -->
<script src="<?= url('/') ?>/assets/plugins/sidebar/sidebar.js"></script>

<!-- Perfect SCROLLBAR JS-->
<script src="<?= url('/') ?>/assets/plugins/p-scroll/perfect-scrollbar.js"></script>
<script src="<?= url('/') ?>/assets/plugins/p-scroll/pscroll.js"></script>
<script src="<?= url('/') ?>/assets/plugins/p-scroll/pscroll-1.js"></script>

<!-- APEXCHART JS -->
<script src="<?= url('/') ?>/assets/js/apexcharts.js"></script>
@include('layouts.templateCommander.script-command')

<!-- INDEX JS -->
<script src="<?= url('/') ?>/assets/js/index1.js"></script>

<!-- CUSTOM JS -->
<script src="<?= url('/') ?>/assets/js/custom.js"></script>

<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>

<!-- CHART-CIRCLE JS-->
<script src="<?= url('/') ?>/assets/js/circle-progress.min.js"></script>

<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>

<!-- CHART-CIRCLE JS-->
<script src="<?= url('/') ?>/assets/js/circle-progress.min.js"></script>


<!-- C3 CHART JS -->
<script src="<?= url('/') ?>/assets/plugins/charts-c3/d3.v5.min.js"></script>
<script src="<?= url('/') ?>/assets/plugins/charts-c3/c3-chart.js"></script>



<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>

<!-- CHART-CIRCLE JS-->
<script src="<?= url('/') ?>/assets/js/circle-progress.min.js"></script>



<!-- SWEET-ALERT JS -->
<script src="<?= url('/') ?>/assets/plugins/sweet-alert/sweetalert.min.js"></script>
<script src="<?= url('/') ?>/assets/js/sweet-alert.js"></script>


<script src="<?= url('/') ?>/assets/plugins/input-mask/jquery.mask.min.js"></script>

<script src="https://raw.githack.com/thdoan/magnify/master/dist/js/jquery.magnify.js"></script>
<script src="https://raw.githack.com/thdoan/magnify/master/dist/js/jquery.magnify-mobile.js"></script>

<script src="<?= url('/') ?>/assets/plugins/leaflet/leaflet.js"></script>
<script src="<?= url('/') ?>/js/geojson.ajax.js"></script>

<script>
    var cities = L.layerGroup();
    

    <?php foreach($tracking as $track):?>
    <?php  $user = User::where('id',$track['id_user'])->first();?>
    var text<?= $user['id'] ?> = '<div class="row"><div class="col-4"><img src="' + '<?php if($user["profile_photo_path"] == NULL){ echo "https://ui-avatars.com/api/?name=' + '".$user["name"]."' +'&color=7F9CF5&background=EBF4FF"; }else{ echo url("/storage/profile-photos/".$user["profile_photo_path"]); } ?>' + '" class="'+ 'img-fluid' + '"  width="150px" height="auto" /></div>   <div class="col-8"><table>' + '<tr><td>Nama</td><td>:</td><td>' + '<?= $user["name"] ?>' + '</td></tr>' + '<tr><td>Email</td><td>:</td><td>' + '<?= $user["email"]?>' + '</td></tr>' + '<tr><td>Nomor</td><td>:</td><td>' + '<?= $user["no_hp"]?>' + '</td></tr>' + '<tr><td>Last Seen</td><td>:</td><td>' + '    {{ \Carbon\Carbon::parse($user["last_seen"])->diffForHumans() }}' + '</td></tr>' + '</table>  </div> </div>';
    L.marker([{{ $track['latitude']}}, {{ $track['longitude']}}]).bindPopup(text<?= $user['id'] ?>).addTo(cities);   
    <?php endforeach;?>

    var mbAttr = '',
        mbUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiaXNhYTIxIiwiYSI6ImNsZnc5dmQ3NDBmMjUzcW8zZzg0c2RnazgifQ.mphOBqpgqHl5ONLL092Txw';
    var grayscale = L.tileLayer(mbUrl, {
            maxZoom: 20,
            id: 'mapbox/satellite-v9',
            tileSize: 512,
            zoomOffset: -1

        }),
        streets = L.tileLayer(mbUrl, {
            maxZoom: 20,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            attribution: mbAttr
        });
        <?php foreach($tracking as $track):?>
    var map = L.map('mapid', {
        center: [{{ $track['latitude']}}, {{ $track['longitude']}}],
        zoom: 12,
        layers: [streets, cities]
    });
    <?php endforeach;?>

    fetch("<?= url('/geojson/tangsel.json');?>").then(response => response.json())
        .then(json => {
            console.log(json.features)
            L.geoJSON(json.features[7]).addTo(map);
        });
    let i = 0;
    var baseLayers = {
        "Track": streets,
        "Satelit": grayscale,
    };

    var overlays = {
        "Cities": cities
    };

    L.control.layers(baseLayers, overlays).addTo(map);
   
</script>
</body>

</html>
