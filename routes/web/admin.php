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

        // #CRUD-PAGE-HOMEPAGES
        // #CRUD-ITEM-HOMEPAGES-PAGEBUILDER
        Route::get('homepage', 'HomepagesController@edit')->name('homepages.edit');
        Route::put('homepage', 'HomepagesController@update')->name('homepages.update');
        Route::delete('homepage', 'HomepagesController@delete')->name('homepage.delete');
        Route::post('homepage/storeMedia', 'HomepagesController@storeMedia')->name('homepage.storeMedia');

        // #CRUD-PAGE-SERVICESPAGES
        // #CRUD-ITEM-SERVICESPAGES-PAGEBUILDER
        Route::get('servicespage', 'ServicespagesController@edit')->name('servicespages.edit');
        Route::put('servicespage', 'ServicespagesController@update')->name('servicespages.update');
        Route::delete('servicespage', 'ServicespagesController@delete')->name('servicespage.delete');
        Route::post('servicespage/storeMedia', 'ServicespagesController@storeMedia')->name('servicespage.storeMedia');

        // #CRUD-PAGE-PORTFOLIOPAGES
        // #CRUD-ITEM-PORTFOLIOPAGES-PAGEBUILDER
        Route::get('portfoliopage', 'PortfoliopagesController@edit')->name('portfoliopages.edit');
        Route::put('portfoliopage', 'PortfoliopagesController@update')->name('portfoliopages.update');
        Route::delete('portfoliopage', 'PortfoliopagesController@delete')->name('portfoliopage.delete');
        Route::post('portfoliopage/storeMedia', 'PortfoliopagesController@storeMedia')->name('portfoliopage.storeMedia');

        // #CRUD-PAGE-APPROACHPAGES
        // #CRUD-ITEM-APPROACHPAGES-PAGEBUILDER
        Route::get('approachpage', 'ApproachpagesController@edit')->name('approachpages.edit');
        Route::put('approachpage', 'ApproachpagesController@update')->name('approachpages.update');
        Route::delete('approachpage', 'ApproachpagesController@delete')->name('approachpage.delete');
        Route::post('approachpage/storeMedia', 'ApproachpagesController@storeMedia')->name('approachpage.storeMedia');

        // #CRUD-PAGE-ABOUTUSPAGES
        // #CRUD-ITEM-ABOUTUSPAGES-PAGEBUILDER
        Route::get('aboutuspage', 'AboutuspagesController@edit')->name('aboutuspages.edit');
        Route::put('aboutuspage', 'AboutuspagesController@update')->name('aboutuspages.update');
        Route::delete('aboutuspage', 'AboutuspagesController@delete')->name('aboutuspage.delete');
        Route::post('aboutuspage/storeMedia', 'AboutuspagesController@storeMedia')->name('aboutuspage.storeMedia');

        // #CRUD-PAGE-BLOGPAGES
        // #CRUD-ITEM-BLOGPAGES-PAGEBUILDER
        Route::get('blogpage', 'BlogpagesController@edit')->name('blogpages.edit');
        Route::put('blogpage', 'BlogpagesController@update')->name('blogpages.update');
        Route::delete('blogpage', 'BlogpagesController@delete')->name('blogpage.delete');
        Route::post('blogpage/storeMedia', 'BlogpagesController@storeMedia')->name('blogpage.storeMedia');

        // #CRUD-PAGE-CONTACTSPAGES
        // #CRUD-ITEM-CONTACTSPAGES-PAGEBUILDER
        Route::get('contactspage', 'ContactspagesController@edit')->name('contactspages.edit');
        Route::put('contactspage', 'ContactspagesController@update')->name('contactspages.update');
        Route::delete('contactspage', 'ContactspagesController@delete')->name('contactspage.delete');
        Route::post('contactspage/storeMedia', 'ContactspagesController@storeMedia')->name('contactspage.storeMedia');

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
