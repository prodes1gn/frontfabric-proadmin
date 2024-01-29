<?php

namespace App\Http\Requests\Admin\Appproachitem;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MoveAppproachitemRequest extends FormRequest {

    public function authorize() {
        return Gate::allows('appproachitem_edit');
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
