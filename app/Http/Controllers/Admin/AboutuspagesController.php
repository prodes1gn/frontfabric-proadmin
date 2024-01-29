<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Aboutuspage\StoreAboutuspageRequest;
use App\Http\Requests\Admin\Aboutuspage\UpdateAboutuspageRequest;
use App\Http\Requests\Admin\Aboutuspage\MoveAboutuspageRequest;
use App\Models\Aboutuspage;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use JanisKelemen\Setting\Facades\Setting;
use App\Http\Controllers\Traits\Gallery;
use Illuminate\Support\Str;
use Dotlogics\Grapesjs\App\Traits\EditorTrait;
#NEW-FIELD-USE-MODEL

class AboutuspagesController extends AdminController {

    use EditorTrait;
    use Gallery;
    #NEW-FIELD-USED-MODEL

    // #SET TITLE
    protected $title = 'aboutuspage';

    // #EDIT VIEW
    public function edit(Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('aboutuspage_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #MODEL
        $aboutuspage = Aboutuspage::first();
        // $DATA
        $lang = $this->getLang($request->lang);
        // #NEW-FIELD-EDIT-METHOD-DATA
        $seotypes = array('article' => trans('global.article'), 'product' => trans('global.product'), 'page' => trans('global.page'));
        // #VIEW
        return view('admin.aboutuspages.edit', compact('aboutuspage', 'lang', 'seotypes', /* NEW-FIELD-EDIT-METHOD-VIEW */));
    }

    // #UPDATE
    public function update(UpdateAboutuspageRequest $request) {

        // #MODEL
        $aboutuspage = Aboutuspage::first();
        // #UPDATE DATA
        // #NEW-FIELD-UPDATE-METHOD-DATA
        $this->slugMake($request, 'slug');
        $request->merge([/* NEW-FIELD-UPDATE-METHOD-MERGE */]);
        $non_lang = [/* NEW-FIELD-UPDATE-METHOD-NONLANG */];
        $aboutuspage->update($request->only($non_lang));
        $aboutuspage->update([$request->lang => $request->except($non_lang)]);
        // #NEW-FIELD-UPDATE-METHOD-SYNC
        // #ADD-UPDATE-METHOD-GALLERY
        // #CRUD-FIELD-SEOIMAGE-START
        $this->updateImage($aboutuspage, $request, 'seoimage', 'seoimage-' . $request->lang);
        // #CRUD-FIELD-SEOIMAGE-END
        // #ADD-UPDATE-METHOD-MEDIA
        // #REDIRECT
        return back()->with('message', trans('global.update_success'));
    }

    
    // #DELETE
    public function delete(Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('aboutuspage_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #MODEL
        $aboutuspage = Aboutuspage::first();
        
        // #DELETE
        $aboutuspage->deleteTranslations($request->lang);
        // #ADD-DELETE-METHOD-GALLERY
        $aboutuspage->clearMediaCollection('seoimage-' . $request->lang);
        // #ADD-DELETE-METHOD-MEDIA
        
        // #REDIRECT
        return redirect()->route('admin.aboutuspages.edit', 1)->with('message', trans('global.delete_success'));
    }
    
    //#PAGEBUILDER-METHOD

}
