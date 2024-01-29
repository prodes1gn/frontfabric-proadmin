<?php

namespace App\Http\Requests\Admin\User;

use App\Models\Permission;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StatusUserRequest extends FormRequest {

    public function authorize() {
        return Gate::allows('user_edit');
    }

    public function rules() {
        return [
            'status' => [
                'between:0,1',
                'integer',
                'required',
            ],
        ];
    }

}
