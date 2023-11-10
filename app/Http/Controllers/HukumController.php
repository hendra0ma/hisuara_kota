<?php

namespace App\Http\Controllers;

use App\Events\CountEvent;
use App\Models\Bukti_deskripsi_curang;
use App\Models\Bukticatatan;
use App\Models\Buktifoto as ModelsBuktifoto;
use App\Models\Buktividio as ModelsBuktividio;
use App\Models\Config;
use App\Models\Configs;
use App\Models\Databukti;
use App\Models\District;
use App\Models\Listkecurangan as ModelsListkecurangan;
use App\Models\Paslon;
use App\Models\Qrcode as ModelsQrcode;
use App\Models\Qrcode;
use App\Models\QuickSaksiData;
use App\Models\RegenciesDomain;
use App\Models\Regency;
use App\Models\Saksi;
use App\Models\Tps;
use App\Models\User;
use App\Models\Village;

use App\Models\SuratPernyataan;
use App\Models\Tracking;
use BuktiDeskirpsiCurang;
use BuktiFoto;
use BuktiVidio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use ListKecurangan;
use Svg\Tag\Rect;

class HukumController extends Controller
{
    public $config;
    public $configs;
    public function __construct()
    {

        $currentDomain = request()->getHttpHost();
        if (isset(parse_url($currentDomain)['port'])) {
            $url = substr($currentDomain, 0, strpos($currentDomain, ':8000'));
        }else{
            $url = $currentDomain;
        }
        $regency_id = RegenciesDomain::where('domain',"LIKE","%".$url."%")->first();

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
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('saksi.kecurangan', 'yes')
            ->where('saksi.status_kecurangan', 'terverifikasi validator')
            ->orWhere('saksi.status_kecurangan', 'diproses')
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->get();
        $data['index_tsm']    = ModelsListkecurangan::get();
        $data['terverifikasi'] = Saksi::where('kecurangan', 'yes')->where('status_kecurangan', 'terverifikasi')->get();
        $data['ditolak'] = Saksi::where('kecurangan', 'yes')->where('status_kecurangan', 'ditolak')->get();
        $data['data_masuk'] = Saksi::where('kecurangan', 'yes')->get();
        $data['team'] = User::where('id', '!=', Auth::user()->id)->where('role_id', 7)->get();
        return view('hukum.index', $data);
    }

