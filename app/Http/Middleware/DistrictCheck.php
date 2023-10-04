<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DistrictCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $region)
    {
        $cekDistrict = DB::table('securities')
            ->where('user_id', Auth::user()->id)
            ->where('security', 1)
            ->first();

        $cekVillage = DB::table('securities')
            ->where('user_id', Auth::user()->id)
            ->where('security', 2)
            ->first();


        // if ($region == "kecamatan" && $cekDistrict == null) {
        //     return redirect()->back()->with(['error' => 'anda harus login terlebih dahulu']);
        // }
        // if ($region == "kelurahan" && $cekVillage == null) {
        //     return redirect()->back()->with(['error' => 'anda harus login terlebih dahulu']);
        // }
        // if (Cache::get('some_user' . $cekVillage->district_id . Auth::user()->role_id . Auth::user()->id) == null) {
        //     Cache::put('some_user' . $cekVillage->district_id . Auth::user()->role_id . Auth::user()->id, Auth::user()->id);
        //     Session::put('user_exist' . $cekVillage->district_id, Auth::user()->id);
        // }
        return $next($request);
    }
}
