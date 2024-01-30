<?php

namespace App\Http\Requests\Admin\Requestsitem;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class StoreRequestsitemRequest extends FormRequest {

    public function authorize() {
        return Gate::allows('requestsitem_create');
    }

    public function rules() {
        return [
            'name' => [
                'between:3,150',
                'required',
                Rule::unique('requestsitems_translations')->where('locale', $this->lang),
            ],
                #CRUD-FIELD-TEXT-START
            'text' => [
                'nullable',
                'max:100000',
                'required',
            ],
                #CRUD-FIELD-TEXT-END
                #CRUD-NEW-FIELD

        ];
    }

}
