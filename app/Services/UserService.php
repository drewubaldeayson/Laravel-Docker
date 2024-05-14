<?php

namespace App\Services;

use Hash;
use Password;
use Str;
use Carbon\Carbon;
use App\Helpers\StringHelper;
use Illuminate\Auth\Events\PasswordReset;

use App\Libraries\M360;
use App\Contracts\UserInterface;
use App\Contracts\UserRepositoryInterface;
use App\Contracts\UserIndividualRepositoryInterface;
use App\Contracts\UserCorporateRepositoryInterface;
use App\Contracts\UserCustomRepositoryInterface;
use App\Contracts\UserRoleRepositoryInterface;
use App\Contracts\UserServiceProviderRepositoryInterface;
use App\Contracts\UserVerificationRepositoryInterface;
use App\Contracts\ClinicRepositoryInterface;
use App\Contracts\ClinicAddressRepositoryInterface;
use App\Jobs\DeleteUnverifiedUser;

use JWTAuth;

class UserService implements UserInterface
{

    protected $user;
    protected $userIndividual;
    protected $userVerification;
    protected $userServiceProvider;
    protected $userCorporate;
    protected $provider;
    protected $location;
    protected $userCustom;
    protected $userRole;

    public function __construct(
        UserRepositoryInterface $user,
        UserIndividualRepositoryInterface $userIndividual,
        UserCorporateRepositoryInterface $userCorporate,
        UserServiceProviderRepositoryInterface $userServiceProvider,
        UserCustomRepositoryInterface $userCustom,
        UserRoleRepositoryInterface $userRole,
        UserVerificationRepositoryInterface $userVerification,
        ClinicRepositoryInterface $provider,
        ClinicAddressRepositoryInterface $location
    )
    {
        $this->user = $user;
        $this->userIndividual = $userIndividual;
        $this->userVerification = $userVerification;
        $this->userCorporate = $userCorporate;
        $this->userServiceProvider = $userServiceProvider;
        $this->userCustom = $userCustom;
        $this->userRole = $userRole;
        $this->provider = $provider;
        $this->location = $location;
    }

    public function refreshToken()
    {
        $newToken = JWTAuth::refresh(JWTAuth::getToken());
        $user = JWTAuth::setToken($newToken)->toUser();
        return $newToken;
    }


    public function signUpUser(array $attributes)
    {
        $response = array(
            'status' => false,
            'message' => 'Something went wrong'
        );

        $userItem = $this->storeUser($attributes);
        if($userItem->wasRecentlyCreated === true)
        {
            $usersOTP = false;
            $attributes['user_id'] = $userItem->user_id;
            $attributes['customer_type'] = 'app_user';
            
            switch ($attributes['usertype']) {
                case 'serviceprovider':
                    $addressItem = $this->storeProviderAddress($attributes);
                    if($addressItem->wasRecentlyCreated === true){
                        $attributes['clinic_address_id'] = $addressItem->clinic_address_id;
                        $clinicItem = $this->storeProvider($attributes);
                        if($clinicItem->wasRecentlyCreated === true){
                            $attributes['clinic_id'] = $clinicItem->clinic_id;
                            $userProviderRes = $this->storeUserServiceProvider($attributes);
                            if ($userProviderRes->wasRecentlyCreated === true){
                                $result = true;
                            }
                        }
                    }
                    break;

                case 'corporate':
                    $userCorporateRes = $this->storeUserCorporate($attributes);
                    if ($userCorporateRes->wasRecentlyCreated === true){
                        $result = true;
                    }
                    break;

                case 'individual':
                    $userIndiRes = $this->storeUserIndividual($attributes);
                    if ($userIndiRes->wasRecentlyCreated === true){
                        $result = $this->usersOTPVerification($attributes);
                        $this->unverifiedUserExpiration($userItem->user_id);
                    }
                    break;
                case 'admin':
                    $userCustomRes = $this->storeUserCustom($attributes);
                    if ($userCustomRes->wasRecentlyCreated === true){
                        $result = true;
                    }
                    break;
            }

            if($result){
                $response['status'] = true;
                $response['message'] = 'A verification code has been sent to your mobile number.';
            }else{
                $response['message'] = 'Failed to send the OTP verification message.';
            }
        }
        
        return $response;
    }

