<?php

namespace App\Http\Requests\Admin\Valuesitem;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class StoreValuesitemRequest extends FormRequest {

    public function authorize() {
        return Gate::allows('valuesitem_create');
    }

    public function rules() {
        return [
            'name' => [
                'between:3,150',
                'required',
                Rule::unique('valuesitems_translations')->where('locale', $this->lang),
            ],
                #CRUD-NEW-FIELD
        ];
    }

}
