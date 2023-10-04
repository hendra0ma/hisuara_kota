<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\Rekening;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;


class Payrole extends Controller
{
    public function index()
    {
        $data['config'] = Config::first();
        $data['rekening'] = User::join('rekening_users', 'users.id', '=', 'rekening_users.user_id')
            ->select('users.*', 'rekening_users.*', 'rekening_users.id as id_rek')
            ->paginate(10);

        return view('payrole.index', $data);
    }
    public function updateToDiproses($id)
    {
        $id = Crypt::decrypt($id);
        $data = [
            'status' => "proses"
        ];
        Rekening::where('id', $id)->update($data);
        return redirect()->back()->with(['success' => "berhasil mengupdate status"]);
    }
}
