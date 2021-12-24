<?php

namespace Modules\Auth\Http\Requests\ApiAuth\Registration;

use Illuminate\Foundation\Http\FormRequest;

class CreateRegistrationRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name'     => 'required|string|max:50',
            'email'    => 'required|email|unique:users',
            'password' => 'required',
        ];
    }


    public function authorize()
    {
        return true;
    }
}
