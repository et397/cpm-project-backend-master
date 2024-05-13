<?php
namespace Modules\Basic\Helpers;

class Null2EmptyHepler
{
    public static function trim($value)
    {
        return is_null($value) ? "": $value;
    }
}
