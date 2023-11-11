<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Saksi;
use App\Models\Tps;
use App\Models\User;
use App\Models\Village;
use App\Models\Config;
use App\Models\Koreksi;
use App\Models\SaksiData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class HumanVerificationController extends Controller
{
    public function index()
    {
         $data['config'] = Config::first();

        $data['saksi_data'] = User::where('role_id', '=', 8)->get();
        return view('administrator.verifikasi.verifikasi_saksi', $data);
    }

    public function verifikasi_akun()
    {
         $data['config'] = Config::first();

        $data['admin_data'] = User::where('role_id', '!=', 8)->get();
        $data['config'] = Config::first();
        return view('administrator.verifikasi.verifikasi_akun', $data);
    }

    public function verifikasi_saksi()
    {
        $data['config'] = Config::first();
        $data['saksi_data'] = User::where('role_id', '=', 8)->get();
        return view('administrator.verifikasi.verifikasi_saksi', $data);
    }

    public function action_setujui(Request $request, $id)
    {
        $data['config'] = Config::first();
        $koreksi = Koreksi::where('saksi_id', Crypt::decrypt($id))->get();
        foreach ($koreksi as $psl) {
            SaksiData::where('saksi_id', Crypt::decrypt($id))->where('paslon_id', $psl['paslon_id'])->update([
                'voice' => $psl['voice'],
            ]);
            Koreksi::where('saksi_id', Crypt::decrypt($id))->where('paslon_id', $psl['paslon_id'])->update([
                'status' => 'selesai',
            ]);
        }
           Saksi::where('id',Crypt::decrypt($id))->update([
               'verification' => 1
            ]);
        return redirect('administrator/verifikasi_koreksi');
    }

    public function tolak_koreksi(Request $request, $id)
    {
        $data['config'] = Config::first();
        $koreksi = Koreksi::where('saksi_id', Crypt::decrypt($id))->get();
        foreach ($koreksi as $psl) {
            Koreksi::where('saksi_id', Crypt::decrypt($id))->where('paslon_id', $psl['paslon_id'])->update([
                'status' => 'ditolak',
            ]);
        }
        return redirect('administrator/verifikasi_koreksi');
    }

 public function get_koreksi_saksi(Request $request)
    {
        $data['config'] = Config::first();
        $data['saksi']  =  Saksi::where('id', $request['id'])->first();
        $data['saksi_data'] = SaksiData::where('saksi_id', $request['id'])->get();
        // $data['saksi_data_baru'] = Koreksi::where('saksi_id', $request['id'])->get();
        // $data['saksi_data_baru_deskripsi'] = Koreksi::where('saksi_id', $request['id'])->first();
        $data['admin_req'] = User::where('id', $data['saksi']['kecurangan_id_users'])->first();
        $data['saksi_koreksi'] = User::where('tps_id', $data['saksi']['tps_id'])->first();
        $data['kelurahan'] = Village::where('id', $data['saksi']['village_id'])->first();
        $data['kecamatan'] = District::where('id', $data['saksi']['district_id'])->first();
        $data['tps'] = Tps::where('id', $data['saksi']['tps_id'])->first();
        // return $data['saksi'];
        return view('administrator.ajax.get_koreksi_saksi', $data);
    }

    
    public function verifikasi_koreksi()
    {
        $data['config'] = Config::first();
        $data['saksi_data'] = Saksi::join('users', 'users.tps_id', '=', 'saksi.tps_id')->where('koreksi', 1)->get();
        return view('administrator.verifikasi.verifikasi_koreksi', $data);

    }
      
    public function get_verifikasi_akun(Request $request)
    {
        $user        = User::where('id',$request['id'])->first();
        $district    = District::where('id',$user['districts'])->first();
        $village     = Village::where('id',$user['villages'])->first();
        $tps     = Tps::where('user_id',$user['id'])->first();
        return view('administrator.ajax.get_verifikasi_akun',[
            'user' => $user,
            'district' => $district,
        ]);
    }

    public function get_verifikasi_saksi(Request $request)
    {
        $user        = User::where('id',$request['id'])->first();
        $district    = District::where('id',$user['districts'])->first();
        $village     = Village::where('id',$user['villages'])->first();
        $tps         = Tps::where('user_id',$user['id'])->first();
        $saksi       = Saksi::where('tps_id',$tps['id'])->first();
        return view('administrator.ajax.get_verifikasi_saksi',[
            'user' => $user,
            'village' => $village,
            'district' => $district,
            'tps' => $tps,
            'saksi' => $saksi,
        ]);
        

    }

    public function action_verifikasi(Request $request,$id)
    {
        $user = User::where('id',decrypt($id))->update([
            'is_active' => decrypt($request['aksi']),
        ]);
        $role = User::where('id',decrypt($id))->first();
        if($role['role_id'] == 8){
            return redirect('huver/verifikasi_saksi');
        }else{
            return redirect('huver/verifikasi_akun');
        }
    }

}
