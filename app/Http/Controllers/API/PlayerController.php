<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\ApiController;
use App\Http\Requests\AuthenticationValidation;
use App\Http\Requests\PlayerInformationValidation;
use App\Services\PlayerService;

class PlayerController extends ApiController
{
    protected $playerService;

    public function __construct(PlayerService $playerService)
    {
        $this->playerService = $playerService;
    }
    
    public function getPlayerInformation(PlayerInformationValidation $request)
    {
        $response = $this->playerService->getPlayerInformation($request);

        if($response['code'] == 200)
            return $this->successResponse($response['data'], $response['message'], $response['code']);

        return $this->errorResponse($response['message'], $response['code']);
    }
}