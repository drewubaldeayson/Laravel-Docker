<?php

namespace App\Http\Requests;

use App\Traits\ApiResponserTrait;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\ApiRequests;
use App\Rules\AlphaDash;

class AuthenticationValidation extends ApiRequests
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

    
    /**
     * Customize the response for validation errors.
     *
     * @param  array  $errors
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function response(array $errors)
    {
        return $this->errorResponse($errors, 'Form Validation Error', 400);
    }

}