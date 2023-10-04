<div>
    <div class="main-chat-body" style="overflow:scroll;height:400px">
        <div class="content-inner">
            <input type="hidden"name="send_to" wire:model="send_to"id="send_to">
            @foreach($chats as $chat)

            <div class="media  {{$chat->send_by == Auth::user()->id ? 'flex-row-reverse chat_right' :'chat_left'}}">
                <div class="main-img-user online">
                    @if ($chat->profile_photo_path == NULL)
                    <img class="" style="width: 250px;"
                        src="https://ui-avatars.com/api/?name={{ $chat->name }}&color=7F9CF5&background=EBF4FF"
                        alt="img">
                    @else
                    <img alt="avatar" src="{{asset('public/storage/profile').'/'.$chat->profile_photo_path}}">
                    @endif
                </div>
                <div class="media-body">
                    <div class="main-msg-wrapper">
                        {{$chat->message}}
                    </div>
                    <div>
                        <span> {{ \Carbon\Carbon::parse($chat->time)->diffForHumans() }}</span> <a href=""><i
                                class="icon ion-android-more-horizontal"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<script>

    let send_toObj = {};

    
    function openForm(send_to) {
        document.getElementById("myForm").style.display = "block";
         @this.send_to = null;

         setTimeout(()=>{
             @this.send_to = send_to;
            },1000)


            send_toObj.id = send_to;
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";
        @this.send_to = null;
        send_toObj.id = null;
    }
</script>

    <script>
      


      
     
    
    </script>

