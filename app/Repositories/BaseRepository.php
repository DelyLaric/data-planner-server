<?php

namespace App\Repositories;

use DB;

class BaseRepository
{
    public function builder()
    {
        return app('db')->connection('data');
    }

    public function increments($table, $column = 'id')
    {
        return DB::raw("(select coalesce(max($column), 0) + 1 from $table)");
    }
}
