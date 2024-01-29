<?php

namespace App\Http\Requests\Admin\Appproachitem;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class StoreAppproachitemRequest extends FormRequest {

    public function authorize() {
        return Gate::allows('appproachitem_create');
    }

    public function rules() {
        return [
            'name' => [
                'between:3,150',
                'required',
                Rule::unique('appproachitems_translations')->where('locale', $this->lang),
            ],
                #CRUD-NEW-FIELD
        ];
    }

}
