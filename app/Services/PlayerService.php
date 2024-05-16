<?php

namespace App\Services;

use App\Helpers\ExternalApiCallHelper;
use App\Models\CasinoTokens;
use App\Models\Players;
use App\Models\Sessions;
use App\Models\SpribeLogs;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Faker\Factory as Faker;

class PlayerService
{
    public function getPlayerInformation($data)
    {
        $faker = Faker::create();
        $request_id = Str::uuid()->toString();
        $currency = $data->currency;
        $logsPayload = [
            'is_request' => true,
            'requestId' => $request_id,
            'gameRoundCode' => null,
            'transactionCode' => null,
            'externalToken' => null,
            'internal_transaction_key' => null,
            'body' => "A user has been trying to retrive player information using /info URL with user id {$data->user_id} and session token {$data->session_token} and currency {$data->currency}",
            'type' => "FETCH PLAYER INFO",
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
