<?php

namespace App\Repositories\Eloquent;

use App\Models\UserIndividual;
use App\Contracts\UserIndividualRepositoryInterface;
use Illuminate\Support\Collection;

class UserIndividualRepository extends BaseRepository implements UserIndividualRepositoryInterface
{

    /**
    * UserIndividualRepository constructor.
    *
    * @param UserIndividual $model
    */
   public function __construct(UserIndividual $model)
   {
       parent::__construct($model);
   }


}