    private function unverifiedUserExpiration($id)
    {
        $job = new DeleteUnverifiedUser($id);
        dispatch($job)->delay(now()->addMinutes(10));
    }

    private function usersOTPVerification(array $attrib){
        $OTPcode = mt_rand(100000,999999);
        $OTPmessage = "Please use this verification code for your account verification ".$OTPcode;
        $attrib['type'] = 'mobile';
        $attrib['verification_code'] = $OTPcode;
        $attrib['expire_at'] = Carbon::now()->addMinute(2)->format('y-m-d H:i:s');
        $userVerifyRes = $this->storeUserVerification($attrib);
        if($userVerifyRes->wasRecentlyCreated === true){
            return $this->sendMobileOTP($attrib['mobile_number'], $OTPmessage, $attrib['user_id']);
            return true;
        }
        return false;
    }

    private function storeUser(array $attributes)
    {
        $prepData = array(
            'firstname' =>  $attributes['firstname'],
            'lastname' =>  $attributes['lastname'],
            'middlename' =>  $attributes['middlename'],            
            'username' =>  $attributes['mobile_number'],
            'email' =>  $attributes['email'],
            'mobile_number' =>  $attributes['mobile_number'],
            'gender' =>  'rather_not_say',
            'age' =>  '0',
            'nationality' =>  'Filipino',
            'date_of_birth' =>  '1970-01-01',
            'password' =>  Hash::make($attributes['password'])
        );
        return $this->user->create($prepData);
    }

    private function storeUserCustom(array $attributes)
    {
        $userRoleRes = $this->userRole->findByCustomWhere(['name' => $attributes['usertype']]);
        $prepData = array(
            'user_id' =>  $attributes['user_id'],
            'user_role_id' =>  $userRoleRes->user_role_id,
            'status' =>  1,
        );

        return $this->userCustom->create($prepData);
    }

    private function storeUserIndividual(array $attributes)
    {
        $prepData = array(
            'user_id' =>  $attributes['user_id'],
            'customer_type' =>  $attributes['customer_type'],
            'status' =>  'pending',
        );
        return $this->userIndividual->create($prepData);
    }

    private function storeUserServiceProvider(array $attributes)
    {
        $prepData = array(
            'user_id' =>  $attributes['user_id'],
            'clinic_id' =>  $attributes['clinic_id'],
            'status' =>  1,
        );
        return $this->userServiceProvider->create($prepData);
    }

    private function storeProvider(array $attribs)
    {
        $prepData = array(
            'clinic_name' => $attribs['clinic_name'],
            'clinic_description' => $attribs['clinic_description'],
            'clinic_mobile_number' => $attribs['clinic_mobile_number'],
            'clinic_email' => $attribs['clinic_email'],
            'clinic_address_id' => $attribs['clinic_address_id'],
            'clinic_status_id' => 1
        );
        return $this->provider->create($prepData);
    }

    private function storeProviderAddress(array $attribs)
    {
        $prepData = array(
            'clinic_region_code' => $attribs['clinic_region_code'],
            'clinic_province_code' => $attribs['clinic_province_code'],
            'clinic_city_code' => $attribs['clinic_city_code'],
            'clinic_brgy_code' => $attribs['clinic_brgy_code'],
            'clinic_region' => $attribs['clinic_region'],
            'clinic_province' => $attribs['clinic_province'],
            'clinic_city' => $attribs['clinic_city'],
            'clinic_brgy' => $attribs['clinic_brgy'],
            'clinic_address' => $attribs['clinic_address'],
            'clinic_landmark' => $attribs['clinic_landmark'],
            'clinic_zip_code' => $attribs['clinic_zip_code'],
            'clinic_longtitude' => $attribs['clinic_longtitude'],
            'clinic_latitude' => $attribs['clinic_latitude'],
        );
        return $this->location->create($prepData);
    }

    private function storeUserVerification(array $attributes)
    {
        $prepData = array(
            'user_id' =>  $attributes['user_id'],
            'type' =>  $attributes['type'],
            'value' =>  $attributes['mobile_number'],
            'verification_code' =>  $attributes['verification_code'],
            'expire_at' =>  $attributes['expire_at'],
            'status' =>  'pending',
        );
        return $this->userVerification->create($prepData);
    }

