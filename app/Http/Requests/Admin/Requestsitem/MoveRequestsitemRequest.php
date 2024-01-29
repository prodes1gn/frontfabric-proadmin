<?php

namespace App\Http\Requests\Admin\Requestsitem;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MoveRequestsitemRequest extends FormRequest {

    public function authorize() {
        return Gate::allows('requestsitem_edit');
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
