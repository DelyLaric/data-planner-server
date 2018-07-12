<?php

namespace App\Services\Database;

use DB;

class Snapshot
{
    public function create($affectId, $table, $ids)
    {
        $ids = is_array($ids) ? $ids : [$ids];

        $dataSet = DB::table($table)->whereIn('id', $ids)->get();

        $insertParams = [];

        foreach ($dataSet as $data) {
            $insertParams[] = [
                'affectId' => $affectId,
                'data' => json_encode($data)
            ];
        }

        DB::table('_log.snapshot')->insert($insertParams);
    }
}

    /**
     * @param string $table
     * @param array $data
     * 
     * 在制定数据表中插入一条或多条数据，并返回插入后数据的 id
     */
