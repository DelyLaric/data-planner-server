<?php

namespace App\Http\Controllers;

use App\Services\Database\Facades as Facade;
use Illuminate\Support\Facades\Schema;

class TestController extends Controller
{
    public function test()
    {
        // Schema::create('users', function ($table) {
        //     $table->increments('id');
        //     $table->string('name');
        // });

        return 100;

        return Facade\Operation::excute(1, 'namespace', 'type', null, [
            [
                'type' => 'delete',
                'table' => 'users',
                'id' => 2,
                'data' => ['name' => 'test_update']
            ],
            [
                'type' => 'search',
                'table' => 'users',
                'id' => 1
            ]
        ]);
        // DB::updateWhere(
        //     'users',

        //         ['name' => 'ttt23', 'id' => 10],

        //     ['name' => 'ttt234']
        // );

        // $id = Facade\Operation::create(1, 'namespace', 'type', ['title' => '1000', 'content' => 'asdasd']);
        // return $id;
        $result = Facade\DB::all('users');
        // return (
        //   DB::findWhere('_system.roles', ['name' => 'admin'])
        // );
    }
}
