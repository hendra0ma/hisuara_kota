<?php

namespace App\Http\Controllers;

use App\Models\Acakey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\District;
use App\Models\RegenciesDomain;
use App\Models\Tracking;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(Request $request)
    {

        
 
        $result = $this->validate(
            $request,
            ['geetest_challenge' => 'geetest',],
            ['geetest' => config('geetest.server_fail_alert')]
        );
        if ($request) {
            $result = $this->validate(
                $request,
                ['geetest_challenge' => 'geetest',],
                ['geetest' => config('geetest.server_fail_alert')]
            );

            $currentDomain = request()->getHttpHost();
            if (isset(parse_url($currentDomain)['port'])) {
                $url = substr($currentDomain, 0, strpos($currentDomain, ':8000'));
            }else{
                $url = $currentDomain;
            }

            if ($url != "hisuara.id") {
                return redirect('/redirect-page');
            }

            if ($request) {
                if(Auth::check()){
                $role = Auth::user()->role_id;
                // return gettype($role)." > ".$role;

                if ($role == "1") {
                    return redirect('dashboard-pusats');
                }else{
                    $regency_id = Auth::user()->regency_id;
                    $regency_domain = RegenciesDomain::where('regency_id',$regency_id)->first();
             
                    return redirect(env("HTTP_SSL","").$regency_domain->domain.env("HTTP_PORT","")."/redirect-page");
                }
                }else{
                    return redirect('login');
                }
            
        }
        }
    }
    public function createAdmin()
    {
        return view('auth.registerAdmin');
    }

    
    public function storeAdmin(Request $request)
    {
        if ($request->cek_koor == "yes") {   
                $this->insertKoordinator($request);
               return redirect()->route('login')->with('success','Anda berhasil membuat akun Koordinator');
           
        }

       Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'alamat' => ['required','string'],
            'role_id' => ['required'],
            'no_hp' => ['required','string','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' =>  ['required', 'string', 'confirmed'],
            'nik' => ['required','numeric'],
          
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();



        if (!$request->file('foto_ktp')) {
            return redirect()->back()->with('error','foto ktp wajib di isi');
          }
          if (!$request->file('foto_profil')) {
            return redirect()->back()->with('error','foto profil wajib di isi');
          }

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        // if ($validator->fails()) {
        //     return redirect()
        //         ->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }
        

        if ($request->file('foto_ktp')) {
            $image = $request->file('foto_ktp');
            $randomString = substr(str_shuffle($characters), 0, 50); // Menghasilkan string acak sepanjang 10 karakter
            $foto_ktp = time() . $randomString  .".".  $image->getClientOriginalExtension();
            $image->move(public_path('storage/profile-photos'), $foto_ktp);
        } else {
            return response()->json(['message' => 'Gagal mengunggah gambar'], 500);
        }

        if ($request->file('foto_profil')) {
            $image = $request->file('foto_profil');
            $randomString = substr(str_shuffle($characters), 0, 50); // Menghasilkan string acak sepanjang 10 karakter
            $foto_profil = time() . $randomString  .".".  $image->getClientOriginalExtension();
            $image->move(public_path('storage/profile-photos'), $foto_profil);
        } else {
            return response()->json(['message' => 'Gagal mengunggah gambar'], 500);
        }
        $role = explode('|',$request->input('role_id'));
        $user = new User();
        $user->name = $request->input('name');
        $user->address = $request->input('address');
        $user->no_hp = $request->input('no_hp');
        $user->province_id = $request->input('provinsi');
        
        if ($role[0] == "tps") {
            $user->districts = $request->input('kecamatan');
            $user->villages = $request->input('kelurahan');
            $user->regency_id = $request->input('kota');
            $user->tps_id = $request->input('tps');
        }else{
            $user->regency_id = $request->input('kota');
        }

        

        $user->role_id = $role[1];
        if ((string) $role[1] == (string)14) {
            $user->is_active = "1";
        }else{
            $user->is_active = "0" ;
        }
        $user->email = $request->input('email');
        $user->address = $request->input('alamat');
        $user->password = bcrypt($request->input('password'));
        $user->cek = "0";
        $user->absen = "";
        $user->nik = $request->input('nik');
        $user->profile_photo_path = $foto_profil;
        $user->foto_ktp = $foto_ktp;
        $user->save();
        return redirect()->route('login');
    }
    private function insertKoordinator(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'alamat' => ['required','string'],
            'role_id' => ['required'],
            'no_hp' => ['required','string','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' =>  ['required', 'string', 'confirmed'],
            'nik' => ['required','numeric'],
            
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();
        if ($request->koor_id == "") {
            return redirect()->back()->with('error','Jenis Koordinator wajib di isi');
        }

        if (!$request->file('foto_ktp')) {
            return redirect()->back()->with('error','foto ktp wajib di isi');
          }
          if (!$request->file('foto_profil')) {
            return redirect()->back()->with('error','foto profil wajib di isi');
          }

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        
        $role = explode('|',$request->input('role_id'));
        $user = new User();
        $user->name = $request->input('name');
        $user->address = $request->input('address');
        $user->no_hp = $request->input('no_hp');
        $user->province_id = $request->input('provinsi');
        $user->koor_id = $request->input('koor_id');
        
        if ((string) $request->koor_id == "1") {
            $user->regency_id = $request->input('kota');
        }elseif((string) $request->koor_id == "2") {
            $user->regency_id = $request->input('kota');
            $user->districts = $request->input('kecamatan');
        }elseif((string) $request->koor_id == "3") {
            $user->regency_id = $request->input('kota');
            $user->districts = $request->input('kecamatan');
            $user->villages = $request->input('kelurahan');
        }elseif((string) $request->koor_id == "4") {
            $user->regency_id = $request->input('kota');
            $user->districts = $request->input('kecamatan');
            $user->villages = $request->input('kelurahan');
            $user->villages = $request->input('rw');
        }elseif((string) $request->koor_id == "5") {
            $user->regency_id = $request->input('kota');
            $user->districts = $request->input('kecamatan');
            $user->villages = $request->input('kelurahan');
            $user->villages = $request->input('rw');
            $user->villages = $request->input('rt');
        }else{

        }
        if ($request->file('foto_ktp')) {
            $image = $request->file('foto_ktp');
            $randomString = substr(str_shuffle($characters), 0, 50); // Menghasilkan string acak sepanjang 10 karakter
            $foto_ktp = time() . $randomString  .".".  $image->getClientOriginalExtension();
            $image->move(public_path('storage/profile-photos'), $foto_ktp);
        } else {
            return response()->json(['message' => 'Gagal mengunggah gambar'], 500);
        }

        if ($request->file('foto_profil')) {
            $image = $request->file('foto_profil');
            $randomString = substr(str_shuffle($characters), 0, 50); // Menghasilkan string acak sepanjang 10 karakter
            $foto_profil = time() . $randomString  .".".  $image->getClientOriginalExtension();
            $image->move(public_path('storage/profile-photos'), $foto_profil);
        } else {
            return response()->json(['message' => 'Gagal mengunggah gambar'], 500);
        }
        $user->role_id = $role[1];
        $user->is_active = "0";
        $user->email = $request->input('email');
        $user->address = $request->input('alamat');
        $user->password = bcrypt($request->input('password'));
        $user->cek = "0";
        $user->absen = "";
        $user->nik = $request->input('nik');
        $user->profile_photo_path = $foto_profil;
        $user->foto_ktp = $foto_ktp;
        $user->save();

    }




    public function track_rec(Request $request)
    {
        $user = Auth::user()->id;
        $tracking = Tracking::where('id_user', $user)->first();

        if ($tracking) {
            $trac = Tracking::find($tracking['id']);
            $trac->delete();
        }
        $track = new Tracking;
        $track->longitude = $request['long'];
        $track->latitude = $request['lat'];
        $track->ip_address = $request->ip();
        $track->id_user = $user;
        $track->save();
    }

    function getKoordinator(Request $request)
    {
        $koor =  DB::table('koordinator')->where('id',$request->id)->first();
        $koor_id = explode(',',$koor->have_kor);
        $data['koorId'] = $koor;
        $data['koordinator'] = DB::table('koordinator')->whereNotIn('id',$koor_id)->get();
        return view('publik.ajax.ajax_koordinator',$data);
    }

 

}