<?php

namespace App\Services;

use App\Models\SpribeLogs;
use Illuminate\Support\Str;
use Carbon\Carbon;


class PlayerNotificationService
{
    public function callbackPlayerNotification($data) 
    {
        $request_id = Str::uuid()->toString();
        $notification_action = $data->notification_data['action'];
        $logsPayload = [
            'is_request' => true,
            'requestId' => $request_id,
            'gameRoundCode' => null,
            'transactionCode' => null,
            'externalToken' => null,
            'internal_transaction_key' => null,
            'body' => "This is an attempt to call the /callback url with user_id {$data->user_id} and game {$data->game} and notification {$data->notification} and notification action {$notification_action}",
            'type' => "CALLBACK PLAYER NOTIFICATION",
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
                'data' => []
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