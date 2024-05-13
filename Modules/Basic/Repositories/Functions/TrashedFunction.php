<?php
namespace Modules\Basic\Repositories\Functions;
use Illuminate\Database\Eloquent\Model;

/**
 * repo用:軟刪除功能集
 * */
trait TrashedFunction{


    /**
     * Summary of GetMax
     * @param string $id
     * @return array
     */
    public function getByIdWithTrashed(int $id)
    {
        return $this->query()->withTrashed()->findOrFail($id);
    }

    public function getByIdOnlyTrashed(int $id)
    {
        return $this->query()->onlyTrashed()->findOrFail($id);
    }


    /**
     * Summary of getByIdWithTrashed
     * @param int $id
     */
    public function getByFieldWithTrashed(string $modelField, $value)
    {
        return $this->query()->withTrashed()->where($modelField, $value)->get();
    }


    public function getByFieldOnlyTrashed(string $modelField, $value)
    {
        return $this->query()->onlyTrashed()->where($modelField, $value)->get();
    }


    public function restore(Model $model) : bool
    {
        return $model->restore();
    }

    public function forceDelete(Model $model): bool
    {
        return $model->forceDelete();
    }

}
