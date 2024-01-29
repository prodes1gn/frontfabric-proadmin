<?php

namespace App\Http\Requests\Admin\Serviceitem;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MoveServiceitemRequest extends FormRequest {

    public function authorize() {
        return Gate::allows('serviceitem_edit');
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
