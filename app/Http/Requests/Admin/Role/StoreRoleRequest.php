<?php

namespace App\Http\Requests\Admin\Role;

use App\Models\Role;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class StoreRoleRequest extends FormRequest {

    public function authorize() {
        return Gate::allows('role_create');
    }

    public function rules() {

        return [
            'title' => [
                'string',
                'min:3',
                'max:50',
                'required',
                Rule::unique('core_roles_translations')->where('locale', $this->lang),
            ],
            'permissions.*' => [
                'integer',
            ],
            'permissions' => [
                'required',
                'array',
            ],
        ];
    }

}
