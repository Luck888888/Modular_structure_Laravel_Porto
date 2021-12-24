<?php

namespace Modules\Auth\Http\Requests\ApiAuth\Login;

use Illuminate\Foundation\Http\FormRequest;

class CreateLoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email'    => 'required|email',
            'password' => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
