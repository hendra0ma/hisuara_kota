<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tps;
use App\Models\Paslon;
use App\Models\Saksi;
use App\Models\SaksiData;
use App\Models\User;
use App\Models\Village;
use App\Models\Absensi;
use App\Models\Listkecurangan;
use App\Models\Bukticatatan;
use App\Models\Bukti_deskripsi_curang;
use App\Models\Buktifoto;
use App\Models\Buktividio;
use App\Models\Config;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Tracking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DevelopingController extends Controller
{
    public function index()
    {
        $villagee = 3674040006;
        $data['dev'] = User::join('tps', 'tps.id', '=', 'users.tps_id')->where('villages', $villagee)->where('setup', 'belum terisi')->first();
        $data['kelurahan'] = Village::where('id', $villagee)->first();
        $data['paslon'] = Paslon::get();
        return view('developing.index', $data);
    }

    public function action_saksi(Request $request)
    {


        $this->validate($request,[
            'total_surat_suara' => "required|numeric",
            'surat_suara_tidak_sah' => "required|numeric",
            'surat_suara_terpakai' => "required|numeric",
            'sisa_surat_suara' => "required|numeric",
            
        ]);

        $config =  Config::find(1);

        $prov = Province::where('id', $config['provinces_id'])->first();
        $reg = Regency::where('province_id', $prov->id)->first();
        $dis = District::where('regency_id', $reg['id'])->first();
        $villages = Village::where('district_id', $dis['id'])->first();
        $villagee =   Auth::user()->villages;
        $images = $request->file('c1_plano')->store('c1_plano');
        $paslon = Paslon::get();
        $count = count($paslon);
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

        $tps = Tps::where('id', Auth::user()->tps_id)->first();

        $userrss = User::where('email', $request['email'])->first();
        Tps::where('id', $tps['id'])->update(
            [
                'user_id' =>  $userrss['id'],
                'setup' => 'terisi',
            ]
        );
        $userss = User::where('id', $userrss['id'])->update([
            'tps_id' => $tps['id']
        ]);
        $saksi = new Saksi;
        $saksi->c1_images = $images;
        $saksi->verification = "";
        $saksi->audit = "";
        $saksi->district_id = Auth::user()->districts;
        $saksi->batalkan = "0";
        $saksi->village_id =  $villagee;
        $saksi->tps_id = $tps['id'];
        $saksi->regency_id = 3674;
        $saksi->overlimit = 0;
        $saksi->save();
        $ide = $saksi->id;

        for ($i = 0; $i < $count; $i++) {
            SaksiData::create([
                'user_id' =>  $userrss['id'],
                'paslon_id' =>  $i,
                'district_id' => Auth::user()->districts,
                'village_id' =>  $villagee,
                'regency_id' => $reg->id,
                'voice' =>  (int)$request->suara[$i],
                'saksi_id' => $ide,
            ]);
        }
        return redirect('upload_c1');
    }


    function absensiSaksi()
    {
       
        if (Auth::user()->absen == "hadir") {
            return redirect()->route('upload_c1');
        }
        $data['kelurahan'] = Village::where('id', Auth::user()->villages)->first();
        $data['paslon'] = Paslon::get();
        $data['dev'] = User::join('tps', 'tps.id', '=', 'users.tps_id')->first();



        return view('developing.absensi_saksi', $data);
    }


    function actionAbsensiSaksi(Request $request)
    {

        $user_id = Auth::user()->id;
        $tracking = Tracking::where('id_user', $user_id)->latest()->first();

        $validator = Validator::make($request->all(), [
            'selfie_lokasi' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);
            $foto_profil = "";
      
        if ($request->file('selfie_lokasi')) {
            $image = $request->file('selfie_lokasi');
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = substr(str_shuffle($characters), 0, 13); // Menghasilkan string acak sepanjang 10 karakter
            $foto_profil = time()  . $randomString  .".". $image->getClientOriginalExtension();
            $image->move(public_path('storage/absensi'), $foto_profil);
        } else {
            return redirect()->back()->with("success", 'gagal mengupload data absensi');
        }

      

        Absensi::create([
            'user_id' => $user_id,
            'longitude' => $tracking->longitude,
            'latitude' => $tracking->latitude,
            'status' => 'sudah absen',
            "selfie_lokasi"=>$foto_profil
        ]);
        User::where('id', $user_id)->update([
            'absen' => "hadir"
        ]);
        return redirect()->back()->with("success", 'Anda Telah absensi');
    }


    public function tps_update()
    {
        $villagee = 3674040006;
        $usesr = Tps::where('villages_id', $villagee)->orderBy('id', 'DESC')->first();
        $use3 = Tps::where('villages_id', $villagee)->first();
        for ($x =  $use3['id']; $x <= $usesr['id']; $x++) {
            $user =  User::where('cek', 0)->first();
            User::where('id', $user['id'])->update([
                'tps_id' => $x,
                'cek' => 1,
            ]);
            echo 'Oke';
        }
    }

    public function test_geo()
    {
        return view('developing.test_geo');
    }
    public function saksi_update()
    {
        for ($x = 1526; $x <= 1581; $x++) {
            $user =  Saksi::where('cek', 0)->first();
            Saksi::where('id', $user['id'])->update([
                'tps_id' => $x,
                'cek' => 1,
            ]);
            echo 'Oke';
        }
    }
    public function tps_user_update()
    {

        $villagee = 3674040006;
        $usesr = User::where('villages', $villagee)->orderBy('id', 'DESC')->first();
        $use3 = User::where('villages', $villagee)->first();
        for ($x =  $use3['id']; $x <= $usesr['id']; $x++) {
            $tps =  Tps::where('cek', 0)->where('villages_id', $villagee)->first();
            Tps::where('id', $tps['id'])->update([
                'user_id' => $x,
                'cek' => 1,
            ]);
            echo 'Oke';
        }
    }


    public function absen()
    {
        $user = User::where('role_id', 8)->get();
        foreach ($user as $us) {
            Absensi::create([
                'user_id' => $us['id'],
                'longitude' => '106.8634106',
                'latitude' => '-6.5619046',
                'status' => 'sudah absen',
            ]);
            User::where('id', $us['id'])->update([
                'absen' => 'hadir',
            ]);
            echo 'ok';
        }
    }
    public function upload_kecurangan(Request $request)
    {



        $villagee = 3674040006;
        $data['tps'] = Tps::where('villages_id', $villagee)->get();
        $data['list_kecurangan'] = Listkecurangan::get();
        $data['kelurahan'] = Village::where('id', $villagee)->first();

        $data['list_solution'] = Bukti_deskripsi_curang::join('list_kecurangan', 'list_kecurangan.id', '=', 'bukti_deskripsi_curang.list_kecurangan_id')
            ->join('solution_frauds', 'solution_frauds.id', '=', 'list_kecurangan.solution_fraud_id')
            ->where('bukti_deskripsi_curang.tps_id', $request['id'])
            ->select('solution_frauds.*', 'bukti_deskripsi_curang.*', 'list_kecurangan.*', 'list_kecurangan.id as id_list')
            ->get();
        $data['pelanggaran_umum']    = Listkecurangan::where('jenis', 0)->get();
        $data['pelanggaran_petugas'] = Listkecurangan::where('jenis', 1)->get();
        $data['pelanggaran_etik'] = Listkecurangan::where('jenis', 2)->get();
        $villagee = 3674040006;
        $data['tps'] = Tps::where('villages_id', (string)$villagee)->get();
        return view('developing.upload_kecurangan', $data);
    }
    public function upload_kecurangan_2(Request $request)
    {
        $villagee = 3674040006;
        $data['tps'] = Tps::where('villages_id', (string)$villagee)->get();
        $data['list_kecurangan'] = Listkecurangan::get();
        $data['kelurahan'] = Village::where('id', (string)$villagee)->first();
        $data['pelanggaran_umum']    = Listkecurangan::where('jenis', 0)->get();
        $data['pelanggaran_petugas'] = Listkecurangan::where('jenis', 1)->get();
        return view('developing.upload_kecurangan_2', $data);
    }
    public function action_upload_kecurangan(Request $request)
    {
        Validator::make($request->all(), [
            'curang.*' => ['required'],
            'tps' => ['required'],
            'foto' => ['required'],
        ])->validate();

        $tps = Tps::where('id', $request['tps'])->first();
        $saksi = Saksi::where('tps_id', $request['tps'])->update([
            'status_kecurangan' => 'belum terverifikasi',
            'kecurangan' => 'yes',
        ]);
        $fromListKecurangan = $request['curang'];
        foreach ($fromListKecurangan as $data) {
            Bukti_deskripsi_curang::create([
                'tps_id' => $request['tps'],
                'text' => $data,
            ]);
        }
        Bukticatatan::create([
            'tps_id' => $request['tps'],
            'text' => $request['curang'],
        ]);
        Buktifoto::create([
            'url' => $request->file('foto')->store('hukum/bukti_foto'),
            'user_id' => $tps['user_id'],
            'tps_id' => $request['tps'],

        ]);
        Buktividio::create([
            'url' => 1,
            'user_id' => $tps['user_id'],
            'tps_id' => $request['tps'],
            'bukti_vidio' => 0,
        ]);

        echo 'Oke sayang input lagi yaaa';
    }
    public function upload_kecurangansss(Request $request)
    {

        Validator::make($request->all(), [
            'curang.*' => ['required'],
            'tps' => ['required'],
            'foto' => ['required'],

        ])->validate();


        $tps = Tps::where('id', $request['tps'])->first();
        $saksi = Saksi::where('tps_id', $request['tps'])->update([
            'status_kecurangan' => 'belum terverifikasi',
            'kecurangan' => 'yes',
        ]);
        $fromListKecurangan = $request['curang'];
        // foreach ($fromListKecurangan as $data) {
        //     $list = Listkecurangan::where('id', $data)->first();
        //     Bukti_deskripsi_curang::create([
        //         'tps_id' => $request['tps'],
        //         'text' =>  $list['kecurangan'],
        //         'list_kecurangan_id' => $list['id'],
        //     ]);

        // }
        Bukticatatan::create([
            'tps_id' => $request['tps'],
            'text' => $request['curang'],
        ]);
        Buktifoto::create([
            'url' => $request->file('foto')->store('hukum/bukti_foto'),
            'user_id' => $tps['user_id'],
            'tps_id' => $request['tps'],

        ]);
        Buktividio::create([
            'url' => 1,
            'user_id' => $tps['user_id'],
            'tps_id' => $request['tps'],
            'bukti_vidio' => 0,
        ]);

        return redirect('/upload_kecurangan');
    }
    public function upload_c1()
    {
        $villagee = Auth::user()->villages;
        $data['dev'] = User::join('tps', 'tps.id', '=', 'users.tps_id')->first();
        $data['kelurahan'] = Village::where('id', $villagee)->first();
        $data['paslon'] = Paslon::get();
        $cekSaksi = Saksi::where('tps_id', Auth::user()->tps_id)->count('id');
     
            return view('developing.c1_plano', $data);
    
    }
    public function c1_quickcount()
    {
        return view('developing.c1_quickcount');
    }
}
