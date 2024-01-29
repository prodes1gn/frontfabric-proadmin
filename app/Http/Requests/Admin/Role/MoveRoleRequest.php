<?php

namespace App\Http\Requests\Admin\Role;

use App\Models\Role;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class MoveRoleRequest extends FormRequest {

    public function authorize() {
        return Gate::allows('role_edit');
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
