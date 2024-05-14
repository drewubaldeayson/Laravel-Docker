<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\ApiController;
use App\Http\Requests\AuthenticationValidation;
use App\Services\AuthenticationService;

class AuthenticationController extends ApiController
{
    protected $authenticationService;

    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }
    
    public function authenticateProvider(AuthenticationValidation $request)
    {
        $response = $this->authenticationService->authenticateProvider($request);

        if($response['code'] == 200)
            return $this->successResponse($response['data'], $response['message'], $response['code']);

        return $this->errorResponse($response['message'], $response['code']);
    }
}