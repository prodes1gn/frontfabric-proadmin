<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Blogitem\StoreBlogitemRequest;
use App\Http\Requests\Admin\Blogitem\UpdateBlogitemRequest;
use App\Http\Requests\Admin\Blogitem\MoveBlogitemRequest;
use App\Models\Blogitem;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use JanisKelemen\Setting\Facades\Setting;
use App\Http\Controllers\Traits\Gallery;
use Illuminate\Support\Str;
use Dotlogics\Grapesjs\App\Traits\EditorTrait;
#NEW-FIELD-USE-MODEL

class BlogitemsController extends AdminController {
    
    use EditorTrait;
    use Gallery;
    #NEW-FIELD-USED-MODEL

    // #SET TITLE
    protected $title = 'blogitem';

    // #LISTING
    public function index(Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('blogitem_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #QUERY
        $query = Blogitem::with(['translations', /* NEW-FIELD-INDEX-METHOD-WITH */]);
        $query->when($request->search, function ($query, $search) {
            $query->whereTranslationLike('name', "%{$search}%");
        });
        $data = $query->orderBy('order')->paginate(Setting::get('pagination'));

        // #VIEW
        return view('admin.blogitems.index', compact('data', 'request'))->withTask(trans('global.view'));
    }

    // #SHOW VIEW
    public function show(Blogitem $blogitem) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('blogitem_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // #NEW-FIELD-SHOW-METHOD-DATA
        $seotypes = array('article' => trans('global.article'), 'product' => trans('global.product'), 'page' => trans('global.page'));
        // #VIEW
        return view('admin.blogitems.show', compact('blogitem', 'seotypes', /* NEW-FIELD-SHOW-METHOD-VIEW */));
    }

    // #CREATE VIEW
    public function create(Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('blogitem_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DATA
        $lang = $this->getLang($request->lang);
        // #NEW-FIELD-CREATE-METHOD-DATA
        $seotypes = array('article' => trans('global.article'), 'product' => trans('global.product'), 'page' => trans('global.page'));
        // #VIEW
        return view('admin.blogitems.create', compact('lang', 'seotypes', /* NEW-FIELD-CREATE-METHOD-VIEW */));
    }

    // #STORE
    public function store(StoreBlogitemRequest $request) {

        // #SAVE DATA
        // #NEW-FIELD-STORE-METHOD-DATA
        $this->slugMake($request, 'slug');
        $request->merge([/* NEW-FIELD-STORE-METHOD-MERGE */]);
        $blogitem = Blogitem::create($request->all());
        // #NEW-FIELD-STORE-METHOD-SYNC
        // #ADD-STORE-METHOD-GALLERY
        // #CRUD-FIELD-SEOIMAGE-START
        $this->storeImage($blogitem, $request, 'seoimage', 'seoimage-' . $request->lang);
        // #CRUD-FIELD-SEOIMAGE-END
        // #ADD-STORE-METHOD-MEDIA
        // #REDIRECT
        return redirect()->route('admin.blogitems.index')->with('message', trans('global.create_success'));
    }

    // #EDIT VIEW
    public function edit(Blogitem $blogitem, Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('blogitem_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $DATA
        $lang = $this->getLang($request->lang);
        // #NEW-FIELD-EDIT-METHOD-DATA
        $seotypes = array('article' => trans('global.article'), 'product' => trans('global.product'), 'page' => trans('global.page'));
        // #VIEW
        return view('admin.blogitems.edit', compact('blogitem', 'lang', 'seotypes', /* NEW-FIELD-EDIT-METHOD-VIEW */));
    }

    // #UPDATE
    public function update(UpdateBlogitemRequest $request, Blogitem $blogitem) {

        // #UPDATE DATA
        // #NEW-FIELD-UPDATE-METHOD-DATA
        $this->slugMake($request, 'slug');
        $request->merge([/* NEW-FIELD-UPDATE-METHOD-MERGE */]);
        $non_lang = [/* NEW-FIELD-UPDATE-METHOD-NONLANG */];
        $blogitem->update($request->only($non_lang));
        $blogitem->update([$request->lang => $request->except($non_lang)]);
        // #NEW-FIELD-UPDATE-METHOD-SYNC
        // #ADD-UPDATE-METHOD-GALLERY
        // #CRUD-FIELD-SEOIMAGE-START
        $this->updateImage($blogitem, $request, 'seoimage', 'seoimage-' . $request->lang);
        // #CRUD-FIELD-SEOIMAGE-END
        // #ADD-UPDATE-METHOD-MEDIA
        // #REDIRECT
        if ($request->action == 1) {
            return back()->with('message', trans('global.update_success'));
        } else {
            return redirect()->route('admin.blogitems.index')->with('message', trans('global.update_success'));
        }
    }

    // #MOVE
    public function move(MoveBlogitemRequest $request, Blogitem $blogitem) {

        // #PARAMETERS
        $type = $request->input('type');
        $order = $request->input('order');

        // #UPDATE
        if ($type == 'move') {
            $blogitem->update(['order' => $order]);
        }
        if ($type == 'moveUp') {
            $blogitem->where('order', $order - 1)->update(['order' => $order]);
            $blogitem->update(['order' => $order - 1]);
        }
        if ($type == 'moveDown') {
            $blogitem->where('order', $order + 1)->update(['order' => $order]);
            $blogitem->update(['order' => $order + 1]);
        }

        // #REDIRECT
        return redirect()->route('admin.blogitems.index');
    }

    // #DELETE
    public function destroy(Blogitem $blogitem) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('blogitem_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DELETE
        $blogitem->delete();

        // #REDIRECT
        return back()->with('message', trans('global.delete_success'));
    }

    // #DELETE
    public function delete(Request $request, Blogitem $blogitem) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('blogitem_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DELETE
        $blogitem->deleteTranslations($request->lang);
        // #ADD-DELETE-METHOD-GALLERY
        $blogitem->clearMediaCollection('seoimage-' . $request->lang);
        // #ADD-DELETE-METHOD-MEDIA

        // #REDIRECT
        return back()->with('message', trans('global.delete_success'));
    }
    
    //#PAGEBUILDER-METHOD

}
