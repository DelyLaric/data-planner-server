<?php

namespace App\Services\Database;

class Operation
{
    /**
     * @param array $comment
     * 
     * 当不传入 comment 时，为他提供一个空对象
     */

    public function create($userId, $namespace, $type, $comment = null)
    {
        return Facade\DB::insertOne($table, [
            'type' => $type,
            'namespace' => $namespace,
            'operatorId' => $userId,
            'comment' => $comment === null ? '{}' : json_encode($comment)
        ]);
    }
}
