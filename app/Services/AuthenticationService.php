<?php

namespace App\Services;

use Hash;
use Carbon\Carbon;
use App\Contracts\AuthenticationServiceInterface;

class AuthenticationService implements AuthenticationServiceInterface
{
    public function authenticateProvider($data) 
    {
        $user_id = "123XXX";
        $username = "arjay_notorio";
        $balance = 100000;
        $currency = $data->currency;

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
        return $response;
    }
}