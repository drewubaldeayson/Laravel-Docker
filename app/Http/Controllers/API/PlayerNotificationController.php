<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\ApiController;
use App\Http\Requests\PlayerNotificationValidation;
use App\Services\PlayerNotificationService;

class PlayerNotificationController extends ApiController
{
    protected $playerNotificationService;

    public function __construct(PlayerNotificationService $playerNotificationService)
    {
        $this->playerNotificationService = $playerNotificationService;
    }
    
    public function callbackPlayerNotification(PlayerNotificationValidation $request)
    {
        $response = $this->playerNotificationService->callbackPlayerNotification($request);

        if($response['code'] == 200)
            return $this->successResponse($response['data'], $response['message'], $response['code']);

        return $this->errorResponse($response['message'], $response['code']);
    }
}