<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\ApiController;
use App\Http\Requests\TransactionDepositValidation;
use App\Http\Requests\TransactionWithdrawValidation;
use App\Http\Requests\TransactionRollbackValidation;
use App\Services\TransactionService;

class TransactionController extends ApiController
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }
    
    public function withdraw(TransactionWithdrawValidation $request)
    {
        $response = $this->transactionService->withdraw($request);

        if($response['code'] == 200)
            return $this->successResponse($response['data'], $response['message'], $response['code']);

        return $this->errorResponse($response['message'], $response['code']);
    }

    public function deposit(TransactionDepositValidation $request)
    {
        $response = $this->transactionService->deposit($request);

        if($response['code'] == 200)
            return $this->successResponse($response['data'], $response['message'], $response['code']);

        return $this->errorResponse($response['message'], $response['code']);
    }

    public function rollback(TransactionRollbackValidation $request)
    {
        $response = $this->transactionService->rollback($request);

        if($response['code'] == 200)
            return $this->successResponse($response['data'], $response['message'], $response['code']);

        return $this->errorResponse($response['message'], $response['code']);
    }
}