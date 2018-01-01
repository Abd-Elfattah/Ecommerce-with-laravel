<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Closure;

class CheckOut
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
        if( $user->addresses->count() > 0 && Session::has('cart')){
            return $next($request);
        }

        if($user->addresses->count() == 0){
            Session::flush('cartFailed' , 'Please add Your Address to your Profile');
            return redirect()->back();
        }
    }
}
