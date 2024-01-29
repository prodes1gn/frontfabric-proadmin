<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ActivityLog;

class UserActivityLog {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) {

        if (auth()->user() && !$request->isMethod('get')) {
            ActivityLog::create([
                'url' => request()->path(),
                'ip' => request()->ip(),
                'type' => request()->method(),
                'user_id' => auth()->id(),
            ]);
        }
        
        return $next($request);
    }

}
