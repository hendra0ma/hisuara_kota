<?php

namespace App\Http\Controllers;

use App\Models\Buktifoto as ModelsBuktifoto;
use App\Events\CommanderEvent;
use App\Models\Config;
use App\Models\District;
use App\Models\Koreksi;
use App\Models\Paslon;
use App\Models\Regency;
use App\Models\Rekapitulator as ModelsRekapitulator;
use App\Models\Rekening as ModelsRekening;
use App\Models\SaksiData;
use App\Models\Qrcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Saksi;
use App\Models\Sessions;
use App\Models\Absensi;
use App\Models\Bukti_deskripsi_curang;
use App\Models\Buktifoto;
use App\Models\Buktividio;
use App\Models\Listkecurangan as ModelsListkecurangan;
use App\Models\NotificationCommander;
use App\Models\Tps;
use App\Models\Tracking as ModelsTracking;
use App\Models\User;
use App\Models\Country;
use App\Models\Databukti;
use App\Models\History;
use App\Models\Village;
use App\Models\Relawan;
use App\Models\SolutionFraud;
use App\Models\Province;
use App\Models\QuickSaksiData;
use App\Models\Configs;
use App\Models\CrowdC1;
use App\Models\DataCrowdC1;
use App\Models\RegenciesDomain;
use App\Models\SuratPernyataan;
use Carbon\Carbon;
use Exception;
use Facade\FlareClient\Http\Response;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Rekapitulator;
use Rekening;
use Tracking;
use Imagine\Image\Metadata\ExifMetadataReader;


