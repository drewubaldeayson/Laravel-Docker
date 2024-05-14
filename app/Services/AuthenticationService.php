<?php

namespace App\Services;

use Hash;
use Carbon\Carbon;
use App\Contracts\AuthenticationServiceInterface;

class AuthenticationService implements AuthenticationServiceInterface
{
    protected $user_id;
    protected $username;
    protected $balance;
    protected $currency;

    public function store_kunwari($data) 
    {
        $user_id = "123XXX";
        $username = "arjay_notorio";
        $balance = 123;
        $currency = "MYR";

        $response = array (
            'code' => 200,
            'message' => 'ok',
            'data' => array(
                'user_id' => $user_id,
                'username' => $username,
                'balance' => $balance,
                'currency' => $currency
            )
        );

        print_r($response);
    }
}