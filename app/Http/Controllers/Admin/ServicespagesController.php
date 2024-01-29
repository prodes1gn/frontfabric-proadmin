<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Servicespage\StoreServicespageRequest;
use App\Http\Requests\Admin\Servicespage\UpdateServicespageRequest;
use App\Http\Requests\Admin\Servicespage\MoveServicespageRequest;
use App\Models\Servicespage;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use JanisKelemen\Setting\Facades\Setting;
use App\Http\Controllers\Traits\Gallery;
use Illuminate\Support\Str;
use Dotlogics\Grapesjs\App\Traits\EditorTrait;
#NEW-FIELD-USE-MODEL

class ServicespagesController extends AdminController {

    use EditorTrait;
    use Gallery;
    #NEW-FIELD-USED-MODEL

    // #SET TITLE
    protected $title = 'servicespage';

    // #EDIT VIEW
    public function edit(Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('servicespage_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #MODEL
        $servicespage = Servicespage::first();
        // $DATA
        $lang = $this->getLang($request->lang);
        // #NEW-FIELD-EDIT-METHOD-DATA
        $seotypes = array('article' => trans('global.article'), 'product' => trans('global.product'), 'page' => trans('global.page'));
        // #VIEW
        return view('admin.servicespages.edit', compact('servicespage', 'lang', 'seotypes', /* NEW-FIELD-EDIT-METHOD-VIEW */));
    }

    // #UPDATE
    public function update(UpdateServicespageRequest $request) {

        // #MODEL
        $servicespage = Servicespage::first();
        // #UPDATE DATA
        // #NEW-FIELD-UPDATE-METHOD-DATA
        $this->slugMake($request, 'slug');
        $request->merge([/* NEW-FIELD-UPDATE-METHOD-MERGE */]);
        $non_lang = [/* NEW-FIELD-UPDATE-METHOD-NONLANG */];
        $servicespage->update($request->only($non_lang));
        $servicespage->update([$request->lang => $request->except($non_lang)]);
        // #NEW-FIELD-UPDATE-METHOD-SYNC
        // #ADD-UPDATE-METHOD-GALLERY
        // #CRUD-FIELD-SEOIMAGE-START
        $this->updateImage($servicespage, $request, 'seoimage', 'seoimage-' . $request->lang);
        // #CRUD-FIELD-SEOIMAGE-END
        // #ADD-UPDATE-METHOD-MEDIA
        // #REDIRECT
        return back()->with('message', trans('global.update_success'));
    }

    
    // #DELETE
    public function delete(Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('servicespage_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #MODEL
        $servicespage = Servicespage::first();
        
        // #DELETE
        $servicespage->deleteTranslations($request->lang);
        // #ADD-DELETE-METHOD-GALLERY
        $servicespage->clearMediaCollection('seoimage-' . $request->lang);
        // #ADD-DELETE-METHOD-MEDIA
        
        // #REDIRECT
        return redirect()->route('admin.servicespages.edit', 1)->with('message', trans('global.delete_success'));
    }
    
    //#PAGEBUILDER-METHOD

}
