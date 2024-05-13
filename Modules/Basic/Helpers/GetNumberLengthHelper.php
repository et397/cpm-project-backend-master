<?php
namespace Modules\Basic\Helpers;
use Exception;

/**
 * 取得數字長度
 */
class GetNumberLengthHelper
{
    public static function length(int $number) : int
    {
        $result = floor(log10(abs($number))) + 1;
        return $result;
    }
}