class AdminController extends Controller
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
        $regency_id = RegenciesDomain::where('domain', "LIKE", "%" . $url . "%")->first();

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


    public function index()
    {
        date_default_timezone_set("Asia/Jakarta");
        $data['jam'] = date("H");
        $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->where('saksi.regency_id', $this->config->regencies_id)->get();

        $paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id,SUM(voice) as total FROM saksi_data WHERE regency_id = "' . $this->config->regencies_id . '" GROUP by paslon_id ORDER by total DESC'));

        // Periksa apakah data kosong
        if (count($paslon_tertinggi) > 0) {
            $data['paslon_tertinggi'] = Paslon::find($paslon_tertinggi[0]->paslon_id);
            $data['urutan'] = $paslon_tertinggi;
        } else {
            // Tetapkan nilai default atau ambil tindakan tertentu jika data kosong
            $data['paslon_tertinggi'] = null;
            $data['urutan'] = null;
        }

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
        $verification                     = Saksi::where('regency_id', $this->config->regencies_id)->where('verification', 1)->with('saksi_data')->get();
        $dpt                              = District::where('regency_id', $this->config->regencies_id)->sum("dpt") ?? 0;

        $incoming_vote                    = SaksiData::where('regency_id', $this->config->regencies_id)->select('voice')->get();
        $voice = SaksiData::sum('voice');
        $data['total_verification_voice'] = 0;
        $data['total_incoming_vote']      = SaksiData::where('regency_id', $this->config->regencies_id)->sum('voice') ?? 0;

        $data['realcount']                =  $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;
        $data['district']                 = District::where("regency_id", $this->config->regencies_id)->get();
        foreach ($verification as $key) {
            foreach ($key->saksi_data as $verif) {
                $data['total_verification_voice'] += $verif->voice;
            }
        }
        $data['saksi_masuk'] = Saksi::count();

        $data['tps_masuk'] = Tps::where('setup', 'terisi')->count();
        $data['total_tps']   =  Tps::where('setup', 'belum terisi')->count();
        $data['tps_kosong']  =  $data['total_tps'] - $data['tps_masuk'];


        $data['saksi_terverifikasi'] = Saksi::where('regency_id', $this->config->regencies_id)->where('verification', 1)->count();
        foreach ($incoming_vote as $key) {
            $data['total_incoming_vote'] += $key->voice;
        }
        $data['suara_masuk'] = SaksiData::where('regency_id', $this->config->regencies_id)->count('voice');
        $data['tracking'] = ModelsTracking::get();
        $data['config'] = Config::first();
        $data['kec'] = District::where('regency_id', $this->config->regencies_id)->get();
        $data['district_quick'] = District::where('regency_id', $this->config->regencies_id)->get();
        return view('administrator.index', $data);
    }

    public function kecamatan($id)
    {
        $data['config'] = Config::first();

      $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->where('saksi.regency_id', $this->config->regencies_id)->get();

        $paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id,SUM(voice) as total FROM saksi_data WHERE regency_id = "' . $this->config->regencies_id . '" GROUP by paslon_id ORDER by total DESC'));

        // Periksa apakah data kosong
        if (count($paslon_tertinggi) > 0) {
            $data['paslon_tertinggi'] = Paslon::find($paslon_tertinggi[0]->paslon_id);
            $data['urutan'] = $paslon_tertinggi;
        } else {
            // Tetapkan nilai default atau ambil tindakan tertentu jika data kosong
            $data['paslon_tertinggi'] = null;
            $data['urutan'] = null;
        }


        $data['paslon']  = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id', 'district_id')
                ->whereNull('saksi.pending')
                ->where('saksi.district_id', decrypt($id));
        }])->get();
        $data['paslon_terverifikasi']     = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id', 'district_id')
                ->whereNull('saksi.pending')
                ->where('saksi.verification', 1)->where('saksi.district_id', decrypt($id));
        }])->get();
        $verification = Saksi::where('verification', 1)->with('saksi_data')->where('district_id', decrypt($id))->get();
        $dpt = District::where('regency_id', $this->config->regencies_id)->sum("dpt");
        $incoming_vote = SaksiData::select('voice')->where('district_id', decrypt($id))->get();
        $data['total_verification_voice'] = 0;
        $data['total_incoming_vote']      = 0;
        foreach ($verification as $key) {
            foreach ($key->saksi_data as $verif) {
                $data['total_verification_voice'] += $verif->voice;
            }
        }
        foreach ($incoming_vote as $key) {
            $data['total_incoming_vote'] += $key->voice;
        }
        $data['realcount']   =  $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;
        $data['district']    = Village::where("district_id", decrypt($id))->get();
        $data['total_tps']   = Village::where('district_id', decrypt($id))->sum('tps');
        $data['tps_masuk']   = Tps::where('district_id', decrypt($id))->where('setup', 'terisi')->count('number');
        $data['tps_kosong']  = Tps::where('district_id', decrypt($id))->count('number');
        $data['suara_masuk'] = SaksiData::where('district_id', decrypt($id))->count('voice');
        $data['kecamatan'] = District::where('id', decrypt($id))->first();
        $data['tracking'] = ModelsTracking::where('id_user', '!=', 1)->get();
        return view('administrator.rekapitulasi.kecamatan', $data);
    }

    function getRealCountAjax() {
        date_default_timezone_set("Asia/Jakarta");
        $data['jam'] = date("H");
        $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->where('saksi.regency_id', $this->config->regencies_id)->get();

        $paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id,SUM(voice) as total FROM saksi_data WHERE regency_id = "' . $this->config->regencies_id . '" GROUP by paslon_id ORDER by total DESC'));

        // Periksa apakah data kosong
        if (count($paslon_tertinggi) > 0) {
            $data['paslon_tertinggi'] = Paslon::find($paslon_tertinggi[0]->paslon_id);
            $data['urutan'] = $paslon_tertinggi;
        } else {
            // Tetapkan nilai default atau ambil tindakan tertentu jika data kosong
            $data['paslon_tertinggi'] = null;
            $data['urutan'] = null;
        }

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
        $verification                     = Saksi::where('regency_id', $this->config->regencies_id)->where('verification', 1)->with('saksi_data')->get();
        $dpt                              = District::where('regency_id', $this->config->regencies_id)->sum("dpt") ?? 0;

        $incoming_vote                    = SaksiData::where('regency_id', $this->config->regencies_id)->select('voice')->get();
        $voice = SaksiData::sum('voice');
        $data['total_verification_voice'] = 0;
        $data['total_incoming_vote']      = SaksiData::where('regency_id', $this->config->regencies_id)->sum('voice') ?? 0;

        $data['realcount']                =  $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;
        $data['district']                 = District::where("regency_id", $this->config->regencies_id)->get();
        foreach ($verification as $key) {
            foreach ($key->saksi_data as $verif) {
                $data['total_verification_voice'] += $verif->voice;
            }
        }
        $data['saksi_masuk'] = Saksi::count();

        $data['tps_masuk'] = Tps::where('setup', 'terisi')->count();
        $data['total_tps']   =  Tps::where('setup', 'belum terisi')->count();
        $data['tps_kosong']  =  $data['total_tps'] - $data['tps_masuk'];


        $data['saksi_terverifikasi'] = Saksi::where('regency_id', $this->config->regencies_id)->where('verification', 1)->count();
        foreach ($incoming_vote as $key) {
            $data['total_incoming_vote'] += $key->voice;
        }
        $data['suara_masuk'] = SaksiData::where('regency_id', $this->config->regencies_id)->count('voice');
        $data['tracking'] = ModelsTracking::get();
        $data['config'] = Config::first();
        $data['kec'] = District::where('regency_id', $this->config->regencies_id)->get();
        $data['district_quick'] = District::where('regency_id', $this->config->regencies_id)->get();
        return view('administrator.perhitungan.ajax.real_count', $data);
    }

    function getTerverifikasiAjax() {
        date_default_timezone_set("Asia/Jakarta");
        $data['jam'] = date("H");
        $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->where('saksi.regency_id', $this->config->regencies_id)->get();

        $paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id,SUM(voice) as total FROM saksi_data WHERE regency_id = "' . $this->config->regencies_id . '" GROUP by paslon_id ORDER by total DESC'));

        // Periksa apakah data kosong
        if (count($paslon_tertinggi) > 0) {
            $data['paslon_tertinggi'] = Paslon::find($paslon_tertinggi[0]->paslon_id);
            $data['urutan'] = $paslon_tertinggi;
        } else {
            // Tetapkan nilai default atau ambil tindakan tertentu jika data kosong
            $data['paslon_tertinggi'] = null;
            $data['urutan'] = null;
        }

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
        $verification                     = Saksi::where('regency_id', $this->config->regencies_id)->where('verification', 1)->with('saksi_data')->get();
        $dpt                              = District::where('regency_id', $this->config->regencies_id)->sum("dpt") ?? 0;

        $incoming_vote                    = SaksiData::where('regency_id', $this->config->regencies_id)->select('voice')->get();
        $voice = SaksiData::sum('voice');
        $data['total_verification_voice'] = 0;
        $data['total_incoming_vote']      = SaksiData::where('regency_id', $this->config->regencies_id)->sum('voice') ?? 0;

        $data['realcount']                =  $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;
        $data['district']                 = District::where("regency_id", $this->config->regencies_id)->get();
        foreach ($verification as $key) {
            foreach ($key->saksi_data as $verif) {
                $data['total_verification_voice'] += $verif->voice;
            }
        }
        $data['saksi_masuk'] = Saksi::count();

        $data['tps_masuk'] = Tps::where('setup', 'terisi')->count();
        $data['total_tps']   =  Tps::where('setup', 'belum terisi')->count();
        $data['tps_kosong']  =  $data['total_tps'] - $data['tps_masuk'];


        $data['saksi_terverifikasi'] = Saksi::where('regency_id', $this->config->regencies_id)->where('verification', 1)->count();
        foreach ($incoming_vote as $key) {
            $data['total_incoming_vote'] += $key->voice;
        }
        $data['suara_masuk'] = SaksiData::where('regency_id', $this->config->regencies_id)->count('voice');
        $data['tracking'] = ModelsTracking::get();
        $data['config'] = Config::first();
        $data['kec'] = District::where('regency_id', $this->config->regencies_id)->get();
        $data['district_quick'] = District::where('regency_id', $this->config->regencies_id)->get();
        return view('administrator.perhitungan.ajax.terverifikasi', $data);
    }

    function getQuickCountAjax() {
        date_default_timezone_set("Asia/Jakarta");
        $data['jam'] = date("H");
        $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->where('saksi.regency_id', $this->config->regencies_id)->get();

        $paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id,SUM(voice) as total FROM saksi_data WHERE regency_id = "' . $this->config->regencies_id . '" GROUP by paslon_id ORDER by total DESC'));

        // Periksa apakah data kosong
        if (count($paslon_tertinggi) > 0) {
            $data['paslon_tertinggi'] = Paslon::find($paslon_tertinggi[0]->paslon_id);
            $data['urutan'] = $paslon_tertinggi;
        } else {
            // Tetapkan nilai default atau ambil tindakan tertentu jika data kosong
            $data['paslon_tertinggi'] = null;
            $data['urutan'] = null;
        }

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
        $verification                     = Saksi::where('regency_id', $this->config->regencies_id)->where('verification', 1)->with('saksi_data')->get();
        $dpt                              = District::where('regency_id', $this->config->regencies_id)->sum("dpt") ?? 0;

        $incoming_vote                    = SaksiData::where('regency_id', $this->config->regencies_id)->select('voice')->get();
        $voice = SaksiData::sum('voice');
        $data['total_verification_voice'] = 0;
        $data['total_incoming_vote']      = SaksiData::where('regency_id', $this->config->regencies_id)->sum('voice') ?? 0;

        $data['realcount']                =  $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;
        $data['district']                 = District::where("regency_id", $this->config->regencies_id)->get();
        foreach ($verification as $key) {
            foreach ($key->saksi_data as $verif) {
                $data['total_verification_voice'] += $verif->voice;
            }
        }
        $data['saksi_masuk'] = Saksi::count();

        $data['tps_masuk'] = Tps::where('setup', 'terisi')->count();
        $data['total_tps']   =  Tps::where('setup', 'belum terisi')->count();
        $data['tps_kosong']  =  $data['total_tps'] - $data['tps_masuk'];


        $data['saksi_terverifikasi'] = Saksi::where('regency_id', $this->config->regencies_id)->where('verification', 1)->count();
        foreach ($incoming_vote as $key) {
            $data['total_incoming_vote'] += $key->voice;
        }
        $data['suara_masuk'] = SaksiData::where('regency_id', $this->config->regencies_id)->count('voice');
        $data['tracking'] = ModelsTracking::get();
        $data['config'] = Config::first();
        $data['kec'] = District::where('regency_id', $this->config->regencies_id)->get();
        $data['district_quick'] = District::where('regency_id', $this->config->regencies_id)->get();
        return view('administrator.perhitungan.ajax.quick_count', $data);
    }

    function getRekapitulasiAjax() {
        date_default_timezone_set("Asia/Jakarta");
        $data['jam'] = date("H");
        $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->where('saksi.regency_id', $this->config->regencies_id)->get();

        $paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id,SUM(voice) as total FROM saksi_data WHERE regency_id = "' . $this->config->regencies_id . '" GROUP by paslon_id ORDER by total DESC'));

        // Periksa apakah data kosong
        if (count($paslon_tertinggi) > 0) {
            $data['paslon_tertinggi'] = Paslon::find($paslon_tertinggi[0]->paslon_id);
            $data['urutan'] = $paslon_tertinggi;
        } else {
            // Tetapkan nilai default atau ambil tindakan tertentu jika data kosong
            $data['paslon_tertinggi'] = null;
            $data['urutan'] = null;
        }

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
        $verification                     = Saksi::where('regency_id', $this->config->regencies_id)->where('verification', 1)->with('saksi_data')->get();
        $dpt                              = District::where('regency_id', $this->config->regencies_id)->sum("dpt") ?? 0;

        $incoming_vote                    = SaksiData::where('regency_id', $this->config->regencies_id)->select('voice')->get();
        $voice = SaksiData::sum('voice');
        $data['total_verification_voice'] = 0;
        $data['total_incoming_vote']      = SaksiData::where('regency_id', $this->config->regencies_id)->sum('voice') ?? 0;

        $data['realcount']                =  $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;
        $data['district']                 = District::where("regency_id", $this->config->regencies_id)->get();
        foreach ($verification as $key) {
            foreach ($key->saksi_data as $verif) {
                $data['total_verification_voice'] += $verif->voice;
            }
        }
        $data['saksi_masuk'] = Saksi::count();

        $data['tps_masuk'] = Tps::where('setup', 'terisi')->count();
        $data['total_tps']   =  Tps::where('setup', 'belum terisi')->count();
        $data['tps_kosong']  =  $data['total_tps'] - $data['tps_masuk'];


        $data['saksi_terverifikasi'] = Saksi::where('regency_id', $this->config->regencies_id)->where('verification', 1)->count();
        foreach ($incoming_vote as $key) {
            $data['total_incoming_vote'] += $key->voice;
        }
        $data['suara_masuk'] = SaksiData::where('regency_id', $this->config->regencies_id)->count('voice');
        $data['tracking'] = ModelsTracking::get();
        $data['config'] = Config::first();
        $data['kec'] = District::where('regency_id', $this->config->regencies_id)->get();
        $data['district_quick'] = District::where('regency_id', $this->config->regencies_id)->get();
        return view('administrator.perhitungan.ajax.rekapitulasi', $data);
    }

    function getKPUAjax() {
        date_default_timezone_set("Asia/Jakarta");
        $data['jam'] = date("H");
        $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->where('saksi.regency_id', $this->config->regencies_id)->get();

        $paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id,SUM(voice) as total FROM saksi_data WHERE regency_id = "' . $this->config->regencies_id . '" GROUP by paslon_id ORDER by total DESC'));

        // Periksa apakah data kosong
        if (count($paslon_tertinggi) > 0) {
            $data['paslon_tertinggi'] = Paslon::find($paslon_tertinggi[0]->paslon_id);
            $data['urutan'] = $paslon_tertinggi;
        } else {
            // Tetapkan nilai default atau ambil tindakan tertentu jika data kosong
            $data['paslon_tertinggi'] = null;
            $data['urutan'] = null;
        }

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
        $verification                     = Saksi::where('regency_id', $this->config->regencies_id)->where('verification', 1)->with('saksi_data')->get();
        $dpt                              = District::where('regency_id', $this->config->regencies_id)->sum("dpt") ?? 0;

        $incoming_vote                    = SaksiData::where('regency_id', $this->config->regencies_id)->select('voice')->get();
        $voice = SaksiData::sum('voice');
        $data['total_verification_voice'] = 0;
        $data['total_incoming_vote']      = SaksiData::where('regency_id', $this->config->regencies_id)->sum('voice') ?? 0;

        $data['realcount']                =  $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;
        $data['district']                 = District::where("regency_id", $this->config->regencies_id)->get();
        foreach ($verification as $key) {
            foreach ($key->saksi_data as $verif) {
                $data['total_verification_voice'] += $verif->voice;
            }
        }
        $data['saksi_masuk'] = Saksi::count();

        $data['tps_masuk'] = Tps::where('setup', 'terisi')->count();
        $data['total_tps']   =  Tps::where('setup', 'belum terisi')->count();
        $data['tps_kosong']  =  $data['total_tps'] - $data['tps_masuk'];


        $data['saksi_terverifikasi'] = Saksi::where('regency_id', $this->config->regencies_id)->where('verification', 1)->count();
        foreach ($incoming_vote as $key) {
            $data['total_incoming_vote'] += $key->voice;
        }
        $data['suara_masuk'] = SaksiData::where('regency_id', $this->config->regencies_id)->count('voice');
        $data['tracking'] = ModelsTracking::get();
        $data['config'] = Config::first();
        $data['kec'] = District::where('regency_id', $this->config->regencies_id)->get();
        $data['district_quick'] = District::where('regency_id', $this->config->regencies_id)->get();
        return view('administrator.perhitungan.ajax.kpu', $data);
    }


    public function rdata()
    {
        $data['visitor'] = ModelsTracking::count();
        $data['user_baru'] = User::orderBy('created_at')->count();
        $data['saksi_masuk'] = Saksi::count();
        $data['saksi_teregistrasi'] = User::where('role_id', 8)->count();
        $data['auditor_teregistrasi'] = User::where('role_id', 3)->count();
        $data['verifikator_teregistrasi'] = User::where('role_id', 2)->count();
        $data['validator_teregistrasi'] = User::where('role_id', 10)->count();
        $data['checking_teregistrasi'] = User::where('role_id', 5)->count();
        $data['hunter_teregistrasi'] = User::where('role_id', 6)->count();
        $data['hukum_teregistrasi'] = User::where('role_id', 7)->count();
        $data['huver_teregistrasi'] = User::where('role_id', 20)->count();
        $data['saksi_terblokir'] = User::where('role_id', 0)->count();
        $data['auditor_terblokir'] = User::where('role_id', 0)->count();
        $data['verifikator_terblokir'] = User::where('role_id', 0)->count();
        $data['auditor_terblokir'] = User::where('role_id', 0)->count();
        $data['validator_terblokir'] = User::where('role_id', 0)->count();
        $data['checking_terblokir'] = User::where('role_id', 0)->count();
        $data['hunter_terblokir'] = User::where('role_id', 0)->count();
        $data['hukum_terblokir'] = User::where('role_id', 0)->count();
        $data['huver_terblokir'] = User::where('role_id', 0)->count();
        $data['saksi_baru'] = User::where('role_id', 8)->limit(12)->orderBy('created_at')->get();
        $data['admin_baru'] =  User::where('role_id', '!=', 8)->limit(12)->orderBy('created_at')->get();
        $data['data_relawan'] = Relawan::count();
        $data['data_overlimit'] = Saksi::where('overlimit', '!=', 0)->count();
        $data['bukti_foto_kecurangan'] = ModelsBuktifoto::count();
        $data['bukti_video_kecurangan'] = Buktividio::count();
        $data['tps_koreksi'] = Saksi::whereNotNull('koreksi')->count();
        $data['config'] = Config::first();
        return view('administrator.r_data_recorder', $data);
    }


    public function kelurahan($id)
    {
        $data['config'] = Config::first();

        $paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id,SUM(voice) as total FROM saksi_data WHERE regency_id = "' . $this->config->regencies_id . '" GROUP by paslon_id ORDER by total DESC'));

        // Periksa apakah data kosong
        if (count($paslon_tertinggi) > 0) {
            $data['paslon_tertinggi'] = Paslon::find($paslon_tertinggi[0]->paslon_id);
            $data['urutan'] = $paslon_tertinggi;
        } else {
            // Tetapkan nilai default atau ambil tindakan tertentu jika data kosong
            $data['paslon_tertinggi'] = null;
            $data['urutan'] = null;
        }


      $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->where('saksi.regency_id', $this->config->regencies_id)->get();
        $data['paslon'] = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query
                ->join('saksi', 'saksi_data.saksi_id', 'saksi.id', 'district_id')
                ->whereNull('saksi.pending')
                ->where('saksi.village_id', decrypt($id));
        }])->get();
        $data['paslon_terverifikasi'] = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query
                ->join('saksi', 'saksi_data.saksi_id', 'saksi.id', 'district_id')
                ->where('saksi.verification', 1)
                ->whereNull('saksi.pending')
                ->where('saksi.village_id', decrypt($id));
        }])->get();

        $dpt = District::where('regency_id', $this->config->regencies_id)->sum("dpt");
        $data['total_incoming_vote'] = 0;
        $incoming_vote = SaksiData::select('voice')->where('village_id', decrypt($id))->get();
        foreach ($incoming_vote as $key) {
            $data['total_incoming_vote'] += $key->voice;
        }
        $verification = Saksi::where('verification', 1)->with('saksi_data')->where('village_id', decrypt($id))->get();
        $data['total_incoming_vote'] = 0;
        $data['total_verification_voice'] = 0;
        foreach ($verification as $key) {
            foreach ($key->saksi_data as $verif) {
                $data['total_verification_voice'] += $verif->voice;
            }
        }
        $data['tps_masuk']   = Tps::where('villages_id', decrypt($id))->where('setup', 'terisi')->sum('number');
        $data['realcount']   =  $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;
        $data['district']    = Village::where("id", decrypt($id))->get();
        $data['total_tps']   = Village::where('id', decrypt($id))->sum('tps');
        $data['tps_masuk']   = Tps::where('villages_id', decrypt($id))->where('setup', 'terisi')->count('number');
        $data['tps_kosong']  = Tps::where('villages_id', decrypt($id))->count('number');
        $data['suara_masuk'] = SaksiData::where('village_id', decrypt($id))->count('voice');
        $data['saksi']       = Saksi::where('village_id', decrypt($id))->get();

        $id = Crypt::decrypt($id);

        $data['regency'] = Regency::where('id', $this->config->regencies_id)->first();

        $data['village'] = Village::where('id', $id)->first();
        $data['district'] = District::where('id', (string)$data['village']->district_id)->first();

        $data['jumlah_tps_masuk'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('tps.villages_id', $id)->count();
        $data['jumlah_tps_terverifikai'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('tps.villages_id', $id)->where('saksi.verification', 1)->count();
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('tps.villages_id', $id)
            ->where('saksi.verification', '')
            ->whereNull('saksi.pending')
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->get();
        return view('administrator.rekapitulasi.kelurahan', $data);
    }

    public function verifikasi_akun()
    {
        $data['config'] = Config::first();
        $data['jumlah_admin'] = User::where('role_id', '!=', 8)->where('is_active', '=', '2')->count();
        return view('administrator.verifikasi.verifikasi_akun', $data);
    }

    function CrowdC1Id(Request $request)
    {
        $crowd = CrowdC1::where('tps_id', $request->id)->first();

        $data['crowd'] = $crowd;
        $data['user'] = User::where('id', $crowd->user_id)->first();
        $data['regency']  = Regency::where("id", $crowd->regency_id)->first();
        $data['district']  = District::where("id", $crowd->district_id)->first();
        $data['village']  = Village::where("id", $crowd->village_id)->first();
        $data['tps']  = Tps::where("id", $crowd->tps_id)->first();
        $data['paslon']  = Paslon::get();

        return view('administrator.ajax.get_verify_crowd', $data);
    }

    function simpanSuaraC1Crowd(Request $request)
    {

        $this->validate($request, [
            'suara.*' => "required|numeric",
        ]);
        $error = false;
        $jumlah = 0;
        foreach ($request->suara as $suara) {
            $jumlah += $suara;
        }
        if ((int)$jumlah > 300) {
            $error = true;
        }
        if ($error) {
            return redirect()->back()->with('error', 'data tidak boleh lebih dari 300');
        }

        $crowd = CrowdC1::where('id', $request->crowd_id)->first();



        $saksi = new Saksi;
        $saksi->c1_images = $crowd->crowd_c1;
        $saksi->verification = "";
        $saksi->audit = "";
        $saksi->district_id = $crowd->district_id;
        $saksi->batalkan = "0";
        $saksi->village_id =  $crowd->village_id;
        $saksi->overlimit = 0;
        $saksi->tps_id = $crowd->tps_id;
        $saksi->regency_id = $crowd->regency_id;
        $saksi->province_id = substr($crowd->regency_id, 0, 2);


        $saksi->save();
        $ide = $saksi->id;
        $paslon = Paslon::get();
        $i = 0;
        foreach ($paslon as $item) {
            SaksiData::create([
                'user_id' =>  $crowd->user_id,
                'paslon_id' =>  $item->id,
                'district_id' => $crowd->district_id,
                'village_id' =>  $crowd->village_id,
                'regency_id' => $crowd->regency_id,
                'province_id' => substr($crowd->regency_id, 0, 2),
                'voice' =>  (int)$request->suara[$i],
                'saksi_id' => $ide,
            ]);
            DataCrowdC1::insert([
                'user_id' => $crowd->user_id,
                'paslon_id' =>  $item->id,
                'village_id' =>  $crowd->village_id,
                'tps_id' => $crowd->tps_id,
                'district_id' =>  $crowd->district_id,
                'regency_id' => $crowd->regency_id,
                'created_at' => Carbon::now(),
                'crowd_c1_id' =>$request->crowd_id,
                'voice' => $request->suara[$i]

            ]);
            $i++;
        }
        CrowdC1::where('id', $request->crowd_id)->update([
            "status" => "1",
            "petugas_id" => Auth::user()->id
        ]);
        return redirect()->back()->with('success', 'Berhasil Menambah Data Realcount dari C1 Crowd');
    }


    public function dataC1()
    {
        $data['config'] = Config::first();
        $data['jumlah_c1'] = Saksi::count();
        return view('administrator.perdataan.data-c1', $data);
    }

    public function crowdC1()
    {
        $data['config'] = Config::first();
        $data['jumlah_c1'] = CrowdC1::join('tps', 'crowd_c1.tps_id', '=', 'tps.id')->where('status', '0')->where('crowd_c1.regency_id', $this->config->regencies_id)->count();

        return view('administrator.c1.crowd-c1-kpu', $data);
    }

    public function dataCrowdC1()
    {
        $data['config'] = Config::first();
        $data['jumlah_c1'] = CrowdC1::join('tps', 'crowd_c1.tps_id', '=', 'tps.id')->where('status', '1')->where('crowd_c1.regency_id', $this->config->regencies_id)->count();

        return view('administrator.c1.data-crowd-c1-kpu', $data);
    }

    public function admin_terverifikasi()
    {
        $data['config'] = Config::first();
        $data['jumlah_admin_terverifikasi'] = User::where('role_id', '!=', 8)->where('is_active', '=', '1')->count();
        return view('administrator.verifikasi.admin_terverifikasi', $data);
    }

    public function verifikasi_saksi()
    {
        $data['config'] = Config::first();
        $data['jumlah_saksi'] = User::where('role_id', '=', 8)->where('is_active', '=', 0)->count();
        return view('administrator.verifikasi.verifikasi_saksi', $data);
    }

    public function koordinator_saksi()
    {
        $data['config'] = Config::first();
        $data['jumlah_saksi'] = User::where('role_id', '=', 8)->where('is_active', '=', 0)->count();
        return view('administrator.verifikasi.koordinator_saksi', $data);
    }

    public function koordinator_kecamatan()
    {
        $data['config'] = Config::first();
        $data['jumlah_saksi'] = User::where('role_id', '=', 8)->where('is_active', '=', 0)->count();
        return view('administrator.verifikasi.koordinator_kecamatan', $data);
    }

    public function koordinator_kelurahan()
    {
        $data['config'] = Config::first();
        $data['jumlah_saksi'] = User::where('role_id', '=', 8)->where('is_active', '=', 0)->count();
        return view('administrator.verifikasi.koordinator_kelurahan', $data);
    }

    public function koordinator_rw()
    {
        $data['config'] = Config::first();
        $data['jumlah_saksi'] = User::where('role_id', '=', 8)->where('is_active', '=', 0)->count();
        return view('administrator.verifikasi.koordinator_rw', $data);
    }

    public function koordinator_rt()
    {
        $data['config'] = Config::first();
        $data['jumlah_saksi'] = User::where('role_id', '=', 8)->where('is_active', '=', 0)->count();
        return view('administrator.verifikasi.koordinator_rt', $data);
    }

    public function saksi_ditolak()
    {
        $data['config'] = Config::first();
        $data['jumlah_saksi_ditolak'] = User::where('role_id', '=', 8)->where('is_active', '=', 5)->count();
        return view('administrator.verifikasi.saksi_ditolak', $data);
    }

    public function Enumerator()
    {
        $data['config'] = Config::first();
        $data['jumlah_saksi'] = User::where('role_id', '=', 8)->where('is_active', '=', 0)->count();
        return view('administrator.enumerator.enumerator', $data);
    }

    public function EnumeratorTeregistrasi()
    {
        $data['config'] = Config::first();
        $data['jumlah_saksi_teregistrasi'] = User::where('role_id', 8)->where('is_active', '=', 1)->count();
        return view('administrator.enumerator.enumerator_teregistrasi', $data);
    }

    public function EnumeratorHadir()
    {
        $data['config'] = Config::first();
        $data['jumlah_hadir'] = Absensi::join('users', 'users.id', '=', 'absensi.user_id')->where('users.absen', '=', 'hadir')->where('is_active', '=', 1)->count();
        return view('administrator.enumerator.enumerator_hadir', $data);
    }

    public function EnumeratorTidakHadir()
    {
        $data['config'] = Config::first();
        $data['jumlah_tidak_hadir'] = User::where('role_id', 8)->where('absen', 'tidak hadir')->where('is_active', '=', 1)->count();
        return view('administrator.enumerator.enumerator_tidak_hadir', $data);
    }

    public function EnumeratorDitolak()
    {
        $data['config'] = Config::first();
        $data['jumlah_saksi_ditolak'] = User::where('role_id', '=', 8)->where('is_active', '=', 5)->count();
        return view('administrator.enumerator.enumerator_ditolak', $data);
    }

    public function VerifikasiCrowdC1()
    {
        $data['config'] = Config::first();
        // $data['jumlah_saksi'] = User::where('role_id', '=', 17)->where('is_active', '=', 0)->count();
        $data['jumlah_saksi'] = User::where('role_id', '=', 8)->where('is_active', '=', 0)->count();
        return view('administrator.verifikasi.crowd-c1', $data);
    }

    public function CrowdC1Terverifikasi()
    {
        $data['config'] = Config::first();
        $config = Config::first();
        $data['kota']      = Regency::where('id', $this->config->regencies_id)->first();
        // $data['jumlah_saksi_teregistrasi'] = User::where('role_id', 17)->where('is_active', '=', 1)->count();
        $data['jumlah_saksi_teregistrasi'] = User::where('role_id', 8)->where('is_active', '=', 1)->count();

        // $data['title'] = 'Saksi Teregistrasi (' . $data['jumlah'] . ')';
        $data['title'] = 'Saksi Teregistrasi';

        return view("administrator.verifikasi.crowd-c1-terverifikasi", $data);
    }

    public function verifikasi_koreksi()
    {
        $data['config'] = Config::first();
        $data['saksi_data'] = Saksi::join('users', 'users.tps_id', '=', 'saksi.tps_id')->where('koreksi', 1)->get();
        // $data['village'] = Village::where('id', $data['saksi_data'][0]->village_id)->first();
        $data['total_tps']   =  Tps::where('setup', 'belum terisi')->count();
        $data['tracking'] = ModelsTracking::get();
        $data['jumlah_tps_masuk'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->count();
        $data['jumlah_tps_terverifikai'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('saksi.verification', 1)->count();
        if (count($data['saksi_data']) > 0) {
            $data['village'] = Village::where('id', $data['saksi_data'][0]->village_id)->first();
        }
        return view('administrator.verifikasi.verifikasi_koreksi', $data);
    }

    public function get_koreksi_saksi(Request $request)
    {
        $data['config'] = Config::first();
        $data['saksi']  =  Saksi::where('id', $request['id'])->first();

        $data['saksi_data'] = SaksiData::where('saksi_id', $request['id'])->get();
        // $data['saksi_data_baru'] = Saksi::where('saksi_id', $request['id'])->get();
        // $data['saksi_data_baru_deskripsi'] = Saksi::where('saksi_id', $request['id'])->first();
        $data['admin_req'] = User::where('id', $data['saksi']['kecurangan_id_users'])->first();
        $data['saksi_koreksi'] = User::where('tps_id', $data['saksi']['tps_id'])->first();
        $data['kelurahan'] = Village::where('id', $data['saksi']['village_id'])->first();
        $data['kecamatan'] = District::where('id', $data['saksi']['district_id'])->first();
        $data['tps'] = Tps::where('id', $data['saksi']['tps_id'])->first();

        return view('administrator.ajax.get_koreksi_saksi', $data);
    }

    public function action_setujui(Request $request, $id)
    {
        $data['config'] = Config::first();

        $koreksi = Koreksi::where('saksi_id', Crypt::decrypt($id))->get();
        return $koreksi;
        foreach ($koreksi as $psl) {
            SaksiData::where('saksi_id', Crypt::decrypt($id))->where('paslon_id', $psl['paslon_id'])->update([
                'voice' => $psl['voice'],
            ]);
            Koreksi::where('saksi_id', Crypt::decrypt($id))->where('paslon_id', $psl['paslon_id'])->update([
                'status' => 'selesai',
            ]);
        }
        Saksi::where('id', Crypt::decrypt($id))->update([
            'verification' => 1
        ]);
        return redirect('administrator/verifikasi_koreksi');
    }
    public function actionSetujuKoreksiAuditor(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $paslon = Paslon::get();
        foreach ($paslon as $pas) {
            // $saksi_data = SaksiData::where('paslon_id',$pas->id)->where('saksi_id',$id)->first();
            SaksiData::where('paslon_id', $pas->id)->where('saksi_id', $id)->update(
                [
                    "voice" => $request->input('paslon' . $pas->id),
                ]
            );
        }
        Saksi::where('id', $id)->update([
            'verification' => "1",
            'batalkan' => 0
        ]);
        return redirect()->back()->with('success', 'berhasil memperbarui data koreksi c1');
    }

    public function tolak_koreksi(Request $request, $id)
    {
        $data['config'] = Config::first();
        $koreksi = Koreksi::where('saksi_id', Crypt::decrypt($id))->get();
        foreach ($koreksi as $psl) {
            Koreksi::where('saksi_id', Crypt::decrypt($id))->where('paslon_id', $psl['paslon_id'])->update([
                'status' => 'ditolak',
            ]);
        }
        return redirect('administrator/verifikasi_koreksi');
    }

    public function real_count()
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
        return view('administrator.count.real_count', $data);
    }

    public function quick_count()
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
        return view('administrator.count.quick_count', $data);
    }

    public function maps_count()
    {
      $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->where('saksi.regency_id', $this->config->regencies_id)->get();
        $data['config'] = Config::first();
        $config = $data['config'];
        $data['kota'] = Regency::where('id', $this->config->regencies_id)->first();
        $data['provinsi'] = Province::where('id', $data['kota']['province_id'])->first();
        $data['paslon'] = Paslon::get();
        $data['kecamatan'] = District::where('regency_id', $this->config->regencies_id)->get();
        foreach ($data['paslon'] as $ps) {
            $data['total' . $ps['id'] . ''] = SaksiData::where('paslon_id', $ps['id'])->sum('voice');
        }

        return view('administrator.count.maps_count', $data);
    }

    public function patroli_mode()
    {
        $data['config'] = Config::first();

        $config = Config::first();
        $data['config'] = Config::first();
        $data['team'] = User::where('role_id', '!=', 8)->get();
        $data['district'] = District::where('regency_id',  $this->config->regencies_id)->get();


        return view('administrator.commander.patroli', $data);
    }

    public function tracking_maps()
    {
        $data['config'] = Config::first();

        $config = Config::first();
        $data['config'] = Config::first();
        $data['tracking'] = ModelsTracking::where('id_user', '!=', 2)->get();
        $data['district'] = District::where('regency_id',  $this->config->regencies_id)->get();
        return view('administrator.commander.tracking.maps', $data);
    }

    public function tracking_detail($id)
    {
        $data['config'] = Config::first();

        $config = Config::first();
        $data['config'] = Config::first();
        $data['tracking'] = ModelsTracking::where('id_user', decrypt($id))->get();
        $data['profile']  = User::where('id', decrypt($id))->first();
        $data['district'] = District::where('regency_id',  $this->config->regencies_id)->get();
        return view('administrator.commander.tracking.detail', $data);
    }


    public function get_verifikasi_saksi(Request $request)
    {
        // dump($request->url);
        $user                       = User::where('id', $request['id'])->first();
        $district                   = District::where('id', $user['districts'])->first();
        $village                    = Village::where('id', $user['villages'])->first();
        $tps                        = Tps::where('user_id', $user['id'])->first();
        $absensi                    = Absensi::where('user_id', $user['id'])->first();
        $qrcode                     = Qrcode::where('tps_id', $user['tps_id'])->first();
        if ($qrcode != null) {
            $verifikator            = User::where('id', $qrcode['verifikator_id'])->first();
            $hukum                  = User::where('id', $qrcode['hukum_id'])->first();
        } else {
            $verifikator            = null;
            $hukum                  = null;
        }
        $bukti_vidio                = Buktividio::where('tps_id', $tps['id'])->get();
        $bukti_foto                 = Buktifoto::where('tps_id', $tps['id'])->get();
        $saksi                      = Saksi::where('tps_id', $tps['id'])->first();
        $surat_pernyataan           = SuratPernyataan::where('saksi_id', $saksi['id'])->first();
        $config                     = Config::first();
        $kota                       = Regency::where('id', $this->config->regencies_id)->first();
        $list_kecurangan            = Bukti_deskripsi_curang::join('list_kecurangan', 'list_kecurangan.id', '=', 'bukti_deskripsi_curang.list_kecurangan_id')
            ->join('solution_frauds', 'solution_frauds.id', '=', 'list_kecurangan.solution_fraud_id')
            ->where('bukti_deskripsi_curang.tps_id', $tps['id'])
            ->get();


        return view('administrator.ajax.get_verifikasi_saksi', [
            'user' => $user,
            'village' => $village,
            'district' => $district,
            'tps' => $tps,
            'absensi' => $absensi,
            'saksi' => $saksi,
            'qrcode' => $qrcode,
            'bukti_vidio' => $bukti_vidio,
            'bukti_foto' => $bukti_foto,
            'surat_pernyataan' => $surat_pernyataan,
            'verifikator' => $verifikator,
            'hukum' => $hukum,
            'kota' => $kota,
            'list_kecurangan' => $list_kecurangan,
            'config' => Config::first(),
            'url' => $request->url,
        ]);
    }

    public function get_kecamatan_tracking(Request $request)
    {
        $data['user'] = User::where('districts', $request['id'])
            ->where([
                ['role_id', '!=', 8],
                ['role_id', '!=', 1],
                ['role_id', '!=', 7],
            ])->get();
        $data['config'] = Config::first();
        if (count($data['user']) == 0) {
            return view('administrator.ajax.result_eror');
        } else {
            return view('administrator.ajax.get_kecamatan_tracking', $data);
        }
    }
    public function get_verifikasi_akun(Request $request)
    {
        $user        = User::where('id', $request['id'])->first();
        $district    = District::where('id', $user['districts'])->first();
        $village     = Village::where('id', $user['villages'])->first();

        $tps     = Tps::where('user_id', $user['id'])->first();
        return view('administrator.ajax.get_verifikasi_akun', [
            'user' => $user,
            'district' => $district,
        ]);
    }

    public function get_history_user(Request $request)
    {
        $data['user'] = User::find($request['id'])->history()->get();
        $data['config'] = Config::first();
        $data['profiles'] = User::where('id', $request['id'])->get();

        if (count($data['user']) == 0) {
            return view('administrator.ajax.result_eror');
        } else {
            return view('administrator.ajax.get_history_user', $data);
        }
    }

    public function action_verifikasi(Request $request, $id)
    {
        $user = User::where('id', decrypt($id))->update([
            'is_active' => decrypt($request['aksi']),
        ]);
        $data['config'] = Config::first();
        $role = User::where('id', decrypt($id))->first();
        if ($role['role_id'] == 8) {
            return redirect('administrator/verifikasi_saksi');
        } else {
            return redirect('administrator/verifikasi_akun');
        }
    }
    public function get_test()
    {
        $data['angka'] = rand();
        echo json_encode($data);
    }

    public function pembayaran_saksi()
    {
        $data['rekening'] = User::join('rekening_users', 'users.id', '=', 'rekening_users.user_id')
            ->join('bank', 'bank.id', "=", "rekening_users.bank_id")
            ->get(['users.*', 'rekening_users.*', 'bank.*']);
        return view('administrator.pembayaran.index', $data);
    }
    public function kick(Request $request)
    {
        // $session = Sessions::where('user_id', Crypt::decrypt($request['id']));
        // $session->delete();

        $user = User::where('id', (string)Crypt::decrypt($request['id']))->update([
            'role_id' => 33,
        ]);
        return redirect('administrator/patroli_mode/tracking/detail/' . $request['id']);
    }

    public function blokir(Request $request)
    {
        $user = User::where('id', Crypt::decrypt($request['id']))->update([
            'role_id' => '0',
        ]);
        if ($user) {
            return redirect('administrator/patroli_mode/tracking/detail/' . $request['id']);
        } else {
            echo 'Eror Tidak Dikenal Harap Hubungi Admin';
        }
    }

    function getModaCek1(Request $request)
    {
        try {
            // Decrypt the TPS ID from the request
            // $encryptedTpsId = $request->segment(3);
            $decryptedTpsId = Crypt::decrypt($request->id);

            // dd($decryptedTpsId);

            // Retrieve Saksi data based on the decrypted TPS ID
            $saksi = Saksi::join('tps', 'tps.id', 'saksi.tps_id')->where('tps_id', (string)$decryptedTpsId)->first();
            // $data['saksi'] = Saksi::where('tps_id', (string)$decryptedTpsId)->first();

            // Prepare data array with default values
            $data = [
                'saksi' => $saksi,
                'qrcode' => null,
                'verifikator' => null,
                'hukum' => null,
            ];

            $data['tps'] = Tps::where('id', $data['saksi']['tps_id'])->first();

            // Check if there's a QR code associated with the TPS
            $qrcode = Qrcode::where('tps_id', $saksi['tps_id'])->first();

            if ($qrcode) {
                // If QR code exists, retrieve additional data
                $data['qrcode'] = $qrcode;
                $data['verifikator'] = User::find($qrcode->verifikator_id);
                $data['hukum'] = User::find($qrcode->hukum_id);
            }

            $data['user'] = User::where('tps_id', $saksi['tps_id'])->first();
            // dd($data['user']);
            // dd($data['saksi']);

            // Return the view with the data
            return view('administrator.ajax.get-moda-cek-1', $data);
        } catch (Exception $e) {
            // Handle decryption exception
            // Log::error('Invalid payload: ' . );
            // dd($e);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function rekapitulator(Request $request)
    {
        $data['config'] = Config::first();

        $rekapitulator = ModelsRekapitulator::where('district_id', Crypt::decrypt($request['id']))->get();
        if (count($rekapitulator) == 0) {
            $district = Village::where('district_id', Crypt::decrypt($request['id']))->get();
            $paslon   = Paslon::get();
            foreach ($paslon as $psl) {
                foreach ($district as $ds) {
                    $rekapitulator_form =  ModelsRekapitulator::create([
                        'village_id' => $ds['id'],
                        'district_id' => Crypt::decrypt($request['id']),
                        'paslon_id' => $psl['id'],
                    ]);
                }
            }
        }
        $data['config'] = Config::first();
        $data['kecamatan'] = Village::where('district_id', Crypt::decrypt($request['id']))->get();
        // $data['rekapitulator'] = Village::join('rekapitulator', 'villages.id', '=', 'rekapitulator.village_id')
        // ->join('paslon','paslon.id','=','rekapitulator.paslon_id')
        // ->get();
        $data['suara'] = Paslon::get();
        $data['id'] = Crypt::decrypt($request['id']);
        return view('administrator.rekapitulasi.rekapitulator', $data);
    }

    public function action_rekapitulator(Request $request, $id)
    {
        $rekapitulator = ModelsRekapitulator::where('village_id', Crypt::decrypt($id))->get();
        foreach ($rekapitulator as $key) {
            ModelsRekapitulator::where('id', $key['id'])->update([
                'value' => $request[$key['id']],
            ]);
        }
        return redirect('administrator/kecamatan/rekapitulator/' . Crypt::encrypt($request['id']));
    }

    public function master_data_tps()
    {
        $data['config'] = Config::first();

        return view('administrator.master_data_tps');
    }

    public function laporan()
    {
        $data['config'] = Config::first();

        return view('administrator.bantuan.laporan');
    }

    public function pusat_bantuan()
    {
        $data['config'] = Config::first();

        return view('administrator.bantuan.pusat_bantuan');
    }

    public function tentang()
    {
        $data['config'] = Config::first();

        return view('administrator.bantuan.tentang');
    }

    public function tutorial()
    {
        $data['config'] = Config::first();

        return view('administrator.bantuan.tutorial');
    }



    public function perhitungan_kecamatan($id)
    {
        $paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id,SUM(voice) as total FROM saksi_data WHERE regency_id = "' . $this->config->regencies_id . '" GROUP by paslon_id ORDER by total DESC'));

        // Periksa apakah data kosong
        if (count($paslon_tertinggi) > 0) {
            $data['paslon_tertinggi'] = Paslon::find($paslon_tertinggi[0]->paslon_id);
            $data['urutan'] = $paslon_tertinggi;
        } else {
            // Tetapkan nilai default atau ambil tindakan tertentu jika data kosong
            $data['paslon_tertinggi'] = null;
            $data['urutan'] = null;
        }

        
      $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->where('saksi.regency_id', $this->config->regencies_id)->get();
        $data['paslon']  = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id', 'district_id')
                ->whereNull('saksi.pending')
                ->where('saksi.district_id', decrypt($id));
        }])->get();
        $data['paslon_terverifikasi']     = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id', 'district_id')
                ->whereNull('saksi.pending')
                ->where('saksi.verification', 1)->where('saksi.district_id', decrypt($id));
        }])->get();
        $verification = Saksi::where('verification', 1)->with('saksi_data')->where('district_id', decrypt($id))->get();
        $dpt = District::where('regency_id', $this->config->regencies_id)->sum("dpt");
        $incoming_vote = SaksiData::select('voice')->where('district_id', decrypt($id))->get();
        $data['total_verification_voice'] = 0;
        $data['total_incoming_vote']      = 0;
        foreach ($verification as $key) {
            foreach ($key->saksi_data as $verif) {
                $data['total_verification_voice'] += $verif->voice;
            }
        }
        $data['config'] = Config::first();
        foreach ($incoming_vote as $key) {
            $data['total_incoming_vote'] += $key->voice;
        }
        $data['realcount']   =  $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;
        $data['district']    = Village::where("district_id", decrypt($id))->get();
        $data['total_tps']   = Village::where('district_id', decrypt($id))->sum('tps');
        $data['tps_masuk']   = Tps::where('district_id', decrypt($id))->where('setup', 'terisi')->count('number');
        $data['tps_kosong']  = Tps::where('district_id', decrypt($id))->count('number');
        $data['suara_masuk'] = SaksiData::where('district_id', decrypt($id))->count('voice');
        $data['kecamatan'] = District::where('id', decrypt($id))->first();
        $data['tracking'] = ModelsTracking::where('id_user', '!=', 1)->get();
        $data['title'] = "KECAMATAN " . $data['kecamatan']['name'] . "";
        $data['saksi_masuk'] = Saksi::count();
        $data['saksi_terverifikasi'] = Saksi::where('verification', 1)->count();
        $data['id_kecamatan'] = decrypt($id);
        return view('administrator.perhitungan.kecamatan', $data);
    }

    public function perhitungan_kelurahan($id)
    {
      $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->where('saksi.regency_id', $this->config->regencies_id)->get();

        $paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id,SUM(voice) as total FROM saksi_data WHERE regency_id = "' . $this->config->regencies_id . '" GROUP by paslon_id ORDER by total DESC'));

        // Periksa apakah data kosong
        if (count($paslon_tertinggi) > 0) {
            $data['paslon_tertinggi'] = Paslon::find($paslon_tertinggi[0]->paslon_id);
            $data['urutan'] = $paslon_tertinggi;
        } else {
            // Tetapkan nilai default atau ambil tindakan tertentu jika data kosong
            $data['paslon_tertinggi'] = null;
            $data['urutan'] = null;
        }

        

        $data['paslon'] = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query
                ->join('saksi', 'saksi_data.saksi_id', 'saksi.id', 'district_id')
                ->whereNull('saksi.pending')
                ->where('saksi.village_id', (string)decrypt($id));
        }])->get();
        $data['paslon_terverifikasi']     = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id')
                ->whereNull('saksi.pending')
                ->where('saksi.verification', 1)
                ->where('saksi.village_id', (string)decrypt($id));
        }])->get();
        // dd($data['paslon_terverifikasi']);

        $dpt = District::where('regency_id', (string)$this->config->regencies_id)->sum("dpt");
        $data['total_incoming_vote'] = 0;
        $incoming_vote = SaksiData::select('voice')->where('village_id', (string)decrypt($id))->get();
        foreach ($incoming_vote as $key) {
            $data['total_incoming_vote'] += $key->voice;
        }
        $verification = Saksi::where('verification', 1)->with('saksi_data')->where('village_id', decrypt($id))->get();
        $data['total_incoming_vote'] = 0;
        $data['total_verification_voice'] = 0;
        foreach ($verification as $key) {
            foreach ($key->saksi_data as $verif) {
                $data['total_verification_voice'] += $verif->voice;
            }
        }
        $data['tps_masuk']   = Tps::where('villages_id', (string)decrypt($id))->where('setup', 'terisi')->sum('number');
        $data['realcount']   = (string) $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;

        $data['total_tps']   = Village::where('id', (string)decrypt($id))->sum('tps');
        $data['tps_masuk']   = Tps::where('villages_id', (string)decrypt($id))->where('setup', 'terisi')->count('number');
        $data['tps_kosong']  = Tps::where('villages_id', (string)decrypt($id))->where('setup', 'belum_terisi')->count('number');
        $data['suara_masuk'] = SaksiData::where('village_id', (string)decrypt($id))->sum('voice');
        $data['saksi']       = Saksi::where('village_id', (string)decrypt($id))->get();

        $id = Crypt::decrypt($id);
        $config = Config::first();
        $data['regency'] = Regency::where('id', (string)$this->config->regencies_id)->first();

        $data['village'] = Village::where('id', (string)$id)->first();
        $data['district'] = District::where('id', (string)$data['village']->district_id)->first();
        $data['kelurahan'] = Village::where('district_id', (string)$data['village']->district_id)->get();
        $data['paslon_candidate'] = Paslon::get();
        $data['config'] = Config::first();
        $data['jumlah_tps_masuk'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('tps.villages_id', $id)->count();
        $data['tps_kel'] = Tps::where('villages_id', (string)$id)->get();
        $data['id'] = $id;
        $data['id_kelurahan'] = $id;
        $data['jumlah_tps_terverifikai'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('tps.villages_id', (string)$id)->where('saksi.verification', (string)1)->count();
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('tps.villages_id', (string)$id)
            ->where('saksi.verification', '')
            ->whereNull('saksi.pending')
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->get();
        $data['tracking'] = ModelsTracking::where('id_user', '!=', 1)->get();
        $data['title'] = "KELURAHAN " . $data['village']['name'] . "";
        $data['saksi_masuk'] = Saksi::count();
        $data['saksi_terverifikasi'] = Saksi::where('verification', 1)->count();

        return view('administrator.perhitungan.kelurahan', $data);
    }
    public function perhitungan_tps($id)
    {

      $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->where('saksi.regency_id', $this->config->regencies_id)->get();

        $paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id, SUM(voice) as total FROM saksi_data GROUP by paslon_id ORDER by total DESC'));

        $data['paslon_tertinggi'] = Paslon::where('id', (string)$paslon_tertinggi['0']->paslon_id)->first();
        $data['urutan'] = $paslon_tertinggi;

        $data['paslon'] = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query
                ->join('saksi', 'saksi_data.saksi_id', 'saksi.id', 'district_id')

                ->whereNull('saksi.pending')
                ->where('saksi.tps_id', (string) Crypt::decrypt($id));
        }])->get();
        $data['paslon_terverifikasi']     = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id')
                ->whereNull('saksi.pending')
                ->where('saksi.verification', 1)
                ->where('saksi.village_id', (string)Crypt::decrypt($id));
        }])->get();

        $dpt = District::where('regency_id', (string)$this->config->regencies_id)->sum("dpt");

        $data['total_incoming_vote'] = 0;
        $incoming_vote = SaksiData::join('saksi', 'saksi_data.saksi_id', "=", 'saksi.id')->select('saksi_data.voice')->where('saksi.tps_id', (string)Crypt::decrypt($id))->get();
        foreach ($incoming_vote as $key) {
            $data['total_incoming_vote'] += $key->voice;
        }
        $verification = Saksi::where('verification', 1)->with('saksi_data')->where('tps_id', Crypt::decrypt($id))->get();
        $data['total_incoming_vote'] = 0;
        $data['total_verification_voice'] = 0;
        foreach ($verification as $key) {
            foreach ($key->saksi_data as $verif) {
                $data['total_verification_voice'] += $verif->voice;
            }
        }
        $data['saksi'] = Saksi::where('verification', 1)->with('saksi_data')->where('tps_id', Crypt::decrypt($id))->first();
        $data['realcount']   = (string) $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;

        $data['tps_masuk']   = Tps::where('id', (string)Crypt::decrypt($id))->where('setup', 'terisi')->count('number');
        $data['tps_kosong']  = Tps::where('id', (string)Crypt::decrypt($id))->where('setup', 'belum_terisi')->count('number');
        $data['suara_masuk'] =  SaksiData::join('saksi', 'saksi_data.saksi_id', "=", 'saksi.id')->where('saksi.tps_id', (string)Crypt::decrypt($id))->sum('saksi_data.voice');
        $data['saksi']       = Saksi::where('tps_id', (string)Crypt::decrypt($id))->get();

        $id = Crypt::decrypt($id);
        $config = Config::first();
        $data['regency'] = Regency::where('id', (string)$this->config->regencies_id)->first();

        $data_tps =     Tps::where('id', (string)$id)->first();
        $data['data_tps'] = $data_tps;
        $data['village'] = Village::where('id', (string)$data_tps->villages_id)->first();
        $data['district'] = District::where('id', (string)$data['village']->district_id)->first();
        $data['kelurahan'] = Village::where('district_id', (string)$data['village']->district_id)->get();
        $data['paslon_candidate'] = Paslon::get();
        $data['config'] = Config::first();
        $data['jumlah_tps_masuk'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('tps.villages_id', $id)->count();
        $data['id'] = $id;
        $data['jumlah_tps_terverifikai'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('tps.villages_id', (string)$id)->where('saksi.verification', (string)1)->count();
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('tps.id', (string) $id)
            ->where('saksi.verification', '')
            ->whereNull('saksi.pending')
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->get();
        $data['tracking'] = ModelsTracking::where('id_user', '!=', 1)->get();
        $data['title'] = "KELURAHAN " . $data['village']['name'] . "";
        $data['qrcode'] = Qrcode::where('tps_id', $data['saksi'][0]['tps_id'])->first();
        if ($data['qrcode'] != null) {
            $data['verifikator'] = User::where('id', $data['qrcode']['verifikator_id'])->first();
            $data['hukum'] = User::where('id', $data['qrcode']['hukum_id'])->first();
        } else {
            $data['verifikator'] = null;
            $data['hukum'] = null;
        }
        
        return view('administrator.perhitungan.tps', $data);
    }



    public function theme(Request $request)
    {
        DB::table('config')->update([
            'darkmode' => $request->theme,
        ]);
        return response()->json(['status' => "berhasil"], 200);
    }
    public function solution($id)
    {
        $id = (string)decrypt($id);
        $data['solution'] = SolutionFraud::get();
        $data['titel'] = SolutionFraud::where('id', $id)->first();
        $data['config'] = Config::first();
        $data['data_kecurangan']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->join('bukti_deskripsi_curang', 'bukti_deskripsi_curang.tps_id', '=', 'tps.id')
            ->join('list_kecurangan', 'list_kecurangan.id', '=', 'bukti_deskripsi_curang.list_kecurangan_id')
            ->where('list_kecurangan.solution_fraud_id', $id)
            ->where('saksi.kecurangan', 'yes')
            ->where('saksi.status_kecurangan', 'terverifikasi')
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->get();

        $cek = 1;
        $arrayCek = [];

        foreach ($data['data_kecurangan']  as $dat) {
            array_push($arrayCek, $dat->tps_id);
        }

        $arrayCek = array_unique($arrayCek);

        foreach ($data['data_kecurangan'] as $key => $value) {
            if (array_key_exists($key, $arrayCek)) {
            } else {
                unset($data['data_kecurangan'][$key]);
            }
        }

        $data['index_tsm']    = ModelsListkecurangan::join('solution_frauds', 'solution_frauds.id', '=', 'list_kecurangan.solution_fraud_id')->get();

        $data['title'] = $data['titel']['solution'];
        return view('administrator.bapilu.solusi_kecurangan', $data);
    }
    public function mainPermission(Request $request)
    {

        if ($request->kode == null || $request->kode != "09122020") {
            return redirect()->back()->with(['error' => "Gagal Meminta Izin"]);
        }

        event(new CommanderEvent([
            'izin' => $request->izin,
            'jenis' => $request->jenis,
            'order' => Auth::user()->id,
        ]));
        NotificationCommander::create([
            'order' => Auth::user()->id,
            'jenis' => $request->jenis,
            'setting' => $request->izin,
            'redirect' => $request->izin,
        ]);
        return redirect()->back()->with(['status' => "berhasil"]);
    }
    public function admin_verifikator_index($id)
    {
        $data['district']  = District::where('id', Crypt::decrypt($id))->first();
        $district = $data['district'];
        $data['villages'] = Village::where('district_id', $district->id)->get();
        $data['village'] = Village::where('district_id', $district->id)->first();
        $data['team'] = User::where('id', '!=', Auth::user()->id)->where('role_id', Auth::user()->role_id)->get();
        $data['title'] = "KECAMATAN " . $data['district']['name'] . "";
        $data['title2'] = "KEC ." . $data['district']['name'] . "";

        return view('verificator.index', $data);
    }

    public function admin_auditor_index($id)
    {
        $data['district']  = District::where('id', Crypt::decrypt($id))->first();
        $district = $data['district'];
        $data['villages'] = Village::where('district_id', $district->id)->get();
        $data['team'] = User::where('id', '!=', Auth::user()->id)->where('role_id', 3)->get();
        $data['title2'] = "KEC ." . $data['district']['name'] . "";
        return view('auditor.index', $data);
    }
    public function admin_rekapitulator($id)
    {
        $rekapitulator = ModelsRekapitulator::where('district_id', Crypt::decrypt($id))->get();
        if (count($rekapitulator) == 0) {
            $district = Village::where('district_id', Crypt::decrypt($id))->get();
            $paslon   = Paslon::get();
            foreach ($paslon as $psl) {
                foreach ($district as $ds) {
                    $rekapitulator_form =  ModelsRekapitulator::create([
                        'village_id' => $ds['id'],
                        'district_id' => Crypt::decrypt($id),
                        'paslon_id' => $psl['id'],
                    ]);
                }
            }
        }
        $data['config'] = Config::first();
        $data['kecamatan'] = Village::where('district_id', Crypt::decrypt($id))->get();
        $data['kec'] = District::where('id', Crypt::decrypt($id))->first();

        // $data['rekapitulator'] = Village::join('rekapitulator', 'villages.id', '=', 'rekapitulator.village_id')
        // ->join('paslon','paslon.id','=','rekapitulator.paslon_id')
        // ->get();
        $data['suara'] = Paslon::get();
        $data['id'] = Crypt::decrypt($id);
        return view('administrator.rekapitulasi.rekapitulator', $data);
    }


    public function absensi_hadir()
    {
        $data['config'] = Config::first();
        $config = Config::first();
        $data['kota']      = Regency::where('id', $this->config->regencies_id)->first();
        $data['jumlah_hadir'] = Absensi::join('users', 'users.id', '=', 'absensi.user_id')->where('users.absen', '=', 'hadir')->where('is_active', '=', 1)->count();
        // $data['title'] = 'Saksi Hadir (' . $data['jumlah'] . ')';
        $data['title'] = 'Saksi Hadir';

        return view("administrator.super_feature.absensi", $data);
    }


    public function absensi()
    {
        $data['config'] = Config::first();
        $config = Config::first();
        $data['kota']      = Regency::where('id', $this->config->regencies_id)->first();
        $data['jumlah_saksi_teregistrasi'] = User::where('role_id', 8)->where('is_active', '=', 1)->count();

        // $data['title'] = 'Saksi Teregistrasi (' . $data['jumlah'] . ')';
        $data['title'] = 'Saksi Teregistrasi';

        return view("administrator.super_feature.absenindex", $data);
    }

    public function absensi_tidak()
    {
        $data['config'] = Config::first();
        $config = Config::first();
        $data['kota']      = Regency::where('id', $this->config->regencies_id)->first();
        $data['jumlah_tidak_hadir'] = User::where('role_id', 8)->where('absen', 'tidak hadir')->where('is_active', '=', 1)->count();

        // $data['title'] = 'Saksi Absen (' . $data['jumlah'] . ')';
        $data['title'] = 'Saksi Absen';

        return view("administrator.super_feature.absensitidakhadir", $data);
    }


    public function get_tps_kelurahan(Request $request)
    {
        $data['saksi'] =  Saksi::where('tps_id', $request['id'])->get();
        $data['id'] = Tps::where('id', $request['id'])->first();
        $data['kecamatan'] = District::where('id',  $data['tps']['district_id'])->first();
        $data['kelurahan'] = Village::where('id',  $data['tps']['villages_id'])->first();
        $data['config'] = Config::first();
        if (count($data['saksi']) == 0) {
            return view('publik.ajax.result_eror');
        } else {
            return view('administrator.ajax.tps', $data);
        }
    }
    public function index_tsm()
    {
        $data['index_tsm']    = ModelsListkecurangan::join('solution_frauds', 'solution_frauds.id', '=', 'list_kecurangan.solution_fraud_id')->get();
        $data['terverifikasi'] = Saksi::where('kecurangan', 'yes')->where('status_kecurangan', 'terverifikasi')->get();
        $data['ditolak'] = Saksi::where('kecurangan', 'yes')->where('status_kecurangan', 'ditolak')->get();
        $data['data_masuk'] = Saksi::where('kecurangan', 'yes')->get();
        $data['config'] = Config::first();
        return view('administrator.hukum.index_tsm', $data);
    }
    public function print_index_tsm()
    {
        $data['index_tsm']    = ModelsListkecurangan::get();
        $config = Config::first();
        $data['config'] = $config;
        $data['kota']      = Regency::where('id', $this->config->regencies_id)->first();
        return view('administrator.hukum.print_index_tsm', $data);
    }
    public function luar_negri()
    {
        $data['paslon_terverifikasi']     = Paslon::with(['saksi_data' => function ($query) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id')
                ->whereNull('saksi.pending')
                ->where('saksi.verification', 1);
        }])->get();
        $data['paslon'] = Paslon::with('saksi_data')->get();
        $data['config'] = Config::first();
        $data['tracking'] = ModelsTracking::where('id_user', '!=', 1)->get();
        $data['country'] = Country::get();
        $data['paslon_can'] = Paslon::get();
        $data['luarnegri']  = Country::join('saksi', 'saksi.tps_id', '=', 'country.id')->get();
        return view("administrator.luar_negri.index", $data);
    }

    public function action_luar_negri(Request $request)
    {
        $paslon =  Paslon::get();

        $saksi = new Saksi;
        $saksi->c1_images = "0";
        $saksi->verification = 1;
        $saksi->audit = "";
        $saksi->district_id = "0";
        $saksi->village_id =  00000;
        $saksi->tps_id = $request['negara'];
        $saksi->regency_id = 00000;
        $saksi->overlimit = 00000;
        $saksi->save();
        $ide = $saksi->id;
        for ($i = 0; $i < count($paslon); $i++) {
            SaksiData::create([
                'user_id' =>  $request['negara'],
                'paslon_id' =>  $i,
                'district_id' => 00000,
                'village_id' =>  00000,
                'regency_id' => 00000,
                'voice' =>  $request['paslon' . $i . ''],
                'saksi_id' => $ide,
            ]);
        }

        return redirect('/administrator/luar_negri');
    }

    public function laporanBapilu()
    {
        $data['index_tsm']    = ModelsListkecurangan::join('solution_frauds', 'solution_frauds.id', '=', 'list_kecurangan.solution_fraud_id')->get();

        $data['config'] = Config::first();
        $data['kota'] = Regency::where('id', $this->config->regencies_id)->first();
        $data['qrcode'] = QrCode::join('surat_pernyataan', 'surat_pernyataan.qrcode_hukum_id', '=', 'qrcode_hukum.id')->get();
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('saksi.kecurangan', 'yes')
            ->where('saksi.status_kecurangan', 'terverifikasi')
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->limit(6)
            ->get();

        return view('administrator.bapilu.laporan_bapilu', $data);
    }
    public function data_gugatan()
    {
        $data['index_tsm']    = ModelsListkecurangan::join('solution_frauds', 'solution_frauds.id', '=', 'list_kecurangan.solution_fraud_id')->get();
        $data['config'] = Config::first();
        $data['kota'] = Regency::where('id', $this->config->regencies_id)->first();
        $data['qrcode'] = QrCode::join('surat_pernyataan', 'surat_pernyataan.qrcode_hukum_id', '=', 'qrcode_hukum.id')->limit(8)->get();
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('saksi.kecurangan', 'yes')
            ->where('saksi.status_kecurangan', 'terverifikasi')
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->limit(6)
            ->get();

        $data['list_sidang']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->join('qrcode_hukum', 'qrcode_hukum.tps_id', '=', 'tps.id')
            ->where('saksi.kecurangan', 'yes')
            ->where('saksi.status_kecurangan', 'terverifikasi')
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->limit(6)
            ->get();


        return view('administrator.bapilu.laporan_gugatan', $data);
    }

    public function rekapitulator_kota()
    {
        $data['config'] = Config::first();

        $rekapitulator = ModelsRekapitulator::where('regency_id', $this->config->regencies_id)->get();
        if (count($rekapitulator) == 0) {
            $district = District::where('regency_id', $this->config->regencies_id)->get();
            $paslon   = Paslon::get();
            foreach ($paslon as $psl) {
                foreach ($district as $ds) {
                    $rekapitulator_form =  ModelsRekapitulator::create([
                        'village_id' => 0,
                        'district_id' => $ds['id'],
                        'paslon_id' => $psl['id'],
                        'regency_id' => $this->config->regencies_id,
                    ]);
                }
            }
            echo 1;
        }
        $data['paslon'] = Paslon::get();
        $data['kecamatan'] = District::where('regency_id', $this->config->regencies_id)->get();
        return view('administrator.rekapitulasi.kota', $data);
    }
    //print
    public function rekapitulator_kota_print()
    {
        $data['config'] = Config::first();
        // $rekapitulator = ModelsRekapitulator::where('regency_id', $this->config->regencies_id)->get();
        $data['kotas'] = Regency::where('id', $this->config->regencies_id)->first();
        $data['paslon'] = Paslon::get();
        $data['kecamatan'] = District::where('regency_id', $this->config->regencies_id)->get();
        return view('administrator.rekapitulasi.print_kota', $data);
    }

    public function rekapitulasiKelurahan()
    {
        $config = Config::first();
        $rekapitulator = ModelsRekapitulator::where('regency_id', $this->config->regencies_id)->get();
        if (count($rekapitulator) == 0) {
            $district = Village::where('regency_id', $this->config->regencies_id)->get();

            $paslon   = Paslon::get();
            foreach ($paslon as $psl) {
                foreach ($district as $ds) {
                    $dsc = District::where('id', $ds->district_id)->first();
                    $rekapitulator_form =  ModelsRekapitulator::create([
                        'village_id' => $ds['id'],
                        'district_id' => $dsc->id,
                        'paslon_id' => $psl['id'],
                        "regency_id" => $this->config->regencies_id
                    ]);
                }
            }
        }
        $data['config'] = $config;
        $data['kecamatan'] = Village::where('district_id', 'like', '%' . $this->config->regencies_id . "%")->get();
        // $data['kec'] = District::where('id', Crypt::decrypt($id))->first();

        // $data['rekapitulator'] = Village::join('rekapitulator', 'villages.id', '=', 'rekapitulator.village_id')
        // ->join('paslon','paslon.id','=','rekapitulator.paslon_id')
        // ->get();
        $data['suara'] = Paslon::get();
        // $data['id'] = Crypt::decrypt($id);

        return view('administrator.rekapitulasi.rekapitulasi_kelurahan', $data);
    }

    public function rekapitulasiKecamatan()
    {
        $data['config'] = Config::first();

        $rekapitulator = ModelsRekapitulator::where('regency_id', $this->config->regencies_id)->get();
        if (count($rekapitulator) == 0) {
            $district = District::where('regency_id', $this->config->regencies_id)->get();
            $paslon   = Paslon::get();
            foreach ($paslon as $psl) {
                foreach ($district as $ds) {
                    $rekapitulator_form =  ModelsRekapitulator::create([
                        'village_id' => 0,
                        'district_id' => $ds['id'],
                        'paslon_id' => $psl['id'],
                        'regency_id' => $this->config->regencies_id,
                    ]);
                }
            }
            echo 1;
        }
        $data['paslon'] = Paslon::get();
        $data['kecamatan'] = District::where('regency_id', $this->config->regencies_id)->get();
        return view('administrator.rekapitulasi.rekapitulasi_kecamatan', $data);
    }

    public function fraudDataPrint()
    {
        $data['config'] = Config::first();
        $data['index_tsm']  = ModelsListkecurangan::join('solution_frauds', 'solution_frauds.id', '=', 'list_kecurangan.solution_fraud_id')->get();
        $data['qrcode'] = QrCode::get();
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('saksi.kecurangan', 'yes')
            ->where('saksi.status_kecurangan', 'terverifikasi')
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->get();
        $data['print'] = QrCode::where('print', 1)->get();
        $data['title']  = 'Jumlah Data Kecurangan Masuk : ' . count($data['list_suara']);
        // $data['title2']  = 'Election Fraud Data Print';
        return view('administrator.fraudDataprint', $data);
    }

    public function fraudDataPrint_tercetak()
    {
        $data['config'] = Config::first();
        $data['index_tsm']  = ModelsListkecurangan::join('solution_frauds', 'solution_frauds.id', '=', 'list_kecurangan.solution_fraud_id')->get();
        $data['qrcode'] = QrCode::get();
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->join('qrcode_hukum', 'qrcode_hukum.tps_id', '=', 'users.tps_id')
            ->where('saksi.kecurangan', 'yes')
            ->where('saksi.status_kecurangan', 'terverifikasi')

            ->where('print', 1)
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->get();
        $data['title']  = 'Jumlah Data Kecurangan Tercetak : ' . count($data['list_suara']);
        // $data['title2']  = 'Election Fraud Data Print';
        $data['print'] = QrCode::where('print', 1)->get();
        return view('administrator.fraudDataprintTercetak', $data);
    }
    public function FraudDataReport()
    {
        $data['index_tsm']    = ModelsListkecurangan::get();
        $data['config'] = Config::first();
        $data['qrcode'] = QrCode::join('surat_pernyataan', 'surat_pernyataan.qrcode_hukum_id', '=', 'qrcode_hukum.id')->paginate(15);
        $data['jumlah_barcode'] = QrCode::join('surat_pernyataan', 'surat_pernyataan.qrcode_hukum_id', '=', 'qrcode_hukum.id')->select('qrcode_hukum.*')->count();

        return view('administrator.fraudDatareport', $data);
    }

    function dokumenLain()
    {
        return view('administrator.perdataan.dokumen-lain');
    }

    public function print_qr_code()
    {
        $data['qrcode'] = QrCode::join('tps', 'tps.id', '=', 'qrcode_hukum.tps_id')
            ->join('users', 'users.tps_id', '=', 'qrcode_hukum.tps_id')
            ->join('villages', 'villages.id', '=', 'tps.villages_id')
            ->select('users.*', 'tps.*', 'villages.name as village_name')
            ->get();
        // dd($data['qrcode']);
        $config = Config::first();
        $data['config'] = $config;
        $data['kota']      = Regency::where('id', $this->config->regencies_id)->first();
        // $data['user'] = User::where('id', $data['tps']['user_id'])->first();
        return view('administrator.printQr', $data);
    }

    public function getKecuranganTerverifikasi(Request $request)
    {
        $data['foto_kecurangan'] = Buktifoto::where('tps_id', $request['id'])->get();
        $data['vidio_kecurangan'] = Buktividio::where('tps_id', $request['id'])->first();
        $data['list_kecurangan']     = Bukti_deskripsi_curang::join('list_kecurangan', 'list_kecurangan.id', '=', 'bukti_deskripsi_curang.list_kecurangan_id')
            ->join('solution_frauds', 'solution_frauds.id', '=', 'list_kecurangan.solution_fraud_id')
            ->where('bukti_deskripsi_curang.tps_id', $request['id'])
            ->get();
        $data['pelanggaran_umum']    = ModelsListkecurangan::join('solution_frauds', 'solution_frauds.id', '=', 'list_kecurangan.solution_fraud_id')
            ->where('list_kecurangan.jenis', 0)->get();
        $data['pelanggaran_petugas'] = ModelsListkecurangan::join('solution_frauds', 'solution_frauds.id', '=', 'list_kecurangan.solution_fraud_id')
            ->where('list_kecurangan.jenis', 1)->get();
        $data['tps'] = Tps::where('id', $request['id'])->first();
        $data['kecamatan'] = District::where('id', $data['tps']['district_id'])->first();
        $data['bukti_vidio'] = Buktividio::where('tps_id', $request['id'])->get();
        $data['bukti_foto'] = Buktifoto::where('tps_id', $request['id'])->get();
        $data['saksi'] = Saksi::where('tps_id', $request['id'])->first();
        $data['solution'] = DB::table('solution_frauds')->where('id', $data['list_kecurangan'][0]->solution_fraud_id)->first();
        // dd($data);
        return view('administrator.ajax.fotoKecuranganterverifikasi', $data);
    }
    public function print(Request $request, $id)
    {
        $data['tps']       = Tps::where('id', Crypt::decrypt($request['id']))->first();
        $data['saksi']     = Saksi::where('tps_id', Crypt::decrypt($request['id']))->first();
        $data['qrcode']    = Qrcode::where('tps_id', Crypt::decrypt($request['id']))->first();
        $data['kota']      = Regency::where('id', $data['saksi']['regency_id'])->first();
        $data['kecamatan'] = District::where('id', $data['saksi']['district_id'])->first();
        $data['kelurahan'] = Village::where('id', $data['saksi']['village_id'])->first();
        $data['user'] = User::where('id', $data['tps']['user_id'])->first();
        $data['verifikator'] = User::where('id', $data['qrcode']['verifikator_id'])->first();
        $data['hukum'] = User::where('id', $data['qrcode']['hukum_id'])->first();
        $data['databukti'] = Databukti::where('tps_id', Crypt::decrypt($request['id']))->first();
        $data['list_kecurangan']     = Bukti_deskripsi_curang::join('list_kecurangan', 'list_kecurangan.id', '=', 'bukti_deskripsi_curang.list_kecurangan_id')
            ->join('solution_frauds', 'solution_frauds.id', '=', 'list_kecurangan.solution_fraud_id')
            ->where('bukti_deskripsi_curang.tps_id', Crypt::decrypt($request['id']))
            ->get();
        $data['foto_kecurangan'] = Buktifoto::where('tps_id', Crypt::decrypt($request['id']))->get();
        $data['vidio_kecurangan'] = Buktividio::where('tps_id', Crypt::decrypt($request['id']))->first();
        $data['surat_pernyataan'] = SuratPernyataan::where('saksi_id', $data['saksi']['id'])->first();
        $data['absensi'] = Absensi::where('user_id', $data['saksi']['id'])->first();

        $status =  Qrcode::where('tps_id', Crypt::decrypt($request['id']))->update([
            'print' => 1
        ]);

        return view('hukum.print.kecurangan', $data);
    }
    public function rDataRecord()
    {
        $data['history'] = History::join('users', 'users.id', '=', 'history.user_id')->get();
        $data['config'] = Config::first();
        return view('administrator.r_data', $data);
    }

    public function analisa_dpt_kpu()
    {
        $data['config'] = Config::first();
        $data['kota']   = Regency::where('id', $this->config->regencies_id)->first();
        $data['paslon_terverifikasi']     = Paslon::with(['saksi_data' => function ($query) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id')
                ->whereNull('saksi.pending')
                ->where('saksi.verification', 1);
        }])->get();
        $data['tracking'] = ModelsTracking::get();
        $data['paslon']                   = Paslon::with('saksi_data')->get();
        $data['kecamatan'] =  District::where('regency_id', $this->config->regencies_id)->get();
        return view('administrator.super_feature.analisa_dpt_kpu', $data);
    }

    public function analisa_dpt_kpu_print()
    {
        $data['config'] = Config::first();
        $data['kecamatan'] =  District::where('regency_id', $this->config->regencies_id)->get();
        $data['kota'] = Regency::where('id', $this->config->regencies_id)->first();
        return view('administrator.super_feature.print', $data);
    }

    public function get_qrsidang(Request $request)
    {
        $data['config'] = Config::first();
        $config = $data['config'];
        $data['qrcode_hukum'] = Qrcode::join('surat_pernyataan', 'surat_pernyataan.qrcode_hukum_id', '=', 'qrcode_hukum.id')
            ->join('users', 'users.tps_id', '=', 'qrcode_hukum.tps_id')->where('qrcode_hukum.tps_id', $request->id_tps)->first();
        $data['verifikator_id'] = User::where('id', $data['qrcode_hukum']['verifikator_id'])->first();
        $data['hukum_id'] = User::where('id', $data['qrcode_hukum']['hukum_id'])->first();
        $data['data_tps'] = Tps::where('id', $request->id_tps)->first();
        $data['bukti_foto'] = ModelsBuktifoto::where('tps_id', $data['qrcode_hukum']['tps_id'])->get();
        $data['bukti_vidio'] = Buktividio::where('tps_id', $data['qrcode_hukum']['tps_id'])->get();
        $data['list'] = Bukti_deskripsi_curang::where('tps_id', $data['qrcode_hukum']['tps_id'])->get();
        $data['kelurahan'] = Village::where('id', $data['qrcode_hukum']['villages'])->first();
        $data['kecamatan'] = District::where('id', $data['qrcode_hukum']['districts'])->first();
        $data['kota'] = Regency::where('id', $this->config->regencies_id)->first();
        return view('administrator.sidang_saksi_online.modal-qr-sidang', $data);
    }

    public function print_sidang($id)
    {
        $data['config'] = Config::first();
        $config = $data['config'];
        $data['qrcode_hukum'] = Qrcode::join('surat_pernyataan', 'surat_pernyataan.qrcode_hukum_id', '=', 'qrcode_hukum.id')
            ->join('users', 'users.tps_id', '=', 'qrcode_hukum.tps_id')->where('qrcode_hukum.tps_id', $id)->first();

        $data['verifikator_id'] = User::where('id', $data['qrcode_hukum']['verifikator_id'])->first();
        $data['hukum_id'] = User::where('id', $data['qrcode_hukum']['hukum_id'])->first();
        $data['data_tps'] = Tps::where('id', $id)->first();

        $data['bukti_foto'] = ModelsBuktifoto::where('tps_id', $data['qrcode_hukum']['tps_id'])->get();
        $data['bukti_vidio'] = Buktividio::where('tps_id', $data['qrcode_hukum']['tps_id'])->get();
        $data['list'] = Bukti_deskripsi_curang::where('tps_id', $data['qrcode_hukum']['tps_id'])->get();
        $data['kelurahan'] = Village::where('id', $data['qrcode_hukum']['villages'])->first();
        $data['kecamatan'] = District::where('id', $data['qrcode_hukum']['districts'])->first();
        $data['kota'] = Regency::where('id', $this->config->regencies_id)->first();

        return view('administrator.sidang_saksi_online.print-sidang', $data);
    }
    public function sidang_online_action($id, $role)
    {
        $saksi = Saksi::where('tps_id', (string)decrypt($id))->update([
            'makamah_konsitusi' => decrypt($role),
        ]);
        return redirect('/administrator/sidang_online');
    }
    public function get_sidang_online(Request $request, $id)
    {
        $data['tps_id'] =  (string)decrypt($id);
        $data['index_tsm']    = ModelsListkecurangan::get();
        return view('administrator.sidang_saksi_online.modal-sidang-online', $data);
    }
    public function sidangOnline()
    {
        $data['config'] = Config::first();
        $data['kota']   = Regency::where('id', $this->config->regencies_id)->first();
        $data['index_tsm']    = ModelsListkecurangan::get();
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->whereNull("saksi.makamah_konsitusi")
            ->where('saksi.kecurangan', 'yes')
            ->where('saksi.status_kecurangan', 'terverifikasi')
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->get();
        $data['tag'] = 1;
        $data['terverifikasi'] = Saksi::where('kecurangan', 'yes')->where('status_kecurangan', 'terverifikasi')->get();
        $data['tidak_menjawab'] = Saksi::where('kecurangan', 'yes')->where('status_kecurangan', 'terverifikasi')->where('makamah_konsitusi', 'Tidak Menjawab')->get();
        $data['selesai'] = Saksi::where('kecurangan', 'yes')->where('status_kecurangan', 'terverifikasi')->where('makamah_konsitusi', 'Selesai')->get();
        $data['ditolak'] = Saksi::where('kecurangan', 'yes')->where('makamah_konsitusi', 'Ditolak')->get();
        $data['data_masuk'] = Saksi::where('kecurangan', 'yes')->where('status_kecurangan', 'terverifikasi')->get();

        return view('administrator.sidang_saksi_online.index', $data);
    }

    public function sidangOnlineAll()
    {
        $data['config'] = Config::first();
        $data['kota']   = Regency::where('id', $this->config->regencies_id)->first();
        $data['index_tsm']    = ModelsListkecurangan::get();
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('saksi.kecurangan', 'yes')
            ->where('saksi.status_kecurangan', 'terverifikasi')
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->get();
        $data['tag'] = 1;
        $data['terverifikasi'] = Saksi::where('kecurangan', 'yes')->where('status_kecurangan', 'terverifikasi')->get();
        $data['tidak_menjawab'] = Saksi::where('kecurangan', 'yes')->where('status_kecurangan', 'terverifikasi')->where('makamah_konsitusi', 'Tidak Menjawab')->get();
        $data['selesai'] = Saksi::where('kecurangan', 'yes')->where('status_kecurangan', 'terverifikasi')->where('makamah_konsitusi', 'Selesai')->get();
        $data['ditolak'] = Saksi::where('kecurangan', 'yes')->where('makamah_konsitusi', 'Ditolak')->get();
        $data['data_masuk'] = Saksi::where('kecurangan', 'yes')->where('status_kecurangan', 'terverifikasi')->get();
        $data['_data_masuk_'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('saksi.kecurangan', 'yes')
            ->where('saksi.status_kecurangan', 'terverifikasi')
            ->whereNull('saksi.makamah_konsitusi')
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->count();
        return view('administrator.sidang_saksi_online.all-data', $data);
    }

    public function sidangOnlinestatus($role)
    {
        $data['config'] = Config::first();
        $data['kota']   = Regency::where('id', $this->config->regencies_id)->first();
        $data['index_tsm']    = ModelsListkecurangan::get();
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('saksi.kecurangan', 'yes')
            ->where('saksi.status_kecurangan', 'terverifikasi')
            ->where('makamah_konsitusi', decrypt($role))
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->get();
        $data['tag'] = 2;
        $data['config'] = Config::first();
        $data['kota']   = Regency::where('id', $this->config->regencies_id)->first();
        $data['tidak_menjawab'] = Saksi::where('kecurangan', 'yes')->where('status_kecurangan', 'terverifikasi')->where('makamah_konsitusi', 'Tidak Menjawab')->get();
        $data['selesai'] = Saksi::where('kecurangan', 'yes')->where('status_kecurangan', 'terverifikasi')->where('makamah_konsitusi', 'Selesai')->get();
        $data['ditolak'] = Saksi::where('kecurangan', 'yes')->where('makamah_konsitusi', 'Ditolak')->get();
        $data['data_masuk'] = Saksi::where('kecurangan', 'yes')->where('status_kecurangan', 'terverifikasi')->get();
        return view('administrator.sidang_saksi_online.index', $data);
    }


    public function batalkan_history($id, $user_id)
    {
        $decrypt_id = Crypt::decrypt($id);
        $history = History::where('id', Crypt::decrypt($id))->first();
        History::where('id', Crypt::decrypt($id))->update([
            'status' => 0,
        ]);
        if ($history['status'] == 1) {
            Saksi::where('id', $history['saksi_id'])->update([
                'verification' => "",
            ]);
            return redirect('/administrator/patroli_mode/tracking/detail/' . $user_id);
        }
        if ($history['status'] == 2) {
            Saksi::where('id', $history['saksi_id'])->update([
                'audit' => "",
            ]);
            return redirect('/administrator/patroli_mode/tracking/detail/' . $user_id);
        }
    }


    public function batalkan_semua($id)
    {
        $decrypt_id = Crypt::decrypt($id);
        $history = History::where('user_id', $decrypt_id)->get();
        foreach ($history as $hs) {
            History::where('id', $hs->id)->update([
                'status' => 0,
            ]);
            if ($hs['status'] == 1) {
                Saksi::where('id', $hs['saksi_id'])->update([
                    'verification' => "",
                ]);
            }
            if ($hs['status'] == 2) {
                Saksi::where('id', $hs['saksi_id'])->update([
                    'audit' => "",
                ]);
            }
        }

        return redirect('/administrator/patroli_mode/tracking/detail/' . $id);
    }


    public function developer()
    {
        $data['config'] = Config::first();
        $data['paslon'] = Paslon::with('saksi_data')->get();
        $data['paslon_terverifikasi']     = Paslon::with(['saksi_data' => function ($query) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id')
                ->whereNull('saksi.pending')
                ->where('saksi.verification', 1);
        }])->get();
        $data['tracking'] = ModelsTracking::get();
        $data['village'] = Village::first();
        $data['villages'] = Village::get();
        $data['district'] = District::first();
        return view('administrator.developer.index', $data);
    }
    public function cek_pass(Request $request)
    {
        if ($request->password == "#Pentagon2024") {
            return redirect('administrator/developer');
        } else {
            return redirect()->back()->with('error', 'Password yang anda masukan salah');
        }
    }

    public function real_count2()
    {
        $data['config'] = Config::first();
        $config = Config::first();
      $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->where('saksi.regency_id', $this->config->regencies_id)->get();
        $paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id,SUM(voice) as total FROM saksi_data WHERE regency_id = "' . $this->config->regencies_id . '" GROUP by paslon_id ORDER by total DESC'));
        // return DB::table('saksi_data')->where('paslon_id',0)->sum('voice');
        $data['paslon_tertinggi'] = Paslon::where('id', $paslon_tertinggi['0']->paslon_id)->first();
        $data['urutan'] = $paslon_tertinggi;
        $dpt                              = District::where('regency_id', $this->config->regencies_id)->sum("dpt");
        $data['paslon'] = Paslon::with('saksi_data')->get();
        $data['paslon_terverifikasi']     = Paslon::with(['saksi_data' => function ($query) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id')
                ->whereNull('saksi.pending')
                ->where('saksi.verification', 1);
        }])->get();
        $data['kota'] = Regency::where('id', $this->config->regencies_id)->first();
        $data['tracking'] = ModelsTracking::get();
        $data['total_incoming_vote']      = SaksiData::sum('voice');
        $data['realcount']                =  $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;
        $data['village'] = Village::first();
        $data['villages'] = Village::get();
        $data['realcount'] =  $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;
        $data['kec'] = District::where('regency_id', $this->config->regencies_id)->get();
        $data['kecamatan'] = District::where('regency_id', $this->config->regencies_id)->get();
        $data['district'] = District::first();

        // dd($data['paslon']);
        return view('administrator.realcount.real_count2', $data);
    }

    public function realcountKecamatan($id)
    {
        $paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id, SUM(voice) as total FROM saksi_data WHERE district_id = :district_id GROUP BY paslon_id ORDER BY total DESC'), ['district_id' => decrypt($id)]);
        $data['paslon_tertinggi'] = Paslon::where('id', $paslon_tertinggi['0']->paslon_id)->first();
        $data['urutan'] = $paslon_tertinggi;
      $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->where('saksi.regency_id', $this->config->regencies_id)->get();
        $data['paslon']  = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id', 'district_id')
                ->whereNull('saksi.pending')
                ->where('saksi.district_id', decrypt($id));
        }])->get();
        $data['paslon_terverifikasi']     = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id', 'district_id')
                ->whereNull('saksi.pending')
                ->where('saksi.verification', 1)->where('saksi.district_id', decrypt($id));
        }])->get();
        $verification = Saksi::where('verification', 1)->with('saksi_data')->where('district_id', decrypt($id))->get();
        $dpt = District::where('regency_id', $this->config->regencies_id)->sum("dpt");
        $incoming_vote = SaksiData::select('voice')->where('district_id', decrypt($id))->get();
        $data['total_verification_voice'] = 0;
        $data['total_incoming_vote']      = 0;
        foreach ($verification as $key) {
            foreach ($key->saksi_data as $verif) {
                $data['total_verification_voice'] += $verif->voice;
            }
        }
        $data['config'] = Config::first();
        foreach ($incoming_vote as $key) {
            $data['total_incoming_vote'] += $key->voice;
        }
        $data['realcount']   =  $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;
        $data['district']    = Village::where("district_id", decrypt($id))->get();
        $data['total_tps']   = Village::where('district_id', decrypt($id))->sum('tps');
        $data['tps_masuk']   = Tps::where('district_id', decrypt($id))->where('setup', 'terisi')->count('number');
        $data['tps_kosong']  = Tps::where('district_id', decrypt($id))->count('number');
        $data['suara_masuk'] = SaksiData::where('district_id', decrypt($id))->count('voice');
        $data['kecamatan'] = District::where('id', decrypt($id))->first();
        $data['kel'] = Village::where('district_id',  decrypt($id))->get();
        $data['tracking'] = ModelsTracking::where('id_user', '!=', 1)->get();
        $data['title'] = "KECAMATAN " . $data['kecamatan']['name'] . "";
        $data['saksi_masuk'] = Saksi::count();
        $data['saksi_terverifikasi'] = Saksi::where('verification', 1)->count();
        $data['id_kecamatan'] = decrypt($id);
        return view('administrator.realcount.kecamatan', $data);
    }

    public function realcountKelurahan($id)
    {
        $paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id, SUM(voice) as total FROM saksi_data WHERE village_id = :village_id GROUP BY paslon_id ORDER BY total DESC'), ['village_id' => (string)decrypt($id)]);

        $data['paslon_tertinggi'] = Paslon::where('id', $paslon_tertinggi['0']->paslon_id)->first();
        $data['urutan'] = $paslon_tertinggi;

        $data['paslon_tertinggi'] = Paslon::where('id', (string)$paslon_tertinggi['0']->paslon_id)->first();

        $data['paslon'] = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query
                ->join('saksi', 'saksi_data.saksi_id', 'saksi.id', 'district_id')
                ->whereNull('saksi.pending')
                ->where('saksi.village_id', (string)decrypt($id));
        }])->get();
        $data['paslon_terverifikasi']     = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id')
                ->whereNull('saksi.pending')
                ->where('saksi.verification', 1)
                ->where('saksi.village_id', (string)decrypt($id));
        }])->get();
        // dd($data['paslon_terverifikasi']);

        $dpt = District::where('regency_id', (string)$this->config->regencies_id)->sum("dpt");
        $data['total_incoming_vote'] = 0;
        $incoming_vote = SaksiData::select('voice')->where('village_id', (string)decrypt($id))->get();
        foreach ($incoming_vote as $key) {
            $data['total_incoming_vote'] += $key->voice;
        }
        $verification = Saksi::where('verification', 1)->with('saksi_data')->where('village_id', decrypt($id))->get();
        $data['total_incoming_vote'] = 0;
        $data['total_verification_voice'] = 0;
        foreach ($verification as $key) {
            foreach ($key->saksi_data as $verif) {
                $data['total_verification_voice'] += $verif->voice;
            }
        }
        $data['tps_masuk']   = Tps::where('villages_id', (string)decrypt($id))->where('setup', 'terisi')->sum('number');
        $data['realcount']   = (string) $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;

        $data['total_tps']   = Village::where('id', (string)decrypt($id))->sum('tps');
        $data['tps_masuk']   = Tps::where('villages_id', (string)decrypt($id))->where('setup', 'terisi')->count('number');
        $data['tps_kosong']  = Tps::where('villages_id', (string)decrypt($id))->where('setup', 'belum_terisi')->count('number');
        $data['suara_masuk'] = SaksiData::where('village_id', (string)decrypt($id))->sum('voice');
        $data['saksi']       = Saksi::where('village_id', (string)decrypt($id))->get();

        $id = Crypt::decrypt($id);
        $config = Config::first();
        $data['regency'] = Regency::where('id', (string)$this->config->regencies_id)->first();

        $data['village'] = Village::where('id', (string)$id)->first();
        $data['district'] = District::where('id', (string)$data['village']->district_id)->first();
        $data['kelurahan'] = Village::where('district_id', (string)$data['village']->district_id)->get();
        $data['paslon_candidate'] = Paslon::get();
        $data['config'] = Config::first();
        $data['jumlah_tps_masuk'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('tps.villages_id', $id)->count();
        $data['tps_kel'] = Tps::where('villages_id', (string)$id)->get();
        $data['id'] = $id;
        $data['id_kelurahan'] = $id;
        $data['jumlah_tps_terverifikai'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('tps.villages_id', (string)$id)->where('saksi.verification', (string)1)->count();
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('tps.villages_id', (string)$id)
            ->where('saksi.verification', '')
            ->whereNull('saksi.pending')
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->get();
        $data['tracking'] = ModelsTracking::where('id_user', '!=', 1)->get();
        $data['title'] = "KELURAHAN " . $data['village']['name'] . "";
        $data['saksi_masuk'] = Saksi::count();
        $data['saksi_terverifikasi'] = Saksi::where('verification', 1)->count();

        return view('administrator.realcount.kelurahan', $data);
    }

    public function realcountTPS($id)
    {
      $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->where('saksi.regency_id', $this->config->regencies_id)->get();

        $paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id,SUM(voice) as total FROM saksi_data GROUP by paslon_id ORDER by total DESC'));
        // return DB::table('saksi_data')->where('paslon_id',0)->sum('voice');
        $data['paslon_tertinggi'] = Paslon::where('id', $paslon_tertinggi['0']->paslon_id)->first();
        $data['urutan'] = $paslon_tertinggi;

        $data['paslon'] = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query
                ->join('saksi', 'saksi_data.saksi_id', 'saksi.id', 'district_id')

                ->whereNull('saksi.pending')
                ->where('saksi.tps_id', (string) Crypt::decrypt($id));
        }])->get();
        $data['paslon_terverifikasi']     = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id')
                ->whereNull('saksi.pending')
                ->where('saksi.verification', 1)
                ->where('saksi.village_id', (string)Crypt::decrypt($id));
        }])->get();

        $dpt = District::where('regency_id', (string)$this->config->regencies_id)->sum("dpt");

        $data['total_incoming_vote'] = 0;
        $incoming_vote = SaksiData::join('saksi', 'saksi_data.saksi_id', "=", 'saksi.id')->select('saksi_data.voice')->where('saksi.tps_id', (string)Crypt::decrypt($id))->get();
        foreach ($incoming_vote as $key) {
            $data['total_incoming_vote'] += $key->voice;
        }
        $verification = Saksi::where('verification', 1)->with('saksi_data')->where('tps_id', Crypt::decrypt($id))->get();
        $data['total_incoming_vote'] = 0;
        $data['total_verification_voice'] = 0;
        foreach ($verification as $key) {
            foreach ($key->saksi_data as $verif) {
                $data['total_verification_voice'] += $verif->voice;
            }
        }
        $data['saksi'] = Saksi::where('verification', 1)->with('saksi_data')->where('tps_id', Crypt::decrypt($id))->first();
        $data['realcount']   = (string) $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;

        $data['tps_masuk']   = Tps::where('id', (string)Crypt::decrypt($id))->where('setup', 'terisi')->count('number');
        $data['tps_kosong']  = Tps::where('id', (string)Crypt::decrypt($id))->where('setup', 'belum_terisi')->count('number');
        $data['suara_masuk'] =  SaksiData::join('saksi', 'saksi_data.saksi_id', "=", 'saksi.id')->where('saksi.tps_id', (string)Crypt::decrypt($id))->sum('saksi_data.voice');
        $data['saksi']       = Saksi::where('tps_id', (string)Crypt::decrypt($id))->get();

        $id = Crypt::decrypt($id);
        $config = Config::first();
        $data['regency'] = Regency::where('id', (string)$this->config->regencies_id)->first();

        $data_tps =     Tps::where('id', (string)$id)->first();
        $data['data_tps'] = $data_tps;
        $data['village'] = Village::where('id', (string)$data_tps->villages_id)->first();
        $data['district'] = District::where('id', (string)$data['village']->district_id)->first();
        $data['kelurahan'] = Village::where('district_id', (string)$data['village']->district_id)->get();
        $data['paslon_candidate'] = Paslon::get();
        $data['config'] = Config::first();
        $data['jumlah_tps_masuk'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('tps.villages_id', $id)->count();
        $data['id'] = $id;
        $data['jumlah_tps_terverifikai'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('tps.villages_id', (string)$id)->where('saksi.verification', (string)1)->count();
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('tps.id', (string) $id)
            ->where('saksi.verification', '')
            ->whereNull('saksi.pending')
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->get();
        $data['tracking'] = ModelsTracking::where('id_user', '!=', 1)->get();
        $data['title'] = "KELURAHAN " . $data['village']['name'] . "";
        $data['qrcode'] = Qrcode::where('tps_id', $data['saksi'][0]['tps_id'])->first();
        if ($data['qrcode'] != null) {
            $data['verifikator'] = User::where('id', $data['qrcode']['verifikator_id'])->first();
            $data['hukum'] = User::where('id', $data['qrcode']['hukum_id'])->first();
        } else {
            $data['verifikator'] = null;
            $data['hukum'] = null;
        }

        return view('administrator.realcount.tps', $data);
    }

    public function hitung_kpu()
    {
        $data['config'] = Config::first();
        $config = Config::first();
      $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->where('saksi.regency_id', $this->config->regencies_id)->get();
        $paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id,SUM(voice) as total FROM saksi_data WHERE regency_id = "' . $this->config->regencies_id . '" GROUP by paslon_id ORDER by total DESC'));
        // return DB::table('saksi_data')->where('paslon_id',0)->sum('voice');
        $data['paslon_tertinggi'] = Paslon::where('id', $paslon_tertinggi['0']->paslon_id)->first();
        $data['urutan'] = $paslon_tertinggi;
        $dpt                              = District::where('regency_id', $this->config->regencies_id)->sum("dpt");
        $data['paslon'] = Paslon::with('saksi_data')->get();
        $data['paslon_terverifikasi']     = Paslon::with(['saksi_data' => function ($query) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id')
                ->whereNull('saksi.pending')
                ->where('saksi.verification', 1);
        }])->get();
        $data['kota'] = Regency::where('id', $this->config->regencies_id)->first();
        $data['tracking'] = ModelsTracking::get();
        $data['total_incoming_vote']      = SaksiData::sum('voice');
        $data['realcount']                =  $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;
        $data['village'] = Village::first();
        $data['villages'] = Village::get();
        $data['realcount'] =  $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;
        $data['kec'] = District::where('regency_id', $this->config->regencies_id)->get();
        $data['kecamatan'] = District::where('regency_id', $this->config->regencies_id)->get();
        $data['district'] = District::first();

        // dd($data['paslon']);
        return view('administrator.hitung_kpu.kpu', $data);
    }

    public function kpuKecamatan($id)
    {
        $paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id, SUM(voice) as total FROM saksi_data WHERE district_id = :district_id GROUP BY paslon_id ORDER BY total DESC'), ['district_id' => decrypt($id)]);
        $data['paslon_tertinggi'] = Paslon::where('id', $paslon_tertinggi['0']->paslon_id)->first();
        $data['urutan'] = $paslon_tertinggi;
      $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->where('saksi.regency_id', $this->config->regencies_id)->get();
        $data['paslon']  = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id', 'district_id')
                ->whereNull('saksi.pending')
                ->where('saksi.district_id', decrypt($id));
        }])->get();
        $data['paslon_terverifikasi']     = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id', 'district_id')
                ->whereNull('saksi.pending')
                ->where('saksi.verification', 1)->where('saksi.district_id', decrypt($id));
        }])->get();
        $verification = Saksi::where('verification', 1)->with('saksi_data')->where('district_id', decrypt($id))->get();
        $dpt = District::where('regency_id', $this->config->regencies_id)->sum("dpt");
        $incoming_vote = SaksiData::select('voice')->where('district_id', decrypt($id))->get();
        $data['total_verification_voice'] = 0;
        $data['total_incoming_vote']      = 0;
        foreach ($verification as $key) {
            foreach ($key->saksi_data as $verif) {
                $data['total_verification_voice'] += $verif->voice;
            }
        }
        $data['config'] = Config::first();
        foreach ($incoming_vote as $key) {
            $data['total_incoming_vote'] += $key->voice;
        }
        $data['realcount']   =  $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;
        $data['district']    = Village::where("district_id", decrypt($id))->get();
        $data['total_tps']   = Village::where('district_id', decrypt($id))->sum('tps');
        $data['tps_masuk']   = Tps::where('district_id', decrypt($id))->where('setup', 'terisi')->count('number');
        $data['tps_kosong']  = Tps::where('district_id', decrypt($id))->count('number');
        $data['suara_masuk'] = SaksiData::where('district_id', decrypt($id))->count('voice');
        $data['kecamatan'] = District::where('id', decrypt($id))->first();
        $data['kel'] = Village::where('district_id',  decrypt($id))->get();
        $data['tracking'] = ModelsTracking::where('id_user', '!=', 1)->get();
        $data['title'] = "KECAMATAN " . $data['kecamatan']['name'] . "";
        $data['saksi_masuk'] = Saksi::count();
        $data['saksi_terverifikasi'] = Saksi::where('verification', 1)->count();
        $data['id_kecamatan'] = decrypt($id);
        return view('administrator.hitung_kpu.kecamatan', $data);
    }

    public function kpuKelurahan($id)
    {
        $paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id, SUM(voice) as total FROM saksi_data WHERE village_id = :village_id GROUP BY paslon_id ORDER BY total DESC'), ['village_id' => (string)decrypt($id)]);

        $data['paslon_tertinggi'] = Paslon::where('id', $paslon_tertinggi['0']->paslon_id)->first();
        $data['urutan'] = $paslon_tertinggi;

        $data['paslon_tertinggi'] = Paslon::where('id', (string)$paslon_tertinggi['0']->paslon_id)->first();

        $data['paslon'] = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query
                ->join('saksi', 'saksi_data.saksi_id', 'saksi.id', 'district_id')
                ->whereNull('saksi.pending')
                ->where('saksi.village_id', (string)decrypt($id));
        }])->get();
        $data['paslon_terverifikasi']     = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id')
                ->whereNull('saksi.pending')
                ->where('saksi.verification', 1)
                ->where('saksi.village_id', (string)decrypt($id));
        }])->get();
        // dd($data['paslon_terverifikasi']);

        $dpt = District::where('regency_id', (string)$this->config->regencies_id)->sum("dpt");
        $data['total_incoming_vote'] = 0;
        $incoming_vote = SaksiData::select('voice')->where('village_id', (string)decrypt($id))->get();
        foreach ($incoming_vote as $key) {
            $data['total_incoming_vote'] += $key->voice;
        }
        $verification = Saksi::where('verification', 1)->with('saksi_data')->where('village_id', decrypt($id))->get();
        $data['total_incoming_vote'] = 0;
        $data['total_verification_voice'] = 0;
        foreach ($verification as $key) {
            foreach ($key->saksi_data as $verif) {
                $data['total_verification_voice'] += $verif->voice;
            }
        }
        $data['tps_masuk']   = Tps::where('villages_id', (string)decrypt($id))->where('setup', 'terisi')->sum('number');
        $data['realcount']   = (string) $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;

        $data['total_tps']   = Village::where('id', (string)decrypt($id))->sum('tps');
        $data['tps_masuk']   = Tps::where('villages_id', (string)decrypt($id))->where('setup', 'terisi')->count('number');
        $data['tps_kosong']  = Tps::where('villages_id', (string)decrypt($id))->where('setup', 'belum_terisi')->count('number');
        $data['suara_masuk'] = SaksiData::where('village_id', (string)decrypt($id))->sum('voice');
        $data['saksi']       = Saksi::where('village_id', (string)decrypt($id))->get();

        $id = Crypt::decrypt($id);
        $config = Config::first();
        $data['regency'] = Regency::where('id', (string)$this->config->regencies_id)->first();

        $data['village'] = Village::where('id', (string)$id)->first();
        $data['district'] = District::where('id', (string)$data['village']->district_id)->first();
        $data['kelurahan'] = Village::where('district_id', (string)$data['village']->district_id)->get();
        $data['paslon_candidate'] = Paslon::get();
        $data['config'] = Config::first();
        $data['jumlah_tps_masuk'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('tps.villages_id', $id)->count();
        $data['tps_kel'] = Tps::where('villages_id', (string)$id)->get();
        $data['id'] = $id;
        $data['id_kelurahan'] = $id;
        $data['jumlah_tps_terverifikai'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('tps.villages_id', (string)$id)->where('saksi.verification', (string)1)->count();
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('tps.villages_id', (string)$id)
            ->where('saksi.verification', '')
            ->whereNull('saksi.pending')
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->get();
        $data['tracking'] = ModelsTracking::where('id_user', '!=', 1)->get();
        $data['title'] = "KELURAHAN " . $data['village']['name'] . "";
        $data['saksi_masuk'] = Saksi::count();
        $data['saksi_terverifikasi'] = Saksi::where('verification', 1)->count();

        return view('administrator.hitung_kpu.kelurahan', $data);
    }

    public function kpuTPS($id)
    {
      $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->where('saksi.regency_id', $this->config->regencies_id)->get();

        $paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id,SUM(voice) as total FROM saksi_data GROUP by paslon_id ORDER by total DESC'));
        // return DB::table('saksi_data')->where('paslon_id',0)->sum('voice');
        $data['paslon_tertinggi'] = Paslon::where('id', $paslon_tertinggi['0']->paslon_id)->first();
        $data['urutan'] = $paslon_tertinggi;

        $data['paslon'] = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query
                ->join('saksi', 'saksi_data.saksi_id', 'saksi.id', 'district_id')

                ->whereNull('saksi.pending')
                ->where('saksi.tps_id', (string) Crypt::decrypt($id));
        }])->get();
        $data['paslon_terverifikasi']     = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id')
                ->whereNull('saksi.pending')
                ->where('saksi.verification', 1)
                ->where('saksi.village_id', (string)Crypt::decrypt($id));
        }])->get();

        $dpt = District::where('regency_id', (string)$this->config->regencies_id)->sum("dpt");

        $data['total_incoming_vote'] = 0;
        $incoming_vote = SaksiData::join('saksi', 'saksi_data.saksi_id', "=", 'saksi.id')->select('saksi_data.voice')->where('saksi.tps_id', (string)Crypt::decrypt($id))->get();
        foreach ($incoming_vote as $key) {
            $data['total_incoming_vote'] += $key->voice;
        }
        $verification = Saksi::where('verification', 1)->with('saksi_data')->where('tps_id', Crypt::decrypt($id))->get();
        $data['total_incoming_vote'] = 0;
        $data['total_verification_voice'] = 0;
        foreach ($verification as $key) {
            foreach ($key->saksi_data as $verif) {
                $data['total_verification_voice'] += $verif->voice;
            }
        }
        $data['saksi'] = Saksi::where('verification', 1)->with('saksi_data')->where('tps_id', Crypt::decrypt($id))->first();
        $data['realcount']   = (string) $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;

        $data['tps_masuk']   = Tps::where('id', (string)Crypt::decrypt($id))->where('setup', 'terisi')->count('number');
        $data['tps_kosong']  = Tps::where('id', (string)Crypt::decrypt($id))->where('setup', 'belum_terisi')->count('number');
        $data['suara_masuk'] =  SaksiData::join('saksi', 'saksi_data.saksi_id', "=", 'saksi.id')->where('saksi.tps_id', (string)Crypt::decrypt($id))->sum('saksi_data.voice');
        $data['saksi']       = Saksi::where('tps_id', (string)Crypt::decrypt($id))->get();

        $id = Crypt::decrypt($id);
        $config = Config::first();
        $data['regency'] = Regency::where('id', (string)$this->config->regencies_id)->first();

        $data_tps =     Tps::where('id', (string)$id)->first();
        $data['data_tps'] = $data_tps;
        $data['village'] = Village::where('id', (string)$data_tps->villages_id)->first();
        $data['district'] = District::where('id', (string)$data['village']->district_id)->first();
        $data['kelurahan'] = Village::where('district_id', (string)$data['village']->district_id)->get();
        $data['paslon_candidate'] = Paslon::get();
        $data['config'] = Config::first();
        $data['jumlah_tps_masuk'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('tps.villages_id', $id)->count();
        $data['id'] = $id;
        $data['jumlah_tps_terverifikai'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('tps.villages_id', (string)$id)->where('saksi.verification', (string)1)->count();
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('tps.id', (string) $id)
            ->where('saksi.verification', '')
            ->whereNull('saksi.pending')
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->get();
        $data['tracking'] = ModelsTracking::where('id_user', '!=', 1)->get();
        $data['title'] = "KELURAHAN " . $data['village']['name'] . "";
        $data['qrcode'] = Qrcode::where('tps_id', $data['saksi'][0]['tps_id'])->first();
        if ($data['qrcode'] != null) {
            $data['verifikator'] = User::where('id', $data['qrcode']['verifikator_id'])->first();
            $data['hukum'] = User::where('id', $data['qrcode']['hukum_id'])->first();
        } else {
            $data['verifikator'] = null;
            $data['hukum'] = null;
        }

        return view('administrator.hitung_kpu.tps', $data);
    }

    public function Rekapitulasi()
    {
        $data['config'] = Config::first();
        $config = Config::first();
      $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->where('saksi.regency_id', $this->config->regencies_id)->get();
        $paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id,SUM(voice) as total FROM saksi_data WHERE regency_id = "' . $this->config->regencies_id . '" GROUP by paslon_id ORDER by total DESC'));
        $data['paslon_tertinggi'] = Paslon::where('id', $paslon_tertinggi['0']->paslon_id)->first();
        $data['urutan'] = $paslon_tertinggi;
        $dpt                              = District::where('regency_id', $this->config->regencies_id)->sum("dpt");
        $data['paslon'] = Paslon::with('saksi_data')->get();
        $data['paslon_terverifikasi']     = Paslon::with(['saksi_data' => function ($query) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id')
                ->whereNull('saksi.pending')
                ->where('saksi.verification', 1);
        }])->get();
        $data['kota'] = Regency::where('id', $this->config->regencies_id)->first();
        $data['tracking'] = ModelsTracking::get();
        $data['total_incoming_vote']      = SaksiData::sum('voice');
        $data['realcount']                =  $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;
        $data['village'] = Village::first();
        $data['villages'] = Village::get();
        $data['realcount'] =  $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;
        $data['kec'] = District::where('regency_id', $this->config->regencies_id)->get();
        $data['kecamatan'] = District::where('regency_id', $this->config->regencies_id)->get();
        $data['district'] = District::first();

        // dd($data['paslon']);
        return view('administrator.rekapitulasi-perhitungan.rekapitulasi', $data);
    }

    public function rekapKecamatan($id)
    {
        $paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id, SUM(voice) as total FROM saksi_data WHERE district_id = :district_id GROUP BY paslon_id ORDER BY total DESC'), ['district_id' => decrypt($id)]);
        $data['paslon_tertinggi'] = Paslon::where('id', $paslon_tertinggi['0']->paslon_id)->first();
        $data['urutan'] = $paslon_tertinggi;
      $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->where('saksi.regency_id', $this->config->regencies_id)->get();
        $data['paslon']  = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id', 'district_id')
                ->whereNull('saksi.pending')
                ->where('saksi.district_id', decrypt($id));
        }])->get();
        $data['paslon_terverifikasi']     = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id', 'district_id')
                ->whereNull('saksi.pending')
                ->where('saksi.verification', 1)->where('saksi.district_id', decrypt($id));
        }])->get();
        $verification = Saksi::where('verification', 1)->with('saksi_data')->where('district_id', decrypt($id))->get();
        $dpt = District::where('regency_id', $this->config->regencies_id)->sum("dpt");
        $incoming_vote = SaksiData::select('voice')->where('district_id', decrypt($id))->get();
        $data['total_verification_voice'] = 0;
        $data['total_incoming_vote']      = 0;
        foreach ($verification as $key) {
            foreach ($key->saksi_data as $verif) {
                $data['total_verification_voice'] += $verif->voice;
            }
        }
        $data['config'] = Config::first();
        foreach ($incoming_vote as $key) {
            $data['total_incoming_vote'] += $key->voice;
        }
        $data['realcount']   =  $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;
        $data['district']    = Village::where("district_id", decrypt($id))->get();
        $data['total_tps']   = Village::where('district_id', decrypt($id))->sum('tps');
        $data['tps_masuk']   = Tps::where('district_id', decrypt($id))->where('setup', 'terisi')->count('number');
        $data['tps_kosong']  = Tps::where('district_id', decrypt($id))->count('number');
        $data['suara_masuk'] = SaksiData::where('district_id', decrypt($id))->count('voice');
        $data['kecamatan'] = District::where('id', decrypt($id))->first();
        $data['kel'] = Village::where('district_id',  decrypt($id))->get();
        $data['tracking'] = ModelsTracking::where('id_user', '!=', 1)->get();
        $data['title'] = "KECAMATAN " . $data['kecamatan']['name'] . "";
        $data['saksi_masuk'] = Saksi::count();
        $data['saksi_terverifikasi'] = Saksi::where('verification', 1)->count();
        $data['id_kecamatan'] = decrypt($id);
        return view('administrator.rekapitulasi-perhitungan.kecamatan', $data);
    }

    public function rekapKelurahan($id)
    {
        $paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id, SUM(voice) as total FROM saksi_data WHERE village_id = :village_id GROUP BY paslon_id ORDER BY total DESC'), ['village_id' => (string)decrypt($id)]);

        $data['paslon_tertinggi'] = Paslon::where('id', $paslon_tertinggi['0']->paslon_id)->first();
        $data['urutan'] = $paslon_tertinggi;

        $data['paslon_tertinggi'] = Paslon::where('id', (string)$paslon_tertinggi['0']->paslon_id)->first();

        $data['paslon'] = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query
                ->join('saksi', 'saksi_data.saksi_id', 'saksi.id', 'district_id')
                ->whereNull('saksi.pending')
                ->where('saksi.village_id', (string)decrypt($id));
        }])->get();
        $data['paslon_terverifikasi']     = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id')
                ->whereNull('saksi.pending')
                ->where('saksi.verification', 1)
                ->where('saksi.village_id', (string)decrypt($id));
        }])->get();
        // dd($data['paslon_terverifikasi']);

        $dpt = District::where('regency_id', (string)$this->config->regencies_id)->sum("dpt");
        $data['total_incoming_vote'] = 0;
        $incoming_vote = SaksiData::select('voice')->where('village_id', (string)decrypt($id))->get();
        foreach ($incoming_vote as $key) {
            $data['total_incoming_vote'] += $key->voice;
        }
        $verification = Saksi::where('verification', 1)->with('saksi_data')->where('village_id', decrypt($id))->get();
        $data['total_incoming_vote'] = 0;
        $data['total_verification_voice'] = 0;
        foreach ($verification as $key) {
            foreach ($key->saksi_data as $verif) {
                $data['total_verification_voice'] += $verif->voice;
            }
        }
        $data['tps_masuk']   = Tps::where('villages_id', (string)decrypt($id))->where('setup', 'terisi')->sum('number');
        $data['realcount']   = (string) $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;

        $data['total_tps']   = Village::where('id', (string)decrypt($id))->sum('tps');
        $data['tps_masuk']   = Tps::where('villages_id', (string)decrypt($id))->where('setup', 'terisi')->count('number');
        $data['tps_kosong']  = Tps::where('villages_id', (string)decrypt($id))->where('setup', 'belum_terisi')->count('number');
        $data['suara_masuk'] = SaksiData::where('village_id', (string)decrypt($id))->sum('voice');
        $data['saksi']       = Saksi::where('village_id', (string)decrypt($id))->get();

        $id = Crypt::decrypt($id);
        $config = Config::first();
        $data['regency'] = Regency::where('id', (string)$this->config->regencies_id)->first();

        $data['village'] = Village::where('id', (string)$id)->first();
        $data['district'] = District::where('id', (string)$data['village']->district_id)->first();
        $data['kelurahan'] = Village::where('district_id', (string)$data['village']->district_id)->get();
        $data['paslon_candidate'] = Paslon::get();
        $data['config'] = Config::first();
        $data['jumlah_tps_masuk'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('tps.villages_id', $id)->count();
        $data['tps_kel'] = Tps::where('villages_id', (string)$id)->get();
        $data['id'] = $id;
        $data['id_kelurahan'] = $id;
        $data['jumlah_tps_terverifikai'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('tps.villages_id', (string)$id)->where('saksi.verification', (string)1)->count();
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('tps.villages_id', (string)$id)
            ->where('saksi.verification', '')
            ->whereNull('saksi.pending')
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->get();
        $data['tracking'] = ModelsTracking::where('id_user', '!=', 1)->get();
        $data['title'] = "KELURAHAN " . $data['village']['name'] . "";
        $data['saksi_masuk'] = Saksi::count();
        $data['saksi_terverifikasi'] = Saksi::where('verification', 1)->count();

        return view('administrator.rekapitulasi-perhitungan.kelurahan', $data);
    }

    public function rekapTPS($id)
    {
      $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->where('saksi.regency_id', $this->config->regencies_id)->get();

        $paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id,SUM(voice) as total FROM saksi_data WHERE regency_id = "' . $this->config->regencies_id . '" GROUP by paslon_id ORDER by total DESC'));

        // Periksa apakah data kosong
        if (count($paslon_tertinggi) > 0) {
            $data['paslon_tertinggi'] = Paslon::find($paslon_tertinggi[0]->paslon_id);
            $data['urutan'] = $paslon_tertinggi;
        } else {
            // Tetapkan nilai default atau ambil tindakan tertentu jika data kosong
            $data['paslon_tertinggi'] = null;
            $data['urutan'] = null;
        }

        $data['paslon'] = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query
                ->join('saksi', 'saksi_data.saksi_id', 'saksi.id', 'district_id')

                ->whereNull('saksi.pending')
                ->where('saksi.tps_id', (string) Crypt::decrypt($id));
        }])->get();
        $data['paslon_terverifikasi']     = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id')
                ->whereNull('saksi.pending')
                ->where('saksi.verification', 1)
                ->where('saksi.village_id', (string)Crypt::decrypt($id));
        }])->get();

        $dpt = District::where('regency_id', (string)$this->config->regencies_id)->sum("dpt");

        $data['total_incoming_vote'] = 0;
        $incoming_vote = SaksiData::join('saksi', 'saksi_data.saksi_id', "=", 'saksi.id')->select('saksi_data.voice')->where('saksi.tps_id', (string)Crypt::decrypt($id))->get();
        foreach ($incoming_vote as $key) {
            $data['total_incoming_vote'] += $key->voice;
        }
        $verification = Saksi::where('verification', 1)->with('saksi_data')->where('tps_id', Crypt::decrypt($id))->get();
        $data['total_incoming_vote'] = 0;
        $data['total_verification_voice'] = 0;
        foreach ($verification as $key) {
            foreach ($key->saksi_data as $verif) {
                $data['total_verification_voice'] += $verif->voice;
            }
        }
        $data['saksi'] = Saksi::where('verification', 1)->with('saksi_data')->where('tps_id', Crypt::decrypt($id))->first();
        $data['realcount']   = (string) $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;

        $data['tps_masuk']   = Tps::where('id', (string)Crypt::decrypt($id))->where('setup', 'terisi')->count('number');
        $data['tps_kosong']  = Tps::where('id', (string)Crypt::decrypt($id))->where('setup', 'belum_terisi')->count('number');
        $data['suara_masuk'] =  SaksiData::join('saksi', 'saksi_data.saksi_id', "=", 'saksi.id')->where('saksi.tps_id', (string)Crypt::decrypt($id))->sum('saksi_data.voice');
        $data['saksi']       = Saksi::where('tps_id', (string)Crypt::decrypt($id))->get();

        $id = Crypt::decrypt($id);
        $config = Config::first();
        $data['regency'] = Regency::where('id', (string)$this->config->regencies_id)->first();

        $data_tps =     Tps::where('id', (string)$id)->first();
        $data['data_tps'] = $data_tps;
        $data['village'] = Village::where('id', (string)$data_tps->villages_id)->first();
        $data['district'] = District::where('id', (string)$data['village']->district_id)->first();
        $data['kelurahan'] = Village::where('district_id', (string)$data['village']->district_id)->get();
        $data['paslon_candidate'] = Paslon::get();
        $data['config'] = Config::first();
        $data['jumlah_tps_masuk'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('tps.villages_id', $id)->count();
        $data['id'] = $id;
        $data['jumlah_tps_terverifikai'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('tps.villages_id', (string)$id)->where('saksi.verification', (string)1)->count();
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('tps.id', (string) $id)
            ->where('saksi.verification', '')
            ->whereNull('saksi.pending')
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->get();
        $data['tracking'] = ModelsTracking::where('id_user', '!=', 1)->get();
        $data['title'] = "KELURAHAN " . $data['village']['name'] . "";
        $data['qrcode'] = Qrcode::where('tps_id', $data['saksi'][0]['tps_id'])->first();
        if ($data['qrcode'] != null) {
            $data['verifikator'] = User::where('id', $data['qrcode']['verifikator_id'])->first();
            $data['hukum'] = User::where('id', $data['qrcode']['hukum_id'])->first();
        } else {
            $data['verifikator'] = null;
            $data['hukum'] = null;
        }

        return view('administrator.rekapitulasi-perhitungan.tps', $data);
    }


    public function quick_count2()
    {

        $data['config'] = Config::first();
        $config = Config::first();
        $dpt                              = District::where('regency_id', $this->config->regencies_id)->sum("dpt");
        $data['paslon'] = Paslon::with('quicksaksidata')->get();
        $data['paslon_terverifikasi']     = Paslon::with(['quicksaksidata' => function ($query) {
            $query->join('quicksaksi', 'quicksaksidata.saksi_id', 'quicksaksi.id')
                ->whereNull('quicksaksi.pending')
                ->where('quicksaksi.verification', 1);
        }])->get();
        $data['total_incoming_vote']      = QuickSaksiData::sum('voice');
        $data['kota'] = Regency::where('id', $this->config->regencies_id)->first();
        $data['tracking'] = ModelsTracking::get();

        $data['realcount']  =  $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;
        $data['village'] = Village::first();
        $data['villages'] = Village::get();
        $data['realcount'] =  $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;
        $data['kec'] = District::where('regency_id', $this->config->regencies_id)->get();
        $data['kecamatan'] = District::where('regency_id', $this->config->regencies_id)->get();
        $data['district'] = District::first();
      $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->where('saksi.regency_id', $this->config->regencies_id)
            ->join('tps', 'tps.id', "=", "saksi.tps_id")
            ->where('tps.sample', 5)
            ->get();
        $paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id,SUM(voice) as total FROM saksi_data WHERE regency_id = "' . $this->config->regencies_id . '" GROUP by paslon_id ORDER by total DESC'));
        $data['paslon_tertinggi'] = Paslon::where('id', $paslon_tertinggi['0']->paslon_id)->first();
        $data['urutan'] = $paslon_tertinggi;
        $data['district_quick'] = District::join('villages', 'villages.district_id', '=', 'districts.id')->where('regency_id', $this->config->regencies_id)->get();
        return view('administrator.quickcount.quick_count2', $data);
        // dd($data['paslon']);

    }

    public function quick_count_nasional()
    {

        $data['config'] = Config::first();
        $config = Config::first();
        $dpt                              = District::where('regency_id', $this->config->regencies_id)->sum("dpt");
        $data['paslon'] = Paslon::with('quicksaksidata')->get();
        $data['paslon_terverifikasi']     = Paslon::with(['quicksaksidata' => function ($query) {
            $query->join('quicksaksi', 'quicksaksidata.saksi_id', 'quicksaksi.id')
                ->whereNull('quicksaksi.pending')
                ->where('quicksaksi.verification', 1);
        }])->get();
        $data['total_incoming_vote']      = QuickSaksiData::sum('voice');
        $data['kota'] = Regency::where('id', $this->config->regencies_id)->first();
        $data['tracking'] = ModelsTracking::get();

        $data['realcount']  =  $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;
        $data['village'] = Village::first();
        $data['villages'] = Village::get();
        $data['realcount'] =  $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;
        $data['kec'] = District::where('regency_id', $this->config->regencies_id)->get();
        $data['kecamatan'] = District::where('regency_id', $this->config->regencies_id)->get();
        $data['district'] = District::first();
      $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->where('saksi.regency_id', $this->config->regencies_id)
            ->join('tps', 'tps.id', "=", "saksi.tps_id")
            ->where('tps.sample', 5)
            ->get();
        $paslon_tertinggi = DB::select(DB::raw('SELECT paslon_id,SUM(voice) as total FROM saksi_data WHERE regency_id = "' . $this->config->regencies_id . '" GROUP by paslon_id ORDER by total DESC'));
        $data['paslon_tertinggi'] = Paslon::where('id', $paslon_tertinggi['0']->paslon_id)->first();
        $data['urutan'] = $paslon_tertinggi;
        $data['district_quick'] = District::join('villages', 'villages.district_id', '=', 'districts.id')->where('regency_id', $this->config->regencies_id)->get();
        return view('administrator.quickcount.quick_count_nasional', $data);
        // dd($data['paslon']);

    }

    public function terverifikasi()
    {

        $data['config'] = Config::first();
        $config = Config::first();
        $verification                     = Saksi::where('verification', 1)->with('saksi_data')->get();
        $dpt                              = District::where('regency_id', $this->config->regencies_id)->sum("dpt");
        $incoming_vote                    = SaksiData::select('voice')->get();
        $data['paslon'] = Paslon::with('quicksaksidata')->get();
        $data['paslon_terverifikasi']     = Paslon::with(['saksi_data' => function ($query) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id')
                ->whereNull('saksi.pending')
                ->where('saksi.verification', 1);
        }])->get();
        $data['total_incoming_vote']      = QuickSaksiData::sum('voice');
        $data['kota'] = Regency::where('id', $this->config->regencies_id)->first();
        $data['tracking'] = ModelsTracking::get();

        $data['saksi_terverifikasi'] = Saksi::where('verification', 1)->count();
        foreach ($incoming_vote as $key) {
            $data['total_incoming_vote'] += $key->voice;
        }
        $data['saksi_masuk'] = Saksi::count();
        $data['total_verification_voice'] = 0;
        $data['total_incoming_vote']      = 0;

        $paslon_tertinggi = DB::select(DB::raw('SELECT saksi_data.paslon_id, SUM(saksi_data.voice) as total FROM saksi_data JOIN saksi ON saksi.id = saksi_data.saksi_id WHERE saksi.verification = 1 GROUP BY saksi_data.paslon_id ORDER BY total DESC'));
        $data['paslon_tertinggi'] = Paslon::where('id', $paslon_tertinggi['0']->paslon_id)->first();
        $data['urutan'] = $paslon_tertinggi;

        foreach ($verification as $key) {
            foreach ($key->saksi_data as $verif) {
                $data['total_verification_voice'] += $verif->voice;
            }
        }
        foreach ($incoming_vote as $key) {
            $data['total_incoming_vote'] += $key->voice;
        }

        $data['realcount']  =  $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;
        $data['village'] = Village::first();
        $data['villages'] = Village::get();
        $data['realcount'] =  $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;
        $data['kec'] = District::where('regency_id', $this->config->regencies_id)->get();
        $data['kecamatan'] = District::where('regency_id', $this->config->regencies_id)->get();
        $data['district'] = District::first();
      $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->where('saksi.regency_id', $this->config->regencies_id)
            ->join('tps', 'tps.id', "=", "saksi.tps_id")
            ->where('tps.sample', 5)
            ->get();
        $data['district_quick'] = District::join('villages', 'villages.district_id', '=', 'districts.id')->where('regency_id', $this->config->regencies_id)->get();
        return view('administrator.terverifikasi.terverifikasi', $data);
        // dd($data['paslon']); 

    }

    public function terverifikasiKecamatan($id)
    {
        $paslon_tertinggi = DB::select(DB::raw('SELECT saksi_data.paslon_id, SUM(saksi_data.voice) as total
                                                FROM saksi_data
                                                JOIN saksi ON saksi.id = saksi_data.saksi_id
                                                WHERE saksi.verification = 1 AND saksi_data.district_id = :district_id
                                                GROUP BY saksi_data.paslon_id
                                                ORDER BY total DESC
                                            '), ['district_id' => decrypt($id)]);

        $data['paslon_tertinggi'] = Paslon::where('id', $paslon_tertinggi['0']->paslon_id)->first();
        $data['urutan'] = $paslon_tertinggi;
      $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->where('saksi.regency_id', $this->config->regencies_id)->get();
        $data['paslon']  = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id', 'district_id')
                ->whereNull('saksi.pending')
                ->where('saksi.verification', 1)
                ->where('saksi.district_id', decrypt($id));
        }])->get();
        $data['paslon_terverifikasi']     = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id')
                ->whereNull('saksi.pending')
                ->where('saksi.verification', 1)->where('saksi.district_id', decrypt($id));;
        }])->get();
        $verification = Saksi::where('verification', 1)->with('saksi_data')->where('district_id', decrypt($id))->get();
        $dpt = District::where('regency_id', $this->config->regencies_id)->sum("dpt");
        $incoming_vote = SaksiData::select('voice')->where('district_id', decrypt($id))->get();
        $data['total_verification_voice'] = 0;
        $data['total_incoming_vote']      = 0;
        foreach ($verification as $key) {
            foreach ($key->saksi_data as $verif) {
                $data['total_verification_voice'] += $verif->voice;
            }
        }
        $data['config'] = Config::first();
        foreach ($incoming_vote as $key) {
            $data['total_incoming_vote'] += $key->voice;
        }
        $data['realcount']   =  $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;
        $data['district']    = Village::where("district_id", decrypt($id))->get();
        $data['total_tps']   = Village::where('district_id', decrypt($id))->sum('tps');
        $data['tps_masuk']   = Tps::where('district_id', decrypt($id))->where('setup', 'terisi')->count('number');
        $data['tps_kosong']  = Tps::where('district_id', decrypt($id))->count('number');
        $data['suara_masuk'] = SaksiData::where('district_id', decrypt($id))->count('voice');
        $data['kecamatan'] = District::where('id', decrypt($id))->first();
        $data['kel'] = Village::where('district_id',  decrypt($id))->get();
        $data['tracking'] = ModelsTracking::where('id_user', '!=', 1)->get();
        $data['title'] = "KECAMATAN " . $data['kecamatan']['name'] . "";
        $data['saksi_masuk'] = Saksi::count();
        $data['saksi_terverifikasi'] = Saksi::where('verification', 1)->count();
        $data['id_kecamatan'] = decrypt($id);
        return view('administrator.terverifikasi.kecamatan', $data);
    }

    public function terverifikasiKelurahan($id)
    {
        $paslon_tertinggi = DB::select(DB::raw('SELECT saksi_data.paslon_id, SUM(saksi_data.voice) as total
                                                FROM saksi_data
                                                JOIN saksi ON saksi.id = saksi_data.saksi_id
                                                WHERE saksi.verification = 1 AND saksi_data.village_id = :village_id
                                                GROUP BY saksi_data.paslon_id
                                                ORDER BY total DESC
                                            '), ['village_id' => (string)decrypt($id)]);

        // $data['paslon_tertinggi'] = Paslon::where('id', $paslon_tertinggi['0']->paslon_id)->first();
        $data['urutan'] = $paslon_tertinggi;

        $data['paslon_tertinggi'] = Paslon::where('id', (string)$paslon_tertinggi['0']->paslon_id)->first();





        $data['paslon'] = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query
                ->join('saksi', 'saksi_data.saksi_id', 'saksi.id', 'district_id')
                ->whereNull('saksi.pending')
                ->where('saksi.verification', 1)
                ->where('saksi.village_id', (string)decrypt($id));
        }])->get();
        $data['paslon_terverifikasi']     = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi_data.saksi_id', 'saksi.id')
                ->whereNull('saksi.pending')
                ->where('saksi.verification', 1)
                ->where('saksi.village_id', (string)decrypt($id));
        }])->get();
        // dd($data['paslon_terverifikasi']);

        $dpt = District::where('regency_id', (string)$this->config->regencies_id)->sum("dpt");
        $data['total_incoming_vote'] = 0;
        $incoming_vote = SaksiData::select('voice')->where('village_id', (string)decrypt($id))->get();
        foreach ($incoming_vote as $key) {
            $data['total_incoming_vote'] += $key->voice;
        }
        $verification = Saksi::where('verification', 1)->with('saksi_data')->where('village_id', decrypt($id))->get();
        $data['total_incoming_vote'] = 0;
        $data['total_verification_voice'] = 0;
        foreach ($verification as $key) {
            foreach ($key->saksi_data as $verif) {
                $data['total_verification_voice'] += $verif->voice;
            }
        }
        $data['tps_masuk']   = Tps::where('villages_id', (string)decrypt($id))->where('setup', 'terisi')->sum('number');
        $data['realcount']   = (string) $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;

        $data['total_tps']   = Village::where('id', (string)decrypt($id))->sum('tps');
        $data['tps_masuk']   = Tps::where('villages_id', (string)decrypt($id))->where('setup', 'terisi')->count('number');
        $data['tps_kosong']  = Tps::where('villages_id', (string)decrypt($id))->where('setup', 'belum_terisi')->count('number');
        $data['suara_masuk'] = SaksiData::where('village_id', (string)decrypt($id))->sum('voice');
        $data['saksi']       = Saksi::where('village_id', (string)decrypt($id))->get();

        $id = Crypt::decrypt($id);
        $config = Config::first();
        $data['regency'] = Regency::where('id', (string)$this->config->regencies_id)->first();

        $data['village'] = Village::where('id', (string)$id)->first();
        $data['district'] = District::where('id', (string)$data['village']->district_id)->first();
        $data['kelurahan'] = Village::where('district_id', (string)$data['village']->district_id)->get();
        $data['paslon_candidate'] = Paslon::get();
        $data['config'] = Config::first();
        $data['jumlah_tps_masuk'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('tps.villages_id', $id)->count();
        $data['tps_kel'] = Tps::where('villages_id', (string)$id)->get();
        $data['id'] = $id;
        $data['id_kelurahan'] = $id;
        $data['jumlah_tps_terverifikai'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('tps.villages_id', (string)$id)->where('saksi.verification', (string)1)->count();
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('tps.villages_id', (string)$id)
            ->where('saksi.verification', '')
            ->whereNull('saksi.pending')
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->get();
        $data['tracking'] = ModelsTracking::where('id_user', '!=', 1)->get();
        $data['title'] = "KELURAHAN " . $data['village']['name'] . "";
        $data['saksi_masuk'] = Saksi::count();
        $data['saksi_terverifikasi'] = Saksi::where('verification', 1)->count();

        return view('administrator.terverifikasi.kelurahan', $data);
    }

    public function terverifikasiTPS($id)
    {
      $data['marquee'] = Saksi::join('users', 'users.tps_id', "=", "saksi.tps_id")->where('saksi.regency_id', $this->config->regencies_id)->get();

        $paslon_tertinggi = DB::select(DB::raw('SELECT saksi_data.paslon_id, SUM(saksi_data.voice) as total FROM saksi_data JOIN saksi ON saksi.id = saksi_data.saksi_id WHERE saksi.verification = 1 GROUP BY saksi_data.paslon_id ORDER BY total DESC'));
        $data['paslon_tertinggi'] = Paslon::where('id', $paslon_tertinggi['0']->paslon_id)->first();
        $data['urutan'] = $paslon_tertinggi;

        $data['paslon'] = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query
                ->join('saksi', 'saksi_data.saksi_id', 'saksi.id', 'district_id')

                ->whereNull('saksi.pending')
                ->where('saksi.verification', 1)
                ->where('saksi.tps_id', (string) Crypt::decrypt($id));
        }])->get();
        $data['paslon_terverifikasi']     = Paslon::with(['saksi_data' => function ($query) use ($id) {
            $query->join('saksi', 'saksi.id', 'saksi_data.saksi_id')
                ->whereNull('saksi.pending')
                ->where('saksi.verification', 1)
                ->where('saksi.tps_id', (string)Crypt::decrypt($id));
        }])->get();
        // return $data['paslon_terverifikasi'];
        $dpt = District::where('regency_id', (string)$this->config->regencies_id)->sum("dpt");

        $data['total_incoming_vote'] = 0;
        $incoming_vote = SaksiData::join('saksi', 'saksi_data.saksi_id', "=", 'saksi.id')->select('saksi_data.voice')->where('saksi.tps_id', (string)Crypt::decrypt($id))->get();
        foreach ($incoming_vote as $key) {
            $data['total_incoming_vote'] += $key->voice;
        }
        $verification = Saksi::where('verification', 1)->with('saksi_data')->where('tps_id', Crypt::decrypt($id))->get();
        $data['total_incoming_vote'] = 0;
        $data['total_verification_voice'] = 0;
        foreach ($verification as $key) {
            foreach ($key->saksi_data as $verif) {
                $data['total_verification_voice'] += $verif->voice;
            }
        }
        $data['saksi'] = Saksi::where('verification', 1)->with('saksi_data')->where('tps_id', Crypt::decrypt($id))->first();
        $data['realcount']   = (string) $dpt != 0 ? ($data['total_incoming_vote'] / $dpt * 100) : 0;

        $data['tps_masuk']   = Tps::where('id', (string)Crypt::decrypt($id))->where('setup', 'terisi')->count('number');
        $data['tps_kosong']  = Tps::where('id', (string)Crypt::decrypt($id))->where('setup', 'belum_terisi')->count('number');
        $data['suara_masuk'] =  SaksiData::join('saksi', 'saksi_data.saksi_id', "=", 'saksi.id')->where('saksi.tps_id', (string)Crypt::decrypt($id))->sum('saksi_data.voice');
        $data['saksi']       = Saksi::where('tps_id', (string)Crypt::decrypt($id))->get();

        $id = Crypt::decrypt($id);
        $config = Config::first();
        $data['regency'] = Regency::where('id', (string)$this->config->regencies_id)->first();

        $data_tps =     Tps::where('id', (string)$id)->first();
        $data['data_tps'] = $data_tps;
        $data['village'] = Village::where('id', (string)$data_tps->villages_id)->first();
        $data['district'] = District::where('id', (string)$data['village']->district_id)->first();
        $data['kelurahan'] = Village::where('district_id', (string)$data['village']->district_id)->get();
        $data['paslon_candidate'] = Paslon::get();
        $data['config'] = Config::first();
        $data['jumlah_tps_masuk'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('tps.villages_id', $id)->count();
        $data['id'] = $id;
        $data['jumlah_tps_terverifikai'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('tps.villages_id', (string)$id)->where('saksi.verification', (string)1)->count();
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('tps.id', (string) $id)
            ->where('saksi.verification', '')
            ->whereNull('saksi.pending')
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->get();
        $data['tracking'] = ModelsTracking::where('id_user', '!=', 1)->get();
        $data['title'] = "KELURAHAN " . $data['village']['name'] . "";
        $data['qrcode'] = Qrcode::where('tps_id', $data['saksi'][0]['tps_id'])->first();
        if ($data['qrcode'] != null) {
            $data['verifikator'] = User::where('id', $data['qrcode']['verifikator_id'])->first();
            $data['hukum'] = User::where('id', $data['qrcode']['hukum_id'])->first();
        } else {
            $data['verifikator'] = null;
            $data['hukum'] = null;
        }

        return view('administrator.terverifikasi.tps', $data);
    }

    public function Relawan()
    {
        $data['config'] = Config::first();
        $config = Config::first();
        $data['paslon'] = Paslon::with('quicksaksidata')->get();
        $data['paslon_terverifikasi']     = Paslon::with(['quicksaksidata' => function ($query) {
            $query->join('quicksaksi', 'quicksaksidata.saksi_id', 'quicksaksi.id')
                ->whereNull('quicksaksi.pending')
                ->where('quicksaksi.verification', 1);
        }])->get();
        $data['total_incoming_vote']      = QuickSaksiData::sum('voice');
        $data['kota'] = Regency::where('id', $this->config->regencies_id)->first();
        $data['tracking'] = ModelsTracking::get();
        $data['jumlah_relawan'] = User::where('role_id', '=', (string)14)->where('is_active', '=', '1')->count();
        return view('administrator.relawan.relawan', $data);
    }

    public function RelawanDihapus()
    {
        $data['config'] = Config::first();
        $config = Config::first();
        $data['paslon'] = Paslon::with('quicksaksidata')->get();
        $data['paslon_terverifikasi']     = Paslon::with(['quicksaksidata' => function ($query) {
            $query->join('quicksaksi', 'quicksaksidata.saksi_id', 'quicksaksi.id')
                ->whereNull('quicksaksi.pending')
                ->where('quicksaksi.verification', 1);
        }])->get();
        $data['total_incoming_vote']      = QuickSaksiData::sum('voice');
        $data['kota'] = Regency::where('id', $this->config->regencies_id)->first();
        $data['tracking'] = ModelsTracking::get();
        $data['jumlah_relawan_dihapus'] = User::where('role_id', '=', (string)14)->where('is_active', '=', '0')->count();
        return view('administrator.relawan.relawan_dihapus', $data);
    }

    public function lacakSaksi()
    {
        $data['config'] = Config::first();
        $data['jumlah_saksi'] = User::where('role_id', '=', 8)->count();
        $data['saksi'] = User::where('role_id', '=', 8)->get();
        $data['tracking'] = ModelsTracking::join('users', 'users.id', '=', 'tracking.id_user')
            ->where('users.role_id', '=', 8)
            ->select('users.*', 'tracking.*')
            ->get();
        return view('administrator.lacak.lacak_saksi', $data);
    }

    public function lacakRelawan()
    {
        $data['config'] = Config::first();
        $data['jumlah_relawan'] = User::where('role_id', '=', 14)->count();
        $data['relawan'] = User::where('role_id', '=', 14)->get();
        $data['tracking'] = ModelsTracking::join('users', 'users.id', '=', 'tracking.id_user')
            ->where('users.role_id', '=', 14)
            ->select('users.*', 'tracking.*')
            ->get();
        return view('administrator.lacak.lacak_relawan', $data);
    }

    public function lacakEnumerator()
    {
        $data['config'] = Config::first();
        $data['jumlah_enumerator'] = User::where('role_id', '=', 8)->count();
        $data['enumerator'] = User::where('role_id', '=', 8)->get();
        $data['tracking'] = ModelsTracking::join('users', 'users.id', '=', 'tracking.id_user')
            ->where('users.role_id', '=', 8)
            ->select('users.*', 'tracking.*')
            ->get();
        return view('administrator.lacak.lacak_enumerator', $data);
    }

    public function lacakAdmin()
    {
        $data['config'] = Config::first();
        $data['jumlah_admin'] = User::where('role_id', '=', 1)->count();
        $data['admin'] = User::where('role_id', '=', 1)->get();
        $data['tracking'] = ModelsTracking::join('users', 'users.id', '=', 'tracking.id_user')
            ->where('users.role_id', '=', 1)
            ->select('users.*', 'tracking.*')
            ->get();
        return view('administrator.lacak.lacak_admin', $data);
    }

    public function lacakCrowdC1()
    {
        $data['config'] = Config::first();
        $data['jumlah_crowd_c1'] = User::where('role_id', '=', 17)->count();
        $data['crowd_c1'] = User::where('role_id', '=', 17)->get();
        $data['tracking'] = ModelsTracking::join('users', 'users.id', '=', 'tracking.id_user')
            ->where('users.role_id', '=', 17)
            ->select('users.*', 'tracking.*')
            ->get();
        return view('administrator.lacak.lacak_crowd_c1', $data);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
