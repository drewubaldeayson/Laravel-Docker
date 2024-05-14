<?php

namespace App\Repositories\Eloquent;

use App\Models\UserAddresses;
use App\Contracts\UserAddressesRepositoryInterface;

class UserAddressesRepository extends BaseRepository implements UserAddressesRepositoryInterface
{

    /**
    * UserAddressesRepository constructor.
    *
    * @param UserAddresses $model
    */
   public function __construct(UserAddresses $model)
   {
       parent::__construct($model);
   }


   public function findByUserID($id)
   {
        return $this->model->where('user_id', $id)->first();
   }

   public function findAddressesByUserID($id)
   {
        return $this->model->where('user_id', $id)->get();
   }


}