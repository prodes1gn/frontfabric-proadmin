<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Systempagesitem\StoreSystempagesitemRequest;
use App\Http\Requests\Admin\Systempagesitem\UpdateSystempagesitemRequest;
use App\Http\Requests\Admin\Systempagesitem\MoveSystempagesitemRequest;
use App\Models\Systempagesitem;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use JanisKelemen\Setting\Facades\Setting;
use App\Http\Controllers\Traits\Gallery;
use Illuminate\Support\Str;
use Dotlogics\Grapesjs\App\Traits\EditorTrait;
#NEW-FIELD-USE-MODEL

class SystempagesitemsController extends AdminController {
    
    use EditorTrait;
    use Gallery;
    #NEW-FIELD-USED-MODEL

    // #SET TITLE
    protected $title = 'systempagesitem';

    // #LISTING
    public function index(Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('systempagesitem_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #QUERY
        $query = Systempagesitem::with(['translations', /* NEW-FIELD-INDEX-METHOD-WITH */]);
        $query->when($request->search, function ($query, $search) {
            $query->whereTranslationLike('name', "%{$search}%");
        });
        $data = $query->orderBy('order')->paginate(Setting::get('pagination'));

        // #VIEW
        return view('admin.systempagesitems.index', compact('data', 'request'))->withTask(trans('global.view'));
    }

    // #SHOW VIEW
    public function show(Systempagesitem $systempagesitem) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('systempagesitem_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // #NEW-FIELD-SHOW-METHOD-DATA
        $seotypes = array('article' => trans('global.article'), 'product' => trans('global.product'), 'page' => trans('global.page'));
        // #VIEW
        return view('admin.systempagesitems.show', compact('systempagesitem', 'seotypes', /* NEW-FIELD-SHOW-METHOD-VIEW */));
    }

    // #CREATE VIEW
    public function create(Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('systempagesitem_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DATA
        $lang = $this->getLang($request->lang);
        // #NEW-FIELD-CREATE-METHOD-DATA
        $seotypes = array('article' => trans('global.article'), 'product' => trans('global.product'), 'page' => trans('global.page'));
        // #VIEW
        return view('admin.systempagesitems.create', compact('lang', 'seotypes', /* NEW-FIELD-CREATE-METHOD-VIEW */));
    }

    // #STORE
    public function store(StoreSystempagesitemRequest $request) {

        // #SAVE DATA
        // #NEW-FIELD-STORE-METHOD-DATA
        $this->slugMake($request, 'slug');
        $request->merge([/* NEW-FIELD-STORE-METHOD-MERGE */]);
        $systempagesitem = Systempagesitem::create($request->all());
        // #NEW-FIELD-STORE-METHOD-SYNC
        // #ADD-STORE-METHOD-GALLERY
        // #CRUD-FIELD-SEOIMAGE-START
        $this->storeImage($systempagesitem, $request, 'seoimage', 'seoimage-' . $request->lang);
        // #CRUD-FIELD-SEOIMAGE-END
        // #ADD-STORE-METHOD-MEDIA
        // #REDIRECT
        return redirect()->route('admin.systempagesitems.index')->with('message', trans('global.create_success'));
    }

    // #EDIT VIEW
    public function edit(Systempagesitem $systempagesitem, Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('systempagesitem_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $DATA
        $lang = $this->getLang($request->lang);
        // #NEW-FIELD-EDIT-METHOD-DATA
        $seotypes = array('article' => trans('global.article'), 'product' => trans('global.product'), 'page' => trans('global.page'));
        // #VIEW
        return view('admin.systempagesitems.edit', compact('systempagesitem', 'lang', 'seotypes', /* NEW-FIELD-EDIT-METHOD-VIEW */));
    }

    // #UPDATE
    public function update(UpdateSystempagesitemRequest $request, Systempagesitem $systempagesitem) {

        // #UPDATE DATA
        // #NEW-FIELD-UPDATE-METHOD-DATA
        $this->slugMake($request, 'slug');
        $request->merge([/* NEW-FIELD-UPDATE-METHOD-MERGE */]);
        $non_lang = [/* NEW-FIELD-UPDATE-METHOD-NONLANG */];
        $systempagesitem->update($request->only($non_lang));
        $systempagesitem->update([$request->lang => $request->except($non_lang)]);
        // #NEW-FIELD-UPDATE-METHOD-SYNC
        // #ADD-UPDATE-METHOD-GALLERY
        // #CRUD-FIELD-SEOIMAGE-START
        $this->updateImage($systempagesitem, $request, 'seoimage', 'seoimage-' . $request->lang);
        // #CRUD-FIELD-SEOIMAGE-END
        // #ADD-UPDATE-METHOD-MEDIA
        // #REDIRECT
        if ($request->action == 1) {
            return back()->with('message', trans('global.update_success'));
        } else {
            return redirect()->route('admin.systempagesitems.index')->with('message', trans('global.update_success'));
        }
    }

    // #MOVE
    public function move(MoveSystempagesitemRequest $request, Systempagesitem $systempagesitem) {

        // #PARAMETERS
        $type = $request->input('type');
        $order = $request->input('order');

        // #UPDATE
        if ($type == 'move') {
            $systempagesitem->update(['order' => $order]);
        }
        if ($type == 'moveUp') {
            $systempagesitem->where('order', $order - 1)->update(['order' => $order]);
            $systempagesitem->update(['order' => $order - 1]);
        }
        if ($type == 'moveDown') {
            $systempagesitem->where('order', $order + 1)->update(['order' => $order]);
            $systempagesitem->update(['order' => $order + 1]);
        }

        // #REDIRECT
        return redirect()->route('admin.systempagesitems.index');
    }

    // #DELETE
    public function destroy(Systempagesitem $systempagesitem) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('systempagesitem_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DELETE
        $systempagesitem->delete();

        // #REDIRECT
        return back()->with('message', trans('global.delete_success'));
    }

    // #DELETE
    public function delete(Request $request, Systempagesitem $systempagesitem) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('systempagesitem_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DELETE
        $systempagesitem->deleteTranslations($request->lang);
        // #ADD-DELETE-METHOD-GALLERY
        $systempagesitem->clearMediaCollection('seoimage-' . $request->lang);
        // #ADD-DELETE-METHOD-MEDIA

        // #REDIRECT
        return back()->with('message', trans('global.delete_success'));
    }
    
    //#PAGEBUILDER-METHOD

}
