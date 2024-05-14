<?php

namespace App\Contracts;

interface AuthenticationRepositoryInterface
{
    public function getDetails($data);

}