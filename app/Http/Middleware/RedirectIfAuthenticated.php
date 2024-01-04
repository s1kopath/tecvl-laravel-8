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
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if ($guard == "user" && Auth::guard('user')->check() && Auth::user()->roles[0]->type == "global" &&  Auth::user()->roles[0]->slug == "super-admin") {
            return redirect()->intended(route('dashboard'));
        } elseif ($guard == "user" && Auth::guard('user')->check() && Auth::user()->roles[0]->type == "vendor" &&  Auth::user()->roles[0]->slug == "vendor-admin") {
            return redirect()->intended(route('vendor-dashboard'));
        }

        return $next($request);
    }
}
