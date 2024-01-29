<?php

namespace App\Http\Requests\Admin\User;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest {

    public function authorize() {
        return Gate::allows('user_edit');
    }

    public function rules() {

        $rules = [
            'name' => [
                'string',
                'min:3',
                'max:50',
                'unique:core_users,name,' . request()->route('user')->id . ',id,deleted_at,NULL',
                'required',
            ],
            'email' => [
                'required',
                'min:5',
                'max:150',
                'unique:core_users,email,' . request()->route('user')->id . ',id,deleted_at,NULL',
            ],
            'roles.*' => [
                'integer',
            ],
            'roles' => [
                'required',
                'array',
            ],
            'approved' => [
                'boolean',
                'required',
            ],
            'verified' => [
                'boolean',
                'required',
            ],
            'status' => [
                'boolean',
                'required',
            ],
            'avatar' => [
                'nullable',
                'max:5120',
            ],
        ];

        // #CHECK PASSWORD CHANGED & SET RULES
        if ($this->password !== null) {
            $rules['password'] = [
                'max:' . config('cms.password_max_chars'),
                'required',
                        Password::min(config('cms.password_min_chars'))
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
            ];
        }

        return $rules;
    }

}
