<?php

namespace App\Services;

use App\Models\SpribeLogs;
use Illuminate\Support\Str;
use Carbon\Carbon;


class AuthenticationService
{
    public function authenticateProvider($data) 
    {
        $request_id = Str::uuid()->toString();
        $user_id = "0001";
        $username = $data->user_token;
        $balance = 0;
        $currency = $data->currency;
        $payload = [
            'is_request' => true,
            'requestId' => $request_id,
            'gameRoundCode' => null,
            'transactionCode' => null,
            'externalToken' => null,
            'internal_transaction_key' => null,
            'body' => "A user has been trying to authenticate using /auth URL with user token {$data->user_token} and session token {$data->session_token} and platform {$data->platform} and currency {$data->currency}",
            'type' => "AUTH",
            'modify_uid' => '0',
            'create_dt' => Carbon::now(),
            'modify_dt' => Carbon::now()
        ];

        //STORE LOG
        $newLog = SpribeLogs::insert($payload);

        if($newLog){
            $response = array (
                'code' => 200,
                'message' => 'Success!',
                'data' => array(
                    'user_id' => $user_id,
                    'username' => $username,
                    'balance' => $balance,
                    'currency' => $currency
                )
            );
        }else{
            $response = array (
                'code' => 400,
                'message' => 'Something went wrong in creating the logs.',
                'data' => []
            );
        }

        return $response;
    }
}