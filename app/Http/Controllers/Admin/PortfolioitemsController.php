<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Portfolioitem\StorePortfolioitemRequest;
use App\Http\Requests\Admin\Portfolioitem\UpdatePortfolioitemRequest;
use App\Http\Requests\Admin\Portfolioitem\MovePortfolioitemRequest;
use App\Models\Portfolioitem;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use JanisKelemen\Setting\Facades\Setting;
use App\Http\Controllers\Traits\Gallery;
use Illuminate\Support\Str;
use Dotlogics\Grapesjs\App\Traits\EditorTrait;
use App\Models\ServiceitemTranslation;
#NEW-FIELD-USE-MODEL

class PortfolioitemsController extends AdminController {
    
    use EditorTrait;
    use Gallery;
    #NEW-FIELD-USED-MODEL

    // #SET TITLE
    protected $title = 'portfolioitem';

    // #LISTING
    public function index(Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('portfolioitem_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #QUERY
        $query = Portfolioitem::with(['translations', /* NEW-FIELD-INDEX-METHOD-WITH */]);
        $query->when($request->search, function ($query, $search) {
            $query->whereTranslationLike('name', "%{$search}%");
        });
        $data = $query->orderBy('order')->paginate(Setting::get('pagination'));

        // #VIEW
        return view('admin.portfolioitems.index', compact('data', 'request'))->withTask(trans('global.view'));
    }

    // #SHOW VIEW
    public function show(Portfolioitem $portfolioitem) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('portfolioitem_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // #NEW-FIELD-SHOW-METHOD-DATA
        $seotypes = array('article' => trans('global.article'), 'product' => trans('global.product'), 'page' => trans('global.page'));
        // #VIEW
        return view('admin.portfolioitems.show', compact('portfolioitem', 'seotypes', /* NEW-FIELD-SHOW-METHOD-VIEW */));
    }

    // #CREATE VIEW
    public function create(Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('portfolioitem_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DATA
        $lang = $this->getLang($request->lang);
        // #NEW-FIELD-CREATE-METHOD-DATA
        $servicedropdowns = ServiceitemTranslation::where('locale', $lang)->pluck('name', 'serviceitem_id');
        $seotypes = array('article' => trans('global.article'), 'product' => trans('global.product'), 'page' => trans('global.page'));
        // #VIEW
        return view('admin.portfolioitems.create', compact('lang', 'seotypes', 'servicedropdowns', /* NEW-FIELD-CREATE-METHOD-VIEW */));
    }

    // #STORE
    public function store(StorePortfolioitemRequest $request) {

        // #SAVE DATA
        // #NEW-FIELD-STORE-METHOD-DATA
        $this->slugMake($request, 'slug');
        $request->merge([/* NEW-FIELD-STORE-METHOD-MERGE */]);
        $portfolioitem = Portfolioitem::create($request->all());
        // // #NEW-FIELD-STORE-METHOD-SYNC
        $portfolioitem->servicedropdown()->sync($request->input('servicedropdown', []));
        // #ADD-STORE-METHOD-GALLERY
        // #CRUD-FIELD-SEOIMAGE-START
        $this->storeImage($portfolioitem, $request, 'seoimage', 'seoimage-' . $request->lang);
        // #CRUD-FIELD-SEOIMAGE-END
        // #CRUD-FIELD-IMAGE-START
        $this->storeImage($portfolioitem, $request, 'image', 'image-' . $request->lang);
        // #CRUD-FIELD-IMAGE-END
        // #ADD-STORE-METHOD-MEDIA
        // #REDIRECT
        return redirect()->route('admin.portfolioitems.index')->with('message', trans('global.create_success'));
    }

    // #EDIT VIEW
    public function edit(Portfolioitem $portfolioitem, Request $request) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('portfolioitem_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $DATA
        $lang = $this->getLang($request->lang);
        // #NEW-FIELD-EDIT-METHOD-DATA
        $servicedropdowns = ServiceitemTranslation::where('locale', $lang)->pluck('name', 'serviceitem_id');
        $seotypes = array('article' => trans('global.article'), 'product' => trans('global.product'), 'page' => trans('global.page'));
        // #VIEW
        return view('admin.portfolioitems.edit', compact('portfolioitem', 'lang', 'seotypes', 'servicedropdowns', /* NEW-FIELD-EDIT-METHOD-VIEW */));
    }

    // #UPDATE
    public function update(UpdatePortfolioitemRequest $request, Portfolioitem $portfolioitem) {

        // #UPDATE DATA
        // #NEW-FIELD-UPDATE-METHOD-DATA
        $this->slugMake($request, 'slug');
        $request->merge([/* NEW-FIELD-UPDATE-METHOD-MERGE */]);
        $non_lang = [/* NEW-FIELD-UPDATE-METHOD-NONLANG */];
        $portfolioitem->update($request->only($non_lang));
        $portfolioitem->update([$request->lang => $request->except($non_lang)]);
        // // #NEW-FIELD-UPDATE-METHOD-SYNC
        $portfolioitem->servicedropdown()->sync($request->input('servicedropdown', []));
        // #ADD-UPDATE-METHOD-GALLERY
        // #CRUD-FIELD-SEOIMAGE-START
        $this->updateImage($portfolioitem, $request, 'seoimage', 'seoimage-' . $request->lang);
        // #CRUD-FIELD-SEOIMAGE-END
        // #CRUD-FIELD-IMAGE-START
        $this->updateImage($portfolioitem, $request, 'image', 'image-' . $request->lang);
        // #CRUD-FIELD-IMAGE-END
        // #ADD-UPDATE-METHOD-MEDIA
        // #REDIRECT
        if ($request->action == 1) {
            return back()->with('message', trans('global.update_success'));
        } else {
            return redirect()->route('admin.portfolioitems.index')->with('message', trans('global.update_success'));
        }
    }

    // #MOVE
    public function move(MovePortfolioitemRequest $request, Portfolioitem $portfolioitem) {

        // #PARAMETERS
        $type = $request->input('type');
        $order = $request->input('order');

        // #UPDATE
        if ($type == 'move') {
            $portfolioitem->update(['order' => $order]);
        }
        if ($type == 'moveUp') {
            $portfolioitem->where('order', $order - 1)->update(['order' => $order]);
            $portfolioitem->update(['order' => $order - 1]);
        }
        if ($type == 'moveDown') {
            $portfolioitem->where('order', $order + 1)->update(['order' => $order]);
            $portfolioitem->update(['order' => $order + 1]);
        }

        // #REDIRECT
        return redirect()->route('admin.portfolioitems.index');
    }

    // #DELETE
    public function destroy(Portfolioitem $portfolioitem) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('portfolioitem_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DELETE
        $portfolioitem->delete();

        // #REDIRECT
        return back()->with('message', trans('global.delete_success'));
    }

    // #DELETE
    public function delete(Request $request, Portfolioitem $portfolioitem) {

        // #CHECK PERMISSIONS
        abort_if(Gate::denies('portfolioitem_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // #DELETE
        $portfolioitem->deleteTranslations($request->lang);
        // #ADD-DELETE-METHOD-GALLERY
        $portfolioitem->clearMediaCollection('seoimage-' . $request->lang);
        $portfolioitem->clearMediaCollection('image-' . $request->lang);
        // #ADD-DELETE-METHOD-MEDIA

        // #REDIRECT
        return back()->with('message', trans('global.delete_success'));
    }
    
    //#PAGEBUILDER-METHOD

}
