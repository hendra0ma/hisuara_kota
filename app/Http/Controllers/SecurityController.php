<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\Security;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Security as ModelsSecurity;
use App\Models\User;
use App\Models\Village;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class   SecurityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index($id)
    {
        $data['village_id'] = Crypt::decrypt($id);
        $data['config'] = Config::first();
        $checkUser = User::where('role_id', Auth::user()->role_id)->get();
        $id = Crypt::decrypt($id);
        if (Cache::get('some_user' . $id . Auth::user()->role_id . Auth::user()->id) != null) {
            if (Auth::user()->role_id == 2 ||Auth::user()->role_id == 1) {
                return redirect()->route('verifikator.village', Crypt::encrypt($id));
            }
            if (Auth::user()->role_id == 2 ||Auth::user()->role_id == 1) {
                return redirect()->route('auditor.village', Crypt::encrypt($id));
            }
        }
        for ($l = 0; $l < count($checkUser); $l++) {
            if (Cache::get('some_user' . $id . Auth::user()->role_id . $checkUser[$l]->id) != null) {
                if (Cache::get('is_online' . $checkUser[$l]->id) == false) {
                    Cache::forget('some_user' . $id . Auth::user()->role_id . $checkUser[$l]->id);
                }
                return redirect()->back()->with(["error" => "kelurahan yang anda masuki sedang ada user lain"]);
            }
        }

        return view('security.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data['village_id'] = $id;
        $data['config'] = Config::first();
        $cek = ModelsSecurity::where('district_id', Crypt::decrypt($id))->where('security', 2)->where('user_id', Auth::user()->id)->count();

        if ($cek > 0) return redirect()->route('security.login', $id);
        return view('security.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        Validator::make($request->all(), [
            'password' =>  ['required', 'string', 'confirmed'],
        ])->validate();
        $data['config'] = Config::first();
        $user = Auth::user()->id;
        $security_code = new ModelsSecurity;
        $security_code->district_id  = Crypt::decrypt($id);
        $security_code->user_id  = $user;
        $security_code->security = 2;
        $security_code->password = Hash::make($request['password']);
        $security_code->save();
        return redirect()->route('security.login', $id);
    }
    public function loginAction(Request $request, $id)
    {
        $userid = Auth::user()->id;
        $user = ModelsSecurity::where('user_id', $userid)->first();
        $data['config'] = Config::first();
        if (Hash::check($request->password, $user->password)) {
            Session::put('login_session', Auth::user()->id);
            if (Auth::user()->role_id == 2 || Auth::user()->role_id == 1) {
                return redirect()->route('verifikator.village', Crypt::encrypt($id));
            }
            if (Auth::user()->role_id == 3 || Auth::user()->role_id == 1) {
                return redirect()->route('auditor.village', Crypt::encrypt($id));
            }
        } else {
            return redirect()->back()->with('error', 'password yang anda masukan salah');
        }
    }
    public function logoutKelurahan($id)
    {
        $id = Crypt::decrypt($id);
        $data['config'] = Config::first();
        Session::forget('user_exist' . $id);
        Cache::forget('some_user' . $id . Auth::user()->role_id . Auth::user()->id);
        Session::forget('login_session');
        return redirect('redirect');
    }
}
