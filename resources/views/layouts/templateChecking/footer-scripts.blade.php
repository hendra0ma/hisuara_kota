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

<!-- PIETY CHART JS-->

<!-- INTERNAL SELECT2 JS -->
<script src="../../assets/plugins/select2/select2.full.min.js"></script>

<!-- INTERNAL Data tables js-->
<script src="../../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="../../assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
<script src="../../assets/plugins/datatable/dataTables.responsive.min.js"></script>

<!-- ECART JS-->

<!-- SIDE-MENU JS-->
<script src="../../assets/plugins/sidemenu/sidemenu.js"></script>
<!-- SIDEBAR JS -->
<script src="../../assets/plugins/sidebar/sidebar.js"></script>
<!-- Perfect SCROLLBAR JS-->
<script src="../../assets/plugins/p-scroll/perfect-scrollbar.js"></script>
<script src="../../assets/plugins/p-scroll/pscroll.js"></script>
<script src="../../assets/plugins/p-scroll/pscroll-1.js"></script>
<!-- APEXCHART JS -->
<!-- INDEX JS -->
<script src="../../assets/js/index1.js"></script>
<!-- CUSTOM JS -->
<script src="../../assets/js/custom.js"></script>
<!-- CHART-CIRCLE JS-->
<script src="../../assets/js/circle-progress.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

<script src="../../assets/plugins/input-mask/jquery.mask.min.js"></script>
<script src="https://raw.githack.com/thdoan/magnify/master/dist/js/jquery.magnify.js"></script>
<script src="https://raw.githack.com/thdoan/magnify/master/dist/js/jquery.magnify-mobile.js"></script>
@livewireScripts

<script>
  const buttonperiksaC1 = $("button.periksa-c1-plano");
  const buttonkecurangan = $("button.periksa-c1-kecurangan");
  buttonperiksaC1.on('click', function() {
    const id = $(this).data('id');
    $.ajax({
      url: "{{route('checking.getSaksiData')}}",
      data: {
        "_token": "{{ csrf_token() }}",
        id
      },
      type: "post",
      dataType: "html",
      success: function(data) {
        $('#container-view-modal').html(data)
      }
    });
  })


  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;
  var pusher = new Pusher('d3492f7a24c6c2d7ed0f', {
    cluster: 'ap1'
  });

  var channel = pusher.subscribe('messages');
  channel.bind('my-event', function(data) {
    Livewire.emit('pesanTersimpan')
    document.querySelector("div.container-fluid.chat-container").scrollTop += document.querySelector("div.container-fluid.chat-container").scrollHeight + document.querySelector("div.container-fluid.chat-container").scrollHeight;
  });
</script>
</body>

</html>