<?php
namespace Modules\Basic\Helpers;
use Exception;

/**
 * 取得下一號英文字母
 */
class AlphaHelper
{
    public static function getNextAlpha(string $alpha, int $passNumber = 1) : string
    {
        $ascii = ord($alpha) ;

        if($ascii + $passNumber > 90){
            throw new Exception("已超過字母總數");
        }
        $char = chr($ascii + $passNumber);

        return $char;
    }

    public static function nextIsOver(string $alpha, int $passNumber = 1) : bool
    {
        $ascii = ord($alpha) ;

        if($ascii + $passNumber > 90){
            return true;
        }
        return false;
    }
}
