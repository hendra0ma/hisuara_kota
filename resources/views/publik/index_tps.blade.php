<div class="modal-header">
    <h5 class="modal-title">TPS {{$tps['number']}}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
   @foreach ($saksi as $item)
   <img src="{{asset('storage'.'/'.$item['c1_images'])}}" alt=""
   srcset="">
   @endforeach
     
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary">Unduh Salinan</button>
    <button type="button" class="btn btn-primary">Banding C1</button>
</div>