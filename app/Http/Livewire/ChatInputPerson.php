<?php

namespace App\Http\Livewire;
use App\Models\ChatPerson;
use App\Models\Config;
use App\Models\Configs;
use App\Models\RegenciesDomain;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatInputPerson extends Component
{
    public $pesan;
    public $send_to;
    private $config;
    private $configs;
      public function __construct()
    {
        $currentDomain = request()->getHttpHost();
        if (isset(parse_url($currentDomain)['port'])) {
            $url = substr($currentDomain, 0, strpos($currentDomain, ':8000'));
        } else {
            $url = $currentDomain;
        }
        $regency_id = RegenciesDomain::where('domain', $url)->first();

        $this->configs = Config::first();
        $this->config = new Configs();
        $this->config->regencies_id = (string) $regency_id->regency_id;      
    }
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
