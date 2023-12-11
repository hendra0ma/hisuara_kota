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
use App\Models\CrowdC1;
use App\Models\DataCrowdC1;
use App\Models\DataSaksiC;
use App\Models\District;
use App\Models\Kecurangan;
use App\Models\Province;
use App\Models\Regency;
use App\Models\SaksiC;
use App\Models\SuratSuara;
use App\Models\Tracking;
use App\Models\VideoPernyataan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DevelopingController extends Controller
{
    public function index()
    {
        $villagee = $saksi['villages'];
        $data['dev'] = User::join('tps', 'tps.id', '=', 'users.tps_id')->where('villages', $villagee)->where('setup', 'belum terisi')->first();
        $data['kelurahan'] = Village::where('id', $villagee)->first();
        $data['paslon'] = Paslon::get();
        return view('developing.index', $data);
    }

    function c1Crowd()
    {
        $data['paslon'] = Paslon::get();
        return view('developing.crowd', $data);
    }


    function uploadC1Crowd(Request $request)
    {
        if ($request->tipe == "suara") {
            $this->validate($request, [
                'provinsi' => 'required',
                'kota' => 'required',
                'kecamatan' => 'required',
                'kelurahan' => 'required',
                'tps' => 'required',
                "suara.*" => 'required'
            ]);
        } else {
            $this->validate($request, [
                'provinsi' => 'required',
                'kota' => 'required',
            ]);
        }


        if (!$request->file('c1_images')) {
            return redirect()->back()->with('error', 'Foto c1 Crowd wajib di isi');
        }
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if ($request->file('c1_images')) {
            $image = $request->file('c1_images');
            $randomString = substr(str_shuffle($characters), 0, 50); // Menghasilkan string acak sepanjang 10 karakter
            $c1_images = time() . $randomString  . "." .  $image->getClientOriginalExtension();
            $image->move(public_path('storage/c1_plano'), $c1_images);
        } else {
            return response()->json(['message' => 'Gagal mengunggah gambar'], 500);
        }
        $user = Auth::user();
        $crowd_c1 = new CrowdC1;
        $crowd_c1->crowd_c1 =  $c1_images;
        $crowd_c1->status = '0';
        $crowd_c1->user_id = $user->id;
        $crowd_c1->regency_id = $request->input('kota');
        if ($request->tipe == "suara") {
            $crowd_c1->district_id = $request->input('kecamatan');
            $crowd_c1->village_id = $request->input('kelurahan');
            $crowd_c1->tps_id =  $request->input('tps');
        }
        $crowd_c1->save();
        $id_crowd = $crowd_c1->id;
        if ($request->tipe == "suara") {
            $paslon = Paslon::get();
            $index = 0;
            foreach ($paslon as $pas) {

                DataCrowdC1::insert([
                    'user_id' => $user->id,
                    'paslon_id' => $pas->id,
                    'village_id' => $request->input('kelurahan'),
                    'tps_id' => $request->input('tps'),
                    'district_id' => $request->input('kecamatan'),
                    'regency_id' => $request->input('kota'),
                    'created_at' => Carbon::now(),
                    'crowd_c1_id' => $id_crowd,
                    'voice' => $request->suara[$index]

                ]);
                $index++;
            }
        }



        return redirect()->back()->with('success', 'berhasil mengupload C1 Crowd');
    }


    public function action_saksi(Request $request)
    {


        $this->validate($request, [
            'suara.*' => "required|numeric",

        ]);
        $district = District::where('id', Auth::user()->districts)->first();
        $regency = Regency::where("id", $district->regency_id)->first();

        $config =  Config::find(1);


        $villagee =   Auth::user()->villages;
        $count = Paslon::count();

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
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if ($request->file('c1_plano')) {
            $image = $request->file('c1_plano');
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = substr(str_shuffle($characters), 0, 50); // Menghasilkan string acak sepanjang 10 karakter
            $c1_plano = time()  . $randomString  . "." . $image->getClientOriginalExtension();
            $image->move(public_path('storage/c1_plano'), $c1_plano);
        } else {
            return redirect()->back()->with("error", 'gagal mengupload data C1 Plano');
        }

        $saksi = new Saksi;
        $saksi->c1_images = $c1_plano;
        $saksi->verification = "";
        $saksi->audit = "";
        $saksi->district_id = Auth::user()->districts;
        $saksi->batalkan = "0";
        $saksi->village_id =  $villagee;
        $saksi->overlimit = 0;
        $saksi->tps_id = Auth::user()->tps_id;
        $saksi->regency_id = $regency->id;
        $saksi->province_id = Auth::user()->province_id;
        $saksi->save();
        $ide = $saksi->id;
        $paslon = Paslon::get();
        // for ($i = 0; $i < $count; $i++) {
        $i = 0;
        $updtSuara = [];
        foreach ($paslon as $item) {
            SaksiData::create([
                'user_id' =>  $userrss['id'],
                'paslon_id' =>  $item->id,
                'district_id' => Auth::user()->districts,
                'village_id' =>  $villagee,
                'regency_id' => $regency->id,
                'province_id' => Auth::user()->province_id,
                'voice' =>  (int)$request->suara[$i],
                'saksi_id' => $ide,
            ]);
            $updtSuara[] = (int)$request->suara[$i];
        }
        $suara1 = $regency->suara1 + $updtSuara[0];
        $suara2 = $regency->suara2 + $updtSuara[1];
        $suara3 = $regency->suara3 + $updtSuara[2];
        Regency::where('id', $regency->id)->update([
            'suara1' => $suara1,
            'suara2' => $suara2,
            'suara3' => $suara3,
        ]);
        return redirect()->route('dashboard.saksi2');
    }


    public function action_saksi_c(Request $request)
    {
        if ($request->file('formulir')) {
            $image = $request->file('formulir');
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = substr(str_shuffle($characters), 0, 50); // Menghasilkan string acak sepanjang 10 karakter
            $formulir = time()  . $randomString  . "." . $image->getClientOriginalExtension();
            $image->move(public_path('storage/formulir'), $formulir);
        } else {
            return redirect()->back()->with("error", 'gagal mengupload data C1 Plano');
        }
        $village_id =   Auth::user()->villages;
        $district_id =  Auth::user()->districts;
        $tps_id =  Auth::user()->tps_id;




        $saksi = new SaksiC;
        $saksi->c_images = $formulir;
        $saksi->regency_id = substr($district_id, 0, 4);
        $saksi->province_id = substr($district_id, 0, 2);
        $saksi->district_id = $district_id;
        $saksi->village_id =  $village_id;
        $saksi->tps_id =   $tps_id;
        $saksi->save();


        return redirect()->route('dashboard.saksi2');
    }

    function uploadSuratSuara()
    {

        // if (Auth::user()->absen == "hadir") {
        //     return redirect()->route('upload_c1');
        // }
        $data['kelurahan'] = Village::where('id', Auth::user()->villages)->first();
        $data['paslon'] = Paslon::get();
        $data['dev'] = User::join('tps', 'tps.id', '=', 'users.tps_id')->first();

        return view('developing.surat_suara');
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

    function actionSuratSuara(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "dpt" => "required|numeric",
            "surat_suara_sah" => "required|numeric",
            "jumlah_sah_dan_tidak" => "required|numeric",
            "total_surat_suara" => "required|numeric",
            "surat_suara_tidak_sah" => "required|numeric",
            "surat_suara_terpakai" => "required|numeric",
            "sisa_surat_suara" => "required|numeric",
            "surat_suara.*" => 'image|mimes:jpeg,png,jpg,gif'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if ($request->hasFile('surat_suara')) {
            $surat_suara = $request->file('surat_suara');
            $pathFotoArray = [];
            foreach ($surat_suara as $image) {
                $randomString = substr(str_shuffle($characters), 0, 50); // Menghasilkan string acak sepanjang 10 karakter
                $imageName = time()  . $randomString  . "." .  $image->getClientOriginalName();
                $image->move(public_path('storage/surat_suara'), $imageName);
                $pathFotoArray[] = $imageName;
            }
            $namaFoto = implode('|', $pathFotoArray);
        }
        SuratSuara::insert([
            "total_surat_suara" => $request->input("total_surat_suara"),
            "surat_suara_tidak_sah" => $request->input("surat_suara_tidak_sah"),
            "surat_suara_terpakai" => $request->input("surat_suara_terpakai"),
            "sisa_surat_suara" => $request->input("sisa_surat_suara"),
            "dpt" => $request->input("dpt"),
            "surat_suara_sah" => $request->input("surat_suara_sah"),
            "jumlah_sah_dan_tidak" => $request->input("jumlah_sah_dan_tidak"),
            "foto_surat_suara" => $namaFoto,
            "tps_id" => Auth::user()->tps_id,
            "user_id" => Auth::user()->id
        ]);

        return redirect()->back()->with('success', 'Surat Suara Berhasil di Upload');
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
            $randomString = substr(str_shuffle($characters), 0, 50); // Menghasilkan string acak sepanjang 10 karakter
            $foto_profil = time()  . $randomString  . "." . $image->getClientOriginalExtension();
            $image->move(public_path('storage/absensi'), $foto_profil);
        } else {
            return redirect()->back()->with("error", 'gagal mengupload data absensi');
        }
        Absensi::create([
            'user_id' => $user_id,
            'longitude' => $tracking->longitude,
            'latitude' => $tracking->latitude,
            'status' => 'sudah absen',
            "selfie_lokasi" => $foto_profil
        ]);
        User::where('id', $user_id)->update([
            'absen' => "hadir"
        ]);
        return redirect()->back()->with("success", 'Anda Telah absensi');
    }


    public function tps_update()
    {
        $villagee = $saksi['villages'];
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

        $villagee = $saksi['villages'];
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
        $villagee = Auth::user()->villages;
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

        if ($request->hasFile('foto') == false && $request->hasFile('video') == false) {
            Validator::make($request->all(), [
                'foto' => ['required', 'file', 'mimes:jpeg,png,jpg,gif'], // Sesuaikan dengan ekstensi file yang diizinkan
                'video' => ['required', 'file', 'mimetypes:video/mp4,video/avi'], // Sesuaikan dengan tipe MIME file video yang diizinkan
            ])->validate();
        }
   
        Validator::make($request->all(), [
            'video_pernyataan' => ['required', 'file', 'mimetypes:video/mp4,video/avi'],
            "audioFile"=>['required', 'file']
        ])->validate();


        if ($request->hasFile('audioFile')) {
                $audioFile = $request->file('audioFile');
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $randomString = substr(str_shuffle($characters), 0, 50); // Menghasilkan string acak sepanjang 10 karakter
                $audio = time()  . $randomString  . "." . $audioFile->getClientOriginalExtension();
                $audioFile->move(public_path('storage/hukum/bukti_rekaman'), $audio);
            
        }

        $kecurangan = new Kecurangan;
        $kecurangan->user_id = Auth::user()->id;
        $kecurangan->rekaman = "hukum/bukti_foto/" . $audio;
        $kecurangan->regency_id = Auth::user()->regency_id;
        if (Auth::user()->role_id ==  8) {
            $kecurangan->tps_id = Auth::user()->tps_id;   
        }
        $kecurangan->save();
        $kecuranganId = $kecurangan->id;

        

 
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as  $file) {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $randomString = substr(str_shuffle($characters), 0, 50); // Menghasilkan string acak sepanjang 10 karakter
                $foto = time()  . $randomString  . "." . $file->getClientOriginalExtension();
                $file->move(public_path('storage/hukum/bukti_foto'), $foto);
                Buktifoto::insert([
                    'url' => "hukum/bukti_foto/" . $foto,
                    'user_id' => Auth::user()->id,
                    "kecurangan_id" => $kecuranganId
                ]);
            }
        }
        if ($request->hasFile('video')) {
            foreach ($request->file('video') as  $file_video) {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $randomString = substr(str_shuffle($characters), 0, 50); // Menghasilkan string acak sepanjang 10 karakter
                $video = time()  . $randomString  . "." . $file_video->getClientOriginalExtension();
                $file_video->move(public_path('storage/hukum/bukti_vidio'), $video);
                Buktividio::insert([
                    'url' =>  "hukum/bukti_vidio/" . $video,
                    'user_id' => Auth::user()->id,
                    'bukti_vidio' => 0,
                    "kecurangan_id" => $kecuranganId
                ]);
            }
        }

        $video_pernyataan = $request->file('video_pernyataan');
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = substr(str_shuffle($characters), 0, 50); // Menghasilkan string acak sepanjang 10 karakter
        $video = time()  . $randomString  . "." . $video_pernyataan->getClientOriginalExtension();
        $video_pernyataan->move(public_path('storage/hukum/video_pernyataan'), $video);
        VideoPernyataan::insert([
            'video' => "hukum/bukti_pernyataan." . $video,
            'user_id' => Auth::user()->id,
            "kecurangan_id" => $kecuranganId
        ]);


        if ($request['deskripsi'] != null) {
            DB::table('deskripsi_kecurangan')->insert([
                "deskripsi" => $request->deskripsi,
                'user_id' => Auth::user()->id,
                "kecurangan_id" => $kecuranganId
            ]);
        }

        if ($request['curang'] != null) {
            $fromListKecurangan = $request['curang'];
            foreach ($fromListKecurangan as $data) {
                $kecurangan = explode('|', $data)[0];
                $jenis = explode('|', $data)[1];
                Bukti_deskripsi_curang::create([
                    'text' => $kecurangan,
                    'jenis' => $jenis,
                    'user_id' => Auth::user()->id,
                    "kecurangan_id" => $kecuranganId
                ]);
            }
        }




        return redirect()->back()->with('success', "berhasil upload data kecurangan");
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
        if ($cekSaksi == null) {
            return view('developing.c1_plano', $data);
        }
        return redirect()->route('uploadSuratSuara');
    }
    public function c1_quickcount()
    {
        return view('developing.c1_quickcount');
    }
}
