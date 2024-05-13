<?php
namespace Modules\Basic\Repositories\Functions;

/**
 * repo用:取得欄位最大值
 */
trait GetMaxFunction{


    public function getMax(string $column)
    {
        return $this->model->max($column);
    }


    public function getMaxWithTrashed(string $column)
    {
        return $this->model->withTrashed()->max($column);
    }
}
