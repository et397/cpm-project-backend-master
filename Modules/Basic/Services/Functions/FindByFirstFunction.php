<?php
namespace Modules\Basic\Services\Functions;

trait FindByFirstFunction {

    /**
     * Summary of findFirst
     * @param string|null $modelField
     * @param mixed|null $value
     * @return array
     */
    public function findFirst(mixed $modelField = null, mixed $value = null): array
    {
        $result = $this->repo->getFirst($modelField, $value);
        return $result->toArray();
    }

}
