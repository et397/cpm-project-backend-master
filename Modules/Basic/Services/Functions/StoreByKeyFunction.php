<?php
namespace Modules\Basic\Services\Functions;
use Illuminate\Http\Request;

trait StoreByKeyFunction {

   /**
     * Summary of store
     * @param Request $data
     * @return array
     */
    public function store(Request $data): array
    {
        $val = $data->validate($this->validate);
        $result = $this->repo->create($val);
        return $this->findByKey($result->toArray());
    }


}
