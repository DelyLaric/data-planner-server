<?php

namespace App\Http\Controllers;

use DB;

class TestController extends BaseController
{
    public function test()
    {
      return DB::select('select * from data."Plan" limit 100');
    }
}
