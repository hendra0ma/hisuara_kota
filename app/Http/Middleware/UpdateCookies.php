<?php

namespace App\Http\Middleware;

use App\Models\RegenciesDomain;
use Closure;
use Illuminate\Http\Request;

class UpdateCookies
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {


        // $currentDomain = request()->getHttpHost();
        // $url = substr($currentDomain, 0, strpos($currentDomain, ':8000'));
        // $regency_id = RegenciesDomain::where('domain',"LIKE","%".$url."%")->first();
        $response = $next($request);
        
        return $response;
    }
}
