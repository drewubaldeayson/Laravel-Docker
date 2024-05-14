<?php

namespace App\Http\Requests;

use App\Traits\ApiResponserTrait;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\ApiRequests;
use App\Rules\AlphaDash;

class UserServiceProviderUpdateValidation extends ApiRequests
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
            'mobile_number.size'    => 'Please enter your 10-digit Mobile Number',
            'email'                 => 'Please enter a valid email address',
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
            'firstname'     => ['required','max:100'],
            'lastname'      => ['required','max:100'],
            'middlename'    => ['nullable','max:100'],
            'mobile_number' => 'required|min:11|regex:/^((09)[0-9\s\-\+\(\)]*)$/|max:11,mobile_number',
            'email'         => 'required|email|max:255',
        ];
    }

    public function response(array $errors)
    {
        return $this->errorResponse($errors, 'Form Validation Error', 400);
    }

}
