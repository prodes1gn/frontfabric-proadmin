<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Blogcategoryitem\StoreBlogcategoryitemRequest;
use App\Http\Requests\Admin\Blogcategoryitem\UpdateBlogcategoryitemRequest;
use App\Http\Requests\Admin\Blogcategoryitem\MoveBlogcategoryitemRequest;
use App\Models\Blogcategoryitem;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use JanisKelemen\Setting\Facades\Setting;
use App\Http\Controllers\Traits\Gallery;
use Illuminate\Support\Str;
use Dotlogics\Grapesjs\App\Traits\EditorTrait;
#NEW-FIELD-USE-MODEL

class BlogcategoryitemsController extends AdminController {
    
    use EditorTrait;
    use Gallery;
    #NEW-FIELD-USED-MODEL

    // #SET TITLE
    protected $title = 'blogcategoryitem';

    // #LISTING
    public function index(Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('blogcategoryitem_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #QUERY
        $query = Blogcategoryitem::with(['translations', /* NEW-FIELD-INDEX-METHOD-WITH */]);
        $query->when($request->search, function ($query, $search) {
            $query->whereTranslationLike('name', "%{$search}%");
        });
        $data = $query->orderBy('order')->paginate(Setting::get('pagination'));

        // #VIEW
        return view('admin.blogcategoryitems.index', compact('data', 'request'))->withTask(trans('global.view'));
    }

    // #SHOW VIEW
    public function show(Blogcategoryitem $blogcategoryitem) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('blogcategoryitem_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // #NEW-FIELD-SHOW-METHOD-DATA
        // #VIEW
        return view('admin.blogcategoryitems.show', compact('blogcategoryitem', /* NEW-FIELD-SHOW-METHOD-VIEW */));
    }

    // #CREATE VIEW
    public function create(Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('blogcategoryitem_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DATA
        $lang = $this->getLang($request->lang);
        // #NEW-FIELD-CREATE-METHOD-DATA
        // #VIEW
        return view('admin.blogcategoryitems.create', compact('lang', /* NEW-FIELD-CREATE-METHOD-VIEW */));
    }

    // #STORE
    public function store(StoreBlogcategoryitemRequest $request) {

        // #SAVE DATA
        // #NEW-FIELD-STORE-METHOD-DATA
        $request->merge([/* NEW-FIELD-STORE-METHOD-MERGE */]);
        $blogcategoryitem = Blogcategoryitem::create($request->all());
        // #NEW-FIELD-STORE-METHOD-SYNC
        // #ADD-STORE-METHOD-GALLERY
        // #ADD-STORE-METHOD-MEDIA
        // #REDIRECT
        return redirect()->route('admin.blogcategoryitems.index')->with('message', trans('global.create_success'));
    }

    // #EDIT VIEW
    public function edit(Blogcategoryitem $blogcategoryitem, Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('blogcategoryitem_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $DATA
        $lang = $this->getLang($request->lang);
        // #NEW-FIELD-EDIT-METHOD-DATA
        // #VIEW
        return view('admin.blogcategoryitems.edit', compact('blogcategoryitem', 'lang', /* NEW-FIELD-EDIT-METHOD-VIEW */));
    }

    // #UPDATE
    public function update(UpdateBlogcategoryitemRequest $request, Blogcategoryitem $blogcategoryitem) {

        // #UPDATE DATA
        // #NEW-FIELD-UPDATE-METHOD-DATA
        $request->merge([/* NEW-FIELD-UPDATE-METHOD-MERGE */]);
        $non_lang = [/* NEW-FIELD-UPDATE-METHOD-NONLANG */];
        $blogcategoryitem->update($request->only($non_lang));
        $blogcategoryitem->update([$request->lang => $request->except($non_lang)]);
        // #NEW-FIELD-UPDATE-METHOD-SYNC
        // #ADD-UPDATE-METHOD-GALLERY
        // #ADD-UPDATE-METHOD-MEDIA
        // #REDIRECT
        if ($request->action == 1) {
            return back()->with('message', trans('global.update_success'));
        } else {
            return redirect()->route('admin.blogcategoryitems.index')->with('message', trans('global.update_success'));
        }
    }

    // #MOVE
    public function move(MoveBlogcategoryitemRequest $request, Blogcategoryitem $blogcategoryitem) {

        // #PARAMETERS
        $type = $request->input('type');
        $order = $request->input('order');

        // #UPDATE
        if ($type == 'move') {
            $blogcategoryitem->update(['order' => $order]);
        }
        if ($type == 'moveUp') {
            $blogcategoryitem->where('order', $order - 1)->update(['order' => $order]);
            $blogcategoryitem->update(['order' => $order - 1]);
        }
        if ($type == 'moveDown') {
            $blogcategoryitem->where('order', $order + 1)->update(['order' => $order]);
            $blogcategoryitem->update(['order' => $order + 1]);
        }

        // #REDIRECT
        return redirect()->route('admin.blogcategoryitems.index');
    }

    // #DELETE
    public function destroy(Blogcategoryitem $blogcategoryitem) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('blogcategoryitem_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DELETE
        $blogcategoryitem->delete();

        // #REDIRECT
        return back()->with('message', trans('global.delete_success'));
    }

    // #DELETE
    public function delete(Request $request, Blogcategoryitem $blogcategoryitem) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('blogcategoryitem_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DELETE
        $blogcategoryitem->deleteTranslations($request->lang);
        // #ADD-DELETE-METHOD-GALLERY
        // #ADD-DELETE-METHOD-MEDIA

        // #REDIRECT
        return back()->with('message', trans('global.delete_success'));
    }
    
    //#PAGEBUILDER-METHOD

}
