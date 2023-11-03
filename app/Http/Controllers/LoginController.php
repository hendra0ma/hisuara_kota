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
                    $regency_id = substr(Auth::user()->districts,0,4);
                    $regency_domain = RegenciesDomain::where('regency_id',$regency_id)->first();
             
                    return redirect(env("HTTP_SSL","").$regency_domain->domain.env("HTTP_PORT","")."/redirect-page");
                }
                }else{
                    return redirect('login');
                }
                // return "halo";
            
        }
        }
    }
    public function createAdmin()
    {
        return view('auth.registerAdmin', [
            'kec' => District::where('regency_id', 3674)->get()
        ]);
    }
    public function storeAdmin(Request $req)
    {
        Validator::make($req->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' =>  ['required', 'string', 'confirmed'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();
        User::create([
            'nik' => $req['nik'],
            'name' => $req['name'],
            'address'  => $req['alamat'],
            'role_id' => Crypt::decryptString($req['role_id']),
            'is_active' => '1',
            'no_hp'  => $req['no_hp'],
            'districts'  =>  $req['kecamatan'],
            'email' => $req['email'],
            'password' => Hash::make($req['password']),
            'cek' => 0,
        ]);
        return redirect()->route('login');
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
}
