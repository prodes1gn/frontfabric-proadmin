<?php

namespace App\Http\Requests\Admin\Blogcategoryitem;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class StoreBlogcategoryitemRequest extends FormRequest {

    public function authorize() {
        return Gate::allows('blogcategoryitem_create');
    }

    public function rules() {
        return [
            'name' => [
                'between:3,150',
                'required',
                Rule::unique('blogcategoryitems_translations')->where('locale', $this->lang),
            ],
                #CRUD-NEW-FIELD
        ];
    }

}
