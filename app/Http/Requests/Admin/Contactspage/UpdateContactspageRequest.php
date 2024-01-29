<?php

namespace App\Http\Requests\Admin\Contactspage;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class UpdateContactspageRequest extends FormRequest {

    public function authorize() {
        return Gate::allows('contactspage_edit');
    }

    public function rules() {
        return [
            'name' => [
                'between:3,50',
                'required',
            ],
                #CRUD-FIELD-SLUG-START
            'slug' => [
                'nullable',
                'max:255',
                
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
                #CRUD-NEW-FIELD






        ];
    }

}
