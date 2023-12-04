<?php

namespace App\Http\Livewire;

use App\Models\ChatPerson as ModelsChatPerson;
use App\Models\Config;
use App\Models\Configs;
use App\Models\RegenciesDomain;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatPerson extends Component
{

    public $pesan;
    public $send_to;
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
        $regency_id = RegenciesDomain::where('domain', 'LIKE', '%' . $url . '%')->first();

        $this->configs = Config::first();
        $this->config = new Configs();
        $this->config->regencies_id = (string) $regency_id->regency_id;      
    }
    public function render()
    {
        return view('livewire.chat-person',[
            'chats'=> ModelsChatPerson::where('send_by',Auth::user()->id)->where('send_to',$this->send_to)->get()
        ]);
    }
   
}
