<?php

namespace App\Http\Controllers;

use App\Events\NotifEvent;
use App\Models\Config;
use App\Models\District;
use App\Models\Koreksi;
use App\Models\Paslon;
use App\Models\Regency;
use App\Models\Saksi;
use App\Models\SaksiData;
use App\Models\Tps;
use App\Models\User;
use App\Models\History;
use App\Models\Qrcode;
use App\Models\Village;
use Database\Factories\TpsFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Models\Bukti_deskripsi_curang;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\Environment\Console;
use App\Models\Buktifoto as ModelsBuktifoto;
use App\Models\Buktividio as ModelsBuktividio;
use App\Models\Configs;
use App\Models\CrowdC1;
use App\Models\Databukti;
use App\Models\DataCrowdC1;
use App\Models\Listkecurangan as ModelsListkecurangan;
use App\Models\Relawan;
use App\Models\RelawanData;
use App\Models\QuickSaksiData;
use App\Models\RegenciesDomain;
use App\Models\RiwayatKoreksi;
use App\Models\RiwayatKoreksiData;
use App\Models\SuratPernyataan;
use App\Models\SuratSuara;
use Illuminate\Support\Facades\DB;
use App\Models\Tracking as ModelsTracking;

class VerificatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     public $config;
     public $configs;
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
         $this->config->provinces_id = $this->configs->provinces_id;
         $this->config->setup = $this->configs->setup;
         $this->config->updated_at = $this->configs->updated_at;
         $this->config->created_at = $this->configs->created_at;
         $this->config->partai_logo = $this->configs->partai_logo;
         $this->config->date_overlimit = $this->configs->date_overlimit;
         $this->config->show_public = $this->configs->show_public;
         $this->config->show_terverifikasi = $this->configs->show_terverifikasi;
         $this->config->lockdown = $this->configs->lockdown;
         $this->config->multi_admin = $this->configs->multi_admin;
         $this->config->otonom = $this->configs->otonom;
         $this->config->dark_mode = $this->configs->dark_mode;
         $this->config->jumlah_multi_admin = $this->configs->jumlah_multi_admin;
         $this->config->jenis_pemilu = $this->configs->jenis_pemilu;
         $this->config->tahun = $this->configs->tahun;
         $this->config->quick_count = $this->configs->quick_count;
         $this->config->default = $this->configs->default;
    $this->config->default =  $this->configs->default;
     }

    public function index()
    {
        $config = Config::first();
        $data['title'] = 'Kecamatan';
        $data['regency'] = Regency::where('id', $this->config->regencies_id)->first();
        $data['district']  = District::where('id', Auth::user()->districts)->first();
        $district = $data['district'];
        $data['villages'] = Village::where('district_id', $district->id)->get();
        $data['village'] = Village::where('district_id', $district->id)->first();
        $data['team'] = User::where('id', '!=', Auth::user()->id)->where('role_id', Auth::user()->role_id)->get();
          $data['title2'] = "KEC ." . $data['district']['name'] . "";
        return view('verificator.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function village($id)
    {
        $id = Crypt::decrypt($id);
        $config = Config::first();
        $data['regency'] = Regency::where('id',(string)$this->config->regencies_id)->first();
        $data['village'] = Village::where('id',(string)$id)->first();
        $data['district'] = District::where('id', $data['village']->district_id)->first();
        $data['jumlah_tps_masuk'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('tps.villages_id', (string)$id)->whereNull('saksi.pending')->count();
        $data['jumlah_tps_terverifikai'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->whereNull('saksi.pending')
            ->where('tps.villages_id', (string)$id)
            ->where('saksi.verification', 1)->count();

        return view('verificator.village', $data);
    }
    public function create()
    {
        //
    }
    public function verifikasiKecurangan($id)
    {
        $id = Crypt::decrypt($id);
        $data = [
            'status_kecurangan' => 'terverifikasi validator',
            'verifikator_id' => Auth::user()->id,

        ];
        Saksi::where('tps_id', $id)->where('kecurangan','yes')->where('status_kecurangan', 'belum terverifikasi')->update($data);
        $save = Qrcode::create([
            'tps_id' => $id,
            'verifikator_id' => Auth::user()->id,
            'hukum_id' => Auth::user()->role_id,
            'tanggal_masuk' => now(),
            'token' => encrypt(rand()),
        ]);
        return redirect()->back()->with(['success' => "Kecurangan telah di verifikasi"]);
    }
    public function tolakkecurangan($id)
    {
        $id = Crypt::decrypt($id);
        $data = [
            'status_kecurangan' => 'ditolak verifikator',
            'verifikator_id' => Auth::user()->id,
        ];
        Saksi::where('tps_id', $id)->update($data);
        return redirect()->back()->with(['success' => "Kecurangan telah di Tolak"]);
    }
    public function getSaksiData(Request $req)
    {
        $data['paslon'] = Paslon::with(['saksi_data' => function ($query) use ($req) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id')
                ->join('tps', 'tps.id', 'saksi.tps_id')
                ->where('tps.id', '=', $req->id)
                ->whereNull('saksi.pending');
        }])->get();
        $data['village'] = Village::where('id', $data['paslon'][0]->saksi_data[0]->village_id)->first();
        $data['user'] = User::where('tps_id', $req->id)->first();
        $data['surat_suara'] = SuratSuara::where('tps_id',$req->id)->first();
        return view('verificator.modalView', $data);
    }
    public function getSaksiPending(Request $req)
    {
        $data['paslon'] = Paslon::with(['saksi_data' => function ($query) use ($req) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id')
                ->join('tps', 'tps.id', 'saksi.tps_id')
                ->where('tps.id', '=', $req->id)
                ->whereNotNull('saksi.pending');
        }])->get();

        
        $data['village'] = Village::where('id', $data['paslon'][0]->saksi_data[0]->village_id)->first();
        $data['surat_suara'] = SuratSuara::where('tps_id',$req->id)->first();
        return view('verificator.modalViewPending', $data);
    }
    public function getKecuranganSaksi(Request $request)
    {

        // $data['foto_kecurangan'] = ModelsBuktifoto::where('tps_id', $request['id'])->get();
        // $data['vidio_kecurangan'] = ModelsBuktividio::where('tps_id', $request['id'])->first();
        $data['list_kecurangan']     = Bukti_deskripsi_curang::join('list_kecurangan', 'list_kecurangan.id', '=', 'bukti_deskripsi_curang.list_kecurangan_id')
        ->join('solution_frauds', 'solution_frauds.id', '=', 'list_kecurangan.solution_fraud_id')
        ->where('bukti_deskripsi_curang.tps_id', $request->id)
        ->get();

        $data['tps'] = Tps::where('id', $request['id'])->first();
        $data['kecamatan'] = District::where('id', $data['tps']['district_id'])->first();
        $data['bukti_vidio'] = ModelsBuktividio::where('tps_id', $request['id'])->get();
        $data['bukti_foto'] = ModelsBuktifoto::where('tps_id', $request['id'])->get();
        $data['user'] = User::where('tps_id', $request['id'])->first();
        $data['qrcode'] = Qrcode::where('tps_id', $data['user']['tps_id'])->first();
        $data['district'] = District::where('id', $data['user']['districts'])->first();
        $data['village'] = Village::where('id', $data['user']['villages'])->first();
        if ($data['qrcode'] != null) {
            $data['verifikator']            = User::where('id', $data['qrcode']['verifikator_id'])->first();
            $data['hukum']                  = User::where('id', $data['qrcode']['hukum_id'])->first();
        } else {
            $data['verifikator']            = null;
            $data['hukum']                  = null;
        }
        $config = Config::first();
        $data['kota'] = Regency::where('id', $config->regencies_id)->first();
        $data['saksi'] = Saksi::where('tps_id', $data['tps']['id'])->first();
        $data['surat_pernyataan'] = SuratPernyataan::where('saksi_id', $data['saksi']['id'])->first();
        $data['pelanggaran_umum']    = ModelsListkecurangan::join('solution_frauds', 'solution_frauds.id', '=', 'list_kecurangan.solution_fraud_id')->where('list_kecurangan.jenis', 0)->get();
        $data['pelanggaran_petugas'] = ModelsListkecurangan::join('solution_frauds', 'solution_frauds.id', '=', 'list_kecurangan.solution_fraud_id')->where('list_kecurangan.jenis', 1)->get();
        $data['pelanggaran_etik'] = ModelsListkecurangan::join('solution_frauds', 'solution_frauds.id', '=', 'list_kecurangan.solution_fraud_id')->where('list_kecurangan.jenis', 2)->get();
        $data['pelanggaran_aparatur'] = ModelsListkecurangan::join('solution_frauds', 'solution_frauds.id', '=', 'list_kecurangan.solution_fraud_id')->where('list_kecurangan.jenis', 3)->get();
        $data['surat_suara'] = SuratSuara::where('tps_id',$request->id)->first();
        return view('verificator.modal-view-kecurangan', $data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function verifikasiData($id)
    {
        $id = Crypt::decrypt($id);
        Saksi::where('id', $id)->update(
            [
                'verification' => 1
            ]
        );
        $saksi_data = SaksiData::where('saksi_id',$id)->get();
        $regency_voice = Regency::where('id',$this->config->regencies_id)->first();
        $voice1 =  $regency_voice->suarav1 + $saksi_data[0]->voice;
        $voice2 =  $regency_voice->suarav2 + $saksi_data[1]->voice;
        $voice3 =  $regency_voice->suarav3 + $saksi_data[2]->voice;
        Regency::where('id',$this->config->regencies_id)->update([
            'suarav1'=>$voice1,
            'suarav2'=>$voice2,
            'suarav3'=>$voice3,
        ]);
        $saksi = Saksi::where('id', $id)->first();
        $tps = Tps::where('id', $saksi['tps_id'])->first();
        $kecamatan = District::where('id', $saksi['district_id'])->first();
        // $kelurahan = Village::where('id', $saksi['village_id'])->first();
        $pesan = "" . Auth::user()->name . " Memverifikasi Tps " . $tps['number'] . " Kecamatan " . $kecamatan['name'] . " Kelurahan " . $kecamatan['name'] . "  ";
        History::create([
            'user_id' => Auth::user()->id,
            'action' => $pesan,
            'saksi_id' => $saksi['id'],
            'status' => 1,
        ]);

     
        // event(new NotifEvent($pesan));
        // Set pesan sukses dalam session flash
        session()->flash('sukses_verif', 'Verifikasi berhasil dilakukan.');

        return redirect()->back();
    }
    public function verifikasiDataPending($id)
    {
        $id = Crypt::decrypt($id);
        $getSaksi = Saksi::where('id', $id)->first();
        $cekRelawan = Relawan::where('tps_id', $getSaksi->tps_id)->count();
        if ($cekRelawan > 0) {
            $cek = Saksi::where('tps_id', $getSaksi->tps_id)->whereNull('pending')->first();
            SaksiData::where('saksi_id', $cek->id)->delete();
            Saksi::where('tps_id', $getSaksi->tps_id)->whereNull('pending')->delete();
        }
        Saksi::where('id', $id)->update(
            [
                'pending' => NUll
            ]
        );
        $saksi = Saksi::where('id', $id)->first();
        $tps = Tps::where('id', $saksi['tps_id'])->first();
        $kecamatan = District::where('id', $saksi['district_id'])->first();
        $kelurahan = Village::where('id', $saksi['village_id'])->first();
        $pesan = "" . Auth::user()->name . " Memverifikasi Data Tps Pending " . $tps['number'] . " Kecamatan " . $kecamatan['name'] . " Kelurahan " . $kecamatan['name'] . "  ";
        $history = History::create([
            'user_id' => Auth::user()->id,
            'action' => $pesan,
        ]);
        // event(new NotifEvent($pesan));
        return redirect()->back()->with(['success' => "berhasil memverifikasi data tps Pending."]);
    }
    public function koreksidata($id)
    {

        $data['config'] = Config::first();
        $id = Crypt::decrypt($id);
        $data['id'] = $id;
        $data['saksi'] = Saksi::with('saksi_data')->where('id',(string)$id)->get();
        $data['saksis'] = Saksi::with('saksi_data')->where('id',(string)$id)->first();
        $data['title2'] = "-";
        $data['title'] = "";
        // dd($data['saksi']);
        $data['user'] = User::where('tps_id', $data['saksis']['tps_id'])->first();

        return view('verificator.viewKoreksi', $data);
    }
    public function getKoreksiVerifikator(Request $request)
    {

        $data['config'] = Config::first();
        $id = Crypt::decrypt($request->id);
        $data['id'] = $id;
        $data['saksi'] = Saksi::with('saksi_data')->where('id',(string)$id)->get();
        $data['saksis'] = Saksi::with('saksi_data')->where('id',(string)$id)->first();
        $data['title2'] = "-";
        $data['title'] = "";
        // dd($data['saksi']);
        $data['user'] = User::where('tps_id', $data['saksis']['tps_id'])->first();

        return view('verificator.modalViewKoreksi', $data);
    }
    public function actionKoreksiData(Request $req, $id)
    {

        $req->validate([
            'suara.*' => ['required'],
            "persetujuan" => ['required']
        ]);
        
        $id = Crypt::decrypt($id);
        $saksi = Saksi::where('id', $id)->first();
        $saksi_data = SaksiData::where('saksi_id', $id)->get();
        $regency_voice = Regency::where('id',$this->config->regencies_id)->first();
        
        $user = User::where('tps_id',$saksi->tps_id)->first();

        $riwayatKoreksi = new RiwayatKoreksi;
        $riwayatKoreksi->c1_images = $saksi->c1_images;
        $riwayatKoreksi->user_id = $user->id;
        $riwayatKoreksi->province_id = $saksi->province_id;
        $riwayatKoreksi->regency_Id = $saksi->regency_id;
        $riwayatKoreksi->village_id = $saksi->village_id;
        $riwayatKoreksi->district_id = $saksi->district_id;
        $riwayatKoreksi->tps_id = $saksi->tps_id;
        $riwayatKoreksi->from = "verifikator";
        $riwayatKoreksi->petugas_id =Auth::user()->id;
        $riwayatKoreksi->save();
        $riwayatKoreksiId = $riwayatKoreksi->id;
        $paslon = Paslon::get();
        foreach ($paslon as $key => $value) {
            RiwayatKoreksiData::insert([
                'user_id' =>  $user->id,
                "voice"=> $saksi_data[$key]->voice,
                "paslon_id"=>$value->id,
                "riwayat_koreksi_id"=>$riwayatKoreksiId,
                "province_id"=>$saksi->province_id,
                "regency_id"=>$saksi->regency_id,
                "tps_id"=>$saksi->tps_id,
                "village_id"=>$saksi->village_id,
                "district_id"=>$saksi->district_id,
                "petugas_id"=>Auth::user()->id,
            ]);
        }
    


        foreach($saksi_data as $i=> $sd){
            SaksiData::where('id',$sd->id)->update([
                "voice" => (int)$req->suara[$i],
            ]);
        }
        $voice1 =  $regency_voice->suara1 - $saksi_data[0]->voice + $req->suara[0];
        $voice2 =  $regency_voice->suara2 - $saksi_data[1]->voice + $req->suara[1];
        $voice3 =  $regency_voice->suara3 - $saksi_data[2]->voice + $req->suara[2];
        Regency::where('id',$this->config->regencies_id)->update([
            'suara1'=>$voice1,
            'suara2'=>$voice2,
            'suara3'=>$voice3,
        ]);

        Saksi::where('id', $id)->update([
            "koreksi" => 1,
            "kecurangan_id_users" =>  Auth::user()->id,
        ]);
     
        $tps = Tps::where('id', $saksi['tps_id'])->first();
        $kecamatan = District::where('id', $saksi['district_id'])->first();
        $kelurahan = Village::where('id', $saksi['village_id'])->first();
        $pesan = "" . Auth::user()->name . " Melakukan Koreksi Di Tps " . $tps['number'] . " Kecamatan " . $kecamatan['name'] . " Kelurahan " . $kelurahan['name'] . "  ";
        $history = History::create([
            'user_id' => Auth::user()->id,
            'action' => $pesan,
        ]);
        return redirect()->route('verifikator.verifikasiC1');
    }
    public function getRelawanData(Request $req)
    {
        $data['relawan'] = Relawan::with('relawan_data')->where('tps_id', $req->id)->first();

        return view('verificator.modal-view-relawan', $data);
    }
    public function getCrowdData(Request $req)
    {
        $data['relawan'] = CrowdC1::with('crowd_data')->where('id', $req->id)->first();
        return view('verificator.modal-view-crowd', $data);
    }
    public function verifikasiDataC1Relawan($id)
    {
        $id = Crypt::decrypt($id);
        $relawan = Relawan::where('id', $id)->first();
        Relawan::where('id', $id)->update([
            'status' => 2
        ]);
        $relawan_data = RelawanData::where('relawan_id', $id)->get();
        $saksi = new Saksi();
        $saksi->c1_images = $relawan->c1_images;
        $saksi->district_id = $relawan->district_id;
        $saksi->village_id = $relawan->village_id;
        $saksi->regency_id = $relawan->regency_id;
        $saksi->tps_id = $relawan->tps_id;
        $saksi->verification = "";
        $saksi->audit = "";
        $saksi->overlimit = 0;
        $saksi->kecurangan = "no";
        $saksi->save();
        $saksiId = $saksi->id;
        foreach ($relawan_data as $rd) {
            $saksi_data = new SaksiData();
            $saksi_data->voice = $rd->voice;
            $saksi_data->village_id = $rd->village_id;
            $saksi_data->regency_id = $rd->regency_id;
            $saksi_data->district_id = $rd->district_id;
            $saksi_data->paslon_id = $rd->paslon_id;
            $saksi_data->user_id = $rd->relawan_id;
            $saksi_data->saksi_id = $saksiId;
            $saksi_data->save();
        }
        $regency_voice = Regency::where('id', $this->config->regencies_id)->first();
        $suara1 = $regency_voice->suara1 +  $relawan_data->voice[0];
        $suara2 = $regency_voice->suara2 +  $relawan_data->voice[1];
        $suara3 = $regency_voice->suara3 +  $relawan_data->voice[2];
        Regency::where('id', $regency_voice->id)->update([
            'suara1' => $suara1,
            'suara2' => $suara2,
            'suara3' => $suara3,
        ]);
        $saksi = Saksi::where('id', $id)->first();
        $tps = Tps::where('id', $saksi['tps_id'])->first();
        $kecamatan = District::where('id', $saksi['district_id'])->first();
        $kelurahan = Village::where('id', $saksi['village_id'])->first();
        $pesan = "" . Auth::user()->name . " Memverifikasi Data Relawan -  Tps " . $tps['number'] . " Kecamatan " . $kecamatan['name'] . " Kelurahan " . $kelurahan['name'] . "  ";
        $history = History::create([
            'user_id' => Auth::user()->id,
            'action' => $pesan,
        ]);
        // event(new NotifEvent($pesan));

        return redirect()->back()->with(['success' => 'berhasil memverifikasi data relawan']);
    }
    public function verifikasiDataC1Crowd($id)
    {
        $id = Crypt::decrypt($id);
        $crowd_c1 = CrowdC1::where('id', $id)->first();
        CrowdC1::where('id', $id)->update([
            'status' => 2
        ]);
        $crowd_c1_data = DataCrowdC1::where('crowd_c1_id', $id)->get();
        $saksi = new Saksi();
        $saksi->c1_images = $crowd_c1->c1_images;
        $saksi->district_id = $crowd_c1->district_id;
        $saksi->village_id = $crowd_c1->village_id;
        $saksi->regency_id = $crowd_c1->regency_id;
        $saksi->tps_id = $crowd_c1->tps_id;
        $saksi->verification = "";
        $saksi->audit = "";
        $saksi->overlimit = 0;
        $saksi->kecurangan = "no";
        $saksi->save();
        $saksiId = $saksi->id;
        foreach ($crowd_c1_data as $rd) {
            $saksi_data = new SaksiData();
            $saksi_data->voice = $rd->voice;
            $saksi_data->village_id = $rd->village_id;
            $saksi_data->regency_id = $rd->regency_id;
            $saksi_data->district_id = $rd->district_id;
            $saksi_data->paslon_id = $rd->paslon_id;
            $saksi_data->user_id = $rd->crowd_c1_id;
            $saksi_data->saksi_id = $saksiId;
            $saksi_data->save();
        }
        $regency_voice = Regency::where('id', $this->config->regencies_id)->first();
        $suara1 = $regency_voice->suara1 +  $crowd_c1_data->voice[0];
        $suara2 = $regency_voice->suara2 +  $crowd_c1_data->voice[1];
        $suara3 = $regency_voice->suara3 +  $crowd_c1_data->voice[2];
        Regency::where('id', $regency_voice->id)->update([
            'suara1' => $suara1,
            'suara2' => $suara2,
            'suara3' => $suara3,
        ]);
        $saksi = Saksi::where('id', $id)->first();
        $tps = Tps::where('id', $saksi['tps_id'])->first();
        $kecamatan = District::where('id', $saksi['district_id'])->first();

        $pesan = "" . Auth::user()->name . " Memverifikasi Data Crowd C1 -  Tps " . $tps['number'] . " Kecamatan " . $kecamatan['name'] . " Kelurahan " . $kecamatan['name'] . "  ";
        History::create([
            'user_id' => Auth::user()->id,
            'action' => $pesan,
        ]);

        return redirect()->back()->with(['success' => 'berhasil memverifikasi data Crowd C1']);
    }

    public function verifikasiC1() {
        $data['config'] = Config::first();
        $config = Config::first();
        $data['paslon'] = Paslon::with('quicksaksidata')->get();
        $data['paslon_terverifikasi']     = Paslon::with(['quicksaksidata' => function ($query) {
            $query->join('quicksaksi', 'quicksaksidata.saksi_id', 'quicksaksi.id')
                ->whereNull('quicksaksi.pending')
                ->where('quicksaksi.verification', 1);
        }])->get();
        $data['total_incoming_vote']      = QuickSaksiData::sum('voice');
        $data['kota'] = DB::table("regencies")->where('id',(int)$this->config->regencies_id)->first();
        $data['tracking'] = ModelsTracking::get();
        // $data['jumlah_tps_masuk'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->count();
        // $data['jumlah_tps_terverifikai'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('saksi.verification', 1)->count();
        // $data['jumlah_tps_terverifikai'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('saksi.verification', 1)->count();
        $data['total_tps']   =  Tps::where('setup','belum terisi')->count();
        // $data['jumlah_kosong']  =  $data['total_tps'] - $data['jumlah_tps_masuk'];
        return view('administrator.c1.verifikasi-c1', $data);
    }

    public function verifikatorKecurangan() {
        $data['config'] = Config::first();
        $config = Config::first();
        $data['paslon'] = Paslon::with('quicksaksidata')->get();
        $data['paslon_terverifikasi']     = Paslon::with(['quicksaksidata' => function ($query) {
            $query->join('quicksaksi', 'quicksaksidata.saksi_id', 'quicksaksi.id')
                ->whereNull('quicksaksi.pending')
                ->where('quicksaksi.verification', 1);
        }])->get();
        $data['total_incoming_vote']      = QuickSaksiData::sum('voice');
        $data['kota'] = Regency::where('id',$this->config->regencies_id)->first();
        $data['tracking'] = ModelsTracking::get();
        $data['jumlah_tps_masuk'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->count();
        $data['jumlah_tps_terverifikai'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('saksi.verification', 1)->count();
        $data['jumlah_tps_terverifikai'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('saksi.verification', 1)->count();
        $data['total_tps']   =  Tps::where('setup','belum terisi')->count();
        $data['jumlah_kosong']  =  $data['total_tps'] - $data['jumlah_tps_masuk'];
        return view('administrator.kecurangan.verifikator_kecurangan', $data);
    }
    
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
