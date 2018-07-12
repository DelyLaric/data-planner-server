<?php

namespace App\Services\Database;

use DB;

class Data
{

    /**
     * @param array $data
     *   $data: [{
     *      "table": "users",
     *      "data": [{
     *          "name": "test",
     *          "email": "email"
     *      }] || {...}
     *   }] || {...}
     */

    public function insert($operationId, $table, $data)
    {
        $affectId = Facade\Affect::insert($operationId, $table);

    }

    public function insert($userId, $namespace, $type, $comment, $data)
    {
        $data = isset($data[0]) ? $data : [$data];
 
        Facades\Transaction::begin();

        $operationId = Facades\Operation::create($userId, $namespace, $type, $comment);
        $dataIds = Facades\Data::insert($data);
        $affectIds = Facades\Affect::insert($operationId, array_keys($dataIds));

        foreach ($dataIds as $table => $ids) {
            Facades\Snapshot::create($affectIds[$table], $table, $ids);
        }

        Facades\Transaction::commit();
    }

    /**
     * @param array $data
     * [{
     *   "table": "users",
     *   "view": "user_view",
     *   "data": [{
     *      .....
     *   }],
     * }]
     */

    public function update($userId, $namespace, $type, $comment, $data)
    {
        $data = isset($data[0]) ? $data : [$data];
        Facades\Transaction::begin();
        $operationId = Facade\Operation::create($userId, $namespace, $type, $comment);
        $dataIds = Facades\Data::update($data);
        $affectIds = Facade\Affect::insert($operationId, array_keys($dataIds));

        foreach ($dataIds as $table => $ids) {
            Facades\Snapshot::create($affectIds[$table], $table, $ids);
        }

        Facades\Transaction::commit();
    }
}
