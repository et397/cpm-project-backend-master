<?php
namespace Modules\Basic\Validators;
use Modules\Basic\Exceptions\CustomizeException;

class UniqueInArrayValidator
{

    // public static function replace($message, $attribute, $rule, $parameters, $customAttributes)
    // {
    //     $attrInfos = $customAttributes;
    //     if(count($attrInfos) > 0)
    //     {
    //         return str_replace([':attribute'], [$attrInfos[$attribute]], ':attribute在傳入值必需是唯一');
    //     } else {
    //         return str_replace([':attribute'], [$attribute], ':attribute在傳入值必需是唯一。');
    //     }
    // }

    /**
     * Summary of UniqueInArrayValidator
     * @param mixed $attribute
     * @param mixed $value
     * @param mixed $parameters
     * @return bool
     */
    public static function validate($attribute, $value, $parameters, $validator)
    {
        $strArray = explode('.', $attribute);

        if(count($strArray) == 1){
            throw new \Exception("檢核格式並非為array");
        }
        $parentAttr = $strArray[0];
        $attr = end($strArray);

        $array = $validator->getData()[$parentAttr] ?? null;

        $columns = array_column($array, $attr);
        if (count($columns) !== count(array_unique($columns))) {
            return false;
        }
        return true; // 符合要求，返回 true
    }
}
