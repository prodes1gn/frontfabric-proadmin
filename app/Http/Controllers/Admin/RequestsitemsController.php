<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Requestsitem\StoreRequestsitemRequest;
use App\Http\Requests\Admin\Requestsitem\UpdateRequestsitemRequest;
use App\Http\Requests\Admin\Requestsitem\MoveRequestsitemRequest;
use App\Models\Requestsitem;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use JanisKelemen\Setting\Facades\Setting;
use App\Http\Controllers\Traits\Gallery;
use Illuminate\Support\Str;
use Dotlogics\Grapesjs\App\Traits\EditorTrait;
#NEW-FIELD-USE-MODEL

class RequestsitemsController extends AdminController {
    
    use EditorTrait;
    use Gallery;
    #NEW-FIELD-USED-MODEL

    // #SET TITLE
    protected $title = 'requestsitem';

    // #LISTING
    public function index(Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('requestsitem_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #QUERY
        $query = Requestsitem::with(['translations', /* NEW-FIELD-INDEX-METHOD-WITH */]);
        $query->when($request->search, function ($query, $search) {
            $query->whereTranslationLike('name', "%{$search}%");
        });
        $data = $query->orderBy('order')->paginate(Setting::get('pagination'));

        // #VIEW
        return view('admin.requestsitems.index', compact('data', 'request'))->withTask(trans('global.view'));
    }

    // #SHOW VIEW
    public function show(Requestsitem $requestsitem) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('requestsitem_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // #NEW-FIELD-SHOW-METHOD-DATA
        // #VIEW
        return view('admin.requestsitems.show', compact('requestsitem', /* NEW-FIELD-SHOW-METHOD-VIEW */));
    }

    // #CREATE VIEW
    public function create(Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('requestsitem_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DATA
        $lang = $this->getLang($request->lang);
        // #NEW-FIELD-CREATE-METHOD-DATA
        // #VIEW
        return view('admin.requestsitems.create', compact('lang', /* NEW-FIELD-CREATE-METHOD-VIEW */));
    }

    // #STORE
    public function store(StoreRequestsitemRequest $request) {

        // #SAVE DATA
        // #NEW-FIELD-STORE-METHOD-DATA
        $request->merge([/* NEW-FIELD-STORE-METHOD-MERGE */]);
        $requestsitem = Requestsitem::create($request->all());
        // #NEW-FIELD-STORE-METHOD-SYNC
        // #ADD-STORE-METHOD-GALLERY
        // #ADD-STORE-METHOD-MEDIA
        // #REDIRECT
        return redirect()->route('admin.requestsitems.index')->with('message', trans('global.create_success'));
    }

    // #EDIT VIEW
    public function edit(Requestsitem $requestsitem, Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('requestsitem_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $DATA
        $lang = $this->getLang($request->lang);
        // #NEW-FIELD-EDIT-METHOD-DATA
        // #VIEW
        return view('admin.requestsitems.edit', compact('requestsitem', 'lang', /* NEW-FIELD-EDIT-METHOD-VIEW */));
    }

    // #UPDATE
    public function update(UpdateRequestsitemRequest $request, Requestsitem $requestsitem) {

        // #UPDATE DATA
        // #NEW-FIELD-UPDATE-METHOD-DATA
        $request->merge([/* NEW-FIELD-UPDATE-METHOD-MERGE */]);
        $non_lang = [/* NEW-FIELD-UPDATE-METHOD-NONLANG */];
        $requestsitem->update($request->only($non_lang));
        $requestsitem->update([$request->lang => $request->except($non_lang)]);
        // #NEW-FIELD-UPDATE-METHOD-SYNC
        // #ADD-UPDATE-METHOD-GALLERY
        // #ADD-UPDATE-METHOD-MEDIA
        // #REDIRECT
        if ($request->action == 1) {
            return back()->with('message', trans('global.update_success'));
        } else {
            return redirect()->route('admin.requestsitems.index')->with('message', trans('global.update_success'));
        }
    }

    // #MOVE
    public function move(MoveRequestsitemRequest $request, Requestsitem $requestsitem) {

        // #PARAMETERS
        $type = $request->input('type');
        $order = $request->input('order');

        // #UPDATE
        if ($type == 'move') {
            $requestsitem->update(['order' => $order]);
        }
        if ($type == 'moveUp') {
            $requestsitem->where('order', $order - 1)->update(['order' => $order]);
            $requestsitem->update(['order' => $order - 1]);
        }
        if ($type == 'moveDown') {
            $requestsitem->where('order', $order + 1)->update(['order' => $order]);
            $requestsitem->update(['order' => $order + 1]);
        }

        // #REDIRECT
        return redirect()->route('admin.requestsitems.index');
    }

    // #DELETE
    public function destroy(Requestsitem $requestsitem) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('requestsitem_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DELETE
        $requestsitem->delete();

        // #REDIRECT
        return back()->with('message', trans('global.delete_success'));
    }

    // #DELETE
    public function delete(Request $request, Requestsitem $requestsitem) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('requestsitem_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DELETE
        $requestsitem->deleteTranslations($request->lang);
        // #ADD-DELETE-METHOD-GALLERY
        // #ADD-DELETE-METHOD-MEDIA

        // #REDIRECT
        return back()->with('message', trans('global.delete_success'));
    }
    
    //#PAGEBUILDER-METHOD

}
