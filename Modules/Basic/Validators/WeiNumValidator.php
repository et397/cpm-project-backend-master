<?php
namespace Modules\Basic\Validators;


/**
 * Summary of WeiDashValidator
 * 字母、數字
 */
class WeiNumValidator {

    /**
     * Summary of validateWeiDash
     * @param mixed $attribute
     * @param mixed $value
     * @param mixed $parameters
     * @return bool
     */
    public static function validate($attribute, $value, $parameters, $validator)
    {
        return is_string($value) && preg_match('/^[a-zA-Z0-9]+$/u', $value);
    }
}

