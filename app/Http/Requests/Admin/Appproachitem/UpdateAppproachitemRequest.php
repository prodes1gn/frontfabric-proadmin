<?php

namespace App\Http\Requests\Admin\Appproachitem;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class UpdateAppproachitemRequest extends FormRequest {

    public function authorize() {
        return Gate::allows('appproachitem_edit');
    }

    public function rules() {
        return [
            'name' => [
                'between:3,150',
                'required',
                Rule::unique('appproachitems_translations')->where('locale', $this->lang)->ignore($this->appproachitem->id, 'appproachitem_id'),
            ],
                #CRUD-NEW-FIELD
        ];
    }

}
