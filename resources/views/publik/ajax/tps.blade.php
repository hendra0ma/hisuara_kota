<div class="modal-header">
    <h5 class="modal-title">Kecamatan {{$kecamatan['name']}} / Kelurahan {{$kelurahan['name']}} / TPS {{$tps['number']}}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
</div>
<div class="modal-body">
    @if($config->show_public == "show")
    <div class="row">
        <!--<div class="col-lg-6">-->
        <!--    <button type="button" class="btn btn-block btn-secondary">Unduh Salinan</button>-->
        <!--</div>-->
        <div class="col-lg-12">
            <button type="button" class="btn btn-block btn-primary" data-bs-toggle="modal" data-bs-target="#banding-c1">Banding C1</button>
        </div>
    </div>
    @endif
 
    @if($config->show_public == "show")
    <div class="page pinch-zoom-parent">
        <div class="pinch-zoom-container" style="overflow: hidden; position: relative; height: 750px;">
            <div class="pinch-zoom" style="transform-origin: 0% 0%; position: absolute; transform: scale(0.796178, 0.796178) translate(804.184px, 0px);">
                <img src="{{asset('storage'.'/'.$saksi[0]->c1_images)}}" alt="" srcset="">
            </div>
        </div>
    </div>
    @else
    <div class="alert alert-danger" role="alert">
        Data C1 tidak/belum ditampilkan sesuai dengan kebijakan Admin.
    </div>
    @endif

   
   
</div>
<div class="modal-footer">

</div>
@if($config->show_public == "show")
<script src="../../assets/js/pinch-to-zoom.js"></script>

<script type="text/javascript">
    var el = document.querySelector('div.pinch-zoom');
    new PinchZoom.default(el, {});
</script>
@endif



<div class="modal fade" id="banding-c1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="banding-c1">Banding C1</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>
            Halaman ini merupakan fitur banding C1, dimana jika Anda menemukan data C1 yang berbeda dari data C1 yang ada pada Rekapitung Anda dapat melakukan banding dengan mengirimkan C1 tersebut pada Formulir ini.
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="{{url('')}}/relawan-banding"type="button" class="btn btn-primary">Ajukan Banding</a>
      </div>
    </div>
  </div>
</div>