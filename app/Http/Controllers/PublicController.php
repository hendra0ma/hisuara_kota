<?php

namespace App\Http\Controllers;

use App\Models\Bukti_deskripsi_curang;
use App\Models\Buktifoto as ModelsBuktifoto;
use App\Models\Buktividio;
use App\Models\Config;
use App\Models\Configs;
use App\Models\Paslon;
use App\Models\Qrcode;
use App\Models\Regency;
use App\Models\SaksiData;
use App\Models\User;
use App\Models\Tps;
use App\Models\District;
use App\Models\Village;
use App\Models\Saksi;
use App\Models\History;
use App\Models\Listkecurangan;
use App\Models\Tracking;
use App\Models\Province;
use App\Models\QuickSaksiData;
use App\Models\RegenciesDomain;
use App\Models\SuratSuara;
use BuktiDeskirpsiCurang;
use BuktiFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{

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
        $regency_id = RegenciesDomain::where('domain', $url)->first();

        $this->configs = Config::first();
        $this->config = new Configs;
        $this->config->regencies_id =  (string) $regency_id->regency_id;
        $this->config->provinces_id =  $this->configs->provinces_id;
        $this->config->setup =  $this->configs->setup;
        $this->config->updated_at =  $this->configs->updated_at;
        $this->config->created_at =  $this->configs->created_at;
        $this->config->partai_logo =  $this->configs->partai_logo;
        $this->config->date_overlimit =  $this->configs->date_overlimit;
        $this->config->show_public =  $this->configs->show_public;
        $this->config->show_terverifikasi =  $this->configs->show_terverifikasi;
        $this->config->lockdown =  $this->configs->lockdown;
        $this->config->multi_admin =  $this->configs->multi_admin;
        $this->config->otonom =  $this->configs->otonom;
        $this->config->dark_mode =  $this->configs->dark_mode;
        $this->config->jumlah_multi_admin =  $this->configs->jumlah_multi_admin;
        $this->config->jenis_pemilu =  $this->configs->jenis_pemilu;
        $this->config->tahun =  $this->configs->tahun;
        $this->config->quick_count =  $this->configs->quick_count;
        $this->config->default =  $this->configs->default;
    }

    public function getsolution(Request $request)
    {
        $data = Listkecurangan::join('solution_frauds', 'solution_frauds.id', '=', 'list_kecurangan.solution_fraud_id')->where('list_kecurangan.id', $request->id_list)->first();
        return response()->json($data, 200);
    }
    public function index()
    {

        $data['config'] = Config::first();
        $config = Config::first();
        $dpt = District::where('regency_id', $this->config->regencies_id)->sum("dpt");
        $data['kota'] = Regency::find($this->config->regencies_id);
        $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->where('saksi.regency_id', $this->config->regencies_id)->get();
        $data['paslon']  = Paslon::with(['saksi_data' => function ($query) {
            $query
                ->where('saksi_data.regency_id', $this->config->regencies_id);
        }])->get();
        $data['paslon_terverifikasi']     = Paslon::with(['saksi_data' => function ($query) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id')
                ->whereNull('saksi.pending')
                ->where('saksi_data.regency_id', $this->config->regencies_id)
                ->where('saksi.verification', 1);
        }])->get();
        $data['paslon_quick']     = Paslon::with(['saksi_data' => function ($query) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id')
                ->join('tps', 'tps.id', 'saksi.tps_id')
                ->where('tps.sample', '1');
        }])->get();


        $data['kecamatan'] = District::where('regency_id', $this->config->regencies_id)->get();
        $data['paslon_quick'] = Paslon::with('quicksaksidata')->get();
        $data['paslon_terverifikasi_quick']     = Paslon::with(['quicksaksidata' => function ($query) {
            $query->join('quicksaksi', 'quicksaksidata.saksi_id', 'quicksaksi.id')
                ->whereNull('quicksaksi.pending')
                ->where('quicksaksi.verification', 1);
        }])->get();
        $data['total_incoming_vote_quick']      = QuickSaksiData::sum('voice');
        $data['realcount']  = $data['total_incoming_vote_quick'] / $dpt * 100;
        $data['tps_selesai'] = Tps::where('regency_id', $this->config->regencies_id)->where('setup', 'terisi')->count();
        $data['tps_belum'] = Tps::where('regency_id', $this->config->regencies_id)->count();
        $data['tps_selesai_quick'] = Tps::where('regency_id', $this->config->regencies_id)->where('setup', 'terisi')->where('sample', 1)->count();
        $data['tps_belum_quick'] = Tps::where('regency_id', $this->config->regencies_id)->where('sample', 1)->count();
        $data['kec'] = District::where('regency_id', $this->config->regencies_id)->get();
        $data['paslon_candidate'] = Paslon::get();
        $data['title'] = "";
        // $data['villages_quick'] = Tps::join('villages','villages.id','=','tps.villages_id')->where('sample',1)->get();
        $data['district_quick'] = District::join('villages', 'villages.district_id', '=', 'districts.id')->where('regency_id', $this->config->regencies_id)->get();
        return view('publik.index', $data);
    }
    //halaman publik pusat
    public function pusatIndex()
    {


        $dpt = Province::sum("dpt");
        $data['kota'] = Regency::find($this->config->regencies_id);
        // $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->get();
        $data['paslon'] = Paslon::with('saksi_data')->get();
        $data['paslon_terverifikasi'] =$data['paslon'];



        $data['provinsi'] = Province::get();
        $data['total_incoming_vote']  =  DB::table('regencies')
            ->selectRaw('SUM(suara1 + suara2 + suara3) as total_suara')
            ->value('total_suara');
        $data['realcount']  =  $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;
        $data['tps_selesai'] = Tps::where('setup', 'terisi')->count();
        $data['tps_belum'] = Tps::count();
        $data['tps_selesai_quick'] = Tps::where('setup', 'terisi')->where('sample', 1)->count();
        $data['tps_belum_quick'] = Tps::where('sample', 1)->count();
        $data['paslon_candidate'] = Paslon::get();
        $data['title'] = "";
        // $data['villages_quick'] = Tps::join('villages','villages.id','=','tps.villages_id')->where('sample',1)->get();
        $data['district_quick'] = District::join('villages', 'villages.district_id', '=', 'districts.id')->where('regency_id', $this->config->regencies_id)->get();
        return view('publik.pusat', $data);
    }



    public function kecamatan(Request $request, $id)
    {
        $data['config'] = Config::first();
        $data['kota'] = Regency::find($this->config->regencies_id);
        $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->where('saksi.regency_id', $this->config->regencies_id)->get();
        $data['paslon']  = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id', 'district_id')->where('saksi.district_id', decrypt($id));
        }])->get();
        $data['paslon_terverifikasi']     = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id', 'district_id')->where('saksi.verification', 1)->where('saksi.district_id', decrypt($id));
        }])->get();
        $data['paslon_quick']     = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id')->where('saksi.district_id', decrypt($id))
                ->join('tps', 'tps.id', 'saksi.tps_id')
                ->where('tps.sample', '1');
        }])->get();
        $data['tps_selesai_quick'] = Tps::where('setup', 'terisi')->where('sample', 1)->count();
        $data['tps_belum_quick'] = Tps::where('sample', 1)->count();
        $data['tps_selesai'] = Tps::where('setup', 'terisi')->where('district_id', Crypt::decrypt($id))->count();
        $data['tps_belum'] = Tps::where('setup', 'belum terisi')->where('district_id', Crypt::decrypt($id))->count();
        $data['kel'] = Village::where('district_id', Crypt::decrypt($id))->get();
        $data['paslon_candidate'] = Paslon::get();
        $data['kecamatan_name'] = District::where('id', Crypt::decrypt($id))->first();
        $data['villages_quick'] = Village::where('district_id', Crypt::decrypt($id))->get();
        $data['title'] = "Kecamatan " . $data['kecamatan_name']['name'] . "";
        return view('publik.kecamatan', $data);
    }

    public function quick_kecamatan(Request $request, $id)
    {
        $data['config'] = Config::first();
        $data['kota'] = Regency::find($this->config->regencies_id);
        $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->where('saksi.regency_id', $this->config->regencies_id)->get();
        $data['paslon']  = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id', 'district_id')->where('saksi.district_id', decrypt($id));
        }])->get();
        $data['paslon_terverifikasi']     = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id', 'district_id')->where('saksi.verification', 1)->where('saksi.district_id', decrypt($id));
        }])->get();
        $data['paslon_quick']     = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id')->where('saksi.district_id', decrypt($id))
                ->join('tps', 'tps.id', 'saksi.tps_id')
                ->where('tps.sample', '1');
        }])->get();
        $data['tps_selesai_quick'] = Tps::where('setup', 'terisi')->where('sample', 1)->count();
        $data['tps_belum_quick'] = Tps::where('sample', 1)->count();
        $data['tps_selesai'] = Tps::where('setup', 'terisi')->where('district_id', Crypt::decrypt($id))->count();
        $data['tps_belum'] = Tps::where('setup', 'belum terisi')->where('district_id', Crypt::decrypt($id))->count();
        $data['kel'] = Village::where('district_id', Crypt::decrypt($id))->get();
        $data['paslon_candidate'] = Paslon::get();
        $data['kecamatan_name'] = District::where('id', Crypt::decrypt($id))->first();
        $data['villages_quick'] = Village::where('district_id', Crypt::decrypt($id))->get();
        $data['title'] = "Kecamatan " . $data['kecamatan_name']['name'] . "";
        return view('publik.quick_kecamatan', $data);
    }


    public function kelurahan(Request $request, $id)
    {
        $data['config'] = Config::first();
        $data['kota'] = Regency::find($this->config->regencies_id);
        $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->where('saksi.regency_id', $this->config->regencies_id)->get();
        $data['paslon']  = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id', 'village_id')->where('saksi.village_id', (string)decrypt($id));
        }])->get();
        $data['paslon_terverifikasi']     = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id', 'village_id')->where('saksi.verification', 1)->where('saksi.village_id', (string)decrypt($id));
        }])->get();
        $data['paslon_quick']     = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id')->where('saksi.village_id', (string)decrypt($id))
                ->join('tps', 'tps.id', 'saksi.tps_id')
                ->where('tps.sample', '1');
        }])->get();
        $data['tps_selesai_quick'] = Tps::where('setup', 'terisi')->where('sample', 1)->count();
        $data['tps_belum_quick'] = Tps::where('sample', 1)->count();
        $data['tps_selesai'] = Tps::where('setup', 'terisi')->where('villages_id', Crypt::decrypt($id))->count();
        $data['tps_belum'] = Tps::where('setup', 'belum terisi')->where('villages_id', Crypt::decrypt($id))->count();
        $data['kel'] = Tps::where('villages_id', (string)Crypt::decrypt($id))->get();
        $data['tps_ver'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('villages_id', (string)Crypt::decrypt($id))->where('verification', 1)->get();
        $data['paslon_candidate'] = Paslon::get();
        $data['id'] = decrypt($id);
        $data['kelurahan_name'] = Village::where('id', '' . Crypt::decrypt($id))->first();
        $data['kecamatan'] = District::where('id', $data['kelurahan_name']->district_id)->first();
        $data['title'] = "Kecamatan " . $data['kecamatan']['name'] . "/Kelurahan " . $data['kelurahan_name']['name'] . "";
        return view('publik.kelurahan', $data);
    }

    public function quick_kelurahan(Request $request, $id)
    {
        $data['config'] = Config::first();
        $data['kota'] = Regency::find($this->config->regencies_id);
        $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->where('saksi.regency_id', $this->config->regencies_id)->get();
        $data['paslon']  = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id', 'village_id')->where('saksi.village_id', (string)decrypt($id));
        }])->get();
        $data['paslon_terverifikasi']     = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id', 'village_id')->where('saksi.verification', 1)->where('saksi.village_id', (string)decrypt($id));
        }])->get();
        $data['paslon_quick']     = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id')->where('saksi.village_id', (string)decrypt($id))
                ->join('tps', 'tps.id', 'saksi.tps_id')
                ->where('tps.sample', '1');
        }])->get();
        $data['tps_selesai_quick'] = Tps::where('setup', 'terisi')->where('sample', 1)->count();
        $data['tps_belum_quick'] = Tps::where('sample', 1)->count();
        $data['tps_selesai'] = Tps::where('setup', 'terisi')->where('villages_id', Crypt::decrypt($id))->count();
        $data['tps_belum'] = Tps::where('setup', 'belum terisi')->where('villages_id', Crypt::decrypt($id))->count();
        $data['kel'] = Tps::where('villages_id', (string)Crypt::decrypt($id))->where('sample', 1)->get();
        $data['tps_ver'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('villages_id', (string)Crypt::decrypt($id))->where('verification', 1)->get();
        $data['paslon_candidate'] = Paslon::get();
        $data['id'] = decrypt($id);
        $data['kelurahan_name'] = Village::where('id', '' . Crypt::decrypt($id))->first();
        $data['kecamatan'] = District::where('id', $data['kelurahan_name']->district_id)->first();
        $data['title'] = "Kecamatan " . $data['kecamatan']['name'] . "/Kelurahan " . $data['kelurahan_name']['name'] . "";
        return view('publik.quick_kelurahan', $data);
    }
    public function get_tps(Request $request)
    {
        $data['saksi'] =  Saksi::where('tps_id', $request['id'])->get();

        $data['tps'] = Tps::where('id', $request['id'])->first();
        $data['kecamatan'] = District::where('id',  $data['tps']['district_id'])->first();
        $data['kelurahan'] = Village::where('id',  '' . $data['tps']['villages_id'])->first();
        $data['config'] = Config::first();
        $data['surat_suara'] = SuratSuara::where('tps_id',$request['id'])->first();
        if (count($data['saksi']) == 0) {
            return view('publik.ajax.result_eror');
        } else {
            return view('publik.ajax.tps', $data);
        }
    }
    public function scanning(Request $request, $id)
    {


        if ($request->password == null || $request->password != "123") {
            return redirect()->back()->with('error', 'password yang anda masukan salah');
        }

        $data['config'] = Config::first();
        $config = $data['config'];
        $data['qrcode_hukum'] = Qrcode::join('surat_pernyataan', 'surat_pernyataan.qrcode_hukum_id', '=', 'qrcode_hukum.id')
            ->join('users', 'users.tps_id', '=', 'qrcode_hukum.tps_id')->where('qrcode_hukum.nomor_berkas', Crypt::decrypt($id))->first();
        if ($data['qrcode_hukum'] == null) {
            $data['qrcode_hukum'] = Qrcode::join('surat_pernyataan', 'surat_pernyataan.qrcode_hukum_id', '=', 'qrcode_hukum.id')
                ->join('users', 'users.tps_id', '=', 'qrcode_hukum.tps_id')->where('qrcode_hukum.id',  Crypt::decrypt($id))->first();
        }

        $data['verifikator_id'] = User::where('id', $data['qrcode_hukum']['verifikator_id'])->first();
        $data['hukum_id'] = User::where('id', $data['qrcode_hukum']['hukum_id'])->first();
        $data['bukti_foto'] = ModelsBuktifoto::where('tps_id', $data['qrcode_hukum']['tps_id'])->get();
        $data['bukti_vidio'] = Buktividio::where('tps_id', $data['qrcode_hukum']['tps_id'])->get();
        $data['list'] = Bukti_deskripsi_curang::where('tps_id', $data['qrcode_hukum']['tps_id'])->get();
        $data['data_tps'] = Tps::where('id', '' . $data['qrcode_hukum']->tps_id)->first();
        $data['kelurahan'] = Village::where('id', '' . $data['qrcode_hukum']['villages'])->first();
        $data['kecamatan'] = District::where('id', $data['qrcode_hukum']['districts'])->first();
        $data['kota'] = Regency::where('id', $this->config->regencies_id)->first();
        $data['tps']       = Tps::where('id', $data['qrcode_hukum']['tps_id'])->first();
        $data['user'] = User::where('id', $data['tps']['user_id'])->first();
        // dd($data['user']);
        return view('publik.scan', $data);
        // dd($data['qrcode_hukum']);
    }


    public function real_count_get()
    {
        $paslon = Paslon::get();
        foreach ($paslon as $ps) {
            $data['paslon' . $ps['id'] . ''] = SaksiData::where('paslon_id', $ps['id'])->sum('voice');
        }
        echo json_encode($data);
    }

    public function real_count()
    {
        $data['config'] = Config::first();
        $config = $data['config'];
        $data['kota'] = Regency::where('id', $this->config->regencies_id)->first();
        $data['paslon'] = Paslon::get();
        $data['kecamatan'] = District::where('regency_id', $this->config->regencies_id)->get();
        foreach ($data['paslon'] as $ps) {
            $data['total' . $ps['id'] . ''] = SaksiData::where('paslon_id', $ps['id'])->sum('voice');
        }
        return view('count.realcount', $data);
    }

    public function history()
    {
        $data['history'] = History::join('users', 'users.id', '=', 'history.user_id')->get();
        return view('publik.history', $data);
    }

    public function disclaimer()
    {
        return view('publik.disclaimer');
    }

    public function get_tps_quick(Request $request)
    {
        $data['tps'] = Tps::where('villages_id', $request['id'])->where('sample', 1)->get();
        $data['candidate'] = Paslon::get();
        $data['kelurahan'] = Village::where('id', '' . $request['id'])->first();
        return view('publik.ajax.public_tps_quick', $data);
    }
    public function get_tps_quick2(Request $request)
    {
        $data['tps'] = Tps::where('villages_id', $request['id'])->where('quick_count', 1)->get();
        $data['candidate'] = Paslon::get();
        $data['kelurahan'] = Village::where('id', '' . $request['id'])->first();
        return view('publik.ajax.public_tps_quick', $data);
    }

    public function quick_index(Request $request, $id)
    {
        $data['saksi'] =  Saksi::where('tps_id', Crypt::decrypt($id))->get();
        $data['tps'] = Tps::find(Crypt::decrypt($id))->first();
        if (count($data['saksi']) == 0) {
            return view('publik.result_null');
        } else {
            return view('publik.index_tps', $data);
        }
    }
    public function fraud()
    {
        $data['qrcode'] = QrCode::get();
        return view('publik.fraud', $data);
    }

    public function backend_file()
    {
        echo true;
    }

    public function real_count_public()
    {
        $data['config'] = Config::first();
        $config = $data['config'];
        $data['kota'] = Regency::where('id', $this->config->regencies_id)->first();
        $data['provinsi'] = Province::where('id', $data['kota']['province_id'])->first();
        $data['paslon'] = Paslon::get();
        $data['kecamatan'] = District::where('regency_id', $this->config->regencies_id)->get();
        foreach ($data['paslon'] as $ps) {
            $data['total' . $ps['id'] . ''] = SaksiData::where('paslon_id', $ps['id'])->sum('voice');
        }

        return view('publik.public_count.real_count', $data);
    }

    public function quick_count_public()
    {
        $data['config'] = Config::first();
        $config = $data['config'];
        $data['kota'] = Regency::where('id', $this->config->regencies_id)->first();
        $data['provinsi'] = Province::where('id', $data['kota']['province_id'])->first();
        $data['paslon'] = Paslon::get();
        $data['kecamatan'] = District::where('regency_id', $this->config->regencies_id)->get();
        foreach ($data['paslon'] as $ps) {
            $data['total' . $ps['id'] . ''] = SaksiData::where('paslon_id', $ps['id'])->sum('voice');
        }

        return view('publik.public_count.quick_count', $data);
    }

    public function map_count_public()
    {
        $data['config'] = Config::first();
        $config = $data['config'];
        $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->where('saksi.regency_id', $this->config->regencies_id)->get();
        $data['kota'] = Regency::where('id', $this->config->regencies_id)->first();
        $data['provinsi'] = Province::where('id', $data['kota']['province_id'])->first();
        $data['paslon'] = Paslon::get();
        $data['kecamatan'] = District::where('regency_id', $this->config->regencies_id)->get();
        foreach ($data['paslon'] as $ps) {
            $data['total' . $ps['id'] . ''] = SaksiData::where('paslon_id', $ps['id'])->sum('voice');
        }

        return view('administrator.count.maps_count', $data);
    }
    public function get_tps_kelurahan(Request $request)
    {
        $data['saksi'] =  Saksi::where('tps_id', $request['id'])->get();
        $data['tps'] = Tps::where('id', $request['id'])->first();
        $data['kecamatan'] = District::where('id',  $data['tps']['district_id'])->first();
        $data['kelurahan'] = Village::where('id',  $data['tps']['villages_id'])->first();
        $data['config'] = Config::first();
        $data['surat_suara'] = SuratSuara::where('tps_id',$request['id'])->first();
        if (count($data['saksi']) == 0) {
            return view('publik.ajax.result_eror');
        } else {
            return view('administrator.ajax.tps', $data);
        }
    }
    public function kicked()
    {
        $data['track'] = Tracking::where('id_user', Auth::user()->id)->first();
        return view('publik.ajax.kicked', $data);
    }
    public function scanSecure($id)
    {
        $data['title'] = "ini";
        $data['nomor_berkas'] = $id;

        return view('auth.scan_secure', $data);
    }
}
