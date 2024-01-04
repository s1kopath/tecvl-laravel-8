<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class UserAuthenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        session()->put('prev3', session()->get('prev2'));
        session()->put('prev2', session()->get('prev1'));
        session()->put('prev1', url()->previous());
        session()->put('nextUrl', url()->full());

        if (! $request->expectsJson()) {
            return route('site.login');
        }
    }
}
