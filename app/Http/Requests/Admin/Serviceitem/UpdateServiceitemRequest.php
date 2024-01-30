<?php

namespace App\Http\Requests\Admin\Serviceitem;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class UpdateServiceitemRequest extends FormRequest {

    public function authorize() {
        return Gate::allows('serviceitem_edit');
    }

    public function rules() {
        return [
            'name' => [
                'between:3,150',
                'required',
                Rule::unique('serviceitems_translations')->where('locale', $this->lang)->ignore($this->serviceitem->id, 'serviceitem_id'),
            ],
                #CRUD-FIELD-SLUG-START
            'slug' => [
                'nullable',
                'max:255',
                Rule::unique('serviceitems_translations')->where('locale', $this->lang)->ignore($this->serviceitem->id, 'serviceitem_id'),
                
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
                #CRUD-FIELD-HOMETEXT-START
            'hometext' => [
                'nullable',
                'max:255',
                'required',
            ],
                #CRUD-FIELD-HOMETEXT-END
                #CRUD-FIELD-TEXT-START
            'text' => [
                'nullable',
                'max:100000',
                'required',
            ],
                #CRUD-FIELD-TEXT-END
                #CRUD-FIELD-SERVICEPOINTDROPDOWN-START
            'servicepointdropdown' => [
                'required',
            ],
                #CRUD-FIELD-SERVICEPOINTDROPDOWN-END
                #CRUD-FIELD-IMAGE-START
            'image' => [
            ],
                #CRUD-FIELD-IMAGE-END
                #CRUD-NEW-FIELD











        ];
    }

}
