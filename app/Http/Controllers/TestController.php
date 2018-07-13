<?php

namespace App\Http\Controllers;

use App\Services\Database\Facades\DB;

class TestController extends Controller
{
    public function test()
    {
      return 100;
    }
}
