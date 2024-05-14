<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use App\Traits\ApiResponserTrait;

class JwtMiddleware extends BaseMiddleware
{

    use ApiResponserTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return $this->errorResponse([], 'Token is invalid.', 403);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return $this->errorResponse([], 'Token is expired.', 401);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenBlacklistedException){
                return $this->errorResponse([], 'Token is blacklisted.', 400);
            }else{
                return $this->errorResponse([], 'Authorization token not found.', 404);
            }
        }
        return $next($request);
    }

}
