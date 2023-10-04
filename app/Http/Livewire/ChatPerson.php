<?php

namespace App\Http\Livewire;

use App\Models\ChatPerson as ModelsChatPerson;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatPerson extends Component
{

    public $pesan;
    public $send_to;
    protected $listeners = [
        'pesanTersimpan' => '$refresh',
    ];
    public function render()
    {
        return view('livewire.chat-person',[
            'chats'=> ModelsChatPerson::where('send_by',Auth::user()->id)->where('send_to',$this->send_to)->get()
        ]);
    }
   
}
