<?php

namespace App\Http\Requests\Admin\Portfolioitem;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MovePortfolioitemRequest extends FormRequest {

    public function authorize() {
        return Gate::allows('portfolioitem_edit');
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
