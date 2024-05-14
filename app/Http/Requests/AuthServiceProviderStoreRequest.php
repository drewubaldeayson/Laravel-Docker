<?php

namespace App\Http\Requests;

use App\Traits\ApiResponserTrait;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\ApiRequests;
use App\Rules\AlphaDash;

class AuthServiceProviderStoreRequest extends ApiRequests
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
            'mobile_number.min'     => 'Please enter your 11-digit mobile number',
            'mobile_number.max'     => 'Please enter your 11-digit mobile number',
            'email'                 => 'Please enter a valid email address',
            'unique'                => 'The :attribute is already taken'
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
            'firstname'             => ['required','max:100'],
            'lastname'              => ['required','max:100'],
            'middlename'            => ['nullable','max:100'],
            'email'                 => 'required|email|max:255|unique:users,email',
            'mobile_number'         => 'required|min:11|max:11|regex:/^((09)[0-9\s\-\+\(\)]*)$/|unique:users,mobile_number',
            'password'              => 'required | confirmed | min:6',
            'usertype'              => 'alpha|max:15',
            'clinic_name'           => 'required',
            'clinic_description'    => 'required',
            'clinic_mobile_number'  => 'required',
            'clinic_email'          => 'required',
            'clinic_region_code'    => 'required',
            'clinic_province_code'  => 'required',
            'clinic_city_code'      => 'required',
            'clinic_brgy_code'      => 'required',
            'clinic_region'         => 'required',
            'clinic_province'       => 'required',
            'clinic_city'           => 'required',
            'clinic_brgy'           => 'required',
            'clinic_address'        => 'required',
            'clinic_landmark'       => 'nullable',
            'clinic_zip_code'       => 'required',
            'clinic_longtitude'     => 'required',
            'clinic_latitude'       => 'required'

        ];
    }

    public function response(array $errors)
    {
        return $this->errorResponse($errors, 'Form Validation Error', 400);
    }

}
