<?php

namespace App\Cms;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\File;

class Cms {

    // @SET LANG PREFIX
    public function setLang() {

        // #GET AVAILABLE LANGUAGES
        $available = config('translatable.locales');

        // #GET FIRST URL SEGMENT
        $locale = Request::segment(1);

        // #CHECK LOCALE EXIST
        if (!in_array($locale, $available)) {
            $locale = null;
            app()->setLocale(config('translatable.locale'));
        } else {
            app()->setLocale($locale);
        }

        // #OUTPUT
        return $locale;
    }

    // @CHECK IS MULTILANUAGE WEBSITE
    public function isMulitLang() {

        // #GET AVAILABLE LANGUAGES
        $languages = config('translatable.locales');

        // #CHECK LOCALE EXIST
        if (is_array($languages) && count($languages) > 1) {
            return true;
        } else {
            return false;
        }
        
    }

    // #GET CURRRNT LANGUAGE
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

    // #SHOW IMG PATH
    public function img($model = null, $collection = null, $thumb = false) {
        if (!is_null($model) && $model->getMedia($collection)->first() != null && File::exists($model->getMedia($collection)->first()->getPath())) {
            if ($thumb == false) {
                $output = $model->getMedia($collection)->first()->getUrl();
            } else {
                $output = $model->getMedia($collection)->first()->getUrl('thumb');
            }
        } else {
            $output = asset('uploads/settings/placeholder.png');
        }
        return $output;
    }

    // #SHOW FILE PATH
    public function file($model = null, $collection = null) {
        if (!is_null($model) && $model->getMedia($collection)->first() != null && File::exists($model->getMedia($collection)->first()->getPath())) {
                $output = $model->getMedia($collection)->first()->getUrl();
        } else {
            $output = trans('global.choose');
        }
        return $output;
    }
}
