<?php

namespace App\Http\Livewire;

use App\Models\ChatApp;
use App\Models\Config;
use App\Models\Configs;
use App\Models\RegenciesDomain;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatGroupComponent extends Component
{
    protected $listeners = [
        'pesanTersimpan' => '$refresh',
    ];
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

        return view('livewire.chat-group-component', [
            'chats' => ChatApp::join('users', 'users.id', '=', 'chat_app.send_by')
                ->where('chat_app.role_id', Auth::user()->role_id)->get()
        ]);
    }
}
