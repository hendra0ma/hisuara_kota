<?php

namespace App\Http\Controllers;

use App\Events\CountEvent;
use App\Models\Bukti_deskripsi_curang;
use App\Models\Bukticatatan;
use App\Models\Buktifoto as ModelsBuktifoto;
use App\Models\Buktividio as ModelsBuktividio;
use App\Models\Databukti;
use App\Models\District;
use App\Models\Listkecurangan as ModelsListkecurangan;
use App\Models\Qrcode as ModelsQrcode;
use App\Models\Qrcode;
use App\Models\Regency;
use App\Models\Saksi;
use App\Models\Tps;
use App\Models\User;
use App\Models\Village;
use BuktiDeskirpsiCurang;
use BuktiFoto;
use BuktiVidio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use ListKecurangan;
use Svg\Tag\Rect;


class BalwasluController extends Controller
{
    public function index()
    {
        $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
        ->join('users', 'users.tps_id', '=', 'tps.id')
        ->where('saksi.kecurangan', 'yes')
        ->where('saksi.status_kecurangan', 'terverifikasi')
        ->orWhere('saksi.status_kecurangan', 'diproses')
        ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
        ->get();
        $data['terverifikasi'] = Saksi::where('kecurangan','yes')->where('status_kecurangan','terverifikasi')->get();
        $data['ditolak'] = Saksi::where('kecurangan','yes')->where('status_kecurangan','ditolak')->get();
        $data['data_masuk'] = Saksi::where('kecurangan','yes')->get();
        return view('balwaslu.terverifikasi',$data);
        

    }

    // public function terverifikasi()
    // {
    //     $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
    //     ->join('users', 'users.tps_id', '=', 'tps.id')
    //     ->where('saksi.kecurangan', 'yes')
    //     ->where('saksi.status_kecurangan', 'terverifikasi')
    //     ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
    //     ->get();
    //     $data['terverifikasi'] = Saksi::where('kecurangan','yes')->where('status_kecurangan','terverifikasi')->get();
    //     $data['ditolak'] = Saksi::where('kecurangan','yes')->where('status_kecurangan','ditolak')->get();
    //     $data['data_masuk'] = Saksi::where('kecurangan','yes')->get();
    //     return view('balwaslu.terverifikasi', $data);
    // }

    // public function ditolak()
    // {
    //     $data['list_suara']  = Tps::join('saksi', 'saksi.tps_id', '=', 'tps.id')
    //     ->join('users', 'users.tps_id', '=', 'tps.id')
    //     ->where('saksi.kecurangan', 'yes')
    //     ->where('saksi.status_kecurangan', 'ditolak')
    //     ->select('saksi.*', 'saksi.created_at as date', 'tps.*', 'users.*')
    //     ->get();
    //     $data['terverifikasi'] = Saksi::where('kecurangan','yes')->where('status_kecurangan','terverifikasi')->get();
    //     $data['ditolak'] = Saksi::where('kecurangan','yes')->where('status_kecurangan','ditolak')->get();
    //     $data['data_masuk'] = Saksi::where('kecurangan','yes')->get();
    //     return view('balwaslu.ditolak', $data);
    // }

    // public function indextsm()
    // {
    //     $data['index_tsm']    = ModelsListkecurangan::get();
    //     $data['terverifikasi'] = Saksi::where('kecurangan','yes')->where('status_kecurangan','terverifikasi')->get();
    //     $data['ditolak'] = Saksi::where('kecurangan','yes')->where('status_kecurangan','ditolak')->get();
    //     $data['data_masuk'] = Saksi::where('kecurangan','yes')->get();
    //     return view('balwaslu.index_tsm', $data);
    // }



    ///// Ajax Hukum
    public function get_foto_kecurangan(Request $request)
    {
       $data['foto_kecurangan'] = ModelsBuktifoto::where('tps_id', $request['id'])->get();
        $data['vidio_kecurangan'] = ModelsBuktividio::where('tps_id', $request['id'])->first();
        $data['list_kecurangan']     = Bukti_deskripsi_curang::where('tps_id', $request['id'])->get();
        $data['pelanggaran_umum']    = ModelsListkecurangan::where('jenis', 0)->get();
        $data['pelanggaran_petugas'] = ModelsListkecurangan::where('jenis', 1)->get();
        $data['tps'] = Tps::where('id',$request['id'])->first();
        $data['kecamatan'] = District::where('id', $data['tps']['district_id'])->first();
        $data['bukti_vidio'] = ModelsBuktividio::where('tps_id',$request['id'])->get();
        $data['bukti_foto'] = ModelsBuktifoto::where('tps_id',$request['id'])->get();
        $data['saksi'] = Saksi::where('tps_id',$request['id'])->first();
        return view('balwaslu.ajax.fotokecurangan', $data);
    }

    public function get_fotoKecuranganterverifikasi(Request $request)
    {
        $data['foto_kecurangan'] = ModelsBuktifoto::where('tps_id', $request['id'])->get();
        $data['vidio_kecurangan'] = ModelsBuktividio::where('tps_id', $request['id'])->first();
        $data['list_kecurangan']     = Bukti_deskripsi_curang::where('tps_id', $request['id'])->get();
        $data['pelanggaran_umum']    = ModelsListkecurangan::where('jenis', 0)->get();
        $data['pelanggaran_petugas'] = ModelsListkecurangan::where('jenis', 1)->get();
        $data['tps'] = Tps::where('id',$request['id'])->first();
        $data['kecamatan'] = District::where('id', $data['tps']['district_id'])->first();
        $data['bukti_vidio'] = ModelsBuktividio::where('tps_id',$request['id'])->get();
        $data['bukti_foto'] = ModelsBuktifoto::where('tps_id',$request['id'])->get();
        $data['saksi'] = Saksi::where('tps_id',$request['id'])->first();
        return view('balwaslu.ajax.fotoKecuranganterverifikasi',$data);
    }

