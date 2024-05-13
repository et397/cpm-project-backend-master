<?php

namespace Modules\Basic\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Modules\Basic\Exceptions\CustomizeException;

/**
 * Summary of Repository
 */
abstract class FunctionRepository
{
    protected Model $model;

    public function __construct()
    {
        $this->model = app($this->model());
    }

    public abstract function model(): string;

    protected function query(Builder|null $builder = null): Builder
    {
        if (is_null($builder)) {
            $builder = $this->model->newQuery();
        }
        return $builder;
    }

    public function findById(int $id, array $columns = ['*'], array $relations = []): Model
    {
        $builder = $this->query(null);
        return $builder->with($relations)->find($id, $columns);
    }

    public function get(\Closure $query, Builder|null $builder = null, array $columns = ['*']) : \Illuminate\Database\Eloquent\Collection
    {
        $builder = $this->query($builder);
        $query($builder);
        return $builder->get($columns);
    }

    public function first(\Closure $query, Builder|null $builder = null, array $columns = ['*']): Model
    {
        $builder = $this->query($builder);
        $query($builder);
        return $builder->firstOrFail($columns);
    }

    public function paginate(\Closure $query, int $page = 1, int $perPage = 15, Builder|null $builder = null): \Illuminate\Pagination\LengthAwarePaginator
    {
        $builder = $this->query($builder);
        $query($builder);
        return $builder->paginate($perPage, ['*'], 'page', $page);
    }

    public function count(string $column, \Closure $query, Builder|null $builder = null): int
    {
        $builder = $this->query($builder);
        $query($builder);
        return $builder->count($column);
    }


    public function max(string $column, \Closure $query, Builder|null $builder = null): int
    {
        $builder = $this->query($builder);
        $query($builder);
        return $builder->max($column);
    }

    public function min(string $column, \Closure $query, Builder|null $builder = null): int
    {
        $builder = $this->query($builder);
        $query($builder);
        return $builder->min($column);
    }

    public function sum(string $column, \Closure $query, Builder|null $builder = null): int
    {
        $builder = $this->query($builder);
        $query($builder);
        return $builder->sum($column);
    }

    public function filter(\Closure $query, Builder|null $builder = null): Builder
    {
        $builder = $this->query($builder);
        $query($builder);
        return $builder;
    }

    public function like(Builder $builder, $keyword, $columns): Builder
    {
        return $builder->where(function ($query) use ($keyword, $columns) {
            foreach ($columns as $column) {
                $query->orWhere($column, 'like', "%{$keyword}%");
            }
        });
    }

    public function order(Builder $builder, $order): Builder
    {
        if (is_null($order)) {
        } else if (is_object($order)) {
            foreach ($order as $key => $value) {
                $builder->orderBy($key, $value);
            }
        }
        return $builder;
    }

    public function getByIds(array $ids, array $columns = ['*'], array $relations = []): \Illuminate\Database\Eloquent\Collection
    {
        return $this->get(function($query) use ($ids, $columns, $relations){
            $query->whereIn('id', $ids);
            $query->select($columns);
            $query->with($relations);
        });
    }

    /**
     * Summary of create
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * Summary of update
     * @param int $id
     * @param array $data
     * @return Model
     */
    public function update(int $id, array $data): Model
    {
        $model = $this->model->findOrFail($id);
        $model->fill($data);

        $success = $model->updateOrFail($data);
        if (!$success) {
            throw new CustomizeException("異動失敗");
        }

        return $model;
    }

    /**
     * Summary of delete
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->model->findOrFail($id)->deleteOrFail();
    }


    public function deleteByIds(array $ids): bool
    {
        return $this->model->whereIn('id', $ids)->delete();
    }

    public function updateByIds(array $ids, array $data): bool
    {
        return $this->model->whereIn('id', $ids)->update($data);
    }

    public function insert(array $data): bool
    {
        return $this->model->insert($data);
    }


    public function updateOrCreate(array $data, array $condition): Model
    {
        return $this->model->updateOrCreate($condition, $data);
    }

}
