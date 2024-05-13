<?php
namespace Modules\Basic\Services\Functions;
use Illuminate\Http\Request;

trait EditByKeyFunction {

    /**
     * Summary of edit
     * @param array $keyValues
     * @param Request $data
     * @return array<string>
     */
    public function edit(array $keyValues, Request $data): array
    {
        $exclude = implode(',', $keyValues) . ',' . implode(',', array_keys($keyValues));

        foreach($this->judges as $judge){
            $this->validate[$judge] .= ',' . $exclude;
        }
        $val = $data->validate($this->validate);
        $material = $this->repo->getByKeys($keyValues);
        $this->repo->updateByKey($keyValues, $val);

        return $material->toArray();
    }


}
