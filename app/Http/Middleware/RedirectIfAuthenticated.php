<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
//    public function handle(Request $request, Closure $next, ...$guards)
//    {
//        $guards = empty($guards) ? [null] : $guards;
//
//        foreach ($guards as $guard) {
//            if (Auth::guard($guard)->check()) {
//                return redirect(RouteServiceProvider::HOME);
//            }
//        }
//
//        return $next($request);
//    }
    
    public function handle(Request $request, Closure $next, $guard = null) {
        
//        if (Auth::guard("alumni")->check()) {
//            return redirect('/');
//        }else if(Auth::guard("admin")->check()){
//            return redirect('adm');
//        }
//
//        return $next($request);
        
        switch($guard){
        case 'admin':
            if (Auth::guard($guard)->check()) {
                return redirect('/');
            }
        break;

        default:
            if (Auth::guard($guard)->check()) {
                return redirect('/');
            }
        break;
    }
        return $next($request); //<-- this line :)
    }
}
