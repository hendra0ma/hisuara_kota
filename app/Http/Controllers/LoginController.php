<?php

namespace App\Http\Controllers;

use App\Models\Acakey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\District;
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

            if ($request) {
                if(Auth::check()){
                $role = Auth::user()->role;
                return view('auth.redirect', [
                    'role_id' => $role,
                ]);
                }else{
                    return redirect('login');
                }
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
