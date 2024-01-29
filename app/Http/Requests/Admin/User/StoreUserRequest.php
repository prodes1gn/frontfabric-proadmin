<?php

namespace App\Http\Requests\Admin\User;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest {

    public function authorize() {
        return Gate::allows('user_create');
    }

    public function rules() {

        return [
            'name' => [
                'string',
                'min:3',
                'max:50',
                'unique:core_users,name,NULL,id,deleted_at,NULL',
                'required',
            ],
            'email' => [
                'required',
                'min:5',
                'max:150',
                'unique:core_users,email,NULL,id,deleted_at,NULL',
            ],
            'password' => [
                'max:' . config('cms.password_max_chars'),
                'required',
                        Password::min(config('cms.password_min_chars'))
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
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
    }

}
