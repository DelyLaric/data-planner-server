<?php

namespace App\Services\Database;

use App\Services\Database\Facades\DB;

class Data
{
    public function create($operationId, $table, $data)
    {
        $id = Facades\DB::insert($table, $data);
        Facades\Snapshot::create($operationId, $table, $id);
    }

    public function update($operationId, $table, $id, $data)
    {
        Facades\DB::update($table, $id);
        Facades\Snapshot::new($operationId, $table, $id);
    }

    public function delete($operationId, $table, $id)
    {
        Facades\DB::delete($table, $id);
        Facades\Snapshot::delete($table, $id);
    }

    public function search($table, $ids)
    {
        return Facades\DB::find($table, $ids);
    }
}
