<?php

namespace App\Facades;

use Illuminate\Support\Facades\DB as BaseDB;

class DB extends BaseDB
{
  public static function updateOrCreate()
  {
    return 'success to extend';
  }
}
