<?php

namespace App\Http\Middleware;

use App\Models\Config;
use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Acakey;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        $role_id = auth()->user()->role_id;
        $config = Config::first();
        //lockdown
        if($config->lockdown == "yes" && $role_id !=1){
             return redirect()->route('config.lockdown');
        }
        if ($role == 'administrator' && $role_id != 1 && $role_id != 25 && $role_id !=  26) {
            abort(403);
        }
        if ($role == 'verifikator' && $role_id != 2 && $role_id != 1) {
            // abort(403);
            return redirect('kicked');
        }
        if ($role == 'auditor' && $role_id != 3 && $role_id != 1) {
            abort(403);
        }
        if ($role == 'huver' && $role_id != 20 && $role_id != 1) {
            abort(403);
        }
        if ($role == 'rekapitulator' && $role_id != 9 && $role_id != 1) {
            abort(403);
        }
        if ($role == 'checking' && $role_id != 5 && $role_id != 1) {
            abort(403);
        }
        if ($role == 'hunter' && $role_id != 6 && $role_id != 1) {
            abort(403);
        }
        if ($role == 'saksi' && $role_id != 8) {
            abort(403);
        }
        if ($role == 'hukum' && $role_id != 7 && $role_id != 1)  {
            abort(403);
        }
        if ($role == 'validator_hukum' && $role_id != 10) {
            abort(403);
        }
        if ($role == 'payrole' && $role_id != 12) {
            abort(403);
        }
        if ($role == 'banwaslu' && $role_id != 11) {
            abort(403);
        }
        if ($role == 'relawan' && $role_id != 14 ) {
            abort(403);
        }

        if ($role == 'banding' && $role_id != 15 ) {
            abort(403);
        }
        if ($role == 'terblokir' && $role_id != 0) {
            abort(403);
        }
        return $next($request);
    }
}
