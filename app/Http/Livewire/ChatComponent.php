<?php

namespace App\Http\Livewire;

use App\Events\ChatEvent;
use App\Models\ChatApp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ChatComponent extends Component
{
    public $pesan;
    public function render()
    {
        return view('livewire.chat-component');
    }
    public function store()
    {
        $this->pesan = trim($this->pesan);
        if ($this->pesan != "") {
            ChatApp::create([
                'message' => $this->pesan,
                'send_by' => Auth::user()->id,
                'role_id' => Auth::user()->role_id,
                'time' => now()
            ]);
            $this->pesan = "";
            event(new ChatEvent('hello'));
            $this->emit('pesanTersimpan');
        }
    }
}
