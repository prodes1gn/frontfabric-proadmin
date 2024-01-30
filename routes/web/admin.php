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

        // #CRUD-ITEM-SERVICEITEMS
        Route::group(['prefix' => 'serviceitems'], function () {
        // #CRUD-ITEM-SERVICEITEMS-FILTERS
        // #CRUD-ITEM-SERVICEITEMS-PAGEBUILDER
        Route::post('storeMedia', 'ServiceitemsController@storeMedia')->name('serviceitem.storeMedia');
        Route::post('move/{serviceitem}', 'ServiceitemsController@move')->name('serviceitem.move');
        Route::delete('delete/{serviceitem}', 'ServiceitemsController@delete')->name('serviceitem.delete');
        });
        Route::resource('serviceitems', 'ServiceitemsController');

        // #CRUD-ITEM-WHYUSHOMEPAGEITEMS
        Route::group(['prefix' => 'whyushomepageitems'], function () {
        // #CRUD-ITEM-WHYUSHOMEPAGEITEMS-FILTERS
        // #CRUD-ITEM-WHYUSHOMEPAGEITEMS-PAGEBUILDER
        Route::post('storeMedia', 'WhyushomepageitemsController@storeMedia')->name('whyushomepageitem.storeMedia');
        Route::post('move/{whyushomepageitem}', 'WhyushomepageitemsController@move')->name('whyushomepageitem.move');
        Route::delete('delete/{whyushomepageitem}', 'WhyushomepageitemsController@delete')->name('whyushomepageitem.delete');
        });
        Route::resource('whyushomepageitems', 'WhyushomepageitemsController');

        // #CRUD-ITEM-TESTIMONIALSITEMS
        Route::group(['prefix' => 'testimonialsitems'], function () {
        // #CRUD-ITEM-TESTIMONIALSITEMS-FILTERS
        // #CRUD-ITEM-TESTIMONIALSITEMS-PAGEBUILDER
        Route::post('storeMedia', 'TestimonialsitemsController@storeMedia')->name('testimonialsitem.storeMedia');
        Route::post('move/{testimonialsitem}', 'TestimonialsitemsController@move')->name('testimonialsitem.move');
        Route::delete('delete/{testimonialsitem}', 'TestimonialsitemsController@delete')->name('testimonialsitem.delete');
        });
        Route::resource('testimonialsitems', 'TestimonialsitemsController');

        // #CRUD-ITEM-APPPROACHITEMS
        Route::group(['prefix' => 'appproachitems'], function () {
        // #CRUD-ITEM-APPPROACHITEMS-FILTERS
        // #CRUD-ITEM-APPPROACHITEMS-PAGEBUILDER
        Route::post('storeMedia', 'AppproachitemsController@storeMedia')->name('appproachitem.storeMedia');
        Route::post('move/{appproachitem}', 'AppproachitemsController@move')->name('appproachitem.move');
        Route::delete('delete/{appproachitem}', 'AppproachitemsController@delete')->name('appproachitem.delete');
        });
        Route::resource('appproachitems', 'AppproachitemsController');

        // #CRUD-ITEM-PORTFOLIOITEMS
        Route::group(['prefix' => 'portfolioitems'], function () {
        // #CRUD-ITEM-PORTFOLIOITEMS-FILTERS
        // #CRUD-ITEM-PORTFOLIOITEMS-PAGEBUILDER
        Route::post('storeMedia', 'PortfolioitemsController@storeMedia')->name('portfolioitem.storeMedia');
        Route::post('move/{portfolioitem}', 'PortfolioitemsController@move')->name('portfolioitem.move');
        Route::delete('delete/{portfolioitem}', 'PortfolioitemsController@delete')->name('portfolioitem.delete');
        });
        Route::resource('portfolioitems', 'PortfolioitemsController');

        // #CRUD-ITEM-BLOGITEMS
        Route::group(['prefix' => 'blogitems'], function () {
        // #CRUD-ITEM-BLOGITEMS-FILTERS
        // #CRUD-ITEM-BLOGITEMS-PAGEBUILDER
        Route::post('storeMedia', 'BlogitemsController@storeMedia')->name('blogitem.storeMedia');
        Route::post('move/{blogitem}', 'BlogitemsController@move')->name('blogitem.move');
        Route::delete('delete/{blogitem}', 'BlogitemsController@delete')->name('blogitem.delete');
        });
        Route::resource('blogitems', 'BlogitemsController');

        // #CRUD-ITEM-REQUESTSITEMS
        Route::group(['prefix' => 'requestsitems'], function () {
        // #CRUD-ITEM-REQUESTSITEMS-FILTERS
        // #CRUD-ITEM-REQUESTSITEMS-PAGEBUILDER
        Route::post('storeMedia', 'RequestsitemsController@storeMedia')->name('requestsitem.storeMedia');
        Route::post('move/{requestsitem}', 'RequestsitemsController@move')->name('requestsitem.move');
        Route::delete('delete/{requestsitem}', 'RequestsitemsController@delete')->name('requestsitem.delete');
        });
        Route::resource('requestsitems', 'RequestsitemsController');

        // #CRUD-ITEM-SYSTEMPAGESITEMS
        Route::group(['prefix' => 'systempagesitems'], function () {
        // #CRUD-ITEM-SYSTEMPAGESITEMS-FILTERS
        // #CRUD-ITEM-SYSTEMPAGESITEMS-PAGEBUILDER
        Route::post('storeMedia', 'SystempagesitemsController@storeMedia')->name('systempagesitem.storeMedia');
        Route::post('move/{systempagesitem}', 'SystempagesitemsController@move')->name('systempagesitem.move');
        Route::delete('delete/{systempagesitem}', 'SystempagesitemsController@delete')->name('systempagesitem.delete');
        });
        Route::resource('systempagesitems', 'SystempagesitemsController');

        // #CRUD-ITEM-SERVICEPOINTITEMS
        Route::group(['prefix' => 'servicepointitems'], function () {
        // #CRUD-ITEM-SERVICEPOINTITEMS-FILTERS
        // #CRUD-ITEM-SERVICEPOINTITEMS-PAGEBUILDER
        Route::post('storeMedia', 'ServicepointitemsController@storeMedia')->name('servicepointitem.storeMedia');
        Route::post('move/{servicepointitem}', 'ServicepointitemsController@move')->name('servicepointitem.move');
        Route::delete('delete/{servicepointitem}', 'ServicepointitemsController@delete')->name('servicepointitem.delete');
        });
        Route::resource('servicepointitems', 'ServicepointitemsController');

        // #CRUD-ITEM-VALUESITEMS
        Route::group(['prefix' => 'valuesitems'], function () {
        // #CRUD-ITEM-VALUESITEMS-FILTERS
        // #CRUD-ITEM-VALUESITEMS-PAGEBUILDER
        Route::post('storeMedia', 'ValuesitemsController@storeMedia')->name('valuesitem.storeMedia');
        Route::post('move/{valuesitem}', 'ValuesitemsController@move')->name('valuesitem.move');
        Route::delete('delete/{valuesitem}', 'ValuesitemsController@delete')->name('valuesitem.delete');
        });
        Route::resource('valuesitems', 'ValuesitemsController');

        // #CRUD-ITEM-BLOGCATEGORYITEMS
        Route::group(['prefix' => 'blogcategoryitems'], function () {
        // #CRUD-ITEM-BLOGCATEGORYITEMS-FILTERS
        // #CRUD-ITEM-BLOGCATEGORYITEMS-PAGEBUILDER
        Route::post('storeMedia', 'BlogcategoryitemsController@storeMedia')->name('blogcategoryitem.storeMedia');
        Route::post('move/{blogcategoryitem}', 'BlogcategoryitemsController@move')->name('blogcategoryitem.move');
        Route::delete('delete/{blogcategoryitem}', 'BlogcategoryitemsController@delete')->name('blogcategoryitem.delete');
        });
        Route::resource('blogcategoryitems', 'BlogcategoryitemsController');

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
