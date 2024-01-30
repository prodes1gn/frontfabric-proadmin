<?php

namespace App\Http\Requests\Admin\Valuesitem;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MoveValuesitemRequest extends FormRequest {

    public function authorize() {
        return Gate::allows('valuesitem_edit');
    }

    public function rules() {
        return [
            'order' => [
                'integer',
                'required',
            ],
        ];
    }

}
