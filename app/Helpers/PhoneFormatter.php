<?php

namespace App\Helpers;

class PhoneFormatter
{
    private static function cellphone($value)
    {
        return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $value);
    }

    private static function fixedphone($value)
    {
        return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $value);
    }

    public static function formatter($value)
    {
        $value = preg_replace('/[^0-9]/', '', $value);

        if (strlen($value) === 11) {
            return self::cellphone($value);
        }

        if (strlen($value) === 10) {
            return self::cellphone('0' . $value);
        }

        return self::fixedphone($value);
    }
}