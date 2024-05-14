<?php

namespace App\Http\Requests;

use App\Traits\ApiResponserTrait;
use App\Http\Requests\ApiRequests;
use App\Rules\AlphaDash;

class UserAddAddressValidation extends ApiRequests
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
            'contact_number.min'     => 'Please enter your 10-digit mobile number',
            'contact_number.max'     => 'Please enter your 10-digit mobile number',
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
            'region_code'    => 'required',
            'province_code'  => 'required',
            'city_code'      => 'required',
            'brgy_code'      => 'required',
            'region'         => 'required',
            'province'       => 'required',
            'city'           => 'required',
            'brgy'           => 'required',
            'address'        => 'required',
            'landmark'       => 'nullable',
            'zip_code'       => 'required',
            'longtitude'     => 'required',
            'latitude'       => 'required',
            'contact_number' => 'required|min:11|max:11|regex:/^((09)[0-9\s\-\+\(\)]*)$/'
        ];
    }

    public function response(array $errors)
    {
        return $this->errorResponse($errors, 'Form Validation Error', 400);
    }
}
