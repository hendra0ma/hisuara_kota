<?php

namespace App\Http\Responses;

use App\Models\Acakey;
use App\Models\RegenciesDomain;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        // dd(Auth::user());
        $regency_id = substr((string) Auth::user()->districts,0,4);
        $regency_domain = RegenciesDomain::where('regency_id',$regency_id)->first();
        
        if (Auth::user()->role == 1) {
            return redirect()->route('pusat.home');
        }
        if(auth()->user()->role_id == 14){
            // return redirect('https://'.$regency_domain->domain.'/c1-relawan');
            return redirect('/c1-relawan');
        }
        if(auth()->user()->role_id == 15){
            // return redirect('https://'.$regency_domain->domain.'/c1-banding');
            return redirect('c1-banding');
        }



        if($request->commander ==null){

            // if(auth()->user()->id == 1 && (int) $request->acakey == 111111){
            //         return redirect('redirect');
            // }

            // $acaKey =  Acakey::where('user_id',auth()->user()->id)->where('kode',$request->acakey)->first();
            //     if($acaKey==null){
            //         Auth::logout(); 
            //         return redirect()->back()->with('error','Kode Aca yang anda masukan salah');
            //     }
            //     Acakey::where('kode',$request->acakey)->delete();
    
            }
        



        if($request->commander !=null){
            Cookie::queue('commander',true);
            return redirect('redirect');
        }
        return redirect('redirect');

    }
}
