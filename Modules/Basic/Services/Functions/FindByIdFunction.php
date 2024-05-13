<?php
namespace Modules\Basic\Services\Functions;

trait FindByIdFunction {

    /**
     * Summary of find
     * @param mixed $id
     * @return array
     */
    public function findById($id): array
    {
        $result = $this->repo->getById($id);
        return $result->toArray();
    }

}
