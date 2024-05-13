<?php
namespace Modules\Basic\Services\Functions;

trait FindByKeyFunction {

    /**
     * Summary of find
     * @param array $keyValues
     * @return array
     */
    public function findByKey(array $keyValues): array
    {
        $result = $this->repo->getBykeys($keyValues);
        return $result->toArray();
    }
}
