<?php

use App\Models\User;
?>

<!-- BACK-TO-TOP -->
<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>



<!-- Modal -->
<div class="modal fade" id="modallockdown" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-danger text-light">
            <div class="modal-header">
                <h5 class="modal-title" id="modallockdownLabel">Lockdown</h5>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger text-dark" role="alert">
                    <h3 class="display-3 text-light">
                        <i class="fas fa-lock-alt fa-3x"></i> LOCKDOWN
                    </h3>
                </div>
            </div>

        </div>
    </div>
</div>

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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.2/velocity.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.2/velocity.ui.min.js"></script>


<script src="{{ url('/') }}/assets/plugins/input-mask/jquery.mask.min.js"></script>
<script src="https://raw.githack.com/thdoan/magnify/master/dist/js/jquery.magnify.js"></script>
<script src="https://raw.githack.com/thdoan/magnify/master/dist/js/jquery.magnify-mobile.js"></script>


@livewireScripts



<script>
    @if($message = Session::get('success'))
   
    Swal.fire({
        title: "Verifikasi Kecurangan",
        text: "{{$message}}",
        icon: "success"
    });

    @endif


    const redirect = function(page) {
        $.ajax({
            url: `{{ url('') }}/administrator/commander-redirect`,
            data: {
                '_token': '{{ csrf_token() }}',
                page,
                user_id: '{{ Auth::user()->id }}'
            },
            type: "post",
            success: function(res) {

            }
        });
    }
    const scrollCommand = function(dist) {
        $.ajax({
            url: `{{ url('') }}/administrator/commander-scroll`,
            data: {
                '_token': '{{ csrf_token() }}',
                dist,
                user_id: '{{ Auth::user()->id }}'
            },
            type: "post",
            success: function(res) {

            }
        });
    }

    const settings = function(set, ini) {

        $.ajax({
            url: `{{ url('') }}/administrator/commander-settings`,
            data: {
                '_token': '{{ csrf_token() }}',
                set,
                itu: ini.checked,
                user_id: '{{ Auth::user()->id }}'
            },
            type: "post",
            success: function(res) {
                location.reload();
            }
        });
    }
    const defaults = function(ini) {

        $.ajax({
            url: `{{ url('') }}/administrator/commander-defaults`,
            data: {
                '_token': '{{ csrf_token() }}',

                itu: ini.checked,
                user_id: '{{ Auth::user()->id }}'
            },
            type: "get",
            dataType: "json",
            success: function(res) {

                window.location.reload()

            }
        });
    }
</script>




<script>
    $(".modal").each(function(l) {
        $(this).on("show.bs.modal", function(l) {
            var o = $(this).attr("data-easein");
            "shake" == o ? $(".modal-dialog").velocity("callout." + o) : "pulse" == o ? $(
                    ".modal-dialog").velocity("callout." + o) : "tada" == o ? $(".modal-dialog")
                .velocity("callout." + o) : "flash" == o ? $(".modal-dialog").velocity("callout." + o) :
                "bounce" == o ? $(".modal-dialog").velocity("callout." + o) : "swing" == o ? $(
                    ".modal-dialog").velocity("callout." + o) : $(".modal-dialog").velocity(
                    "transition." + o)
        })
    });
</script>



@include('layouts.templateCommander.script-command')

<script>
    const buttonkecurangan = $("button.periksa-c1-kecurangan");
    buttonkecurangan.on('click', function() {
        const id = $(this).data('id');
        $.ajax({
            url: "{{ route('verifikator.getKecuranganSaksi') }}",
            data: {
                id
            },
            type: "get",
            dataType: "html",
            success: function(data) {
                $('#container-view-modal-kecurangan').html(data)
            }
        });
    })

    let myModal = new bootstrap.Modal(document.getElementById('modallockdown'), {
        keyboard: false,
        backdrop: "static"
    });



    $(document).ready(function() {

        @if ($config->lockdown == 'yes')
            myModal.show()
        @endif ;
        var pusher = new Pusher('d3492f7a24c6c2d7ed0f', {
            cluster: 'ap1'
        });
        var channel = pusher.subscribe('messages');
        channel.bind('my-event', function(data) {
            show_count(data);
            playSound();
        });

        function show_count(data) {
            $('div.notification-menu').append(`
            <a class="dropdown-item d-flex" href="#">
                <div class="me-3 notifyimg  bg-primary-gradient brround box-shadow-primary">
                    <i class="fe fe-message-square"></i>
                </div>
                <div class="mt-1">
                    <h5 class="notification-label mb-1">${data.message}</h5>
                    <span class="notification-subtext">1 minutes ago</span>
                </div>
            </a>
            `);
        }

        function playSound(url) {
            const audio = new Audio(url);
            audio.play();
            // console.log(audio);
        }
    });
</script>

<script>
    $('.mode-1').on('click', function() {

        $('.tampilan-1').show();

        $('.tampilan-2').hide();
        setTimeout(() => {
            chartmode1.flush()
            chartmode2.flush()
        }, 5);

    })
    $('.mode-2').on('click', function() {
        $('.tampilan-1').hide();

        $('.tampilan-2').show();
        setTimeout(() => {
            chartmode1.flush()
            chartmode2.flush()
        }, 5);
    })

    $('.mode-v-1').on('click', function() {

        $('.tampilan-v-1').show();

        $('.tampilan-v-2').hide();
        setTimeout(() => {
            chartV1.flush()
            chartV2.flush()
        }, 5);

    })
    $('.mode-v-2').on('click', function() {
        $('.tampilan-v-1').hide();

        $('.tampilan-v-2').show();
        setTimeout(() => {
            chartV1.flush()
            chartV2.flush()
        }, 5);
    })
</script>

<script src="https://cdn.jsdelivr.net/npm/exif-js"></script>


</body>

</html>
