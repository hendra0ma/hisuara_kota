<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\Configs;
use App\Models\District;
use App\Models\Paslon;
use App\Models\RegenciesDomain;
use App\Models\Regency;
use App\Models\Relawan;
use App\Models\RelawanData;
use App\Models\Saksi;
use App\Models\Tps;
use App\Models\User;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RelawanController extends Controller
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
        $data['tps'] = Tps::get();
        $config =Config::first();
        $data['config'] =$config;
        $data['kota']   = Regency::where('id', $this->config->regencies_id)->first();
        $data['kecamatan']= District::where('regency_id',$this->config->regencies_id)->get();
        return view('publik.relawan',$data);
    }
    
    public function relawanBanding()
    {
        $data['tps'] = Tps::get();
        $config =Config::first();
        $data['config'] = $config;
        $data['kota']   = Regency::where('id', $data['config']->regencies_id)->first();
        $data['kecamatan'] = District::where('regency_id', $this->config->regencies_id)->get();
        return view('publik.relawanBanding',$data);
    }
    public function daftarRelawanBanding(Request $request)
    {
        Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:6'],
            'repassword' => ['required', 'same:password', 'min:6'],
            'no_hp' => ['required', 'numeric'],
            'no_ktp' => ['required', 'numeric'],
            'alamat' => ['required', 'string'],
            'kecamatan' => ['required'],
            'kelurahan' => ['required'],
            'tps' => ['required'],
        ])->validate();

        User::create([
            'name' => $request->nama,
            'address' => $request->alamat,
            'no_hp' => $request->no_hp,
            'nik' => $request->no_ktp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'districts' => $request->kecamatan,
            'villages' => $request->kelurahan,
            'role_id' => 15,
            'is_active' => 1,
            'tps_id' => $request->tps,
            'cek'=>1,
            // 'print'=>0,
        ]);
        return redirect('login')->with(['success' => "Berhasil Membuat akun Relawan Banding, Silahkan login untuk memasukan data C1 anda"]);
    }
    public function daftarRelawan(Request $request)
    {
        Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required','min:6'],
            'repassword' => ['required','same:password', 'min:6'],
            'no_hp' => ['required','numeric'],
            'no_ktp' => ['required','numeric'],
            'alamat' => ['required', 'string'],
            'kecamatan' => ['required'],
            'kelurahan' => ['required'],
            'tps' => ['required'],
        ])->validate();

        User::create([
            'name'=>$request->nama,
            'address'=>$request->alamat,
            'no_hp'=>$request->no_hp,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'districts'=>$request->kecamatan,
            'villages'=>$request->kelurahan,
            'nik' => $request->no_ktp,
            'role_id'=>14,
            'is_active'=>1,
            'tps_id'=>$request->tps,
            'cek' => 1,
            // 'print' => 0,
        ]);
        return redirect('login')->with(['success'=>"Berhasil Membuat akun Relawan , Silahkan login untuk memasukan data C1 anda"]);
        
    }
    public function getKel(Request $req)
    {
       $villages = Village::where('district_id',$req->id)->get();
       foreach($villages as $vil){
           echo "
           <option value='$vil->id'>
            $vil->name
           </option>
           ";
       }
    }
    public function uploadC1Banding(Request $request)
    {
        Validator::make($request->all(), [
            'c1_images' => 'required|mimes:png,jpg|max:2048',
        ]);
        
        $config = Config::first();
        $user  = Auth::user();
        if ($files = $request->file('c1_images')) {
            $file =  $request->file->store('storage/c1_plano');
        }else{
            return redirect()->back()->with(['error'=>'error saat mengupload file']);
        }
        $upload_relawan = new Relawan;
        $upload_relawan->c1_images = $file;
        $upload_relawan->regency_id = $this->config->regencies_id;
        $upload_relawan->district_id = $user->districts;
        $upload_relawan->village_id = $user->villages;
        $upload_relawan->tps_id = $user->tps_id;
        $upload_relawan->status = 0;
        $upload_relawan->relawan_id = $user->id;
        $upload_relawan->jenis = 'banding';
        $upload_relawan->save();
        return redirect()->back()->with(['success' => 'berhasil saat upload c1 relawan']);
    }
    public function c1relawan()
    {
        $data['paslon'] = Paslon::get();
        $data['data_relawan']  = Relawan::where('relawan_id',Auth::user()->id)->first();
        
        return view('publik.relawan.uploadc1relawan',$data);
    }
    public function c1banding()
    {
        return view('publik.relawan.uploadc1banding');
    }
    public function uploadC1Relawan(Request $request)
    {
        Validator::make($request->all(), [
            'c1_images' => 'required|mimes:png,jpg|max:2048',
            'suara.*' => 'required',
        ]);  
        
        $config = Config::first();
        $user  = Auth::user();

        $paslon = Paslon::select('id')->get();
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if ($files = $request->file('c1_images')) {

            // $file =  $request->file('c1_images')->store('storage/c1_plano');
            // $namafile =  $request->file('c1_images')->getClientOriginalName();

            $image = $request->file('c1_images');
            $randomString = substr(str_shuffle($characters), 0, 40); // Menghasilkan string acak sepanjang 10 karakter
            $namafile = time() . $randomString  .".".  $image->getClientOriginalExtension();
            $image->move(public_path('storage/c1_plano'), $namafile);




        }else{
            return redirect()->back()->with(['error'=>'error saat mengupload file']);
        }
        // $regency = Regency::where('id',Auth::user()->district_id)->first();

        $upload_relawan = new Relawan;
        $upload_relawan->c1_images = $namafile;
        $upload_relawan->regency_id = $this->config->regencies_id;

        $upload_relawan->district_id = $user->districts;
        $upload_relawan->province_id = $user->province_id;
        $upload_relawan->village_id = $user->villages;
        $upload_relawan->tps_id = $user->tps_id;
        $upload_relawan->status = 1;
        $upload_relawan->relawan_id = $user->id;
        // $upload_relawan->jenis = 'relawan';
        $upload_relawan->save();
        $id = $upload_relawan->id;

        $i = 0;
        foreach ($paslon as $pas) {
            $relawan_data = new RelawanData;
            $relawan_data->relawan_id = $id;
            $relawan_data->c1_relawan_id = $id;
            $relawan_data->village_id = $user->villages;
            $relawan_data->paslon_id = $pas->id;
            $relawan_data->regency_id = $this->config->regencies_id;
            $relawan_data->district_id = $user->districts;
            $relawan_data->province_id = $user->province_id;
            $relawan_data->voice = $request->suara[$i];
            $relawan_data->save();
            $i++;
        }

        return redirect()->back()->with(['success' => 'berhasil saat upload c1 relawan']);
    }
    public function getTps(Request $req)
    {
        // $tps = Tps::where('villages_id', $req->id)->get();
        // foreach ($tps as $vil) {
        //     $saksi = Saksi::where("tps_id",$vil->id)->first();
        //     if ($saksi == null) {
        //         echo "
        //        <option value='$vil->id'>
        //        TPS $vil->number
        //        </option>
        //        ";
        //     }
        // }  


        $tps = Tps::where('villages_id',$req->id)->get();
        
        foreach ($tps as $key => $item) {
            $user = User::where('tps_id',$item['id'])->first();
            if ($user !=null) {
                // Menghapus elemen dari $data jika villages_id adalah '3674010001'
                
                // unset($tps[$key]);
                continue;
            }
                echo "
                <option value='$item->id'>
                TPS $item->number
                </option>
                ";
            
        }

    }
}