<?php

namespace App\Services\Database\Facades;

use Illuminate\Support\Facades\Facade;

class Snapshot extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'App\Services\Database\Snapshot';
    }
}
