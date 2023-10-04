<?php

namespace App\Http\Controllers;

use App\Models\Acakey;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class EmailController extends Controller
{
    public function getAca(Request $request){
        $kode = rand(100000,999999);
        $details = [
        'title' => 'Mail from Acakey.com',
        'kode' => $kode
        ];
        $email = User::where('email',$request->email)->first();
        if($email == null){
          return  response()->json([
                'error'=>"email yang anda masukan tidak terdaftar"
                
            ],200); 
        }

        Acakey::insert([
            'kode'=>$kode,
            'user_id'=>$email->id
        ]);
        Mail::to($request->email)->send(new \App\Mail\AcaMail($details));
       
        return response()->json([
            'success'=>"Silahkan Cek email Anda"
        ],200);
        }
}
