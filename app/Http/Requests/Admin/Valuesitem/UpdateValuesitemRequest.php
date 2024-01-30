<?php

namespace App\Http\Requests\Admin\Valuesitem;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class UpdateValuesitemRequest extends FormRequest {

    public function authorize() {
        return Gate::allows('valuesitem_edit');
    }

    public function rules() {
        return [
            'name' => [
                'between:3,150',
                'required',
                Rule::unique('valuesitems_translations')->where('locale', $this->lang)->ignore($this->valuesitem->id, 'valuesitem_id'),
            ],
                #CRUD-NEW-FIELD
        ];
    }

}
