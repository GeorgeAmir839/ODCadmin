<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class verify
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
        // dd(Auth::user()->verified);
        if (Auth::check() && (Auth::user()->verified == 1)) {
            // if (Auth::user()->email == 'admin@ysys.co' || Auth::user()->user_type == 'staff') // allow only this user "admin@ysys.co"
            return $next($request);
            // else
            // return redirect()->route('user.login');
        } else {
            return abort(403, 'Code Not Verify!');
        }
    }
}
