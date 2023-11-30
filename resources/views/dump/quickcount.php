<?php


$data['config'] = Config::first();
$config = Config::first();
use App\Models\Configs;
use App\Models\RegenciesDomain;
$configs = 
all()->first();
$currentDomain = request()->getHttpHost();
if (isset(parse_url($currentDomain)['port'])) {
    $url = substr($currentDomain, 0, strpos($currentDomain, ':8000'));
}else{
    $url = $currentDomain;
}
$regency_id = RegenciesDomain::where('domain',"LIKE","%".$url."%")->first();

$reg = App\Models\Regency::where('id', $regency_id->regency_id)->first();

$config = new Configs;
$config->regencies_id =  (string) $regency_id->regency_id;
$config->regencies_logo =  (string) $reg->logo_kota;
$config->provinces_id =  $configs->provinces_id;
$config->setup =  $configs->setup;
$config->darkmode =  $configs->darkmode;
$config->updated_at =  $configs->updated_at;
$config->created_at =  $configs->created_at;
$config->partai_logo =  $configs->partai_logo;
$config->date_overlimit =  $configs->date_overlimit;
$config->show_public =  $configs->show_public;
$config->show_terverifikasi =  $configs->show_terverifikasi;
$config->lockdown =  $configs->lockdown;
$config->multi_admin =  $configs->multi_admin;
$config->otonom =  $configs->otonom;
$config->dark_mode =  $configs->dark_mode;
$config->jumlah_multi_admin =  $configs->jumlah_multi_admin;
$config->jenis_pemilu =  $configs->jenis_pemilu;
$config->tahun =  $configs->tahun;
$config->quick_count =  $configs->quick_count;
$config->default =  $configs->default;

$dpt                              = District::where('regency_id', $this->config->regencies_id)->sum("dpt");
$data['paslon'] = Paslon::with('quicksaksidata')->get();
$data['paslon_terverifikasi']     = Paslon::with(['quicksaksidata' => function ($query) {
    $query->join('quicksaksi', 'quicksaksidata.saksi_id', 'quicksaksi.id')
        ->whereNull('quicksaksi.pending')
        ->where('quicksaksi.verification', 1);
}])->get();
$data['kota'] = Regency::where('id', $config->regencies_id)->first();
$data['tracking'] = ModelsTracking::get();
$data['total_incoming_vote']      = SaksiData::sum('voice');
$data['realcount']                = $data['total_incoming_vote'] / $dpt * 100;
$data['village'] = Village::first();
$data['villages'] = Village::get();
$data['realcount'] = $data['total_incoming_vote'] / $dpt * 100;
$data['kec'] = District::where('regency_id', $data['config']['regencies_id'])->get();
$data['kecamatan'] = District::where('regency_id', $config->regencies_id)->get();
$data['district'] = District::first();
return view('administrator.quickcount.quick_count2',$data);
