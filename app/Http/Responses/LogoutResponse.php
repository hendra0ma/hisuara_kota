<?php

namespace App\Http\Responses;
use App\Models\Village;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;

class LogoutResponse implements LogoutResponseContract
{
    public function toResponse($request)
    {
        if ($request->district_id) {
            $village = Village::where('district_id', $request->district_id)->get();
            foreach ($village as $vl) {
                if (Cache::has('some_user' . $vl->id . $request->role_id . $request->id)) {
                    Cache::forget('some_user' . $vl->id . $request->role_id . $request->id);
                }
            }
        }
        if($request->commander != null){
        Cookie::queue(Cookie::forget('commander'));
        return redirect('login-commander');
        }

        return redirect()->route('login');
    }
}
