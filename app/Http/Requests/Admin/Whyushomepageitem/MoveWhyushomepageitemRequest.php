<?php

namespace App\Http\Requests\Admin\Whyushomepageitem;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MoveWhyushomepageitemRequest extends FormRequest {

    public function authorize() {
        return Gate::allows('whyushomepageitem_edit');
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
