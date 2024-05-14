<?php

namespace App\Repositories\Eloquent;

use App\Models\UserSavedClinic;
use App\Contracts\UserSavedClinicRepositoryInterface;
use Illuminate\Support\Collection;

class UserSavedClinicRepository extends BaseRepository implements UserSavedClinicRepositoryInterface
{

    /**
    * UserSavedClinicRepository constructor.
    *
    * @param UserSavedClinic $model
    */
   public function __construct(UserSavedClinic $model)
   {
       parent::__construct($model);
   }

   public function findByUserID($id): Collection
   {
       return $this->model->where('user_id', $id)->get(['*']);
   }

   public function deleteSavedClinic($user_id, $clinic_id)
   {
        return $this->model->where('user_id',$user_id)->where('clinic_id', $clinic_id)->delete();
   }

   public function isExisting($user_id, $clinic_id)
   {
       return $this->model->where('user_id',$user_id)->where('clinic_id', $clinic_id)->first();
   }

}