<?php

namespace App\Exceptions;

use App\Traits\ApiResponserTrait;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponserTrait;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    


    // /**
    //  * Render an exception into an HTTP response.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \Exception  $exception
    //  * @return \Illuminate\Http\Response
    //  */
    // public function render($request, Exception $exception)
    // {
    //     $response = $this->handleException($request, $exception);
    //     return $response;
    // }

    // public function handleException($request, Exception $exception)
    // {

    //     if ($exception instanceof MethodNotAllowedHttpException) {
    //         return $this->errorResponse([], 'The specified method for the request is invalid', 405);
    //     }

    //     if ($exception instanceof NotFoundHttpException) {
    //         return $this->errorResponse([], 'The specified URL cannot be found', 404);
    //     }

    //     if ($exception instanceof HttpException) {
    //         return $this->errorResponse([], $exception->getMessage(), $exception->getStatusCode());
    //     }

    //     if (config('app.debug')) {
    //         return parent::render($request, $exception);            
    //     }

    //     return $this->errorResponse([], 'Unexpected Exception. Try later', 500);

    // }
    

}