    public function sendMobileOTP($mobileNum, $message, $userId)
    {
        $mobileNumber =  '+63'.substr($mobileNum, 1);
        $transId = strtotime(date('Y-m-d H:i:s')).$userId;
        $m360 = new M360();
        $m360->set_msisdn($mobileNumber);
        $m360->set_content($message);
        $m360->set_rcvd_transid($transId);
        $m360->send();

        return $m360->success();
    }

    private function updateUserInfo($id, array $attributes)
    {
        $chkdata = $this->user->find($id);
        if ($chkdata) {
            $chkdata->firstname = $attributes['firstname'];
            $chkdata->middlename = $attributes['middlename'];
            $chkdata->lastname = $attributes['lastname'];
            $chkdata->mobile_number = $attributes['mobile_number'];
            $chkdata->email = $attributes['email'];
            $chkdata->age = isset($attributes['age']) ? $attributes['age'] : 0;
        }
        if(isset($attributes['username'])){
            $chkdata->username = $attributes['username'];
        }
        if(isset($attributes['gender'])){
            $chkdata->gender = $attributes['gender'];
        }
        if(isset($attributes['birthday'])){
            $chkdata->date_of_birth = $attributes['birthday'];
        }
        if(isset($attributes['nationality'])){
            $chkdata->nationality = $attributes['nationality'];
        }
        
        return $chkdata->save();
    }

    public function validateOTP(array $attributes)
    {
        $response = array(
            'status' => false,
            'message' => 'Something went wrong.'
        );

        $data = $this->checkIfVerified($attributes);

        if ($data) {
            if($data['status'] === 'active'){
                $response['status'] = true;
                $response['message'] = 'Account verified.';
                return $response;
            }

            if( $data == true && ($attributes['key'] == $data['mobile_number'] && $attributes['code'] == $data['verification_code']) ){
                $expire_at = $data['expire_at'];
                $now = Carbon::now()->format('y-m-d H:i:s');
                if (strtotime($expire_at) >= strtotime($now)) {
                    $this->userVerification->update($data['verification_id'], array('status' => 'active'));
                    $userIndividualItem = $this->userIndividual->findByCustomWhere(['user_id' => $data['user_id']]);
                    $this->userIndividual->update($userIndividualItem->user_individual_id, array('status' => 'active'));
                    $response['status'] = true;
                    $response['message'] = 'Account verified.';
                } else {
                    $this->userVerification->update($data['verification_id'], array('status' => 'expired'));
                    $response['message'] = 'Verification code has expired';
                }
            } else {
                $response['message'] = 'Verification code failed.';
            }

        } else {
            $response['message'] = 'Not Found.';
        }

        return $response;
    }

    public function resendOTP(array $attributes)
    {

        $response = array(
            'status' => false,
            'message' => 'Something went wrong.'
        );

        $data = $this->checkIfVerified($attributes);

        if ($data) {
            if ($data['attempts'] <= 3) {
                $data['attempts'] = $data['attempts'] + 1;
                if(!$data || $data['status'] === 'active'){
                    $response['status'] = true;
                    $response['message'] = 'A verification code has been sent to your mobile number.';
                    return $response;
                }

                $OTPcode = mt_rand(100000,999999);
                $OTPmessage = "Please use this verification code for your account verification ".$OTPcode;
                $expire_at = Carbon::now()->addMinute(2)->format('y-m-d H:i:s');

                if($this->sendMobileOTP($data['mobile_number'], $OTPmessage, $data['user_id'])) {
                    $this->userVerification->update(
                        $data['verification_id'],
                        array( 
                            'expire_at' => $expire_at,
                            'updated_at' => Carbon::now(),
                            'verification_code' => $OTPcode,
                            'attempts' => $data['attempts']
                        )
                    );
                    $response['status'] = true;
                    $response['message'] = 'A verification code has been sent to your mobile number.';
                }else{
                    $response['message'] = 'Failed to send the OTP verification message.';
                }
            } else {
                $response['message'] = 'You have reach the OTP Limit';
            }
        } else {
            $response['message'] = 'Invalid key to verify.';
        }
        
        return $response;
    }

