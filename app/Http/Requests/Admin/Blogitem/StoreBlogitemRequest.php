<?php

namespace App\Http\Requests\Admin\Blogitem;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class StoreBlogitemRequest extends FormRequest {

    public function authorize() {
        return Gate::allows('blogitem_create');
    }

    public function rules() {
        return [
            'name' => [
                'between:3,150',
                'required',
                Rule::unique('blogitems_translations')->where('locale', $this->lang),
            ],
                #CRUD-FIELD-SLUG-START
            'slug' => [
                'nullable',
                'max:255',
                Rule::unique('blogitems_translations')->where('locale', $this->lang),
                
            ],
                #CRUD-FIELD-SLUG-END
                #CRUD-FIELD-SEOTITLE-START
            'seotitle' => [
                'nullable',
                'max:255',
                
            ],
                #CRUD-FIELD-SEOTITLE-END
                #CRUD-FIELD-SEODESCRIPTION-START
            'seodescription' => [
                'nullable',
                'max:255',
                
            ],
                #CRUD-FIELD-SEODESCRIPTION-END
                #CRUD-FIELD-SEOIMAGE-START
            'seoimage' => [
            ],
                #CRUD-FIELD-SEOIMAGE-END
                #CRUD-FIELD-SEOTYPE-START
            'seotype' => [
                
            ],
                #CRUD-FIELD-SEOTYPE-END
                #CRUD-FIELD-IMAGE-START
            'image' => [
            ],
                #CRUD-FIELD-IMAGE-END
                #CRUD-FIELD-DATE-START
            'date' => [
                'nullable',
                'date',
                'date_format:Y-m-d',
                'required',
            ],
                #CRUD-FIELD-DATE-END
                #CRUD-FIELD-READTIME-START
            'readtime' => [
                'nullable',
                'max:255',
                
            ],
                #CRUD-FIELD-READTIME-END
                #CRUD-NEW-FIELD










        ];
    }

}
