<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Valuesitem\StoreValuesitemRequest;
use App\Http\Requests\Admin\Valuesitem\UpdateValuesitemRequest;
use App\Http\Requests\Admin\Valuesitem\MoveValuesitemRequest;
use App\Models\Valuesitem;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use JanisKelemen\Setting\Facades\Setting;
use App\Http\Controllers\Traits\Gallery;
use Illuminate\Support\Str;
use Dotlogics\Grapesjs\App\Traits\EditorTrait;
#NEW-FIELD-USE-MODEL

class ValuesitemsController extends AdminController {
    
    use EditorTrait;
    use Gallery;
    #NEW-FIELD-USED-MODEL

    // #SET TITLE
    protected $title = 'valuesitem';

    // #LISTING
    public function index(Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('valuesitem_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #QUERY
        $query = Valuesitem::with(['translations', /* NEW-FIELD-INDEX-METHOD-WITH */]);
        $query->when($request->search, function ($query, $search) {
            $query->whereTranslationLike('name', "%{$search}%");
        });
        $data = $query->orderBy('order')->paginate(Setting::get('pagination'));

        // #VIEW
        return view('admin.valuesitems.index', compact('data', 'request'))->withTask(trans('global.view'));
    }

    // #SHOW VIEW
    public function show(Valuesitem $valuesitem) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('valuesitem_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // #NEW-FIELD-SHOW-METHOD-DATA
        // #VIEW
        return view('admin.valuesitems.show', compact('valuesitem', /* NEW-FIELD-SHOW-METHOD-VIEW */));
    }

    // #CREATE VIEW
    public function create(Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('valuesitem_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DATA
        $lang = $this->getLang($request->lang);
        // #NEW-FIELD-CREATE-METHOD-DATA
        // #VIEW
        return view('admin.valuesitems.create', compact('lang', /* NEW-FIELD-CREATE-METHOD-VIEW */));
    }

    // #STORE
    public function store(StoreValuesitemRequest $request) {

        // #SAVE DATA
        // #NEW-FIELD-STORE-METHOD-DATA
        $request->merge([/* NEW-FIELD-STORE-METHOD-MERGE */]);
        $valuesitem = Valuesitem::create($request->all());
        // #NEW-FIELD-STORE-METHOD-SYNC
        // #ADD-STORE-METHOD-GALLERY
        // #ADD-STORE-METHOD-MEDIA
        // #REDIRECT
        return redirect()->route('admin.valuesitems.index')->with('message', trans('global.create_success'));
    }

    // #EDIT VIEW
    public function edit(Valuesitem $valuesitem, Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('valuesitem_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $DATA
        $lang = $this->getLang($request->lang);
        // #NEW-FIELD-EDIT-METHOD-DATA
        // #VIEW
        return view('admin.valuesitems.edit', compact('valuesitem', 'lang', /* NEW-FIELD-EDIT-METHOD-VIEW */));
    }

    // #UPDATE
    public function update(UpdateValuesitemRequest $request, Valuesitem $valuesitem) {

        // #UPDATE DATA
        // #NEW-FIELD-UPDATE-METHOD-DATA
        $request->merge([/* NEW-FIELD-UPDATE-METHOD-MERGE */]);
        $non_lang = [/* NEW-FIELD-UPDATE-METHOD-NONLANG */];
        $valuesitem->update($request->only($non_lang));
        $valuesitem->update([$request->lang => $request->except($non_lang)]);
        // #NEW-FIELD-UPDATE-METHOD-SYNC
        // #ADD-UPDATE-METHOD-GALLERY
        // #ADD-UPDATE-METHOD-MEDIA
        // #REDIRECT
        if ($request->action == 1) {
            return back()->with('message', trans('global.update_success'));
        } else {
            return redirect()->route('admin.valuesitems.index')->with('message', trans('global.update_success'));
        }
    }

    // #MOVE
    public function move(MoveValuesitemRequest $request, Valuesitem $valuesitem) {

        // #PARAMETERS
        $type = $request->input('type');
        $order = $request->input('order');

        // #UPDATE
        if ($type == 'move') {
            $valuesitem->update(['order' => $order]);
        }
        if ($type == 'moveUp') {
            $valuesitem->where('order', $order - 1)->update(['order' => $order]);
            $valuesitem->update(['order' => $order - 1]);
        }
        if ($type == 'moveDown') {
            $valuesitem->where('order', $order + 1)->update(['order' => $order]);
            $valuesitem->update(['order' => $order + 1]);
        }

        // #REDIRECT
        return redirect()->route('admin.valuesitems.index');
    }

    // #DELETE
    public function destroy(Valuesitem $valuesitem) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('valuesitem_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DELETE
        $valuesitem->delete();

        // #REDIRECT
        return back()->with('message', trans('global.delete_success'));
    }

    // #DELETE
    public function delete(Request $request, Valuesitem $valuesitem) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('valuesitem_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DELETE
        $valuesitem->deleteTranslations($request->lang);
        // #ADD-DELETE-METHOD-GALLERY
        // #ADD-DELETE-METHOD-MEDIA

        // #REDIRECT
        return back()->with('message', trans('global.delete_success'));
    }
    
    //#PAGEBUILDER-METHOD

}
