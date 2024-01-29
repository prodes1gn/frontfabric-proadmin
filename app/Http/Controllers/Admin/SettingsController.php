<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Settings\SettingsRequest;
use Illuminate\Http\Request;
use App\Models\Settings;
use JanisKelemen\Setting\Facades\Setting;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class SettingsController extends AdminController {

    // #SET TITLE
    protected $title = 'settings';

    // #EDIT
    public function edit() {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('settings_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #TITLES
        $title = trans('global.settings');
        $task = null;

        // #VIEW
        return view('admin.settings.edit', compact('title', 'task'));
    }

    // #UPDATE
    public function update(SettingsRequest $request) {

        // #UPDATE DATA
        Setting::set('pagination', $request->pagination);
        Setting::set('theme_breadcrumbs', $request->theme_breadcrumbs);
        Setting::set('theme_aside_enable', $request->theme_aside_enable);
        Setting::set('aside_minimize', $request->aside_minimize);
        if ($request->theme_aside_enable == 0) {
            Setting::set('aside_minimize', 0);
        }
        Setting::set('theme_header_menu', $request->theme_header_menu);
        Setting::set('theme_header', $request->theme_header);
        Setting::set('theme_aside', $request->theme_aside);
        Setting::set('twofa_by_email', $request->twofa_by_email);
        Setting::set('gmaps_key', $request->gmaps_key);

        // #REDIRECT
        return back()->with('message', trans('global.update_success'));
    }

}
