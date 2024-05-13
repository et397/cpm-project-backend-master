<?php
namespace Modules\Basic\Validators;

use Illuminate\Contracts\Validation\Rule;

class OneFieldRequired implements Rule
{
    //todo 目前有問題，無法設定正確的參數

    private $fields;

    public function __construct(...$fields)
    {
        $this->fields = $fields;
    }

    public function passes($attribute, $value)
    {
        $filledCount = 0;

        foreach ($this->fields as $field) {
            if (!empty(request()->input($field))) {
                $filledCount++;
            }
        }

        return $filledCount === 1;
    }

    public function message()
    {
        return '請選擇其中一個欄位輸入。';
    }
}
