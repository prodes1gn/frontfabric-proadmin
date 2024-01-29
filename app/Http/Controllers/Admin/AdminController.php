<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    // #SET CONSTRUCT
    public function __construct() {
        $this->middleware(function ($request, $next) {
            View::share('title', trans('cruds.' . $this->title . 's'));
            View::share('task', trans('global.' . request()->route()->getActionMethod()));
            return $next($request);
        });
    }

    // #GET LANGUAGE
    public function getLang($lang = null) {

        // #GET AVAILABLE LANGUAGES
        $languages = config('translatable.locales');

        // #GET FIRST URL SEGMENT
        $default = config('translatable.locale');

        // #CHECK LOCALE EXIST
        if (is_array($languages) && count($languages) > 1 && in_array($lang, $languages)) {
            return $lang;
        } else {
            return $default;
        }
    }

    // #CREATE SLUG
    public function slugMake($request, $field = null) {
        if ($request->$field == null) {
            $request[$field] = Str::slug($request->name);
        } else {
            $request[$field] = Str::slug($request->$field);
        }
    }

    // #STORE IMAGE
    public function storeImage($model, $request, $field, $collection) {
        if ($request->input($field, false)) {
            $model->addMedia(storage_path('tmp/uploads/' . basename($request->input($field))))->withResponsiveImages()->usingName($model->name)->toMediaCollection($collection);
        }
    }

    // #UPDATE IMAGE
    public function updateImage($model, $request, $field, $collection) {
        if ($request->input($field, false)) {
            if (!$model->$field || $request->input($field) !== $model->$field->file_name) {
                if ($model->$field) {
                    $model->$field->delete();
                }
                $model->addMedia(storage_path('tmp/uploads/' . basename($request->input($field))))->withResponsiveImages()->usingName($model->name)->toMediaCollection($collection);
            }
        } elseif ($model->$field) {
            $model->$field->delete();
        }
    }

    // #STORE GALLERY
    public function storeGallery($model, $request, $field, $collection) {
        foreach ($request->input($field, []) as $file) {
            $model->addMedia(storage_path('tmp/uploads/' . basename($file)))->withResponsiveImages()->usingName($model->name)->toMediaCollection($collection);
        }
    }

    // #UPDATE GALLERY
    public function updateGallery($model, $request, $field, $collection) {
        if (count($model->$field) > 0) {
            foreach ($model->$field as $media) {
                if (!in_array($media->file_name, $request->input($field, []))) {
                    $media->delete();
                }
            }
        }
        $media = $model->$field->pluck('file_name')->toArray();
        foreach ($request->input($field, []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $model->addMedia(storage_path('tmp/uploads/' . basename($file)))->withResponsiveImages()->usingName($model->name)->toMediaCollection($collection);
            }
        }
    }

}
