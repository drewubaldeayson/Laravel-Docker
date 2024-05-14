<?php

namespace App\Services;

use App\Models\SpribeLogs;
use Illuminate\Support\Str;
use Carbon\Carbon;


class PlayerService
{
    public function getPlayerInformation($data) 
    {
        $request_id = Str::uuid()->toString();
        $balance = 0;
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
                    'user_id' => $data->user_id,
                    'username' => "Sample Username",
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