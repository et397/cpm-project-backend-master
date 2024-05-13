<?php
namespace Modules\Basic\Helpers;
use Exception;

/**
 * 通用異體字轉換
 */
class TransformVariantCharHelper
{
    public static function transform(string $source) : string
    {
        $simplified = ['台', '体'];
        $traditional = ['臺', '體'];
        return str_replace($simplified, $traditional, $source);
    }
}
