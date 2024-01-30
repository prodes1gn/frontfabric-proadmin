<?php

namespace App\Http\Requests\Admin\Servicepointitem;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class StoreServicepointitemRequest extends FormRequest {

    public function authorize() {
        return Gate::allows('servicepointitem_create');
    }

    public function rules() {
        return [
            'name' => [
                'between:3,150',
                'required',
                Rule::unique('servicepointitems_translations')->where('locale', $this->lang),
            ],
                #CRUD-FIELD-TEXT-START
            'text' => [
                'nullable',
                'max:255',
                'required',
            ],
                #CRUD-FIELD-TEXT-END
                #CRUD-NEW-FIELD

        ];
    }

}
