<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Profile\UpdatePasswordRequest;
use App\Http\Requests\Admin\Profile\UpdateProfileRequest;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class ChangePasswordController extends Controller {

    public function edit() {
        abort_if(Gate::denies('profile_password_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #TITLES
        $title = trans('global.change_password');
        $task = trans('global.edit');

        return view('auth.passwords.edit', compact('title', 'task'));
    }

    public function update(UpdatePasswordRequest $request) {
        auth()->user()->update($request->validated());

        return redirect()->route('profile.password.edit')->with('message', trans('global.change_password_success'));
    }

    public function profile() {
        abort_if(Gate::denies('profile_password_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #TITLES
        $title = trans('global.my_profile');
        $task = trans('global.edit');

        return view('auth.passwords.profile', compact('title', 'task'));
    }

    public function updateProfile(UpdateProfileRequest $request) {
        $user = auth()->user();

        $user->update($request->validated());
        $user->clearMediaCollection('avatar');
        $user->addMediaFromRequest('avatar')->withResponsiveImages()->usingName($user->name)->toMediaCollection('avatar');

        return redirect()->route('profile.profile.edit')->with('message', trans('global.update_profile_success'));
    }

}
