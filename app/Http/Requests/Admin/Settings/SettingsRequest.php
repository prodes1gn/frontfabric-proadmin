<?php

namespace App\Http\Requests\Admin\Settings;

use App\Models\Permission;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class SettingsRequest extends FormRequest {

    public function authorize() {
        return Gate::allows('settings_access');
    }

    public function rules() {

        $rules = [
            'pagination' => [
                'integer',
                'min:5',
                'max:100',
                'required',
            ],
            'theme_aside_enable' => [
                'boolean',
                'required',
            ],
            'aside_minimize' => [
                'boolean',
                'required',
            ],
            'theme_breadcrumbs' => [
                'boolean',
                'required',
            ],
            'theme_header_menu' => [
                'boolean',
                'required',
            ],
            'twofa_by_email' => [
                'boolean',
                'required',
            ],
            'theme_aside' => [
                'required',
            ],
            'theme_header' => [
                'required',
            ],
        ];

        return $rules;
    }

}
