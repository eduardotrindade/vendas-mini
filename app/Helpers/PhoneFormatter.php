<?php

namespace App\Helpers;

class PhoneFormatter
{
    private static function cellphone(string $value): string
    {
        return preg_replace('/^(\d{2})(\d{5})(\d{4})$/', '($1) $2-$3', $value);
    }

    private static function fixedphone(string $value): string
    {
        return preg_replace('/^(\d{2})(\d{4})(\d{4})$/', '($1) $2-$3', $value);
    }

    public static function formatter(string $value): string
    {
        if (strlen($value) === 11) {
            return self::cellphone($value);
        }

        return self::fixedphone($value);
    }
}
