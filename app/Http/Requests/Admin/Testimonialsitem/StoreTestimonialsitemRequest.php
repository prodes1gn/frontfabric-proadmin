<?php

namespace App\Http\Requests\Admin\Testimonialsitem;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class StoreTestimonialsitemRequest extends FormRequest {

    public function authorize() {
        return Gate::allows('testimonialsitem_create');
    }

    public function rules() {
        return [
            'name' => [
                'between:3,150',
                'required',
                Rule::unique('testimonialsitems_translations')->where('locale', $this->lang),
            ],
                #CRUD-NEW-FIELD
        ];
    }

}
