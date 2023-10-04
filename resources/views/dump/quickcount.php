<?php


$data['config'] = Config::first();
$config = Config::first();
$dpt                              = District::where('regency_id', $this->config->regencies_id)->sum("dpt");
$data['paslon'] = Paslon::with('quicksaksidata')->get();
$data['paslon_terverifikasi']     = Paslon::with(['quicksaksidata' => function ($query) {
    $query->join('quicksaksi', 'quicksaksidata.saksi_id', 'quicksaksi.id')
        ->whereNull('quicksaksi.pending')
        ->where('quicksaksi.verification', 1);
}])->get();
$data['kota'] = Regency::where('id', $config['regencies_id'])->first();
$data['tracking'] = ModelsTracking::get();
$data['total_incoming_vote']      = SaksiData::sum('voice');
$data['realcount']                = $data['total_incoming_vote'] / $dpt * 100;
$data['village'] = Village::first();
$data['villages'] = Village::get();
$data['realcount'] = $data['total_incoming_vote'] / $dpt * 100;
$data['kec'] = District::where('regency_id', $data['config']['regencies_id'])->get();
$data['kecamatan'] = District::where('regency_id', $config['regencies_id'])->get();
$data['district'] = District::first();
return view('administrator.quickcount.quick_count2',$data);
