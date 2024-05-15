<?php

namespace App\Services;

use App\Helpers\ExternalApiCallHelper;
use App\Models\CasinoTokens;
use App\Models\Players;
use App\Models\Sessions;
use App\Models\SpribeLogs;
use Illuminate\Support\Str;
use Carbon\Carbon;


class TransactionService
{
    public function withdraw($data) 
    {
        $request_id = Str::uuid()->toString();
        $transaction_id = Str::uuid()->toString();
        $logsPayload = [
            'is_request' => true,
            'requestId' => $request_id,
            'gameRoundCode' => null,
            'transactionCode' => null,
            'externalToken' => null,
            'internal_transaction_key' => null,
            'body' => "A user has been trying to withdraw using /withdraw URL with 
                       user id {$data->user_id} and amount {$data->amount} and currency {$data->currency} and provider {$data->provider}",
            'type' => "WITHDRAW",
            'modify_uid' => '0',
            'create_dt' => Carbon::now(),
            'modify_dt' => Carbon::now()
        ];

        //TODO: CALL API OR FUNCTIONALITY TO WITHDRAW BALANCE
        $playerData = Players::where('id', '=', $data->user_id)->first();

        if($playerData){
            //getting the data from sessions table where initial session = user token (came from request) and session = session token (came from request)
            $sessionData = Sessions::where('session', '=', $data->session_token)->first();

            if($sessionData){
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
                    $requestBalanceUrl = "{$walletUrl}/update_balance";

                    //initializaing request balance payload
                    $requestBalancePayload = [
                        "action" => "update_balance",
                        "user_id" => $data->user_id,
                        "bet" =>  $data->amount,//withdraw
                        "win" => "0.00",//deposit
                        "jackpot_win" => "0.00",
                        "game_name" =>  $data->game,
                        "Free_spin" => [], //todo
                        "transaction_id" => $transaction_id,
                        "round_id" => $data->action_id,
                        "session_id" => $data->provider_tx_id,
                        "token" => $apiKey,
                        "request_token" => $sessionData->request_token,
                        "game_round_close" => null //todo
                    ];

                    // md5 version of the concatenated payload //todo
                    $md5Hash = "update_balance{$data->user_id}{$data->amount}0.000.00{$data->game}freespin{$transaction_id}{$data->action_id}{$data->provider_tx_id}{$apiKey}{$sessionData->request_token}{game_round_close}{$secretKey}";
                    
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
                                'operator_tx_id' => '1',
                                'new_balance' => floatval($balanceResponse->balance), 
                                'old_balance' => floatval($balanceResponse->balance) + floatval($data->amount),
                                'user_id' => $data->user_id,
                                'currency' => $data->currency,
                                'provider' => $data->provider,
                                'provider_tx_id' => $data->provider_tx_id
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
            }else{
                $response = array (
                    'code' => 400,
                    'message' => 'User token is invalid',
                    'data' => []
                );
            }
        } else{
            $response = array (
                'code' => 400,
                'message' => 'User token is invalid',
                'data' => []
            );
        }

        return $response;
    }

    public function deposit($data) 
    {
        $request_id = Str::uuid()->toString();
        $logsPayload = [
            'is_request' => true,
            'requestId' => $request_id,
            'gameRoundCode' => null,
            'transactionCode' => null,
            'externalToken' => null,
            'internal_transaction_key' => null,
            'body' => "A user has been trying to deposit using /deposit URL with 
                       user id {$data->user_id} and amount {$data->amount} and currency {$data->currency} and provider {$data->provider}",
            'type' => "DEPOSIT",
            'modify_uid' => '0',
            'create_dt' => Carbon::now(),
            'modify_dt' => Carbon::now()
        ];

        //TODO: CALL API OR FUNCTIONALITY TO DEPOSIT BALANCE 

        //STORE LOG
        $newLog = SpribeLogs::insert($logsPayload);

        if($newLog){
            $response = array (
                'code' => 200,
                'message' => 'ok',
                'data' => array(
                    'operator_tx_id' => '1',
                    'new_balance' => floatval($data->amount),
                    'old_balance' => floatval($data->amount),
                    'user_id' => $data->user_id,
                    'currency' => $data->currency,
                    'provider' => $data->provider,
                    'provider_tx_id' => $data->provider_tx_id
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

    public function rollback($data) 
    {
        $request_id = Str::uuid()->toString();
        $logsPayload = [
            'is_request' => true,
            'requestId' => $request_id,
            'gameRoundCode' => null,
            'transactionCode' => null,
            'externalToken' => null,
            'internal_transaction_key' => null,
            'body' => "A user has been trying to rollback transaction using /rollback URL with 
                       user id {$data->user_id} and amount {$data->amount} and currency {$data->currency} and provider {$data->provider}",
            'type' => "ROLLBACK",
            'modify_uid' => '0',
            'create_dt' => Carbon::now(),
            'modify_dt' => Carbon::now()
        ];

        //TODO: CALL API OR FUNCTIONALITY TO ROLLBACK BALANCE 

        //STORE LOG
        $newLog = SpribeLogs::insert($logsPayload);

        if($newLog){
            $response = array (
                'code' => 200,
                'message' => 'ok',
                'data' => array(
                    'user_id' => $data->user_id,
                    'operator_tx_id' => '1',
                    'provider' => $data->provider,
                    'provider_tx_id' => $data->provider_tx_id,
                    'old_balance' => floatval($data->amount),
                    'new_balance' => floatval($data->amount),
                    'currency' => 'MYR'
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