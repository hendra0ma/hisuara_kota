<!-- JQUERY JS -->
<script src="../../assets/js/jquery.min.js"></script>
@include('layouts.templateCommander.script-command')

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
@livewireScripts
<script>
    let cekModal = function(el,id){
 // let id = $(this).data('id');
                // console.log(id)
                $.ajax({
                    url: '{{url("/")}}/administrator/ajax/get_verifikasi_saksi',
                    type: "GET",
                    data: {
                        id:id,
                        url: "<?= request()->segment(count(request()->segments())) ?>"
                    },
                    success: function (response) {
                        if (response) {
                            $('#container-verifikasi').html(response);
                        }
                    }
                });
            }

            // $(document).on('click','.cekmodal' ,function () {
               
            // });

</script>

<script>
    // Create a map centered at a specific location and with an initial zoom level
    var map = L.map('lacak_map').setView([-2.2151, 118.2437], 5);

    // Add a tile layer (you can use different providers, e.g., OpenStreetMap)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Array of marker locations
    const tracking = JSON.parse('<?=json_encode($tracking)?>');
    console.log( tracking);
    var markers = [];
    tracking.forEach((item,index)=>{
        // markers.push();
        // console.log(item)
        markers.push({lat:item.latitude, lng:item.longitude, photoUrl:item.profile_photo_path, name:item.name , email:item.email, number:item.no_hp, lastSeen: '2023-11-11'})
    })
    console.log(markers)
    // Loop through the array and add markers to the map
    markers.forEach(function (marker) {
    // Create a marker with a custom popup
    var customPopup = L.popup();
    
    // Set the HTML content for the popup
    customPopup.setContent(`
    <div class="row">
        <div class="col text-center">
            ${
            marker.photoUrl
            ? `<img style="height: 100px; object-fit: cover" src="{{ asset('') }}storage/profile-photos/${marker.photoUrl}"
                alt="Photo">`
            : `<img style="height: 100px; object-fit: cover"
                src="https://ui-avatars.com/api/?name=${marker.name}&color=${marker.name}7F9CF5&background=EBF4FF"
                alt="Placeholder">`
            }
        </div>
        <div class="col-8">
            <table style="width: 100%;">
                <!-- Set a fixed width for the table -->
                <tr>
                    <td><strong>Name:</strong></td>
                    <td><strong>:</strong></td>
                    <td>${marker.name}</td>
                </tr>
                <tr>
                    <td><strong>Email:</strong></td>
                    <td><strong>:</strong></td>
                    <td style="max-width: 150px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">
                        ${marker.email}</td>
                </tr>
                <tr>
                    <td><strong>Number:</strong></td>
                    <td><strong>:</strong></td>
                    <td>${marker.number}</td>
                </tr>
                <tr>
                    <td><strong>Last Seen:</strong></td>
                    <td><strong>:</strong></td>
                    <td>${marker.lastSeen}</td>
                </tr>
            </table>
        </div>
    </div>
    `);
    
    // Attach the custom popup to the marker
    L.marker([marker.lat, marker.lng]).addTo(map).bindPopup(customPopup);
    });

    // Create an array of LatLng objects from marker coordinates
    var markerLatLngs = markers.map(marker => L.latLng(marker.lat, marker.lng));
    
    // Fit the bounds of the map to include all markers
    map.fitBounds(L.latLngBounds(markerLatLngs));
</script>