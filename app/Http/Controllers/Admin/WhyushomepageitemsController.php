<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Whyushomepageitem\StoreWhyushomepageitemRequest;
use App\Http\Requests\Admin\Whyushomepageitem\UpdateWhyushomepageitemRequest;
use App\Http\Requests\Admin\Whyushomepageitem\MoveWhyushomepageitemRequest;
use App\Models\Whyushomepageitem;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use JanisKelemen\Setting\Facades\Setting;
use App\Http\Controllers\Traits\Gallery;
use Illuminate\Support\Str;
use Dotlogics\Grapesjs\App\Traits\EditorTrait;
#NEW-FIELD-USE-MODEL

class WhyushomepageitemsController extends AdminController {
    
    use EditorTrait;
    use Gallery;
    #NEW-FIELD-USED-MODEL

    // #SET TITLE
    protected $title = 'whyushomepageitem';

    // #LISTING
    public function index(Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('whyushomepageitem_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #QUERY
        $query = Whyushomepageitem::with(['translations', /* NEW-FIELD-INDEX-METHOD-WITH */]);
        $query->when($request->search, function ($query, $search) {
            $query->whereTranslationLike('name', "%{$search}%");
        });
        $data = $query->orderBy('order')->paginate(Setting::get('pagination'));

        // #VIEW
        return view('admin.whyushomepageitems.index', compact('data', 'request'))->withTask(trans('global.view'));
    }

    // #SHOW VIEW
    public function show(Whyushomepageitem $whyushomepageitem) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('whyushomepageitem_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // #NEW-FIELD-SHOW-METHOD-DATA
        // #VIEW
        return view('admin.whyushomepageitems.show', compact('whyushomepageitem', /* NEW-FIELD-SHOW-METHOD-VIEW */));
    }

    // #CREATE VIEW
    public function create(Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('whyushomepageitem_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DATA
        $lang = $this->getLang($request->lang);
        // #NEW-FIELD-CREATE-METHOD-DATA
        // #VIEW
        return view('admin.whyushomepageitems.create', compact('lang', /* NEW-FIELD-CREATE-METHOD-VIEW */));
    }

    // #STORE
    public function store(StoreWhyushomepageitemRequest $request) {

        // #SAVE DATA
        // #NEW-FIELD-STORE-METHOD-DATA
        $request->merge([/* NEW-FIELD-STORE-METHOD-MERGE */]);
        $whyushomepageitem = Whyushomepageitem::create($request->all());
        // #NEW-FIELD-STORE-METHOD-SYNC
        // #ADD-STORE-METHOD-GALLERY
        // #ADD-STORE-METHOD-MEDIA
        // #REDIRECT
        return redirect()->route('admin.whyushomepageitems.index')->with('message', trans('global.create_success'));
    }

    // #EDIT VIEW
    public function edit(Whyushomepageitem $whyushomepageitem, Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('whyushomepageitem_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $DATA
        $lang = $this->getLang($request->lang);
        // #NEW-FIELD-EDIT-METHOD-DATA
        // #VIEW
        return view('admin.whyushomepageitems.edit', compact('whyushomepageitem', 'lang', /* NEW-FIELD-EDIT-METHOD-VIEW */));
    }

    // #UPDATE
    public function update(UpdateWhyushomepageitemRequest $request, Whyushomepageitem $whyushomepageitem) {

        // #UPDATE DATA
        // #NEW-FIELD-UPDATE-METHOD-DATA
        $request->merge([/* NEW-FIELD-UPDATE-METHOD-MERGE */]);
        $non_lang = [/* NEW-FIELD-UPDATE-METHOD-NONLANG */];
        $whyushomepageitem->update($request->only($non_lang));
        $whyushomepageitem->update([$request->lang => $request->except($non_lang)]);
        // #NEW-FIELD-UPDATE-METHOD-SYNC
        // #ADD-UPDATE-METHOD-GALLERY
        // #ADD-UPDATE-METHOD-MEDIA
        // #REDIRECT
        if ($request->action == 1) {
            return back()->with('message', trans('global.update_success'));
        } else {
            return redirect()->route('admin.whyushomepageitems.index')->with('message', trans('global.update_success'));
        }
    }

    // #MOVE
    public function move(MoveWhyushomepageitemRequest $request, Whyushomepageitem $whyushomepageitem) {

        // #PARAMETERS
        $type = $request->input('type');
        $order = $request->input('order');

        // #UPDATE
        if ($type == 'move') {
            $whyushomepageitem->update(['order' => $order]);
        }
        if ($type == 'moveUp') {
            $whyushomepageitem->where('order', $order - 1)->update(['order' => $order]);
            $whyushomepageitem->update(['order' => $order - 1]);
        }
        if ($type == 'moveDown') {
            $whyushomepageitem->where('order', $order + 1)->update(['order' => $order]);
            $whyushomepageitem->update(['order' => $order + 1]);
        }

        // #REDIRECT
        return redirect()->route('admin.whyushomepageitems.index');
    }

    // #DELETE
    public function destroy(Whyushomepageitem $whyushomepageitem) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('whyushomepageitem_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DELETE
        $whyushomepageitem->delete();

        // #REDIRECT
        return back()->with('message', trans('global.delete_success'));
    }

    // #DELETE
    public function delete(Request $request, Whyushomepageitem $whyushomepageitem) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('whyushomepageitem_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DELETE
        $whyushomepageitem->deleteTranslations($request->lang);
        // #ADD-DELETE-METHOD-GALLERY
        // #ADD-DELETE-METHOD-MEDIA

        // #REDIRECT
        return back()->with('message', trans('global.delete_success'));
    }
    
    //#PAGEBUILDER-METHOD

}
