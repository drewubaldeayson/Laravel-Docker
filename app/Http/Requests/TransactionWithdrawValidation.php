<?php

namespace App\Http\Requests;

use App\Traits\ApiResponserTrait;
use App\Http\Requests\ApiRequests;

class TransactionWithdrawValidation extends ApiRequests
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
            'user_id'      => 'required|string',
            'currency'     => 'required|string',
            'amount'       => 'required|int',
            'provider'     => 'required|string',
            'provider_tx_id' =>  'required|string',
            'game' =>  'required|string',
            'action' =>  'required|string',
            'action_id' =>  'required|string',
            'session_token' =>  'required|string',
            'platform' =>  'required|string'
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
        return $this->errorResponse('Form Validation Error', 400);
    }

}