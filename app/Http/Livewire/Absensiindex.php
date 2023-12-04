<?php

namespace App\Http\Livewire;

use App\Models\Absensi;
use App\Models\Config;
use App\Models\Configs;
use App\Models\RegenciesDomain;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Absensiindex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];
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
        $data['absen2'] = Absensi::join('users', 'users.id', '=', 'absensi.user_id')->where("users.regency_id",  $this->config->regencies_id)->get();
        $data['absen'] = User::where('role_id',8)->where('is_active', '=', 1)->where("users.regency_id",  $this->config->regencies_id)->where('name', 'like', '%'.$this->search.'%')->paginate(16);
        $data['user'] = User::where('role_id',8)->where("users.regency_id",  $this->config->regencies_id)->count();
        $data['jumlah'] = $data['user'];
        
        return view('livewire.absensiindex', $data);
    }
}