    public function get_fotoKecuranganditolak(Request $request)
    {
        $data['foto_kecurangan'] = ModelsBuktifoto::where('tps_id', $request['id'])->get();
        $data['vidio_kecurangan'] = ModelsBuktividio::where('tps_id', $request['id'])->first();
        $data['list_kecurangan']     = Bukti_deskripsi_curang::where('tps_id', $request['id'])->get();
        $data['pelanggaran_umum']    = ModelsListkecurangan::where('jenis', 0)->get();
        $data['pelanggaran_petugas'] = ModelsListkecurangan::where('jenis', 1)->get();
        $data['tps'] = Tps::where('id',$request['id'])->first();
        $data['kecamatan'] = District::where('id', $data['tps']['district_id'])->first();
        $data['bukti_vidio'] = ModelsBuktividio::where('tps_id',$request['id'])->get();
        $data['bukti_foto'] = ModelsBuktifoto::where('tps_id',$request['id'])->get();
        $data['saksi'] = Saksi::where('tps_id',$request['id'])->first();
        return view('balwaslu.ajax.fotoKecuranganditolak',$data);
    }

    public function verifikasi_kecurangan(Request $request)
    {
       $data['tps'] = Tps::where('id',Crypt::decrypt($request['id']))->first();
    //    return view('balwaslu.print.kecurangan',$data);
        var_dump($request['id']);
    }
  
    //// Action Hukum
    public function proses_kecurangan(Request $request, $id)
    {

        $kecurangan = $request['bukti_text'];
        if ($kecurangan == null) {
            $kecurangan = [];
        }
        $fromListKecurangan = $request['curang'];
        $catatanHukum = $request['kecurangan'];
        if ($request['curang'] != null) {
            foreach ($fromListKecurangan as $data) {
                Bukti_deskripsi_curang::create([
                    'tps_id' => Crypt::decrypt($id),
                    'text' => $data,
                ]);
            }
        }
        if ($request['kecurangan'] != null) {
            Bukticatatan::create([
                'tps_id' => Crypt::decrypt($id),
                'text' => $request['kecurangan'],
            ]);
        }
        if($request['bukti'] != NULL){
            $buktiImplode = implode('|', $request['bukti']);
            Databukti::create([
                'tps_id' => Crypt::decrypt($id),
                'bukti' => $buktiImplode,
            ]);
        } 
        $crypt = Crypt::encrypt(rand());
        Saksi::where('tps_id',Crypt::decrypt($id))->update([
            'status_kecurangan' => 'diproses',
        ]);
        $bulan = date('m');
        $tahun = date('y');
        $tps = Tps::where('id',Crypt::decrypt($id))->first();
        $no_berkas = "H/".Crypt::decrypt($id)."/HKM-".$tps['number']."/".$bulan."/".$tahun."";
        $save = Qrcode::create([
            'token'  => $crypt,
            'tps_id' => Crypt::decrypt($id),
            'nomor_berkas' => $no_berkas,
            'verifikator_id' => 46,
            'hukum_id' => 10,
        ]);
        if($save){
           return redirect('validator-hukum/print/'.$id);
        }else{
            echo 'Terjadi Kesalahan Tak Terduga Hubungi Admin';
        }
    }
 
    public function action_verifikasi_kecurangan(Request $request,$id)
    {
        $verifikasi = Saksi::where('tps_id',Crypt::decrypt($id))->update([
            'status_kecurangan' => 'terverifikasi',
        ]);
        if($verifikasi){
            return redirect('validator-hukum/index')->with(['success' => 'Pesan Error']);
        }
    }

    public function action_tolak_kecurangan(Request $request,$id)
    {
        $tolak = Saksi::where('tps_id',Crypt::decrypt($id))->update([
            'status_kecurangan' => 'ditolak',
        ]);
        if($tolak){
            return redirect('validator-hukum/index')->with(['error' => 'Pesan Error']);
        }
    }

    public function print(Request $request, $id)
    {
        $data['tps']       = Tps::where('id',Crypt::decrypt($request['id']))->first();
        $data['saksi']     = Saksi::where('tps_id',Crypt::decrypt($request['id']))->first();
        $data['qrcode']    = ModelsQrcode::where('tps_id',Crypt::decrypt($request['id']))->first();
        $data['kota']      = Regency::where('id',$data['saksi']['regency_id'])->first();
        $data['kecamatan'] = District::where('id',$data['saksi']['district_id'])->first();
        $data['kelurahan'] = Village::where('id',$data['saksi']['village_id'])->first();
        $data['user'] = User::where('id',$data['tps']['user_id'])->first();
        $data['verifikator'] = User::where('id',$data['qrcode']['verifikator_id'])->first();
        $data['hukum'] = User::where('id',$data['qrcode']['hukum_id'])->first();
        $data['databukti'] = Databukti::where('tps_id',Crypt::decrypt($request['id']))->first();
        $data['list_kecurangan']     = Bukti_deskripsi_curang::join('list_kecurangan', 'list_kecurangan.id', '=', 'bukti_deskripsi_curang.list_kecurangan_id')
        ->join('solution_frauds', 'solution_frauds.id', '=', 'list_kecurangan.solution_fraud_id')
        ->where('bukti_deskripsi_curang.tps_id', Crypt::decrypt($request['id']))
        ->get();
        $data['foto_kecurangan'] = ModelsBuktifoto::where('tps_id', Crypt::decrypt($request['id']))->get();
        $data['vidio_kecurangan'] = ModelsBuktividio::where('tps_id', Crypt::decrypt($request['id']))->first();
        return view('balwaslu.print.kecurangan',$data);
        
    }
}