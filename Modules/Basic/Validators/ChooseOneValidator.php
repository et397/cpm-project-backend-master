<?php
namespace Modules\Basic\Validators;

class ChooseOneValidator
{
   
    public static function replace($message, $attribute, $rule, $parameters, $customAttributes)
    {
        $attributeName = $parameters[0];
        $attrInfos = $customAttributes;
        if(count($attrInfos) > 0)
        {
            return str_replace([':attribute', ':param'], [$attrInfos[$attribute], $attrInfos[$attributeName]], ':attribute 與 :param 必須擇一輸入。');
        } else {
            return str_replace([':attribute', ':param'], [$attribute, $attributeName], ':attribute 與 :param 必須擇一輸入。');
        }
    }

    /**
     * Summary of ChooseOneValidator
     * @param mixed $attribute
     * @param mixed $value
     * @param mixed $parameters
     * @return bool
     */
    public static function validate($attribute, $value, $parameters, $validator)
    {
        $attributeName = $parameters[0];
        $type = 'string';
        if(isset($parameters[1])){
            $type = $parameters[1];
        }

        $option1 = $validator->getData()[$attributeName] ?? null;

        if ($option1 === null && $value === null) {
            return false; // 兩個選項都為 null，不符合要求，返回 false
        } else {
            // TODO 只先處理兩種型別
            if($type === "integer" || $type === "numeric" ){
                if ($option1 === 0 && $value === 0) {
                    return false; // 兩個選項都為 0，不符合要求，返回 false
                }
            }
        }

        return true; // 符合要求，返回 true
    }
}
