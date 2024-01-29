<?php

namespace App\Http\Requests\Admin\Whyushomepageitem;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class StoreWhyushomepageitemRequest extends FormRequest {

    public function authorize() {
        return Gate::allows('whyushomepageitem_create');
    }

    public function rules() {
        return [
            'name' => [
                'between:3,150',
                'required',
                Rule::unique('whyushomepageitems_translations')->where('locale', $this->lang),
            ],
                #CRUD-NEW-FIELD
        ];
    }

}
