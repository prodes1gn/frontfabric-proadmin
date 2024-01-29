<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Testimonialsitem\StoreTestimonialsitemRequest;
use App\Http\Requests\Admin\Testimonialsitem\UpdateTestimonialsitemRequest;
use App\Http\Requests\Admin\Testimonialsitem\MoveTestimonialsitemRequest;
use App\Models\Testimonialsitem;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use JanisKelemen\Setting\Facades\Setting;
use App\Http\Controllers\Traits\Gallery;
use Illuminate\Support\Str;
use Dotlogics\Grapesjs\App\Traits\EditorTrait;
#NEW-FIELD-USE-MODEL

class TestimonialsitemsController extends AdminController {
    
    use EditorTrait;
    use Gallery;
    #NEW-FIELD-USED-MODEL

    // #SET TITLE
    protected $title = 'testimonialsitem';

    // #LISTING
    public function index(Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('testimonialsitem_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #QUERY
        $query = Testimonialsitem::with(['translations', /* NEW-FIELD-INDEX-METHOD-WITH */]);
        $query->when($request->search, function ($query, $search) {
            $query->whereTranslationLike('name', "%{$search}%");
        });
        $data = $query->orderBy('order')->paginate(Setting::get('pagination'));

        // #VIEW
        return view('admin.testimonialsitems.index', compact('data', 'request'))->withTask(trans('global.view'));
    }

    // #SHOW VIEW
    public function show(Testimonialsitem $testimonialsitem) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('testimonialsitem_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // #NEW-FIELD-SHOW-METHOD-DATA
        // #VIEW
        return view('admin.testimonialsitems.show', compact('testimonialsitem', /* NEW-FIELD-SHOW-METHOD-VIEW */));
    }

    // #CREATE VIEW
    public function create(Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('testimonialsitem_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DATA
        $lang = $this->getLang($request->lang);
        // #NEW-FIELD-CREATE-METHOD-DATA
        // #VIEW
        return view('admin.testimonialsitems.create', compact('lang', /* NEW-FIELD-CREATE-METHOD-VIEW */));
    }

    // #STORE
    public function store(StoreTestimonialsitemRequest $request) {

        // #SAVE DATA
        // #NEW-FIELD-STORE-METHOD-DATA
        $request->merge([/* NEW-FIELD-STORE-METHOD-MERGE */]);
        $testimonialsitem = Testimonialsitem::create($request->all());
        // #NEW-FIELD-STORE-METHOD-SYNC
        // #ADD-STORE-METHOD-GALLERY
        // #ADD-STORE-METHOD-MEDIA
        // #REDIRECT
        return redirect()->route('admin.testimonialsitems.index')->with('message', trans('global.create_success'));
    }

    // #EDIT VIEW
    public function edit(Testimonialsitem $testimonialsitem, Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('testimonialsitem_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $DATA
        $lang = $this->getLang($request->lang);
        // #NEW-FIELD-EDIT-METHOD-DATA
        // #VIEW
        return view('admin.testimonialsitems.edit', compact('testimonialsitem', 'lang', /* NEW-FIELD-EDIT-METHOD-VIEW */));
    }

    // #UPDATE
    public function update(UpdateTestimonialsitemRequest $request, Testimonialsitem $testimonialsitem) {

        // #UPDATE DATA
        // #NEW-FIELD-UPDATE-METHOD-DATA
        $request->merge([/* NEW-FIELD-UPDATE-METHOD-MERGE */]);
        $non_lang = [/* NEW-FIELD-UPDATE-METHOD-NONLANG */];
        $testimonialsitem->update($request->only($non_lang));
        $testimonialsitem->update([$request->lang => $request->except($non_lang)]);
        // #NEW-FIELD-UPDATE-METHOD-SYNC
        // #ADD-UPDATE-METHOD-GALLERY
        // #ADD-UPDATE-METHOD-MEDIA
        // #REDIRECT
        if ($request->action == 1) {
            return back()->with('message', trans('global.update_success'));
        } else {
            return redirect()->route('admin.testimonialsitems.index')->with('message', trans('global.update_success'));
        }
    }

    // #MOVE
    public function move(MoveTestimonialsitemRequest $request, Testimonialsitem $testimonialsitem) {

        // #PARAMETERS
        $type = $request->input('type');
        $order = $request->input('order');

        // #UPDATE
        if ($type == 'move') {
            $testimonialsitem->update(['order' => $order]);
        }
        if ($type == 'moveUp') {
            $testimonialsitem->where('order', $order - 1)->update(['order' => $order]);
            $testimonialsitem->update(['order' => $order - 1]);
        }
        if ($type == 'moveDown') {
            $testimonialsitem->where('order', $order + 1)->update(['order' => $order]);
            $testimonialsitem->update(['order' => $order + 1]);
        }

        // #REDIRECT
        return redirect()->route('admin.testimonialsitems.index');
    }

    // #DELETE
    public function destroy(Testimonialsitem $testimonialsitem) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('testimonialsitem_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DELETE
        $testimonialsitem->delete();

        // #REDIRECT
        return back()->with('message', trans('global.delete_success'));
    }

    // #DELETE
    public function delete(Request $request, Testimonialsitem $testimonialsitem) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('testimonialsitem_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DELETE
        $testimonialsitem->deleteTranslations($request->lang);
        // #ADD-DELETE-METHOD-GALLERY
        // #ADD-DELETE-METHOD-MEDIA

        // #REDIRECT
        return back()->with('message', trans('global.delete_success'));
    }
    
    //#PAGEBUILDER-METHOD

}
