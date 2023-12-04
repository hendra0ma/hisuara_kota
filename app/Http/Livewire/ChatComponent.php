<?php

namespace App\Http\Livewire;

use App\Events\ChatEvent;
use App\Models\ChatApp;
use App\Models\Config;
use App\Models\Configs;
use App\Models\RegenciesDomain;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ChatComponent extends Component
{
    public $pesan;
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
        $regency_id = RegenciesDomain::where('domain', 'LIKE', '%' . $url . '%')->first();

        $this->configs = Config::first();
        $this->config = new Configs();
        $this->config->regencies_id = (string) $regency_id->regency_id;      
    }
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
