<?php

namespace App\Services;

class Formater
{
    public static function format(array $arr): array
    {
        foreach ($arr as $index => $value) {
            if (is_null($value)) {
                unset($arr[$index]);
            }
        }

        return $arr;
    }
}
