<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Blogpage\StoreBlogpageRequest;
use App\Http\Requests\Admin\Blogpage\UpdateBlogpageRequest;
use App\Http\Requests\Admin\Blogpage\MoveBlogpageRequest;
use App\Models\Blogpage;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use JanisKelemen\Setting\Facades\Setting;
use App\Http\Controllers\Traits\Gallery;
use Illuminate\Support\Str;
use Dotlogics\Grapesjs\App\Traits\EditorTrait;
#NEW-FIELD-USE-MODEL

class BlogpagesController extends AdminController {

    use EditorTrait;
    use Gallery;
    #NEW-FIELD-USED-MODEL

    // #SET TITLE
    protected $title = 'blogpage';

    // #EDIT VIEW
    public function edit(Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('blogpage_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #MODEL
        $blogpage = Blogpage::first();
        // $DATA
        $lang = $this->getLang($request->lang);
        // #NEW-FIELD-EDIT-METHOD-DATA
        $seotypes = array('article' => trans('global.article'), 'product' => trans('global.product'), 'page' => trans('global.page'));
        // #VIEW
        return view('admin.blogpages.edit', compact('blogpage', 'lang', 'seotypes', /* NEW-FIELD-EDIT-METHOD-VIEW */));
    }

    // #UPDATE
    public function update(UpdateBlogpageRequest $request) {

        // #MODEL
        $blogpage = Blogpage::first();
        // #UPDATE DATA
        // #NEW-FIELD-UPDATE-METHOD-DATA
        $this->slugMake($request, 'slug');
        $request->merge([/* NEW-FIELD-UPDATE-METHOD-MERGE */]);
        $non_lang = [/* NEW-FIELD-UPDATE-METHOD-NONLANG */];
        $blogpage->update($request->only($non_lang));
        $blogpage->update([$request->lang => $request->except($non_lang)]);
        // #NEW-FIELD-UPDATE-METHOD-SYNC
        // #ADD-UPDATE-METHOD-GALLERY
        // #CRUD-FIELD-SEOIMAGE-START
        $this->updateImage($blogpage, $request, 'seoimage', 'seoimage-' . $request->lang);
        // #CRUD-FIELD-SEOIMAGE-END
        // #ADD-UPDATE-METHOD-MEDIA
        // #REDIRECT
        return back()->with('message', trans('global.update_success'));
    }

    
    // #DELETE
    public function delete(Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('blogpage_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #MODEL
        $blogpage = Blogpage::first();
        
        // #DELETE
        $blogpage->deleteTranslations($request->lang);
        // #ADD-DELETE-METHOD-GALLERY
        $blogpage->clearMediaCollection('seoimage-' . $request->lang);
        // #ADD-DELETE-METHOD-MEDIA
        
        // #REDIRECT
        return redirect()->route('admin.blogpages.edit', 1)->with('message', trans('global.delete_success'));
    }
    
    //#PAGEBUILDER-METHOD

}
