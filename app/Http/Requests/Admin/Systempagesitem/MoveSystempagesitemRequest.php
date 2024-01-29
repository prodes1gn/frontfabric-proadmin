<?php

namespace App\Http\Requests\Admin\Systempagesitem;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MoveSystempagesitemRequest extends FormRequest {

    public function authorize() {
        return Gate::allows('systempagesitem_edit');
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
