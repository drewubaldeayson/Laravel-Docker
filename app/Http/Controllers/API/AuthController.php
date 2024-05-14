<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Auth;

use App\Http\Resources\UserAddressesResource;

use App\Contracts\UserInterface;
use App\Contracts\ProfileInterface;

use App\Http\Requests\LoginValidation;
use App\Http\Requests\AuthStoreRequest;
use App\Http\Requests\OTPValidation;
use App\Http\Requests\OTPResend;
use App\Http\Controllers\API\ApiController;
use JWTAuth;

class AuthController extends ApiController
{

    protected $user;
    protected $addresses;
    protected $usertype = 'individual';

    public function __construct(
        UserInterface $user,
        ProfileInterface $addresses
    )
    {
        $this->middleware('jwt.verify', ['except' => ['login', 'store', 'resendMobileOtp','validateMobileOtp','refresh']]);
        $this->user = $user;
        $this->addresses = $addresses;
    }


    /**
     * @OA\Post(
     *      path="/api/v1/user/signup",
     *      tags={"User - Auth"},
     *      summary="Admin signup endpoint",
     *      description="Admin signup endpoint",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation")
     *       ),
     *     )
     */
    public function store(AuthStoreRequest $request)
    {
        $validatedData = $request->validated();
        $registerResult = $this->user->signUpUser($validatedData);
        if($registerResult['status'] === true){
            return $this->successResponse([], $registerResult['message'], 201);
        }
        return $this->errorResponse([], $registerResult['message'], 400);
    }

    public function login(LoginValidation $request)
    {
        if (!$token = auth()->attempt($request->validated())) {
            return $this->respondUnauthorized([]);
        }

        if ($this->user->validateUserType(auth()->user()->user_id, $this->usertype)) {
            $result = $this->user->validateUserStatus(auth()->user()->user_id);
            if ($result['user_status'] == 'active') {
                $data = $this->createNewToken($token);
                return $this->respondAccepted($data);
            } else if ($result['user_status'] == 'pending') {
                auth()->logout();
                return $this->errorResponse('User is Unverified. Please wait a couple minutes to register again', 'Unverified User', 400);
            }
        } else {
            auth()->logout();
            return $this->errorResponse([], 'Invalid User Type', 400);
        }
    }

    public function refresh()
    {
        $newToken = $this->user->refreshToken();
        return $this->createNewToken($newToken);
    }

    public function logout()
    {
        auth()->logout();
        return $this->successResponse([], "You have been logged out.", 200);
    }

    public function userProfile()
    {
        return $this->successResponse(auth()->user(), "", 200);
    }

    public function validateMobileOtp(OTPValidation $request)
    {
        $otpResult = $this->user->validateOTP($request->validated());
        if($otpResult['status'] === true){
            return $this->successResponse([], $otpResult['message'], 200);
        }
        return $this->errorResponse([], $otpResult['message'], 400);
    }

    public function resendMobileOtp(OTPResend $request)
    {
        $otpResult = $this->user->resendOTP($request->validated());
        if($otpResult['status'] === true){
            return $this->successResponse([], $otpResult['message'], 200);
        }
        return $this->errorResponse([], $otpResult['message'], 400);
    }

    private function showAddresses($id)
    {
        return UserAddressesResource::collection($this->addresses->showAddresses($id));
    }

    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user(),
            'usertype' => $this->usertype,
            'addresses' => $this->showAddresses(auth()->user()->user_id)
        ]);
    }

}
