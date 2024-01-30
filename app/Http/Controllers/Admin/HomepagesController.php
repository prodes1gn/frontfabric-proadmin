<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Homepage\StoreHomepageRequest;
use App\Http\Requests\Admin\Homepage\UpdateHomepageRequest;
use App\Http\Requests\Admin\Homepage\MoveHomepageRequest;
use App\Models\Homepage;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use JanisKelemen\Setting\Facades\Setting;
use App\Http\Controllers\Traits\Gallery;
use Illuminate\Support\Str;
use Dotlogics\Grapesjs\App\Traits\EditorTrait;
#NEW-FIELD-USE-MODEL

class HomepagesController extends AdminController {

    use EditorTrait;
    use Gallery;
    #NEW-FIELD-USED-MODEL

    // #SET TITLE
    protected $title = 'homepage';

    // #EDIT VIEW
    public function edit(Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('homepage_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #MODEL
        $homepage = Homepage::first();
        // $DATA
        $lang = $this->getLang($request->lang);
        // #NEW-FIELD-EDIT-METHOD-DATA
        $seotypes = array('article' => trans('global.article'), 'product' => trans('global.product'), 'page' => trans('global.page'));
        // #VIEW
        return view('admin.homepages.edit', compact('homepage', 'lang', 'seotypes', /* NEW-FIELD-EDIT-METHOD-VIEW */));
    }

    // #UPDATE
    public function update(UpdateHomepageRequest $request) {

        // #MODEL
        $homepage = Homepage::first();
        // #UPDATE DATA
        // #NEW-FIELD-UPDATE-METHOD-DATA
        $this->slugMake($request, 'slug');
        $request->merge([/* NEW-FIELD-UPDATE-METHOD-MERGE */]);
        $non_lang = [/* NEW-FIELD-UPDATE-METHOD-NONLANG */];
        $homepage->update($request->only($non_lang));
        $homepage->update([$request->lang => $request->except($non_lang)]);
        // #NEW-FIELD-UPDATE-METHOD-SYNC
        // #ADD-UPDATE-METHOD-GALLERY
        // #CRUD-FIELD-SEOIMAGE-START
        $this->updateImage($homepage, $request, 'seoimage', 'seoimage-' . $request->lang);
        // #CRUD-FIELD-SEOIMAGE-END
        // #CRUD-FIELD-HEROIMAGE-START
        $this->updateImage($homepage, $request, 'heroimage', 'heroimage-' . $request->lang);
        // #CRUD-FIELD-HEROIMAGE-END
        // #ADD-UPDATE-METHOD-MEDIA
        // #REDIRECT
        return back()->with('message', trans('global.update_success'));
    }

    
    // #DELETE
    public function delete(Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('homepage_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #MODEL
        $homepage = Homepage::first();
        
        // #DELETE
        $homepage->deleteTranslations($request->lang);
        // #ADD-DELETE-METHOD-GALLERY
        $homepage->clearMediaCollection('seoimage-' . $request->lang);
        $homepage->clearMediaCollection('heroimage-' . $request->lang);
        // #ADD-DELETE-METHOD-MEDIA
        
        // #REDIRECT
        return redirect()->route('admin.homepages.edit', 1)->with('message', trans('global.delete_success'));
    }
    
    //#PAGEBUILDER-METHOD

}
