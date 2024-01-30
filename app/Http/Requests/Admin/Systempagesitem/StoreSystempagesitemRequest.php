<?php

namespace App\Http\Requests\Admin\Systempagesitem;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class StoreSystempagesitemRequest extends FormRequest {

    public function authorize() {
        return Gate::allows('systempagesitem_create');
    }

    public function rules() {
        return [
            'name' => [
                'between:3,150',
                'required',
                Rule::unique('systempagesitems_translations')->where('locale', $this->lang),
            ],
                #CRUD-FIELD-SLUG-START
            'slug' => [
                'nullable',
                'max:255',
                Rule::unique('systempagesitems_translations')->where('locale', $this->lang),
                
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
