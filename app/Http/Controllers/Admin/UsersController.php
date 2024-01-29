<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Http\Requests\Admin\User\StatusUserRequest;
use App\Http\Requests\Admin\User\MoveUserRequest;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use JanisKelemen\Setting\Facades\Setting;
use App\Http\Controllers\Traits\Gallery;

class UsersController extends AdminController {

    use Gallery;

    // #SET TITLE
    protected $title = 'user';

    // #LISTING
    public function index(Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #QUERY
        $query = User::with(['roles', 'roles.translations']);
        $query->when($request->search, function ($q, $search) {
            $q->where('name', 'LIKE', "%{$search}%");
        });

        if (isset($request->status) && !is_null($request->status) && $request->status != 'all' && $request->status > -1) {
            $query = $query->where('status', $request->status);
        }

        // #DATA
        $data = $query->orderBy('order')->paginate(Setting::get('pagination'));

        // #VIEW
        return view('admin.core.users.index', compact('data', 'request'))->withTask(trans('global.view'));
    }

    // #SHOW VIEW
    public function show(User $user) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #ROLES
        $user->load('roles');

        // #VIEW
        return view('admin.core.users.show', compact('user'));
    }

    // #CREATE VIEW
    public function create() {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DATA
        $roles = Role::get();
        $lang = app()->getLocale();

        // #VIEW
        return view('admin.core.users.create', compact('roles', 'lang'));
    }

    // #STORE
    public function store(StoreUserRequest $request) {

        // #SAVE DATA
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        $user->where('order', '>', -1)->increment('order');

        // #ADD AVATAR
        if ($request->hasFile('avatar')) {
            $user->addMediaFromRequest('avatar')->withResponsiveImages()->usingName($user->name)->toMediaCollection('avatar');
        }

        // #REDIRECT
        return redirect()->route('admin.users.index')->with('message', trans('global.create_success'));
    }

    // #EDIT VIEW
    public function edit(Request $request, User $user) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $DATA
        $roles = Role::with('translations')->get();
        $user->load('roles');
        $lang = app()->getLocale();

        // #VIEW
        return view('admin.core.users.edit', compact('roles', 'user', 'lang'));
    }

    // #UPDATE
    public function update(UpdateUserRequest $request, User $user) {

        // #UPDATE DATA
        if ($request->input('password') !== null) {
            $user->update($request->all());
        } else {
            $user->update($request->except(['password']));
        }
        $user->roles()->sync($request->input('roles', []));

        // #ADD AVATAR
        if ((!$request->hasFile('avatar') && $request->image == 1) OR $request->hasFile('avatar')) {
            $user->clearMediaCollection('avatar');
        }
        if ($request->hasFile('avatar')) {
            $user->addMediaFromRequest('avatar')->withResponsiveImages()->usingName($user->name)->toMediaCollection('avatar');
        }

        // #REDIRECT
        if ($request->action == 1) {
            return back()->with('message', trans('global.update_success'));
        } else {
            return redirect()->route('admin.users.index')->with('message', trans('global.update_success'));
        }
    }

    public function status(StatusUserRequest $request, User $user) {

        // @CHECK DELETE CURRENT USER
        if (auth()->user()->id == $user->id) {
            return redirect()->route('admin.users.index')->with('danger', trans('global.not_delete_logged_user'));
        }

        // @CHECK DELETE SUPER ADMIN
        if ($user->superAdmin == 1) {
            return redirect()->route('admin.users.index')->with('danger', trans('global.not_delete_super_admin'));
        }
        $user->update($request->all());

        return redirect()->route('admin.users.index');
    }

    // #MOVE
    public function move(MoveUserRequest $request, User $user) {

        // #PARAMETERS
        $type = $request->input('type');
        $order = $request->input('order');

        // #UPDATE
        if ($type == 'move') {
            $user->update(['order' => $order]);
        }
        if ($type == 'moveUp') {
            $user->where('order', $order - 1)->update(['order' => $order]);
            $user->update(['order' => $order - 1]);
        }
        if ($type == 'moveDown') {
            $user->where('order', $order + 1)->update(['order' => $order]);
            $user->update(['order' => $order + 1]);
        }

        // #REDIRECT
        return redirect()->route('admin.users.index');
    }

    // #DELETE
    public function destroy(User $user) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // @CHECK DELETE CURRENT USER
        if (auth()->user()->id == $user->id) {
            return redirect()->route('admin.users.index')->with('danger', trans('global.not_delete_logged_user'));
        }

        // @CHECK DELETE SUPER ADMIN
        if ($user->superAdmin == 1) {
            return redirect()->route('admin.users.index')->with('danger', trans('global.not_delete_super_admin'));
        }

        // #DELETE
        $user->delete();

        // #REDIRECT
        return back()->with('message', trans('global.delete_success'));
    }

}
