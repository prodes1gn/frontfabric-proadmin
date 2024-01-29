<?php

namespace App\Http\Requests\Admin\Support;

use App\Models\Permission;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class SupportRequest extends FormRequest {

    public function authorize() {
        return config('cms.support');
    }

    public function rules() {

        $rules = [
            'title' => [
                'string',
                'min:5',
                'max:100',
                'required',
            ],
            'text' => [
                'string',
                'min:10',
                'max:1000',
                'required',
            ],
        ];

        return $rules;
    }

}
