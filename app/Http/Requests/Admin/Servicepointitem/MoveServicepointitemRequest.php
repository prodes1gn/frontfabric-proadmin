<?php

namespace App\Http\Requests\Admin\Servicepointitem;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MoveServicepointitemRequest extends FormRequest {

    public function authorize() {
        return Gate::allows('servicepointitem_edit');
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
