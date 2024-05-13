<?php
namespace Modules\Basic\Helpers;
use Exception;

/**
 * 取得下一個號碼，超過位數最大值時，使用字母開頭產生編號(僅第一位)
 */
class GetNextNoHelper
{
    public static function getNextNo(string $currentNo, int $length) : string
    {
        $firstChar = substr($currentNo, 0, 1);
        $number = intval(substr($currentNo, 1, strlen($currentNo) - 1));
        $numberChar = "0";
        if (ctype_alpha($firstChar)) {
            if(GetNumberLengthHelper::length($number + 1) > $length - 1){
                $firstChar = AlphaHelper::getNextAlpha($firstChar);
                $numberChar = str_pad("0", $length - 1, "0");
            } else {
                $numberChar = strval($number + 1);
            }
        } elseif (ctype_digit($firstChar)) {

            if(GetNumberLengthHelper::length($number + 1) > $length - 1){
                if($firstChar === "9"){
                    $firstChar = "A";
                    $numberChar = str_pad("0", $length - 1, "0");
                } else {
                    $firstChar = strval(intval($firstChar) + 1);
                }
            } else {
                $numberChar = strval($number + 1);
            }
        }
        return $firstChar . $numberChar;
    }
}
