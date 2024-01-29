<?php

namespace App\Http\Requests\Admin\Profile;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Spatie\MediaLibraryPro\Rules\Concerns\ValidatesMedia;
use JanisKelemen\Setting\Facades\Setting;

class UpdateProfileRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        abort_if(Gate::denies('profile_password_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => [
                'string',
                'min:3',
                'max:50',
                'unique:core_users,name,' . auth()->id() . ',id,deleted_at,NULL',
                'required',
            ],
            'email' => [
                'required',
                'min:5',
                'max:150',
                'unique:core_users,email,' . auth()->id() . ',id,deleted_at,NULL',
            ],
            'avatar' => [
                'image',
                'max:' . Setting::get('attachments_max_filesize') * 1024,
            ],
        ];
    }

}
