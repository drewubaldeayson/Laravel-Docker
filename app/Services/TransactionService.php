<?php

namespace App\Services;

use App\Models\SpribeLogs;
use Illuminate\Support\Str;
use Carbon\Carbon;


class TransactionService
{
    public function withdraw($data) 
    {
        $request_id = Str::uuid()->toString();
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