<?php
namespace App\Services;

class GenerateSlug
{
    public static function make($key)
    {
        return  str_replace(' ', '-', $key);
    }
}
