<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Role\StoreRoleRequest;
use App\Http\Requests\Admin\Role\UpdateRoleRequest;
use App\Http\Requests\Admin\Role\MoveRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use JanisKelemen\Setting\Facades\Setting;

class RolesController extends AdminController {

    // #SET TITLE
    protected $title = 'role';

    // #LISTING
    public function index(Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #QUERY
        $query = Role::with(['permissions', 'translations']);
        $query->when($request->search, function ($query, $search) {
            $query->whereTranslationLike('title', "%{$search}%");
        });
        $data = $query->orderBy('order')->paginate(Setting::get('pagination'));

        // #VIEW
        return view('admin.core.roles.index', compact('data', 'request'))->withTask(trans('global.view'));
    }

    // #SHOW VIEW
    public function show(Role $role) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('role_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #PERMISSIONS
        $role->load('permissions');

        // #VIEW
        return view('admin.core.roles.show', compact('role'));
    }

    // #CREATE VIEW
    public function create(Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('role_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DATA
        $permissions = Permission::pluck('title', 'id');
        $lang = $this->getLang($request->lang);

        // #VIEW
        return view('admin.core.roles.create', compact('permissions', 'lang'));
    }

    // #STORE
    public function store(StoreRoleRequest $request) {

        // #SAVE DATA
        $role = Role::create($request->all());
        $role->permissions()->sync($request->input('permissions', []));

        // #REDIRECT
        return redirect()->route('admin.roles.index')->with('message', trans('global.create_success'));
    }

    // #EDIT VIEW
    public function edit(Role $role, Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('role_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $DATA
        $permissions = Permission::pluck('title', 'id');
        $role->load('permissions');
        $lang = $this->getLang($request->lang);

        // #VIEW
        return view('admin.core.roles.edit', compact('permissions', 'role', 'lang'));
    }

    // #UPDATE
    public function update(UpdateRoleRequest $request, Role $role) {

        // #UPDATE DATA
        $role->update([$request->lang => $request->all()]);
        $role->permissions()->sync($request->input('permissions', []));

        // #REDIRECT
        if ($request->action == 1) {
            return back()->with('message', trans('global.update_success'));
        } else {
            return redirect()->route('admin.roles.index')->with('message', trans('global.update_success'));
        }
    }

    // #MOVE
    public function move(MoveRoleRequest $request, Role $role) {

        // #PARAMETERS
        $type = $request->input('type');
        $order = $request->input('order');

        // #UPDATE
        if ($type == 'move') {
            $role->update(['order' => $order]);
        }
        if ($type == 'moveUp') {
            $role->where('order', $order - 1)->update(['order' => $order]);
            $role->update(['order' => $order - 1]);
        }
        if ($type == 'moveDown') {
            $role->where('order', $order + 1)->update(['order' => $order]);
            $role->update(['order' => $order + 1]);
        }

        // #REDIRECT
        return redirect()->route('admin.roles.index');
    }

    // #DELETE
    public function destroy(Role $role) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #USER ROLES
        $user = User::with('roles')->where('id', auth()->user()->id)->first();

        // #CHECK
        foreach ($user->roles as $row) {
            if ($row->id == $role->id) {
                return redirect()->route('admin.roles.index')->with('danger', trans('global.not_delete_role_of_logged_user'));
            }
        }
        
        // #DELETE
        $role->delete();

        // #REDIRECT
        return back()->with('message', trans('global.delete_success'));
    }

    // #DELETE
    public function delete(Request $request, Role $role) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DELETE
        $role->deleteTranslations($request->lang);

        // #REDIRECT
        return back()->with('message', trans('global.delete_success'));
    }

}
