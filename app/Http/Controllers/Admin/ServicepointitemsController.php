<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Servicepointitem\StoreServicepointitemRequest;
use App\Http\Requests\Admin\Servicepointitem\UpdateServicepointitemRequest;
use App\Http\Requests\Admin\Servicepointitem\MoveServicepointitemRequest;
use App\Models\Servicepointitem;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use JanisKelemen\Setting\Facades\Setting;
use App\Http\Controllers\Traits\Gallery;
use Illuminate\Support\Str;
use Dotlogics\Grapesjs\App\Traits\EditorTrait;
#NEW-FIELD-USE-MODEL

class ServicepointitemsController extends AdminController {
    
    use EditorTrait;
    use Gallery;
    #NEW-FIELD-USED-MODEL

    // #SET TITLE
    protected $title = 'servicepointitem';

    // #LISTING
    public function index(Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('servicepointitem_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #QUERY
        $query = Servicepointitem::with(['translations', /* NEW-FIELD-INDEX-METHOD-WITH */]);
        $query->when($request->search, function ($query, $search) {
            $query->whereTranslationLike('name', "%{$search}%");
        });
        $data = $query->orderBy('order')->paginate(Setting::get('pagination'));

        // #VIEW
        return view('admin.servicepointitems.index', compact('data', 'request'))->withTask(trans('global.view'));
    }

    // #SHOW VIEW
    public function show(Servicepointitem $servicepointitem) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('servicepointitem_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // #NEW-FIELD-SHOW-METHOD-DATA
        // #VIEW
        return view('admin.servicepointitems.show', compact('servicepointitem', /* NEW-FIELD-SHOW-METHOD-VIEW */));
    }

    // #CREATE VIEW
    public function create(Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('servicepointitem_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DATA
        $lang = $this->getLang($request->lang);
        // #NEW-FIELD-CREATE-METHOD-DATA
        // #VIEW
        return view('admin.servicepointitems.create', compact('lang', /* NEW-FIELD-CREATE-METHOD-VIEW */));
    }

    // #STORE
    public function store(StoreServicepointitemRequest $request) {

        // #SAVE DATA
        // #NEW-FIELD-STORE-METHOD-DATA
        $request->merge([/* NEW-FIELD-STORE-METHOD-MERGE */]);
        $servicepointitem = Servicepointitem::create($request->all());
        // #NEW-FIELD-STORE-METHOD-SYNC
        // #ADD-STORE-METHOD-GALLERY
        // #ADD-STORE-METHOD-MEDIA
        // #REDIRECT
        return redirect()->route('admin.servicepointitems.index')->with('message', trans('global.create_success'));
    }

    // #EDIT VIEW
    public function edit(Servicepointitem $servicepointitem, Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('servicepointitem_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $DATA
        $lang = $this->getLang($request->lang);
        // #NEW-FIELD-EDIT-METHOD-DATA
        // #VIEW
        return view('admin.servicepointitems.edit', compact('servicepointitem', 'lang', /* NEW-FIELD-EDIT-METHOD-VIEW */));
    }

    // #UPDATE
    public function update(UpdateServicepointitemRequest $request, Servicepointitem $servicepointitem) {

        // #UPDATE DATA
        // #NEW-FIELD-UPDATE-METHOD-DATA
        $request->merge([/* NEW-FIELD-UPDATE-METHOD-MERGE */]);
        $non_lang = [/* NEW-FIELD-UPDATE-METHOD-NONLANG */];
        $servicepointitem->update($request->only($non_lang));
        $servicepointitem->update([$request->lang => $request->except($non_lang)]);
        // #NEW-FIELD-UPDATE-METHOD-SYNC
        // #ADD-UPDATE-METHOD-GALLERY
        // #ADD-UPDATE-METHOD-MEDIA
        // #REDIRECT
        if ($request->action == 1) {
            return back()->with('message', trans('global.update_success'));
        } else {
            return redirect()->route('admin.servicepointitems.index')->with('message', trans('global.update_success'));
        }
    }

    // #MOVE
    public function move(MoveServicepointitemRequest $request, Servicepointitem $servicepointitem) {

        // #PARAMETERS
        $type = $request->input('type');
        $order = $request->input('order');

        // #UPDATE
        if ($type == 'move') {
            $servicepointitem->update(['order' => $order]);
        }
        if ($type == 'moveUp') {
            $servicepointitem->where('order', $order - 1)->update(['order' => $order]);
            $servicepointitem->update(['order' => $order - 1]);
        }
        if ($type == 'moveDown') {
            $servicepointitem->where('order', $order + 1)->update(['order' => $order]);
            $servicepointitem->update(['order' => $order + 1]);
        }

        // #REDIRECT
        return redirect()->route('admin.servicepointitems.index');
    }

    // #DELETE
    public function destroy(Servicepointitem $servicepointitem) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('servicepointitem_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DELETE
        $servicepointitem->delete();

        // #REDIRECT
        return back()->with('message', trans('global.delete_success'));
    }

    // #DELETE
    public function delete(Request $request, Servicepointitem $servicepointitem) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('servicepointitem_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DELETE
        $servicepointitem->deleteTranslations($request->lang);
        // #ADD-DELETE-METHOD-GALLERY
        // #ADD-DELETE-METHOD-MEDIA

        // #REDIRECT
        return back()->with('message', trans('global.delete_success'));
    }
    
    //#PAGEBUILDER-METHOD

}
