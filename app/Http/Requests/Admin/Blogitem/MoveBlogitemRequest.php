<?php

namespace App\Http\Requests\Admin\Blogitem;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MoveBlogitemRequest extends FormRequest {

    public function authorize() {
        return Gate::allows('blogitem_edit');
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
