<?php
namespace Modules\Basic\Validators;

use Illuminate\Validation\Validator;
use Illuminate\Validation\Concerns\ValidatesAttributes;
use Modules\Basic\Validators\UniqueByPkeyValidator;
use Modules\Basic\Validators\UniqueInArrayValidator;

class BasicValidator extends Validator
{
    use ValidatesAttributes;

    /**
     * 檢核是否重覆，排除pkey
     */
    public function validateUniqueByPkey($attribute, $value, $parameters, $validator)
    {
        return UniqueByPkeyValidator::validate($attribute, $value, $parameters, $validator);
    }


    /**
     * 二者一輸入，自訂訊息
     */
    protected function replaceChooseOne($message, $attribute, $rule, $parameters)
    {
        return ChooseOneValidator::replace($message, $attribute, $rule, $parameters, $this->customAttributes);
    }

   /**
     * 二者一輸入
     */
    public function validateChooseOne($attribute, $value, $parameters, $validator)
    {
        return ChooseOneValidator::validate($attribute, $value, $parameters, $validator);
    }


    /**
     * 檢查在陣列內是否重覆
     */
    public function validateUniqueInArray($attribute, $value, $parameters, $validator)
    {
        return UniqueInArrayValidator::validate($attribute, $value, $parameters, $validator);
    }



}
