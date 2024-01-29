<?php

namespace App\Http\Requests\Admin\User;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class MoveUserRequest extends FormRequest {

    public function authorize() {
        return Gate::allows('user_edit');
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
