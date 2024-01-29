<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Serviceitem\StoreServiceitemRequest;
use App\Http\Requests\Admin\Serviceitem\UpdateServiceitemRequest;
use App\Http\Requests\Admin\Serviceitem\MoveServiceitemRequest;
use App\Models\Serviceitem;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use JanisKelemen\Setting\Facades\Setting;
use App\Http\Controllers\Traits\Gallery;
use Illuminate\Support\Str;
use Dotlogics\Grapesjs\App\Traits\EditorTrait;
#NEW-FIELD-USE-MODEL

class ServiceitemsController extends AdminController {
    
    use EditorTrait;
    use Gallery;
    #NEW-FIELD-USED-MODEL

    // #SET TITLE
    protected $title = 'serviceitem';

    // #LISTING
    public function index(Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('serviceitem_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #QUERY
        $query = Serviceitem::with(['translations', /* NEW-FIELD-INDEX-METHOD-WITH */]);
        $query->when($request->search, function ($query, $search) {
            $query->whereTranslationLike('name', "%{$search}%");
        });
        $data = $query->orderBy('order')->paginate(Setting::get('pagination'));

        // #VIEW
        return view('admin.serviceitems.index', compact('data', 'request'))->withTask(trans('global.view'));
    }

    // #SHOW VIEW
    public function show(Serviceitem $serviceitem) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('serviceitem_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // #NEW-FIELD-SHOW-METHOD-DATA
        $seotypes = array('article' => trans('global.article'), 'product' => trans('global.product'), 'page' => trans('global.page'));
        // #VIEW
        return view('admin.serviceitems.show', compact('serviceitem', 'seotypes', /* NEW-FIELD-SHOW-METHOD-VIEW */));
    }

    // #CREATE VIEW
    public function create(Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('serviceitem_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DATA
        $lang = $this->getLang($request->lang);
        // #NEW-FIELD-CREATE-METHOD-DATA
        $seotypes = array('article' => trans('global.article'), 'product' => trans('global.product'), 'page' => trans('global.page'));
        // #VIEW
        return view('admin.serviceitems.create', compact('lang', 'seotypes', /* NEW-FIELD-CREATE-METHOD-VIEW */));
    }

    // #STORE
    public function store(StoreServiceitemRequest $request) {

        // #SAVE DATA
        // #NEW-FIELD-STORE-METHOD-DATA
        $this->slugMake($request, 'slug');
        $request->merge([/* NEW-FIELD-STORE-METHOD-MERGE */]);
        $serviceitem = Serviceitem::create($request->all());
        // #NEW-FIELD-STORE-METHOD-SYNC
        // #ADD-STORE-METHOD-GALLERY
        // #CRUD-FIELD-SEOIMAGE-START
        $this->storeImage($serviceitem, $request, 'seoimage', 'seoimage-' . $request->lang);
        // #CRUD-FIELD-SEOIMAGE-END
        // #ADD-STORE-METHOD-MEDIA
        // #REDIRECT
        return redirect()->route('admin.serviceitems.index')->with('message', trans('global.create_success'));
    }

    // #EDIT VIEW
    public function edit(Serviceitem $serviceitem, Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('serviceitem_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $DATA
        $lang = $this->getLang($request->lang);
        // #NEW-FIELD-EDIT-METHOD-DATA
        $seotypes = array('article' => trans('global.article'), 'product' => trans('global.product'), 'page' => trans('global.page'));
        // #VIEW
        return view('admin.serviceitems.edit', compact('serviceitem', 'lang', 'seotypes', /* NEW-FIELD-EDIT-METHOD-VIEW */));
    }

    // #UPDATE
    public function update(UpdateServiceitemRequest $request, Serviceitem $serviceitem) {

        // #UPDATE DATA
        // #NEW-FIELD-UPDATE-METHOD-DATA
        $this->slugMake($request, 'slug');
        $request->merge([/* NEW-FIELD-UPDATE-METHOD-MERGE */]);
        $non_lang = [/* NEW-FIELD-UPDATE-METHOD-NONLANG */];
        $serviceitem->update($request->only($non_lang));
        $serviceitem->update([$request->lang => $request->except($non_lang)]);
        // #NEW-FIELD-UPDATE-METHOD-SYNC
        // #ADD-UPDATE-METHOD-GALLERY
        // #CRUD-FIELD-SEOIMAGE-START
        $this->updateImage($serviceitem, $request, 'seoimage', 'seoimage-' . $request->lang);
        // #CRUD-FIELD-SEOIMAGE-END
        // #ADD-UPDATE-METHOD-MEDIA
        // #REDIRECT
        if ($request->action == 1) {
            return back()->with('message', trans('global.update_success'));
        } else {
            return redirect()->route('admin.serviceitems.index')->with('message', trans('global.update_success'));
        }
    }

    // #MOVE
    public function move(MoveServiceitemRequest $request, Serviceitem $serviceitem) {

        // #PARAMETERS
        $type = $request->input('type');
        $order = $request->input('order');

        // #UPDATE
        if ($type == 'move') {
            $serviceitem->update(['order' => $order]);
        }
        if ($type == 'moveUp') {
            $serviceitem->where('order', $order - 1)->update(['order' => $order]);
            $serviceitem->update(['order' => $order - 1]);
        }
        if ($type == 'moveDown') {
            $serviceitem->where('order', $order + 1)->update(['order' => $order]);
            $serviceitem->update(['order' => $order + 1]);
        }

        // #REDIRECT
        return redirect()->route('admin.serviceitems.index');
    }

    // #DELETE
    public function destroy(Serviceitem $serviceitem) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('serviceitem_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DELETE
        $serviceitem->delete();

        // #REDIRECT
        return back()->with('message', trans('global.delete_success'));
    }

    // #DELETE
    public function delete(Request $request, Serviceitem $serviceitem) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('serviceitem_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DELETE
        $serviceitem->deleteTranslations($request->lang);
        // #ADD-DELETE-METHOD-GALLERY
        $serviceitem->clearMediaCollection('seoimage-' . $request->lang);
        // #ADD-DELETE-METHOD-MEDIA

        // #REDIRECT
        return back()->with('message', trans('global.delete_success'));
    }
    
    //#PAGEBUILDER-METHOD

}
