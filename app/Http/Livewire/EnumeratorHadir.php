<?php

namespace App\Http\Livewire;

use App\Models\Absensi as AbsensiModel;
use App\Models\Config;
use App\Models\Configs;
use App\Models\RegenciesDomain;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class EnumeratorHadir extends Component
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
        $data['absen'] = AbsensiModel::join('users', 'users.id', '=', 'absensi.user_id')
        ->where("users.regency_id",  $this->config->regencies_id)
        ->where('users.absen', '=', 'hadir')
        ->where('is_active', '=', 1)
        ->where('name', 'like', '%' . $this->search . '%')->paginate(16);
        $data['absen2'] = AbsensiModel::join('users', 'users.id', '=', 'absensi.user_id')->where("users.regency_id",  $this->config->regencies_id)->get();
        $data['user'] = User::where('role_id', 8)->where("users.regency_id",  $this->config->regencies_id)->count();
        $data['jumlah'] = count($data['absen2']);
        return view('livewire.enumerator-hadir', $data);
    }
}
