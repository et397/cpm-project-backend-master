<?php
namespace Modules\Basic\Repositories\Functions;

/**
 * repo用:排序符號>數字>英文
 */
trait OrderBySymbolNumberLetterFunction{

    public function orderBySymbolNumberLetter($builder, $column, $order = 'asc')
    {
        $orderType = ($order === 'desc') ? 'desc' : 'asc';

        return $builder->orderByRaw("
            CASE
                WHEN $column REGEXP '^[^a-zA-Z0-9]' THEN 1 -- 符號
                WHEN $column REGEXP '^[0-9]' THEN 2 -- 數字
                ELSE 3 -- 英文字母
            END $orderType")
            ->orderBy($column, $orderType);
    }
}
