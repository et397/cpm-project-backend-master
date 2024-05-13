<?php

namespace Modules\Basic\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Modules\Basic\Repositories\FunctionRepository;

/**
 * Summary of Service
 */
abstract class FunctionService
{

    protected $repo;


    /**
     * Summary of __construct
     * @param $repository
     */
    public function __construct($repository)
    {
        $this->repo = $repository;
    }


    /**
     * Summary of index
     * @param array $columns
     * @param int $page
     * @param int $perPage
     * @param array|null $relations
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function index(\Closure $query, int $page = 1, int $perPage = 50): LengthAwarePaginator
    {
        $result = $this->repo->paginate($query, $page, $perPage);
        return $result;
    }


    /**
     * Summary of count
     * @param mixed $modelField
     * @param mixed $value
     * @return int
     */
    public function count(mixed $modelField = null, mixed $value = null): int
    {
        $result = $this->repo->count(function($query) use ($modelField, $value){
            if($modelField && $value){
                if(is_string($modelField) && is_string($value)){
                    $query->where($modelField, $value);
                } else {
                    foreach($modelField as $key => $field){
                        $query->where($field, $value[$key]);
                    }
                }
            }
        });
        return $result;
    }

    /**
     * Summary of findById
     * @param mixed $id
     * @param array|null $columns
     * @param array|null $relations
     */
    public function findById($id, array|null $columns = null, array|null $relations = null)
    {
        $result = $this->repo->findById($id, $columns, $relations);
        return $result;
    }

    /**
     * Summary of getByIds
     * @param array $ids
     * @param array|null $columns
     * @param array|null $relations
     * @return \Illuminate\Support\Collection
     */
    public function getByIds(array $ids, array|null $columns = null, array|null $relations = null): Collection
    {
        $result = $this->repo->getByIds($ids, $columns, $relations);
        return $result;
    }

    public function first(mixed $modelField = null, mixed $value = null)
    {
        $result = $this->repo->first(function($query) use ($modelField, $value){
            if($modelField && $value){
                if(is_string($modelField) && is_string($value)){
                    $query->where($modelField, $value);
                } else {
                    foreach($modelField as $key => $field){
                        $query->where($field, $value[$key]);
                    }
                }
            }
        });
        return $result;
    }


    public function store($data)
    {
        $result = $this->repo->create($data);
        return $this->findById($result->id, ['*'], []);
    }


    public function edit(int $id, array $data)
    {
        $this->repo->update($id, $data);
        return $this->findById($id, ['*'], []);
    }


    public function remove(int $id): bool
    {
        return $this->repo->delete($id);
    }

    public function removeByIds(array $ids): bool
    {
        return $this->repo->deleteByIds($ids);
    }

    public function insert(array $data): bool
    {
        return $this->repo->insert($data);
    }

}
