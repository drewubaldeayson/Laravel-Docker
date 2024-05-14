<?php

namespace App\Contracts;

interface UserRepositoryInterface extends EloquentRepositoryInterface
{

    public function findByUsername($username);

    public function findByMobile($mobileNumber);

    public function findByEmail($email);

    public function findDefaultAddressByUserId($id);
    
    public function fetchAllPatient();

    public function fetchPatient($id);

}