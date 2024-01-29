<?php

namespace App\Providers;

use App\Cms\Cms;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CmsServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        view()->share('menu_pages', $this->countMenus('page'));
        view()->share('menu_modules', $this->countMenus('item'));
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        $this->app->bind('cms', function () {

            return new Cms();
        });
    }
    
    
    // #COUNT MENU ITEMS
    public function countMenus($type = null) {
        $output = false;
        if (Schema::hasTable('dev_generators')) {
            $exists = DB::table('dev_generators')->where('type', $type)->exists();
            if ($exists == true) {
                $output = true;
            }
        } else {
            $output = true;
        }
        return $output;
    }

}
