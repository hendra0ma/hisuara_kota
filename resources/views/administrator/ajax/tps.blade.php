<div class="modal-header">
    <h5 class="modal-title">Kecamatan {{$kecamatan['name']}} / Kelurahan {{$kelurahan['name']}} / TPS {{$tps['number']}}</h5>
     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
 </div>
 <div class="modal-body">

     @foreach ($saksi as $item)
     <img src="{{asset('storage'.'/'.$item['c1_images'])}}" alt="" srcset="">
     @endforeach
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
