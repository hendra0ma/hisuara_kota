<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|numeric|max:255',
            'email' => 'required|string|email|max:255',
            'nik' => 'required|numeric',
            'no_hp' => 'required|numeric',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $cek_email = User::where('email',$request->email)->first();
        $cek_nik = User::where('nik',$request->nik)->first();
        $cek_no_hp = User::where('no_hp',$request->no_hp)->first();
        if($cek_email !=null && $cek_nik!=null){

        }
    }
    public function registerPusat(Request $request)
    {
       $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'address' => 'required|string',
            'no_hp' => 'required|string|unique:users',
            'districts' => 'required|string',
            'villages' => 'required|string',
            'role_id' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
            'tps_id' => 'required|string|unique:users',
            'cek' => 'required|string',
            'absen' => 'required|string',
            'nik' => 'required|string',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg,gif', 
            'foto_profil' => 'required|image|mimes:jpeg,png,jpg,gif', 
        ]);     
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
     

        if ($request->file('foto_ktp')) {
            $image = $request->file('foto_ktp');
            $randomString = substr(str_shuffle($characters), 0, 13); // Menghasilkan string acak sepanjang 10 karakter
            $foto_ktp = time() . $randomString .".". $image->getClientOriginalExtension();
            $image->move(public_path('storage/profile-photos'), $foto_ktp);
        } else {
            return response()->json(['message' => 'Gagal mengunggah gambar'], 500);
        }

        if ($request->file('foto_profil')) {
            $image = $request->file('foto_profil');
            $randomString = substr(str_shuffle($characters), 0, 14); // Menghasilkan string acak sepanjang 10 karakter
            $foto_profil = time() . $randomString  .".".  $image->getClientOriginalExtension();
            $image->move(public_path('storage/profile-photos'), $foto_profil);
        } else {
            return response()->json(['message' => 'Gagal mengunggah gambar'], 500);
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->address = $request->input('address');
        $user->no_hp = $request->input('no_hp');
        $user->districts = $request->input('districts');
        $user->villages = $request->input('villages');
        $user->role_id = $request->input('role_id');
        $user->is_active = "0"  ;
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->tps_id = $request->input('tps_id');
        $user->cek = $request->input('cek');
        $user->absen = $request->input('absen');
        $user->profile_photo_path = $foto_profil;
        $user->foto_ktp = $foto_ktp;

        $user->nik = $request->input('nik');
        $user->save();
        return response()->json(['message' => 'Anda Berhasil Daftar'], 201);
        
    }

    function testUpload(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ]);
        if ($request->file('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/profile-photos'), $imageName);

            return response()->json(['message' => 'Gambar berhasil diunggah', 'url' => 'storage/profile-photos/' . $imageName], 200);
        } else {
            return response()->json(['message' => 'Gagal mengunggah gambar'], 500);
        }
    }


    public function registerPusatAdmin(Request $request)
    {
        // return response()->json(['message' => 'asdfasfsa'], 201);
       $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'address' => 'required|string',
            'no_hp' => 'required|string|unique:users',
            // 'districts' => 'required|string',
            // 'villages' => 'required|string',
            'role_id' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
            // 'tps_id' => 'required|string|unique:users',
            'cek' => 'required|string',
            'absen' => 'required|string',
            'nik' => 'required|string',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg,gif', 
            'foto_profil' => 'required|image|mimes:jpeg,png,jpg,gif', 
        ]);
      
        //UnComment Kode iini setelah pencobaan

        // $users = User::where('role_id', $request->input('role_id'))->count();
        // if ($users > 10) {
        //     return response()->json(['errors' => ["error"=>"Tidak dapat mendaftar, karena admin Telah mencapai 10 admin"]], 422);
        // }

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->file('foto_ktp')) {
            $image = $request->file('foto_ktp');
            $randomString = substr(str_shuffle($characters), 0, 13); // Menghasilkan string acak sepanjang 10 karakter
            $foto_profil = time() . $randomString  .".".  $image->getClientOriginalExtension();
            $image->move(public_path('storage/profile-photos'), $foto_profil);
        } else {
            return response()->json(['message' => 'Gagal mengunggah gambar'], 500);
        }

        if ($request->file('foto_profil')) {
            $image = $request->file('foto_profil');
            $randomString = substr(str_shuffle($characters), 0, 13); // Menghasilkan string acak sepanjang 10 karakter
            $foto_profil = time() . $randomString  .".".  $image->getClientOriginalExtension();
            $image->move(public_path('storage/profile-photos'), $foto_profil);
        } else {
            return response()->json(['message' => 'Gagal mengunggah gambar'], 500);
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->address = $request->input('address');
        $user->no_hp = $request->input('no_hp');
        $user->districts = "null";
        // $user->villages = $request->input('villages');
        $user->role_id = $request->input('role_id');
        $user->is_active = "1"  ;
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        // $user->tps_id = $request->input('tps_id');
        $user->cek = $request->input('cek');
        $user->absen = $request->input('absen');
        $user->nik = $request->input('nik');
        $user->save();
        return response()->json(['message' => 'User created successfully'], 201);
        
    }



    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['message' => 'Hi ' . $user->name . ', welcome to home', 'access_token' => $token, 'token_type' => 'Bearer',]);
    }
    public function loginCek(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()
                ->json(['message' => 'gagal'], 401);
        }

         return response()
       ->json(['message' => 'berhasil'], 200);
    }




    
    // method for user logout and delete token
    public function logout()
    {
        auth('sanctum')->user()->tokens()->delete();
        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }
    function accessLoginToken(Request $request){
       $token = PersonalAccessToken::findToken($request->token);
       if (!$token) {
        return response()->json(['message'=>"data kosong"],401);
       }
       $user = User::where("id",$token->tokenable_id)->first();

       if (!$user) {
           return response()->json( ['messages'=>"user tidak terdaftar"],401);
        }
        auth()->user()->tokens()->delete();
    }

    
}
