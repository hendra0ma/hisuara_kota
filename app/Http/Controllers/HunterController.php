<?php

namespace App\Http\Controllers;

use App\Models\Paslon;
use App\Models\Relawan;
use App\Models\RelawanData;
use App\Models\SuratSuara;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class HunterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['team'] = User::where('id', '!=', Auth::user()->id)->where('role_id', Auth::user()->role_id)->get();
        $data['team_count'] = User::where('role_id', Auth::user()->role_id)->count();
        
        return view('hunter.index', $data);
    }
    public function getSaksiData(Request $req)
    {
        $data['relawan'] = Relawan::join('villages', 'villages.id', '=', 'c1_relawan.village_id')
            ->where('c1_relawan.tps_id', $req->id)
            ->select('c1_relawan.*', 'villages.*', 'villages.name as village_name', 'c1_relawan.id as relawan_id')
            ->first();
        // dump($data);
        $data['paslon'] = Paslon::get();
        $data['surat_suara'] = SuratSuara::where('tps_id',$req->id)->first();
        return view('hunter.modalView', $data);
    }

    public function verifikasiRelawan(Request $req, $id)
    {
        $req->validate([
            'suara.*' => ['required'],
        ]);
        $id = Crypt::decrypt($id);
        $relawan = Relawan::where('id', $id)->first();
        $paslon = Paslon::select('id')->get();
        $i = 0;
        $data = ['status' => 1];
        Relawan::where('id', $id)->update($data);
        foreach ($paslon as $pas) {
            $relawan_data = new RelawanData;
            $relawan_data->relawan_id = $id;
            $relawan_data->c1_relawan_id = $id;
            $relawan_data->paslon_id = $pas->id;
            $relawan_data->village_id = $relawan->village_id;
            $relawan_data->regency_id = $relawan->regency_id;
            $relawan_data->district_id = $relawan->district_id;
            $relawan_data->voice = $req->suara[$i];
            $relawan_data->save();
            $i++;
        }
        return redirect()->back()->with(['success' => "Data relawan berhasil di verifikasi"]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
