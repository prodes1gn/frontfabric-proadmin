<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PublicLocale {

    public function handle(Request $request, Closure $next) {

        $lang = $request->segment(1);
        $languages = config('translatable.locales');
        $default = config('translatable.locale');

        if (is_array($languages) && count($languages) > 1) {
            if (in_array($lang, $languages)) {
                app()->setLocale($lang);
                return $next($request);
            } else {
                app()->setLocale($default);
                return redirect()->to(app()->getLocale());
            }
        } else {
            app()->setLocale($default);
            return $next($request);
        }
    }

}
