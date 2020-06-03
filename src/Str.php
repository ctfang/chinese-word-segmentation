<?php
/**
 * Created by PhpStorm.
 * User: ctfang
 * Date: 2020-06-02
 * Time: 11:08
 */

namespace ChineseWordSegmentation;


class Str
{
    /**
     * @param string $str
     * @return array
     */
    public static function toArray(string $str): array
    {
        $length = mb_strlen($str);
        $arr = [];
        for ($i = 0; $i < $length; $i++) {
            $arr[] = mb_substr($str, $i, 1, 'utf-8');
        }

        return $arr;
    }
}