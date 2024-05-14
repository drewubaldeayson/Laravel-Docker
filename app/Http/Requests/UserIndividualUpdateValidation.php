<?php

namespace App\Http\Requests;

use App\Traits\ApiResponserTrait;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\ApiRequests;
use App\Rules\AlphaDash;

class UserIndividualUpdateValidation extends ApiRequests
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
            'firstname'     => ['required','max:100'],
            'lastname'      => ['required','max:100'],
            'middlename'    => ['nullable','max:100'],
            'birthday'      => ['required', 'date_format:Y-m-d'],
            'age'           => ['required', 'integer'],
            'nationality'   => ['nullable', 'string']
        ];
    }

    public function response(array $errors)
    {
        return $this->errorResponse($errors, 'Form Validation Error', 400);
    }

}
