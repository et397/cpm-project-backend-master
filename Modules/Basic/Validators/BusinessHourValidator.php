<?php
namespace Modules\Basic\Validators;


/**
 * Summary of BusinessHourValidator
 * 開店時間
 */
class BusinessHourValidator {

    /**
     * Summary of BusinessHourValidator
     * @param mixed $attribute
     * @param mixed $value
     * @param mixed $parameters
     * @return bool
     */
    public static function validate($attribute, $value, $parameters, $validator)
    {
        return is_string($value) && preg_match('/^(((0[0-9]|1[0-9]|2[0-3])[0-5]{1}[0-9]{1})-((0[0-9]|1[0-9]|2[0-3])[0-5]{1}[0-9]{1})|close)+$/u', $value);
    }
}