    private function checkIfVerified(array $attributes)
    {

        if($attributes['type'] == 'mobile'){
            $data = $this->user->findByMobile($attributes['key']);
            // $data = $this->userVerification->findByCustomWhere(['otp_number' => $attributes['key'], 'user_id' => $attributes['user_id']]);
        }
        else if($attributes['type'] == 'email'){
            $data = $this->user->findByEmail($attributes['key']);
        }
        else{
            $response['message'] = 'Invalid key to verify.';
        }

        return $data;

    }

    public function fetchAllUser()
    {
        return $this->user->all();
    }

    public function fetchAllServiceProvider($request)
    {

    
        $response = array(
            'status' => false,
            'message' => 'Something went wrong'
        );

        $search = array();
        if(isset($request->search)){
            $search = array($request->search);
        }

        $data = $this->userServiceProvider->fetchWithSort(['clinic'], ['*'], 'DESC', $search);

        if($data){
            $response['status'] = true;
            $response['message'] = 'Fetched Clinic Admin accounts.';
            $response['data'] = $data;
        }else{
            $response['status'] = true;
            $response['message'] = 'No accounts listed.';
        }

        return $response;
    }

    public function storeUserServiceProviderByAdmin(array $attributes)
    {
        $response = array(
            'status' => false,
            'message' => 'Something went wrong'
        );

        $userItem = $this->storeUser($attributes);
        if($userItem->wasRecentlyCreated === true) {
            $attributes['user_id'] = $userItem->user_id;
            $userProviderRes = $this->storeUserServiceProvider($attributes);
            if ($userProviderRes->wasRecentlyCreated === true){
                $response['status'] = true;
                $response['message'] = 'Clinic assigned to a user successfully.';
            }
        }

        return $response;
    }

    public function updateUserProvider($id, array $attributes)
    {
        $response = array(
            'status' => false,
            'message' => 'Something went wrong'
        );

        $isUserProvider = $this->userServiceProvider->findByCustomWhere(['user_id' => $id]);
        if ($isUserProvider) {
            if($this->updateUserInfo($id, $attributes))
            {
                $response['status'] = true;
                $response['message'] = 'User has been updated successfully.';
            }
        } else {
            $response['message'] = 'User ID does not exist, failed to update.';
        }
        

        return $response;
    }

    public function showUserProvider($id)
    {
        $response = array(
            'status' => false,
            'message' => 'Something went wrong'
        );

        $isUserProvider = $this->userServiceProvider->findByCustomWhere(['user_id' => $id]);
        if ($isUserProvider) {
            $response['status'] = true;
            $response['message'] = 'Fetched successfully.';
            $response['data'] = $this->user->find($id);
        } else {
            $response['message'] = 'User ID does not exist, failed to fetch.';
        }
        

        return $response;
    }

    public function show($id)
    {
        return $this->user->find($id);
    }

    public function allPatient()
    {
        return $this->user->fetchAllPatient();
    }

    public function showPatient($id)
    {
        return $this->user->fetchPatient($id);
    }

    public function totalUsers()
    {
        return $this->userIndividual->all()->count();
    }

    public function forgotPassword($email)
    {
        $response = array(
            'status' => false,
            'message' => 'Something went wrong'
        );

        $status = Password::sendResetLink($email);
        $response['message'] = __($status);

        if ($status === Password::RESET_LINK_SENT) {
            $response['status'] = true;
        }

        return $response;
    }
    

    public function resetUserPassword(array $attrib)
    {
        $response = array(
            'status' => false,
            'message' => 'Something went wrong'
        );

        $isUserProvider = $this->userServiceProvider->findByCustomWhere(['user_id' => $attrib['clinic_account_id']]);
        if($isUserProvider){
            $newpass = StringHelper::random_string(8);
            $chkUser = $this->user->find($attrib['clinic_account_id']);
            $chkUser->password = Hash::make($newpass);
            $chkUser->save();

            $response['status'] = true;
            $response['data'] = $newpass;
            $response['message'] = 'Generated new password successfully.';
        }else{
            $response['message'] = 'Not a clinic account.';
        }

        return $response;
    }

    public function updatePassword(array $attributes)
    {
        $response = array(
            'status' => false,
            'message' => 'Something went wrong'
        );

        $status = Password::reset(
        $attributes,
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
            }
        );

        $response['message'] = __($status);

        if ($status === Password::PASSWORD_RESET) {
            $response['status'] = true;
        }

