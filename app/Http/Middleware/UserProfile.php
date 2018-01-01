<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class UserProfile
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
        if( Auth::check() && $user->id == $request->user_id ){
            return $next($request);
        }

        if( !Auth::check() ){
            return redirect()->route('login');
        }

        if($user->id != $request->user_id){
            return redirect()->route('error404');
        }
        
    }
}
