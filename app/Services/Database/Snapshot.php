<?php

namespace App\Services\Database;

use DB;

class Snapshot
{
    public function new($operationId, $table, $id)
    {
        $data = Facades\DB::findOne($table, $id);
        Facades\DB::create('_log.snapshot', [
            'operationId' => $operationId,
            'table' => $table,
            'data' => json_encode($data)
        ]);
    }

    public function create($operationId, $table, $ids)
    {
        $dataSet = Facades\DB::find($table, $ids);
        foreach ($dataSet as $data) {
            $insertParams[] = [
                'operationId' => $operationId,
                'table' => $table,
                'data' => json_encode($data)
            ];
        }

        Facades\DB::create('_log.snapshot', $insertParams);
    }

    // todo remove DB injection !!!!!!!!!!!!!!
    public function delete($table, $ids)
    {
        $ids = is_array($ids) ? $ids : [$ids];

        DB::table('_log.snapshot')->where('table', $table)->whereIn('id', $ids)->delete();
    }
}
