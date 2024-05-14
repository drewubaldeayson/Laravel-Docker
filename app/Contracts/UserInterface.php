<?php

namespace App\Contracts;

interface UserInterface
{

    public function signUpUser(array $attributes);

    public function sendMobileOTP($mobileNum, $message, $userId);

    public function validateOTP(array $attributes);

    public function resendOTP(array $attributes);

    public function fetchAllUser();

    public function storeUserServiceProviderByAdmin(array $attributes);

    public function show($id);

    public function showUserProvider($id);

    public function forgotPassword($email);

    public function updatePassword(array $attributes);

    public function refreshToken();

    public function validateUserType($id, $usertype);

    public function fetchAllServiceProvider($request);

    public function updateUserProvider($id, array $attributes);

    public function fetchAllUserIndividual();

    public function showUserIndividual($id);

    public function changeUserIndividualStatus($id, array $attributes);

    public function storeUserIndividualByAdmin(array $attributes);

    public function validateUserStatus($id);

}