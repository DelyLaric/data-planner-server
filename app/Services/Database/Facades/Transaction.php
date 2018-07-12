<?php

namespace App\Services\Database\Facades;

use Illuminate\Support\Facades\Facade;

class Transaction extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'App\Services\Database\Transaction';
    }
}
