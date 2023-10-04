<div>
    <div class="main-chat-body" style="overflow:scroll;height:400px" id="ChatBody">
        <div class="content-inner">
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
