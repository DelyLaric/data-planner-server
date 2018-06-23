<?php

namespace App\Repositories;

use App\Repositories\Views;
use App\Repositories\Models\BaseModel;

class Operation extends BaseRepository
{
    public function add($type, $namespace, $userId)
    {
        return DB::table('_log.operations')->insertGetId([
            'type' => $type,
            'namespace' => $namespace,
            'operator_id' => $userId
        ]);
    }
}
