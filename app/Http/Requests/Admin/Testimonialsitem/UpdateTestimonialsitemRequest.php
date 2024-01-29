<?php

namespace App\Http\Requests\Admin\Testimonialsitem;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class UpdateTestimonialsitemRequest extends FormRequest {

    public function authorize() {
        return Gate::allows('testimonialsitem_edit');
    }

    public function rules() {
        return [
            'name' => [
                'between:3,150',
                'required',
                Rule::unique('testimonialsitems_translations')->where('locale', $this->lang)->ignore($this->testimonialsitem->id, 'testimonialsitem_id'),
            ],
                #CRUD-NEW-FIELD
        ];
    }

}
