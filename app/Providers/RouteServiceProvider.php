<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider {

    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot(): void {

        $this->configureRateLimiting();

        $this->routes(function () {

            // #API ROUTES 
            Route::prefix('api')
                    ->middleware('api')
                    ->namespace($this->namespace)
                    ->group(base_path('routes/api.php'));

            // #WEB ROUTES 
            Route::middleware('web')
                    ->middleware(['web'])
                    ->namespace($this->namespace)
                    ->group(base_path('routes/web/public.php'));

            // #ADMIN MIDDLEWARES
            $admin_middleware = array(
                'web',
                'blockIP',
                'activityLog',
                'banned',
                'admin_locale',
            );

            // @CHECK IS ADMIN PANEL IP ENABLE
            if (config('cms.admin_panel_ip_resstrict') === true) {
                $admin_middleware[] = 'allowIPadmin';
            }

            // #ADMIN ROUTES 
            Route::prefix(config('cms.admin_panel_url'))
                    ->middleware($admin_middleware)
                    ->namespace($this->namespace)
                    ->group(base_path('routes/web/admin.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }

}