        return $response;
    }

    public function validateUserType($id, $usertype)
    {
        if ($usertype == 'individual') {
            return $this->userIndividual->findByCustomWhere(['user_id' => $id]);
        } 
        else if ($usertype == 'serviceprovider') {
            return $this->userServiceProvider->findByCustomWhere(['user_id' => $id]);
        } 
        else if ($usertype == 'admin') {
            return $this->userCustom->findByCustomWhere(['user_id' => $id, 'user_role_id' => 2]);
        }
    }

    public function storeUserIndividualByAdmin(array $attributes)
    {
        $response = array(
            'status' => false,
            'message' => 'Something went wrong'
        );

        $userItem = $this->storeUser($attributes);
        if($userItem->wasRecentlyCreated === true) {
            $attributes['user_id'] = $userItem->user_id;
            $attributes['customer_type'] = "app_user";
            $userProviderRes = $this->storeUserIndividual($attributes);
            if ($userProviderRes->wasRecentlyCreated === true){
                $response['status'] = true;
                $response['message'] = 'User individual created successfully.';
            }
        }

        return $response;
    }

    public function fetchAllUserIndividual()
    {
        $response = array(
            'status' => false,
            'message' => 'Something went wrong'
        );

        $data = $this->userIndividual->fetchWithSort([],['*'], 'DESC');

        if($data){
            $response['status'] = true;
            $response['message'] = 'Fetch Individual users.';
            $response['data'] = $data;
        }else{
            $response['status'] = true;
            $response['message'] = 'No data found.';
            $response['data'] = [];
        }

        return $response;
    }

    public function showUserIndividual($id)
    {
        $response = array(
            'status' => false,
            'message' => 'Something went wrong'
        );

        $userIndividualItem =  $this->userIndividual->findByCustomWhere(['user_id' => $id]);
        if ($userIndividualItem) {
            $response['status'] = true;
            $response['message'] = 'Fetched!';
            $response['data'] = $userIndividualItem;
        } else {
            $response['message'] = 'User ID does not exist, failed to fetch.';
        }
        return $response;
    }

    public function updateUserIndividual($id, $attributes)
    {
        $response = array(
            'status' => false,
            'message' => 'Something went wrong'
        );

        $isUserIndividual =  $this->userIndividual->findByCustomWhere(['user_id' => $id]);
        if ($isUserIndividual) {
            if($this->updateUserIndividualInfo($id, $attributes)){
                $response['status'] = true;
                $response['message'] = 'User individual has been updated successfully.';
            }
        } else {
            $response['message'] = 'User ID does not exist, failed to update.';
        }
        return $response;
    }

    private function updateUserIndividualInfo($id, $attribs)
    {
        $chkdata = $this->user->find($id);
        if ($chkdata) {
            $chkdata->firstname = $attribs['firstname'];
            $chkdata->middlename = $attribs['middlename'];
            $chkdata->lastname = $attribs['lastname'];
            $chkdata->age = isset($attribs['age']) ? $attribs['age'] : 0;
        }
        if(isset($attribs['username'])){
            $chkdata->username = $attribs['username'];
        }
        if(isset($attribs['gender'])){
            $chkdata->gender = $attribs['gender'];
        }
        if(isset($attribs['birthday'])){
            $chkdata->date_of_birth = $attribs['birthday'];
        }
        if(isset($attribs['nationality'])){
            $chkdata->nationality = $attribs['nationality'];
        }
        return $chkdata->save();
    }

    public function changeUserIndividualStatus($id, array $attributes)
    {
        $response = array(
            'status' => false,
            'message' => 'Something went wrong'
        );

        $isUserIndividual = $this->userIndividual->findByCustomWhere(['user_id' => $id]);
        if ($isUserIndividual) {
            if ($this->userIndividual->update($isUserIndividual->user_individual_id, array('status' => $attributes['status']))) {
                $response['status'] = true;
                $response['message'] = 'User individual status has been updated successfully.';
            }
        } else {
            $response['message'] = 'User ID does not exist, failed to change status.';
        }
        return $response;
    }

    public function validateUserStatus($id)
    {
        $userIndividualItem = $this->userIndividual->findByCustomWhere(['user_id' => $id]);
        $result['user_status'] = $userIndividualItem->status;
        return $result;

    }


}
