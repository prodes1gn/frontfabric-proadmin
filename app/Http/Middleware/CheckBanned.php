<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class CheckBanned {

    // #CHECK BANNED USER
    public function handle(Request $request, Closure $next) {
        if (auth()->check() && (auth()->user()->status == 0)) {
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

                return redirect()->route('login')->with('message', trans('global.users_banned'));
        }

        return $next($request);
    }

}
