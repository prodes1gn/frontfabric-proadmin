<?php

// #AUTHENTICATION
Route::get('userVerification/{token}', 'Auth\UserVerificationController@approve')->name('userVerification');
Auth::routes(['register' => config('cms.registration_enable')]);

// #USER, ROLE && PERMISSIOMS MANAGEMENT
Route::group(['as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', '2fa']], function () {

    // #DASHBOARD
    Route::get('/', 'HomeController@index')->name('dashboard');

    // #SERACH
    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');

    // #CORE
    Route::group(['prefix' => 'core'], function () {
        // #ROLES
        Route::post('roles/move/{role}', 'RolesController@move')->name('role.move');
        Route::delete('roles/delete/{role}', 'RolesController@delete')->name('role.delete');
        Route::resource('roles', 'RolesController');

        // #USERS
        Route::post('users/status/{user}', 'UsersController@status')->name('users.status');
        Route::post('users/move/{user}', 'UsersController@move')->name('user.move');
        Route::resource('users', 'UsersController');

        // #TICKET SUPPORT
        Route::get('support', 'SupportController@edit')->name('support.edit');
        Route::post('support', 'SupportController@update')->name('support.update');

        // #SETTINGS SUPPORT
        Route::get('settings', 'SettingsController@edit')->name('settings.edit');
        Route::post('settings', 'SettingsController@update')->name('settings.update');
    });

    // #PAGES
    Route::group(['prefix' => 'page'], function () {

        #CRUD-NEW-PAGE
    });
    
    // #MODULES
    Route::group(['prefix' => 'module'], function () {

        #CRUD-NEW-ITEM
    });
});

// #PROFILE EDIT
Route::group(['as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
    Route::post('password', 'ChangePasswordController@update')->name('password.update');
    Route::get('profile', 'ChangePasswordController@profile')->name('profile.edit');
    Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
    Route::post('profile/two-factor', 'ChangePasswordController@toggleTwoFactor')->name('password.toggleTwoFactor');
});

// #TWO FACTOR AUTHENTICATION BY EMAIL
Route::group(['namespace' => 'Auth', 'middleware' => ['auth']], function () {
    Route::get('two-factor', 'TwoFactorController@show')->name('twoFactor.show');
    Route::post('two-factor', 'TwoFactorController@check')->name('twoFactor.check');
    Route::get('two-factor/resend', 'TwoFactorController@resend')->name('twoFactor.resend');
});
