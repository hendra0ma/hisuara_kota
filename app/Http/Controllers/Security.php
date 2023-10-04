<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\Link;
use App\Models\District;
use App\Models\Security as ModelsSecurity;
use App\Models\Village;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class Security extends Controller
{
    public function key_kecamatan(Request $req, $id,$role)
    {
        $user = Auth::user()->id;
        $data['config'] = Config::first();
        $cek_password = ModelsSecurity::where('user_id', $user)->where('security', decrypt($role))->first();
        $kecamatan = District::where('id', decrypt($id))->first();
        if ($cek_password == NULL) {
            return view('administrator.security.generate_key_kecamatan', [
                'kecamatan' => $kecamatan,
                'role' => $role,
                'judul'=>$req->title,
                'config' =>  Config::first(),
            ]);
        } else {
            return view('administrator.security.key_kecamatan', [
                'kecamatan' => $kecamatan,
                'role' => $role,
                'config' =>  Config::first(),
                'judul'=>$req->title
                
            ]);
        }
    }

    public function generate_action_security(Request $request, $id,$role)
    {
        Validator::make($request->all(), [
            'password' =>  ['required', 'string', 'confirmed'],
        ])->validate();
        $user = Auth::user()->id;
        $security_code = new ModelsSecurity;
        $security_code->district_id  = decrypt($id);
        $security_code->user_id  = $user;
        $security_code->security = decrypt($role);
        $security_code->password = Hash::make($request['password']);
        $security_code->save();

        return redirect('/key_kecamatan/' . $id. '/'.$role)->with(['success' => 'Masukan Password Yang Sudah Di Buat']);
    }

    public function action_security_get(Request $request, $id,$role)
    {
        $userid = Auth::user()->id;
        $user   = ModelsSecurity::where('user_id', $userid)->first();
        // dd(decrypt($role));
        $role_link   = Link::where('id',decrypt($role))->first();
        if (Hash::check($request['password'], $user->password)) {
            $request->session()->put('session_kecamatan', $id);
            return redirect($role_link->url . $id);
        } else {
            $request->session()->forget('session_kecamatan');
            return redirect('/key_kecamatan/' . $id.'/'.$role)->with(['error' => 'Password Salah']);
        }
    }

    public function key_kelurahan(Request $req, $id)
    {
        $user = Auth::user()->id;
        $cek_password = ModelsSecurity::where('user_id', $user)->where('security', 2)->first();
        $kelurahan = Village::where('id', decrypt($id))->first();
        if ($cek_password == NULL) {
            return view('administrator.security.generate_key_kelurahan', [
                'kelurahan' => $kelurahan,
                'config' =>  Config::first(),
                'judul'=>$req->title
                
            ]);
        } else {
            return view('administrator.security.key_kelurahan', [
                'kelurahan' => $kelurahan,
                'config' =>  Config::first(),
                'judul'=>$req->titl
            ]);
        }
    }

    public function action_generate_security_kelurahan(Request $request, $id)
    {
        Validator::make($request->all(), [
            'password' =>  ['required', 'string', 'confirmed'],
        ])->validate();
        $user = Auth::user()->id;
        $security_code = new ModelsSecurity;
        $security_code->district_id  = decrypt($id);
        $security_code->user_id  = $user;
        $security_code->security = 2;
        $security_code->password = Hash::make($request['password']);
        $security_code->save();
        return redirect('/key_kelurahan/' . $id)->with(['success' => 'Masukan Password Yang Sudah Di Buat']);
    }

    public function action_get_security_kelurahan(Request $request, $id,$role)
    {
        $userid = Auth::user()->id;
        $user = ModelsSecurity::where('user_id', $userid)->first();
        if (Hash::check($request['password'], $user->password)) {
            $request->session()->put('session_kelurahan', $id);
            return redirect('/administrator/kelurahan/' . $id);
        } else {
            $request->session()->forget('session_kelurahan');
            return redirect('/key_kelurahan/' . $id)->with(['error' => 'Password Salah']);
        }
    }

    public function v2l_security(Request $req,$role)
    
    {
        $user = Auth::user()->id;
        $cek_password = ModelsSecurity::where('user_id', $user)->where('security', decrypt($role))->first();
        
        if ($cek_password == NULL) {
            return view('administrator.security.generate_key_v2l', [
                'role' => $role,
                'config' =>  Config::first(),
                'judul'=>$req->title
            ]);
        } else {
            return view('administrator.security.key_v2l', [
                'role' => $role,
                'config' =>  Config::first(),
                'judul'=>$req->title
            ]);
        }
    }

    public function action_security_v2l(Request $request,$role)
    {
        Validator::make($request->all(), [
            'password' =>  ['required', 'string', 'confirmed'],
        ])->validate();
        $user = Auth::user()->id;
        $security_code = new ModelsSecurity;
        $security_code->district_id  = 12;
        $security_code->user_id  = $user;
        $security_code->security = decrypt($role);
        $security_code->password = Hash::make($request['password']);
        $security_code->save();

        return redirect('/v2l_security/'.$role)->with(['success' => 'Masukan Password Yang Sudah Di Buat']);

    }

    public function action_v2l_security(Request $request,$role)
    {
        $userid = Auth::user()->id;
        $user   = ModelsSecurity::where('user_id', $userid)->first();
        $role_link   = Link::where('id',decrypt($role))->first();
        if (Hash::check($request['password'], $user->password)) {
            return redirect($role_link->url);
        } else {
            $request->session()->forget('session_kecamatan');
            return redirect('/v2l_security/'.$role)->with(['error' => 'Password Salah']);
        }
    }
}
