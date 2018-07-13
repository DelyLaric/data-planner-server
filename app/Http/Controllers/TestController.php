<?php

namespace App\Http\Controllers;

use App\Services\Database\Facades\DB;

class TestController extends Controller
{
    public function test()
    {
      return (
        DB::find('_system.users', [1, 3])
      );
    }
}
