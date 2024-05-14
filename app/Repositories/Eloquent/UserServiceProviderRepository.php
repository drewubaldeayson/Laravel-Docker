<?php

namespace App\Repositories\Eloquent;

use App\Models\UserServiceProvider;
use App\Contracts\UserServiceProviderRepositoryInterface;
use Illuminate\Support\Collection;

class UserServiceProviderRepository extends BaseRepository implements UserServiceProviderRepositoryInterface
{

    /**
    * UserServiceProviderRepository constructor.
    *
    * @param UserServiceProvider $model
    */
   public function __construct(UserServiceProvider $model)
   {
       parent::__construct($model);
   }


   public function fetchWithSort(array $relations = [], array $columns = ['*'], $sort = 'ASC', array $whereAttributes = [])
   {
         $query = $this->model->select('user_service_provider.*','clinic.*', 'users.*')
               ->join('clinic', 'user_service_provider.clinic_id', 'clinic.clinic_id')
               ->join('users', 'user_service_provider.user_id', 'users.user_id')
                ->where([])
                ->orderBy('user_service_provider.created_at', $sort);
              
               
        $whereAttributes = implode(" ", $whereAttributes);
        if($whereAttributes != ''){
                $query = $query->where('users.firstname', 'LIKE', '%'.$whereAttributes.'%')
                            ->orwhere('users.middlename', 'LIKE', '%'.$whereAttributes.'%')
                            ->orwhere('users.lastname', 'LIKE', '%'.$whereAttributes.'%')
                            ->orwhere('users.mobile_number', 'LIKE', '%'.$whereAttributes.'%')
                            ->orwhere('users.email', 'LIKE', '%'.$whereAttributes.'%');
        }

        return $query->paginate($this->perPage, $columns);
   }



}