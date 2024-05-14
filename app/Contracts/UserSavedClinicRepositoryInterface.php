<?php

namespace App\Contracts;

interface UserSavedClinicRepositoryInterface extends EloquentRepositoryInterface
{
   public function findByUserID($id);
    
}