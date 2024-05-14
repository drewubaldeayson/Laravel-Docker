<?php

namespace App\Http\Controllers\API;
use App\Contracts\AuthServiceInterface;
use App\Http\Requests\AuthenticationRequests;
use App\Http\Requests\AuthenticationValidation;
use App\Http\Controllers\API\ApiController;
use App\Http\Resources\AuthenticationResources;
use App\Contracts\AuthenticationServiceInterface;
use App\Services\AuthenticationService;

class AuthenticationController extends ApiController
{
    protected $authenticationService;

    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }
    
    public function authenticateProvider(AuthenticationRequests $request)
    {
        $data = $request;
        return $this->authenticationService->authenticateProvider($data);
    }


}


/*

Act : 
route <--> controller
    controller <--> service
        service <--> repository


    public function create(AuthenticationValidation $request)
    {
        
        $data = []; // Your data array

        $user = User::create($request->validated())
        $this->authenticationService->store_kunwari($data);
    }
*/