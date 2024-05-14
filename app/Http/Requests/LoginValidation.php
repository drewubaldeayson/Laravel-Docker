<?php

namespace App\Http\Requests;

use App\Traits\ApiResponserTrait;
use App\Http\Requests\ApiRequests;

class LoginValidation extends ApiRequests
{
    use ApiResponserTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            // 'exists'    => 'Incorrect email or password.',
            'email'     => 'Please enter a valid email address'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'email'      => 'required|email|exists:users',
            'email'      => 'required|email',
            'password'   => 'required|string'
        ];
    }

    public function response(array $errors)
    {
        return $this->errorResponse($errors, 'Form Validation Error', 400);
    }
}
