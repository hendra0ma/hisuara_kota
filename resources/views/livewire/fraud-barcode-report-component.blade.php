 <div class="row">
     @foreach ($qrcode as $item)
     <?php $scan_url = "" . url('') . "/scanning-secure/" . Crypt::encrypt($item->id) . ""; ?>
     <div class="col-md-3">
         <center>
             <div class="card" style="background-color:white">
                 <div class="card-body">
                     <a href="{{$scan_url}}" target="_blank" rel="noopener noreferrer">
                         {!! QrCode::size(200)->generate($scan_url); !!}
                     </a>
                 </div>
             </div>
         </center>
     </div>
     @endforeach
     {{$qrcode->links()}}
 </div>