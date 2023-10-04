<?php

namespace App\Http\Livewire;
use App\Models\ChatPerson;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatInputPerson extends Component
{
    public $pesan;
    public $send_to;
    public function render()
    {
        return view('livewire.chat-input-person');
    }
    public function store()
    {
        $this->pesan = trim($this->pesan);
        if ($this->pesan != "") {
            ChatPerson::create([
                'message' => $this->pesan,
                'send_by' => Auth::user()->id,
                'send_to' => $this->send_to,
                'time' => now()
            ]);
            $this->pesan = "";
            // event(new ChatEvent('person'));
            $this->emit('pesanTersimpan');
        }
    }
   
}
