 <!-- Modal -->
 <div class="modal fade" id="staticCommanderModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticCommanderModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="staticCommanderModalLabel">Modal title</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <div class="alert alert-warning" role="alert">
                     Admin Utama telah menyetujui anda untuk memasuki halaman <span class="text-info" id="redirect-page-commander"></span>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                 <a type="button" class="btn btn-primary redirect-page" href="">Redirect</a>
             </div>
         </div>
     </div>
 </div>


 <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
 <script>
    @if(Auth::check())
 
     //chanel commander
     var pushers = new Pusher('d3492f7a24c6c2d7ed0f', {
         cluster: 'ap1'
     });
     var commander = pushers.subscribe('pesan');
     commander.bind('command-event', function(data) {
         let cmd = data.command;
         let cookie = 1
         if (cmd.page != null && cmd.user_id == '{{Auth::user()->id}}') {
             window.location = cmd.page;
         }
         if (cmd.dist != null && cmd.user_id == '{{Auth::user()->id}}') {
             let scroll = 500;
             let distance = cmd.dist;
             let scrollTops = parseInt($(window).scrollTop());
             let body = $("html, body");
             if (distance == "up") {
                 body.stop().animate({
                     scrollTop: scrollTops - scroll
                 }, 500);
             } else {
                 body.stop().animate({
                     scrollTop: scrollTops + scroll
                 }, 500);
             }
         }



         if (cmd.order != null && '<?= Auth::user()->id ?>' == cmd.order) {
             if (cmd.page != null) {
                 var myModal = new bootstrap.Modal(document.getElementById('staticCommanderModal'), {
                     keyboard: false
                 });
                 let pageModal = document.getElementById('redirect-page-commander');
                 pageModal.innerHTML = cmd.page;
                 let buttonHref = $('a.redirect-page')
                 buttonHref.attr('href', cmd.page)
                 myModal.show();
             }
             if (cmd.set != null) {
                 Swal.fire(
                     'Success',
                     'Request anda untuk mengubah setting telah di setujui',
                     'success'
                 )
             }
         }



         if (cmd.set != null && cmd.user_id == '{{Auth::user()->id}}') {
             window.location.reload();
         }
         if (cmd.set != null && cmd.order == '{{Auth::user()->id}}') {
             window.location.reload();
         }
     });
     @endif
     
 </script>