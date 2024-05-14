<?php

namespace App\Http\Requests;

use App\Traits\ApiResponserTrait;
use App\Http\Requests\ApiRequests;

class AuthenticationRequests extends ApiRequests
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
            'user_token'      => 'required|string',
            'session_token'   => 'required|string',
            'platform'   => 'required|string',
            'currency'   => 'required|string'
        ];
    }

    public function response(array $errors)
    {
        return $this->errorResponse($errors, 'Session Data Error', 400);
    }
}
