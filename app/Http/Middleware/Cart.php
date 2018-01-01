<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class Cart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if( Auth::check() && $user->status == 1 ){
            return $next($request);
        }

        if( !Auth::check() ){ 
            return redirect()->route('login');
        }

        if($user->status != 1){
            return redirect()->back();
        }
    }
}
