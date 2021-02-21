<?php

namespace App\Gateway\ContaAzul;

use App\Gateway\ContaAzul\Services\Auth;
use App\Gateway\ContaAzul\Services\Customers;
use App\Gateway\ContaAzul\Services\Sales;

final class ContaAzul
{
    public static function auth(): Auth
    {
        return app(Auth::class);
    }

    public static function customers(): Customers
    {
        return app(Customers::class);
    }

    public static function sales(): Sales
    {
        return app(Sales::class);
    }
}