    public function validatorKecurangan ()
    {
        $data['config'] = Config::first();
        $config = $data['config'];
        $data['paslon'] = Paslon::with('quicksaksidata')->get();
        $data['paslon_terverifikasi']     = Paslon::with(['quicksaksidata' => function ($query) {
            $query->join('quicksaksi', 'quicksaksidata.saksi_id', 'quicksaksi.id')
                ->whereNull('quicksaksi.pending')
                ->where('quicksaksi.verification', 1);
        }])->get();
        $data['total_incoming_vote']      = QuickSaksiData::sum('voice');
        $data['kota'] = Regency::where('id', $this->config->regencies_id)->first();
        $data['tracking'] = Tracking::get();
        $data['jumlah_tps_masuk'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->count();
        $data['jumlah_tps_terverifikai'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('saksi.verification', 1)->count();
        $data['jumlah_tps_terverifikai'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')->where('saksi.verification', 1)->count();
        $data['total_tps']   =  Tps::where('setup','belum terisi')->count();
        $data['jumlah_kosong']  =  $data['total_tps'] - $data['jumlah_tps_masuk'];

        $data['index_tsm']    = ModelsListkecurangan::get();
        $data['terverifikasi'] = Saksi::where('kecurangan', 'yes')->where('status_kecurangan', 'terverifikasi')->get();
        $data['ditolak'] = Saksi::where('kecurangan', 'yes')->where('status_kecurangan', 'ditolak')->get();
        $data['data_masuk'] = Saksi::where('kecurangan', 'yes')->get();
        $data['team'] = User::where('id', '!=', Auth::user()->id)->where('role_id', 7)->get();
        return view('administrator.kecurangan.validator_kecurangan', $data);
    }

    public function terverifikasi()
    {
        $data['index_tsm']    = ModelsListkecurangan::get();

        $data['terverifikasi'] = Saksi::where('kecurangan', 'yes')->where('status_kecurangan', 'terverifikasi')->get();
        $data['ditolak'] = Saksi::where('kecurangan', 'yes')->where('status_kecurangan', 'ditolak')->get();
        $data['data_masuk'] = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
            ->join('users', 'users.tps_id', '=', 'tps.id')
            ->where('saksi.kecurangan', 'yes')
            ->where('saksi.status_kecurangan', 'terverifikasi validator')
            ->orWhere('saksi.status_kecurangan', 'diproses')
            ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
            ->get();
        return view('hukum.terverifikasi', $data);
    }

    public function ditolak()
    {
        $data['index_tsm']    = ModelsListkecurangan::get();
        $data['terverifikasi'] = Saksi::where('kecurangan', 'yes')->where('status_kecurangan', 'terverifikasi')->get();
        $data['ditolak'] = Saksi::where('kecurangan', 'yes')->where('status_kecurangan', 'ditolak')->get();
        $data['data_masuk'] = Saksi::where('kecurangan', 'yes')->get();
        return view('hukum.ditolak', $data);
    }

    public function indextsm()
    {
        $data['index_tsm']    = ModelsListkecurangan::get();
        $data['terverifikasi'] = Saksi::where('kecurangan', 'yes')->where('status_kecurangan', 'terverifikasi')->get();
        $data['ditolak'] = Saksi::where('kecurangan', 'yes')->where('status_kecurangan', 'ditolak')->get();
        $data['data_masuk'] = Saksi::where('kecurangan', 'yes')->get();
        return view('hukum.index_tsm', $data);
    }



    ///// Ajax Hukum
    public function get_foto_kecurangan(Request $request)
    {
        $data['foto_kecurangan'] = ModelsBuktifoto::where('tps_id', $request['id'])->get();
        $data['vidio_kecurangan'] = ModelsBuktividio::where('tps_id', $request['id'])->first();
        $data['list_kecurangan']     = Bukti_deskripsi_curang::where('tps_id', $request['id'])->get();
        $data['list_solution'] = Bukti_deskripsi_curang::
        join('list_kecurangan','list_kecurangan.id','=','bukti_deskripsi_curang.list_kecurangan_id')
        ->join('solution_frauds', 'solution_frauds.id', '=', 'list_kecurangan.solution_fraud_id')
        ->where('bukti_deskripsi_curang.tps_id',$request['id'])
        ->select('solution_frauds.*','bukti_deskripsi_curang.*','list_kecurangan.*','list_kecurangan.id as id_list')
        ->get();
        $data['pelanggaran_umum']    = ModelsListkecurangan::where('jenis', 0)->get();
        $data['pelanggaran_petugas'] = ModelsListkecurangan::where('jenis', 1)->get();
        $data['tps'] = Tps::where('id', $request['id'])->first();
        $data['kecamatan'] = District::where('id', $data['tps']['district_id'])->first();
        $data['bukti_vidio'] = ModelsBuktividio::where('tps_id', $request['id'])->get();
        $data['bukti_foto'] = ModelsBuktifoto::where('tps_id', $request['id'])->get();
        $data['saksi'] = Saksi::where('tps_id', $request['id'])->first();

        $data['user'] = User::where('tps_id', $request['id'])->first();
        $data['qrcode'] = Qrcode::where('tps_id', $data['user']['tps_id'])->first();
        if ($data['qrcode'] != null) {
            $data['verifikator']            = User::where('id', $data['qrcode']['verifikator_id'])->first();
            $data['hukum']                  = User::where('id', $data['qrcode']['hukum_id'])->first();
        } else {
            $data['verifikator']            = null;
            $data['hukum']                  = null;
        }
        $data['saksi'] = Saksi::where('tps_id', $data['tps']['id'])->first();
        // dump($data);die;
        return view('hukum.ajax.fotokecurangan', $data);
    }
    public function getsolution(Request $request)
    {
        $data= ModelsListkecurangan::join('solution_frauds','solution_frauds.id','=','list_kecurangan.solution_fraud_id')->where('list_kecurangan.id',$request->id_list)->first();
        return response()->json($data,200);
    }

    public function get_fotoKecuranganterverifikasi(Request $request)
    {
        $data['foto_kecurangan'] = ModelsBuktifoto::where('tps_id', $request['id'])->get();
        $data['vidio_kecurangan'] = ModelsBuktividio::where('tps_id', $request['id'])->first();
        $data['list_kecurangan']     = Bukti_deskripsi_curang::where('tps_id', $request['id'])->get();
        $data['pelanggaran_umum']    = ModelsListkecurangan::where('jenis', 0)->get();
        $data['pelanggaran_petugas'] = ModelsListkecurangan::where('jenis', 1)->get();
        $data['tps'] = Tps::where('id', $request['id'])->first();
        $data['kecamatan'] = District::where('id', $data['tps']['district_id'])->first();
        $data['bukti_vidio'] = ModelsBuktividio::where('tps_id', $request['id'])->get();
        $data['bukti_foto'] = ModelsBuktifoto::where('tps_id', $request['id'])->get();
        $data['saksi'] = Saksi::where('tps_id', $request['id'])->first();
        return view('hukum.ajax.fotoKecuranganterverifikasi', $data);
    }

    public function get_fotoKecuranganditolak(Request $request)
    {
        $data['foto_kecurangan'] = ModelsBuktifoto::where('tps_id', $request['id'])->get();
        $data['vidio_kecurangan'] = ModelsBuktividio::where('tps_id', $request['id'])->first();
        $data['list_kecurangan']     = Bukti_deskripsi_curang::where('tps_id', $request['id'])->get();
        $data['pelanggaran_umum']    = ModelsListkecurangan::where('jenis', 0)->get();
        $data['pelanggaran_petugas'] = ModelsListkecurangan::where('jenis', 1)->get();
        $data['tps'] = Tps::where('id', $request['id'])->first();
        $data['kecamatan'] = District::where('id', $data['tps']['district_id'])->first();
        $data['bukti_vidio'] = ModelsBuktividio::where('tps_id', $request['id'])->get();
        $data['bukti_foto'] = ModelsBuktifoto::where('tps_id', $request['id'])->get();
        $data['saksi'] = Saksi::where('tps_id', $request['id'])->first();
        return view('hukum.ajax.fotoKecuranganditolak', $data);
    }

    public function verifikasi_kecurangan(Request $request)
    {
        $data['tps'] = Tps::where('id', Crypt::decrypt($request['id']))->first();
        //    return view('hukum.print.kecurangan',$data);
        var_dump($request['id']);
    }

    //// Action Hukum
    public function proses_kecurangan(Request $request, $id)
    {
       $kecurangan = $request['bukti_text'];
        if ($kecurangan == null) {
            $kecurangan = [];
        }
        $fromListKecurangan = $request['curang'];
        $catatanHukum = $request['kecurangan'];
        // if ($request['curang'] != null) {
        //     foreach ($fromListKecurangan as $data) {
        //         Bukti_deskripsi_curang::create([
        //             'tps_id' => Crypt::decrypt($id),
        //             'text' => $data,
        //         ]);
        //     }
        // }

    

        if ($request['kecurangan'] != null) {
            Bukticatatan::create([
                'tps_id' => Crypt::decrypt($id),
                'text' => $request['kecurangan'],
            ]);
        }
        if ($request['bukti'] != NULL) {
            $buktiImplode = implode('|', $request['bukti']);
            Databukti::create([
                'tps_id' => Crypt::decrypt($id),
                'bukti' => $buktiImplode,
            ]);
        }
        $crypt = Crypt::encrypt(rand());
        // Saksi::where('tps_id', Crypt::decrypt($id))->update([
        //     'status_kecurangan' => 'terverifikasi',
        // ]);
        $bulan = date('m');
        $tahun = date('y');
        $tps = Tps::where('id', Crypt::decrypt($id))->first();
        $no_berkas = Crypt::decrypt($id) . "/BK"  . "/PILPRES/" . $bulan . "/" . $tahun . "";

        $save = Qrcode::create([
            'tps_id' => $id,
            'verifikator_id' => Auth::user()->id,
            'hukum_id' => Auth::user()->role_id,
            'tanggal_masuk' => now(),
            'token' => encrypt(rand()),
            'nomor_berkas' => $no_berkas,
            'hukum_id' => Auth::user()->id,
        ]);

        // $save = Qrcode::where('tps_id',Crypt::decrypt($id))->update([
        //     'token'  => $crypt,
        //     'nomor_berkas' => $no_berkas,
        //     'hukum_id' => Auth::user()->id,
        // ]);
        
        $data = [
            'status_kecurangan' =>'terverifikasi',
            'verifikator_id' => Auth::user()->id,
        ];
        Saksi::where('tps_id', $id)->update($data);




        $qr =  Qrcode::where('tps_id',Crypt::decrypt($id))->first();
        $saksi = Saksi::where('tps_id', Crypt::decrypt($id))->first();
        SuratPernyataan::create([
            'deskripsi' => 'Dengan ini menyatakan bahwa saya siap bertanggung jawab atas data dan bukti-bukti yang saya kirimkan dari TPS tempat saya bertugas dan bisa dipertanggung jawabkan kebenaranya. Saya bersedia hadir untuk memberikan keterangan sebagai saksi pada pihak-pihak terkait jika diperlukan. Demikian pernyataan ini dibuat dalam keadaan sadar sehat jasmani raohani serta tidak ada paksaan dari pihak manapun.',
            'saksi_id' => $saksi->id,
            'qrcode_hukum_id' => $qr->id,
        ]);
        if ($save) {
            return redirect('hukum/index/');
        } else {
            echo 'Terjadi Kesalahan Tak Terduga Hubungi Admin';
        }
    }

    public function action_verifikasi_kecurangan(Request $request, $id)
    {
        $verifikasi = Saksi::where('tps_id', Crypt::decrypt($id))->update([
            'status_kecurangan' => 'terverifikasi',
        ]);
        $saksi = Saksi::where('tps_id',Crypt::decrypt($id))->first();
        $qr = Qrcode::where('tps_id',Crypt::decrypt($id))->first();
             SuratPernyataan::create([
                 'deskripsi' => 'Dengan ini menyatakan bahwa saya siap bertanggung jawab atas data dan bukti-bukti yang saya kirimkan dari TPS tempat saya bertugas dan bisa dipertanggung jawabkan kebenaranya. Saya bersedia hadir untuk memberikan keterangan sebagai saksi pada pihak-pihak terkait jika diperlukan. Demikian pernyataan ini dibuat dalam keadaan sadar sehat jasmani raohani serta tidak ada paksaan dari pihak manapun.',
                 'saksi_id' => $saksi->id,
                 'qrcode_hukum_id' => $qr->id,
             ]);
        if ($verifikasi) {
            return redirect('hukum/index')->with(['success' => 'Pesan Error']);
        }
    }

    public function action_tolak_kecurangan(Request $request, $id)
    {
        $tolak = Saksi::where('tps_id', Crypt::decrypt($id))->update([
            'status_kecurangan' => 'ditolak',
        ]);
        if ($tolak) {
            return redirect('hukum/index')->with(['error' => 'Pesan Error']);
        }
    }

    public function print(Request $request, $id)
    {
        $data['tps']       = Tps::where('id', Crypt::decrypt($request['id']))->first();
        $data['saksi']     = Saksi::where('tps_id', Crypt::decrypt($request['id']))->first();
        $data['qrcode']    = ModelsQrcode::where('tps_id', Crypt::decrypt($request['id']))->first();
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
        $data['foto_kecurangan'] = ModelsBuktifoto::where('tps_id', Crypt::decrypt($request['id']))->get();
        $data['vidio_kecurangan'] = ModelsBuktividio::where('tps_id', Crypt::decrypt($request['id']))->first();
        return view('hukum.print.kecurangan', $data);

    }
}
