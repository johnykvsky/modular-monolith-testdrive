<?php

namespace Spisywarka\Application\Helper;

class Polyfill
{
    public static function filter(string $string): string
    {
        $str = preg_replace('/\x00|<[^>]*>?/', '', $string);
        return str_replace(["'", '"'], ['&#39;', '&#34;'], $str);
    }
}