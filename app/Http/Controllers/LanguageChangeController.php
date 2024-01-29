<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageChangeController extends Controller
{
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

    public function changeLanguage(Request $request, $new_lang = null) {
        $newlang = $this->getLang($new_lang);
    	$path = $request->path;

        return redirect($path)->with('lang', $newlang);
    }
}
