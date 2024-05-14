<?php

namespace App\Repositories\Eloquent;

use App\Models\UserCustom;
use App\Contracts\UserCustomRepositoryInterface;
use Illuminate\Support\Collection;

class UserCustomRepository extends BaseRepository implements UserCustomRepositoryInterface
{

    /**
    * UserCustomRepository constructor.
    *
    * @param UserCustom $model
    */
   public function __construct(UserCustom $model)
   {
       parent::__construct($model);
   }


}