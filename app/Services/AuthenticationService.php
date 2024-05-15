<?php

namespace App\Services;

use App\Helpers\ExternalApiCallHelper;
use App\Models\CasinoTokens;
use App\Models\Players;
use App\Models\SpribeLogs;
use App\Models\Sessions;
use Illuminate\Support\Str;
use Carbon\Carbon;


class AuthenticationService
{
    public function authenticateProvider($data) 
    {
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

        //getting the data from sessions table where initial session = user token (came from request) and session = session token (came from request)
        $sessionData = Sessions::where('initial_session', '=', $data->user_token)->where('session', '=', $data->session_token)->first();

        //checking if the condition's matches and there's data
        if($sessionData){
            //getting the data from players table where id = player id from session table
            $playerData = Players::where('id', '=', $sessionData->player_id)->first();
            
            //checking if the condition's matches and there's data
            if($playerData){
                
                //getting the casino id from sessions table
                $casinoId = $sessionData->casino_id;
                
                //getting the data from casino tokens table where casino id = casino id from sessions table
                $casinoTokens = CasinoTokens::where('casino_id','=', $casinoId)->first();
                
                //check if casino tokens has value
                if($casinoTokens){
                    //getting the api key, secret key, and wallet url
                    $apiKey = $casinoTokens->api_key;
                    $secretKey = $casinoTokens->secret_key;
                    $walletUrl = $casinoTokens->wallet_url;
                    // concatenate wallet url and request_balance url
                    $requestBalanceUrl = "{$walletUrl}/request_balance";

                    //initializaing request balance payload
                    $requestBalancePayload = [
                        "action" => "request_balance",
                        "user_id" => $sessionData->player_id,
                        "token" => $apiKey,
                        "request_token" => $sessionData->request_token
                    ];

                    // md5 version of the concatenated payload
                    $md5Hash = "request_balance{$sessionData->player_id}{$apiKey}{$sessionData->request_token}{$secretKey}";
                    
                    //add hash value from the previous md5 hashing of the value
                    $requestBalancePayload['hash'] = $md5Hash;
                    
                    //executing the external api call (CURL) to get balance from the request balance url
                    $balanceResponse = ExternalApiCallHelper::callApi("POST", $requestBalanceUrl, $requestBalancePayload);

                    //STORE LOG
                    $newLog = SpribeLogs::insert($logsPayload);

                    if($newLog){
                        $response = array (
                            'code' => 200,
                            'message' => 'ok',
                            'data' => array(
                                'user_id' => $playerData->id,
                                'username' => $playerData->username,
                                'balance' => $balanceResponse->balance,
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
                }
            } else{
                $response = array (
                    'code' => 400,
                    'message' => 'No data in Players table from Sessions table',
                    'data' => []
                );
            }
        }else{
            //return user token is invalid since there's no data from the given params of the user
            $response = array (
                'code' => 400,
                'message' => 'User token is invalid',
                'data' => []
            );
        }

        return $response;
    }
}