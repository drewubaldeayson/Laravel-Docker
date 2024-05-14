<?php

namespace App\Http\Requests;

use App\Traits\ApiResponserTrait;
use App\Http\Requests\ApiRequests;
use App\Rules\MatchOldPassword;

class ProfileChangePasswordValidation extends ApiRequests
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
            //
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
            'current_password'      => ['required', new MatchOldPassword],
            'new_password'          => 'required',
            'new_confirm_password'  => 'same:new_password'
        ];
    }

    public function response(array $errors)
    {
        return $this->errorResponse($errors, 'Form Validation Error', 400);
    }
}
