<?php

namespace App\Http\Livewire;

use App\Models\ChatApp;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatGroupComponent extends Component
{
    protected $listeners = [
        'pesanTersimpan' => '$refresh',
    ];

    public function render()
    {

        return view('livewire.chat-group-component', [
            'chats' => ChatApp::join('users', 'users.id', '=', 'chat_app.send_by')
                ->where('chat_app.role_id', Auth::user()->role_id)->get()
        ]);
    }
}
