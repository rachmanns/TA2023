<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class SecretPageAuth
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
        if(Auth::user()->roles->pluck('secret_access')[0]){

            if (!empty(auth()->user()->secret_page)) {
                return $next($request);
            }

            return redirect(RouteServiceProvider::SECRET_PAGE);

        }else{

            return redirect(RouteServiceProvider::SECRET_PAGE_FORBIDDEN);


        }
        
    }
}
