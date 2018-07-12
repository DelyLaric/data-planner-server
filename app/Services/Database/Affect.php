<?php

namespace App\Services\Database;

use DB;

class Affect
{
    /**
     * 一致性问题：创建记录之前，operationId 一定不存在
     * 以及开启事务后，serial 是否会受影响
     * 
     * 返回与 tables 所对应的 affectId
     * [
     *   'table1' => id1,
     *   'table2' => id2 
     * ]
     */
    // public function insert($operationId, $tables)
    // {
    //     $tables = is_array($tables) ? $tables : [$tables];
    //     $result = [];

    //     foreach ($tables as $table) {
    //         $id = DB::table('_log.affect')->insertGetId([
    //             'operationId' => $operationId,
    //             'table' => $table
    //         ]);

    //         $result[$table] = $id;
    //     }
        
    //     return $result;
    // }

    public function create($operationId, $tables)
    {
        
        $result = [];
        foreach ($tables as $table) {
            $id = DB::table('_log.affect')->insertGetId([
                'operationId' => $operationId,
                'table' => $table
            ]);
            
            $result[$table] = $id;
        }
        
        return $result;
    }
}
