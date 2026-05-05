<?php

namespace App\Gateway\ContaAzul;

use App\Gateway\ContaAzul\Services\Auth;
use App\Gateway\ContaAzul\Services\Customers;
use App\Gateway\ContaAzul\Services\Sales;

final class ContaAzul
{
    public static function auth()
    {
        return app(Auth::class);
    }

    public static function customers()
    {
        return app(Customers::class);
    }

    public static function sales()
    {
        return app(Sales::class);
    }
}
