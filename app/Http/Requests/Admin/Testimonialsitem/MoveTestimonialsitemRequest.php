<?php

namespace App\Http\Requests\Admin\Testimonialsitem;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MoveTestimonialsitemRequest extends FormRequest {

    public function authorize() {
        return Gate::allows('testimonialsitem_edit');
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
