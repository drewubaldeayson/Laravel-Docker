<?php

namespace App\Repositories\Eloquent;

use App\Models\UserCorporate;
use App\Contracts\UserCorporateRepositoryInterface;
use Illuminate\Support\Collection;

class UserCorporateRepository extends BaseRepository implements UserCorporateRepositoryInterface
{

    /**
    * UserCorporateRepository constructor.
    *
    * @param UserCorporate $model
    */
   public function __construct(UserCorporate $model)
   {
       parent::__construct($model);
   }


}