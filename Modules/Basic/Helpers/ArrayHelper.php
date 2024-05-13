<?php
namespace Modules\Basic\Helpers;

class ArrayHelper {
    static function group_by(array $array, $key) {
        $result = [];
        foreach ($array as $item) {
            $result[$item[$key]][] = $item;
        }
        return $result;
    }
}
