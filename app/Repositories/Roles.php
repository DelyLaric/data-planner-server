<?php

namespace App\Repositories;

use DB;
use JWT;

class Roles extends BaseRepository
{
    public function search()
    {
        return DB::table('_system.roles')->get();
    }

    /*
     * @params
     * ['name', 'id']
     */
    public function create($params)
    {
        $id = DB::table('_system.roles')->insertGetId($params, 'id');

        return DB::table('_system.roles')->where('id', $id)->get()[0];
    }

    public function rename($id, $name)
    {
        DB::table('_system.roles')
          ->where('id', $id)
          ->update(['name' => $name]);

        return DB::table('_system.roles')->where('id', $id)->get()[0];
    }

    public function disable($id)
    {
        DB::table('_system.roles')
          ->where('id', $id)
          ->update(['disabled' => true]);
    }
}
