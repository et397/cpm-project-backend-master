<?php
namespace Modules\Basic\Services\Functions;
use Illuminate\Http\Request;

trait RemoveByKeyFunction {

    /**
     * Summary of remove
     * @param array
     * @return void
     */
    public function remove(array $keyValues): bool
    {
        return $this->repo->deleteByKey($keyValues);
    }


}
