<?php

namespace App\Repositories\Eloquent;

use App\Contracts\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements EloquentRepositoryInterface 
{     
    /**      
     * @var Model      
     */     
     protected $model;
     protected $perPage = 5;

    /**      
     * BaseRepository constructor.      
     *      
     * @param Model $model      
     */     
    public function __construct(Model $model)     
    {         
        $this->model = $model;
    }

    /**
     * 
     * @param array @columns
     * @param array @relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): Collection
    {
        return  $this->model->with($relations)->get($columns);
    }
 
    /**
    * @param array $attributes
    *
    * @return Model
    */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }
 
    /**
    * @param $id
    * @return Model
    */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }
    
    /**
    * find by custom where.
    * 
    * @param array $whereAttributes
    * @return bool
    */
    public function findByCustomWhere(array $whereAttributes): ?Model
    {
        return $this->model->where($whereAttributes)->first();
    }

    /**
    * fetch by custom where.
    * 
    * @param array $whereAttributes
    * @return bool
    */
    public function fetchByCustomWhere(array $whereAttributes): ?Collection
    {
        return $this->model->where($whereAttributes)->get();
    }


    /**
    * fetch by latest
    * 
    * @param array $relations
    * @param array $columns
    * @param string $sort
    * @return bool
    */
    public function fetchWithSort(array $relations = [], array $columns = ['*'], $sort = 'ASC', array $whereAttributes = [])
    {
       
        return $this->model
                ->with($relations)
                ->where($whereAttributes)
                ->orderBy('created_at', $sort)
                ->paginate($this->perPage, $columns);
    }

    

    public function fetchAllWith($status, $filter)
    {
        if(!empty($filter)){
            if($status == 'all'){
                return $this->model
                            ->whereIn('status', [0,1,2])
                            ->whereBetween('created_at', $filter)
                            ->latest()
                            ->paginate($this->perPage);
            }
    
            $status_id = $status == 'active'? 1 : 0;
            return $this->model
                            ->where('status', $status_id)
                            ->whereBetween('created_at', $filter)
                            ->latest()
                            ->paginate($this->perPage);
        }

        if($status == 'all'){
            return $this->model
                        ->whereIn('status', [0,1,2])
                        ->latest()
                        ->paginate($this->perPage);
        }

        $status_id = $status == 'active'? 1 : 0;
        return $this->model
                        ->where('status', $status_id)
                        ->latest()
                        ->paginate($this->perPage);
    }


    /**
    * Update existing model.
    * 
    * @param int $modelId
    * @param array $attributes
    * @return bool
    */
    public function update(int $modelId, array $attributes): bool
    {
        $model = $this->find($modelId);

        return $model->update($attributes);
    }

   /**
    * Delete model by id.
    * 
    * @param int $modelId
    * @return bool
    */
    public function delete(int $modelId): bool
    {
        return $this->find($modelId)->delete();
    }


}