<?php

namespace App\Services;

use App\Helpers\ExternalApiCallHelper;
use App\Models\CasinoTokens;
use App\Models\Players;
use App\Models\SpribeLogs;
use App\Models\Sessions;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Faker\Factory as Faker;


class AuthenticationService
{
    public function authenticateProvider($data)
    {
        $faker = Faker::create();
        $request_id = Str::uuid()->toString();
        $currency = $data->currency;
        //spribe logs data payload
        $logsPayload = [
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
        $newLog = SpribeLogs::insert($logsPayload);

        if($newLog){
            $response = array (
                'code' => 200,
                'message' => 'ok',
                'data' => array(
                    'user_id' => Str::uuid()->toString(),
                    'username' =>  $faker->userName,
                    'balance' => 0,
                    'currency' => $currency
                )
            );
        }else{
            $response = array (
                'code' => 400,
                'message' => 'Something went wrong in creating logs',
                'data' => []
            );
        }

        return $response;
    }
}
