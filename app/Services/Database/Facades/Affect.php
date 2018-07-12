<?php

namespace App\Services\Database\Facades;

use Illuminate\Support\Facades\Facade;

class Affect extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'App\Services\Database\Affect';
    }
}
