<?php

namespace App\Http\Requests\Admin\Requestsitem;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class UpdateRequestsitemRequest extends FormRequest {

    public function authorize() {
        return Gate::allows('requestsitem_edit');
    }

    public function rules() {
        return [
            'name' => [
                'between:3,150',
                'required',
                Rule::unique('requestsitems_translations')->where('locale', $this->lang)->ignore($this->requestsitem->id, 'requestsitem_id'),
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
