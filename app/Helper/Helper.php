<?php

namespace App\Helper;

class Helper
{
    public static function stringToArrayFormat($string): array
    {
        return explode(',', str_replace('"', '', $string));
    }
}
