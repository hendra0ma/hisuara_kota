<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRoleApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        $role_id = auth()->user()->role_id;

        if ($role == 'saksi' && $role_id != 13) {
            return response()->json(['messages' => "forbidden"], 403);
        }
        if ($role == "relawan" && $role_id != 14) {
            return response()->json(['messages' => "forbidden"], 403);
        }

        return $next($request);
    }
}
