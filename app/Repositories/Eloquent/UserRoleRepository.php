<?php

namespace App\Repositories\Eloquent;

use App\Models\UserRole;
use App\Contracts\UserRoleRepositoryInterface;
use Illuminate\Support\Collection;

class UserRoleRepository extends BaseRepository implements UserRoleRepositoryInterface
{

    /**
    * UserRoleRepository constructor.
    *
    * @param UserRole $model
    */
   public function __construct(UserRole $model)
   {
       parent::__construct($model);
   }


}