<?php

namespace App\Contracts;

interface AuthenticationServiceInterface
{

    public function authenticateProvider($data);

}