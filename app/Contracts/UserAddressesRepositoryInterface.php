<?php

namespace App\Contracts;

interface UserAddressesRepositoryInterface extends EloquentRepositoryInterface
{
    
    public function findByUserID($id);

    public function findAddressesByUserID($id);

    
}