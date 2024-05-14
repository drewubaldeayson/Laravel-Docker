<?php

namespace App\Repositories\Eloquent;

use App\Models\UserVerification;
use App\Contracts\UserVerificationRepositoryInterface;

class UserVerificationRepository extends BaseRepository implements UserVerificationRepositoryInterface
{

    /**
    * UserVerificationRepository constructor.
    *
    * @param UserVerification $model
    */
   public function __construct(UserVerification $model)
   {
       parent::__construct($model);
   }


}