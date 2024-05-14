<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Contracts\UserRepositoryInterface;
use Illuminate\Support\Collection;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    /**
    * UserRepository constructor.
    *
    * @param User $model
    */
    public function __construct(User $model)
    {
       parent::__construct($model);
    }


    public function findByUsername($username)
    {
       return $this->model->where('username', $username)->first();
    }

    public function findByMobile($mobileNumber)
    {
        return $this->model->where('mobile_number', $mobileNumber)
            ->leftJoin('user_verification', 'users.user_id', '=', 'user_verification.user_id')
            ->first();
    }

    public function findByEmail($email)
    {
        return $this->model->where('email', $email)
            ->leftJoin('user_verification', 'users.user_id', '=', 'user_verification.user_id')
            ->first();
    }

    public function findDefaultAddressByUserId($id)
    {
        return $this->model->select('*')
            ->leftJoin('user_adresses', 'users.user_id', '=', 'user_adresses.user_id')
            ->where('users.user_id', $id)
            ->where('user_adresses.is_default', 1)
            ->first();
    }

    public function fetchAllPatient()
    {
        return $this->model->select('users.*', 'user_individual.status')->join('user_individual', 'users.user_id', 'user_individual.user_id')->get();
    }

    public function fetchPatient($id)
    {
        return $this->model->select('users.*', 'user_individual.status')
        ->join('user_individual', 'users.user_id', 'user_individual.user_id')
        ->where('users.user_id', $id)
        ->first();
    }

}