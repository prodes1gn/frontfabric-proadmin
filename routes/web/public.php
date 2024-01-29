<?php

// #HOME
Route::get('/dashboard', function () {
    if (session('status')) {
        return redirect()->route('admin.dashboard')->with('status', session('status'));
    }
    return redirect()->route('admin.dashboard');
});

Route::get('/lang-change-front/{new_lang}', 'App\Http\Controllers\LanguageChangeController@changeLanguage')->name('lang-change-front');

// #CONFIG PUBLIC ROUTES
$locales = config('translatable.locales');
if (is_array($locales) && count($locales) > 1) {
    $config = ['prefix' => CMS::setLang(), 'where' => ['locale' => '[a-zA-Z]{2}'], 'middleware' => 'public_locale'];
} else {
    $config = ['middleware' => 'public_locale'];
}

// #PUBLIC LOCALES
Route::group($config, function () {

    Route::get('/', function () {
        return view('public.welcome');
    });
});

Route::post('deploy', 'App\Http\Controllers\DeployController@deploy');
