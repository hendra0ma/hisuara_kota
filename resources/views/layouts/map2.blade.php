<div class="ht-300" id="map2" style="height:600px"></div>


<script>
var map2 = L.map('map2').setView([-6.261223099846002, 106.69325190584601], 10);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    @foreach($tracking as $track)
    <?php $user = App\Models\User::where('id', (string)$track->id_user)->first(); ?>
    @if($user == NULL)
      L.marker([{{$track['latitude']}},{{$track['longitude']}}]).bindPopup(' Tidak Terdeteksi ').addTo(map2);
    @else
       var text<?= $user['id'] ?> = '<div class="row"><div class="col-4"><img src="' + '<?php if($user["profile_photo_path"] == NULL){ echo "https://ui-avatars.com/api/?name=' + '".$user["name"]."' +'&color=7F9CF5&background=EBF4FF"; }else{ echo url("/storage/profile-photos/".$user["profile_photo_path"]); } ?>' + '" class="'+ 'img-fluid' + '"  width="150px" height="auto" /></div>   <div class="col-8"><table>' + '<tr><td>Nama</td><td>:</td><td>' + '<?= $user["name"] ?>' + '</td></tr>' + '<tr><td>Email</td><td>:</td><td>' + '<?= $user["email"]?>' + '</td></tr>' + '<tr><td>Nomor</td><td>:</td><td>' + '<?= $user["no_hp"]?>' + '</td></tr>' + '<tr><td>Last Seen</td><td>:</td><td>' + '    {{ \Carbon\Carbon::parse($user["last_seen"])->diffForHumans() }}' + '</td></tr>' + '</table><a href="#modalMap"data-bs-toggle="modal">Detail Tracking</a>  </div> </div>';
    L.marker([{{ $track['latitude']}}, {{ $track['longitude']}}]).bindPopup(text<?= $user['id'] ?>).addTo(map2);   
    @endif
    @endforeach
</script>