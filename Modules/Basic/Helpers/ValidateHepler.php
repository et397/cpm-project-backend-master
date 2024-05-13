<?php
namespace Modules\Basic\Helpers;

/**
 * 檢核字串轉array
 */
class ValidateHepler
{
    public static function toArray($validate) : array
    {
        if(is_string($validate)){
            $array = explode('|', $validate);
            return $array;
        }
        return $validate;
    }

}
