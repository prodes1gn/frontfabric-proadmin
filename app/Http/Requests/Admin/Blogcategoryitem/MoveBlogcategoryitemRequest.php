<?php

namespace App\Http\Requests\Admin\Blogcategoryitem;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MoveBlogcategoryitemRequest extends FormRequest {

    public function authorize() {
        return Gate::allows('blogcategoryitem_edit');
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
