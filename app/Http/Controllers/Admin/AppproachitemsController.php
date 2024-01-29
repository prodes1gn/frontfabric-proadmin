<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Appproachitem\StoreAppproachitemRequest;
use App\Http\Requests\Admin\Appproachitem\UpdateAppproachitemRequest;
use App\Http\Requests\Admin\Appproachitem\MoveAppproachitemRequest;
use App\Models\Appproachitem;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use JanisKelemen\Setting\Facades\Setting;
use App\Http\Controllers\Traits\Gallery;
use Illuminate\Support\Str;
use Dotlogics\Grapesjs\App\Traits\EditorTrait;
#NEW-FIELD-USE-MODEL

class AppproachitemsController extends AdminController {
    
    use EditorTrait;
    use Gallery;
    #NEW-FIELD-USED-MODEL

    // #SET TITLE
    protected $title = 'appproachitem';

    // #LISTING
    public function index(Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('appproachitem_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #QUERY
        $query = Appproachitem::with(['translations', /* NEW-FIELD-INDEX-METHOD-WITH */]);
        $query->when($request->search, function ($query, $search) {
            $query->whereTranslationLike('name', "%{$search}%");
        });
        $data = $query->orderBy('order')->paginate(Setting::get('pagination'));

        // #VIEW
        return view('admin.appproachitems.index', compact('data', 'request'))->withTask(trans('global.view'));
    }

    // #SHOW VIEW
    public function show(Appproachitem $appproachitem) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('appproachitem_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // #NEW-FIELD-SHOW-METHOD-DATA
        // #VIEW
        return view('admin.appproachitems.show', compact('appproachitem', /* NEW-FIELD-SHOW-METHOD-VIEW */));
    }

    // #CREATE VIEW
    public function create(Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('appproachitem_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DATA
        $lang = $this->getLang($request->lang);
        // #NEW-FIELD-CREATE-METHOD-DATA
        // #VIEW
        return view('admin.appproachitems.create', compact('lang', /* NEW-FIELD-CREATE-METHOD-VIEW */));
    }

    // #STORE
    public function store(StoreAppproachitemRequest $request) {

        // #SAVE DATA
        // #NEW-FIELD-STORE-METHOD-DATA
        $request->merge([/* NEW-FIELD-STORE-METHOD-MERGE */]);
        $appproachitem = Appproachitem::create($request->all());
        // #NEW-FIELD-STORE-METHOD-SYNC
        // #ADD-STORE-METHOD-GALLERY
        // #ADD-STORE-METHOD-MEDIA
        // #REDIRECT
        return redirect()->route('admin.appproachitems.index')->with('message', trans('global.create_success'));
    }

    // #EDIT VIEW
    public function edit(Appproachitem $appproachitem, Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('appproachitem_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $DATA
        $lang = $this->getLang($request->lang);
        // #NEW-FIELD-EDIT-METHOD-DATA
        // #VIEW
        return view('admin.appproachitems.edit', compact('appproachitem', 'lang', /* NEW-FIELD-EDIT-METHOD-VIEW */));
    }

    // #UPDATE
    public function update(UpdateAppproachitemRequest $request, Appproachitem $appproachitem) {

        // #UPDATE DATA
        // #NEW-FIELD-UPDATE-METHOD-DATA
        $request->merge([/* NEW-FIELD-UPDATE-METHOD-MERGE */]);
        $non_lang = [/* NEW-FIELD-UPDATE-METHOD-NONLANG */];
        $appproachitem->update($request->only($non_lang));
        $appproachitem->update([$request->lang => $request->except($non_lang)]);
        // #NEW-FIELD-UPDATE-METHOD-SYNC
        // #ADD-UPDATE-METHOD-GALLERY
        // #ADD-UPDATE-METHOD-MEDIA
        // #REDIRECT
        if ($request->action == 1) {
            return back()->with('message', trans('global.update_success'));
        } else {
            return redirect()->route('admin.appproachitems.index')->with('message', trans('global.update_success'));
        }
    }

    // #MOVE
    public function move(MoveAppproachitemRequest $request, Appproachitem $appproachitem) {

        // #PARAMETERS
        $type = $request->input('type');
        $order = $request->input('order');

        // #UPDATE
        if ($type == 'move') {
            $appproachitem->update(['order' => $order]);
        }
        if ($type == 'moveUp') {
            $appproachitem->where('order', $order - 1)->update(['order' => $order]);
            $appproachitem->update(['order' => $order - 1]);
        }
        if ($type == 'moveDown') {
            $appproachitem->where('order', $order + 1)->update(['order' => $order]);
            $appproachitem->update(['order' => $order + 1]);
        }

        // #REDIRECT
        return redirect()->route('admin.appproachitems.index');
    }

    // #DELETE
    public function destroy(Appproachitem $appproachitem) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('appproachitem_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DELETE
        $appproachitem->delete();

        // #REDIRECT
        return back()->with('message', trans('global.delete_success'));
    }

    // #DELETE
    public function delete(Request $request, Appproachitem $appproachitem) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('appproachitem_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DELETE
        $appproachitem->deleteTranslations($request->lang);
        // #ADD-DELETE-METHOD-GALLERY
        // #ADD-DELETE-METHOD-MEDIA

        // #REDIRECT
        return back()->with('message', trans('global.delete_success'));
    }
    
    //#PAGEBUILDER-METHOD

}
